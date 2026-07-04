<?php
/**
 * Template Name: Join / Get Involved
 * "Get involved" hub — Work · Invest · Advise · Partner.
 * Content is editable in Dashboard → Settings → Mitsue Content → "Join Page" tab.
 * Create a Page in WP admin, set slug "join" (or "get-involved"), assign this template.
 * @package Mitsue
 */
get_header();

$ways = mitsue_rows('join_ways', [
  ['label_en'=>'🌲 Work','label_jp'=>'働く','sub'=>'Paid roles at the forestry co-op — forest, energy, data.','sub_jp'=>'森林組合の有給職——森・エネルギー・データ。','anchor'=>'#work'],
  ['label_en'=>'◆ Invest','label_jp'=>'出資する','sub'=>'Patient capital for a 25-year, non-profit build.','sub_jp'=>'25年・非営利の事業への長期資本。','anchor'=>'#invest'],
  ['label_en'=>'✎ Advise','label_jp'=>'助言する','sub'=>'Expertise in forestry, energy, compute, or governance.','sub_jp'=>'林業・エネルギー・計算・ガバナンスの知見。','anchor'=>'#advise'],
  ['label_en'=>'⌂ Partner','label_jp'=>'連携する','sub'=>'Companies, NGOs, landowners, and volunteers.','sub_jp'=>'企業・NGO・土地所有者・ボランティア。','anchor'=>'#partner'],
]);

$pillars = mitsue_rows('join_pillars', [
  ['num'=>'🌱 01','title_en'=>'Reforest','title_jp'=>'再生 · 生きた在来林を取り戻す','body'=>"Not \"cut trees\" — the opposite. Convert dark, lifeless sugi monoculture into living native broadleaf forest: oak and konara for wildlife forage, returning birds, insects and balance.|A multi-decade legacy you can walk through — the forest our ancestors planted for timber, remade into the forest we leave our descendants.",'body_jp'=>"「木を切る」のではなくその逆。杉一斉林を、生きた在来広葉樹林へ転換します。|実際に歩いて確かめられる数十年の遺産——先人が植えた森を、子孫に遺す森へ。",'tag'=>'For ecologists & conservationists'],
  ['num'=>'⚡ 02','title_en'=>'Power','title_jp'=>'動力 · エネルギーと村営データセンター','body'=>"The same forest work literally powers computation — biomass CHP, salt-battery storage, and a village-owned AI data center. Frontier technology, not analog forestry.",'body_jp'=>"同じ森の仕事が、計算資源を文字どおり動かします——バイオマスCHP、蓄熱、村営AIデータセンター。",'tag'=>'For technologists & engineers'],
  ['num'=>'🏡 03','title_en'=>'Revive','title_jp'=>'再建 · 未来のある村を取り戻す','body'=>"A depopulating mountain village given a genuine next chapter — jobs, families, energy self-sufficiency, disaster resilience.",'body_jp'=>"過疎の山村に本物の次章を——雇用、家族、エネルギー自給、防災。",'tag'=>'For U/I-turn returnees & families'],
]);

$stack = mitsue_rows('join_stack', [
  ['scheme'=>'緑の雇用 (Green Employment)','who'=>'林野庁 → the co-op','val'=>'Wage + ~3-yr OJT training subsidy for new forestry recruits','val_jp'=>'新規就業者の人件費＋約3年のOJT研修助成'],
  ['scheme'=>'地域おこし協力隊','who'=>'総務省 → via 御杖村','val'=>'~¥5.2M/yr (salary + activity), up to 3 yrs, + up to ¥1M startup grant','val_jp'=>'報償費＋活動費 約520万円/年、最長3年、＋起業支援最大100万円'],
  ['scheme'=>'移住支援金 (Relocation grant)','who'=>'国 + 県 + 町 → you','val'=>'Household up to ¥1M + up to ¥1M per child; single ¥0.6M','val_jp'=>'世帯 最大100万円＋子1人最大100万円／単身60万円'],
  ['scheme'=>'空き家バンク + housing','who'=>'御杖村','val'=>'Vacant-house match + renovation support','val_jp'=>'空き家マッチング＋改修支援'],
]);

$sections = mitsue_rows('join_sections', [
  ['id'=>'invest','num'=>'§ 03','label'=>'Invest','title_en'=>'Patient capital for a <em>25-year</em> build.','title_jp'=>'25年の事業への長期資本。','body'=>'The project is a non-profit (一般社団法人 → NPO) with a transparent, published budget and funding gates. We are assembling patient capital across a five-layer stack — founder, grants, foundations, corporate partnerships, and operating revenue. If your horizon matches ours, we welcome the conversation.','body_jp'=>'本事業は非営利（一般社団法人→NPO法人）であり、公開された予算と資金ゲートを持ちます。創業者・補助金・財団・企業連携・事業収益の五層構造で長期資本を組成しています。時間軸が一致するなら、ぜひご相談ください。','cta'=>'For investors','href'=>'/#funding'],
  ['id'=>'advise','num'=>'§ 04','label'=>'Advise','title_en'=>'Lend your <em>expertise.</em>','title_jp'=>'知見を貸してください。','body'=>'We are building an advisory board across forestry, distributed energy, edge compute, rural governance, and Japanese non-profit law. Advisors give occasional, high-leverage guidance — not day-to-day work. (Ray Ozzie confirmed, 2026.)','body_jp'=>'林業・分散型エネルギー・エッジコンピュート・農村ガバナンス・日本の非営利法にわたる顧問会を組成しています。顧問は日常業務ではなく、要所での助言をお願いするものです。（レイ・オジー就任確約、2026年）','cta'=>'','href'=>''],
  ['id'=>'partner','num'=>'§ 05','label'=>'Partner','title_en'=>'Companies, NGOs, landowners &amp; <em>volunteers.</em>','title_jp'=>'企業・NGO・土地所有者・ボランティア。','body'=>'Corporate partners (CSR-aligned), reforestation and J-Credit NGOs, forest landowners, and volunteers for tree-survey and eco-tourism activities. There are many ways to contribute time, land, or capability without relocating.','body_jp'=>'企業パートナー（CSR連携）、再植林・JクレジットのNGO、森林所有者、そして樹木調査・エコツーリズム活動のボランティア。移住せずとも、時間・土地・能力で貢献する方法が数多くあります。','cta'=>'','href'=>''],
]);
$email = mitsue_get('join_email', mitsue_get('cta_email', 'info@mitsue.it'));
?>

<main class="join">

<section class="hero" style="border-bottom:1px solid var(--rule);">
  <div class="wrap">
    <div class="mono" style="color:var(--ink-mute);margin-bottom:18px;"><?php echo esc_html( mitsue_get('join_eyebrow', 'Get involved') ); ?></div>
    <h1 style="font-family:var(--serif-en);font-weight:500;line-height:1.15;margin:0 0 10px;">
      <?php echo wp_kses_post( mitsue_get('join_headline_en', 'Rewild a mountain, power an AI data center, <em>and rebuild a village.</em>') ); ?>
    </h1>
    <div class="h2-jp jp" style="margin-bottom:20px;"><?php echo esc_html( mitsue_get('join_headline_jp', '山を再生し、AIデータセンターを動かし、村を再建する。') ); ?></div>
    <p class="body-en" style="max-width:60ch;color:var(--ink-soft);font-size:17px;line-height:1.7;"><?php echo esc_html( mitsue_get('join_lede_en', '') ); ?></p>
    <p class="body-jp jp" style="max-width:62ch;color:var(--ink-soft);font-size:17px;line-height:1.9;"><?php echo esc_html( mitsue_get('join_lede_jp', '') ); ?></p>

    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(210px,1fr));gap:14px;margin-top:32px;">
      <?php foreach ($ways as $w): ?>
      <a href="<?php echo esc_url($w['anchor'] ?? '#'); ?>" style="display:block;padding:18px 20px;border:1px solid var(--rule);border-radius:8px;text-decoration:none;color:inherit;">
        <div style="font-weight:600;font-size:17px;margin-bottom:6px;"><?php echo esc_html($w['label_en'] ?? ''); ?><span class="jp" style="margin-left:8px;color:var(--ink-mute);font-weight:400;"><?php echo esc_html($w['label_jp'] ?? ''); ?></span></div>
        <div class="body-en" style="color:var(--ink-soft);font-size:14px;line-height:1.55;"><?php echo esc_html($w['sub'] ?? ''); ?></div>
        <div class="body-jp jp" style="color:var(--ink-soft);font-size:14px;line-height:1.7;"><?php echo esc_html($w['sub_jp'] ?? ''); ?></div>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section id="work">
  <div class="wrap">
    <div class="section-head">
      <div class="num">§ 02<span class="label">Work</span></div>
      <div>
        <h2>Three things, <em>one job.</em></h2>
        <div class="h2-jp jp">三つのこと、ひとつの仕事。</div>
        <div class="h2-sub body-en"><?php echo esc_html( mitsue_get('join_work_intro_en', 'Paid, multi-skill roles at the Mitsue forestry cooperative. Most rural jobs offer one thread — this offers all three, woven together.') ); ?></div>
        <div class="h2-sub body-jp jp"><?php echo esc_html( mitsue_get('join_work_intro_jp', '御杖村森林組合の有給・多技能職。多くの地方の仕事は1本の糸しか提供しませんが、これは3本を編み合わせて提供します。') ); ?></div>
      </div>
    </div>
    <div class="pillars">
      <?php foreach ($pillars as $p): ?>
        <div class="pillar">
          <div class="num"><?php echo esc_html($p['num'] ?? ''); ?></div>
          <h3><?php echo esc_html($p['title_en'] ?? ''); ?></h3>
          <div class="h3-jp jp"><?php echo esc_html($p['title_jp'] ?? ''); ?></div>
          <div class="body-en">
            <?php foreach (explode('|', $p['body'] ?? '') as $para): ?><p><?php echo esc_html($para); ?></p><?php endforeach; ?>
          </div>
          <?php if (!empty($p['body_jp'])): ?>
          <div class="body-jp jp">
            <?php foreach (explode('|', $p['body_jp']) as $para): ?><p><?php echo esc_html($para); ?></p><?php endforeach; ?>
          </div>
          <?php endif; ?>
          <div class="tag"><?php echo esc_html($p['tag'] ?? ''); ?></div>
        </div>
      <?php endforeach; ?>
    </div>

    <div style="border-top:1px solid var(--rule);margin-top:8px;padding-top:28px;">
      <div class="mono" style="color:var(--ink-mute);margin-bottom:14px;">§ 02.1 · Relocation & training support</div>
      <p style="max-width:64ch;color:var(--ink-soft);margin:0 0 18px;">
        <span class="body-en">We've removed the reasons <em>not</em> to come. Japan's forestry and relocation grants stack; actual amounts depend on your situation and the year — we help you navigate them.</span>
        <span class="body-jp jp">移住しない理由を、すべて取り除きました。日本の林業・移住支援制度は積み上げられます。実際の金額は状況と年度で異なります——申請をお手伝いします。</span>
      </p>
      <div style="border-top:1px solid var(--rule);">
        <?php foreach ($stack as $s): ?>
        <div style="display:grid;grid-template-columns:minmax(180px,1fr) minmax(120px,0.8fr) 1.6fr;gap:16px;padding:14px 0;border-bottom:1px solid var(--rule);align-items:baseline;">
          <div style="font-weight:600;"><?php echo esc_html($s['scheme'] ?? ''); ?></div>
          <div class="mono" style="color:var(--ink-mute);font-size:13px;"><?php echo esc_html($s['who'] ?? ''); ?></div>
          <div style="color:var(--ink-soft);">
            <span class="body-en"><?php echo esc_html($s['val'] ?? ''); ?></span>
            <span class="body-jp jp"><?php echo esc_html($s['val_jp'] ?? ''); ?></span>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
      <p style="margin-top:16px;color:var(--ink-mute);font-size:14px;">
        <span class="body-en"><?php echo esc_html( mitsue_get('join_stack_note_en', 'The grants get you to parity. The mission is the reason to come — and the reason to stay.') ); ?></span>
        <span class="body-jp jp"><?php echo esc_html( mitsue_get('join_stack_note_jp', '補助金は「並び」に到達させ、使命こそが来る理由、そして留まる理由です。') ); ?></span>
      </p>
    </div>
  </div>
</section>

<?php foreach ($sections as $sec): ?>
<section id="<?php echo esc_attr($sec['id'] ?? ''); ?>" style="border-top:1px solid var(--rule);">
  <div class="wrap">
    <div class="section-head">
      <div class="num"><?php echo esc_html($sec['num'] ?? ''); ?><span class="label"><?php echo esc_html($sec['label'] ?? ''); ?></span></div>
      <div>
        <h2><?php echo wp_kses_post($sec['title_en'] ?? ''); ?></h2>
        <div class="h2-jp jp"><?php echo esc_html($sec['title_jp'] ?? ''); ?></div>
        <div class="h2-sub body-en"><?php foreach (explode('|', $sec['body'] ?? '') as $para): ?><p><?php echo esc_html($para); ?></p><?php endforeach; ?></div>
        <div class="h2-sub body-jp jp"><?php foreach (explode('|', $sec['body_jp'] ?? '') as $para): ?><p><?php echo esc_html($para); ?></p><?php endforeach; ?></div>
        <?php if (!empty($sec['cta']) && !empty($sec['href'])): ?>
        <p style="margin-top:16px;"><a class="cta-btn" href="<?php echo esc_url($sec['href']); ?>"><?php echo esc_html($sec['cta']); ?></a></p>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>
<?php endforeach; ?>

<section class="cta" id="contact">
  <div class="wrap">
    <h2 style="color:inherit;">
      <span class="body-en"><?php echo esc_html( mitsue_get('join_cta_head_en', 'Want to build this with us?') ); ?></span>
      <span class="body-jp jp"><?php echo esc_html( mitsue_get('join_cta_head_jp', '一緒に築きませんか？') ); ?></span>
    </h2>
    <p style="max-width:52ch;margin:10px auto 24px;">
      <span class="body-en"><?php echo esc_html( mitsue_get('join_cta_body_en', 'Tell us which way pulls you — work, invest, advise, or partner — and where you\'re coming from.') ); ?></span>
      <span class="body-jp jp"><?php echo esc_html( mitsue_get('join_cta_body_jp', 'どの形で関わりたいか（働く・出資・助言・連携）と、今どちらにお住まいかをお知らせください。') ); ?></span>
    </p>
    <div class="cta-contact-row">
      <a class="cta-btn" href="mailto:<?php echo esc_attr( antispambot( $email ) ); ?>?subject=Get%20involved%20%E2%80%94%20Mitsue%20Project">
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
