# OntarioGamers — Site Admin Wiki

A complete, plain-language guide to running **OntarioGamers.ca** from the WordPress
admin dashboard. No coding required — everything in this guide is done by pointing
and clicking in `wp-admin`.

> **Golden rule:** *Content* (casinos, slots, pages, menus, images) is edited in the
> WordPress admin. *Code* (theme design, layout) is edited in the project files and
> deployed via Git. This wiki covers the **content** side.

---

## Table of Contents

1. [Logging In](#1-logging-in)
2. [How the Site Is Organised](#2-how-the-site-is-organised)
3. [Adding a Casino Review](#3-adding-a-casino-review-all-fields)
4. [Adding a Slot Review](#4-adding-a-slot-review-all-fields)
5. [Featured Images / Logos](#5-featured-images--logos)
6. [Categories & Game Providers](#6-categories--game-providers)
7. [Controlling Display Order](#7-controlling-the-order-things-appear)
8. [Editing Static Pages](#8-editing-static-pages-about-privacy-etc)
9. [Navigation Menus (Header & Footer)](#9-navigation-menus-header--footer)
10. [Site Logo & Title](#10-site-logo--title)
11. [Sidebar Widgets](#11-sidebar-widgets)
12. [AGCO / Legal Content Rules](#12-agco--legal-content-rules-important)
13. [Publishing Workflow & Checklist](#13-publishing-workflow--checklist)
14. [Posting News & Articles](#14-posting-news--articles)
15. [Search Engine Optimisation (SEO)](#15-search-engine-optimisation-seo)
16. [Backlinks & Off-Page SEO](#16-backlinks--off-page-seo)
17. [Troubleshooting](#17-troubleshooting)

---

## 1. Logging In

1. Go to **`https://ontariogamers.ca/wp-admin`** (or `/wp-login.php`).
2. Enter your admin username and password.
3. You land on the **Dashboard**. The left-hand black menu is where everything lives.

---

## 2. How the Site Is Organised

The site is built around three content types. Each appears as its own item in the
left admin menu:

| Admin menu item | What it is | Public URL |
|---|---|---|
| **Casino Reviews** 🎲 | One entry per online casino (Bet99, BetMGM…) | `/online-casinos/` |
| **Slot Reviews** ▦ | One entry per slot game (Gates of Olympus…) | `/online-slots/` |
| **Pages** | Static pages (About, Privacy, Contact…) | e.g. `/about/` |

- The **homepage** automatically pulls in your **6 top casino reviews** and **6 top
  slot reviews** — you do not edit the homepage directly, you just add/order reviews.
- Each casino/slot review has a set of **structured fields** (rating, bonus, RTP…)
  that fill in the boxes and tables you see on the live site.

---

## 3. Adding a Casino Review (All Fields)

**Casino Reviews → Add New Casino**

### Step A — The main content
| Field | Where | What to put |
|---|---|---|
| **Title** | Top text box | The casino's name, e.g. `Bet99` |
| **Body content** | Main editor | The full written review (intro, banking, pros/cons, verdict). Use Headings (H2/H3) so the design styles them nicely. |
| **Excerpt** | *Screen Options → enable Excerpt*, or the Excerpt box | 1–2 sentence summary used in listings (optional). |

### Step B — Casino Review Details (the box below the editor)
This is the **"Casino Review Details"** panel. Every field here feeds the comparison
table and the review info box on the live site.

| Field | Example | Appears on site as |
|---|---|---|
| **Rating (1–10)** | `9.2` | The ⭐ score badge / "9.2/10" |
| **Bonus Description** | `100% up to $1,000 + 100 Spins` | "Welcome Bonus" line *(see §12 — AGCO rules)* |
| **Affiliate URL** | `https://bet99.com/?aff=...` | The green **"Play Now"** button link |
| **License** | `AGCO-registered` | The ✓ License badge |
| **Deposit Methods** | `Interac, Visa, Mastercard` | "Deposit Methods" row |
| **Withdrawal Time** | `0–24 hours` | "Withdrawal Time" row + ⏱ in table |
| **Minimum Deposit** | `$10` | "Min Deposit" row |
| **Year Established** | `2020` | "Established" row |

> Leave a field **blank** and it simply won't show — the layout adapts automatically.

### Step C — Featured image
Set the casino **logo** as the *Featured Image* (right sidebar). See [§5](#5-featured-images--logos).

### Step D — Publish
Click **Publish**. The review is now live at `/online-casinos/<name>/` and appears in
the homepage casino table (subject to order — see [§7](#7-controlling-the-order-things-appear)).

---

## 4. Adding a Slot Review (All Fields)

**Slot Reviews → Add New Slot**

### Step A — Main content
- **Title** = the slot name, e.g. `Gates of Olympus`
- **Body** = the written review in the main editor.

### Step B — Slot Review Details panel
| Field | Example | Notes |
|---|---|---|
| **RTP (%)** | `96.50` | Accepts decimals (80–99.99). Shows as "RTP: 96.5%". |
| **Volatility** | `High` | Low / Medium / High. |
| **Max Win** | `5000x` | Maximum payout multiplier. |
| **Provider** | `Pragmatic Play` | Game studio. |
| **Theme** | `Greek Mythology` | Slot theme. |
| **Reels** | `6x5` | Reel layout. |
| **Paylines/Ways** | `Scatter Pays` | Paylines or "ways to win". |
| **Min Bet (CAD)** | `$0.20` | |
| **Max Bet (CAD)** | `$125` | |
| **Affiliate URL** | `https://...` | "Play Now" link for the slot. |

### Step C — Featured image
Set a **slot thumbnail / screenshot** as the Featured Image. This is the image shown
in the slot grid on the homepage and listings.

### Step D — Publish.

---

## 5. Featured Images / Logos

The **Featured Image** is critical — it's the casino logo or slot artwork.

1. In the editor, find the **Featured Image** box (right-hand sidebar; if missing,
   open **Screen Options** at the top and tick it).
2. Click **Set featured image** → **Upload files** → choose your image → **Set featured image**.

**Recommended sizes** (the theme auto-crops, but start with good source images):
| Use | Ideal upload size |
|---|---|
| Casino logo | ~320×320 px, square, transparent PNG preferred |
| Slot thumbnail | ~800×500 px (landscape) |

> Always fill in the **Alt Text** when uploading (for SEO + accessibility), e.g.
> "Bet99 Ontario casino logo".

---

## 6. Categories & Game Providers

These optional **taxonomies** help you group and filter content:

| Taxonomy | Attached to | Example values |
|---|---|---|
| **Casino Categories** | Casino Reviews | `Live Casino`, `New 2026`, `Interac Casinos` |
| **Slot Categories** | Slot Reviews | `Megaways`, `Cluster Pays`, `Jackpot` |
| **Game Providers** | Casinos **and** Slots | `Pragmatic Play`, `NetEnt`, `Evolution` |

To add one: open a review → find the category/provider box on the right → tick an
existing term or type a new one → **Add**.

---

## 7. Controlling the Order Things Appear

The homepage and listings show casinos/slots ordered by a number called **"Order"**
(lowest number first).

1. Open the casino/slot review.
2. Find the **Page Attributes** box (right sidebar) → **Order** field.
3. Set `1` for your top pick, `2` for second, and so on.
4. **Update**.

> If two items share the same number, WordPress falls back to date order. Give each
> item a unique number to be safe (1, 2, 3…).

---

## 8. Editing Static Pages (About, Privacy, etc.)

The site ships with these pre-written pages (created automatically):

| Page | Slug / URL |
|---|---|
| About OntarioGamers | `/about/` |
| Responsible Gambling | `/responsible-gambling/` |
| Affiliate Disclosure | `/affiliate-disclosure/` |
| Privacy Policy | `/privacy-policy/` |
| Terms and Conditions | `/terms-and-conditions/` |
| Contact | `/contact/` |

To edit any of them:
1. **Pages → All Pages**.
2. Hover the page → **Edit**.
3. Change the text in the editor → **Update**.

> These are normal pages — edit freely. Your edits are never overwritten.

**To add a brand-new page** (e.g. an "Ontario Casino Guide"):
**Pages → Add New** → give it a Title → write content → **Publish**. The URL is built
from the title (you can change it under the **Permalink/Slug** setting).

---

## 9. Navigation Menus (Header & Footer)

**Appearance → Menus**

The theme has two menu locations:

| Location | Where it shows |
|---|---|
| **Primary Menu** | The top header navigation (and the mobile hamburger ☰) |
| **Footer Menu** | (optional) extra footer links |

### To build/edit the header menu:
1. **Appearance → Menus**.
2. Create a menu (name it e.g. "Main") or select the existing one.
3. From the left panel, tick pages / casino reviews / custom links → **Add to Menu**.
4. Drag items to reorder; drag slightly right to make a **sub-item** (dropdown).
5. Under **Menu Settings**, tick **Primary Menu** as the display location.
6. **Save Menu**.

> The same menu automatically powers the **mobile hamburger** — no separate setup.
> Test it by shrinking your browser window or opening the site on your phone.

---

## 10. Site Logo & Title

**Appearance → Customize → Site Identity**

- **Site Title / Tagline** — used in the browser tab and SEO.
- **Logo** — upload an image logo. If you don't set one, the site shows the styled
  text "Ontario**Gamers**" automatically.

---

## 11. Sidebar Widgets

Review pages have a sidebar. **Appearance → Widgets** (or Customize → Widgets).

- **Main Sidebar** — shows on casino/slot review pages.
- **Footer Column 1** — an extra footer area.

Drag widgets (e.g. a "Top Casinos" custom HTML block, recent posts, text) into these
areas and **Save**.

---

## 12. AGCO / Legal Content Rules (Important)

OntarioGamers serves Ontario players, so content must respect **AGCO** advertising
standards:

- ⚠️ **Bonus terms cannot be publicly advertised** to Ontario players (AGCO Standard
  11.10). Keep the **Bonus Description** field generic — e.g. *"Welcome bonus
  available — see operator for terms"* — rather than listing exact figures, unless
  you are certain of current compliance. The casino card already shows an AGCO
  disclaimer automatically.
- Always keep the **19+** and **responsible gambling** messaging intact (it's added
  automatically by the theme on every page).
- Only list operators that are **AGCO-registered / verified on iGaming Ontario**.
- The **Affiliate Disclosure** appears automatically on review pages — don't remove it.

> When in doubt, keep bonus wording conservative. The compliance disclaimers built
> into the theme are there to protect the site.

---

## 13. Publishing Workflow & Checklist

Before hitting **Publish** on a new casino or slot review:

- [ ] Title is the correct casino/slot name
- [ ] Full review written in the body, with H2/H3 headings
- [ ] All **Review Details** fields filled (rating, bonus, affiliate URL, etc.)
- [ ] **Affiliate URL** is correct and tested
- [ ] **Featured Image** (logo/thumbnail) set, with Alt text
- [ ] **Order** number set (Page Attributes) for homepage position
- [ ] Category / Provider assigned (optional)
- [ ] Proofread for spelling and accuracy
- [ ] Click **Preview** to check it looks right on desktop **and** mobile

---

## 14. Posting News & Articles

The site has a built-in **News & Guides** section at `/news/`. Publishing fresh
articles is the single best way to earn free Google traffic: every guide becomes a
new page Google can rank, and a place to link to your casino and slot reviews.

### How to post an article

1. Go to **Posts → Add New** (the standard *Posts* menu — not Casino/Slot Reviews).
2. **Title:** write it the way someone would search Google — e.g. *“How to Read
   Slot RTP”* or *“Best Ontario Casino Bonuses Explained”*.
3. **Body:** write the article in the editor. Use **Heading** blocks (H2/H3) to break
   it into sections — good for readers and for Google.
4. **Category** (right panel): tick one — *Casino News*, *Sports Betting*, *Slots*
   or *Guides*.
5. **Featured image** (right panel): set one so the article card looks good, and add
   **Alt text**.
6. **Internal links:** link words like *Bet99* or *Gates of Olympus* to their review
   pages (highlight text → link icon → search the review). This sends visitors and
   Google authority to your money pages.
7. Click **Publish**. The article appears instantly at `/news/`, in its category, and
   in the “Latest News” strip on the homepage.

> **Tip:** aim for one helpful, well-written article a week. A single 1,000-word
> guide that genuinely answers a question out-ranks ten thin posts.

> ⚠️ **Never** paste articles copied from other sites. Duplicate content is ignored
> or penalised by Google and can hurt the whole domain. Always write original copy.

---

## 15. Search Engine Optimisation (SEO)

SEO is how you get found on Google without paying for ads. The heavy **technical**
SEO is already built into this site by the developer — your job is mostly to keep
writing good content and to complete the one-time Google setup below.

### What’s already built in (automatic — no action needed)

| Feature | What it does for you |
|---|---|
| **Meta titles & descriptions** | Every page outputs a title and description tag — the blue headline and grey text Google shows in results. |
| **Open Graph / Twitter cards** | Shared links on Facebook, X or WhatsApp show a proper title, description and image. |
| **Schema markup (star ratings)** | Casino/slot reviews output `Review` data with your rating; articles output `Article` data — this is what lets Google show review stars and rich snippets. |
| **XML sitemap** | A live map of every page is auto-generated at `/wp-sitemap.xml` — submit it to Google (below). |
| **Canonical URLs** | Tells Google the one true address of each page, preventing “duplicate content” issues. |

### One-time setup: submit your sitemap to Google Search Console

1. Go to **[search.google.com/search-console](https://search.google.com/search-console)**
   and sign in with a Google account.
2. Click **Add property → URL prefix** → enter `https://ontariogamers.ca`.
3. **Verify ownership.** The easiest is the *HTML tag* method (send the tag to the
   developer to add to the header) or the *Domain* method by adding a DNS record in
   Cloudflare.
4. Once verified, open **Sitemaps**, enter `wp-sitemap.xml`, and click **Submit**.
5. Optionally repeat at **[Bing Webmaster Tools](https://www.bing.com/webmasters)**.

> Indexing isn’t instant — new pages can take days to a couple of weeks to appear.
> Keep publishing; more useful content and backlinks = faster, higher rankings.

### Everyday SEO habits (your part)

- **Write for a real question** — put the search phrase in your title and first paragraph.
- **Fill the Excerpt** — it becomes the Google description, so write a tempting sentence.
- **Always set a featured image with Alt text.**
- **Link internally** between articles and reviews (see §14).
- **Keep content fresh** — update older reviews when bonuses or facts change.

> **Want a full SEO dashboard?** You can optionally install **Rank Math** or **Yoast**
> from **Plugins → Add New** for a point-and-click interface. If you do, the site’s
> built-in SEO steps aside automatically so you won’t get duplicate tags. For a small
> 1 GB server, the built-in SEO is usually all you need.

---

## 16. Backlinks & Off-Page SEO

A **backlink** is a link from another website to yours. Google treats each quality
backlink as a “vote of confidence” — sites with more trustworthy links rank higher.
This is the biggest factor you influence *off* your own site.

### The golden rule: quality over quantity

One link from a respected, *relevant* site (an Ontario news outlet, a well-known
gambling portal) is worth more than hundreds from random low-quality pages.

### How to earn good backlinks

- **Create link-worthy content:** original guides, data and “best of” lists other
  sites *want* to reference (this is why the News section matters).
- **Industry directories & portals:** get listed on reputable gambling-affiliate
  directories such as *Gambling.com*, *AskGamblers*, *Casino.org* and Ontario/Canada
  listings.
- **Guest posts:** write a useful article for another relevant blog that links back.
- **Press & data angles:** publish original Ontario iGaming stats or commentary;
  journalists and bloggers link to sources.
- **Forums & communities:** genuinely help in gambling/sports communities and link
  only where it adds value — this drives direct traffic too.

> ⚠️ **Avoid black-hat link schemes.** Never *buy* bulk links, use automated
> link-spam tools, or join “link farms”. Google penalises these and can demote or
> de-index the whole site. Slow, genuine link-building wins.

> **Track your links** in Google Search Console → **Links → External links**.

---

## 17. Troubleshooting

| Problem | Fix |
|---|---|
| **New review doesn't show on homepage** | Homepage shows only the top 6 by Order. Lower its Order number, or it may be beyond the first 6. |
| **A field (bonus, rating) isn't showing** | The field was left blank — empty fields are hidden by design. Fill it in and Update. |
| **"Page not found" on a review URL** | Go to **Settings → Permalinks** and click **Save Changes** once (this refreshes URL rules). |
| **Logo/image looks stretched** | Re-upload using the recommended size in [§5](#5-featured-images--logos). |
| **Menu changes not visible** | Make sure the menu is assigned to **Primary Menu** location and you clicked **Save Menu**. |
| **Hamburger menu not opening on phone** | Hard-refresh the page (clears cached JS). If it persists, contact the developer. |
| **Changes to design/layout needed** | That's a *code* change — handled by the developer via Git, not in wp-admin. |

---

### Content vs. Code — quick reminder

| You want to… | Where |
|---|---|
| Add/edit a casino, slot, page, menu, image, widget | **wp-admin** (this wiki) |
| Change colours, fonts, layout, page templates | **Code** → edit theme files → `git push` → deploy |

The live server has its **own database**, separate from any local test site. Content
you create in the live admin stays on the live site only.
