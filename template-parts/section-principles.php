<?php
$ps = mitsue_rows('principles', [
  ['n'=>'i.',  'title'=>'Local first',          'jp'=>'地域第一',     'body'=>'Every material decision begins with the wellbeing of Mitsue residents and landowners. Not as marketing — as a procedural rule.',        'body_jp'=>'あらゆる意思決定は、御杖の住民と土地所有者の幸福を起点とします。マーケティングではなく、手続き上のルールとして。'],
  ['n'=>'ii.', 'title'=>'Open and transparent', 'jp'=>'公開・透明',    'body'=>'Environmental data, financial records, and methodologies are published. The default is open; exceptions are documented.',                   'body_jp'=>'環境データ・財務記録・手法はすべて公開します。デフォルトはオープン。例外は文書化します。'],
  ['n'=>'iii.','title'=>'Patient and long-term','jp'=>'忍耐と長期視野','body'=>'A 25-year horizon. No premature scaling. Funding gates are honored even when delay is uncomfortable.',                                   'body_jp'=>'25年という時間軸。拙速なスケールアップは行いません。遅延が不本意であっても、資金ゲートを遵守します。'],
  ['n'=>'iv.', 'title'=>'Replicable',           'jp'=>'再現可能',      'body'=>'Documentation discipline is treated as a deliverable, not an afterthought. The point is that other villages can copy this.',              'body_jp'=>'文書化の規律は成果物として扱います。他の村がこのモデルを複製できることが目的です。'],
  ['n'=>'v.',  'title'=>'Modest in scale',      'jp'=>'適正な規模',   'body'=>'Small enough to remain accountable to the community that hosts it. Hyperscale economics are explicitly not the goal.',                   'body_jp'=>'受け入れてくれるコミュニティに対して説明責任を果たせる規模を維持します。ハイパースケール経済は明示的に目標としません。'],
  ['n'=>'vi.', 'title'=>'Non-partisan',         'jp'=>'中立',          'body'=>"No political alignment. Positions are confined to the project's mission and to what the published evidence supports.",                   'body_jp'=>'特定の政治的立場を取りません。主張はプロジェクトの使命と、公開された証拠が支持する範囲に限定します。'],
]);
?>
<section>
  <div class="wrap">
    <div class="section-head">
      <div class="num">§ 06<span class="label">Operating Principles</span>
        <?php $si = mitsue_get('section_img_principles'); if ($si): ?><img src="<?php echo esc_url($si); ?>" alt="" class="section-img" loading="lazy" decoding="async"><?php endif; ?>
      </div>
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
          <p class="body-en"><?php echo esc_html($p['body']); ?></p>
          <?php if (!empty($p['body_jp'])): ?>
          <p class="body-jp jp"><?php echo esc_html($p['body_jp']); ?></p>
          <?php endif; ?>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
