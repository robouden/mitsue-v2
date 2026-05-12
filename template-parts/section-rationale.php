<?php
$items = mitsue_rows('rationale', [
  ['n'=>'01 · ENERGY TRANSITION','title'=>'Distributed generation, not grid extension.',       'jp'=>'EV普及と分散型発電',    'body'=>'Within roughly ten years, the majority of Japanese passenger vehicles are expected to be electric. Rural regions need significant new distributed generation capacity — grid extension is slow and capital-intensive.','body_jp'=>'およそ10年以内に、日本の乗用車の大半が電気自動車になると予測されています。農村部には大規模な分散型発電能力が必要であり、系統延伸は遅く資本集約的です。'],
  ['n'=>'02 · FOREST LIABILITY', 'title'=>'Aged cedar plantations as under-managed asset.',    'jp'=>'放置された杉人工林の活用','body'=>'Aged sugi plantations impose ecological costs — pollen burden, biodiversity loss — and physical risks: landslide and fire. Active management converts liability into feedstock and timber revenue.','body_jp'=>'老齢化した杉の人工林は、花粉被害・生物多様性の喪失といった生態的コストと、土砂崩れ・火災リスクをもたらします。適切な管理により、負の資産を燃料や木材収益へと転換できます。'],
  ['n'=>'03 · STRANDED ASSETS',  'title'=>'Closed schools as anchor facilities.',              'jp'=>'廃校の利活用',         'body'=>'Closed schools currently impose net maintenance costs on shrinking municipal budgets. Productive reuse turns these into community-anchored facilities — the data center inherits a building, a community, and a story.','body_jp'=>'廃校は現在、縮小する自治体予算に維持管理コストとして負担をかけています。有効活用することで、地域の拠点施設へと転換できます。'],
  ['n'=>'04 · DIGITAL DEFICIT',  'title'=>'Edge compute where the energy is.',                'jp'=>'農村部のデジタル基盤不足','body'=>'Rural broadband and edge-compute capacity continue to lag urban Japan. A small, energy-aligned data center addresses both the connectivity gap and the on-site computation gap at the same time.','body_jp'=>'農村部のブロードバンドとエッジコンピューティング能力は、都市部に比べて依然として遅れています。エネルギーと連携した小規模データセンターが、接続性と演算能力の両方のギャップを同時に解消します。'],
]);
?>
<section>
  <div class="wrap">
    <div class="section-head">
      <div class="num">§ 02<span class="label">Rationale</span></div>
      <div>
        <h2>Four converging pressures, <em>one rural answer.</em></h2>
        <div class="h2-jp jp">四つの構造的圧力に、ひとつの農村型解答を。</div>
        <div class="h2-sub">The project sits at the intersection of energy transition, forest liability, stranded community assets, and a rural digital deficit — each individually expensive to solve, all of them addressable together.</div>
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
