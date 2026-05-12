<?php
/**
 * Mitsue_Admin_Page
 *
 * Settings → Mitsue Content — tabbed page for managing all front-page content.
 *
 * Design approach (inspired by Astra):
 *  • All controls declared as config arrays — one array entry per field.
 *  • Tabs map to logical page sections (Hero, Programme, …).
 *  • Everything saves into ONE option: mitsue_options[key].
 *  • Repeaters render as JS-enhanced tables; data stored as JSON strings.
 *
 * @package Mitsue
 */

if ( ! class_exists( 'Mitsue_Admin_Page' ) ) {

	class Mitsue_Admin_Page {

		private static ?Mitsue_Admin_Page $instance = null;

		public static function get_instance(): self {
			if ( self::$instance === null ) {
				self::$instance = new self();
				self::$instance->init();
			}
			return self::$instance;
		}

		private function init(): void {
			add_action( 'admin_menu',            [ $this, 'add_page' ] );
			add_action( 'admin_init',            [ $this, 'register_setting' ] );
			add_action( 'admin_enqueue_scripts', [ $this, 'enqueue' ] );
		}

		/* ── Menu & setting registration ───────────────────────────── */

		public function add_page(): void {
			add_submenu_page(
				'options-general.php',
				__( 'Mitsue Content', 'mitsue' ),
				__( 'Mitsue Content', 'mitsue' ),
				'edit_posts',
				'mitsue-content',
				[ $this, 'render_page' ]
			);
		}

		public function register_setting(): void {
			register_setting( 'mitsue_options_group', 'mitsue_options', [
				'sanitize_callback' => [ $this, 'sanitize_options' ],
			] );
		}

		public function sanitize_options( $input ): array {
			if ( ! is_array( $input ) ) return [];
			$clean = [];
			foreach ( $input as $key => $val ) {
				$key = sanitize_key( $key );
				if ( is_array( $val ) ) {
					// Repeater submitted as nested array → encode to JSON.
					$rows = [];
					foreach ( $val as $row ) {
						if ( ! is_array( $row ) ) continue;
						$clean_row = [];
						foreach ( $row as $col => $cell ) {
							$clean_row[ sanitize_key( $col ) ] = wp_kses_post( (string) $cell );
						}
						$rows[] = $clean_row;
					}
					$clean[ $key ] = wp_json_encode( $rows );
				} else {
					$clean[ $key ] = wp_kses_post( (string) $val );
				}
			}
			return $clean;
		}

		public function enqueue( string $hook ): void {
			if ( $hook !== 'settings_page_mitsue-content' ) return;
			wp_enqueue_media();
			wp_enqueue_style(  'mitsue-admin', MITSUE_URI . '/assets/admin.css', [], MITSUE_VERSION );
			wp_enqueue_script( 'mitsue-admin', MITSUE_URI . '/assets/admin.js',  [], MITSUE_VERSION, true );
		}

		/* ── Field schema ───────────────────────────────────────────── */
		/*
		 * Declare every editable field here.
		 *   tab      → which tab it appears on
		 *   label    → human label shown above the control
		 *   type     → text | textarea | email | url | repeater
		 *   default  → fallback when option is empty
		 *   columns  → (repeaters only) [ col_key => Column Label ]
		 *   defaults → (repeaters only) default rows array
		 */
		public function field_schema(): array {
			return [

				/* ─── Hero ─────────────────────────────────────────── */
				'hero_eyebrow' => [
					'tab'     => 'hero',
					'label'   => __( 'Eyebrow text', 'mitsue' ),
					'type'    => 'text',
					'default' => 'A 25-YEAR INITIATIVE · 二十五年計画',
				],
				'hero_headline_en' => [
					'tab'     => 'hero',
					'label'   => __( 'Headline (EN) — wrap accent words in <em>…</em>', 'mitsue' ),
					'type'    => 'textarea',
					'default' => 'Forest restoration, distributed energy, and a <em>community-owned</em> data center — in rural Japan.',
				],
				'hero_headline_jp' => [
					'tab'     => 'hero',
					'label'   => __( 'Headline (JP)', 'mitsue' ),
					'type'    => 'text',
					'default' => '森林再生・分散型再生可能エネルギー・地域所有のデータセンター',
				],
				'hero_lede_en' => [
					'tab'     => 'hero',
					'label'   => __( 'Intro paragraph (EN)', 'mitsue' ),
					'type'    => 'textarea',
					'default' => 'The Mitsue Project repurposes a closed mountain school and the forests around it into a single, transparent, openly replicable demonstration of rural revitalization — modest in scale, patient in horizon, built to be copied.',
				],
				'hero_lede_jp' => [
					'tab'     => 'hero',
					'label'   => __( 'Intro paragraph (JP)', 'mitsue' ),
					'type'    => 'textarea',
					'default' => '御杖プロジェクトは、閉校した山間の小学校とその周囲の森林を、農山村再生の透明で再現可能な統合モデルへと再生する取り組みです。',
				],
				'hero_meta' => [
					'tab'     => 'hero',
					'label'   => __( 'Hero stat facts (4 boxes)', 'mitsue' ),
					'type'    => 'repeater',
					'columns' => [ 'k' => 'Label', 'v' => 'Value', 'sub' => 'Subtext' ],
					'defaults' => [
						[ 'k' => 'LOCATION',     'v' => 'Mitsue Village', 'sub' => 'Nara Prefecture · 奈良県御杖村' ],
						[ 'k' => 'HORIZON',      'v' => '25 Years',       'sub' => 'Bridging today to small-scale fusion' ],
						[ 'k' => 'STRUCTURE',    'v' => 'Non-profit',     'sub' => '一般社団法人 → NPO法人' ],
						[ 'k' => 'YEAR-3 TARGET','v' => '¥134M',          'sub' => 'Five-layer funding stack' ],
					],
				],

				/* ─── Programme ─────────────────────────────────────── */
				'pillars' => [
					'tab'     => 'programme',
					'label'   => __( 'Programme pillars', 'mitsue' ),
					'type'    => 'repeater',
					'columns' => [ 'num' => 'Numeral', 'title_en' => 'Title EN', 'title_jp' => 'Title JP', 'body' => 'Body EN (separate paragraphs with |)', 'body_jp' => 'Body JP (separate paragraphs with |)', 'tag' => 'Footer tag' ],
					'defaults' => [
						[ 'num' => 'i',   'title_en' => 'Forest Restoration',    'title_jp' => '森林再生 · Native broadleaf', 'body' => "Phased replacement of aged sugi (cedar) plantations with native broadleaf species, with private landowners, the Forestry Agency (林野庁), and local contractors. Liability becomes feedstock and timber revenue.|The 25-year arc aligns to the ecological clock, not the funding cycle.", 'body_jp' => '老齢化した杉（スギ）の人工林を、地元の土地所有者・林野庁・地域請負業者と協力しながら、段階的に在来広葉樹種へ転換します。負の資産を木材収益へと転換します。|25年という時間軸は、資金調達サイクルではなく、生態系の時計に合わせたものです。', 'tag' => 'Sugi → Broadleaf · 25-year cycle' ],
						[ 'num' => 'ii',  'title_en' => 'Sustainable Energy',    'title_jp' => '再生可能エネルギー · Thermal first', 'body' => 'Biomass and biogas generation from sustainably harvested forest material — sized for village load, EV charging, and greenhouse heat.|Thermal first, electrical second. A boiler with heat recovery costs roughly one-third of a CHP unit and runs several times more efficiently.', 'body_jp' => '持続可能な形で収穫した森林資源から、バイオマス・バイオガスを発電——村の電力需要、EV充電、温室暖房に対応できる規模。|まず熱、次に電気。熱回収付きボイラーはCHPユニットの約3分の1のコストで、数倍の効率を発揮します。', 'tag' => 'Biomass · Solar · Grid backup' ],
						[ 'num' => 'iii', 'title_en' => 'Community Data Center', 'title_jp' => '地域所有データセンター · Edge-scale', 'body' => 'The closed Mitsue Elementary School building, repurposed as a small-scale, energy-efficient edge-compute facility powered entirely by locally generated renewable energy.|Sized for accountability and community ownership — not hyperscale economics. Designed to be replicated by other depopulating municipalities.', 'body_jp' => '廃校となった御杖小学校の校舎を、地域で発電した再生可能エネルギーのみで稼働する、小規模・省エネ型エッジコンピュート施設として再活用します。|ハイパースケール経済ではなく、説明責任と地域所有のための規模。過疎自治体が複製できるモデルとして設計されています。', 'tag' => 'Edge compute · Heat re-use · Replicable' ],
					],
				],

				/* ─── Imagery ───────────────────────────────────────── */
				'imagery_left' => [
					'tab'     => 'imagery',
					'label'   => __( 'Left image URL — forest (paste from Media Library or use picker)', 'mitsue' ),
					'type'    => 'image',
					'default' => '',
				],
				'imagery_right' => [
					'tab'     => 'imagery',
					'label'   => __( 'Right image URL — closed school', 'mitsue' ),
					'type'    => 'image',
					'default' => '',
				],

				/* ─── Rationale ─────────────────────────────────────── */
				'rationale' => [
					'tab'     => 'rationale',
					'label'   => __( 'Rationale items', 'mitsue' ),
					'type'    => 'repeater',
					'columns' => [ 'n' => 'Eyebrow', 'title' => 'Title EN', 'jp' => 'Title JP', 'body' => 'Body EN', 'body_jp' => 'Body JP' ],
					'defaults' => [
						[ 'n' => '01 · ENERGY TRANSITION', 'title' => 'Distributed generation, not grid extension.',        'jp' => 'EV普及と分散型発電',    'body' => 'Within roughly ten years, the majority of Japanese passenger vehicles are expected to be electric. Rural regions need significant new distributed generation capacity — grid extension is slow and capital-intensive.', 'body_jp' => 'およそ10年以内に、日本の乗用車の大半が電気自動車になると予測されています。農村部には大規模な分散型発電能力が必要であり、系統延伸は遅く資本集約的です。' ],
						[ 'n' => '02 · FOREST LIABILITY',  'title' => 'Aged cedar plantations as under-managed asset.',     'jp' => '放置された杉人工林の活用', 'body' => 'Aged sugi plantations impose ecological costs — pollen burden, biodiversity loss — and physical risks: landslide and fire. Active management converts liability into feedstock and timber revenue.', 'body_jp' => '老齢化した杉の人工林は、花粉被害・生物多様性の喪失といった生態的コストと、土砂崩れ・火災リスクをもたらします。適切な管理により、負の資産を燃料や木材収益へと転換できます。' ],
						[ 'n' => '03 · STRANDED ASSETS',   'title' => 'Closed schools as anchor facilities.',               'jp' => '廃校の利活用',         'body' => 'Closed schools currently impose net maintenance costs on shrinking municipal budgets. Productive reuse turns these into community-anchored facilities.', 'body_jp' => '廃校は現在、縮小する自治体予算に維持管理コストとして負担をかけています。有効活用することで、地域の拠点施設へと転換できます。' ],
						[ 'n' => '04 · DIGITAL DEFICIT',   'title' => 'Edge compute where the energy is.',                  'jp' => '農村部のデジタル基盤不足', 'body' => 'Rural broadband and edge-compute capacity continue to lag urban Japan. A small, energy-aligned data center addresses both the connectivity gap and the on-site computation gap at the same time.', 'body_jp' => '農村部のブロードバンドとエッジコンピューティング能力は、都市部に比べて依然として遅れています。エネルギーと連携した小規模データセンターが、接続性と演算能力の両方のギャップを同時に解消します。' ],
					],
				],

				/* ─── Timeline ──────────────────────────────────────── */
				'phases' => [
					'tab'     => 'timeline',
					'label'   => __( 'Timeline phases', 'mitsue' ),
					'type'    => 'repeater',
					'columns' => [ 'name' => 'Phase name', 'title' => 'Title EN', 'jp' => 'JP', 'months' => 'Months', 'note' => 'Note', 'budget' => 'Budget', 'extra' => 'Extra note', 'current' => 'Current (1=yes)' ],
					'defaults' => [
						[ 'name' => 'Phase 0 — Current', 'title' => 'Pre-Foundation',  'jp' => '準備期',         'months' => 'Months 01 – 03', 'note' => 'Local trust-building, founding team, draft charter.', 'budget' => '¥0 – 0.5M',  'extra' => 'self-funded', 'current' => '1' ],
						[ 'name' => 'Phase 1',           'title' => 'Foundation',      'jp' => '基盤構築期',     'months' => 'Months 04 – 09', 'note' => 'Legal entity, feasibility studies, advisors.',       'budget' => '¥3 – 8M',    'extra' => '', 'current' => '0' ],
						[ 'name' => 'Phase 2',           'title' => 'Pilot Design',    'jp' => 'パイロット設計期', 'months' => 'Months 10 – 18', 'note' => 'Engineering, partnerships, permits.',               'budget' => '¥15 – 30M',  'extra' => '', 'current' => '0' ],
						[ 'name' => 'Phase 3',           'title' => 'Pilot Build',     'jp' => 'パイロット建設期', 'months' => 'Months 19 – 30', 'note' => 'First-stage construction, commissioning.',          'budget' => '¥80 – 200M', 'extra' => '', 'current' => '0' ],
						[ 'name' => 'Phase 4',           'title' => 'Operate & Scale', 'jp' => '運営・拡張期',   'months' => 'Months 31 +',    'note' => 'Operations, monitoring, replication.',               'budget' => 'Revenue-led', 'extra' => '', 'current' => '0' ],
					],
				],
				'gates' => [
					'tab'     => 'timeline',
					'label'   => __( 'Funding gates', 'mitsue' ),
					'type'    => 'repeater',
					'columns' => [ 'n' => 'Gate ID', 'v' => 'Amount', 'note' => 'Label' ],
					'defaults' => [
						[ 'n' => 'G1', 'v' => '¥3 – 8M',       'note' => 'Foundation gate' ],
						[ 'n' => 'G2', 'v' => '¥30 – 50M',     'note' => 'Design gate' ],
						[ 'n' => 'G3', 'v' => '¥80 – 200M',    'note' => 'Build gate' ],
						[ 'n' => 'G4', 'v' => 'Revenue online', 'note' => 'Operating gate' ],
					],
				],

				/* ─── Governance ────────────────────────────────────── */
				'advisors' => [
					'tab'     => 'governance',
					'label'   => __( 'Advisory board members', 'mitsue' ),
					'type'    => 'repeater',
					'columns' => [ 'initials' => 'Initials', 'name' => 'Full name', 'credit' => 'Bio / credit paragraph' ],
					'defaults' => [
						[ 'initials' => 'J.I.', 'name' => 'Joi Ito',   'credit' => 'Former Director, MIT Media Lab. Internet pioneer; long-running engagement with Japanese institutions, technology policy, and emerging compute. Confirmed May 5, 2026.' ],
						[ 'initials' => 'R.O.', 'name' => 'Ray Ozzie', 'credit' => 'Software pioneer; former Chief Software Architect at Microsoft. Decades of work on distributed systems, collaboration software, and the discipline of small, accountable platforms. Confirmed May 5, 2026.' ],
					],
				],
				'founders' => [
					'tab'     => 'governance',
					'label'   => __( 'Founding members', 'mitsue' ),
					'type'    => 'repeater',
					'columns' => [ 'name' => 'Name', 'when' => 'Note / affiliation' ],
					'defaults' => [
						[ 'name' => 'Rob Oudendijk',       'when' => 'YR-Design · Safecast' ],
						[ 'name' => 'Japanese Co-founder', 'when' => 'To be confirmed' ],
						[ 'name' => 'Founding member · 3', 'when' => 'To be confirmed' ],
						[ 'name' => 'Founding member · 4', 'when' => 'To be confirmed' ],
						[ 'name' => 'Target size',         'when' => '3 – 5 total' ],
					],
				],
				'legal_path' => [
					'tab'     => 'governance',
					'label'   => __( 'Legal structure path', 'mitsue' ),
					'type'    => 'repeater',
					'columns' => [ 'name' => 'Stage name', 'when' => 'Timeline' ],
					'defaults' => [
						[ 'name' => 'Pre-incorporation',                         'when' => 'Today' ],
						[ 'name' => '一般社団法人 · Gen. Incorporated Assoc.',   'when' => 'First 6 – 9 mo' ],
						[ 'name' => 'NPO法人 · Specified Nonprofit',            'when' => 'Months 18 – 24' ],
						[ 'name' => '認定NPO法人 · Certified NPO',              'when' => 'Long-term' ],
					],
				],

				/* ─── Funding ───────────────────────────────────────── */
				'funding_rows' => [
					'tab'     => 'funding',
					'label'   => __( 'Funding stack rows', 'mitsue' ),
					'type'    => 'repeater',
					'columns' => [ 'layer' => 'Layer', 'name' => 'Source name', 'desc' => 'Description', 'y1' => 'Year 1', 'y3' => 'Year 3' ],
					'defaults' => [
						[ 'layer' => 'L1', 'name' => 'Founder / private capital', 'desc' => 'Self-funded ramp; founder commitments',                                   'y1' => '¥3M', 'y3' => '¥1M' ],
						[ 'layer' => 'L2', 'name' => 'Government grants',          'desc' => 'NEDO · METI · Nara Prefecture · Mitsue Village',                         'y1' => '¥5M', 'y3' => '¥80M' ],
						[ 'layer' => 'L3', 'name' => 'Foundations',                'desc' => 'Nippon Foundation · Japan Fund for Global Environment · Toyota Foundation','y1' => '¥3M', 'y3' => '¥20M' ],
						[ 'layer' => 'L4', 'name' => 'Corporate partnerships',     'desc' => 'Dutch and Japanese corporates; CSR-aligned',                             'y1' => '¥0',  'y3' => '¥30M' ],
						[ 'layer' => 'L5', 'name' => 'Operating revenue',          'desc' => 'Hosting fees · FIT/FIP · heat · EV charging · J-Credits',               'y1' => '¥0',  'y3' => '¥3M' ],
					],
				],
				'funding_total_y1' => [
					'tab'     => 'funding',
					'label'   => __( 'Total — Year 1', 'mitsue' ),
					'type'    => 'text',
					'default' => '¥11M',
				],
				'funding_total_y3' => [
					'tab'     => 'funding',
					'label'   => __( 'Total — Year 3', 'mitsue' ),
					'type'    => 'text',
					'default' => '¥134M',
				],

				/* ─── Principles ────────────────────────────────────── */
				'principles' => [
					'tab'     => 'principles',
					'label'   => __( 'Operating principles', 'mitsue' ),
					'type'    => 'repeater',
					'columns' => [ 'n' => 'Numeral', 'title' => 'Title EN', 'jp' => 'Title JP', 'body' => 'Body EN', 'body_jp' => 'Body JP' ],
					'defaults' => [
						[ 'n' => 'i.',   'title' => 'Local first',           'jp' => '地域第一',     'body' => 'Every material decision begins with the wellbeing of Mitsue residents and landowners. Not as marketing — as a procedural rule.',          'body_jp' => 'あらゆる意思決定は、御杖の住民と土地所有者の幸福を起点とします。マーケティングではなく、手続き上のルールとして。' ],
						[ 'n' => 'ii.',  'title' => 'Open and transparent',  'jp' => '公開・透明',    'body' => 'Environmental data, financial records, and methodologies are published. The default is open; exceptions are documented.',                   'body_jp' => '環境データ・財務記録・手法はすべて公開します。デフォルトはオープン。例外は文書化します。' ],
						[ 'n' => 'iii.', 'title' => 'Patient and long-term', 'jp' => '忍耐と長期視野', 'body' => 'A 25-year horizon. No premature scaling. Funding gates are honored even when delay is uncomfortable.',                                   'body_jp' => '25年という時間軸。拙速なスケールアップは行いません。遅延が不本意であっても、資金ゲートを遵守します。' ],
						[ 'n' => 'iv.',  'title' => 'Replicable',            'jp' => '再現可能',      'body' => 'Documentation discipline is treated as a deliverable, not an afterthought. The point is that other villages can copy this.',              'body_jp' => '文書化の規律は成果物として扱います。他の村がこのモデルを複製できることが目的です。' ],
						[ 'n' => 'v.',   'title' => 'Modest in scale',       'jp' => '適正な規模',   'body' => 'Small enough to remain accountable to the community that hosts it. Hyperscale economics are explicitly not the goal.',                   'body_jp' => '受け入れてくれるコミュニティに対して説明責任を果たせる規模を維持します。ハイパースケール経済は明示的に目標としません。' ],
						[ 'n' => 'vi.',  'title' => 'Non-partisan',          'jp' => '中立',          'body' => "No political alignment. Positions are confined to the project's mission and to what the published evidence supports.",                   'body_jp' => '特定の政治的立場を取りません。主張はプロジェクトの使命と、公開された証拠が支持する範囲に限定します。' ],
					],
				],

				/* ─── Status ────────────────────────────────────────── */
				'status_completed' => [
					'tab'     => 'status',
					'label'   => __( 'Completed items', 'mitsue' ),
					'type'    => 'repeater',
					'columns' => [ 't' => 'Item text' ],
					'defaults' => [
						[ 't' => 'Initial meeting with Vice Mayor of Mitsue (late 2025)' ],
						[ 't' => 'Initial meeting with the local forestry group (early 2026)' ],
						[ 't' => 'Drafted founding charter and detailed implementation plan' ],
						[ 't' => 'Phase & funding-gate flowchart published' ],
						[ 't' => 'Advisory commitments: Joi Ito and Ray Ozzie' ],
					],
				],
				'status_progress' => [
					'tab'     => 'status',
					'label'   => __( 'In-progress items', 'mitsue' ),
					'type'    => 'repeater',
					'columns' => [ 't' => 'Item text' ],
					'defaults' => [
						[ 't' => 'Identifying a Japanese co-founder with rural credibility' ],
						[ 't' => 'Scheduling a formal meeting with the Village Mayor' ],
						[ 't' => 'Drafting bylaws for a 一般社団法人' ],
						[ 't' => 'Engaging a 行政書士 (administrative scrivener) in Nara' ],
					],
				],
				'status_next' => [
					'tab'     => 'status',
					'label'   => __( 'Next 30 days', 'mitsue' ),
					'type'    => 'repeater',
					'columns' => [ 't' => 'Item text' ],
					'defaults' => [
						[ 't' => 'Approach candidate Japanese co-founder' ],
						[ 't' => 'Hold informal meeting with the Village Mayor' ],
						[ 't' => 'Initial consultations with administrative scriveners' ],
						[ 't' => 'Finalise a two-page bilingual charter for distribution' ],
					],
				],

				/* ─── CTA ───────────────────────────────────────────── */
				'cta_lead_name' => [
					'tab'     => 'cta',
					'label'   => __( 'Project lead name', 'mitsue' ),
					'type'    => 'text',
					'default' => 'Rob Oudendijk',
				],
				'cta_lead_affil' => [
					'tab'     => 'cta',
					'label'   => __( 'Project lead affiliation', 'mitsue' ),
					'type'    => 'text',
					'default' => 'YR-Design · Safecast',
				],
				'cta_email' => [
					'tab'     => 'cta',
					'label'   => __( 'Contact email address', 'mitsue' ),
					'type'    => 'email',
					'default' => '',
				],
				'cta_plan_url' => [
					'tab'     => 'cta',
					'label'   => __( 'Implementation plan URL', 'mitsue' ),
					'type'    => 'url',
					'default' => '#',
				],
				'cta_charter_url' => [
					'tab'     => 'cta',
					'label'   => __( 'Founding charter URL', 'mitsue' ),
					'type'    => 'url',
					'default' => '#',
				],

			]; // end schema
		}

		/* ── Tab labels ─────────────────────────────────────────────── */
		private function tabs(): array {
			return [
				'hero'       => __( 'Hero',       'mitsue' ),
				'programme'  => __( 'Programme',  'mitsue' ),
				'imagery'    => __( 'Imagery',    'mitsue' ),
				'rationale'  => __( 'Rationale',  'mitsue' ),
				'timeline'   => __( 'Timeline',   'mitsue' ),
				'governance' => __( 'Governance', 'mitsue' ),
				'funding'    => __( 'Funding',    'mitsue' ),
				'principles' => __( 'Principles', 'mitsue' ),
				'status'     => __( 'Status',     'mitsue' ),
				'cta'        => __( 'CTA',        'mitsue' ),
			];
		}

		/* ── Page render ────────────────────────────────────────────── */
		public function render_page(): void {
			if ( ! current_user_can( 'edit_posts' ) ) return;

			$tabs   = $this->tabs();
			$active = ( isset( $_GET['tab'] ) && array_key_exists( sanitize_key( $_GET['tab'] ), $tabs ) )
				? sanitize_key( $_GET['tab'] )
				: 'hero';

			$schema  = $this->field_schema();
			$options = (array) get_option( 'mitsue_options', [] );

			echo '<div class="wrap mitsue-admin-wrap">';
			echo '<h1>' . esc_html__( 'Mitsue Content', 'mitsue' ) . '</h1>';
			echo '<p class="description">' . esc_html__( 'Edit all front-page content here. Visual / colour settings are in Appearance → Customize.', 'mitsue' ) . '</p>';

			/* Tab bar */
			echo '<nav class="nav-tab-wrapper mitsue-tabs">';
			foreach ( $tabs as $slug => $label ) {
				$url   = admin_url( 'options-general.php?page=mitsue-content&tab=' . $slug );
				$class = ( $slug === $active ) ? 'nav-tab nav-tab-active' : 'nav-tab';
				printf( '<a href="%s" class="%s">%s</a>', esc_url( $url ), esc_attr( $class ), esc_html( $label ) );
			}
			echo '</nav>';

			/* Form */
			echo '<form method="post" action="options.php" class="mitsue-settings-form">';
			settings_fields( 'mitsue_options_group' );

			foreach ( $schema as $key => $field ) {
				if ( $field['tab'] !== $active ) continue;

				$current = $options[ $key ] ?? null;

				echo '<div class="mitsue-field-group">';
				echo '<h3 class="mitsue-field-heading">' . esc_html( $field['label'] ) . '</h3>';

				if ( $field['type'] === 'repeater' ) {
					$this->render_repeater( $key, $field, $current );
				} else {
					$this->render_scalar( $key, $field, $current );
				}

				echo '</div>';
			}

			submit_button( __( 'Save changes', 'mitsue' ) );
			echo '</form></div>';
		}

		/* ── Render helpers ─────────────────────────────────────────── */

		private function render_scalar( string $key, array $field, $current ): void {
			$value = ( $current !== null && $current !== '' ) ? $current : ( $field['default'] ?? '' );
			$name  = 'mitsue_options[' . esc_attr( $key ) . ']';
			$id    = 'mitsue_' . esc_attr( $key );

			switch ( $field['type'] ) {
				case 'textarea':
					printf(
						'<textarea id="%s" name="%s" class="large-text" rows="4">%s</textarea>',
						$id, $name, esc_textarea( $value )
					);
					break;

				case 'image':
					printf(
						'<div class="mitsue-image-field"><input type="url" id="%s" name="%s" value="%s" class="regular-text" placeholder="https://" />',
						$id, $name, esc_attr( $value )
					);
					printf(
						'<button type="button" class="button mitsue-media-pick" data-target="%s">%s</button>',
						$id, esc_html__( 'Choose from Media Library', 'mitsue' )
					);
					if ( $value ) {
						printf( '<img src="%s" class="mitsue-img-preview" />', esc_url( $value ) );
					}
					echo '</div>';
					break;

				default: // text, email, url
					printf(
						'<input type="%s" id="%s" name="%s" value="%s" class="regular-text" />',
						esc_attr( $field['type'] === 'image' ? 'url' : $field['type'] ),
						$id, $name, esc_attr( $value )
					);
			}
		}

		private function render_repeater( string $key, array $field, $current ): void {
			$rows = null;
			if ( is_string( $current ) && $current !== '' ) {
				$decoded = json_decode( $current, true );
				if ( is_array( $decoded ) && count( $decoded ) ) $rows = $decoded;
			}
			if ( $rows === null ) $rows = $field['defaults'] ?? [];

			$columns  = $field['columns'];
			$col_keys = array_keys( $columns );
			$name_base = 'mitsue_options[' . $key . ']';

			echo '<div class="mitsue-repeater" data-key="' . esc_attr( $key ) . '">';
			echo '<table class="widefat mitsue-repeater-table"><thead><tr>';
			foreach ( $columns as $col_label ) {
				echo '<th>' . esc_html( $col_label ) . '</th>';
			}
			echo '<th class="mitsue-th-action"></th></tr></thead><tbody>';

			foreach ( $rows as $i => $row ) {
				$this->render_repeater_row( $name_base, $col_keys, $row, $i );
			}

			echo '</tbody></table>';
			echo '<button type="button" class="button mitsue-add-row">' . esc_html__( '+ Add row', 'mitsue' ) . '</button>';

			// Template row for JS cloning.
			echo '<template class="mitsue-row-tpl">';
			$this->render_repeater_row( $name_base, $col_keys, array_fill_keys( $col_keys, '' ), '__IDX__' );
			echo '</template>';

			echo '</div>';
		}

		private function render_repeater_row( string $name_base, array $col_keys, array $row, $idx ): void {
			$long_cols = [ 'body', 'credit', 'desc', 't' ];
			echo '<tr>';
			foreach ( $col_keys as $col ) {
				$val  = $row[ $col ] ?? '';
				$name = sprintf( '%s[%s][%s]', $name_base, $idx, $col );
				$is_long = in_array( $col, $long_cols, true );
				echo '<td>';
				if ( $is_long ) {
					printf( '<textarea name="%s" rows="3" class="widefat">%s</textarea>', esc_attr( $name ), esc_textarea( $val ) );
				} else {
					printf( '<input type="text" name="%s" value="%s" class="widefat" />', esc_attr( $name ), esc_attr( $val ) );
				}
				echo '</td>';
			}
			echo '<td><button type="button" class="button-link mitsue-remove-row" title="Remove">✕</button></td>';
			echo '</tr>';
		}
	}

	Mitsue_Admin_Page::get_instance();
}
