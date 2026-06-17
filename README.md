# Mitsue v2 — WordPress Theme

Custom WordPress theme for the [Mitsue Village Project](https://mitsue.it) (御杖プロジェクト) — a 25-year rural revitalization initiative in Nara Prefecture, Japan.

The theme is a single-page presentation site with full EN/JP bilingual switching. It requires **no plugins** for content management — all content is stored natively in the WordPress database and edited through a built-in settings page and the WordPress Customizer.

---

## Requirements

- WordPress 6.x
- PHP 8.x
- No ACF, no page builders, no additional plugins required

---

## Installation

1. Copy the `mitsue-v2` folder into `wp-content/themes/`
2. Go to **Appearance → Themes** and activate **Mitsue v2**
3. Visit **Settings → Mitsue Content** — all fields will be pre-filled with default content

---

## Editing content

All front-page content is edited in two places in the WordPress admin.

### Settings → Mitsue Content

The main content editor. Ten tabs, each covering one section of the page:

| Tab | What you edit |
|-----|--------------|
| **Hero** | Main headline (EN + JP), intro paragraph (EN + JP), four stat boxes |
| **Programme** | Three programme pillars — title, body text, footer tag (EN + JP) |
| **Imagery** | Left and right image URLs (paste from Media Library or use the picker) |
| **Rationale** | Four rationale items — eyebrow, title, body (EN + JP) |
| **Timeline** | Five phases — title, months, note, budget (EN + JP); four funding gates |
| **Governance** | Advisory board bios, founding members list, legal structure path |
| **Funding** | Funding stack rows — source, description, Year 1 / Year 3 targets (EN + JP) |
| **Principles** | Six operating principles — title, body (EN + JP) |
| **Status** | Completed / In progress / Next 30 days lists (EN + JP) |
| **CTA** | Contact section — intro paragraph (EN + JP), lead name, email, document URLs |

**Repeater fields** (Programme, Rationale, Timeline, etc.) have an **+ Add row** button at the bottom of the table and a **✕ Remove** button on each row.

**Image fields** have a **Choose image** button that opens the WordPress Media Library picker.

**Body fields** with a `(separate paragraphs with |)` label accept multiple paragraphs separated by a pipe character, e.g.:
```
First paragraph text.|Second paragraph text.|Third paragraph text.
```

### Appearance → Customize

Two panels for visual and branding settings:

**Mitsue — Brand & Identity**
- Logo mark character (default: 御)
- Japanese logo text
- Navigation CTA button label
- Utility bar texts (phase, location, horizon)
- Footer tagline

**Mitsue — Colours**
- Eight colour tokens with live preview (background, ink, accent, clay, paper, etc.)
- Accent colours accept any CSS colour value: hex, `hsl()`, or `oklch()`

---

## EN / JP language switching

The toggle in the navigation bar switches between English and Japanese. The preference is saved in the browser (`localStorage`) so it persists across visits.

**How the two modes differ:**

- **Headings and short labels** — both languages are always present in the HTML. The inactive language is displayed smaller and muted. This is intentional — it creates a bilingual typographic texture.
- **Body paragraphs and longer text** — only the active language is shown. The inactive language is hidden with `display:none`.

In the content editor, every body field has a matching `… JP` column next to it. Leave the JP field empty and only the EN text will show in both modes.

---

## File structure

```
mitsue-v2/
├── style.css                        # All styles + design tokens + EN/JP switching rules
├── functions.php                    # Theme bootstrap, mitsue_get(), mitsue_rows()
├── front-page.php                   # Loads all section template parts
├── header.php                       # Nav, logo, utility bar, lang toggle
├── footer.php                       # Footer grid, EN/JP toggle JS
├── index.php                        # Fallback
├── assets/
│   ├── admin.css                    # Settings page styles
│   ├── admin.js                     # Repeater add/remove rows, media picker
│   ├── nav.js                       # Mobile hamburger menu toggle
│   └── lightbox.js                  # Image lightbox
├── inc/
│   ├── class-mitsue-admin-page.php  # Settings page — field schema + render
│   ├── class-mitsue-customizer.php  # Customizer panels — colours + brand
│   └── class-mitsue-dynamic-css.php # Generates :root{} CSS vars from Customizer
└── template-parts/
    ├── section-hero.php
    ├── section-programme.php
    ├── section-imagery.php
    ├── section-rationale.php
    ├── section-timeline.php
    ├── section-governance.php
    ├── section-funding.php
    ├── section-principles.php
    ├── section-status.php
    └── section-cta.php
```

---

## Deploying updates (mitsue.it VPS)

The live site runs on a VPS at `80.208.225.44`. WP-CLI is available.

**Push theme file changes:**
```bash
rsync -av --delete \
  --exclude='.git' --exclude='.gitignore' --exclude='.entire' --exclude='.omc' \
  "/path/to/mitsue-v2/" \
  root@80.208.225.44:/home/mitsue.it/public_html/wp-content/themes/mitsue-v2/
```
> **Never** sync `.git`/`.gitignore` into the webroot — they are publicly
> downloadable and leak source + history. The excludes above prevent this; the
> server `.htaccess` also denies `.git/.hg/.svn/.bzr` as defense-in-depth.

**Push content data** (after editing `build-updraft.py`):
```bash
cd "/path/to/project"
python3 - <<'PYEOF' | ssh root@80.208.225.44 \
  "wp --path=/home/mitsue.it/public_html --allow-root option update mitsue_options --format=json"
import json
exec(open('build-updraft.py').read().split('def theme_mods_v2')[0].replace('#!/usr/bin/env python3',''))
print(json.dumps(mitsue_options(), ensure_ascii=False))
PYEOF
```

**Flush cache** (always run after any theme or content change):
```bash
ssh root@80.208.225.44 \
  "wp --path=/home/mitsue.it/public_html --allow-root cache flush && \
   rm -rf /home/mitsue.it/public_html/wp-content/cache/wpo-cache/ && \
   rm -rf /home/mitsue.it/public_html/wp-content/cache/wpo-minify/"
```

> **Note:** WP-Optimize is active and caches full HTML pages to disk. Logged-in users bypass the cache; logged-out visitors (the public) get the cached file. Always delete both `wpo-cache` and `wpo-minify` after deploying, or changes will be invisible to non-logged-in visitors.

---

## Repositories

- GitHub: https://github.com/robouden/mitsue-v2
- Codeberg: https://codeberg.org/YR-Design/mitsue-v2

---

## Licence

Theme code: [MIT](https://opensource.org/licenses/MIT)  
Content and documents: [CC-BY 4.0](https://creativecommons.org/licenses/by/4.0/)
