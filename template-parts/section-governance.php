<?php
$founder_profiles = mitsue_rows('founder_profiles', [
  ['initials'=>'R.O.','name'=>'Rob Oudendijk','credit'=>'Founder of the BIOMASS ENERGY & AI project. Founder of YR-Design, a design and technology studio based in the Netherlands, and a core contributor to Safecast — the open environmental monitoring network established after Fukushima. His work spans interaction design, hardware development, and open-source environmental data.','credit_jp'=>'バイオマスエネルギーとAI創業者。オランダを拠点とするデザイン・テクノロジースタジオ「YR-Design」の創設者であり、福島第一原発事故後に設立されたオープン環境モニタリングネットワーク「Safecast」のコア・コントリビューター。インタラクションデザイン・ハードウェア開発・オープンソース環境データの領域を横断して活動している。'],
]);
$advisors = mitsue_rows('advisors', [
  ['initials'=>'R.O.','name'=>'Ray Ozzie','credit'=>'Software pioneer; former Chief Software Architect at Microsoft. Decades of work on distributed systems, collaboration software, and the discipline of small, accountable platforms. Confirmed May 5, 2026.', 'credit_jp'=>'ソフトウェア分野の先駆者。元マイクロソフト チーフ ソフトウェア アーキテクト。分散システム、コラボレーションソフトウェア、小規模で説明責任のあるプラットフォームの設計を数十年にわたり追求。2026年5月5日確認。'],
  ['initials'=>'S.P.','name'=>'San Poisson','credit'=>'Project Manager.', 'credit_jp'=>'プロジェクトマネージャー。'],
  ['initials'=>'·','name'=>'Advisor 4 — TBD','credit'=>'To be confirmed.', 'credit_jp'=>'確定待ち。'],
]);
$founders = mitsue_rows('founders', [
  ['name'=>'Rob Oudendijk',      'when'=>'YR-Design · Safecast'],
  ['name'=>'Japanese Co-founder','when'=>'To be confirmed'],
  ['name'=>'Founding member · 3','when'=>'To be confirmed'],
  ['name'=>'Founding member · 4','when'=>'To be confirmed'],
  ['name'=>'Target size',        'when'=>'3 – 5 total'],
]);
$legal = mitsue_rows('legal_path', [
  ['name'=>'Pre-incorporation',                         'when'=>'Today'],
  ['name'=>'一般社団法人 · Gen. Incorporated Assoc.',   'when'=>'First 6 – 9 mo'],
  ['name'=>'NPO法人 · Specified Nonprofit',            'when'=>'Months 18 – 24'],
  ['name'=>'認定NPO法人 · Certified NPO',              'when'=>'Long-term'],
]);
?>
<section id="governance">
  <div class="wrap">
    <div class="section-head">
      <div class="num">§ 04<span class="label">Governance</span>
        <?php $si = mitsue_get('section_img_governance'); if ($si): ?><img src="<?php echo esc_url($si); ?>" alt="" class="section-img"><?php endif; ?>
      </div>
      <div>
        <h2>An advisory bench of <em>builders</em> — and a clear path to certified nonprofit status.</h2>
        <div class="h2-jp jp">実務家による助言体制と、認定NPOへの明確な道筋</div>
      </div>
    </div>
    <div class="advisors">
      <?php foreach ($founder_profiles as $a): ?>
        <div class="advisor">
          <div class="role">FOUNDER · 創業者</div>
          <?php
            $photo_url = !empty($a['photo']) ? $a['photo'] : null;
            if ( ! $photo_url ) {
              $slug = strtolower(strtok($a['name'], ' '));
              $img  = MITSUE_DIR . '/assets/images/' . $slug . '.jpg';
              if ( file_exists($img) ) $photo_url = MITSUE_URI . '/assets/images/' . $slug . '.jpg';
            }
          ?>
          <div class="portrait" aria-hidden="true">
            <?php if ( $photo_url ): ?>
              <img src="<?php echo esc_url($photo_url); ?>" alt="<?php echo esc_attr($a['name']); ?>">
            <?php else: ?>
              <?php echo esc_html($a['initials'] ?? strtoupper(substr($a['name'],0,1))); ?>
            <?php endif; ?>
          </div>
          <h4><?php if (!empty($a['link'])): ?><a href="<?php echo esc_url($a['link']); ?>" target="_blank" rel="noopener"><?php echo esc_html($a['name']); ?></a><?php else: ?><?php echo esc_html($a['name']); ?><?php endif; ?></h4>
          <p class="credit body-en"><?php echo esc_html($a['credit']); ?></p>
          <?php if (!empty($a['credit_jp'])): ?>
          <p class="credit body-jp jp"><?php echo esc_html($a['credit_jp']); ?></p>
          <?php endif; ?>
        </div>
      <?php endforeach; ?>
      <?php foreach ($advisors as $a): ?>
        <div class="advisor">
          <div class="role">ADVISORY BOARD · 助言役員</div>
          <?php
            $photo_url = !empty($a['photo']) ? $a['photo'] : null;
            if ( ! $photo_url ) {
              $slug = strtolower(strtok($a['name'], ' '));
              $img  = MITSUE_DIR . '/assets/images/' . $slug . '.jpg';
              if ( file_exists($img) ) $photo_url = MITSUE_URI . '/assets/images/' . $slug . '.jpg';
            }
          ?>
          <div class="portrait" aria-hidden="true">
            <?php if ( $photo_url ): ?>
              <img src="<?php echo esc_url($photo_url); ?>" alt="<?php echo esc_attr($a['name']); ?>">
            <?php else: ?>
              <?php echo esc_html($a['initials'] ?? strtoupper(substr($a['name'],0,1))); ?>
            <?php endif; ?>
          </div>
          <h4><?php if (!empty($a['link'])): ?><a href="<?php echo esc_url($a['link']); ?>" target="_blank" rel="noopener"><?php echo esc_html($a['name']); ?></a><?php else: ?><?php echo esc_html($a['name']); ?><?php endif; ?></h4>
          <p class="credit body-en"><?php echo esc_html($a['credit']); ?></p>
          <?php if (!empty($a['credit_jp'])): ?>
          <p class="credit body-jp jp"><?php echo esc_html($a['credit_jp']); ?></p>
          <?php endif; ?>
        </div>
      <?php endforeach; ?>
    </div>
    <div class="governance">
      <div class="gov-col">
        <h5>FOUNDING MEMBERS · 設立メンバー</h5>
        <ul>
          <?php foreach ($founders as $f): ?>
            <li><span><?php echo esc_html($f['name']); ?></span><span class="when"><?php echo esc_html($f['when']); ?></span></li>
          <?php endforeach; ?>
        </ul>
      </div>
      <div class="gov-col">
        <h5>LEGAL STRUCTURE · 法人形態の経路</h5>
        <ul>
          <?php foreach ($legal as $l): ?>
            <li><span><?php echo esc_html($l['name']); ?></span><span class="when"><?php echo esc_html($l['when']); ?></span></li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
  </div>
</section>
