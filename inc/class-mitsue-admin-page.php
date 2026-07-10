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
			// Start from existing saved values so fields on other tabs are not wiped.
			$clean = (array) get_option( 'mitsue_options', [] );
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
					'default' => 'The BIOMASS ENERGY & AI project repurposes an unused school or a disused village factory building and the forests around it into a single, transparent, openly replicable demonstration of rural revitalization — modest in scale, patient in horizon, built to be copied.',
				],
				'hero_lede_jp' => [
					'tab'     => 'hero',
					'label'   => __( 'Intro paragraph (JP)', 'mitsue' ),
					'type'    => 'textarea',
					'default' => '御杖くんプロジェクトは、未使用の学校または廃村工場と、その周囲の森林を、農山村再生の透明で再現可能な統合モデルへと転換する取り組みです。',
				],
				'hero_meta' => [
					'tab'     => 'hero',
					'label'   => __( 'Hero stat facts (4 boxes)', 'mitsue' ),
					'type'    => 'repeater',
					'columns' => [ 'k' => 'Label', 'v' => 'Value', 'sub' => 'Subtext EN', 'sub_jp' => 'Subtext JP' ],
					'defaults' => [
						[ 'k' => 'LOCATION',     'v' => 'Mitsue Village', 'sub' => 'Nara Prefecture, Japan',               'sub_jp' => '奈良県御杖村' ],
						[ 'k' => 'HORIZON',      'v' => '25 Years',       'sub' => 'Bridging today to small-scale fusion',  'sub_jp' => '現在から小規模核融合時代への橋渡し' ],
						[ 'k' => 'STRUCTURE',    'v' => 'Non-profit',     'sub' => 'General Incorporated Association → NPO','sub_jp' => '一般社団法人 → NPO法人' ],
						[ 'k' => 'YEAR-3 TARGET','v' => '¥134M',          'sub' => 'Five-layer funding stack',              'sub_jp' => '五層構造の資金調達' ],
					],
				],

				/* ─── Programme ─────────────────────────────────────── */
				'section_img_programme' => [
					'tab'     => 'programme',
					'label'   => __( 'Section image (left column, beside heading)', 'mitsue' ),
					'type'    => 'image',
					'default' => '',
				],
				'pillars' => [
					'tab'     => 'programme',
					'label'   => __( 'Programme pillars', 'mitsue' ),
					'type'    => 'repeater',
					'columns' => [ 'num' => 'Numeral', 'title_en' => 'Title EN', 'title_jp' => 'Title JP', 'body' => 'Body EN (separate paragraphs with |)', 'body_jp' => 'Body JP (separate paragraphs with |)', 'tag' => 'Footer tag' ],
					'defaults' => [
						[ 'num' => 'i',   'title_en' => 'Forest Restoration',    'title_jp' => '森林再生 · Native broadleaf', 'body' => "Phased replacement of aged sugi (cedar) plantations with native broadleaf species, with private landowners, the Forestry Agency (林野庁), and local contractors. Liability becomes feedstock and timber revenue.|The 25-year arc aligns to the ecological clock, not the funding cycle.", 'body_jp' => '老齢化した杉（スギ）の人工林を、地元の土地所有者・林野庁・地域請負業者と協力しながら、段階的に在来広葉樹種へ転換します。負の資産を木材収益へと転換します。|25年という時間軸は、資金調達サイクルではなく、生態系の時計に合わせたものです。', 'tag' => 'Sugi → Broadleaf · 25-year cycle' ],
						[ 'num' => 'ii',  'title_en' => 'Biomass CHP & Energy Resilience', 'title_jp' => 'バイオマスCHP・エネルギーレジリエンス · 太陽光・EV充電', 'body' => 'The village\'s primary energy source is a biomass combined heat and power (CHP) system fuelled by sugi forest thinnings — generating 24/7 baseload electricity (primary output) and heat (secondary output). The forest powers the village. Solar and EV charging complement this biomass core, serving residents and visitors making the transition away from petrol.|Aging rural distribution lines make blackouts a real and growing risk. Unlike intermittent solar alone, the on-site biomass CHP runs round the clock, keeping the data center and critical facilities running through grid outages.', 'body_jp' => '村の主たるエネルギー源は、杉林の間伐材を燃料とするバイオマス熱電併給（CHP）システムです——24時間のベースロード電力（主たる出力）と熱（副次的な出力）を生み出します。太陽光とEV充電がこのバイオマスの中核を補完し、ガソリン車からの移行を進める住民・来訪者に対応します。|老朽化した農村の配電線は、停電リスクを年々高めています。間欠的な太陽光だけと異なり、現地のバイオマスCHPは24時間稼働し、停電時もデータセンターと重要施設の稼働を継続します。', 'tag' => 'Biomass CHP (primary) · Solar · EV charging · Blackout resilience' ],
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
				'section_img_rationale' => [
					'tab'     => 'rationale',
					'label'   => __( 'Section image (left column, beside heading)', 'mitsue' ),
					'type'    => 'image',
					'default' => '',
				],
				'rationale' => [
					'tab'     => 'rationale',
					'label'   => __( 'Rationale items', 'mitsue' ),
					'type'    => 'repeater',
					'columns' => [ 'n' => 'Eyebrow', 'title' => 'Title EN', 'jp' => 'Title JP', 'body' => 'Body EN', 'body_jp' => 'Body JP' ],
					'defaults' => [
						[ 'n' => '01 · ENERGY TRANSITION', 'title' => 'Distributed generation, not grid extension.',        'jp' => '分散型発電：系統依存からの脱却',    'body' => 'Japan targets 100% electrified new passenger-vehicle sales by 2035 — EVs, PHEVs and FCVs, not pure-EV. Rural regions need significant new distributed generation and charging capacity; grid extension is slow and capital-intensive. Japan\'s FY2024 CEV subsidies (up to ¥850,000 for an EV, ¥550,000 for a PHEV) now reward charging infrastructure and disaster resilience alongside vehicle performance.', 'body_jp' => '日本は2035年までに新車乗用車販売の100%を電動車（EV・PHEV・FCV）とすることを目標としています——純粋なEVだけではありません。農村部には相当規模の分散型発電・充電能力が必要であり、系統延伸は遅く資本集約的です。2024年度のCEV補助金（EV最大85万円、PHEV最大55万円）は、車両性能に加えて充電インフラや災害対応力も評価します。' ],
						[ 'n' => '02 · FOREST LIABILITY',  'title' => 'Aged cedar plantations as under-managed asset.',     'jp' => '放置された杉人工林の活用', 'body' => 'Aged sugi plantations impose ecological costs — pollen burden, biodiversity loss — and physical risks: landslide and fire. Active management converts liability into feedstock and timber revenue.', 'body_jp' => '老齢化した杉の人工林は、花粉被害・生物多様性の喪失といった生態的コストと、土砂崩れ・火災リスクをもたらします。適切な管理により、負の資産を燃料や木材収益へと転換できます。' ],
						[ 'n' => '03 · STRANDED ASSETS',   'title' => 'Closed schools as anchor facilities.',               'jp' => '廃校の利活用',         'body' => 'Closed schools currently impose net maintenance costs on shrinking municipal budgets. Productive reuse turns these into community-anchored facilities.', 'body_jp' => '廃校は現在、縮小する自治体予算に維持管理コストとして負担をかけています。有効活用することで、地域の拠点施設へと転換できます。' ],
						[ 'n' => '04 · DIGITAL DEFICIT',   'title' => 'Edge compute where the energy is.',                  'jp' => '農村部のデジタル基盤不足', 'body' => 'Rural broadband and edge-compute capacity continue to lag urban Japan. A small, energy-aligned data center addresses both the connectivity gap and the on-site computation gap at the same time.', 'body_jp' => '農村部のブロードバンドとエッジコンピューティング能力は、都市部に比べて依然として遅れています。エネルギーと連携した小規模データセンターが、接続性と演算能力の両方のギャップを同時に解消します。' ],
					],
				],

				/* ─── Endorsement ───────────────────────────────────── */
				'endorsements' => [
					'tab'     => 'endorsement',
					'label'   => __( 'Endorsements — add one row per person. Quote columns: wrap paragraphs in <p>…</p>, links allowed via <a href=”…”>.', 'mitsue' ),
					'type'    => 'repeater',
					'columns' => [
						'cite_name'    => 'Name',
						'cite_role_en' => 'Role / title (EN)',
						'cite_role_jp' => 'Role / title (JP)',
						'quote_en'     => 'Quote (EN)',
						'quote_jp'     => 'Quote (JP)',
					],
					'defaults' => [
						[
							'cite_name'    => 'Olivia Bina',
							'cite_role_en' => 'Co-author, “Transforming Knowledge Systems for Life on Earth”',
							'cite_role_jp' => '「地球上の生命のための知識システムの変革」共著者',
							'quote_en'     => '<p>This initiative is highly relevant and timely. It addresses both the past and present reality of rural depopulation and the socio-economic “impoverishment” — or “desertification”, as we call it in <a href=”https://ec.europa.eu/regional_policy/policy/what/investment-policy_en” target=”_blank” rel=”noopener”>European Cohesion Policy</a> — while also being forward-looking: engaging critically with the AI and digital economies, and confronting the global problem of monocultures and plantations that deplete biodiversity and erode resilient, thriving landscapes.</p><p>I see great relevance in such an idea — not least for the many EU countries that, like Japan, suffer from the ageing and depopulation of rural areas, with multiple negative social, ecological and economic impacts.</p><p>Re-imagining towns and villages is a wonderful and essential project. Combining ecological resilience (the replacement of cedar) with social (trust and revival), cultural (a new sense of place) and economic resilience is very promising.</p>',
							'quote_jp'     => '<p>この構想は非常に意義深く、時宜を得たものです。過去から現在に続く農村部の人口減少と、社会経済的な「困窮」——<a href=”https://ec.europa.eu/regional_policy/policy/what/investment-policy_en” target=”_blank” rel=”noopener”>欧州結束政策</a>で私たちが「砂漠化」と呼ぶ現象——に取り組むと同時に、未来志向でもあります。AI・デジタル経済を批判的に受け止め、生物多様性を枯渇させ、回復力ある豊かな景観を損なう単一栽培やプランテーションという世界的課題にも向き合っているからです。</p><p>このような発想には大きな意義があると感じます。とりわけ、日本と同様に農村部の高齢化と人口減少に直面し、社会・生態・経済の各面で複合的な負の影響を被っている多くのEU諸国にとって、その意義は小さくありません。</p><p>町や村を再構想することは、すばらしく、そして不可欠な取り組みです。生態的な回復力（杉の置き換え）を、社会的な回復力（信頼と再生）、文化的な回復力（新たな「場所」の感覚）、そして経済的な回復力と組み合わせる——これは非常に有望です。</p>',
						],
					],
				],

				/* ─── Timeline ──────────────────────────────────────── */
				'section_img_timeline' => [
					'tab'     => 'timeline',
					'label'   => __( 'Section image (left column, beside heading)', 'mitsue' ),
					'type'    => 'image',
					'default' => '',
				],
				'phases' => [
					'tab'     => 'timeline',
					'label'   => __( 'Timeline phases', 'mitsue' ),
					'type'    => 'repeater',
					'columns' => [ 'name' => 'Phase name', 'title' => 'Title EN', 'jp' => 'Title JP', 'months' => 'Months', 'note' => 'Note EN', 'note_jp' => 'Note JP', 'budget' => 'Budget', 'extra' => 'Extra note', 'current' => 'Current (1=yes)' ],
					'defaults' => [
						[ 'name' => 'Phase 0 — Current', 'title' => 'Pre-Foundation',  'jp' => '準備期',         'months' => 'Months 01 – 03', 'note' => 'Local trust-building, founding team, draft charter.', 'note_jp' => '地域との信頼構築、創設チーム形成、定款草案。', 'budget' => '¥0 – 0.5M',  'extra' => 'self-funded', 'current' => '1' ],
						[ 'name' => 'Phase 1',           'title' => 'Foundation',      'jp' => '基盤構築期',     'months' => 'Months 04 – 09', 'note' => 'Legal entity, feasibility studies, advisors.',       'note_jp' => '法人設立、実現可能性調査、顧問選定。',         'budget' => '¥3 – 8M',    'extra' => '', 'current' => '0' ],
						[ 'name' => 'Phase 2',           'title' => 'Pilot Design',    'jp' => 'パイロット設計期', 'months' => 'Months 10 – 18', 'note' => 'Engineering, partnerships, permits.',               'note_jp' => 'エンジニアリング、パートナーシップ、許認可。', 'budget' => '¥15 – 30M',  'extra' => '', 'current' => '0' ],
						[ 'name' => 'Phase 3',           'title' => 'Pilot Build',     'jp' => 'パイロット建設期', 'months' => 'Months 19 – 30', 'note' => 'First-stage construction, commissioning.',          'note_jp' => '第一期建設、竣工検査。',                       'budget' => '¥80 – 200M', 'extra' => '', 'current' => '0' ],
						[ 'name' => 'Phase 4',           'title' => 'Operate & Scale', 'jp' => '運営・拡張期',   'months' => 'Months 31 +',    'note' => 'Operations, monitoring, replication.',               'note_jp' => '運営、モニタリング、モデル普及。',             'budget' => 'Revenue-led', 'extra' => '', 'current' => '0' ],
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
				'section_img_governance' => [
					'tab'     => 'governance',
					'label'   => __( 'Section image (left column, beside heading)', 'mitsue' ),
					'type'    => 'image',
					'default' => '',
				],
				'founder_profiles' => [
					'tab'     => 'governance',
					'label'   => __( 'Founder profile cards', 'mitsue' ),
					'type'    => 'repeater',
					'columns' => [ 'initials' => 'Initials', 'name' => 'Full name', 'link' => 'Link URL', 'photo' => 'Photo', 'credit' => 'Bio EN', 'credit_jp' => 'Bio JP' ],
					'defaults' => [
						[ 'initials' => 'R.O.', 'name' => 'Rob Oudendijk', 'link' => 'https://about.me/robouden', 'credit' => 'Founder of the BIOMASS ENERGY & AI project. Founder of YR-Design, a design and technology studio based in the Netherlands, and a core contributor to Safecast — the open environmental monitoring network established after Fukushima. His work spans interaction design, hardware development, and open-source environmental data.', 'credit_jp' => 'バイオマスエネルギーとAI創業者。オランダを拠点とするデザイン・テクノロジースタジオ「YR-Design」の創設者であり、福島第一原発事故後に設立されたオープン環境モニタリングネットワーク「Safecast」のコア・コントリビューター。インタラクションデザイン・ハードウェア開発・オープンソース環境データの領域を横断して活動している。' ],
					],
				],
				'advisors' => [
					'tab'     => 'governance',
					'label'   => __( 'Advisory board members', 'mitsue' ),
					'type'    => 'repeater',
					'columns' => [ 'initials' => 'Initials', 'name' => 'Full name', 'link' => 'Link URL', 'photo' => 'Photo', 'credit' => 'Bio EN', 'credit_jp' => 'Bio JP' ],
					'defaults' => [
						[ 'initials' => 'R.O.', 'name' => 'Ray Ozzie', 'link' => 'https://en.wikipedia.org/wiki/Ray_Ozzie', 'credit' => 'Software pioneer; former Chief Software Architect at Microsoft. Decades of work on distributed systems, collaboration software, and the discipline of small, accountable platforms. Confirmed May 5, 2026.', 'credit_jp' => 'ソフトウェアの先駆者、マイクロソフト元チーフソフトウェアアーキテクト。分散システム・コラボレーションソフトウェア・小規模で説明責任を果たすプラットフォームの設計原則に数十年従事。2026年5月5日に顧問就任を承諾。' ],
						[ 'initials' => 'S.P.', 'name' => 'San Poisson',    'link' => '', 'credit' => 'Project Manager.', 'credit_jp' => 'プロジェクトマネージャー。' ],
						[ 'initials' => '·',    'name' => 'Advisor 4 — TBD', 'link' => '', 'credit' => 'To be confirmed.', 'credit_jp' => '確定待ち。' ],
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
				'section_img_funding' => [
					'tab'     => 'funding',
					'label'   => __( 'Section image (left column, beside heading)', 'mitsue' ),
					'type'    => 'image',
					'default' => '',
				],
				'funding_rows' => [
					'tab'     => 'funding',
					'label'   => __( 'Funding stack rows', 'mitsue' ),
					'type'    => 'repeater',
					'columns' => [ 'layer' => 'Layer', 'name' => 'Source name', 'desc' => 'Description EN', 'desc_jp' => 'Description JP', 'committed' => 'Target amount (unsecured — none raised/committed yet)' ],
					'defaults' => [
						[ 'layer' => 'L1', 'name' => 'Founder / private capital', 'desc' => 'Self-funded ramp; founder commitments',                                    'desc_jp' => '自己資金による立ち上げ；創業者コミットメント',                   'committed' => '¥6M' ],
						[ 'layer' => 'L2', 'name' => 'Government grants',          'desc' => 'NEDO · METI · Nara Prefecture · Mitsue Village',                          'desc_jp' => 'NEDO・経済産業省・奈良県・御杖村',                               'committed' => '¥115M' ],
						[ 'layer' => 'L3', 'name' => 'Foundations',                'desc' => 'Nippon Foundation · Japan Fund for Global Environment · Toyota Foundation', 'desc_jp' => '日本財団・地球環境基金・トヨタ財団',                             'committed' => '¥33M' ],
						[ 'layer' => 'L4', 'name' => 'Corporate partnerships',     'desc' => 'Dutch and Japanese corporates; CSR-aligned',                              'desc_jp' => 'オランダ・日本の企業；CSR連携',                                  'committed' => '¥35M' ],
						[ 'layer' => 'L5', 'name' => 'Operating revenue',          'desc' => 'Hosting fees · FIT/FIP · EV charging · J-Credits',                    'desc_jp' => 'ホスティング料金・FIT/FIP・EV充電料金・Jクレジット',            'committed' => '¥3M' ],
					],
				],
				'funding_total_committed' => [
					'tab'     => 'funding',
					'label'   => __( 'Total — Funding Target (unsecured; ¥0 raised/committed)', 'mitsue' ),
					'type'    => 'text',
					'default' => '¥192M',
				],
				'funding_bac' => [
					'tab'     => 'funding',
					'label'   => __( 'BAC (project budget baseline)', 'mitsue' ),
					'type'    => 'text',
					'default' => '¥220M',
				],
				'funding_total_budget' => [
					'tab'     => 'funding',
					'label'   => __( 'Total project budget (incl. reserve)', 'mitsue' ),
					'type'    => 'text',
					'default' => '¥245M',
				],

				/* ─── Principles ────────────────────────────────────── */
				'section_img_principles' => [
					'tab'     => 'principles',
					'label'   => __( 'Section image (left column, beside heading)', 'mitsue' ),
					'type'    => 'image',
					'default' => '',
				],
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
				'section_img_status' => [
					'tab'     => 'status',
					'label'   => __( 'Section image (left column, beside heading)', 'mitsue' ),
					'type'    => 'image',
					'default' => '',
				],
				'status_completed' => [
					'tab'     => 'status',
					'label'   => __( 'Completed items', 'mitsue' ),
					'type'    => 'repeater',
					'columns' => [ 't' => 'Item text EN', 't_jp' => 'Item text JP' ],
					'defaults' => [
						[ 't' => 'Initial meeting with Vice Mayor of Mitsue (late 2025)',        't_jp' => '御杖村副村長との初回面談（2025年末）' ],
						[ 't' => 'Initial meeting with the local forestry group (early 2026)',   't_jp' => '地域林業グループとの初回面談（2026年初頭）' ],
						[ 't' => 'Drafted founding charter and detailed implementation plan',     't_jp' => '設立定款・詳細実施計画の草案作成' ],
						[ 't' => 'Phase &amp; funding-gate flowchart published',                 't_jp' => 'フェーズ・資金ゲートフローチャートの公開' ],
						[ 't' => 'Advisory commitment: Ray Ozzie',                              't_jp' => '顧問就任の確約：レイ・オジー' ],
					],
				],
				'status_progress' => [
					'tab'     => 'status',
					'label'   => __( 'In-progress items', 'mitsue' ),
					'type'    => 'repeater',
					'columns' => [ 't' => 'Item text EN', 't_jp' => 'Item text JP' ],
					'defaults' => [
						[ 't' => 'Identifying a Japanese co-founder with rural credibility', 't_jp' => '農村に信頼のある日本人共同創業者の選定' ],
						[ 't' => 'Scheduling a formal meeting with the Village Mayor',       't_jp' => '村長との正式面談の調整' ],
						[ 't' => 'Drafting bylaws for a 一般社団法人',                      't_jp' => '一般社団法人の定款草案の作成' ],
						[ 't' => 'Engaging a 行政書士 (administrative scrivener) in Nara',  't_jp' => '奈良県内の行政書士との協議' ],
					],
				],
				'status_next' => [
					'tab'     => 'status',
					'label'   => __( 'Next 30 days', 'mitsue' ),
					'type'    => 'repeater',
					'columns' => [ 't' => 'Item text EN', 't_jp' => 'Item text JP' ],
					'defaults' => [
						[ 't' => 'Approach candidate Japanese co-founder',                    't_jp' => '候補となる日本人共同創業者へのアプローチ' ],
						[ 't' => 'Hold informal meeting with the Village Mayor',              't_jp' => '村長との非公式面談の実施' ],
						[ 't' => 'Initial consultations with administrative scriveners',      't_jp' => '行政書士との初回相談' ],
						[ 't' => 'Finalise a two-page bilingual charter for distribution',   't_jp' => '配布用二ページ二言語版定款の最終化' ],
					],
				],

				/* ─── Join Page (/join) ─────────────────────────────── */
				'join_eyebrow' => [
					'tab'     => 'join',
					'label'   => __( 'Eyebrow text', 'mitsue' ),
					'type'    => 'text',
					'default' => 'Get involved · 御杖くんプロジェクト × 御杖村森林組合',
				],
				'join_headline_en' => [
					'tab'     => 'join',
					'label'   => __( 'Headline (EN) — wrap accent words in <em>…</em>', 'mitsue' ),
					'type'    => 'textarea',
					'default' => 'Rewild a mountain, power an AI data center, <em>and rebuild a village.</em>',
				],
				'join_headline_jp' => [
					'tab'     => 'join',
					'label'   => __( 'Headline (JP)', 'mitsue' ),
					'type'    => 'text',
					'default' => '山を再生し、AIデータセンターを動かし、村を再建する。',
				],
				'join_lede_en' => [
					'tab'     => 'join',
					'label'   => __( 'Intro paragraph (EN)', 'mitsue' ),
					'type'    => 'textarea',
					'default' => 'One place, one 25-year story — reforest a mountain, power a community-owned data center, and revive a village. Whether you want to work, invest, advise, or partner, there is a way in.',
				],
				'join_lede_jp' => [
					'tab'     => 'join',
					'label'   => __( 'Intro paragraph (JP)', 'mitsue' ),
					'type'    => 'textarea',
					'default' => 'ひとつの場所、25年の物語——山を再生し、地域所有のデータセンターを動かし、村を蘇らせる。働く・出資する・助言する・連携する、どの形でも参加の入り口があります。',
				],
				'join_ways' => [
					'tab'     => 'join',
					'label'   => __( 'Ways to get involved — chooser cards', 'mitsue' ),
					'type'    => 'repeater',
					'columns' => [ 'label_en' => 'Label EN', 'label_jp' => 'Label JP', 'sub' => 'One-liner EN', 'sub_jp' => 'One-liner JP', 'anchor' => 'Anchor (#work etc.)' ],
					'defaults' => [
						[ 'label_en' => '🌲 Work', 'label_jp' => '働く', 'sub' => 'Paid roles at the forestry co-op — forest, energy, data.', 'sub_jp' => '森林組合の有給職——森・エネルギー・データ。', 'anchor' => '#work' ],
						[ 'label_en' => '◆ Invest', 'label_jp' => '出資する', 'sub' => 'Patient capital for a 25-year, non-profit build.', 'sub_jp' => '25年・非営利の事業への長期資本。', 'anchor' => '#invest' ],
						[ 'label_en' => '✎ Advise', 'label_jp' => '助言する', 'sub' => 'Expertise in forestry, energy, compute, or governance.', 'sub_jp' => '林業・エネルギー・計算・ガバナンスの知見。', 'anchor' => '#advise' ],
						[ 'label_en' => '⌂ Partner', 'label_jp' => '連携する', 'sub' => 'Companies, NGOs, landowners, and volunteers.', 'sub_jp' => '企業・NGO・土地所有者・ボランティア。', 'anchor' => '#partner' ],
					],
				],
				'join_pillars' => [
					'tab'     => 'join',
					'label'   => __( 'The Work — three pillars', 'mitsue' ),
					'type'    => 'repeater',
					'columns' => [ 'num' => 'Numeral', 'title_en' => 'Title EN', 'title_jp' => 'Title JP', 'body' => 'Body EN (paragraphs with |)', 'body_jp' => 'Body JP (paragraphs with |)', 'tag' => 'Footer tag' ],
					'defaults' => [
						[ 'num' => '🌱 01', 'title_en' => 'Reforest', 'title_jp' => '再生 · 生きた在来林を取り戻す', 'body' => "Not \"cut trees\" — the opposite. Convert dark, lifeless sugi monoculture into living native broadleaf forest: oak and konara for wildlife forage, returning birds, insects and balance, protecting watersheds and reducing landslide risk.|A multi-decade legacy you can walk through — the forest our ancestors planted for timber, remade into the forest we leave our descendants.", 'body_jp' => "「木を切る」のではなくその逆。暗く生命の乏しい杉一斉林を、生きた在来広葉樹林へ転換します。コナラ・クヌギで野生動物の餌を確保し、鳥や昆虫、生態系の均衡を取り戻し、水源を守り土砂災害リスクを下げます。|実際に歩いて確かめられる数十年の遺産——先人が木材のために植えた森を、子孫に遺す森へ。", 'tag' => 'For ecologists & conservationists' ],
						[ 'num' => '⚡ 02', 'title_en' => 'Power', 'title_jp' => '動力 · エネルギーと村営データセンター', 'body' => "The same forest work literally powers computation — biomass CHP, salt-battery storage, and a village-owned AI data center. Frontier technology, not analog forestry.|You can stand in the forest you replanted and point at the servers it runs.", 'body_jp' => "同じ森の仕事が、計算資源を文字どおり動かします——バイオマスCHP、ソルトバッテリー蓄熱、村営AIデータセンター。アナログな林業ではなく、最先端の技術です。|自分が植え直した森に立ち、それが動かすサーバーを指さすことができます。", 'tag' => 'For technologists & engineers' ],
						[ 'num' => '🏡 03', 'title_en' => 'Revive', 'title_jp' => '再建 · 未来のある村を取り戻す', 'body' => "A depopulating mountain village given a genuine next chapter — jobs, families, energy self-sufficiency, disaster resilience. Rural life with a future, not nostalgia.", 'body_jp' => "過疎の山村に本物の次章を——雇用、家族、エネルギー自給、防災。郷愁ではなく、未来のある地方生活です。", 'tag' => 'For U/I-turn returnees & families' ],
					],
				],
				'join_work_intro_en' => [
					'tab'     => 'join',
					'label'   => __( 'The Work — subheading (EN)', 'mitsue' ),
					'type'    => 'text',
					'default' => 'Most rural jobs offer one thread. This offers all three, woven together — and each pillar draws a different kind of person.',
				],
				'join_work_intro_jp' => [
					'tab'     => 'join',
					'label'   => __( 'The Work — subheading (JP)', 'mitsue' ),
					'type'    => 'text',
					'default' => '多くの地方の仕事は1本の糸しか提供しません。これは3本を編み合わせて提供します——各柱が異なる層に届きます。',
				],
				'join_stack' => [
					'tab'     => 'join',
					'label'   => __( 'Support — subsidy stack rows', 'mitsue' ),
					'type'    => 'repeater',
					'columns' => [ 'scheme' => 'Scheme', 'who' => 'Funder → recipient', 'val' => 'Value EN', 'val_jp' => 'Value JP' ],
					'defaults' => [
						[ 'scheme' => '緑の雇用 (Green Employment)', 'who' => '林野庁 → the co-op', 'val' => 'Wage + ~3-yr OJT training subsidy for new forestry recruits', 'val_jp' => '新規就業者の人件費＋約3年のOJT研修助成' ],
						[ 'scheme' => '地域おこし協力隊', 'who' => '総務省 → via 御杖村', 'val' => '~¥5.2M/yr (salary + activity), up to 3 yrs, + up to ¥1M startup grant', 'val_jp' => '報償費＋活動費 約520万円/年、最長3年、＋起業支援最大100万円' ],
						[ 'scheme' => '移住支援金 (Relocation grant)', 'who' => '国 + 県 + 町 → you', 'val' => 'Household up to ¥1M + up to ¥1M per child; single ¥0.6M', 'val_jp' => '世帯 最大100万円＋子1人最大100万円／単身60万円' ],
						[ 'scheme' => '空き家バンク + housing', 'who' => '御杖村', 'val' => 'Vacant-house match + renovation support', 'val_jp' => '空き家マッチング＋改修支援' ],
					],
				],
				'join_stack_note_en' => [
					'tab'     => 'join',
					'label'   => __( 'Support — closing line (EN)', 'mitsue' ),
					'type'    => 'text',
					'default' => 'The grants get you to parity. The mission is the reason to come — and the reason to stay.',
				],
				'join_stack_note_jp' => [
					'tab'     => 'join',
					'label'   => __( 'Support — closing line (JP)', 'mitsue' ),
					'type'    => 'text',
					'default' => '補助金は「並び」に到達させ、使命こそが来る理由、そして留まる理由です。',
				],
				'join_cta_head_en' => [
					'tab'     => 'join',
					'label'   => __( 'Closing CTA — heading (EN)', 'mitsue' ),
					'type'    => 'text',
					'default' => 'Want to build this with us?',
				],
				'join_cta_head_jp' => [
					'tab'     => 'join',
					'label'   => __( 'Closing CTA — heading (JP)', 'mitsue' ),
					'type'    => 'text',
					'default' => '一緒に築きませんか？',
				],
				'join_cta_body_en' => [
					'tab'     => 'join',
					'label'   => __( 'Closing CTA — body (EN)', 'mitsue' ),
					'type'    => 'textarea',
					'default' => "Tell us which pillar pulls you — forest, energy, or village — and where you're coming from. No forestry experience required; curiosity and commitment matter more.",
				],
				'join_cta_body_jp' => [
					'tab'     => 'join',
					'label'   => __( 'Closing CTA — body (JP)', 'mitsue' ),
					'type'    => 'textarea',
					'default' => 'どの柱に惹かれるか（森・エネルギー・村）と、今どちらにお住まいかをお知らせください。林業経験は不問です。好奇心と覚悟を重視します。',
				],
				'join_sections' => [
					'tab'     => 'join',
					'label'   => __( 'Other ways — Invest / Advise / Partner blocks', 'mitsue' ),
					'type'    => 'repeater',
					'columns' => [ 'id' => 'Anchor id (invest…)', 'num' => 'Section №', 'label' => 'Kicker label', 'title_en' => 'Title EN (<em> ok)', 'title_jp' => 'Title JP', 'body' => 'Body EN', 'body_jp' => 'Body JP', 'cta' => 'Button label (opt.)', 'href' => 'Button URL (opt.)' ],
					'defaults' => [
						[ 'id' => 'invest', 'num' => '§ 03', 'label' => 'Invest', 'title_en' => 'Patient capital for a <em>25-year</em> build.', 'title_jp' => '25年の事業への長期資本。', 'body' => 'The project is a non-profit (一般社団法人 → NPO) with a transparent, published budget and funding gates. We are assembling patient capital across a five-layer stack — founder, grants, foundations, corporate partnerships, and operating revenue. If your horizon matches ours, we welcome the conversation.', 'body_jp' => '本事業は非営利（一般社団法人→NPO法人）であり、公開された予算と資金ゲートを持ちます。創業者・補助金・財団・企業連携・事業収益の五層構造で長期資本を組成しています。時間軸が一致するなら、ぜひご相談ください。', 'cta' => 'For investors', 'href' => '/#funding' ],
						[ 'id' => 'advise', 'num' => '§ 04', 'label' => 'Advise', 'title_en' => 'Lend your <em>expertise.</em>', 'title_jp' => '知見を貸してください。', 'body' => 'We are building an advisory board across forestry, distributed energy, edge compute, rural governance, and Japanese non-profit law. Advisors give occasional, high-leverage guidance — not day-to-day work. (Ray Ozzie confirmed, 2026.)', 'body_jp' => '林業・分散型エネルギー・エッジコンピュート・農村ガバナンス・日本の非営利法にわたる顧問会を組成しています。顧問は日常業務ではなく、要所での助言をお願いするものです。（レイ・オジー就任確約、2026年）', 'cta' => '', 'href' => '' ],
						[ 'id' => 'partner', 'num' => '§ 05', 'label' => 'Partner', 'title_en' => 'Companies, NGOs, landowners &amp; <em>volunteers.</em>', 'title_jp' => '企業・NGO・土地所有者・ボランティア。', 'body' => 'Corporate partners (CSR-aligned), reforestation and J-Credit NGOs, forest landowners, and volunteers for tree-survey and eco-tourism activities. There are many ways to contribute time, land, or capability without relocating.', 'body_jp' => '企業パートナー（CSR連携）、再植林・JクレジットのNGO、森林所有者、そして樹木調査・エコツーリズム活動のボランティア。移住せずとも、時間・土地・能力で貢献する方法が数多くあります。', 'cta' => '', 'href' => '' ],
					],
				],
				'join_email' => [
					'tab'     => 'join',
					'label'   => __( 'Contact email (falls back to CTA email if blank)', 'mitsue' ),
					'type'    => 'email',
					'default' => '',
				],

				/* ─── CTA ───────────────────────────────────────────── */
				'cta_intro_en' => [
					'tab'     => 'cta',
					'label'   => __( 'Intro paragraph (EN)', 'mitsue' ),
					'type'    => 'textarea',
					'default' => "The project is currently in pre-foundation phase. We're identifying patient capital, advisory partners, and Japanese co-founders with rural credibility. If your time horizon matches ours, we would welcome the conversation.",
				],
				'cta_intro_jp' => [
					'tab'     => 'cta',
					'label'   => __( 'Intro paragraph (JP)', 'mitsue' ),
					'type'    => 'textarea',
					'default' => 'プロジェクトは現在、設立準備段階にあります。長期的視点を持つ出資者、助言パートナー、農村に信頼のある日本人共同創業者を探しています。時間軸が一致すると感じていただけるなら、ぜひご連絡ください。',
				],
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
				'cta_repo_url' => [
					'tab'     => 'cta',
					'label'   => __( 'Document repository URL', 'mitsue' ),
					'type'    => 'url',
					'default' => '#',
				],
				'cta_repo_label' => [
					'tab'     => 'cta',
					'label'   => __( 'Document repository label EN (link text)', 'mitsue' ),
					'type'    => 'text',
					'default' => 'codeberg.org / YR-Design',
				],
				'cta_repo_label_jp' => [
					'tab'     => 'cta',
					'label'   => __( 'Document repository label JP (link text)', 'mitsue' ),
					'type'    => 'text',
					'default' => 'codeberg.org / YR-Design',
				],
				'cta_repo_desc' => [
					'tab'     => 'cta',
					'label'   => __( 'Document repository description EN', 'mitsue' ),
					'type'    => 'text',
					'default' => 'Founding charter · implementation plan · stakeholder map · finance workbook',
				],
				'cta_repo_desc_jp' => [
					'tab'     => 'cta',
					'label'   => __( 'Document repository description JP', 'mitsue' ),
					'type'    => 'text',
					'default' => '設立定款・実施計画・ステークホルダーマップ・財務ワークブック',
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
				'cta_flowchart_url' => [
					'tab'     => 'cta',
					'label'   => __( 'Phase & funding flowchart URL', 'mitsue' ),
					'type'    => 'url',
					'default' => 'https://codeberg.org/YR-Design/mitsue-ai-data-center/raw/branch/main/mitsue_phases_funding_flowchart.pdf',
				],
				'cta_stakeholder_url' => [
					'tab'     => 'cta',
					'label'   => __( 'Stakeholder map URL', 'mitsue' ),
					'type'    => 'url',
					'default' => 'https://codeberg.org/YR-Design/mitsue-ai-data-center/raw/branch/main/mitsue_stakeholders.pdf',
				],
				'cta_finance_url' => [
					'tab'     => 'cta',
					'label'   => __( 'Finance workbook URL', 'mitsue' ),
					'type'    => 'url',
					'default' => 'https://codeberg.org/YR-Design/mitsue-ai-data-center/raw/branch/main/mitsue_finance.xlsx',
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
				'endorsement'=> __( 'Endorsement','mitsue' ),
				'timeline'   => __( 'Timeline',   'mitsue' ),
				'governance' => __( 'Governance', 'mitsue' ),
				'funding'    => __( 'Funding',    'mitsue' ),
				'principles' => __( 'Principles', 'mitsue' ),
				'status'     => __( 'Status',     'mitsue' ),
				'cta'        => __( 'CTA',        'mitsue' ),
				'join'       => __( 'Join Page',  'mitsue' ),
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
			$long_cols  = [ 'body', 'body_jp', 'credit', 'credit_jp', 'desc', 'desc_jp', 't', 't_jp', 'note', 'note_jp', 'sub', 'sub_jp', 'quote_en', 'quote_jp' ];
			$photo_cols = [ 'photo', 'img', 'image_url' ];
			echo '<tr>';
			foreach ( $col_keys as $col ) {
				$val  = $row[ $col ] ?? '';
				$name = sprintf( '%s[%s][%s]', $name_base, $idx, $col );
				echo '<td>';
				if ( in_array( $col, $photo_cols, true ) ) {
					echo '<div class="mitsue-image-field">';
					printf( '<input type="url" name="%s" value="%s" class="widefat" placeholder="https://" />', esc_attr( $name ), esc_attr( $val ) );
					echo '<button type="button" class="button mitsue-media-pick-row" style="margin-top:4px;">' . esc_html__( 'Choose photo from Media Library', 'mitsue' ) . '</button>';
					if ( $val ) {
						printf( '<img class="mitsue-img-preview" src="%s" style="margin-top:6px;max-width:80px;display:block;" />', esc_url( $val ) );
					} else {
						echo '<img class="mitsue-img-preview" src="" style="margin-top:6px;max-width:80px;display:none;" />';
					}
					echo '</div>';
				} elseif ( in_array( $col, $long_cols, true ) ) {
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
