<?php
/**
 * Template Name: Join / Recruitment
 * Recruitment landing page — Mitsue Kanko workforce (reforest · power · revive)
 * Create a Page in WP admin, set slug "join", assign this template.
 * @package Mitsue
 */
get_header();

$pillars = [
  ['num'=>'01','emoji'=>'🌱','title_en'=>'Reforest','title_jp'=>'再生 · 生きた在来林を取り戻す',
   'body'=>"Not \"cut trees\" — the opposite. Convert dark, lifeless sugi monoculture into living native broadleaf forest: oak and konara for wildlife forage, returning birds, insects and balance, protecting watersheds and reducing landslide risk.|A multi-decade legacy you can walk through — the forest our ancestors planted for timber, remade into the forest we leave our descendants.",
   'body_jp'=>"「木を切る」のではなくその逆。暗く生命の乏しい杉一斉林を、生きた在来広葉樹林へ転換します。コナラ・クヌギで野生動物の餌を確保し、鳥や昆虫、生態系の均衡を取り戻し、水源を守り土砂災害リスクを下げます。|実際に歩いて確かめられる数十年の遺産——先人が木材のために植えた森を、子孫に遺す森へ。",
   'tag'=>'For ecologists & conservationists'],
  ['num'=>'02','emoji'=>'⚡','title_en'=>'Power','title_jp'=>'動力 · エネルギーと村営データセンター',
   'body'=>"The same forest work literally powers computation — biomass CHP, salt-battery storage, and a village-owned AI data center. Frontier technology, not analog forestry.|You can stand in the forest you replanted and point at the servers it runs.",
   'body_jp'=>"同じ森の仕事が、計算資源を文字どおり動かします——バイオマスCHP、ソルトバッテリー蓄熱、村営AIデータセンター。アナログな林業ではなく、最先端の技術です。|自分が植え直した森に立ち、それが動かすサーバーを指さすことができます。",
   'tag'=>'For technologists & engineers'],
  ['num'=>'03','emoji'=>'🏡','title_en'=>'Revive','title_jp'=>'再建 · 未来のある村を取り戻す',
   'body'=>"A depopulating mountain village given a genuine next chapter — jobs, families, energy self-sufficiency, disaster resilience. Rural life with a future, not nostalgia.",
   'body_jp'=>"過疎の山村に本物の次章を——雇用、家族、エネルギー自給、防災。郷愁ではなく、未来のある地方生活です。",
   'tag'=>'For U/I-turn returnees & families'],
];

$stack = [
  ['scheme'=>'緑の雇用 (Green Employment)','who'=>'林野庁 → the co-op','val'=>'Wage + ~3-yr OJT training subsidy for new forestry recruits','val_jp'=>'新規就業者の人件費＋約3年のOJT研修助成'],
  ['scheme'=>'地域おこし協力隊','who'=>'総務省 → via 御杖村','val'=>'~¥5.2M/yr (salary + activity), up to 3 yrs, + up to ¥1M startup grant','val_jp'=>'報償費＋活動費 約520万円/年、最長3年、＋起業支援最大100万円'],
  ['scheme'=>'移住支援金 (Relocation grant)','who'=>'国 + 県 + 町 → you','val'=>'Household up to ¥1M + up to ¥1M per child; single ¥0.6M','val_jp'=>'世帯 最大100万円＋子1人最大100万円／単身60万円'],
  ['scheme'=>'空き家バンク + housing','who'=>'御杖村','val'=>'Vacant-house match + renovation support','val_jp'=>'空き家マッチング＋改修支援'],
];
?>

<main class="join">

<section class="hero" style="border-bottom:1px solid var(--rule);">
  <div class="wrap">
    <div class="mono" style="color:var(--ink-mute);margin-bottom:18px;">Careers · 御杖村森林組合 × Mitsue Project</div>
    <h1 style="font-family:var(--serif-en);font-weight:500;line-height:1.15;margin:0 0 10px;">
      Rewild a mountain, power an AI data center,<br><em>and rebuild a village.</em>
    </h1>
    <div class="h2-jp jp" style="margin-bottom:20px;">山を再生し、AIデータセンターを動かし、村を再建する。</div>
    <p class="body-en" style="max-width:56ch;color:var(--ink-soft);font-size:17px;line-height:1.7;">
      One job, one place, one 25-year story. We are growing the Mitsue forestry cooperative to
      restore native forest and power a community-owned data center — and we are looking for people
      who want to build it.
    </p>
    <p class="body-jp jp" style="max-width:60ch;color:var(--ink-soft);font-size:17px;line-height:1.9;">
      ひとつの仕事、ひとつの場所、25年の物語。私たちは御杖村森林組合を拡大し、在来林を再生して
      地域所有のデータセンターを動かします——それを共に築く仲間を探しています。
    </p>
  </div>
</section>

<section>
  <div class="wrap">
    <div class="section-head">
      <div class="num">§ 01<span class="label">The Work</span></div>
      <div>
        <h2>Three things, <em>one job.</em></h2>
        <div class="h2-jp jp">三つのこと、ひとつの仕事。</div>
        <div class="h2-sub body-en">Most rural jobs offer one thread. This offers all three, woven together — and each pillar draws a different kind of person.</div>
        <div class="h2-sub body-jp jp">多くの地方の仕事は1本の糸しか提供しません。これは3本を編み合わせて提供します——各柱が異なる層に届きます。</div>
      </div>
    </div>
    <div class="pillars">
      <?php foreach ($pillars as $p): ?>
        <div class="pillar">
          <div class="num"><?php echo esc_html($p['emoji'] . ' ' . $p['num']); ?></div>
          <h3><?php echo esc_html($p['title_en']); ?></h3>
          <div class="h3-jp jp"><?php echo esc_html($p['title_jp']); ?></div>
          <div class="body-en">
            <?php foreach (explode('|', $p['body']) as $para): ?><p><?php echo esc_html($para); ?></p><?php endforeach; ?>
          </div>
          <div class="body-jp jp">
            <?php foreach (explode('|', $p['body_jp']) as $para): ?><p><?php echo esc_html($para); ?></p><?php endforeach; ?>
          </div>
          <div class="tag"><?php echo esc_html($p['tag']); ?></div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section style="background:var(--paper-2, #f7f6f2);border-top:1px solid var(--rule);">
  <div class="wrap">
    <div class="section-head">
      <div class="num">§ 02<span class="label">Support</span></div>
      <div>
        <h2>We've removed the reasons <em>not</em> to come.</h2>
        <div class="h2-jp jp">移住しない理由を、すべて取り除きました。</div>
        <div class="h2-sub body-en">Japan's forestry and relocation grants stack. Actual amounts depend on your situation and the year — we help you navigate them.</div>
        <div class="h2-sub body-jp jp">日本の林業・移住支援制度は積み上げられます。実際の金額は状況と年度により異なります——申請をお手伝いします。</div>
      </div>
    </div>
    <div style="border-top:1px solid var(--rule);">
      <?php foreach ($stack as $s): ?>
      <div style="display:grid;grid-template-columns:minmax(180px,1fr) minmax(120px,0.8fr) 1.6fr;gap:16px;padding:16px 0;border-bottom:1px solid var(--rule);align-items:baseline;">
        <div style="font-weight:600;"><?php echo esc_html($s['scheme']); ?></div>
        <div class="mono" style="color:var(--ink-mute);font-size:13px;"><?php echo esc_html($s['who']); ?></div>
        <div style="color:var(--ink-soft);">
          <span class="body-en"><?php echo esc_html($s['val']); ?></span>
          <span class="body-jp jp"><?php echo esc_html($s['val_jp']); ?></span>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
    <p style="margin-top:18px;color:var(--ink-mute);font-size:14px;">
      <span class="body-en">The grants get you to parity. The mission is the reason to come — and the reason to stay.</span>
      <span class="body-jp jp">補助金は「並び」に到達させ、使命こそが来る理由、そして留まる理由です。</span>
    </p>
  </div>
</section>

<section class="cta" id="contact">
  <div class="wrap">
    <h2 style="color:inherit;">
      <span class="body-en">Want to build this with us?</span>
      <span class="body-jp jp">一緒に築きませんか？</span>
    </h2>
    <p style="max-width:52ch;margin:10px auto 24px;">
      <span class="body-en">Tell us which pillar pulls you — forest, energy, or village — and where you're coming from. No forestry experience required; curiosity and commitment matter more.</span>
      <span class="body-jp jp">どの柱に惹かれるか（森・エネルギー・村）と、今どちらにお住まいかをお知らせください。林業経験は不問です。好奇心と覚悟を重視します。</span>
    </p>
    <div class="cta-contact-row">
      <a class="cta-btn" href="mailto:<?php echo esc_attr( antispambot( get_theme_mod('mitsue_contact_email', 'info@mitsue.it') ) ); ?>?subject=Join%20Mitsue%20%E2%80%94%20Reforest%20/%20Power%20/%20Revive">
        <?php echo esc_html( get_theme_mod('mitsue_join_cta', 'Email us') ); ?>
      </a>
      <a class="cta-btn" href="<?php echo esc_url(home_url('/')); ?>" style="background:transparent;">
        <span class="body-en">About the project</span><span class="body-jp jp">プロジェクトについて</span>
      </a>
    </div>
  </div>
</section>

</main>

<?php get_footer();
