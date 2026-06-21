<?php
$eyebrow     = mitsue_get('hero_eyebrow', 'A 25-YEAR INITIATIVE · 二十五年計画');
$headline_en = mitsue_get('hero_headline_en', 'Forest restoration, distributed energy, and a <em>community-owned</em> data center — in rural Japan.');
$headline_jp = mitsue_get('hero_headline_jp', '森林再生・分散型再生可能エネルギー・地域所有のデータセンター');
$lede_en     = mitsue_get('hero_lede_en', 'The Mitsue Project repurposes the former Sugano Elementary School (Mitsue Taiken Koryukan / 体験交流館) and the forests around it into a single, transparent, openly replicable demonstration of rural revitalization — modest in scale, patient in horizon, built to be copied.');
$lede_jp     = mitsue_get('hero_lede_jp', '御杖プロジェクトは、旧菅野小学校（御杖体験交流館）とその周囲の森林を、農山村再生の透明で再現可能な統合モデルへと転換する取り組みです。');
$meta        = mitsue_rows('hero_meta', [
  ['k'=>'LOCATION',    'v'=>'Mitsue Village','sub'=>'Nara Prefecture · 奈良県御杖村'],
  ['k'=>'HORIZON',     'v'=>'25 Years',      'sub'=>'Bridging today to small-scale fusion'],
  ['k'=>'STRUCTURE',   'v'=>'Non-profit',    'sub'=>'一般社団法人 → NPO法人'],
  ['k'=>'YEAR-3 TARGET','v'=>'¥134M',        'sub'=>'Five-layer funding stack'],
]);
?>
<header class="hero">
  <div class="wrap">
    <div class="eyebrow"><?php echo wp_kses_post($eyebrow); ?></div>
    <h1><?php echo wp_kses_post($headline_en); ?></h1>
    <div class="h1-jp jp"><?php echo esc_html($headline_jp); ?></div>
    <p class="lede">
      <?php echo esc_html($lede_en); ?>
      <span class="jp"><?php echo esc_html($lede_jp); ?></span>
    </p>
    <div class="hero-meta">
      <?php foreach ($meta as $item): ?>
        <div>
          <div class="k"><?php echo esc_html($item['k']); ?></div>
          <div class="v"><?php echo esc_html($item['v']); ?>
            <small class="body-en"><?php echo esc_html($item['sub']); ?></small>
            <?php if (!empty($item['sub_jp'])): ?><small class="body-jp jp"><?php echo esc_html($item['sub_jp']); ?></small><?php endif; ?>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</header>
