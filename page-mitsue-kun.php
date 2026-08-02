<?php
/**
 * Template Name: Mitsue-kun
 * On-site mascot explainer — exists mainly so みつえくん/Mitsue-kun has an
 * indexable on-domain page (previously only linked out to Codeberg).
 * Create a Page in WP admin, set slug "mitsue-kun", assign this template.
 * @package Mitsue
 */
get_header();
?>

<main class="mitsue-kun-page">

<section class="hero" style="border-bottom:1px solid var(--rule);">
  <div class="wrap">
    <div class="mono" style="color:var(--ink-mute);margin-bottom:18px;">御杖くん・みつえくん・Mitsue-kun</div>
    <h1 style="font-family:var(--serif-en);font-weight:500;line-height:1.15;margin:0 0 10px;">
      <span class="body-en">Who is Mitsue-kun?</span>
      <span class="body-jp jp">みつえくんとは？</span>
    </h1>
    <div style="display:flex;justify-content:center;margin:28px 0;">
      <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/Mitsue-kun_16-removebg-preview.png' ); ?>"
           alt="御杖くん（みつえくん / Mitsue-kun）— プロジェクトのマスコット" style="height:220px;">
    </div>
  </div>
</section>

<section>
  <div class="wrap" style="max-width:68ch;">

    <div class="body-en" style="font-size:16px;line-height:1.75;">
      <p><strong>Mitsue-kun (みつえくん)</strong> is a character created by this project (not an official village mascot), released under a <strong>CC0 license</strong> so anyone can use him freely with no permission required. His partner is <strong>Tsuemi-chan</strong>, the official character of Mitsue Village — together the two work as a duo to help revitalize Mitsue Village, appearing in brochures, this website, and outreach materials as a warm, local embodiment of the project's guiding idea: <em>"The forest our ancestors planted — the power that sustains the village they built."</em></p>

      <h2>Design, explained</h2>
      <ul>
        <li><strong>The wooden staff (杖)</strong> he carries references the village's own name, 御杖村 (Mitsue-mura) — "Honorable Staff Village" — from a legend about a staff planted in the area.</li>
        <li><strong>The chisel/tool</strong> in his other hand represents hands-on forestry and woodworking — he's a village worker, not a passive symbol.</li>
        <li><strong>His work clothes</strong> are styled after traditional forestry wear, ready to head into the mountains — echoing the project's actual focus: thinning and tending Mitsue's forests to fuel a biomass power plant.</li>
        <li><strong>A small tulip motif</strong> is a quiet nod to the project's founder, Rob Oudendijk, from the Netherlands.</li>
      </ul>

      <p>The project turns neglected village forest into renewable energy (biomass CHP) and, longer-term, a village-owned AI data center that uses that power. Mitsue-kun gives that technical idea a warm, local identity.</p>
    </div>

    <div class="body-jp jp" style="font-size:16px;line-height:1.9;">
      <p><strong>みつえくん</strong>は村の公式マスコットではなく、このプロジェクトが独自に制作したキャラクターで、<strong>CC0ライセンス</strong>の下で公開されており誰でも許可なく自由に使用できます。パートナーは御杖村の公式キャラクターである<strong>つえみちゃん（Tsuemi-chan）</strong>で、二人が組んで御杖村を活性化するために働く存在として、パンフレットやこのウェブサイト、広報資料に登場し、このプロジェクトの理念——「先祖が植えた森。その森が、彼らが築いた村を支える力になる」——を体現しています。</p>

      <h2>デザインの意味</h2>
      <ul>
        <li>手にしている<strong>杖</strong>は、村名「御杖村（みつえむら）」そのものへの直接的な参照です。杖が立てられたという伝説に由来しています。</li>
        <li>もう一方の手に持つ<strong>のみ（工具）</strong>は、森林・木工の実作業を表しており、彼が単なる象徴ではなく、働く村人であることを示しています。</li>
        <li><strong>作業着</strong>は伝統的な林業の装いを模しており、これから山へ働きに行く姿を表現しています。</li>
        <li><strong>チューリップの意匠</strong>は、発起人ロブ・アウデンダイク（オランダ出身）への小さなオマージュです。</li>
      </ul>

      <p>本プロジェクトは、放置された村の森林を再生可能エネルギー（バイオマスCHP）に、そして将来的には村営AIデータセンターへとつなげる構想です。みつえくんは、この技術的な構想に身近で親しみやすいアイデンティティを与えてくれます。</p>
    </div>

    <p style="margin-top:32px;">
      <a class="cta-btn" href="https://codeberg.org/YR-Design/mitsue-ai-data-center/src/branch/main/mitsue_kun_mascot_explainer.md" target="_blank" rel="noopener">
        <span class="body-en">Full explainer &amp; assets ↗</span><span class="body-jp jp">解説・素材一式 ↗</span>
      </a>
      <a class="cta-btn" href="<?php echo esc_url(home_url('/')); ?>" style="background:transparent;">
        <span class="body-en">About the project</span><span class="body-jp jp">プロジェクトについて</span>
      </a>
    </p>

  </div>
</section>

</main>

<?php get_footer();
