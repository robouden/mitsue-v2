<?php
$pillars = mitsue_rows('pillars', [
  ['num'=>'i',   'title_en'=>'Forest Restoration',    'title_jp'=>'森林再生 · Native broadleaf', 'body'=>"Phased replacement of aged sugi (cedar) plantations with native broadleaf species, with private landowners, the Forestry Agency (林野庁), and local contractors. Liability becomes feedstock and timber revenue.|The 25-year arc aligns to the ecological clock, not the funding cycle.", 'tag'=>'Sugi → Broadleaf · 25-year cycle'],
  ['num'=>'ii',  'title_en'=>'Sustainable Energy',    'title_jp'=>'再生可能エネルギー · Thermal first', 'body'=>'Biomass and biogas generation from sustainably harvested forest material — sized for village load, EV charging, and greenhouse heat.|Thermal first, electrical second. A boiler with heat recovery costs roughly one-third of a CHP unit and runs several times more efficiently.', 'tag'=>'Biomass · Solar · Grid backup'],
  ['num'=>'iii', 'title_en'=>'Community Data Center', 'title_jp'=>'地域所有データセンター · Edge-scale', 'body'=>'The closed Mitsue Elementary School building, repurposed as a small-scale, energy-efficient edge-compute facility powered entirely by locally generated renewable energy.|Sized for accountability and community ownership — not hyperscale economics. Designed to be replicated by other depopulating municipalities.', 'tag'=>'Edge compute · Heat re-use · Replicable'],
]);
?>
<section id="programme">
  <div class="wrap">
    <div class="section-head">
      <div class="num">§ 01<span class="label">Programme</span></div>
      <div>
        <h2>Three integrated activities, <em>one coordinating body.</em></h2>
        <div class="h2-jp jp">三つの活動を、一つの運営体で。</div>
        <div class="h2-sub">Forest restoration, locally generated renewable energy, and a small-scale community-owned data center — each reinforces the other and shares a common 25-year ledger of methods, data, and outcomes.</div>
      </div>
    </div>

    <div class="pillars">
      <?php foreach ($pillars as $p): ?>
        <div class="pillar">
          <div class="num"><?php echo esc_html($p['num']); ?></div>
          <h3><?php echo esc_html($p['title_en']); ?></h3>
          <div class="h3-jp jp"><?php echo esc_html($p['title_jp']); ?></div>
          <?php foreach (explode('|', $p['body']) as $para): ?>
            <p><?php echo wp_kses_post($para); ?></p>
          <?php endforeach; ?>
          <div class="tag"><?php echo esc_html($p['tag']); ?></div>
        </div>
      <?php endforeach; ?>
    </div>

    <div style="display:grid;grid-template-columns:1fr 1fr;border-top:1px solid var(--rule);">
      <div style="padding:36px 36px 0 0;border-right:1px solid var(--rule);">
        <div class="mono" style="color:var(--ink-mute);margin-bottom:14px;">§ 01.4 · EV Charging</div>
        <h4 style="font-family:var(--serif-en);font-weight:500;font-size:22px;margin:0 0 8px;">Distributed charging anchored to local generation</h4>
        <p style="color:var(--ink-soft);font-size:15px;line-height:1.7;">Charging infrastructure for residents and visitors, tied to on-site generation rather than waiting on capital-intensive grid extension. Within ten years, the majority of Japanese passenger vehicles are expected to be electric.</p>
      </div>
      <div style="padding:36px 0 0 36px;">
        <div class="mono" style="color:var(--ink-mute);margin-bottom:14px;">§ 01.5 · Open Knowledge</div>
        <h4 style="font-family:var(--serif-en);font-weight:500;font-size:22px;margin:0 0 8px;">Documentation as a deliverable</h4>
        <p style="color:var(--ink-soft);font-size:15px;line-height:1.7;">All methods, environmental data, financial records, and lessons learned are published under permissive open licences — Creative Commons for documents, appropriate open licences for data and code — so other communities may adapt the model.</p>
      </div>
    </div>
  </div>
</section>
