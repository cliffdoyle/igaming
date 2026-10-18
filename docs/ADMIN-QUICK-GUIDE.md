# OntarioGamers — Admin Quick Guide (October 2026 updates)

A short, practical guide to everything added in October 2026 and how to manage it
in wp-admin. For the full manual see [SITE-ADMIN-WIKI.md](SITE-ADMIN-WIKI.md); for the
server and deployments see [../DEPLOY.md](../DEPLOY.md).

**Log in:** https://ontariogamers.ca/wp-admin

---

## 1. What changed

| Change | Where to see it | Managed in wp-admin at |
|---|---|---|
| **New homepage** — "Best Online Casinos Ontario" guide: comparison table, How We Test, 6 in-depth reviews (bet365, BetMGM, FanDuel, LeoVegas, Caesars Palace, NorthStar Bets), legality, how to choose, responsible gambling, FAQs | https://ontariogamers.ca/ | **Appearance → Homepage Top 6** (links, logos, dates, screenshots) |
| **Partner casinos moved up** — "More Top-Rated Ontario Casinos" (Jackpot City, Betway, bwin, TonyBet, Amazon Slots, All Slots) + "Top-Rated Ontario Sportsbooks" (TonyBet Sportsbook), directly under the homepage table | Homepage → "More Casinos" | **Casino Reviews** (each review's details box) |
| **Payment Methods section** — hub page + guides: *Best Interac Casinos Ontario* and *5 Ontario Casinos Tested for Interac Payout Time* | https://ontariogamers.ca/payment-methods/ | **Payment Methods** (left menu) |
| "Payment Methods" link in the **header menu** and a new **footer column** | Every page | Automatic (lists the first 5 guides) |
| **partners@ontariogamers.ca** added next to info@ on the Contact page | https://ontariogamers.ca/contact/ | **Pages → Contact Us** |
| **Automatic deploys** — code pushed to GitHub `main` goes live in ~30 seconds | — | Developer only (see DEPLOY.md) |

> **Content vs. code:** the wording of the 6 homepage reviews is in the theme (ask the
> developer to change it). Everything in this guide can be changed by you in wp-admin.

---

## 2. Affiliate links — what's set and what's missing

The site has **two places** where affiliate links live:

| Brand(s) | Used on | Where to add the link | Status |
|---|---|---|---|
| bet365, BetMGM, FanDuel, LeoVegas, Caesars Palace, NorthStar Bets | Homepage table + 6 reviews **and** every Play button inside Payment Method guides | **Appearance → Homepage Top 6** → brand → *Affiliate link* | ❌ **None set** — buttons currently go to each casino's official Ontario site (earning nothing) |
| Jackpot City, Betway, TonyBet, Amazon Slots, All Slots | Their review pages + homepage "More Casinos" | **Casino Reviews → (casino) → Casino Review Details → Affiliate URL** | ✅ Set |
| bwin | Same as above | **Casino Reviews → bwin → Affiliate URL** | ❌ Missing (no Play button shows) |
| NorthStar Bets | Its review page **and** the homepage Top 6 | **Casino Reviews → NorthStar Bets → Affiliate URL** — the homepage uses this automatically unless a different link is set in *Homepage Top 6* | ❌ Missing |
| TonyBet Sportsbook | Homepage "Top-Rated Ontario Sportsbooks" | Stored in a hidden field — **ask the developer** to change it | ✅ Set |

### Add the 6 homepage brand links (do this first)

1. Go to **Appearance → Homepage Top 6**.
2. Each brand has a box with a status badge:
   - 🟡 *No affiliate link — Play button goes to official site*
   - 🟢 *Affiliate link active*
3. Paste the full tracking link into **Affiliate link** (it must start with `https://`).
4. Click **Save homepage settings** at the bottom.
5. Check the homepage: the brand's Play buttons now use your link. They also update in every Payment Method guide, because the guides use the same links.

### Add a link to a casino review (bwin, NorthStar…)

1. Go to **Casino Reviews**, open the casino and click **Edit**.
2. In **Casino Review Details** (below the editor), paste the link into **Affiliate URL**.
3. Click **Update**. The green **Play** button appears on its review page and in the homepage "More Casinos" list, and its logo starts linking to the casino.

> All affiliate links are automatically marked `sponsored nofollow` (Google requirement) and open in a new tab. Never paste bonus amounts next to them — see §8.

---

## 3. Homepage Top 6 settings (Appearance → Homepage Top 6)

| Setting | What it does | Tip |
|---|---|---|
| **Headline ending** | Text after "Best Online Casinos Ontario –" in the H1 | Default *Updated October 2026*. Only write *Tested & Ranked December 2026* once testing has really happened. |
| **Author box date** | Date in the "By Vanessa Phillimore \| … \| Ontario Resident" line | e.g. `Tested: Dec 5-7, 2026` |
| **Comparison table heading ending** | Text after "…Quick Comparison –" | e.g. `Tests Completed Dec 7, 2026` |
| **Affiliate link** (per brand) | Every Play button for that brand, site-wide | See §2 |
| **Logo** (per brand) | Replaces the coloured name tile in the table, review card and guides | Square or wide PNG/SVG on a white or transparent background |
| **Full review link** | Adds a "Read full review" button under that brand's homepage review | Optional |
| **Proof screenshot + caption** | Shows a screenshot inside that brand's homepage review | **Redact** names, account numbers and emails first |

Leave any box empty to use the default (shown in grey inside the box).

---

## 4. Adding a casino review

1. **Casino Reviews → Add New Casino**.
2. **Title:** the casino name, e.g. `Jackpot City Casino`.
3. **Body:** the full review. Use H2/H3 headings.
4. **Casino Review Details** box — fill in what you have; empty fields are simply hidden:
   - Rating (1–10)
   - Affiliate URL
   - License (`AGCO-registered`)
   - Deposit Methods
   - Withdrawal Time
   - Minimum Deposit
   - Year Established
5. **Featured image** (right sidebar): the casino **logo**. Without one, a grey name box shows.
6. **Excerpt:** 1–2 sentences, used as the Google description.
7. Click **Publish**. The review goes live at `/online-casinos/<name>/`, and it appears automatically in:
   - the homepage **More Top-Rated Ontario Casinos** list (up to 12 casinos);
   - the `/online-casinos/` listing.
   
   **Ordering:** reviews are sorted by **Order** (Page Attributes box; lower = higher up), then by **Rating**. All current reviews have Order `0`, so rating decides.

> The 6 brands in the main homepage guide are fixed and are **not** casino reviews. Edit
> them via *Homepage Top 6* (§3), not here.

---

## 5. Adding a Payment Method guide

1. **Payment Methods → Add New Guide.**
2. **Title:** the on-page H1, e.g. `Best Visa Casinos Ontario – 5 Sites Tested [Nov 2026]`.
3. **Body:** write it with normal blocks. Some extras:
   - **"On this page" menu:** select an H2, then go to *Block → Advanced → HTML anchor* and enter a short id (e.g. `faq`). Every H2 with an anchor appears in the menu once there are 3 or more.
   - **Play buttons:** add a *Shortcode* block, e.g. `[og_play brand="bet365" label="Play at bet365"]`. Brands: `bet365`, `betmgm`, `fanduel`, `leovegas`, `caesars`, `northstar`. The link comes from *Homepage Top 6*. Add `size="small"` for a compact button.
   - **Brand logo:** `[og_logo brand="fanduel"]`, or `size="lg"` for the bigger version.
4. **Excerpt:** the **meta description** for Google (≤155 characters).
5. **Custom fields** (optional). To show the panel: ⋮ menu → *Preferences → Panels → Custom fields*. Then use *Add New Custom Field*:
   - `og_seo_title` — the Google/browser-tab title if it should differ from the H1.
   - `og_byline_note` — shown after the author name, e.g. `Tested Oct 1-3, 2026`.
6. **Order** (Page Attributes): lower number = shown first on the hub and in the footer. The Interac guide is `1`.
7. **Publish.** The guide goes live at `/payment-methods/<slug>/` and appears automatically on the hub and in the footer column (the first 5).

**Editing the Interac guide:** go to **Payment Methods → Best Interac Casinos Ontario**.
- Headings, paragraphs and lists are normal blocks you can edit directly.
- The table, casino cards and FAQ are *Custom HTML* blocks. Edit the text carefully and keep the tags.
- If you change an FAQ answer, tell the developer. The FAQ rich-result data for Google is kept in code and must match the page.

---

## 6. Sportsbook reviews

Sportsbook reviews (e.g. TonyBet Sportsbook) live under **Sports Picks**, and they appear in the homepage
"Top-Rated Ontario Sportsbooks" list. To add a new one or change its affiliate link or
rating, **ask the developer**: those fields aren't yet editable on the Sports Pick screen.

---

## 7. Logos & images

| What | Where |
|---|---|
| Casino review logo (Betway and bwin are missing) | **Casino Reviews → (casino) → Featured image** |
| Homepage Top 6 brand logos (none uploaded yet) | **Appearance → Homepage Top 6 → Logo** |
| Payment guide header image (optional) | **Payment Methods → (guide) → Featured image** |
| Proof screenshots | Homepage: *Homepage Top 6 → Proof screenshot*. In a guide: an *Image* block. |

---

## 8. Rules to keep us compliant (AGCO)

- **No bonus amounts** (e.g. "$1,000 + 100 spins") in public copy for Ontario. Wagering
  terms, as the client's homepage copy already has them, are the client's call.
- Keep **"19+ · Ontario only · T&Cs apply"** near Play buttons. The templates add it automatically.
- Only publish **real test results** and **real dates**. Don't post future dates or invented payout times.
- Every recommended operator must be on the **iGaming Ontario** register.

---

## 9. Outstanding to-do list

- [ ] Add affiliate links for **bet365, BetMGM, FanDuel, LeoVegas, Caesars Palace** (Appearance → Homepage Top 6) and **NorthStar Bets** (Casino Reviews → NorthStar Bets).
- [ ] Add **bwin** affiliate URL (Casino Reviews → bwin).
- [ ] Upload **logos** for the 6 homepage brands (Homepage Top 6), plus Betway and bwin (Featured image).
- [ ] Upload the **redacted deposit screenshots** (homepage bet365 review + Interac guide).
- [ ] Update **test dates** in Homepage Top 6 once the December test is actually done.
- [ ] Interac guide copy: the intro says "6 AGCO sites", but the guide tests **5**. Fix it in the editor.
- [ ] Confirm the **Interac Online discontinuation date** (Oct 31, 2024) quoted in the Interac guide.
- [ ] Payout guide FAQs: *"routinely settling accounts in just over 2 hours"* (FanDuel) and *"be sure that funds will land within 2 hours"* (bet365) sound like guarantees, but the page itself says results are a single test. Consider softening them, and tell the developer so the FAQ data for Google matches.

---

## 10. Quick links

| Page | URL |
|---|---|
| Homepage | https://ontariogamers.ca/ |
| Payment Methods hub | https://ontariogamers.ca/payment-methods/ |
| Interac guide | https://ontariogamers.ca/payment-methods/best-interac-casinos-ontario/ |
| Payout-speed guide | https://ontariogamers.ca/payment-methods/fastest-payout-casinos-ontario/ |
| All casino reviews | https://ontariogamers.ca/online-casinos/ |
| Contact | https://ontariogamers.ca/contact/ |
| Homepage Top 6 settings | https://ontariogamers.ca/wp-admin/themes.php?page=og-homepage-top6 |
| Payment guides (admin) | https://ontariogamers.ca/wp-admin/edit.php?post_type=payment_guide |
| Casino reviews (admin) | https://ontariogamers.ca/wp-admin/edit.php?post_type=casino_review |
| In-dashboard Site Guide | wp-admin → **Site Guide** |
