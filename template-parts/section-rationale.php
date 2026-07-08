<?php
$items = mitsue_rows('rationale', [
  ['n'=>'01 · ENERGY TRANSITION','title'=>'Distributed generation, not grid extension.',       'jp'=>'分散型発電：系統依存からの脱却',    'body'=>'Japan targets 100% electrified new passenger-vehicle sales by 2035 — EVs, PHEVs and FCVs, not pure-EV. Rural regions need significant new distributed generation and charging capacity; grid extension is slow and capital-intensive. Japan\'s FY2024 CEV subsidies (up to ¥850,000 for an EV, ¥550,000 for a PHEV) now reward charging infrastructure and disaster resilience alongside vehicle performance.','body_jp'=>'日本は2035年までに新車乗用車販売の100%を電動車（EV・PHEV・FCV）とすることを目標としています——純粋なEVだけではありません。農村部には相当規模の分散型発電・充電能力が必要であり、系統延伸は遅く資本集約的です。2024年度のCEV補助金（EV最大85万円、PHEV最大55万円）は、車両性能に加えて充電インフラや災害対応力も評価します。'],
  ['n'=>'02 · FOREST LIABILITY', 'title'=>'Aged cedar plantations as under-managed asset.',    'jp'=>'放置された杉人工林の活用','body'=>'Aged sugi plantations impose ecological costs — pollen burden, biodiversity loss — and physical risks: landslide and fire. Active management converts liability into timber revenue; the sugi thinnings are the fuel for the village\'s biomass CHP, the project\'s primary energy source — generating round-the-clock baseload electricity and heat.','body_jp'=>'老齢化した杉の人工林は、花粉被害・生物多様性の喪失といった生態的コストと、土砂崩れ・火災リスクをもたらします。適切な管理により負の資産を木材収益へ転換し、杉の間伐材はプロジェクトの主たるエネルギー源である村のバイオマスCHPの燃料となります——24時間のベースロード電力と熱を生み出します。'],
  ['n'=>'03 · STRANDED ASSETS',  'title'=>'Available community facilities as anchor sites.',   'jp'=>'遊休公共施設の活用',    'body'=>'Underused former schools and community facilities — such as a small vacant school building or a disused village factory — currently impose net maintenance costs on shrinking municipal budgets. Productive reuse turns these into community-anchored facilities — the data center inherits a building, a community, and a story.','body_jp'=>'小規模な空き校舎や廃工場などの遊休公共施設は現在、縮小する自治体予算に維持管理コストとして負担をかけています。有効活用することで、地域の拠点施設へと転換できます。'],
  ['n'=>'04 · DIGITAL DEFICIT',  'title'=>'Edge compute where the energy is.',                'jp'=>'農村部のデジタル基盤不足','body'=>'Rural broadband and edge-compute capacity continue to lag urban Japan. A small, energy-aligned data center addresses both the connectivity gap and the on-site computation gap at the same time.','body_jp'=>'農村部のブロードバンドとエッジコンピューティング能力は、都市部に比べて依然として遅れています。エネルギーと連携した小規模データセンターが、接続性と演算能力の両方のギャップを同時に解消します。'],
  ['n'=>'05 · POLICY ALIGNMENT', 'title'=>'Delivering the village\'s own RE plan.',          'jp'=>'村の再エネ計画の実行','body'=>'The project is the implementation vehicle for Mitsue Village\'s official, Ministry-of-Environment-funded Renewable Energy Plan (2025). It delivers the plan\'s "one resilient distributed-energy site" target (currently zero) and its EV-charging priority — and unlocks the village-led 地域脱炭素移行・再エネ推進交付金 (a 2/3–3/4 subsidy on solar/battery/EV, paid through the village).','body_jp'=>'本プロジェクトは、環境省補助で策定された御杖村の公式再エネ計画（2025年）の実行を担う事業体です。計画が掲げる「レジリエントな分散型電源1拠点」目標（現状ゼロ）とEV充電優先を実現し、村主導の地域脱炭素移行・再エネ推進交付金（太陽光・蓄電池・EVの補助率2/3〜3/4、村経由）を引き出します。'],
]);
?>
<section>
  <div class="wrap">
    <div class="section-head">
      <div class="num">§ 02<span class="label">Rationale</span>
        <?php $si = mitsue_get('section_img_rationale'); if ($si): ?><img src="<?php echo esc_url($si); ?>" alt="" class="section-img"><?php endif; ?>
      </div>
      <div>
        <h2>Four converging pressures, <em>one rural answer.</em></h2>
        <div class="h2-jp jp">四つの構造的圧力に、ひとつの農村型解答を。</div>
        <div class="h2-sub body-en">The project sits at the intersection of energy transition, forest liability, stranded community assets, and a rural digital deficit — each individually expensive to solve, all of them addressable together.</div>
        <div class="h2-sub body-jp jp">本プロジェクトは、エネルギー転換・森林の負債・地域資産の遊休化・農村デジタル格差という四つの交差点に位置します。それぞれ単独では高コストな課題ですが、まとめて取り組むことができます。</div>
      </div>
    </div>
    <div class="rationale">
      <?php foreach ($items as $it): ?>
        <div class="rationale-item">
          <div class="n"><?php echo esc_html($it['n']); ?></div>
          <h4><?php echo esc_html($it['title']); ?></h4>
          <div class="h4-jp jp"><?php echo esc_html($it['jp']); ?></div>
          <p class="body-en"><?php echo esc_html($it['body']); ?></p>
          <?php if (!empty($it['body_jp'])): ?>
          <p class="body-jp jp"><?php echo esc_html($it['body_jp']); ?></p>
          <?php endif; ?>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
