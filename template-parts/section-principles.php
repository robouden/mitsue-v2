<?php
$ps = mitsue_rows('principles', [
  ['n'=>'i.',  'title'=>'Local first',          'jp'=>'地域第一',     'body'=>'Every material decision begins with the wellbeing of Mitsue residents and landowners. Not as marketing — as a procedural rule.'],
  ['n'=>'ii.', 'title'=>'Open and transparent', 'jp'=>'公開・透明',    'body'=>'Environmental data, financial records, and methodologies are published. The default is open; exceptions are documented.'],
  ['n'=>'iii.','title'=>'Patient and long-term','jp'=>'忍耐と長期視野','body'=>'A 25-year horizon. No premature scaling. Funding gates are honored even when delay is uncomfortable.'],
  ['n'=>'iv.', 'title'=>'Replicable',           'jp'=>'再現可能',      'body'=>'Documentation discipline is treated as a deliverable, not an afterthought. The point is that other villages can copy this.'],
  ['n'=>'v.',  'title'=>'Modest in scale',      'jp'=>'適正な規模',   'body'=>'Small enough to remain accountable to the community that hosts it. Hyperscale economics are explicitly not the goal.'],
  ['n'=>'vi.', 'title'=>'Non-partisan',         'jp'=>'中立',          'body'=>"No political alignment. Positions are confined to the project's mission and to what the published evidence supports."],
]);
?>
<section>
  <div class="wrap">
    <div class="section-head">
      <div class="num">§ 06<span class="label">Operating Principles</span></div>
      <div>
        <h2>Six principles that <em>govern every decision.</em></h2>
        <div class="h2-jp jp">運営の六原則</div>
      </div>
    </div>
    <div class="principles">
      <?php foreach ($ps as $p): ?>
        <div class="prin">
          <div class="n"><?php echo esc_html($p['n']); ?></div>
          <h6><?php echo esc_html($p['title']); ?></h6>
          <div class="pjp jp"><?php echo esc_html($p['jp']); ?></div>
          <p><?php echo esc_html($p['body']); ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
