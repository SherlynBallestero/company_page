# RenSher company_page — UX waves + light design system

**Status:** Ready for Eng / CloudAgent (Marketing copy FINAL A–E + Brand tokens v1 + Legal bodies)  
**Repo:** `SherlynBallestero/company_page` · **Live:** https://www.rensher.com/  
**Brand:** `/workspace/rensher-brand/BRAND.md`  
**Legal bodies:** `/workspace/stockp-legal/rensher-privacy-v1.html` (or `rensher-privacy-body.html`) · `/workspace/stockp-legal/rensher-terms-v1.1.html` (CEO approve before publish)  
**Out:** StockP · HTML5 UP look · competitor clones · invented Legal · **comparison % savings table (DROP)** · “Lock this deal”

**Goal:** Original RenSher static site (HTML/CSS/JS + `contact_us.php`). PR → `main`; CEO merges.

| Live | Target |
|---|---|
| `index.html` | Redesign — Marketing homepage pack |
| `offerts.html` | → **`offers.html`** + redirect; Marketing offers pack |
| `portfolio.html` | Redesign as **Projects** |
| `contact_us.php` | Restyle; keep/enhance form |
| `FAQ.html` | Redesign + dedupe |
| `terms.html` | Shell + **Legal Terms v1.1 body** |
| `privacy.html` | **NEW** — Legal Privacy body |

**Nav (all pages):** Home · Offers · Projects · Contact · (FAQ in footer or overflow; Marketing primary nav is Home | Offers | Projects | Contact)

---

## 0. Design system (Brand v1)

### Color

```css
:root {
  --rs-ink: #0B1F2A;
  --rs-ink-soft: #1A3340;
  --rs-fog: #F4F1EA;
  --rs-cloud: #FFFFFF;
  --rs-mist: #D9E2E6;
  --rs-accent: #C45C26;
  --rs-accent-hover: #A34A1C;
  --rs-sea: #2F6F6A;
  --rs-muted: #5C6B73;
  --rs-warn: #B45309;
}
```

Fog page · cloud cards · ink text · accent **only** on primary CTAs · sea for recommended badge/links · kill `#484459` / `#413D53` / Source Sans Pro.

### Type

Fraunces (H1–H2) · Manrope (UI/body/buttons) · IBM Plex Mono (prices/meta). Scale per Brand §4.2.

### Space

8px base · max 1120 · radius 12 card / 10 button · section 64/40 · focus accent ring · ≥44px hits · motion 150–250ms · `prefers-reduced-motion`.

### Components

| Class | Spec |
|---|---|
| `.rs-header` | Wordmark RenSher + muted Enterprises LLC. Nav: Home · Offers · Projects · Contact. Primary: **Get a free quote** (mailto). Mobile disclosure — not HTML5 UP `#menu` clone. |
| `.rs-footer` | Ink-soft. LLC · FL/USA · email · tel · Offers · Projects · FAQ · Terms · **Privacy**. |
| `.rs-btn` / `.rs-btn--secondary` | Accent fill / outline. Sentence case Manrope 600. |
| `.rs-card` / `.rs-plan` | Cloud cards. `.rs-plan--featured` = **Standard** (sea outline + “Recommended”). |
| `.rs-section` / `.rs-prose` | Page rhythm + legal/FAQ. |

### CTA ladder (Marketing — mandatory)

1. **Get a free quote** → mailto (primary everywhere)  
2. **Get a {Basic\|Standard\|Premium} quote** → mailto with plan subject  
3. **Customize your build** → mailto custom subject  
4. Tel **+1-561-360-0081** · keep `contact_us.php` as alternate path  

**Mailto base**

```
mailto:RenSherEnterprisesLLC@gmail.com?subject=Free%20quote%20-%20RenSher&body=Hi%20RenSher%2C%0A%0ABusiness%3A%0ALocation%3A%0APlan%20interest%20(Basic%2FStandard%2FPremium%2FCustom)%3A%0AProject%20type%20(Website%20%2F%20E-commerce%20%2F%20Portfolio)%3A%0A%0AThanks%21
```

Plan subjects: `Quote request — Basic Plan` | `Quote request — Standard Plan` | `Quote request — Premium Plan` | `Custom quote — RenSher`

**Secondary (home):** View plans → `offers.html` (not scroll-only “Proceed”).

**Avoid (Marketing):** high-converting, stunning, supercharge, spark, unlock, lock this deal, new heights, guaranteed rankings/ROI, “up to X% less.”

---

## Canonical copy (Marketing FINAL A–E)

### Homepage

**Hero**  
- H1: RenSher Enterprises  
- Sub: Custom websites for Florida and U.S. businesses — built to fit how you actually work.  
- Support: Custom web, e-commerce, and portfolio sites — with hosting and care after launch.  
- Primary: Get a free quote (mailto)  
- Secondary: View plans → offers  

**Pillars:** Custom — not cookie-cutter · Clear plans · Florida roots, U.S. reach · Launch and ongoing care · Proof over promises  

**Offer cards (prices published)**

| Plan | Audience | Price | CTA |
|---|---|---|---|
| Basic | Startups/local · ≤10 pages | $2,200 initial · $299/mo · or $5,080 maintenance-free | Get a Basic quote |
| **Standard · Recommended** | Growing · ≤20 pages | $4,500 · $449/mo · or $8,550 | Get a Standard quote |
| Premium | E-com/complex · ≤35 pages | $7,000 · $599/mo · or $12,400 | Get a Premium quote |

Blurbs: use Marketing pack (Basic SEO/Maps/photos…; Standard + advanced SEO/blog/chat/forms/2 languages…; Premium + payments/APIs/premium SEO/speed/3 languages…).  
Note: Base plans; we adapt. Final price in contract.

**Projects teaser:** H2 Projects · Selected work… · CTA See projects  

**Services:** Local presence · Web design · E-commerce (Premium) · Simple reporting (Standard+)  

**Closing:** H2 Tell us what you need the site to do · map Basic/Standard/Premium/custom · Get a free quote  

### Offers page

- H1: Web development plans  
- Intro: Clear Basic, Standard, and Premium… Hosting and care options included.  
- Full feature matrix + timelines **30 / 40 / 60** business days  
- Custom band: Don’t see a fit? … CTA **Customize your build**  
- Disclaimer: USD; FL tax may apply; final on signing; SEO/ROI not guaranteed  
- **DROP** Market Initial Cost / “Up to X% less” table entirely  

### Projects page

- H1: Projects  
- Intro: Work samples… business type, what we built, job the site does  
- **Case template:** problem (sector) / built / outcome (job)  
  1. Restaurant & live music — Hospitality — story/menu/shows/photos/delivery/reservations/payments — browse, book, pay  
  2. Venus Home Loan — Mortgage — services/options/testimonials/booking — explain + book consult  
- If only two: full-width cards + “More projects on request” + quote CTA — **no filler**  

### Contact

Prefer mailto ladder; `contact_us.php` fields if kept: name, business, email, phone, plan interest, project type, notes (expand beyond current name/email/comments if Eng touches form).

---

## Waves

### W1 — Foundation

Tokens + fonts · shared header/footer · kill mauve/Source Sans · shrink/remove RS.gif theater · landmarks + skip-link.

**DoD W1.1–W1.3:** Fog shell; nav labels Offers/Projects; quote CTA mailto.

### W2 — Homepage

Implement Marketing homepage sections in order above.

**DoD W2.1** Brand/Marketing hero (no “Launch to New Heights”).  
**DoD W2.2** One accent primary above the fold.  
**DoD W2.3** Standard card featured; prices match table.  
**DoD W2.4** No Proceed-as-primary.

### W3 — Offers

**DoD W3.1** `offers.html` + `offerts.html` redirect; sitewide links.  
**DoD W3.2** Three plans + Custom band; quote CTAs only.  
**DoD W3.3** Feature matrix per Appendix W3 + 30/40/60 days.  
**DoD W3.4** **No** comparison % table.  
**DoD W3.5** Disclaimer present.

### W4 — Projects

**DoD W4.1** Two real cases with problem/built/outcome.  
**DoD W4.2** CTA Discuss / Get a free quote.  
**DoD W4.3** No fake case studies.

### W5 — Contact

**DoD W5.1** Mailto primary path works.  
**DoD W5.2** `contact_us.php` restyled; labels; success/fail tokens.  
**DoD W5.3** Tel visible.  
**DoD W5.4** Plan query/`?plan=` optional → subject/body.

### W6 — FAQ

**DoD W6.1** Dedupe doubled questions.  
**DoD W6.2** Grouped H2/H3; keyboard OK.  
**DoD W6.3** CTA to quote + offers. Voice: practical, not hype.

### W7 — Legal

**DoD W7.1** Ship `privacy.html` with Legal Privacy body (CEO-approved draft).  
**DoD W7.2** Replace `terms.html` inner with Terms v1.1 body — **no UX rewrite of clauses**.  
**DoD W7.3** Footer Privacy + Terms sitewide.  
**DoD W7.4** Entity **RenSher Enterprises LLC** · email RenSherEnterprisesLLC@gmail.com.

### W8 — Launch

**DoD W8.1** Redirects + no wrong host links.  
**DoD W8.2** Unique meta + canonicals.  
**DoD W8.3** a11y AA fog/ink; focus visible.  
**DoD W8.4** reduced-motion; no long loader.  
**DoD W8.5** HTML5 UP `main.css` unused on migrated pages.  
**DoD W8.6** Brand/Marketing spot-check before CEO merge.

---

## Eng checklist

- [ ] W1 shell + tokens  
- [ ] W2 homepage (Marketing A)  
- [ ] W3 offers rename + matrix; **no % table**  
- [ ] W4 projects cases  
- [ ] W5 mailto + contact  
- [ ] W6 FAQ  
- [ ] W7 privacy NEW + terms v1.1  
- [ ] W8 harden  
- [ ] CTA ladder mailto subjects  
- [ ] No StockP / no Lock this deal / no invented Legal  

**CSS layout:** `assets/css/rs-tokens.css` · `rs-base.css` · `rs-components.css` · `rs-pages.css`

**Coord:** CoS · **Copy:** Digital Marketing · **Tokens/voice:** Brand · **Legal bodies:** Legal · **UX:** this doc


---

## Appendix W3 — Offers feature matrix (Marketing paste-ready)

Eng: implement as `.rs-plan` cards + optional comparison **feature** table (features only — **not** a market/% savings table).

| Feature | Basic | Standard | Premium |
|---|---|---|---|
| Best for | Startups & local / first site | Growing businesses / visibility + leads | E-commerce & complex builds |
| Pages | Up to 10 | Up to 20 | Up to 35 |
| Timeline | 30 business days | 40 business days | 60 business days |
| Initial price | $2,200 | $4,500 | $7,000 |
| Maintained | $299/mo | $449/mo | $599/mo |
| Maintenance-free | $5,080 | $8,550 | $12,400 |
| 100% custom web development | ✓ | ✓ | ✓ |
| Responsive design | ✓ | ✓ | ✓ |
| SEO | Basic | Advanced | Premium |
| Google Maps profile setup | ✓ | ✓ | ✓ |
| Professional photographs | Up to 20 | Up to 20 | Up to 20 |
| Domain & hosting (99.9% uptime) | ✓ | ✓ | ✓ |
| Technical support | 24/7 | 24/7 | 24/7 |
| Minor changes / month | 15 | 25 | 45 |
| Blog integration | — | ✓ | ✓ |
| Calendar and chat integration | — | ✓ | ✓ |
| Dynamic forms | — | Up to 3 | Up to 3 |
| Multilingual | — | Basic (2 languages) | Professional translation (3 languages) |
| Monthly performance analysis | — | ✓ | — |
| Monthly traffic/behavior reports | — | — | ✓ |
| Payment gateway integration | — | — | ✓ |
| Custom dashboards | — | — | ✓ |
| External API connections | — | — | 2 |
| Advanced speed optimization | — | — | ✓ |
| Recommended badge | — | Yes | — |
| Card CTA | Get a Basic quote | Get a Standard quote | Get a Premium quote |
| Mailto subject | Quote request — Basic Plan | Quote request — Standard Plan | Quote request — Premium Plan |

**Custom (below matrix):** Don’t see a fit? Describe what you need — we’ll quote only that. CTA: Customize your build · subject `Custom quote — RenSher`

**Disclaimer:** Prices in USD; Florida sales tax may apply. Final prices and services confirmed upon signing. SEO rankings and ROI depend on external factors and are not guaranteed.

**Do not include:** market comparison / % savings table.

---

## PR note for Eng

Commit this file into the `company_page` repo as `docs/UX-WAVES-COMPANY-PAGE.md` (and optional `docs/MARKETING-COPY-NOTES.md`) on the redesign branch so it ships with the PR to `main`. Source of truth on the box until then: `/workspace/company_page/docs/`.
