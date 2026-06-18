# OntarioGamers.com — Implementation Roadmap

> Reference site: [TheMapleEdge.com](https://themapleedge.com/)
> Stack: WordPress (self-hosted) on DigitalOcean
> Budget target: As close to $0/month as possible (free tools prioritized)

---

## Table of Contents

1. [Cost Breakdown — Free vs Paid](#1-cost-breakdown--free-vs-paid)
2. [Phase 1 — Domain & Hosting Setup](#2-phase-1--domain--hosting-setup)
3. [Phase 2 — WordPress Installation & Configuration](#3-phase-2--wordpress-installation--configuration)
4. [Phase 3 — Theme & Design](#4-phase-3--theme--design)
5. [Phase 4 — Plugins (All Free)](#5-phase-4--plugins-all-free)
6. [Phase 5 — Site Architecture & Pages](#6-phase-5--site-architecture--pages)
7. [Phase 6 — Content Templates](#7-phase-6--content-templates)
8. [Phase 7 — SEO Setup](#8-phase-7--seo-setup)
9. [Phase 8 — Performance & Security](#9-phase-8--performance--security)
10. [Phase 9 — Affiliate Link Setup](#10-phase-9--affiliate-link-setup)
11. [Phase 10 — Launch Checklist](#11-phase-10--launch-checklist)
12. [Ongoing — Content & Maintenance](#12-ongoing--content--maintenance)

---

## 1. Cost Breakdown — Free vs Paid

### What You MUST Pay For (no free alternative)

| Item | Cost | Why |
|------|------|-----|
| Domain name (ontariogamers.com or .ca) | ~$12-15/year | You need a domain |
| DigitalOcean Droplet (1GB RAM) | $6/month | Server to run WordPress |
| **Total Year 1** | **~$85** | That's it |

### Everything Else — FREE

| Need | Free Tool | Paid Alternative (NOT needed) |
|------|-----------|-------------------------------|
| WordPress CMS | WordPress.org (free forever) | — |
| Theme | flavor Theme (free) / flavor (free) | flavor Theme ($59) |
| Page builder | Gutenberg (built-in) | flavor ($49/yr) |
| SEO | RankMath Free | Yoast Premium ($99/yr) |
| Custom fields | ACF Free | ACF Pro ($49/yr) |
| Affiliate links | Pretty Links Lite (free) | ThirstyAffiliates Pro ($99/yr) |
| Caching/Speed | WP Super Cache (free) | WP Rocket ($59/yr) |
| Security | Wordfence Free | Sucuri ($199/yr) |
| Backups | UpdraftPlus Free | UpdraftPlus Premium ($70/yr) |
| Image optimization | ShortPixel Free (100 images/mo) | ShortPixel paid |
| SSL certificate | Let's Encrypt (free) | Paid SSL ($10-50/yr) |
| CDN | Cloudflare Free tier | Cloudflare Pro ($20/mo) |
| Analytics | Google Analytics 4 (free) | — |
| Forms | WPForms Lite (free) | WPForms Pro ($49/yr) |
| Tables | flavor (free) | flavor Pro |
| Schema/Structured data | RankMath (included free) | Schema Pro ($79/yr) |

**You do NOT need to buy anything WordPress-related.** WordPress core, themes, and plugins all have free versions that are sufficient.

---

## 2. Phase 1 — Domain & Hosting Setup

### Step 1.1 — Buy Domain

```
Option A: Namecheap.com — ontariogamers.com (~$12/year)
Option B: Cloudflare Registrar — at-cost pricing (~$10/year)
Option C: .ca domain from ca.godaddy.com (~$15/year)
```

**Recommendation:** Buy from Cloudflare Registrar (cheapest, no markup, free WHOIS privacy).

### Step 1.2 — Create DigitalOcean Droplet

1. Sign up at digitalocean.com (they often have $200 free credit for new users)
2. Create Droplet → **Marketplace** → search **"WordPress"**
3. Settings:
   - Plan: Basic → $6/mo (1 CPU, 1GB RAM, 25GB SSD)
   - Region: Toronto (closest to Ontario users)
   - Authentication: SSH key (create one if you don't have one)
4. Click **Create Droplet**
5. Note down the IP address (e.g., `164.90.xxx.xxx`)

### Step 1.3 — Point Domain to Droplet

```
DNS Records (set at your domain registrar):
A record:    @     →  YOUR_DROPLET_IP
A record:    www   →  YOUR_DROPLET_IP
```

Wait 5-30 minutes for DNS propagation.

### Step 1.4 — SSH Into Server & Complete Setup

```bash
ssh root@YOUR_DROPLET_IP
```

The one-click image will show you the WordPress admin password on first login. Note it down.

### Step 1.5 — Install SSL (HTTPS)

```bash
certbot --nginx -d ontariogamers.com -d www.ontariogamers.com
```

Free HTTPS via Let's Encrypt. Auto-renews.

---

## 3. Phase 2 — WordPress Installation & Configuration

### Step 2.1 — Complete WordPress Setup Wizard

1. Visit `https://ontariogamers.com` in browser
2. WordPress setup wizard appears
3. Set:
   - Site Title: `OntarioGamers`
   - Admin Username: (pick something NOT "admin")
   - Admin Password: (strong, save in password manager)
   - Admin Email: your email

### Step 2.2 — WordPress Settings

Navigate to **Settings** in wp-admin:

```
General:
  Site Title: OntarioGamers
  Tagline: Ontario's Independent Casino & Gaming Guide
  WordPress Address: https://ontariogamers.com
  Site Address: https://ontariogamers.com

Permalinks:
  Select: "Post name" → gives URLs like /bet99-review/
  (This matches TheMapleEdge URL structure)

Reading:
  Homepage displays: A static page
  Homepage: [create "Home" page later]
  Posts page: [create "Blog" page later]

Discussion:
  Uncheck "Allow people to submit comments" (affiliate sites don't need comments)
```

### Step 2.3 — Delete Default Content

- Delete "Hello World" post
- Delete "Sample Page"
- Delete default plugins (Hello Dolly, Akismet — you won't need them)

---

## 4. Phase 3 — Theme & Design

### What TheMapleEdge Uses (reference)
- Clean, professional design
- Dark header with logo
- White content area with lots of whitespace
- Card-based casino listings
- Green/dark color scheme (maple/Canadian branding)

### Free Theme Options

**Option A: flavor Theme (Recommended)**
- Purpose-built for affiliate/review sites
- Has review boxes, comparison tables, star ratings
- Free version available at wordpress.org

**Option B: flavor Theme**
- Lightweight, fast, highly customizable
- Pairs with flavor page builder
- Free version has everything you need

**Option C: flavor Theme**
- Modern starter theme
- Works great with flavor page builder (free)
- Very fast loading

### Step 3.1 — Install Theme

```
wp-admin → Appearance → Themes → Add New → Search "flavor Theme" → Install → Activate
```

### Step 3.2 — Customize Branding

```
wp-admin → Appearance → Customize:

Colors:
  Primary: #1a472a (dark green — Ontario/gaming feel)
  Secondary: #f5a623 (gold accent for CTAs)
  Background: #ffffff
  Text: #1a1a1a

Logo:
  Upload your OntarioGamers logo (create free at canva.com)
  Recommended size: 200x50px

Typography:
  Headings: Inter or Poppins (modern, clean)
  Body: system-ui or Inter
```

### Step 3.3 — Set Up Menus

```
Primary Navigation Menu:
├── Online Casinos (dropdown)
│   ├── Best Ontario Casinos
│   ├── Bet99 Review
│   ├── BetMGM Review
│   ├── DraftKings Review
│   └── All Casino Reviews
├── Online Slots (dropdown)
│   ├── Best Slots Ontario
│   ├── Gates of Olympus
│   ├── Sweet Bonanza
│   └── All Slot Reviews
├── Sports Betting (dropdown)
│   ├── Free Daily Picks
│   ├── NHL Picks
│   └── NBA Picks
├── Guides (dropdown)
│   ├── Ontario Casino Guide
│   └── Beginner's Guide
└── About

Footer Menu:
├── About Us
├── Responsible Gambling
├── Affiliate Disclosure
├── Privacy Policy
├── Terms & Conditions
└── Contact
```

---

## 5. Phase 4 — Plugins (All Free)

### Install These Plugins (all free from wordpress.org)

```
wp-admin → Plugins → Add New → Search & Install:
```

| Plugin | Purpose | Reference (TheMapleEdge equivalent) |
|--------|---------|-------------------------------------|
| **RankMath SEO** | SEO, sitemaps, schema markup | Their site is heavily SEO-optimized |
| **ACF (Advanced Custom Fields)** | Custom data fields for reviews | Casino ratings, RTP, bonus amounts |
| **flavor Starter Templates** | Pre-built page layouts | Quick homepage setup |
| **Pretty Links Lite** | Affiliate link cloaking/management | Their "Play Now" buttons |
| **WP Super Cache** | Page caching for speed | Fast page loads |
| **Wordfence Security** | Firewall, login protection | Security |
| **UpdraftPlus** | Automated backups | Backup to Google Drive (free) |
| **flavor/flavor Blocks** | Advanced Gutenberg blocks (tables, tabs) | Casino comparison tables |
| **flavor** | Create comparison tables | Casino comparison tables |
| **flavor** | TOC for long reviews | Their long-form content |
| **flavor** | Star ratings on reviews | Their rating system |
| **flavor** | Schema for reviews | Rich snippets in Google |
| **flavor** | Sticky elements (CTA bars) | Sticky "Play Now" bars |

### Plugin Configuration

**RankMath Setup Wizard:**
```
- Site Type: Blog/Personal (or News/Magazine)
- Business Type: Organization
- Name: OntarioGamers
- Enable: Sitemaps, SEO Analysis, Schema
- Analytics: Connect Google Search Console (free)
```

**ACF Custom Fields (create these field groups):**
```
Field Group: "Casino Review Fields"
  - casino_rating (Number, 1-10)
  - casino_bonus_amount (Text)
  - casino_bonus_description (Textarea)
  - casino_affiliate_url (URL)
  - casino_license (Text — e.g., "AGCO-registered")
  - casino_deposit_methods (Checkbox — Interac, Visa, etc.)
  - casino_withdrawal_time (Text)
  - casino_rtp_average (Number)
  - casino_logo (Image)
  Location rule: Post Type = Casino Reviews

Field Group: "Slot Review Fields"
  - slot_rtp (Number — e.g., 96.50)
  - slot_volatility (Select — Low/Medium/High)
  - slot_max_win (Text — e.g., "5000x")
  - slot_provider (Text — e.g., "Pragmatic Play")
  - slot_affiliate_url (URL)
  - slot_theme (Text)
  Location rule: Post Type = Slot Reviews
```

---

## 6. Phase 5 — Site Architecture & Pages

### How TheMapleEdge structures it → How we replicate it

```
TheMapleEdge                          OntarioGamers (our version)
─────────────                         ───────────────────────────
/                                     / (Homepage)
/online-casinos/                      /online-casinos/
/online-casinos/bet99-review/         /online-casinos/bet99-review/
/online-slots/                        /online-slots/
/online-slots/wolf-gold-canada/       /online-slots/gates-of-olympus-ontario/
/provinces/ontario/                   /guides/ontario-casino-guide/
/vanessa-phillimore/                  /author/[your-name]/
/about/                               /about/
/responsible-gambling/                 /responsible-gambling/
/affiliate-disclosure/                 /affiliate-disclosure/
/privacy-policy/                       /privacy-policy/
/terms-and-conditions/                 /terms-and-conditions/
```

### Step 5.1 — Create Custom Post Types (Free with plugin or functions.php)

Add to your theme's `functions.php` or use **CPT UI** plugin (free):

```php
// Casino Reviews Custom Post Type
function create_casino_post_type() {
    register_post_type('casino_reviews',
        array(
            'labels' => array(
                'name' => 'Casino Reviews',
                'singular_name' => 'Casino Review'
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'online-casinos'),
            'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
            'menu_icon' => 'dashicons-games',
        )
    );
}
add_action('init', 'create_casino_post_type');

// Slot Reviews Custom Post Type
function create_slot_post_type() {
    register_post_type('slot_reviews',
        array(
            'labels' => array(
                'name' => 'Slot Reviews',
                'singular_name' => 'Slot Review'
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'online-slots'),
            'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
            'menu_icon' => 'dashicons-screenoptions',
        )
    );
}
add_action('init', 'create_slot_post_type');
```

### Step 5.2 — Create All Pages

**Static Pages (create in wp-admin → Pages → Add New):**

| Page | URL Slug | Content Type |
|------|----------|--------------|
| Home | `/` (set as front page) | Custom layout with casino table + intro |
| About | `/about/` | Company info, methodology, team |
| Responsible Gambling | `/responsible-gambling/` | Helplines, tools, self-exclusion info |
| Affiliate Disclosure | `/affiliate-disclosure/` | Legal disclosure of affiliate earnings |
| Privacy Policy | `/privacy-policy/` | WP can auto-generate this |
| Terms & Conditions | `/terms-and-conditions/` | Legal terms |
| Ontario Casino Guide | `/guides/ontario-casino-guide/` | Province-specific guide |
| Author Page | `/author/[name]/` | Your bio, credentials, LinkedIn |

**Dynamic Content (Custom Post Types):**

| Content | URL Pattern | Example |
|---------|-------------|---------|
| Casino Reviews | `/online-casinos/[slug]/` | `/online-casinos/bet99-review/` |
| Slot Reviews | `/online-slots/[slug]/` | `/online-slots/gates-of-olympus-ontario/` |
| Blog Posts | `/blog/[slug]/` | `/blog/ontario-igaming-update-2026/` |

---

## 7. Phase 6 — Content Templates

### Casino Review Template (what each review page should contain)

Reference: TheMapleEdge's casino review structure

```
┌─────────────────────────────────────────────────────────┐
│ CASINO REVIEW PAGE TEMPLATE                             │
├─────────────────────────────────────────────────────────┤
│                                                         │
│ [Casino Logo]        [Rating: 8.5/10]                   │
│ [Casino Name] Review — Ontario 2026                     │
│ Author: [Name] | Last Updated: [Date]                   │
│                                                         │
│ ┌─────────────────────────────────────────────────────┐ │
│ │ QUICK INFO BOX                                      │ │
│ │ License: AGCO-registered ✓                          │ │
│ │ Bonus: 100% up to $1,500                            │ │
│ │ Deposit Methods: Interac, Visa, MasterCard          │ │
│ │ Withdrawal Time: 0-24 hours                         │ │
│ │ [PLAY NOW] button                                   │ │
│ └─────────────────────────────────────────────────────┘ │
│                                                         │
│ ## Table of Contents                                    │
│ ## Our Verdict                                          │
│ ## Bonus & Welcome Offer                                │
│ ## Game Library                                         │
│ ## Banking & Withdrawals                                │
│ ## Mobile Experience                                    │
│ ## Responsible Gambling Tools                           │
│ ## Customer Support                                     │
│ ## Final Rating                                         │
│                                                         │
│ [Responsible Gambling Disclaimer]                       │
│ [Affiliate Disclosure]                                  │
└─────────────────────────────────────────────────────────┘
```

### Slot Review Template

```
┌─────────────────────────────────────────────────────────┐
│ SLOT REVIEW PAGE TEMPLATE                               │
├─────────────────────────────────────────────────────────┤
│                                                         │
│ [Slot Screenshot]                                       │
│ [Slot Name] — Ontario Review 2026                       │
│ Author: [Name] | Last Updated: [Date]                   │
│                                                         │
│ ┌─────────────────────────────────────────────────────┐ │
│ │ QUICK STATS BOX                                     │ │
│ │ RTP: 96.50%                                         │ │
│ │ Volatility: High                                    │ │
│ │ Max Win: 5,000x                                     │ │
│ │ Provider: Pragmatic Play                            │ │
│ │ [PLAY NOW] button                                   │ │
│ └─────────────────────────────────────────────────────┘ │
│                                                         │
│ ## What Is [Slot Name]?                                 │
│ ## RTP & Volatility Explained                           │
│ ## Bonus Features & Mechanics                           │
│ ## Where to Play in Ontario (AGCO casinos)              │
│ ## Our Assessment                                       │
│                                                         │
│ [Responsible Gambling Disclaimer]                       │
└─────────────────────────────────────────────────────────┘
```

### Homepage Template

```
┌─────────────────────────────────────────────────────────┐
│ HOMEPAGE TEMPLATE (reference: themapleedge.com/)        │
├─────────────────────────────────────────────────────────┤
│                                                         │
│ ═══ HERO SECTION ═══                                    │
│ "Ontario's Independent Casino & Gaming Guide"           │
│ [CTA: Best Casinos] [CTA: Free Picks] [CTA: Slots]     │
│                                                         │
│ ═══ TRUST BADGES ═══                                    │
│ 🍁 Ontario Focused | ✅ AGCO Licensed Only |            │
│ 📊 RTP Verified | 🔒 Independent                       │
│                                                         │
│ ═══ CASINO COMPARISON TABLE ═══                         │
│ (Top 5-6 casinos with logo, bonus, Play Now button)     │
│ Each row: [Logo] [Name] [Bonus Text] [Read Review] [▶]  │
│ Below each: Legal disclaimer text                       │
│                                                         │
│ ═══ ONTARIO REGULATION SECTION ═══                      │
│ Brief explainer on AGCO + why licensed matters          │
│                                                         │
│ ═══ TOP SLOTS SECTION ═══                               │
│ Grid of 6 slot cards with image + RTP + Play button     │
│                                                         │
│ ═══ SPORTS PICKS SECTION ═══ (if applicable)            │
│ Link to daily picks page                                │
│                                                         │
│ ═══ HOW WE REVIEW SECTION ═══                           │
│ Methodology summary                                     │
│                                                         │
│ ═══ FOOTER ═══                                          │
│ Responsible gambling disclaimer                         │
│ Navigation links                                        │
│ Affiliate disclosure                                    │
│ © 2026 OntarioGamers                                    │
└─────────────────────────────────────────────────────────┘
```

---

## 8. Phase 7 — SEO Setup

### Why This Matters
TheMapleEdge ranks on Google for terms like "best online casino canada" — that's where ALL their traffic (and money) comes from.

### Step 7.1 — RankMath Configuration

```
RankMath → General Settings:
  ✓ Enable Sitemaps (auto-generates sitemap.xml)
  ✓ Enable SEO Analysis
  ✓ Enable Schema (Review schema for casino/slot pages)
  ✓ Enable Redirections

RankMath → Titles & Meta:
  Homepage Title: "Best Ontario Online Casinos 2026 — AGCO Licensed | OntarioGamers"
  Homepage Description: "Independent reviews of AGCO-registered Ontario casinos. 
                         Verified bonuses, RTP data, and honest assessments for 
                         Ontario players. Updated monthly."
```

### Step 7.2 — Schema Markup (Free via RankMath)

For Casino Reviews, add **Review schema**:
```
Type: Review
Item Reviewed: Casino/Organization
Rating: your score (e.g., 8.5/10)
Author: your name
```

This gives you star ratings in Google search results (rich snippets).

### Step 7.3 — Target Keywords

| Page | Primary Keyword | Monthly Searches (est.) |
|------|----------------|------------------------|
| Homepage | best online casino ontario | 5,000-10,000 |
| Casino hub | online casinos ontario | 3,000-5,000 |
| Bet99 review | bet99 review | 2,000-4,000 |
| BetMGM review | betmgm canada review | 1,000-3,000 |
| Slots hub | best online slots ontario | 1,000-2,000 |
| Gates of Olympus | gates of olympus canada | 2,000-5,000 |
| Ontario guide | is online gambling legal in ontario | 1,000-2,000 |

### Step 7.4 — E-E-A-T Setup (What TheMapleEdge does with Vanessa Phillimore)

Create an **Author Page** with:
- Real name (or pen name with consistent identity)
- Photo
- Bio explaining your iGaming expertise
- LinkedIn profile link
- List of published reviews
- Contact information

**Why:** Google trusts gambling content more when authored by named experts.

### Step 7.5 — Internal Linking Structure

```
Homepage
  ├── links to → Casino Hub (/online-casinos/)
  │                 ├── links to → Each casino review
  │                 │                 └── links back to hub + other reviews
  │                 └── links to → Ontario Guide
  ├── links to → Slots Hub (/online-slots/)
  │                 └── links to → Each slot review
  └── links to → Guides

Every page links to:
  - Responsible Gambling page (footer)
  - About page (footer)
  - Related content (sidebar or in-content)
```

---

## 9. Phase 8 — Performance & Security

### Step 8.1 — Cloudflare (Free CDN + Security)

1. Sign up at cloudflare.com (free)
2. Add your domain
3. Change nameservers at your registrar to Cloudflare's
4. Enable:
   - SSL: Full (Strict)
   - Caching: Standard
   - Minification: JS + CSS + HTML
   - Brotli compression: On

**Result:** Your site loads from Cloudflare's global CDN (300+ cities). Server barely touched.

### Step 8.2 — WP Super Cache Configuration

```
wp-admin → Settings → WP Super Cache:
  ✓ Caching On
  ✓ Use mod_rewrite (fastest method)
  ✓ Compress pages
  ✓ Don't cache pages for known users
```

### Step 8.3 — Image Optimization

- Use ShortPixel (free: 100 images/month) — auto-compresses uploads
- Use WebP format where possible
- Casino logos: keep under 50KB each
- Slot screenshots: keep under 150KB each

### Step 8.4 — Security Hardening

```
Wordfence (free):
  ✓ Enable Web Application Firewall
  ✓ Enable login attempt limiting (brute force protection)
  ✓ Enable 2FA for admin login
  ✓ Block known malicious IPs

Also:
  - Change default wp-login.php URL (use WPS Hide Login plugin — free)
  - Keep WordPress + plugins updated
  - Use strong passwords
  - Disable XML-RPC (not needed)
```

### Step 8.5 — Backups

```
UpdraftPlus (free):
  Schedule: Daily database backup, Weekly files backup
  Storage: Google Drive (free 15GB — more than enough)
  Retention: Keep last 7 daily, 4 weekly
```

---

## 10. Phase 9 — Affiliate Link Setup

### How TheMapleEdge Makes Money (and how you will too)

```
User reads review → clicks "Play Now" → redirected to casino with tracking ID
→ user signs up & deposits → casino pays you $50-200 CPA (cost per acquisition)
```

### Step 9.1 — Join Affiliate Programs

| Casino | Affiliate Program | Commission Type |
|--------|------------------|-----------------|
| Bet99 | Bet99 Affiliates | CPA or Revenue Share |
| BetMGM | BetMGM Partners | CPA $100-200 |
| DraftKings | DraftKings Affiliates | CPA or Rev Share |
| LeoVegas | LeoVegas Affiliates | Revenue Share 25-45% |
| JackpotCity | Rewards Affiliates | Revenue Share |
| Betway | Betway Partners | CPA or Rev Share |

Apply directly on each casino's affiliate page. You need:
- A live website (even with minimal content)
- Explanation of your traffic strategy (SEO)
- Ontario-focused positioning helps approval rates

### Step 9.2 — Pretty Links Setup

```
wp-admin → Pretty Links → Add New:

Title: Bet99 Affiliate Link
Target URL: https://bet99.com/?ref=YOUR_TRACKING_ID (from affiliate program)
Pretty Link: /go/bet99/
Tracking: Enabled
Redirect Type: 307 Temporary

Repeat for each casino.
```

**Result:** Your "Play Now" buttons link to `/go/bet99/` which redirects to the casino with your tracking code.

### Step 9.3 — Disclosure Compliance

Every page with affiliate links MUST have:
```
Affiliate Disclosure: OntarioGamers.com earns commission when you sign up 
through our links — at no extra cost to you. This does not influence our 
editorial recommendations. All operators listed are AGCO-registered.
```

Place this:
- Above the first affiliate link on every page
- In the footer of every page
- On a dedicated `/affiliate-disclosure/` page

---

## 11. Phase 10 — Launch Checklist

### Before Going Live

```
□ Domain pointing to server correctly (HTTPS working)
□ Homepage complete with casino comparison table
□ At least 3-5 casino reviews published
□ At least 3-5 slot reviews published
□ Ontario Guide page live
□ About page with author bio
□ Responsible Gambling page with helpline numbers
□ Affiliate Disclosure page
□ Privacy Policy page
□ Terms & Conditions page
□ RankMath SEO configured (titles, descriptions, schema)
□ Google Search Console connected (submit sitemap)
□ Google Analytics 4 installed
□ Cloudflare active
□ Caching working (test page speed at pagespeed.web.dev)
□ Backups configured and tested
□ Mobile responsive (test on phone)
□ All affiliate links working (click each one)
□ Responsible gambling disclaimer on EVERY page
□ 19+ age requirement stated
□ AGCO compliance language on Ontario content
□ Logo and branding consistent
□ Internal links connecting all pages
□ No broken links (use Broken Link Checker plugin — free)
□ XML sitemap submitted to Google
```

---

## 12. Ongoing — Content & Maintenance

### Weekly Tasks

| Task | Time | Tool |
|------|------|------|
| Publish 1-2 new reviews or guides | 2-4 hours | WordPress editor |
| Update existing reviews (bonus changes) | 30 min | WordPress editor |
| Check Google Search Console for issues | 15 min | Free Google tool |
| Monitor keyword rankings | 15 min | RankMath (free) |
| Backup verification | 5 min | UpdraftPlus |

### Monthly Tasks

| Task | Tool |
|------|------|
| Update all bonus amounts (casinos change these) | Manual check |
| Verify all affiliate links still work | Pretty Links report |
| Check AGCO operator list for changes | igamingontario.ca |
| Update "Last Updated" dates on reviews | WordPress editor |
| Review analytics — what content ranks | Google Analytics |
| Publish Ontario market news | WordPress editor |

### Content Roadmap (First 3 Months)

**Month 1 — Foundation (15-20 pages)**
```
Week 1: Homepage + About + Legal pages (5 pages)
Week 2: Top 3 casino reviews — Bet99, BetMGM, DraftKings
Week 3: Top 3 slot reviews — Gates of Olympus, Sweet Bonanza, Big Bass
Week 4: Ontario Casino Guide + Beginner's Guide
```

**Month 2 — Expansion (15-20 pages)**
```
Week 5-6: 3 more casino reviews — LeoVegas, JackpotCity, Betway
Week 7-8: 5 more slot reviews + Slots hub page
         + Blog posts on Ontario news
```

**Month 3 — Authority (15-20 pages)**
```
Week 9-10: Bonus comparison pages, payment method guides
Week 11-12: Sports betting content (if applicable)
            + Update all Month 1 content with fresh data
```

---

## Quick Reference — TheMapleEdge Features → Our Implementation

| TheMapleEdge Feature | How We Build It (Free) |
|---------------------|------------------------|
| Casino comparison table on homepage | flavor plugin (free) + styled with CSS |
| "Play Now" affiliate buttons | Pretty Links + styled Gutenberg buttons |
| Star ratings / scores | flavor plugin or RankMath review schema |
| Author page (Vanessa Phillimore) | Standard WordPress page + author bio |
| Casino review with structured data | ACF custom fields + RankMath review schema |
| Slot review with RTP/volatility box | ACF custom fields + Gutenberg group block |
| Province-specific guides | Standard WordPress pages |
| Responsible gambling footer | Reusable Gutenberg block (insert on all pages) |
| Mobile responsive design | Any modern free theme handles this |
| Fast page loads | WP Super Cache + Cloudflare (both free) |
| SEO-optimized URLs (/online-casinos/bet99-review/) | Custom Post Types with custom slugs |
| Sidebar with "New Casinos" widget | WordPress widget area (built-in) |
| Search functionality | WordPress built-in search |
| Breadcrumbs | RankMath (free, built-in) |

---

## Architecture Diagram

```
                    ┌─────────────────┐
                    │   Cloudflare    │ (FREE)
                    │   CDN + SSL     │
                    └────────┬────────┘
                             │
                    ┌────────▼────────┐
                    │  DigitalOcean   │ ($6/mo)
                    │  Ubuntu + Nginx │
                    │                 │
                    │  ┌───────────┐  │
                    │  │ WordPress │  │ (FREE)
                    │  │   PHP     │  │
                    │  └─────┬─────┘  │
                    │        │        │
                    │  ┌─────▼─────┐  │
                    │  │   MySQL   │  │ (FREE, included)
                    │  │  Database │  │
                    │  └───────────┘  │
                    │                 │
                    │  /wp-content/   │
                    │  └─ uploads/    │ (images on disk)
                    └─────────────────┘
                             │
              ┌──────────────┼──────────────┐
              │              │              │
     ┌────────▼──────┐ ┌────▼─────┐ ┌─────▼──────┐
     │ Google Search │ │ Google   │ │ Affiliate  │
     │ Console (FREE)│ │ Analytics│ │ Programs   │
     └───────────────┘ │ 4 (FREE) │ │ (earn $$$) │
                       └──────────┘ └────────────┘
```

---

## Summary — Total Cost to Launch

| Item | Cost | Frequency |
|------|------|-----------|
| Domain (.com) | $12 | /year |
| DigitalOcean Droplet | $6 | /month |
| WordPress | $0 | Forever |
| Theme | $0 | Free version |
| All Plugins | $0 | Free versions |
| Cloudflare CDN | $0 | Free tier |
| SSL Certificate | $0 | Let's Encrypt |
| Google Analytics | $0 | Free |
| Google Search Console | $0 | Free |
| Backups (Google Drive) | $0 | Free |
| **TOTAL YEAR 1** | **~$84** | |

Everything WordPress-related is **free**. You only pay for the domain and the server to run it on.
