<?php
$rows     = mitsue_rows('funding_rows', [
  ['layer'=>'L1','name'=>'Founder / private capital','desc'=>'Self-funded ramp; founder commitments',                                   'y1'=>'¥3M','y3'=>'¥1M'],
  ['layer'=>'L2','name'=>'Government grants',         'desc'=>'NEDO · METI · Nara Prefecture · Mitsue Village',                         'y1'=>'¥5M','y3'=>'¥80M'],
  ['layer'=>'L3','name'=>'Foundations',               'desc'=>'Nippon Foundation · Japan Fund for Global Environment · Toyota Foundation','y1'=>'¥3M','y3'=>'¥20M'],
  ['layer'=>'L4','name'=>'Corporate partnerships',    'desc'=>'Dutch and Japanese corporates; CSR-aligned',                             'y1'=>'¥0', 'y3'=>'¥30M'],
  ['layer'=>'L5','name'=>'Operating revenue',         'desc'=>'Hosting fees · FIT/FIP · heat · EV charging · J-Credits',               'y1'=>'¥0', 'y3'=>'¥3M'],
]);
$total_y1 = mitsue_get('funding_total_y1','¥11M');
$total_y3 = mitsue_get('funding_total_y3','¥134M');
?>
<section id="funding">
  <div class="wrap">
    <div class="section-head">
      <div class="num">§ 05<span class="label">Funding</span></div>
      <div>
        <h2>A <em>five-layer stack</em> — protecting against early dependence on any single source.</h2>
        <div class="h2-jp jp">五層構造の資金調達 — 単一財源への早期依存を避ける</div>
        <div class="h2-sub body-en">Each layer is unlocked by the deliverables of the prior phase. Figures are planning targets, not commitments; the actual mix depends on grant outcomes and partnership negotiations during Phases 1 and 2.</div>
        <div class="h2-sub body-jp jp">各層は前フェーズの成果物によって解放されます。数字は計画目標であり確約ではなく、実際の組み合わせはフェーズ1・2における補助金の結果とパートナーシップ交渉によって変わります。</div>
      </div>
    </div>
    <table class="funding">
      <thead>
        <tr><th></th><th>Source</th><th>Year 1 Target</th><th>Year 3 Target</th></tr>
      </thead>
      <tbody>
        <?php foreach ($rows as $r): ?>
          <tr>
            <td><?php echo esc_html($r['layer']); ?></td>
            <td class="layer-name"><?php echo esc_html($r['name']); ?>
              <span class="desc body-en"><?php echo esc_html($r['desc']); ?></span>
              <?php if (!empty($r['desc_jp'])): ?><span class="desc body-jp jp"><?php echo esc_html($r['desc_jp']); ?></span><?php endif; ?>
            </td>
            <td class="num"><?php echo esc_html($r['y1']); ?></td>
            <td class="num"><?php echo esc_html($r['y3']); ?></td>
          </tr>
        <?php endforeach; ?>
        <tr class="total">
          <td></td><td>Illustrative total</td>
          <td class="num"><?php echo esc_html($total_y1); ?></td>
          <td class="num"><?php echo esc_html($total_y3); ?></td>
        </tr>
      </tbody>
    </table>
  </div>
</section>
