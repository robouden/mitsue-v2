<?php
$rows     = mitsue_rows('funding_rows', [
  ['layer'=>'L1','name'=>'Founder / private capital','name_jp'=>'創業者・民間資本',  'desc'=>'Self-funded ramp; founder commitments',                                   'desc_jp'=>'自己資金によるスタートアップ費用；創業者コミットメント',                                                       'y1'=>'¥3M','y3'=>'¥1M'],
  ['layer'=>'L2','name'=>'Government grants',         'name_jp'=>'政府助成金',        'desc'=>'NEDO · METI · Nara Prefecture · Mitsue Village',                         'desc_jp'=>'NEDO・経済産業省・奈良県・御杖村',                                                                           'y1'=>'¥5M','y3'=>'¥80M'],
  ['layer'=>'L3','name'=>'Foundations',               'name_jp'=>'財団',              'desc'=>'Nippon Foundation · Japan Fund for Global Environment · Toyota Foundation','desc_jp'=>'日本財団・地球環境基金・トヨタ財団',                                                                         'y1'=>'¥3M','y3'=>'¥20M'],
  ['layer'=>'L4','name'=>'Corporate partnerships',    'name_jp'=>'企業パートナーシップ','desc'=>'Dutch and Japanese corporates; CSR-aligned',                             'desc_jp'=>'オランダ・日本の企業；CSR連携',                                                                              'y1'=>'¥0', 'y3'=>'¥30M'],
  ['layer'=>'L5','name'=>'Operating revenue',         'name_jp'=>'事業収益',          'desc'=>'Hosting fees · FIT/FIP · EV charging · J-Credits',                     'desc_jp'=>'ホスティング料・FIT/FIP・EV充電料金・Jクレジット',                                                           'y1'=>'¥0', 'y3'=>'¥3M'],
]);
$total_y1 = mitsue_get('funding_total_y1','¥11M');
$total_y3 = mitsue_get('funding_total_y3','¥134M');
?>
<section id="funding">
  <div class="wrap">
    <div class="section-head">
      <div class="num">§ 05<span class="label">Funding</span>
        <?php $si = mitsue_get('section_img_funding'); if ($si): ?><img src="<?php echo esc_url($si); ?>" alt="" class="section-img"><?php endif; ?>
      </div>
      <div>
        <h2>A <em>five-layer stack</em> — protecting against early dependence on any single source.</h2>
        <div class="h2-jp jp">五層構造の資金調達 — 単一財源への早期依存を避ける</div>
        <div class="h2-sub body-en">Each layer is unlocked by the deliverables of the prior phase. Figures are planning targets, not commitments; the actual mix depends on grant outcomes and partnership negotiations during Phases 1 and 2.</div>
        <div class="h2-sub body-jp jp">各層は前フェーズの成果によって開放されます。数字は計画目標であり確約ではなく、実際の組み合わせはフェーズ1・2における補助金の結果とパートナーシップ交渉によって変わります。</div>
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
            <td class="layer-name">
              <span class="body-en"><?php echo esc_html($r['name']); ?></span>
              <?php if (!empty($r['name_jp'])): ?><span class="body-jp jp"> · <?php echo esc_html($r['name_jp']); ?></span><?php endif; ?>
              <span class="desc body-en"><?php echo esc_html($r['desc']); ?></span>
              <?php if (!empty($r['desc_jp'])): ?><span class="desc body-jp jp"><?php echo esc_html($r['desc_jp']); ?></span><?php endif; ?>
            </td>
            <td class="num"><?php echo esc_html($r['y1']); ?></td>
            <td class="num"><?php echo esc_html($r['y3']); ?></td>
          </tr>
        <?php endforeach; ?>
        <tr class="total">
          <td></td><td><span class="body-en">Illustrative total</span><span class="body-jp jp"> · 試算合計</span></td>
          <td class="num"><?php echo esc_html($total_y1); ?></td>
          <td class="num"><?php echo esc_html($total_y3); ?></td>
        </tr>
      </tbody>
    </table>
  </div>
</section>
