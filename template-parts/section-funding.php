<?php
$rows     = mitsue_rows('funding_rows', [
  ['layer'=>'L1','name'=>'Founder / private capital','name_jp'=>'創業者・民間資本',  'desc'=>'Self-funded ramp; founder commitments',                                   'desc_jp'=>'自己資金によるスタートアップ費用；創業者コミットメント',                                                       'committed'=>'¥6M'],
  ['layer'=>'L2','name'=>'Government grants',         'name_jp'=>'政府助成金',        'desc'=>'NEDO · METI · Nara Prefecture · Mitsue Village 地域脱炭素移行・再エネ推進交付金 (2/3–3/4, via village)',                         'desc_jp'=>'NEDO・経済産業省・奈良県・御杖村 地域脱炭素移行・再エネ推進交付金（補助率2/3〜3/4、村経由）',                                                                           'committed'=>'¥115M'],
  ['layer'=>'L3','name'=>'Foundations',               'name_jp'=>'財団',              'desc'=>'Nippon Foundation · Japan Fund for Global Environment · Toyota Foundation','desc_jp'=>'日本財団・地球環境基金・トヨタ財団',                                                                         'committed'=>'¥33M'],
  ['layer'=>'L4','name'=>'Corporate partnerships',    'name_jp'=>'企業パートナーシップ','desc'=>'Dutch and Japanese corporates; CSR-aligned',                             'desc_jp'=>'オランダ・日本の企業；CSR連携',                                                                              'committed'=>'¥35M'],
  ['layer'=>'L5','name'=>'Operating revenue',         'name_jp'=>'事業収益',          'desc'=>'Hosting fees · FIT/FIP · EV charging · J-Credits',                     'desc_jp'=>'ホスティング料・FIT/FIP・EV充電料金・Jクレジット',                                                           'committed'=>'¥3M'],
]);
$total_committed = mitsue_get('funding_total_committed','¥192M');
$bac             = mitsue_get('funding_bac','¥220M');
$total_budget    = mitsue_get('funding_total_budget','¥245M');
?>
<section id="funding">
  <div class="wrap">
    <div class="section-head">
      <div class="num">§ 05<span class="label">Funding</span>
        <?php $si = mitsue_get('section_img_funding'); if ($si): ?><img src="<?php echo esc_url($si); ?>" alt="" class="section-img" loading="lazy" decoding="async"><?php endif; ?>
      </div>
      <div>
        <h2>A <em>five-layer stack</em> — protecting against early dependence on any single source.</h2>
        <div class="h2-jp jp">五層構造の資金調達 — 単一財源への早期依存を避ける</div>
        <div class="h2-sub body-en">Each layer is unlocked by the deliverables of the prior phase. Figures are funding targets under the Baseline Rev 1 plan (May 2026) — sources we are pursuing or applying to, not funds secured or received; the remaining gap to the project's full budget is to be closed during Phases 2–3.</div>
        <div class="h2-sub body-jp jp">各層は前フェーズの成果によって開放されます。数字はベースラインRev 1計画（2026年5月）時点の資金調達目標であり、現在申請・交渉中の資金源を示すもので、確保済み・受領済みの資金ではありません。事業全体の予算との差額はフェーズ2〜3で解消する計画です。</div>
      </div>
    </div>
    <table class="funding">
      <thead>
        <tr><th></th><th>Source</th><th>Target (unsecured)</th></tr>
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
            <td class="num"><?php echo esc_html($r['committed']); ?></td>
          </tr>
        <?php endforeach; ?>
        <tr class="total">
          <td></td><td><span class="body-en">Total funding target (unsecured)</span><span class="body-jp jp"> · 資金調達目標合計（未確保）</span></td>
          <td class="num"><?php echo esc_html($total_committed); ?></td>
        </tr>
        <tr class="total">
          <td></td><td><span class="body-en">BAC (project budget baseline)</span><span class="body-jp jp"> · BAC（事業予算ベースライン）</span></td>
          <td class="num"><?php echo esc_html($bac); ?></td>
        </tr>
        <tr class="total">
          <td></td><td><span class="body-en">Total project budget (incl. reserve)</span><span class="body-jp jp"> · 事業総予算（予備費含む）</span></td>
          <td class="num"><?php echo esc_html($total_budget); ?></td>
        </tr>
      </tbody>
    </table>
  </div>
</section>
