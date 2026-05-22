<?php
$pillars = mitsue_rows('pillars', [
  ['num'=>'i',   'title_en'=>'Forest Restoration',    'title_jp'=>'森林再生 · Native broadleaf', 'body'=>"Phased replacement of aged sugi (cedar) plantations with native broadleaf species, with private landowners, the Forestry Agency (林野庁), and local contractors. Liability becomes timber revenue; thinning residue feeds the electrical system as a future biomass-to-electricity input.|The 25-year arc aligns to the ecological clock, not the funding cycle.", 'body_jp'=>'老齢化した杉の人工林を、私有林所有者・林野庁・地元事業者と連携しながら、段階的に在来広葉樹へと置き換えます。負債は用材収益へと転換し、間伐残材は将来のバイオマス発電燃料として、太陽光と同じ電力系統へ供給されます。|25年という時間軸は、資金サイクルではなく森林の生態的時計に合わせています。', 'tag'=>'Sugi → Broadleaf · 25-year cycle'],
  ['num'=>'ii',  'title_en'=>'EV Charging & Energy Resilience', 'title_jp'=>'EV充電・エネルギーレジリエンス · Solar + Battery', 'body'=>'Solar panels and battery storage at the school site supply clean local energy — powering the data center, providing EV charging for residents and visitors, and keeping critical facilities running during grid outages.|Aging rural distribution lines make blackouts a real and growing risk. Village-owned battery storage provides 12–48 hours of backup, independent of the national grid.|In a future phase, forest thinning residue may feed a small biomass-electric unit (gasifier or CHP) injecting into the same battery + EV bus — one unified electrical system, no separate thermal plant.', 'body_jp'=>'校舎の屋根に設置した太陽光パネルと蓄電池が、クリーンな地域エネルギーを供給します——データセンターの稼働、住民・来訪者向けEV充電、そして停電時の重要施設のバックアップ電源として。|老朽化した農村の配電線は、停電リスクを年々高めています。村所有の蓄電池は、国の送電網に依存せず12〜48時間のバックアップを提供します。|将来の段階では、森林の間伐残材を小型バイオマス発電装置（ガス化発電またはCHP）で電力化し、同じ蓄電池・EV系統へ統合する設計です。熱供給用ボイラーを別途設けない、一本化された電気系統です。', 'tag'=>'Solar · Battery · Biomass-electric · EV · Blackout resilience'],
  ['num'=>'iii', 'title_en'=>'Community Data Center', 'title_jp'=>'地域所有データセンター · Edge-scale', 'body'=>'The closed Mitsue Elementary School building, repurposed as a small-scale, energy-efficient edge-compute facility powered entirely by locally generated renewable energy.|Sized for accountability and community ownership — not hyperscale economics. Designed to be replicated by other depopulating municipalities.', 'tag'=>'Edge compute · Heat re-use · Replicable'],
]);
?>
<section id="programme">
  <div class="wrap">
    <div class="section-head">
      <div class="num">§ 01<span class="label">Programme</span>
        <?php $si = mitsue_get('section_img_programme'); if ($si): ?><img src="<?php echo esc_url($si); ?>" alt="" class="section-img"><?php endif; ?>
      </div>
      <div>
        <h2>Three integrated activities, <em>one coordinating body.</em></h2>
        <div class="h2-jp jp">三つの活動を、一つの運営体で。</div>
        <div class="h2-sub body-en">Forest restoration, locally generated renewable energy, and a small-scale community-owned data center — each reinforces the other and shares a common 25-year ledger of methods, data, and outcomes.</div>
        <div class="h2-sub body-jp jp">森林再生・地域発電・小規模地域所有データセンター——それぞれが互いを強化し合い、手法・データ・成果を共有する25年の台帳によって結ばれています。</div>
      </div>
    </div>

    <div class="pillars">
      <?php foreach ($pillars as $p): ?>
        <div class="pillar">
          <div class="num"><?php echo esc_html($p['num']); ?></div>
          <h3><?php echo esc_html($p['title_en']); ?></h3>
          <div class="h3-jp jp"><?php echo esc_html($p['title_jp']); ?></div>
          <div class="body-en">
            <?php foreach (explode('|', $p['body'] ?? '') as $para): ?>
              <p><?php echo wp_kses_post($para); ?></p>
            <?php endforeach; ?>
          </div>
          <?php if (!empty($p['body_jp'])): ?>
          <div class="body-jp jp">
            <?php foreach (explode('|', $p['body_jp']) as $para): ?>
              <p><?php echo wp_kses_post($para); ?></p>
            <?php endforeach; ?>
          </div>
          <?php endif; ?>
          <div class="tag"><?php echo esc_html($p['tag']); ?></div>
        </div>
      <?php endforeach; ?>
    </div>

    <div style="display:grid;grid-template-columns:1fr 1fr;border-top:1px solid var(--rule);">
      <div style="padding:36px 36px 0 0;border-right:1px solid var(--rule);">
        <div class="mono" style="color:var(--ink-mute);margin-bottom:14px;">§ 01.4 · EV Charging</div>
        <h4 style="font-family:var(--serif-en);font-weight:500;font-size:22px;margin:0 0 8px;">
          <span class="body-en">Distributed charging anchored to local generation</span>
          <span class="body-jp jp">地域発電と連動した分散型EV充電</span>
        </h4>
        <p style="color:var(--ink-soft);font-size:15px;line-height:1.7;">
          <span class="body-en">Charging infrastructure for residents and visitors, tied to on-site generation rather than waiting on capital-intensive grid extension. Within ten years, the majority of Japanese passenger vehicles are expected to be electric.</span>
          <span class="body-jp jp">居住者と来訪者向けの充電インフラを、資本集約的な系統延伸を待つのではなく、現地発電と連動して整備します。10年以内に、日本の乗用車の大半が電気自動車になると予測されています。</span>
        </p>
      </div>
      <div style="padding:36px 0 0 36px;">
        <div class="mono" style="color:var(--ink-mute);margin-bottom:14px;">§ 01.5 · Open Knowledge</div>
        <h4 style="font-family:var(--serif-en);font-weight:500;font-size:22px;margin:0 0 8px;">
          <span class="body-en">Documentation as a deliverable</span>
          <span class="body-jp jp">文書化を成果物として</span>
        </h4>
        <p style="color:var(--ink-soft);font-size:15px;line-height:1.7;">
          <span class="body-en">All methods, environmental data, financial records, and lessons learned are published under permissive open licences — Creative Commons for documents, appropriate open licences for data and code — so other communities may adapt the model.</span>
          <span class="body-jp jp">手法・環境データ・財務記録・学んだ教訓はすべて、オープンライセンス（文書はクリエイティブ・コモンズ、データ・コードは適切なオープンライセンス）のもとで公開します。他のコミュニティがモデルを適用できるようにするためです。</span>
        </p>
      </div>
    </div>
  </div>
</section>
