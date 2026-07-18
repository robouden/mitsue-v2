<?php /** @package Mitsue */ ?>
<footer role="contentinfo" style="position:relative;">
  <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/Mitsue-kun_16-removebg-preview.png' ); ?>" alt="" aria-hidden="true" style="position:absolute;right:24px;bottom:48px;width:150px;height:auto;pointer-events:none;">
  <div class="wrap">
    <div class="foot-grid">
      <div>
        <div class="brand" style="margin-bottom:18px;">
          <div class="mark" aria-hidden="true"><?php echo esc_html( get_theme_mod('mitsue_logo_mark','御') ); ?></div>
          <div class="name">
            <div class="en"><?php bloginfo('name'); ?></div>
            <div class="jp"><?php echo esc_html( get_theme_mod('mitsue_logo_jp','御杖くんプロジェクト') ); ?></div>
          </div>
        </div>
        <p style="font-size:13px;color:var(--ink-mute);max-width:320px;line-height:1.65;margin:0;">
          <?php echo esc_html( get_theme_mod('mitsue_footer_tagline','A 25-year initiative for forest restoration, distributed renewable energy, and community-owned digital infrastructure in rural Japan.') ); ?>
        </p>
      </div>
      <div>
        <h6>PROGRAMME</h6>
        <ul>
          <li><a href="#programme">Forest Restoration</a></li>
          <li><a href="#programme">Sustainable Energy</a></li>
          <li><a href="#programme">Community Data Center</a></li>
          <li><a href="#programme">EV Charging</a></li>
          <li><a href="#programme">Open Knowledge</a></li>
        </ul>
      </div>
      <div>
        <h6>DOCUMENTS</h6>
        <ul>
          <?php
          $repo_base       = 'https://codeberg.org/YR-Design/mitsue-ai-data-center/raw/branch/main/';
          $plan_url        = mitsue_get('cta_plan_url','#');
          $charter_url     = mitsue_get('cta_charter_url','#');
          $flowchart_url   = mitsue_get('cta_flowchart_url',   $repo_base . 'mitsue_phases_funding_flowchart.pdf');
          $stakeholder_url = mitsue_get('cta_stakeholder_url', $repo_base . 'mitsue_stakeholders.pdf');
          $finance_url     = mitsue_get('cta_finance_url',     $repo_base . 'mitsue_finance.xlsx');
          ?>
          <li><a href="<?php echo esc_url($charter_url); ?>">Founding Charter</a></li>
          <li><a href="<?php echo esc_url($plan_url); ?>">Implementation Plan</a></li>
          <li><a href="<?php echo esc_url($flowchart_url); ?>">Phase &amp; Funding Flowchart</a></li>
          <li><a href="<?php echo esc_url($stakeholder_url); ?>">Stakeholder Map</a></li>
          <li><a href="<?php echo esc_url($finance_url); ?>">Finance Workbook</a></li>
        </ul>
      </div>
      <div>
        <h6>CONTACT</h6>
        <ul>
          <li><?php echo esc_html( mitsue_get('cta_lead_name','Rob Oudendijk') ); ?></li>
          <li><?php echo esc_html( mitsue_get('cta_lead_affil','YR-Design · Safecast') ); ?></li>
          <li>Nara Prefecture, Japan</li>
          <?php $email = mitsue_get('cta_email',''); if ($email): ?>
          <li><a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a></li>
          <?php endif; ?>
          <li style="padding-top:12px;"><a href="https://codeberg.org/YR-Design" target="_blank" rel="noopener">codeberg.org / YR-Design ↗</a></li>
        </ul>
      </div>
    </div>
    <div class="foot-meta">
      <div>© <?php echo esc_html(date('Y')); ?> BIOMASS ENERGY &amp; AI · バイオマスエネルギーとAI</div>
      <div>CC-BY 4.0 · DOCUMENTS &amp; DATA RELEASED UNDER OPEN LICENCES</div>
    </div>
  </div>
</footer>

<script>
(function () {
  var html    = document.documentElement;
  var buttons = document.querySelectorAll('.lang button');
  var EN_BTN  = buttons[0];   // "EN"
  var JP_BTN  = buttons[1];   // "日本語"

  /* Apply a saved or default language preference */
  function applyLang(lang) {
    html.setAttribute('data-lang', lang);
    var isJp = lang === 'ja';
    EN_BTN.classList.toggle('active', !isJp);
    EN_BTN.setAttribute('aria-pressed', String(!isJp));
    JP_BTN.classList.toggle('active',  isJp);
    JP_BTN.setAttribute('aria-pressed', String(isJp));
    try { localStorage.setItem('mitsue-lang', lang); } catch(e) {}
  }

  /* Restore preference immediately (before first paint if possible) */
  var saved = 'ja';
  try { saved = localStorage.getItem('mitsue-lang') || 'ja'; } catch(e) {}
  applyLang(saved);

  /* Wire up the buttons */
  EN_BTN.addEventListener('click', function () { applyLang('en'); });
  JP_BTN.addEventListener('click', function () { applyLang('ja'); });
}());
</script>

<?php wp_footer(); ?>
</body>
</html>
