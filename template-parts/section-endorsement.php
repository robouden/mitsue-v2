<?php
/**
 * Endorsement — external pull-quote / testimonial band.
 * Light editorial "breather" between Rationale (§02) and the rest of the page.
 * Bilingual via the standard .body-en / .body-jp toggle.
 * Text is editable in Settings → Mitsue Content → Endorsement.
 * @package Mitsue
 */
$quote_en = mitsue_get( 'endorse_quote_en',
  '<p>This initiative is highly relevant and timely. It addresses both the past and present reality of rural depopulation and the socio-economic “impoverishment” — or “desertification”, as we call it in <a href="https://ec.europa.eu/regional_policy/policy/what/investment-policy_en" target="_blank" rel="noopener">European Cohesion Policy</a> — while also being forward-looking: engaging critically with the AI and digital economies, and confronting the global problem of monocultures and plantations that deplete biodiversity and erode resilient, thriving landscapes.</p>'
  . '<p>I see great relevance in such an idea — not least for the many EU countries that, like Japan, suffer from the ageing and depopulation of rural areas, with multiple negative social, ecological and economic impacts.</p>'
  . '<p>Re-imagining towns and villages is a wonderful and essential project. Combining ecological resilience (the replacement of cedar) with social (trust and revival), cultural (a new sense of place) and economic resilience is very promising.</p>'
);

$quote_jp = mitsue_get( 'endorse_quote_jp',
  '<p>この構想は非常に意義深く、時宜を得たものです。過去から現在に続く農村部の人口減少と、社会経済的な「困窮」——<a href="https://ec.europa.eu/regional_policy/policy/what/investment-policy_en" target="_blank" rel="noopener">欧州結束政策</a>で私たちが「砂漠化」と呼ぶ現象——に取り組むと同時に、未来志向でもあります。AI・デジタル経済を批判的に受け止め、生物多様性を枯渇させ、回復力ある豊かな景観を損なう単一栽培やプランテーションという世界的課題にも向き合っているからです。</p>'
  . '<p>このような発想には大きな意義があると感じます。とりわけ、日本と同様に農村部の高齢化と人口減少に直面し、社会・生態・経済の各面で複合的な負の影響を被っている多くのEU諸国にとって、その意義は小さくありません。</p>'
  . '<p>町や村を再構想することは、すばらしく、そして不可欠な取り組みです。生態的な回復力（杉の置き換え）を、社会的な回復力（信頼と再生）、文化的な回復力（新たな「場所」の感覚）、そして経済的な回復力と組み合わせる——これは非常に有望です。</p>'
);

$cite_name    = mitsue_get( 'endorse_cite_name', 'Olivia Bina' );
$cite_role_en = mitsue_get( 'endorse_cite_role_en', 'Co-author, “Transforming Knowledge Systems for Life on Earth”' );
$cite_role_jp = mitsue_get( 'endorse_cite_role_jp', '「地球上の生命のための知識システムの変革」共著者' );
?>
<section class="endorsement">
  <div class="wrap">
    <div class="mono">Endorsement · 推薦の声</div>
    <blockquote>
      <div class="body-en"><?php echo wp_kses_post( $quote_en ); ?></div>
      <div class="body-jp jp"><?php echo wp_kses_post( $quote_jp ); ?></div>
      <?php if ( $cite_name ) : ?>
      <cite>
        <span class="cite-name"><?php echo esc_html( $cite_name ); ?></span>
        <?php if ( $cite_role_en ) : ?><span class="cite-role body-en"><?php echo wp_kses_post( $cite_role_en ); ?></span><?php endif; ?>
        <?php if ( $cite_role_jp ) : ?><span class="cite-role body-jp jp"><?php echo wp_kses_post( $cite_role_jp ); ?></span><?php endif; ?>
      </cite>
      <?php endif; ?>
    </blockquote>
  </div>
</section>
