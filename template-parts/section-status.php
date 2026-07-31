<?php
$completed = mitsue_rows('status_completed', [
  ['t'=>'Initial meeting with Vice Mayor of Mitsue (late 2025)'],
  ['t'=>'Initial meeting with the local forestry group (early 2026)'],
  ['t'=>'Drafted founding charter and detailed implementation plan'],
  ['t'=>'Phase &amp; funding-gate flowchart published'],
  ['t'=>'Advisory commitments: Joi Ito, Ray Ozzie, Takuo Dome, Henry Takata, ElvinZoet and Yoshiko Zoet-Susuki', 't_jp'=>"顧問就任の確約：伊藤穰一・レイ・オジー・堂目卓生・ヘンリー・タカタ・エヴィン・ズート・\r\nヨシコ・ズート鈴木"],
  ['t'=>'Created Mitsue-kun, the project mascot — <a class="status-mascot-link" href="https://codeberg.org/YR-Design/mitsue-ai-data-center/src/branch/main/mitsue_kun_mascot_explainer.md#english" target="_blank" rel="noopener"><img src="'.esc_url( get_template_directory_uri() . '/assets/images/Mitsue-kun_16-removebg-preview.png' ).'" alt="Mitsue-kun" class="status-mascot-img">who is he? ↗</a>', 't_jp'=>'プロジェクトのマスコット「みつえくん」を制作 — <a class="status-mascot-link" href="https://codeberg.org/YR-Design/mitsue-ai-data-center/src/branch/main/mitsue_kun_mascot_explainer.md#%E6%97%A5%E6%9C%AC%E8%AA%9E" target="_blank" rel="noopener"><img src="'.esc_url( get_template_directory_uri() . '/assets/images/Mitsue-kun_16-removebg-preview.png' ).'" alt="みつえくん" class="status-mascot-img">みつえくんとは？↗</a>'],
]);
$progress = mitsue_rows('status_progress', [
  ['t'=>'Identifying a Japanese co-founder with rural credibility'],
  ['t'=>'Scheduling a formal meeting with the Village Mayor'],
  ['t'=>'Drafting bylaws for a 一般社団法人'],
  ['t'=>'Engaging a 行政書士 (administrative scrivener) in Nara'],
]);
$next = mitsue_rows('status_next', [
  ['t'=>'Approach candidate Japanese co-founder'],
  ['t'=>'Hold informal meeting with the Village Mayor'],
  ['t'=>'Initial consultations with administrative scriveners'],
  ['t'=>'Finalise a two-page bilingual charter for distribution'],
]);
?>
<section id="status" style="background:var(--paper);">
  <div class="wrap">
    <div class="section-head">
      <div class="num">§ 07<span class="label">Current Status</span>
        <?php $si = mitsue_get('section_img_status'); if ($si): ?><img src="<?php echo esc_url($si); ?>" alt="" class="section-img"><?php endif; ?>
      </div>
      <div>
        <h2>Where the project stands today, <em><?php echo date('F Y'); ?>.</em></h2>
        <div class="h2-jp jp">現在の進捗 — <?php echo date('Y'); ?>年<?php echo date('n'); ?>月時点</div>
        <div class="h2-sub body-en">Phase 0 is intentionally quiet: no public announcements, no press. The work is local trust-building, founding-team formation, and clean drafting of the charter.</div>
        <div class="h2-sub body-jp jp">フェーズ0は意図的に静かに進めています。公式発表なし、プレスなし。取り組みの中心は、地域との信頼構築、創設チームの形成、そして定款の丁寧な草案作成です。</div>
      </div>
    </div>
    <div class="status-wrap">
      <div class="status-meta">
        <div class="badge"><span class="pulse"></span> PHASE 0 · IN PROGRESS</div>
        <h3>Pre-Foundation</h3>
        <div class="sub">準備期 · 2026年4月〜10月</div>
        <div class="period">SELF-FUNDED · ¥0–0.5M</div>
        <p style="margin-top:24px;font-size:14px;color:var(--ink-soft);line-height:1.7;">
          <span class="body-en">No public announcements yet. Formal channels — dedicated email, NPO bank account — will be established at the start of Phase 1.</span>
          <span class="body-jp jp">現時点では公式発表はありません。専用メール・NPO口座などの正式チャネルは、フェーズ1開始時に整備されます。</span>
        </p>
      </div>
      <div class="status-cols">
        <div class="status-col">
          <h6>COMPLETED</h6>
          <ul>
            <?php foreach ($completed as $i): ?>
              <li class="done">
                <span class="body-en"><?php echo wp_kses_post($i['t']); ?></span>
                <?php if (!empty($i['t_jp'])): ?><span class="body-jp jp"><?php echo wp_kses_post($i['t_jp']); ?></span><?php endif; ?>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>
        <div class="status-col">
          <h6>IN PROGRESS</h6>
          <ul>
            <?php foreach ($progress as $i): ?>
              <li class="prog">
                <span class="body-en"><?php echo wp_kses_post($i['t']); ?></span>
                <?php if (!empty($i['t_jp'])): ?><span class="body-jp jp"><?php echo wp_kses_post($i['t_jp']); ?></span><?php endif; ?>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>
        <div class="status-col">
          <h6>NEXT 30 DAYS</h6>
          <ul>
            <?php foreach ($next as $i): ?>
              <li class="next">
                <span class="body-en"><?php echo wp_kses_post($i['t']); ?></span>
                <?php if (!empty($i['t_jp'])): ?><span class="body-jp jp"><?php echo wp_kses_post($i['t_jp']); ?></span><?php endif; ?>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>
