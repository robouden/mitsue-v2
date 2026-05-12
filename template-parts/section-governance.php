<?php
$advisors = mitsue_rows('advisors', [
  ['initials'=>'J.I.','name'=>'Joi Ito',  'credit'=>'Former Director, MIT Media Lab. Internet pioneer; long-running engagement with Japanese institutions, technology policy, and emerging compute. Confirmed May 5, 2026.'],
  ['initials'=>'R.O.','name'=>'Ray Ozzie','credit'=>'Software pioneer; former Chief Software Architect at Microsoft. Decades of work on distributed systems, collaboration software, and the discipline of small, accountable platforms. Confirmed May 5, 2026.'],
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
      <div class="num">§ 04<span class="label">Governance</span></div>
      <div>
        <h2>An advisory bench of <em>builders</em> — and a clear path to certified nonprofit status.</h2>
        <div class="h2-jp jp">実務家による助言体制と、認定NPOへの明確な道筋</div>
      </div>
    </div>
    <div class="advisors">
      <?php foreach ($advisors as $a): ?>
        <div class="advisor">
          <div class="role">ADVISORY BOARD · 助言役員</div>
          <?php
            $slug = strtolower(strtok($a['name'], ' '));
            $img  = get_stylesheet_directory() . '/assets/images/' . $slug . '.jpg';
            $uri  = get_stylesheet_directory_uri() . '/assets/images/' . $slug . '.jpg';
          ?>
          <div class="portrait" aria-hidden="true">
            <?php if ( file_exists($img) ): ?>
              <img src="<?php echo esc_url($uri); ?>" alt="<?php echo esc_attr($a['name']); ?>">
            <?php else: ?>
              <?php echo esc_html($a['initials']); ?>
            <?php endif; ?>
          </div>
          <h4><?php echo esc_html($a['name']); ?></h4>
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
