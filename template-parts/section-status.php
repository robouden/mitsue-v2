<?php
$completed = mitsue_rows('status_completed', [
  ['t'=>'Initial meeting with Vice Mayor of Mitsue (late 2025)'],
  ['t'=>'Initial meeting with the local forestry group (early 2026)'],
  ['t'=>'Drafted founding charter and detailed implementation plan'],
  ['t'=>'Phase &amp; funding-gate flowchart published'],
  ['t'=>'Advisory commitments: Joi Ito and Ray Ozzie'],
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
      <div class="num">§ 07<span class="label">Current Status</span></div>
      <div>
        <h2>Where the project stands today, <em>May 2026.</em></h2>
        <div class="h2-jp jp">現在の進捗 — 2026年5月時点</div>
        <div class="h2-sub">Phase 0 is intentionally quiet: no public announcements, no press, no website launch. The work is local trust-building, founding-team formation, and clean drafting of the charter.</div>
      </div>
    </div>
    <div class="status-wrap">
      <div class="status-meta">
        <div class="badge"><span class="pulse"></span> PHASE 0 · IN PROGRESS</div>
        <h3>Pre-Foundation</h3>
        <div class="sub">準備期 · Months 01 – 03</div>
        <div class="period">SELF-FUNDED · ¥0–0.5M</div>
        <p style="margin-top:24px;font-size:14px;color:var(--ink-soft);line-height:1.7;">No public announcements yet. Formal channels — website, dedicated email, NPO bank account — will be established at the start of Phase 1.</p>
      </div>
      <div class="status-cols">
        <div class="status-col">
          <h6>COMPLETED</h6>
          <ul>
            <?php foreach ($completed as $i): ?><li class="done"><?php echo wp_kses_post($i['t']); ?></li><?php endforeach; ?>
          </ul>
        </div>
        <div class="status-col">
          <h6>IN PROGRESS</h6>
          <ul>
            <?php foreach ($progress as $i): ?><li class="prog"><?php echo wp_kses_post($i['t']); ?></li><?php endforeach; ?>
          </ul>
        </div>
        <div class="status-col">
          <h6>NEXT 30 DAYS</h6>
          <ul>
            <?php foreach ($next as $i): ?><li class="next"><?php echo wp_kses_post($i['t']); ?></li><?php endforeach; ?>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>
