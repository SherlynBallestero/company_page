# RenSher Enterprises LLC — Brand Brief

**Status:** v1 draft for `company_page` (Rensher.com)  
**Language:** English primary (ES bilingual later)  
**Entity:** RenSher Enterprises LLC (Florida / USA)  
**Contact:** RenSherEnterprisesLLC@gmail.com  
**Out of scope this wave:** StockP product branding  

---

## 1. Positioning

**One-liner:** RenSher Enterprises builds custom websites and digital storefronts for Florida and U.S. businesses — clear scope, modern craft, no template lock-in.

**Category:** Web services studio (custom sites, e-commerce, portfolio sites, hosting & care).

**Who we serve:** Owners and operators who need a professional web presence without agency theater — local FL businesses and U.S. clients who want straight talk and shipped work.

**What we are not:** A template marketplace, a generic “digital agency” hype shop, or a clone of HTML5 UP / competitor skins.

---

## 2. Brand voice

### Personality
- **Clear** — say what we build and what it costs to start the conversation.
- **Steady** — confident, calm; no launch-to-the-moon energy.
- **Practical** — Florida/USA business reality: timelines, hosting, SEO basics, handoff.
- **Respectful** — treat the client’s brand as theirs; we are the builder.

### Tone spectrum
| Context | Tone |
|--------|------|
| Hero / homepage | Direct, warm, professional |
| Offers / pricing | Specific, transparent, no scare tactics |
| Portfolio | Factual outcomes + craft notes |
| Legal / privacy | Plain English, LLC-accurate |
| CTAs | Action + clarity (“Get a free quote”, “Talk through your build”) |

### Do
- Use concrete nouns: site, storefront, hosting, SEO setup, custom build.
- Prefer “we build / we ship / we support” over “we disrupt / we elevate.”
- Name Florida and USA when relevant; don’t fake national agency scale.
- Keep sentences short. One idea per line when selling.

### Don’t
- Hype: “stunning,” “skyrocket,” “dominate,” “next level,” “launch to new heights.”
- Template-speak: “choose a theme,” “instant website.”
- Competitor mimicry in voice or layout language.
- Overpromise SEO rankings or revenue.

### Sample lines (canonical seeds)
- Hero: “Custom websites for Florida and U.S. businesses — built to fit how you actually work.”
- Sub: “Websites, storefronts, and ongoing care. Clear plans. Straight communication.”
- CTA primary: “Get a free quote”
- CTA secondary: “See selected work”
- Trust: “RenSher Enterprises LLC · Based in Florida · Serving clients across the USA”

---

## 3. Messaging pillars

Use these as the spine of homepage, offers, and About.

1. **Custom, not cookie-cutter**  
   Every build is scoped to the business. No recycled competitor skins.

2. **Clear offers, flexible when needed**  
   Named packages (Launch / Grow / Commerce) plus Care module and customize-your-own. Prices in USD; final scope in contract.

3. **Florida roots, USA reach**  
   Local accountability with the ability to serve clients nationwide.

4. **From launch to care**  
   Build + domain/hosting options + practical SEO foundations + support paths.

5. **Proof over promises**  
   Portfolio of real projects; comparisons only with sourced, dated context — never invented metrics.

---

## 4. Visual system (original)

**Design intent:** Quiet confidence. Editorial clarity. Warm coastal ink — *not* the mauve/purple HTML5 UP stack (`#484459` / `#413D53` / Source Sans Pro), *not* generic Tailwind emerald “agency” cards.

### 4.1 Color tokens

| Token | Hex | Role |
|-------|-----|------|
| `--rs-ink` | `#0B1F2A` | Primary text, header bar, strong UI |
| `--rs-ink-soft` | `#1A3340` | Secondary surfaces, footer |
| `--rs-fog` | `#F4F1EA` | Page background (warm paper) |
| `--rs-cloud` | `#FFFFFF` | Cards, elevated panels |
| `--rs-mist` | `#D9E2E6` | Borders, dividers |
| `--rs-accent` | `#C45C26` | Primary CTA, focus rings, key highlights (burnt coral) |
| `--rs-accent-hover` | `#A34A1C` | CTA hover |
| `--rs-sea` | `#2F6F6A` | Secondary accent (links, badges, success-adjacent) |
| `--rs-muted` | `#5C6B73` | Supporting copy |
| `--rs-warn` | `#B45309` | Alerts (sparingly) |

**Rules**
- Background default: `--rs-fog`. Large dark bands only for hero/footer.
- Accent (`--rs-accent`) on primary CTAs only — don’t flood the page.
- Never reintroduce HTML5 UP mauve/violet as brand color.
- Maintain WCAG AA for text on fog/cloud and light text on ink.

### 4.2 Typography

| Role | Family | Fallback | Notes |
|------|--------|----------|-------|
| Display / H1–H2 | **Fraunces** | Georgia, serif | Soft contrast; editorial, not startup-grotesk |
| UI / body | **Manrope** | system-ui, sans-serif | Clean, modern; *not* Source Sans Pro |
| Mono (code / meta) | **IBM Plex Mono** | ui-monospace | Prices, version tags, legal meta |

**Scale (desktop → mobile)**
- H1: 2.75rem / 2.1rem · weight 600 · tracking -0.02em  
- H2: 1.75rem / 1.4rem · weight 600  
- H3: 1.25rem · weight 600  
- Body: 1.0625rem · line-height 1.65  
- Small / legal: 0.875rem · `--rs-muted`

**Rules:** Max ~65ch for prose. No all-caps paragraphs. Buttons: Manrope 600, sentence case.

### 4.3 Spacing & layout

- Base unit: **8px**. Common: 8 / 16 / 24 / 40 / 64.
- Page max width: **1120px** content; hero text ~720px.
- Card radius: **12px**. Buttons: **10px**.
- Section padding: **64px** desktop / **40px** mobile.
- Grid: 12-col mental model; offers as equal cards with one “recommended” outline in `--rs-sea` (not loud emerald borders).

### 4.4 Logo usage

- Wordmark: **RenSher** (primary) + **Enterprises LLC** (secondary, smaller / muted).
- Preferred lockup: horizontal wordmark on `--rs-fog` or reversed on `--rs-ink`.
- Clear space: ≥ height of the “R” on all sides.
- Min digital width: 120px for full lockup; icon-only mark only if a simple monogram is designed (do not stretch the RS.gif loader as logo).
- Don’t: drop shadows on logo, rotate, recolor outside token set, place on busy photography without scrim.

### 4.5 Imagery & UI motifs

- Prefer real project screenshots, Florida/business photography with restrained grade.
- Motif: thin horizontal rules + generous whitespace (editorial), not icon-grid “feature festivals.”
- Icons: simple line set (1.5px), `--rs-ink` / `--rs-sea` — no Font Awesome style-color rainbow from old template.

### 4.6 Motion

- Subtle only: 150–250ms ease for hover/focus.
- No full-screen loader brand theater on every visit; if a loader remains, keep it short and token-aligned.

---

## 5. Conversion copy cues (for Marketing / FE)

| Element | Direction |
|---------|-----------|
| Primary CTA | “Get a free quote” → mailto or form to RenSherEnterprisesLLC@gmail.com |
| Offers CTA | “Start with {Plan}” / “Customize a plan” |
| Portfolio CTA | “Discuss a similar build” |
| Footer | LLC name · FL/USA · privacy/terms · contact email |

Avoid competitor price-table aggression in voice; if a comparison table stays, keep sourced footnotes and calm framing (“illustrative market ranges”), never “they’re expensive, we’re cheap” sneer.

---

## 6. Legal / entity notes (Brand must match)

- Legal name in footers & Terms: **RenSher Enterprises LLC** (not “limited partnership”).
- Privacy/contact email: **RenSherEnterprisesLLC@gmail.com**
- Analytics (ops, not brand voice): GA `G-256P0XXK8Q` may remain; do not put gtag IDs in marketing copy.

---

## 7. Anti-patterns (hard)

- HTML5 UP layouts, class names as design language, or mauve/purple palette revival.
- Cloning competitor agency sites (structure, hero tropes, testimonial carousels copied wholesale).
- StockP product voice or investment-adjacent language on this site.
- Fake urgency (“only 2 spots left”) unless operationally true.

---

## 8. Handoff checklist

- [ ] FE implements CSS variables from §4.1  
- [ ] Fonts: Fraunces + Manrope (+ mono) via self-host or approved CDN  
- [ ] Hero / offers / footer use §2 sample lines or Legal-approved variants  
- [ ] Old Source Sans Pro + `#484459` stack removed from production styles  
- [ ] Brand reviews staging screenshots before launch  

**Owner:** Brand Management · **Coord:** Chief of Staff · **Legal** owns Terms/Privacy substance  
