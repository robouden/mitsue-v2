<?php
$img1 = mitsue_get('imagery_left',  '');
$img2 = mitsue_get('imagery_right', '');
?>
<section style="padding:0;border-bottom:1px solid var(--rule);">
  <div class="wrap" style="padding:0;">
    <div style="display:grid;grid-template-columns:2fr 1fr;min-height:480px;">
      <?php if ($img1): ?>
        <div style="background:url('<?php echo esc_url($img1); ?>') center/cover no-repeat;min-height:480px;" data-lightbox-url="<?php echo esc_attr($img1); ?>" data-lightbox-alt="Mitsue forested landscape · 御杖の森"></div>
      <?php else: ?>
        <div class="img-slot" style="aspect-ratio:auto;min-height:480px;border-left:0;border-top:0;border-bottom:0;">
          <span>Mitsue forested landscape · 御杖の森</span>
        </div>
      <?php endif; ?>
      <?php if ($img2): ?>
        <div style="background:url('<?php echo esc_url($img2); ?>') center/cover no-repeat;min-height:480px;" data-lightbox-url="<?php echo esc_attr($img2); ?>" data-lightbox-alt="Closed Mitsue Elementary School · 旧御杖小学校"></div>
      <?php else: ?>
        <div class="img-slot" style="aspect-ratio:auto;min-height:480px;border-right:0;border-top:0;border-bottom:0;">
          <span>Closed Mitsue Elementary School · 旧御杖小学校</span>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>
