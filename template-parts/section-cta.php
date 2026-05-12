<?php
$lead_name   = mitsue_get('cta_lead_name',  'Rob Oudendijk');
$lead_affil  = mitsue_get('cta_lead_affil', 'YR-Design · Safecast');
$cta_email   = mitsue_get('cta_email',      '');
$plan_url    = mitsue_get('cta_plan_url',   '#');
$charter_url = mitsue_get('cta_charter_url','#');
$intro_en    = mitsue_get('cta_intro_en',   "The project is currently in pre-foundation phase. We're identifying patient capital, advisory partners, and Japanese co-founders with rural credibility. If your time horizon matches ours, we would welcome the conversation.");
$intro_jp    = mitsue_get('cta_intro_jp',   'プロジェクトは現在、設立準備段階にあります。長期的視点を持つ出資者、助言パートナー、農村に信頼のある日本人共同創業者を探しています。時間軸が一致すると感じていただけるなら、ぜひご連絡ください。');
?>
<section id="contact" class="cta" style="border-bottom:0;">
  <div class="wrap">
    <div class="grid">
      <div>
        <div class="mono" style="color:rgba(245,241,234,0.5);margin-bottom:20px;">§ 08 · GET IN TOUCH</div>
        <h2>For investors, foundations, and corporate partners who think in <em>decades.</em></h2>
        <div class="h2-jp">数十年単位で考える投資家・財団・企業パートナーの皆様へ</div>
        <p class="body-en"><?php echo esc_html($intro_en); ?></p>
        <p class="body-jp jp"><?php echo esc_html($intro_jp); ?></p>
        <div class="actions">
          <a href="<?php echo esc_url($plan_url); ?>" class="cta-btn primary">Request the implementation plan <span aria-hidden="true">↓</span></a>
          <a href="<?php echo esc_url($charter_url); ?>" class="cta-btn">Read the founding charter</a>
        </div>
      </div>
      <div>
        <div class="cta-contact">
          <div class="cta-contact-row">
            <span class="label">PROJECT LEAD</span>
            <span class="v"><?php echo esc_html($lead_name); ?></span>
            <?php echo esc_html($lead_affil); ?>
          </div>
          <div class="cta-contact-row">
            <span class="label">LOCATION</span>
            <span class="v">Mitsue Village</span>
            Nara Prefecture, Japan · 奈良県御杖村
          </div>
          <div class="cta-contact-row">
            <span class="label">DOCUMENT REPOSITORY</span>
            <span class="v">codeberg.org / YR-Design</span>
            Founding charter · implementation plan · stakeholder map · finance workbook
          </div>
          <?php if ($cta_email): ?>
          <div class="cta-contact-row">
            <span class="label">EMAIL</span>
            <span class="v"><a href="mailto:<?php echo esc_attr($cta_email); ?>" style="color:inherit;"><?php echo esc_html($cta_email); ?></a></span>
          </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</section>
