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
17. [Work Email on the Domain](#17-work-email-on-the-domain)
18. [Monitoring Traffic (Analytics)](#18-monitoring-traffic-analytics)
19. [Troubleshooting](#19-troubleshooting)

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

#### Why we need to do this

Building the site doesn't automatically put it on Google. Google has to *discover*
your pages, *read* them, and add them to its index before anyone can find you in
search. **Google Search Console** is a free Google tool that:

- **Tells Google your site exists** and hands it your **sitemap** (`/wp-sitemap.xml`)
  so it indexes all pages quickly instead of finding them slowly.
- **Shows how you're doing** — which search terms bring visitors, which pages rank,
  click numbers, and any errors Google hit.
- **Lets you request indexing** of brand-new articles so they appear faster.
- **Reports problems** — broken pages, mobile issues, security flags — so you can fix them.

In short: without it you're invisible to Google and flying blind. One-time setup,
then it just runs.

#### Step 1 — Create the account & add your site

1. Go to **[search.google.com/search-console](https://search.google.com/search-console)**
   and sign in with the Google account that should own the site's data (tip: use the
   *same* account as Google Analytics — it makes verification one click).
2. Click **Add property** → choose the left box, **Domain** → type
   `ontariogamers.ca` (no `https://`, no `www`) → **Continue**.

#### Step 2 — Prove you own the site (verification)

Because our DNS is at Cloudflare, Google offers a **one-click route**:

1. Google shows an **"Authorize DNS records from Google"** screen with a `TXT`
   record it wants to add to Cloudflare. Click the blue **Authorize** button —
   Google adds the record into Cloudflare for you (a one-time, safe authorization).
2. It returns to Search Console showing **"Ownership verified"**. (If not instant,
   wait a minute and click **Verify**.)

> **Manual fallback:** if the one-click box doesn't appear, copy the `TXT` value and
> add it in **Cloudflare → DNS → Add record** (Type `TXT`, Name `@`, Content = the
> value), Save, then click **Verify**. Don't wrap the value in extra quotes.

#### Step 3 — Submit the sitemap

1. Once verified, open **Sitemaps** in the left menu.
2. In "Add a new sitemap", type the **full URL** `https://ontariogamers.ca/wp-sitemap.xml`
   and click **Submit**. (If it rejects the short `wp-sitemap.xml` as "invalid", the
   full URL always works.)
3. It may say **"Couldn't fetch"** for the first few hours — normal right after
   submitting. It changes to **Success** once Google fetches it, then re-reads it
   automatically as you add pages.

#### Step 4 (optional) — Do the same on Bing

Repeat the property + sitemap steps at
**[Bing Webmaster Tools](https://www.bing.com/webmasters)** to cover Bing &
DuckDuckGo. Bing can import everything from Search Console in one click.

> **What to expect:** indexing isn't instant — new pages take days to a couple of
> weeks. After ~2–3 days, check Search Console → **Pages** to confirm pages are
> "Indexed", and **Performance** to watch clicks and search terms come in.

### Reading your Search Console data (who finds & clicks you on Google)

Search Console answers one question: *"how do people find me on Google, and do they click?"* The main report is **Performance → Search results**. Four numbers matter:

| Metric | Plain meaning |
|---|---|
| **Impressions** | How many times a page of mine *appeared* in someone's Google results. High = Google is showing me. |
| **Clicks** | How many of those people actually *clicked through* to my site. This is real Google traffic. |
| **CTR** (click-through rate) | Clicks ÷ impressions, as a %. Low CTR + high impressions = I'm showing up but my title/description isn't tempting — rewrite the Excerpt. |
| **Position** | My average ranking spot for that term (1 = top). Past page 1 (~10+) gets few clicks. |

Useful tabs inside that report:

- **Queries** — the exact words people typed to find me. Gold for ideas: write more articles around terms that already bring impressions.
- **Pages** — which of my URLs get the most clicks/impressions.
- **Indexing → Pages** — confirms which pages are *Indexed* (eligible to show) vs excluded, and why.
- **URL inspection** (top search bar) — paste a brand-new article's URL and click **Request indexing** to nudge Google to read it sooner.

> **How I make sense of it:** rising *impressions* = my SEO is working and Google trusts me more; rising *clicks* = people are choosing my result. High impressions but low clicks → improve titles/descriptions. A query sitting at position 8–15 → a stronger article on that exact topic can push it onto page 1.

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

## 17. Work Email on the Domain

I set up a branded email address on our own domain so messages look professional — `info@ontariogamers.ca` instead of a personal Gmail. Here's exactly how I did it and how to add more addresses later.

### Which option I chose

Email can do two things — **receive** and **send** — and they're set up differently. I started with **Cloudflare Email Routing** because it's free and forwards anything sent to our domain straight into my existing Gmail inbox. If I later need to *reply from* the branded address for partnerships, I'll move up to a full mailbox (Zoho free or Google Workspace) — see the bottom of this section.

> **Note:** Cloudflare is always managed from a normal browser on my Windows machine — **not** from the Ubuntu server. The server has no browser; it only runs the website.

### Step 1 — Turn on Email Routing in Cloudflare

1. Log into **dash.cloudflare.com**.
2. Click the domain **ontariogamers.ca**.
3. Left menu → **Email** → **Email Routing** → **Get started**.

### Step 2 — Add and verify my destination inbox

1. Under **Destination addresses**, add the personal inbox I want mail forwarded to (my Gmail).
2. Cloudflare sends a **verification email** to that Gmail — I open it and click the confirm link.
3. The destination then shows as **Verified**.

### Step 3 — Create the address (route)

1. Under **Custom addresses**, click **Create address**.
2. Type the name I want, e.g. `info` → full address becomes `info@ontariogamers.ca`.
3. Action: **Send to an email** → choose my verified Gmail.
4. Save. Anything emailed to `info@ontariogamers.ca` now lands in my Gmail.

> I can repeat Step 3 to add `vanessa@`, `george@` or `partnerships@`. I can also enable a **catch-all** so *any* name @ourdomain forwards to me.

### Step 4 — Let Cloudflare add the DNS records

When I enable routing, Cloudflare offers to **automatically add the required DNS records** (the MX records plus an SPF TXT record). I click **Add records / Enable** and let it do this — without them, mail won't be delivered. I don't touch DNS by hand.

> ⚠️ **Important:** email only keeps working while the domain is registered and these DNS records exist. If the domain lapses, email goes down too. I keep a valid card on Cloudflare so auto-renew never fails.

### If I want to SEND from the branded address too

Email Routing only *receives/forwards*. To send replies that show as `info@ontariogamers.ca` I have two choices:

- **Zoho Mail (free plan):** real mailboxes (send + receive) for one domain, up to a handful of users. I'd add the MX/SPF/DKIM records Zoho gives me into Cloudflare DNS. Best free upgrade.
- **Google Workspace (paid, ~CAD $8/user/month):** the Gmail interface on our domain — the most polished option if the business grows.

> **My plan:** stay on free Cloudflare Email Routing for now so `info@ontariogamers.ca` reaches my inbox; switch to Zoho free or Google Workspace if/when I need to send branded replies regularly.

---

## 18. Monitoring Traffic (Analytics)

I want to know how many people read the site and which articles are most popular. I use two free tools that answer slightly different questions.

### Cloudflare Analytics (already on, quick overview)

Every visitor passes through Cloudflare, so it counts everyone with no setup. I check it at **dash.cloudflare.com → ontariogamers.ca → Analytics** and switch between **24 Hours / 7 Days / 30 Days**. It shows total unique visitors, requests, data served and countries — great for a quick "how busy are we?" but not per-article detail.

### Google Analytics 4 (per-article detail)

This is the one that tells me *which posts people actually read*. The tracking is already built into the site (Measurement ID `G-JGPHEWDBY9`), and it deliberately **ignores my own visits while I'm logged in** so I don't inflate the numbers. I read it at **analytics.google.com**:

- **Reports → Realtime** — who's on the site right now (good for checking it works: open the site in a private/incognito window and watch myself appear).
- **Reports → Engagement → Pages and screens** — *views per article/page, ranked*. This is my main "what's popular" report.
- **Reports → Acquisition** — where visitors came from (Google, Facebook, direct links).

> **If I ever change the tracking ID:** it lives in the plugin (`includes/analytics.php`). I can override it without touching code by adding `define('ONTARIOGAMERS_GA4_ID', 'G-XXXXXXXXXX');` to `wp-config.php`. New data can take a few minutes (Realtime) up to 24–48 hours (full reports) to appear.

> **Two different questions:** Google *Analytics* tells me what people do *on* the site (after they arrive); Google *Search Console* (see [§15](#15-search-engine-optimisation-seo)) tells me what people searched on Google *before* they clicked. I use both together.

### Making sense of the numbers (which report shows what)

A few GA4 words decoded, so the reports aren't confusing:

| Term | Plain meaning |
|---|---|
| **Users** | How many *different people* visited (roughly — counted per device/browser). |
| **Views** | How many *pages* were opened in total. One person reading 3 articles = 1 user, 3 views. |
| **Sessions** | One visit (a person's whole browsing session). One user can have many sessions over time. |
| **Engagement time** | How long people actually stayed reading. Higher = my content holds attention. |
| **Channels / Source** | Where they came from — *Organic Search* (Google), *Direct* (typed the URL), *Social* (Facebook/X), *Referral* (another site linked me). |

**To answer "how many people read this article?"** go to **Reports → Engagement → Pages and screens**. Each row is a page; the **Views** column is how many times it was read, **Users** is how many people. Sort by Views for my most-read content; click a row to see that article's trend over time.

**To see live activity right now** (e.g. just after sharing a link): **Reports → Realtime** shows users on the site this minute and which pages they're on.

**To see where my traffic comes from:** **Reports → Acquisition → Traffic acquisition** — tells me whether visitors arrive from Google, social posts, or direct links, so I know which promotion is working.

> ⚠️ **Don't panic at small numbers early on.** A new site gets little traffic until Google indexes it and backlinks build (weeks, not days). Watch the *trend* — steadily rising Users/Views week over week is the win, not the day-one number.

---

## 19. Troubleshooting

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
