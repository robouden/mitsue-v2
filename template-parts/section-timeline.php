<?php
$phases = mitsue_rows('phases', [
  ['name'=>'Phase 0 — Current','title'=>'Pre-Foundation',  'jp'=>'準備期',         'months'=>'Months 01 – 03','note'=>'Local trust-building, founding team, draft charter.','budget'=>'¥0 – 0.5M',  'extra'=>'self-funded','current'=>'1'],
  ['name'=>'Phase 1',          'title'=>'Foundation',      'jp'=>'基盤構築期',     'months'=>'Months 04 – 09','note'=>'Legal entity, feasibility studies, advisors.',       'budget'=>'¥3 – 8M',    'extra'=>'','current'=>'0'],
  ['name'=>'Phase 2',          'title'=>'Pilot Design',    'jp'=>'パイロット設計期','months'=>'Months 10 – 18','note'=>'Engineering, partnerships, permits.',               'budget'=>'¥15 – 30M',  'extra'=>'','current'=>'0'],
  ['name'=>'Phase 3',          'title'=>'Pilot Build',     'jp'=>'パイロット建設期','months'=>'Months 19 – 30','note'=>'First-stage construction, commissioning.',          'budget'=>'¥80 – 200M', 'extra'=>'','current'=>'0'],
  ['name'=>'Phase 4',          'title'=>'Operate &amp; Scale','jp'=>'運営・拡張期','months'=>'Months 31 +',   'note'=>'Operations, monitoring, replication.',              'budget'=>'Revenue-led', 'extra'=>'','current'=>'0'],
]);
$gates = mitsue_rows('gates', [
  ['n'=>'G1','v'=>'¥3 – 8M',       'note'=>'Foundation gate'],
  ['n'=>'G2','v'=>'¥30 – 50M',     'note'=>'Design gate'],
  ['n'=>'G3','v'=>'¥80 – 200M',    'note'=>'Build gate'],
  ['n'=>'G4','v'=>'Revenue online', 'note'=>'Operating gate'],
]);
?>
<section id="timeline">
  <div class="wrap">
    <div class="section-head">
      <div class="num">§ 03<span class="label">Phased Plan</span></div>
      <div>
        <h2>Five phases, <em>four explicit gates.</em></h2>
        <div class="h2-jp jp">五段階・四つの資金ゲート</div>
        <div class="h2-sub body-en">Each phase is gated by a funding checkpoint. Failure to clear a gate triggers a hold-and-re-pitch cycle rather than acceleration into an under-resourced phase. Patient capital, deliberately staged.</div>
        <div class="h2-sub body-jp jp">各フェーズは資金チェックポイントによってゲート管理されています。ゲートを通過できない場合は、資金不足のまま次フェーズへ進むのではなく、保留・再提案サイクルに移行します。忍耐強い資本、意図的な段階化。</div>
      </div>
    </div>
    <div class="timeline">
      <div class="timeline-grid">
        <?php foreach ($phases as $ph): $is_current = !empty($ph['current']) && $ph['current'] !== '0'; ?>
          <div class="tphase<?php echo $is_current ? ' current' : ''; ?>">
            <div class="pname<?php echo $is_current ? ' current' : ''; ?>"><?php echo esc_html($ph['name']); ?></div>
            <h5><?php echo wp_kses_post($ph['title']); ?></h5>
            <div class="pjp jp"><?php echo esc_html($ph['jp']); ?></div>
            <div class="pmonths"><?php echo esc_html($ph['months']); ?></div>
            <div class="pbudget">
              <span class="body-en"><?php echo esc_html($ph['note']); ?></span>
              <?php if (!empty($ph['note_jp'])): ?><span class="body-jp jp"><?php echo esc_html($ph['note_jp']); ?></span><?php endif; ?>
              <br><strong><?php echo esc_html($ph['budget']); ?></strong><?php if (!empty($ph['extra'])) echo ' · ' . esc_html($ph['extra']); ?>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
      <div class="gates">
        <?php foreach ($gates as $g): ?>
          <div class="gate">
            <span class="gnum"><?php echo esc_html($g['n']); ?></span>
            <span class="gval"><?php echo esc_html($g['v']); ?><span class="gnote"><?php echo esc_html($g['note']); ?></span></span>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>
