<?php
$pillars = mitsue_rows('pillars', [
  ['num'=>'i',   'title_en'=>'Forest Restoration',    'title_jp'=>'森林再生 · Native broadleaf', 'body'=>"Phased replacement of aged sugi (cedar) plantations with native broadleaf species, with private landowners, the Forestry Agency (林野庁), and local contractors. Liability becomes timber revenue; the sugi thinnings are the fuel for the village's biomass CHP — the project's primary energy source.|The 25-year arc aligns to the ecological clock, not the funding cycle.|Native broadleaf trees — oak, chestnut, and konara — produce acorns and nuts that sustain deer, wild boar, and bear through winter. When the forest feeds them, they stay in the forest. Restoring broadleaf cover directly reduces wildlife raids on surrounding crop areas.", 'body_jp'=>'老齢化した杉の人工林を、私有林所有者・林野庁・地元事業者と連携しながら、段階的に在来広葉樹へと置き換えます。負債は用材収益へと転換し、杉の間伐材はプロジェクトの主たるエネルギー源である村のバイオマスCHPの燃料となります。|25年という時間軸は、資金サイクルではなく森林の生態的時計に合わせています。|在来広葉樹——コナラ・クリ・ミズナラなど——はドングリや木の実を実らせ、シカ・イノシシ・クマの冬の食料源となります。森が動物を養うことができれば、動物は農地に下りてきません。広葉樹林の回復は、周辺農地への野生動物被害を直接減らします。', 'tag'=>'Sugi → Broadleaf · 25-year cycle · Wildlife balance'],
  ['num'=>'ii',  'title_en'=>'Biomass CHP & Energy Resilience', 'title_jp'=>'バイオマスCHP・エネルギーレジリエンス · 太陽光・EV充電', 'body'=>'The village\'s primary energy source is a biomass combined heat and power (CHP) system fuelled by sugi forest thinnings — generating 24/7 baseload electricity (primary output) and heat (secondary output). Forest thinning creates paid local labor and a steady village income stream, while the same thinnings become the fuel: the forest powers the village. Solar and EV charging complement this biomass core, serving residents and visitors making the transition away from petrol.|Aging rural distribution lines make blackouts a real and growing risk. Unlike intermittent solar alone, the on-site biomass CHP runs round the clock, keeping the data center and critical facilities running through grid outages — community blackout resilience built in.|One integrated energy system: biomass CHP as the baseload primary, with privately owned solar and EV charging complementary. This also advances Mitsue Village\'s official Renewable Energy Plan (2025), delivering its "one resilient site" and EV-charging priority.', 'body_jp'=>'村の主たるエネルギー源は、杉林の間伐材を燃料とするバイオマス熱電併給（CHP）システムです——24時間のベースロード電力（主たる出力）と熱（副次的な出力）を生み出します。森林の間伐作業は地元の雇用と安定した村の収入源を生み、その間伐材がそのまま燃料となります——森が村を動かします。太陽光とEV充電がこのバイオマスの中核を補完し、ガソリン車からの移行を進める住民・来訪者に対応します。|老朽化した農村の配電線は、停電リスクを年々高めています。間欠的な太陽光だけと異なり、現地のバイオマスCHPは24時間稼働し、停電時もデータセンターと重要施設の稼働を継続します——コミュニティの停電対策として機能します。|一体化されたエネルギーシステム：バイオマスCHPを主たるベースロード電源とし、個人所有の太陽光とEV充電が補完します。これは御杖村の公式再エネ計画（2025年）の実行でもあり、計画の「レジリエント1拠点」とEV充電優先を実現します。', 'tag'=>'Biomass CHP (primary) · Solar · EV charging · Blackout resilience'],
  ['num'=>'iii', 'title_en'=>'Community Data Center', 'title_jp'=>'地域所有データセンター · Edge-scale', 'body'=>'The former Sugano Elementary School (Mitsue Taiken Koryukan / 体験交流館) — the leading candidate — or a disused village factory building — the alternative candidate; final site confirmed in Phase 1 — repurposed as a small-scale, energy-efficient edge-compute facility powered entirely by locally generated renewable energy.|Sized for accountability and community ownership — not hyperscale economics. Designed to be replicated by other depopulating municipalities.|Because the compute is village-owned, the model reserves a share for the community — free for residents, schools, and the forestry co-op — with locals able to propose their own projects: local mapping, environmental monitoring, learning tools. Who uses the data center — residents and outside tenants alike — is published openly, so the village can always see how its own resource is used.|By building a community-owned AI data center powered by locally generated renewable energy — biomass CHP and solar — Mitsue sets a working example of how rural communities can integrate technological progress with ecological sustainability. Not as opposites, but as a single coherent system. A model built to be copied.', 'body_jp'=>'旧菅野小学校（御杖体験交流館）――有力候補――または村内の空き工場――代替候補（最終選定は第1段階で確定）――を、地域で発電した再生可能エネルギーのみで稼働する小規模・省エネ型エッジコンピュート施設として活用します。|ハイパースケール経済ではなく、説明責任と地域所有のための規模。過疎に悩む他の自治体が複製できるモデルとして設計されています。|演算資源を地域が所有するからこそ、その一部を地域のために確保する設計です――住民・学校・森林組合には無償で開放し、住民は自らのプロジェクト（地域の地図作成・環境モニタリング・学習ツールなど）を提案できます。データセンターの利用者は、住民も外部の利用者も含めて公開され、村は自らの資源の使われ方を常に確認できます。|地域が所有し、バイオマスCHPと太陽光という地元の再生可能エネルギーで稼働するAIデータセンターを構築することで、御杖は農村コミュニティが技術の進歩と生態系の持続可能性をどう統合できるかを示す実証モデルとなります。両者は対立するものではなく、一つの整合したシステムです。複製されることを前提に設計されたモデルです。', 'tag'=>'Edge compute · Free community access · Transparent tenants · Replicable'],
]);
?>
<section id="programme">
  <div class="wrap">
    <div class="section-head">
      <div class="num">§ 01<span class="label">Programme</span>
        <?php $si = mitsue_get('section_img_programme'); if ($si): ?><img src="<?php echo esc_url($si); ?>" alt="Three integrated programme activities" class="section-img"><?php endif; ?>
      </div>
      <div>
        <h2>Three integrated activities, <em>one coordinating body.</em></h2>
        <div class="h2-jp jp">三つの活動を、一つの運営体で。</div>
        <div class="h2-sub body-en">Forest restoration, locally generated renewable energy, and a small-scale community-owned data center — each reinforces the other and shares a common 25-year ledger of methods, data, and outcomes.</div>
        <div class="h2-sub body-jp jp">森林再生・地域発電・小規模地域所有データセンター——それぞれが互いを強化し合い、手法・データ・成果を共有する25年の台帳によって結ばれています。</div>
      </div>
    </div>

    <div class="pillars">
      <?php foreach ($pillars as $p): ?>
        <div class="pillar">
          <div class="num"><?php echo esc_html($p['num']); ?></div>
          <h3><?php echo esc_html($p['title_en']); ?></h3>
          <div class="h3-jp jp"><?php echo esc_html($p['title_jp']); ?></div>
          <div class="body-en">
            <?php foreach (explode('|', $p['body'] ?? '') as $para): ?>
              <p><?php echo wp_kses_post($para); ?></p>
            <?php endforeach; ?>
          </div>
          <?php if (!empty($p['body_jp'])): ?>
          <div class="body-jp jp">
            <?php foreach (explode('|', $p['body_jp']) as $para): ?>
              <p><?php echo wp_kses_post($para); ?></p>
            <?php endforeach; ?>
          </div>
          <?php endif; ?>
          <div class="tag"><?php echo esc_html($p['tag']); ?></div>
        </div>
      <?php endforeach; ?>
    </div>

    <div style="display:grid;grid-template-columns:1fr 1fr;border-top:1px solid var(--rule);">
      <div style="padding:36px 36px 0 0;border-right:1px solid var(--rule);">
        <div class="mono" style="color:var(--ink-mute);margin-bottom:14px;">§ 01.4 · Clean Energy Vehicle Charging</div>
        <h4 style="font-family:var(--serif-en);font-weight:500;font-size:22px;margin:0 0 8px;">
          <span class="body-en">Distributed charging anchored to local generation</span>
          <span class="body-jp jp">地域発電と連動した分散型クリーンエネルギー自動車充電</span>
        </h4>
        <p style="color:var(--ink-soft);font-size:15px;line-height:1.7;">
          <span class="body-en">Charging infrastructure for residents and visitors, tied to on-site generation rather than waiting on capital-intensive grid extension. We build multiple, higher-powered outlets serving the full range of clean energy vehicles — EVs, PHEVs and FCVs — and equip them with external power outlets so vehicles can support the community during disasters. This follows Japan's goal of 100% electrified new passenger-vehicle sales by 2035 and the upgraded FY2024 CEV subsidy scheme (up to ¥850,000 for an EV, ¥550,000 for a PHEV or light EV), which now rewards charging infrastructure and disaster resilience alongside vehicle performance.</span>
          <span class="body-jp jp">居住者と来訪者向けの充電インフラを、資本集約的な系統延伸を待つのではなく、現地発電と連動して整備します。EV・PHEV・FCVといった多様なクリーンエネルギー自動車に対応する複数の高出力充電口を設け、災害時に車両が地域へ電力を供給できるよう外部給電機能も備えます。これは、2035年までに新車乗用車販売の100％を電動車とする日本の目標と、車両性能に加えて充電インフラや災害対応力を評価するよう刷新された2024年度のCEV補助金（EV最大85万円、PHEV・軽EV最大55万円）に沿うものです。</span>
        </p>
      </div>
      <div style="padding:36px 0 0 36px;">
        <div class="mono" style="color:var(--ink-mute);margin-bottom:14px;">§ 01.5 · Open Knowledge</div>
        <h4 style="font-family:var(--serif-en);font-weight:500;font-size:22px;margin:0 0 8px;">
          <span class="body-en">Documentation as a deliverable</span>
          <span class="body-jp jp">文書化を成果物として</span>
        </h4>
        <p style="color:var(--ink-soft);font-size:15px;line-height:1.7;">
          <span class="body-en">All methods, environmental data, financial records, and lessons learned are published under permissive open licences — Creative Commons for documents, appropriate open licences for data and code — so other communities may adapt the model.</span>
          <span class="body-jp jp">手法・環境データ・財務記録・学んだ教訓はすべて、オープンライセンス（文書はクリエイティブ・コモンズ、データ・コードは適切なオープンライセンス）のもとで公開します。他のコミュニティがモデルを適用できるようにするためです。</span>
        </p>
      </div>
    </div>
  </div>
</section>
