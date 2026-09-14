# RenSher company_page — UX waves + light design system

**Status:** Packaging **A** + **CEO-locked prices** (2026-09-14). Eng GREENLIGHT W3b/W6b. SEO labels: **Foundational | Advanced | In-depth** (Brand-final).  
**Repo:** `SherlynBallestero/company_page` · **Live:** https://www.rensher.com/ · **main:** redesign @ `9ee73af`  
**Brand:** `/workspace/rensher-brand/BRAND.md` (tokens unchanged)  
**Legal:** privacy/terms already shipped — do not rewrite bodies  
**Out:** StockP · HTML5 UP · % savings table · “Lock this deal” · **Basic / Standard / Premium on-page strings** (Eng map only)

---

## Packaging A (CEO) — named packages

| On-page name | Eng map (legacy) | Initial | With Care / mo | Without Care (maintenance-free) | Badge |
|---|---|---|---|---|---|
| **Launch** | ← Basic | $1,200 | $99 | $2,699 | — |
| **Grow** | ← Standard | $2,299 | $179 | $4,499 | **Recommended ★** |
| **Commerce** | ← Premium | $3,799 | $279 | $6,999 | — |
| **Care** | maintained retainer | — | = package’s $/mo | — | **Module**, not a 4th size |
| **Custom** | discovery quote | — | — | — | Band below packages |

> **PRICES LOCKED (CEO 2026-09-14):** Launch $1,200 / Care $99 / Without Care $2,699 · Grow $2,299 / $179 / $4,499 · Commerce $3,799 / $279 / $6,999. Care allowances: **15 / 25 / 45 minutes** of minor updates / month (not hours).
>
> **Brand-final SEO labels:** matrix row = Foundational | Advanced | In-depth. Grow blurb keeps “advanced SEO”. Commerce uses “in-depth SEO” + “site support in three languages”. Care mailto subject = `Care plan — RenSher`.


**Kill sitewide (visible copy):** Basic, Standard, Premium. Keep mapping only in Eng comments / mailto body if needed for ops continuity.

---

## 0. Design system (unchanged Brand v1)

Tokens, type, space, header/footer, fog/cloud/accent/sea — same as shipped redesign.

**Component updates for packaging A**

| Class | Spec |
|---|---|
| `.rs-plan` | One card per **Launch / Grow / Commerce** |
| `.rs-plan--featured` | **Grow** (sea outline + Recommended) |
| `.rs-plan__care` | Toggle or checkbox: **Include Care ($X/mo)** — default **on** for Grow/Commerce, optional for Launch. When on: show monthly Care price; when off: emphasize maintenance-free total. |
| `.rs-care-band` | Optional short Care explainer under the three cards (what Care includes: hosting/support/minor changes path — Marketing copy). |
| `.rs-custom-band` | Custom / discovery CTA |

**UX decision (locked):** Prefer **per-card Care toggle** over showing two prices as equal primaries. Maintenance-free is the “off” state of Care, not a competing product name.

---

## CTA ladder (updated)

1. **Get a free quote** → mailto (primary; Brand hero seed unchanged)  
2. **Get a {Launch\|Grow\|Commerce} quote** → mailto  
3. **Ask about Care** → mailto subject `Care plan — RenSher` (or include Care in package mailto body)  
4. **Customize your build** → `Custom quote — RenSher`  
5. Tel **+1-561-360-0081** · `contact_us.php` alternate  

**Mailto subjects**

- `Quote request — Launch package`  
- `Quote request — Grow package`  
- `Quote request — Commerce package`  
- `Care plan — RenSher`  
- `Custom quote — RenSher`  

Update free-quote body plan interest line to: `Plan interest (Launch / Grow / Commerce / Custom):` + `Care (yes/no):`

**Avoid:** Basic/Standard/Premium in UI · Lock this deal · % savings · StockP · hype list (Marketing).

**Nav:** Home · **Offers** · Projects · Contact (FAQ footer).

---

## Canonical copy (packaging A)

### Homepage

**Hero** — Brand seed unchanged:  
H1 RenSher Enterprises · Sub “Custom websites for Florida…” · Support hosting/care · CTA Get a free quote · Secondary View packages → `offers.html`

**Pillars** — keep five; “Clear plans” → “Clear packages — Launch, Grow, Commerce”

**Package cards (job-led — Appendix W3b)**

| Package | Blurb | Price UI | CTA |
|---|---|---|---|
| **Launch** | First credible local site. A custom responsive site so customers can find you and trust you — foundational SEO, Google Maps profile, photos, domain & hosting. | $1,200 + Care $99/mo (15 min) / off → $2,699 | Get a Launch quote |
| **Grow ★** | Visibility and leads. Everything in Launch, plus advanced SEO, blog, calendar & chat, forms, two languages, and monthly performance notes — set up to help turn visitors into inquiries. | $2,299 + Care $179/mo (25 min) / off → $4,499 | Get a Grow quote |
| **Commerce** | Sell or book online. Everything in Grow, plus payments, dashboards, API connections, in-depth SEO, speed work, and site support in three languages. | $3,799 + Care $279/mo (45 min) / off → $6,999 | Get a Commerce quote |

Under cards: **Ask about Care** + note: Packages are starting points; final scope in contract.

**Services:** Local presence · Web design · E-commerce (**Commerce**) · Simple reporting (**Grow+** with Care)

**Closing:** map Launch / Grow / Commerce / custom · Get a free quote

### Offers page

- **H1:** Website packages  
- Intro: Launch, Grow, and Commerce for Florida and U.S. businesses. Add **Care** for ongoing hosting and support — or choose maintenance-free.  
- Three full cards + **feature matrix** columns Launch | Grow | Commerce (Appendix — Marketing paste-ready)  
- Timelines still **30 / 40 / 60** business days (Launch / Grow / Commerce)  
- **Care module band** (what’s included; not a fourth package size)  
- **Custom band:** Don’t see a fit? … Customize your build  
- Disclaimer unchanged (USD, FL tax, contract, no SEO/ROI guarantee)  
- **DROP** % comparison table  

### Projects / FAQ / Contact / Legal

- Projects cases unchanged (problem / built / job)  
- FAQ: replace Basic/Standard/Premium wording with Launch/Grow/Commerce + Care  
- Contact plan `<select>`: Launch / Grow / Commerce / Custom + Care yes/no  
- Privacy/Terms: no substance change  

---

## Follow-up waves (Eng PR)

### W3b — Packaging A rename (priority)

**DoD W3b.1** No visible Basic/Standard/Premium on index, offers, FAQ, contact.  
**DoD W3b.2** Cards + matrix use Launch / Grow / Commerce; Grow featured.  
**DoD W3b.3** Care toggle on each card (Include Care $X/mo + **15/25/45 minutes of minor updates / month**); maintenance-free when off.  
**DoD W3b.4** Care band + Custom band on offers.  
**DoD W3b.5** Mailto subjects updated; free-quote body lists new names.  
**DoD W3b.6** H1 “Website packages”; nav still Offers.  
**DoD W3b.7** Still no % savings table.  
**DoD W3b.8** Dollar amounts match CEO lock: Launch $1,200/$99/$2,699 · Grow $2,299/$179/$4,499 · Commerce $3,799/$279/$6,999; Care minutes labeled 15/25/45.  
**DoD W3b.9** SEO row labels: **Foundational | Advanced | In-depth** (never Basic/Premium as SEO labels). Grow keeps “advanced SEO” in blurb.

### W6b — FAQ / contact labels

**DoD W6b.1** FAQ answers use new package names.  
**DoD W6b.2** Contact plan select + Care field.

### Optional polish (backlog from PR #1)

aria-current on FAQ/privacy/terms · residual `style=` · contact PHP `hello@` ops.

---

## Eng checklist (packaging A)

- [ ] W3b.1–W3b.7  
- [ ] W6b.1–W6b.2  
- [ ] Appendix W3b matrix + blurbs + Care band implemented  
- [ ] CEO-locked $ on cards + matrix (no Basic/Std/Prem dollars)  
- [ ] SEO labels Foundational | Advanced | In-depth (Brand-final)  
- [ ] Legal untouched  

**Coord:** CoS · **Copy:** Digital Marketing · **Tokens:** Brand · **UX:** this doc

---

## Appendix W3b — Packaging A (Brand-final · prices LOCKED)

> Dollar cells below are **CEO-locked** (2026-09-14). Eng ships exactly these figures. Care allowance = **minutes** of minor updates / month.

### 1) Job-led card blurbs

**Launch**  
First credible local site. A custom responsive site so customers can find you and trust you — **foundational SEO**, Google Maps profile, photos, domain & hosting.

**Grow** ★ Recommended  
Visibility and leads. Everything in Launch, plus advanced SEO, blog, calendar & chat, forms, two languages, and monthly performance notes — **set up to help turn visitors into inquiries**.

**Commerce**  
Sell or book online. Everything in Grow, plus payments, dashboards, API connections, **in-depth SEO**, speed work, and **site support in three languages**.

### 2) Feature matrix (Launch | Grow | Commerce)

| Feature | Launch | Grow | Commerce |
|---|---|---|---|
| Job | First local site | Visibility + leads | Sell/book online |
| Pages | ≤10 | ≤20 | ≤35 |
| Timeline | 30 business days | 40 business days | 60 business days |
| Initial | $1,200 | $2,299 | $3,799 |
| With Care (/mo) | $99 | $179 | $279 |
| Without Care (maintenance-free) | $2,699 | $4,499 | $6,999 |
| Custom responsive | ✓ | ✓ | ✓ |
| SEO | **Foundational** | **Advanced** | **In-depth** |
| Google Maps profile | ✓ | ✓ | ✓ |
| Pro photos | up to 20 | up to 20 | up to 20 |
| Domain & hosting (99.9%) | ✓ | ✓ | ✓ |
| Support | 24/7 | 24/7 | 24/7 |
| Minutes of minor updates / month (with Care) | 15 minutes | 25 minutes | 45 minutes |
| Blog | — | ✓ | ✓ |
| Calendar + chat | — | ✓ | ✓ |
| Dynamic forms | — | up to 3 | up to 3 |
| Languages | — | 2 | Site support in three languages |
| Monthly performance | — | ✓ | — |
| Traffic/behavior reports | — | — | ✓ |
| Payments | — | — | ✓ |
| Custom dashboards | — | — | ✓ |
| External APIs | — | — | 2 |
| Speed optimization | — | — | Advanced |
| Recommended badge | — | Yes | — |
| Card CTA | Get a Launch quote | Get a Grow quote | Get a Commerce quote |
| Mailto subject | Quote request — Launch | Quote request — Grow | Quote request — Commerce |

**Disclaimer:** Prices in USD; Florida sales tax may apply. Final prices and services confirmed upon signing. SEO rankings and ROI are not guaranteed.

**Do not include:** market comparison / % savings table.  
**Do not show on-page:** Basic, Standard, Premium (package names).  
**Do not use SEO labels:** “Basic SEO”, “Premium SEO”.

### 3) Care band copy

**Headline:** Care  
**Sub:** Ongoing hosting, support, and small updates after go-live.

**Body:** Care is not a fourth package. On each card, toggle **Include Care ($X/mo)** for hosting, support, and that package’s monthly minor-change allowance — or choose the without-Care price for a maintenance-free handoff.

**Per-card toggle labels:** Include Care ($99/mo) · Include Care ($179/mo) · Include Care ($279/mo)  
**Alt when off:** Without Care — $2,699 / $4,499 / $6,999

**Band CTA:** Ask about Care · mailto subject **`Care plan — RenSher`**

**Custom band:** Don’t see a fit? Describe what you need — we’ll quote only that. CTA: Customize your build · subject `Custom quote — RenSher`

**PR:** Eng commits this doc with packaging A PR using CEO-locked prices.
