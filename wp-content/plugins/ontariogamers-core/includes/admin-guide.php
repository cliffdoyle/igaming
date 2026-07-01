<?php
/**
 * In-Dashboard Admin Guide / Wiki
 *
 * Adds a "Site Guide" page inside wp-admin so admins and editors can read the
 * full instructions for populating the site without leaving WordPress.
 *
 * Menu: wp-admin → Site Guide
 */

if (!defined('ABSPATH')) {
    exit;
}

// Register the admin menu page
function ontariogamers_admin_guide_menu() {
    add_menu_page(
        'OntarioGamers Site Guide',   // page <title>
        'Site Guide',                  // menu label
        'edit_posts',                  // visible to editors + admins
        'ontariogamers-guide',         // menu slug
        'ontariogamers_render_admin_guide', // callback
        'dashicons-book-alt',          // icon
        3                              // position (near the top)
    );
}
add_action('admin_menu', 'ontariogamers_admin_guide_menu');

// A little styling for readability inside wp-admin
function ontariogamers_admin_guide_styles($hook) {
    if ($hook !== 'toplevel_page_ontariogamers-guide') {
        return;
    }
    ?>
    <style>
        .og-guide { max-width: 1000px; }
        .og-guide h2 { margin-top: 2em; padding-bottom: .3em; border-bottom: 2px solid #2271b1; }
        .og-guide h3 { margin-top: 1.5em; }
        .og-guide table { border-collapse: collapse; width: 100%; margin: 1em 0; background: #fff; }
        .og-guide th, .og-guide td { border: 1px solid #dcdcde; padding: 8px 12px; text-align: left; vertical-align: top; }
        .og-guide th { background: #f6f7f7; }
        .og-guide code { background: #f0f0f1; padding: 2px 6px; border-radius: 3px; }
        .og-guide .og-toc { background: #fff; border: 1px solid #dcdcde; border-radius: 4px; padding: 1em 1.5em; }
        .og-guide .og-note { background: #fcf9e8; border-left: 4px solid #dba617; padding: 12px 16px; margin: 1em 0; }
        .og-guide .og-warn { background: #fcf0f1; border-left: 4px solid #d63638; padding: 12px 16px; margin: 1em 0; }
        .og-guide ul { list-style: disc; margin-left: 1.5em; }
        .og-guide ol { margin-left: 1.5em; }
    </style>
    <?php
}
add_action('admin_enqueue_scripts', 'ontariogamers_admin_guide_styles');

// Render the guide
function ontariogamers_render_admin_guide() {
    ?>
    <div class="wrap og-guide">
        <h1><span class="dashicons dashicons-book-alt" style="font-size:30px;width:30px;height:30px;"></span> OntarioGamers — Site Guide</h1>
        <p>Everything you need to run the site from this dashboard. No coding required.</p>

        <div class="og-note">
            <strong>Golden rule:</strong> <em>Content</em> (casinos, slots, pages, menus, images) is edited here in wp-admin.
            <em>Design/layout code</em> is changed by the developer via Git.
        </div>

        <div class="og-toc">
            <strong>Contents</strong>
            <ol>
                <li><a href="#og-structure">How the site is organised</a></li>
                <li><a href="#og-flow">How each admin page reaches the live site</a></li>
                <li><a href="#og-casino">Adding a Casino Review (all fields)</a></li>
                <li><a href="#og-slot">Adding a Slot Review (all fields)</a></li>
                <li><a href="#og-images">Featured images / logos</a></li>
                <li><a href="#og-tax">Categories &amp; game providers</a></li>
                <li><a href="#og-order">Controlling display order</a></li>
                <li><a href="#og-pages">Editing static pages</a></li>
                <li><a href="#og-menus">Navigation menus (header &amp; footer)</a></li>
                <li><a href="#og-logo">Site logo &amp; title</a></li>
                <li><a href="#og-widgets">Sidebar widgets</a></li>
                <li><a href="#og-agco">AGCO / legal content rules</a></li>
                <li><a href="#og-checklist">Publishing checklist</a></li>
                <li><a href="#og-news">Posting news &amp; articles</a></li>
                <li><a href="#og-seo">Search engine optimisation (SEO)</a></li>
                <li><a href="#og-backlinks">Backlinks &amp; off-page SEO</a></li>
                <li><a href="#og-email">Work email on the domain</a></li>
                <li><a href="#og-analytics">Monitoring traffic (Analytics)</a></li>
                <li><a href="#og-trouble">Troubleshooting</a></li>
            </ol>
        </div>

        <h2 id="og-structure">1. How the Site Is Organised</h2>
        <p>The site is built around three content types, each in the left admin menu:</p>
        <table>
            <tr><th>Admin menu item</th><th>What it is</th><th>Public URL</th></tr>
            <tr><td><strong>Casino Reviews</strong></td><td>One entry per online casino (Bet99, BetMGM…)</td><td><code>/online-casinos/</code></td></tr>
            <tr><td><strong>Slot Reviews</strong></td><td>One entry per slot game (Gates of Olympus…)</td><td><code>/online-slots/</code></td></tr>
            <tr><td><strong>Pages</strong></td><td>Static pages (About, Privacy, Contact…)</td><td>e.g. <code>/about/</code></td></tr>
        </table>
        <p>The <strong>homepage</strong> automatically pulls in your top 6 casino reviews and top 6 slot reviews — you never edit the homepage directly, you just add and order reviews.</p>

        <h3>The two halves of the site</h3>
        <p>It helps to picture the site as two layers working together:</p>
        <table>
            <tr><th>Layer</th><th>What it means</th><th>Who changes it</th></tr>
            <tr><td><strong>Content</strong></td><td>The words, numbers, images, reviews, menus and pages — everything a visitor reads.</td><td><strong>You</strong>, here in wp-admin. No code.</td></tr>
            <tr><td><strong>Design / template</strong></td><td>The layout, colours, fonts, the comparison table, the logo shape — <em>how</em> the content is arranged.</td><td>The <strong>developer</strong>, via Git.</td></tr>
        </table>
        <p>So when you add a casino, you are <em>not</em> building a page by hand. You are filling in a form (the fields). The template then takes those values and “pours” them into a ready-made layout. That is why every review page looks consistent.</p>

        <h2 id="og-flow">2. How Each Admin Page Reaches the Live Site</h2>
        <p>Every editable area in wp-admin maps to a specific spot on the public website. This table is the “map” — change something on the left, and it appears on the right:</p>
        <table>
            <tr><th>You edit this in wp-admin…</th><th>…and this changes on the live site</th></tr>
            <tr><td><strong>Casino Reviews →</strong> add / edit an entry</td><td>The casino's own review page, the <code>/online-casinos/</code> list, <em>and</em> the comparison table on the homepage (if it's in the top 6 by Order).</td></tr>
            <tr><td><strong>Slot Reviews →</strong> add / edit an entry</td><td>The slot's review page, the <code>/online-slots/</code> list, and the “Top Slots” block on the homepage.</td></tr>
            <tr><td><strong>Pages →</strong> edit About / Contact / etc.</td><td>That exact static page (e.g. <code>/about/</code>). Only the page you edit changes.</td></tr>
            <tr><td><strong>Appearance → Menus</strong></td><td>The header navigation <em>and</em> the mobile hamburger menu (they share one menu).</td></tr>
            <tr><td><strong>Appearance → Customize → Site Identity</strong></td><td>The logo and the browser-tab icon (favicon).</td></tr>
            <tr><td><strong>Appearance → Widgets</strong></td><td>The sidebar on review pages and the footer widget columns.</td></tr>
            <tr><td><strong>Settings → General</strong></td><td>Site title, tagline, timezone.</td></tr>
        </table>
        <h3>What “Publish” and “Update” actually do</h3>
        <p>When you click <strong>Publish</strong> (new item) or <strong>Update</strong> (existing item), WordPress saves your values into the site database and the change is live <strong>immediately</strong> — there is no separate “deploy” step for content. Refresh the public page to see it.</p>
        <div class="og-note"><strong>Draft vs Publish:</strong> An item saved as <strong>Draft</strong> is <em>not</em> visible to the public. Only <strong>Published</strong> items appear on the site. Use <strong>Preview</strong> to check a draft before publishing.</div>
        <div class="og-note"><strong>If a change doesn't appear:</strong> your browser may be showing a cached copy. Hard-refresh with <code>Ctrl</code>+<code>Shift</code>+<code>R</code> (Windows) or <code>Cmd</code>+<code>Shift</code>+<code>R</code> (Mac). Brand-new review URLs may also need a one-time <strong>Settings → Permalinks → Save Changes</strong> (see Troubleshooting).</div>

        <h2 id="og-casino">3. Adding a Casino Review (All Fields)</h2>
        <p><strong>Casino Reviews → Add New Casino</strong></p>
        <p><em>How it works:</em> a casino review is a single entry made of two parts — the <strong>written review</strong> (the main editor) and a set of <strong>structured fields</strong> (the details panel). The written part appears on the casino's own page; the structured fields are what feed the comparison table, the rating badge and the “Play Now” button across the site. Filling the fields accurately is what keeps every casino card looking uniform.</p>
        <p><strong>Step A — Main content:</strong> Put the casino name in the <strong>Title</strong>, and the full written review in the main editor (use Heading blocks for sections).</p>
        <p><strong>Step B — "Casino Review Details" panel</strong> (below the editor). Every field feeds the comparison table and review box:</p>
        <table>
            <tr><th>Field</th><th>Example</th><th>Shows on site as</th></tr>
            <tr><td>Rating (1–10)</td><td><code>9.2</code></td><td>The ⭐ score / "9.2/10"</td></tr>
            <tr><td>Bonus Description</td><td><code>Welcome bonus available — see operator</code></td><td>"Welcome Bonus" line <em>(see §12 AGCO rules)</em></td></tr>
            <tr><td>Affiliate URL</td><td><code>https://bet99.com/?aff=...</code></td><td>The green "Play Now" button link</td></tr>
            <tr><td>License</td><td><code>AGCO-registered</code></td><td>The ✓ License badge</td></tr>
            <tr><td>Deposit Methods</td><td><code>Interac, Visa, Mastercard</code></td><td>"Deposit Methods" row</td></tr>
            <tr><td>Withdrawal Time</td><td><code>0–24 hours</code></td><td>"Withdrawal Time" row + ⏱ in table</td></tr>
            <tr><td>Minimum Deposit</td><td><code>$10</code></td><td>"Min Deposit" row</td></tr>
            <tr><td>Year Established</td><td><code>2020</code></td><td>"Established" row</td></tr>
        </table>
        <div class="og-note">Leave any field <strong>blank</strong> and it simply won't show — the layout adapts automatically.</div>
        <p><strong>Step C —</strong> Set the casino <strong>logo</strong> as the <em>Featured Image</em> (see §4). <strong>Step D —</strong> click <strong>Publish</strong>.</p>

        <h3>Worked example: the "All Slots Casino" review (step by step)</h3>
        <p>This is exactly how the live <a href="https://ontariogamers.ca/online-casinos/all-slots-casino/" target="_blank">All Slots Casino</a> review was built. Follow the same steps for any new casino.</p>
        <ol>
            <li><strong>Open it:</strong> left menu → <strong>Casino Reviews → All Casino Reviews</strong> → click <strong>All Slots Casino</strong>. (For a brand-new one, click <strong>Add New Casino Review</strong> instead.)</li>
            <li><strong>Title:</strong> type the casino name — <code>All Slots Casino</code>. The page automatically shows it as "All Slots Casino — Ontario Review 2026".</li>
            <li><strong>Write the review (main editor):</strong> paste the full write-up. Use <strong>Heading</strong> blocks for each section (First Impression, Bonuses, Games, Banking, Customer Support, FAQs…) and <strong>Table</strong> blocks for the Overview, Payment Methods and Comparison tables. Drop the section images (Welcome Promo, Slots, Banking, etc.) where they belong.</li>
            <li><strong>Set the logo:</strong> open the <strong>⚙ settings panel</strong> (top-right) → <strong>Featured image</strong> → choose the casino logo (<code>LOGO_asc_300x300</code>). This is the small logo shown in the promo box.</li>
            <li><strong>Fill the "Casino Review Details" panel</strong> (scroll below the editor) with the exact values below:</li>
        </ol>
        <table>
            <tr><th>Field</th><th>Value used for All Slots Casino</th></tr>
            <tr><td>Rating (1–10)</td><td><code>8.6</code></td></tr>
            <tr><td>Bonus Description</td><td><code>Up to $1,500 + Free Spins</code></td></tr>
            <tr><td>Affiliate URL</td><td><code>your All Slots affiliate tracking link</code></td></tr>
            <tr><td>License</td><td><code>Kahnawake Gaming Commission #00892</code></td></tr>
            <tr><td>Deposit Methods</td><td><code>Interac, Visa, Mastercard, Neosurf, Google Pay, Crypto</code></td></tr>
            <tr><td>Withdrawal Time</td><td><code>24 hours to 7 days</code></td></tr>
            <tr><td>Minimum Deposit</td><td><code>$5</code></td></tr>
            <tr><td>Year Established</td><td><code>2002</code></td></tr>
        </table>
        <ol start="6">
            <li><strong>Publish / Update:</strong> click the blue <strong>Save / Update</strong> button (top-right). Refresh the live page to see your changes.</li>
        </ol>
        <div class="og-note"><strong>Images link themselves.</strong> Any image you place inside a casino review is <em>automatically</em> turned into a clickable link to that casino's <strong>Affiliate URL</strong> — along with the logo, the casino name, the <strong>CLAIM BONUS</strong> button and the <strong>Play Now</strong> button. You don't have to link them by hand.</div>
        <div class="og-note"><strong>To link one specific image manually</strong> (anywhere on the site): click the image → click the <strong>link (🔗) icon</strong> → paste the URL → turn on <strong>"Open in new tab"</strong>.</div>
        <div class="og-warn"><strong>Most important field = Affiliate URL.</strong> That single link is what earns commission — every logo, button and image routes through it. Always paste your real tracking link before publishing.</div>

        <h2 id="og-slot">4. Adding a Slot Review (All Fields)</h2>
        <p><strong>Slot Reviews → Add New Slot.</strong> Title = slot name; body = written review. Then fill the <strong>"Slot Review Details"</strong> panel:</p>
        <table>
            <tr><th>Field</th><th>Example</th></tr>
            <tr><td>RTP (%)</td><td><code>96.50</code> (decimals OK, 80–99.99)</td></tr>
            <tr><td>Volatility</td><td><code>High</code> (Low / Medium / High)</td></tr>
            <tr><td>Max Win</td><td><code>5000x</code></td></tr>
            <tr><td>Provider</td><td><code>Pragmatic Play</code></td></tr>
            <tr><td>Theme</td><td><code>Greek Mythology</code></td></tr>
            <tr><td>Reels</td><td><code>6x5</code></td></tr>
            <tr><td>Paylines/Ways</td><td><code>Scatter Pays</code></td></tr>
            <tr><td>Min Bet (CAD)</td><td><code>$0.20</code></td></tr>
            <tr><td>Max Bet (CAD)</td><td><code>$125</code></td></tr>
            <tr><td>Affiliate URL</td><td><code>https://...</code></td></tr>
        </table>
        <p>Set a slot screenshot/thumbnail as the Featured Image, then <strong>Publish</strong>.</p>

        <h2 id="og-images">5. Featured Images / Logos</h2>
        <p>The <strong>Featured Image</strong> is the casino logo or slot artwork. In the editor sidebar click <strong>Set featured image</strong> → upload → set. If the box is missing, enable it via <strong>Screen Options</strong> (top right).</p>
        <table>
            <tr><th>Use</th><th>Ideal upload size</th></tr>
            <tr><td>Casino logo</td><td>~320×320 px, square, transparent PNG</td></tr>
            <tr><td>Slot thumbnail</td><td>~800×500 px, landscape</td></tr>
        </table>
        <div class="og-note">Always fill in <strong>Alt Text</strong> when uploading (SEO + accessibility).</div>

        <h2 id="og-tax">6. Categories &amp; Game Providers</h2>
        <table>
            <tr><th>Taxonomy</th><th>Attached to</th><th>Examples</th></tr>
            <tr><td>Casino Categories</td><td>Casino Reviews</td><td>Live Casino, New 2026, Interac Casinos</td></tr>
            <tr><td>Slot Categories</td><td>Slot Reviews</td><td>Megaways, Cluster Pays, Jackpot</td></tr>
            <tr><td>Game Providers</td><td>Casinos &amp; Slots</td><td>Pragmatic Play, NetEnt, Evolution</td></tr>
        </table>
        <p>Tick an existing term or type a new one in the box on the right of the editor.</p>

        <h2 id="og-order">7. Controlling the Order Things Appear</h2>
        <p>The homepage and listings order items by the <strong>"Order"</strong> number (lowest first). Open a review → <strong>Page Attributes</strong> box → set <strong>Order</strong> to <code>1</code> for your top pick, <code>2</code> next, and so on → <strong>Update</strong>. Give every item a unique number.</p>

        <h2 id="og-pages">8. Editing Static Pages</h2>
        <p>Pre-built pages: <code>/about/</code>, <code>/responsible-gambling/</code>, <code>/affiliate-disclosure/</code>, <code>/privacy-policy/</code>, <code>/terms-and-conditions/</code>, <code>/contact/</code>.</p>
        <p><em>How it works:</em> unlike casino/slot reviews (which use fixed fields), a <strong>Page</strong> is free-form — whatever you type in the editor is what shows. These pages were created once for you and your edits are saved straight to the database. They are never overwritten by code updates.</p>
        <p>Edit via <strong>Pages → All Pages → Edit</strong>. Add a new page via <strong>Pages → Add New</strong>.</p>

        <h2 id="og-menus">9. Navigation Menus (Header &amp; Footer)</h2>
        <p><strong>Appearance → Menus.</strong> Build a menu, tick pages/reviews/custom links → <strong>Add to Menu</strong>, drag to reorder (drag right = dropdown sub-item), then under <strong>Menu Settings</strong> assign it to a <strong>menu location</strong> and <strong>Save</strong>.</p>
        <div class="og-note">The same Primary Menu automatically powers the <strong>mobile hamburger</strong> ☰ — no separate setup. Test by narrowing your browser or opening the site on a phone.</div>
        <h3>Footer columns are editable too</h3>
        <p>The four footer columns are now controlled from the same <strong>Appearance → Menus</strong> screen. Each column has its own location:</p>
        <table>
            <tr><th>Menu location</th><th>Footer column it fills</th></tr>
            <tr><td><strong>Footer Column 1 — Casinos</strong></td><td>The "Casinos" column</td></tr>
            <tr><td><strong>Footer Column 2 — Slots</strong></td><td>The "Slots" column</td></tr>
            <tr><td><strong>Footer Column 3 — Sports Betting</strong></td><td>The "Sports Betting" column</td></tr>
            <tr><td><strong>Footer Column 4 — OntarioGamers</strong></td><td>The "OntarioGamers" column</td></tr>
        </table>
        <p><strong>How to replace the example links:</strong> create a menu (e.g. "Footer Casinos"), add <strong>Pages</strong> or <strong>Custom Links</strong> that point to real pages, assign it to the matching footer location, and Save. Your menu instantly replaces the placeholder examples in that column.</p>
        <div class="og-note">Until you assign a menu to a footer location, the column shows built-in <strong>example links</strong> (some marked "(example)") that may not lead anywhere yet. Assigning your own menu makes them real — exactly like the About/Contact pages.</div>

        <h2 id="og-logo">10. Site Logo, Title &amp; Favicon</h2>
        <p><strong>Appearance → Customize → Site Identity.</strong> Set the site title/tagline here.</p>
        <p><em>How the logo works:</em> by default the header shows the built-in <strong>gamified “OntarioGamers” wordmark</strong> — a gold game-controller icon next to the name, with the “Gamers” half in gold. If you'd rather use a custom image instead, upload one under <strong>Logo</strong> in Site Identity and it automatically replaces the built-in wordmark everywhere.</p>
        <p><em>How the favicon (browser-tab icon) works:</em> the site ships with the <strong>Ontario white trillium</strong> — the province's official flower — shown in white with a gold centre on a green tile. It appears in the browser tab and when the site is bookmarked. To use your own instead, upload a square image (512×512 px) under <strong>Site Icon</strong> in Site Identity — an uploaded Site Icon always takes priority over the built-in one.</p>

        <h2 id="og-widgets">11. Sidebar Widgets</h2>
        <p><strong>Appearance → Widgets.</strong> Drag widgets into <strong>Main Sidebar</strong> (shows on review pages) or <strong>Footer Column 1</strong>, then Save.</p>

        <h2 id="og-agco">12. AGCO / Legal Content Rules (Important)</h2>
        <div class="og-warn">
            <ul>
                <li><strong>Bonus terms cannot be publicly advertised</strong> to Ontario players (AGCO Standard 11.10). Keep the <strong>Bonus Description</strong> generic — e.g. "Welcome bonus available — see operator for terms" — not exact figures.</li>
                <li>Keep <strong>19+</strong> and responsible-gambling messaging intact (added automatically by the theme).</li>
                <li>Only list operators that are <strong>AGCO-registered / verified on iGaming Ontario</strong>.</li>
                <li>The <strong>Affiliate Disclosure</strong> appears automatically on review pages — don't remove it.</li>
            </ul>
        </div>

        <h2 id="og-checklist">13. Publishing Checklist</h2>
        <ul>
            <li>Title is the correct casino/slot name</li>
            <li>Full review written with H2/H3 headings</li>
            <li>All Review Details fields filled</li>
            <li>Affiliate URL correct and tested</li>
            <li>Featured Image set with Alt text</li>
            <li>Order number set (Page Attributes)</li>
            <li>Category / Provider assigned</li>
            <li>Previewed on desktop <strong>and</strong> mobile</li>
        </ul>

        <h2 id="og-news">14. Posting News &amp; Articles</h2>
        <p>The site has a built-in <strong>News &amp; Guides</strong> section at <code>/news/</code>. Fresh articles are the single best way to bring free Google traffic — every guide you publish becomes a new page Google can rank, and a place to link to your casino and slot reviews.</p>
        <h3>How to post an article</h3>
        <ol>
            <li>Go to <strong>Posts → Add New</strong> (the standard “Posts” menu, not Casino/Slot Reviews).</li>
            <li><strong>Title:</strong> write it the way someone would search Google — e.g. “How to Read Slot RTP” or “Best Ontario Casino Bonuses Explained”.</li>
            <li><strong>Body:</strong> write the article in the editor. Use <strong>Heading</strong> blocks (H2/H3) to break it into sections — this helps both readers and Google.</li>
            <li><strong>Category</strong> (right-hand panel): tick one — <em>Casino News</em>, <em>Sports Betting</em>, <em>Slots</em> or <em>Guides</em>. This files the article under the right section.</li>
            <li><strong>Featured image</strong> (right-hand panel): set one so the article card looks good. Add <strong>Alt text</strong> describing the image.</li>
            <li><strong>Internal links:</strong> inside the article, link words like “Bet99” or “Gates of Olympus” to their review pages. Highlight the text → click the link icon → search the review. This passes visitors (and Google authority) to your money pages.</li>
            <li>Click <strong>Publish</strong>. The article appears instantly at <code>/news/</code>, in its category, and in the “Latest News” strip on the homepage.</li>
        </ol>
        <div class="og-note"><strong>Tip:</strong> aim for one helpful, well-written article a week. Quality and usefulness beat quantity — a single 1,000-word guide that genuinely answers a question will out-rank ten thin posts.</div>
        <div class="og-warn">Don’t paste articles copied from other sites. Duplicate content is ignored (or penalised) by Google and can hurt the whole domain. Always write original copy.</div>

        <h2 id="og-seo">15. Search Engine Optimisation (SEO)</h2>
        <p>SEO is how you get found on Google without paying for ads. Good news: the most important <strong>technical</strong> SEO is already built into this site by the developer. Your job is mainly to keep writing good content and complete the one-time Google setup below.</p>

        <h3>What’s already built in (automatic, no action needed)</h3>
        <table>
            <tr><th>Feature</th><th>What it does for you</th></tr>
            <tr><td><strong>Meta titles &amp; descriptions</strong></td><td>Every page automatically outputs the title and a description tag — this is the blue headline and grey text Google shows in search results.</td></tr>
            <tr><td><strong>Open Graph / Twitter cards</strong></td><td>When a page is shared on Facebook, X or WhatsApp, it shows a proper title, description and image instead of a bare link.</td></tr>
            <tr><td><strong>Schema markup (star ratings)</strong></td><td>Casino and slot reviews output <code>Review</code> structured data with your rating, and articles output <code>Article</code> data. This is what lets Google show review stars and rich snippets next to your listing.</td></tr>
            <tr><td><strong>XML sitemap</strong></td><td>A live map of every page is auto-generated at <code>/wp-sitemap.xml</code> — you submit this to Google (below) so it can find all your pages.</td></tr>
            <tr><td><strong>Canonical URLs</strong></td><td>Tells Google the one true address of each page, preventing “duplicate content” problems.</td></tr>
        </table>

        <h3>One-time setup: submit your sitemap to Google Search Console</h3>

        <h4>Why we need to do this</h4>
        <p>Building the site doesn't automatically put it on Google. Google has to <em>discover</em> your pages, <em>read</em> them, and add them to its index before anyone can find you in search. <strong>Google Search Console</strong> is a free Google tool that:</p>
        <ul>
            <li><strong>Tells Google your site exists</strong> and hands it your <strong>sitemap</strong> (the list of every page at <code>/wp-sitemap.xml</code>) so it indexes all your pages quickly instead of stumbling on them slowly.</li>
            <li><strong>Shows you how you're doing</strong> — which search terms bring visitors, which pages rank, your click numbers, and any errors Google hit.</li>
            <li><strong>Lets you request indexing</strong> of brand-new articles so they appear in Google faster.</li>
            <li><strong>Reports problems</strong> — broken pages, mobile issues, security flags — so you can fix them.</li>
        </ul>
        <p>In short: without it you're invisible to Google and flying blind. It's a one-time setup, then it just runs.</p>

        <h4>Step 1 &mdash; Create the account &amp; add your site</h4>
        <ol>
            <li>Go to <a href="https://search.google.com/search-console" target="_blank" rel="noopener">search.google.com/search-console</a> and sign in with the Google account you want to own the site's data (tip: use the <em>same</em> account as Google Analytics &mdash; it makes verification one click).</li>
            <li>Click <strong>Add property</strong>. You'll see two boxes &mdash; choose the left one, <strong>Domain</strong>, type <code>ontariogamers.ca</code> (no <code>https://</code>, no <code>www</code>) and click <strong>Continue</strong>.</li>
        </ol>

        <h4>Step 2 &mdash; Prove you own the site (verification)</h4>
        <p>Google needs proof you control the domain. Because our DNS is at Cloudflare, Google offers a <strong>one-click route</strong>:</p>
        <ol>
            <li>Google shows an <strong>&ldquo;Authorize DNS records from Google&rdquo;</strong> screen with a <code>TXT</code> record it wants to add to Cloudflare. Click the blue <strong>Authorize</strong> button &mdash; Google adds the record into Cloudflare for you (a one-time, safe authorization).</li>
            <li>It returns to Search Console and shows <strong>&ldquo;Ownership verified&rdquo;</strong>. (If not instant, wait a minute and click <strong>Verify</strong>.)</li>
        </ol>
        <div class="og-note"><strong>Manual fallback:</strong> if the one-click box doesn't appear, copy the <code>TXT</code> value Google gives you and add it in <strong>Cloudflare &rarr; DNS &rarr; Add record</strong> (Type <code>TXT</code>, Name <code>@</code>, Content = the value), Save, then click <strong>Verify</strong>. Don't wrap the value in extra quotes.</div>

        <h4>Step 3 — Submit the sitemap</h4>
        <ol>
            <li>Once verified, click into the property, then open <strong>Sitemaps</strong> in the left-hand menu.</li>
            <li>In the &ldquo;Add a new sitemap&rdquo; box, type the <strong>full URL</strong> <code>https://ontariogamers.ca/wp-sitemap.xml</code> and click <strong>Submit</strong>. (If it rejects the short <code>wp-sitemap.xml</code> as &ldquo;invalid&rdquo;, the full URL always works.)</li>
            <li>It may say <strong>&ldquo;Couldn't fetch&rdquo;</strong> for the first few hours &mdash; that's normal right after submitting. It changes to <strong>Success</strong> once Google fetches it, then re-reads it automatically as you add pages.</li>
        </ol>

        <h4>Step 4 (optional) — Do the same on Bing</h4>
        <p>Repeat the property + sitemap steps at <a href="https://www.bing.com/webmasters" target="_blank" rel="noopener">Bing Webmaster Tools</a> to cover Bing &amp; DuckDuckGo. Bing can even import everything straight from Search Console in one click.</p>

        <div class="og-note"><strong>What to expect:</strong> indexing is not instant — new pages take a few days to a couple of weeks to appear. After ~2–3 days, check Search Console → <strong>Pages</strong> to confirm pages are "Indexed", and <strong>Performance</strong> to watch clicks and search terms start coming in.</div>

        <h3>Reading your Search Console data (who finds &amp; clicks you on Google)</h3>
        <p>Search Console answers one question: <em>&ldquo;how do people find me on Google, and do they click?&rdquo;</em> The main report is <strong>Performance &rarr; Search results</strong>. Four numbers matter:</p>
        <table>
            <tr><th>Metric</th><th>Plain meaning</th></tr>
            <tr><td><strong>Impressions</strong></td><td>How many times a page of mine <em>appeared</em> in someone's Google results. High impressions = Google is showing me.</td></tr>
            <tr><td><strong>Clicks</strong></td><td>How many of those people actually <em>clicked through</em> to my site. This is real Google traffic.</td></tr>
            <tr><td><strong>CTR</strong> (click-through rate)</td><td>Clicks &divide; impressions, as a %. Low CTR with high impressions = I'm showing up but my title/description isn't tempting enough &mdash; rewrite the Excerpt.</td></tr>
            <tr><td><strong>Position</strong></td><td>My average ranking spot for that term (1 = top). Closer to 1 = more clicks. Anything past page 1 (position ~10+) gets few clicks.</td></tr>
        </table>
        <p>Useful tabs inside that report:</p>
        <ul>
            <li><strong>Queries</strong> &mdash; the exact words people typed to find me. Gold for ideas: write more articles around terms that already bring impressions.</li>
            <li><strong>Pages</strong> &mdash; which of my URLs get the most clicks/impressions.</li>
            <li><strong>Indexing &rarr; Pages</strong> &mdash; confirms which pages are <em>Indexed</em> (eligible to show) vs excluded, and why.</li>
            <li><strong>URL inspection</strong> (top search bar) &mdash; paste a brand-new article's URL and click <strong>Request indexing</strong> to nudge Google to read it sooner.</li>
        </ul>
        <div class="og-note"><strong>How I make sense of it:</strong> rising <em>impressions</em> = my SEO is working and Google trusts me more; rising <em>clicks</em> = people are choosing my result. If impressions are high but clicks are low, I improve titles/descriptions. If a query is at position 8&ndash;15, a stronger article on that exact topic can push it onto page 1.</div>

        <h3>Everyday SEO habits (your part)</h3>
        <ul>
            <li><strong>Write for a real question.</strong> Put the phrase people search into your title and first paragraph.</li>
            <li><strong>Fill the excerpt.</strong> On any post/review, the <em>Excerpt</em> field becomes the Google description — write a tempting one sentence.</li>
            <li><strong>Always set a featured image with Alt text.</strong></li>
            <li><strong>Link internally</strong> between articles and reviews (see §14).</li>
            <li><strong>Keep content fresh</strong> — update older reviews when bonuses or facts change.</li>
        </ul>
        <div class="og-note"><strong>Want a full SEO dashboard?</strong> You can optionally install <strong>Rank Math</strong> or <strong>Yoast</strong> from <strong>Plugins → Add New</strong> for a point-and-click interface and content scoring. If you do, the site’s built-in SEO automatically steps aside so you won’t get duplicate tags. For a small 1 GB server, the built-in SEO is usually all you need.</div>

        <h2 id="og-backlinks">16. Backlinks &amp; Off-Page SEO</h2>
        <p>A <strong>backlink</strong> is simply a link from another website to yours. Google treats each quality backlink as a “vote of confidence” — sites with more trustworthy links tend to rank higher. This is the single biggest factor you influence <em>off</em> your own site.</p>
        <h3>The golden rule: quality over quantity</h3>
        <p>One link from a respected, <em>relevant</em> site (an Ontario news outlet, a well-known gambling portal) is worth more than hundreds of links from random low-quality pages. Relevance and trust matter most.</p>
        <h3>How to earn good backlinks</h3>
        <ul>
            <li><strong>Create link-worthy content:</strong> original guides, data, or “best of” lists that other sites <em>want</em> to reference (this is why the News section matters).</li>
            <li><strong>Industry directories &amp; portals:</strong> get listed on reputable gambling-affiliate directories such as <em>Gambling.com</em>, <em>AskGamblers</em>, <em>Casino.org</em> and similar Ontario/Canada-focused listings.</li>
            <li><strong>Guest posts:</strong> write a useful article for another relevant blog that links back to a page on your site.</li>
            <li><strong>Press &amp; data angles:</strong> publish original stats or commentary on Ontario iGaming; journalists and bloggers link to sources.</li>
            <li><strong>Forums &amp; communities:</strong> genuinely help in gambling/sports communities and link only where it adds value — this drives direct traffic even when the link doesn’t pass much SEO weight.</li>
        </ul>
        <div class="og-warn"><strong>Avoid “black-hat” link schemes.</strong> Never <em>buy</em> bulk links, use automated link-spam tools, or swap links in “link farms”. Google actively penalises these and it can get your whole site demoted or de-indexed. Slow, genuine link-building wins.</div>
        <div class="og-note"><strong>Track your links:</strong> in Google Search Console, <strong>Links → External links</strong> shows which sites link to you and which pages they point at.</div>

        <h2 id="og-email">17. Work Email on the Domain (e.g. info@ontariogamers.ca)</h2>
        <p>I set up a branded email address on our own domain so messages look professional (<code>info@ontariogamers.ca</code> instead of a personal Gmail). Here&rsquo;s exactly how I did it and how to add more addresses later.</p>

        <h3>Which option I chose</h3>
        <p>Email can do two things &mdash; <strong>receive</strong> and <strong>send</strong> &mdash; and they&rsquo;re set up differently. I started with <strong>Cloudflare Email Routing</strong> because it&rsquo;s free and forwards anything sent to our domain straight into my existing Gmail inbox. If I later need to <em>reply from</em> the branded address for partnerships, I&rsquo;ll move up to a full mailbox (Zoho free or Google Workspace) &mdash; see the bottom of this section.</p>

        <h3>Step 1 &mdash; Turn on Email Routing in Cloudflare</h3>
        <ol>
            <li>Log into <strong>dash.cloudflare.com</strong> from a normal browser (not the server &mdash; the Ubuntu server has no browser; Cloudflare is always managed from my Windows machine).</li>
            <li>Click the domain <strong>ontariogamers.ca</strong>.</li>
            <li>In the left menu choose <strong>Email</strong> &rarr; <strong>Email Routing</strong>, then click <strong>Get started</strong>.</li>
        </ol>

        <h3>Step 2 &mdash; Add and verify my destination inbox</h3>
        <ol>
            <li>Under <strong>Destination addresses</strong> I add the personal inbox I want mail forwarded to (my Gmail).</li>
            <li>Cloudflare sends a <strong>verification email</strong> to that Gmail &mdash; I open it and click the confirm link.</li>
            <li>The destination then shows as <strong>Verified</strong>.</li>
        </ol>

        <h3>Step 3 &mdash; Create the address (route)</h3>
        <ol>
            <li>Under <strong>Custom addresses</strong> I click <strong>Create address</strong>.</li>
            <li>I type the name I want, e.g. <code>info</code> &rarr; so the full address is <code>info@ontariogamers.ca</code>.</li>
            <li>For the action I pick <strong>Send to an email</strong> and choose my verified Gmail.</li>
            <li>Save. Anything emailed to <code>info@ontariogamers.ca</code> now lands in my Gmail.</li>
        </ol>
        <div class="og-note">I can repeat Step 3 to add more addresses like <code>vanessa@</code>, <code>george@</code> or <code>partnerships@</code>. I can also enable a <strong>catch-all</strong> so <em>any</em> name @ourdomain forwards to me.</div>

        <h3>Step 4 &mdash; Let Cloudflare add the DNS records</h3>
        <p>When I enable routing, Cloudflare offers to <strong>automatically add the required DNS records</strong> (the MX records plus an SPF TXT record). I click <strong>Add records / Enable</strong> and let it do this &mdash; without them, mail won&rsquo;t be delivered. I don&rsquo;t need to touch DNS by hand.</p>
        <div class="og-warn"><strong>Important:</strong> email only keeps working while the domain is registered and these DNS records exist. If the domain lapses (see renewal note in &sect;15/Domain), email goes down too. I keep a valid card on Cloudflare so auto-renew never fails.</div>

        <h3>If I want to SEND from the branded address too</h3>
        <p>Email Routing only <em>receives/forwards</em>. To send replies that show as <code>info@ontariogamers.ca</code> I have two choices:</p>
        <ul>
            <li><strong>Zoho Mail (free plan):</strong> real mailboxes (send + receive) for one domain, up to a handful of users. I&rsquo;d add the MX/SPF/DKIM records Zoho gives me into Cloudflare DNS. Best free upgrade.</li>
            <li><strong>Google Workspace (paid, ~CAD $8/user/month):</strong> the Gmail interface but on our domain &mdash; the most polished option if the business grows.</li>
        </ul>
        <div class="og-note"><strong>My plan:</strong> stay on free Cloudflare Email Routing for now so <code>info@ontariogamers.ca</code> reaches my inbox; switch to Zoho free or Google Workspace if/when I need to send branded replies regularly.</div>

        <h2 id="og-analytics">18. Monitoring Traffic (Analytics)</h2>
        <p>I want to know how many people read the site and which articles are most popular. I use two free tools that answer slightly different questions.</p>

        <h3>Cloudflare Analytics (already on, quick overview)</h3>
        <p>Every visitor passes through Cloudflare, so it counts everyone with no setup. I check it at <strong>dash.cloudflare.com &rarr; ontariogamers.ca &rarr; Analytics</strong> and switch between <strong>24 Hours / 7 Days / 30 Days</strong>. It shows total unique visitors, requests, data served and countries &mdash; great for a quick &ldquo;how busy are we?&rdquo; but not per-article detail.</p>

        <h3>Google Analytics 4 (per-article detail)</h3>
        <p>This is the one that tells me <em>which posts people actually read</em>. The tracking is already built into the site (Measurement ID <code>G-JGPHEWDBY9</code>), and it deliberately <strong>ignores my own visits while I&rsquo;m logged in</strong> so I don&rsquo;t inflate the numbers. I read it at <strong>analytics.google.com</strong>:</p>
        <ul>
            <li><strong>Reports &rarr; Realtime</strong> &mdash; who&rsquo;s on the site right now (good for checking it works: open the site in a private/incognito window and watch myself appear).</li>
            <li><strong>Reports &rarr; Engagement &rarr; Pages and screens</strong> &mdash; <em>views per article/page, ranked</em>. This is my main &ldquo;what&rsquo;s popular&rdquo; report.</li>
            <li><strong>Reports &rarr; Acquisition</strong> &mdash; where visitors came from (Google, Facebook, direct links).</li>
        </ul>
        <div class="og-note"><strong>If I ever change the tracking ID:</strong> it lives in the plugin (<code>includes/analytics.php</code>). I can override it without touching code by adding <code>define('ONTARIOGAMERS_GA4_ID', 'G-XXXXXXXXXX');</code> to <code>wp-config.php</code>. New data can take a few minutes (Realtime) up to 24&ndash;48 hours (full reports) to appear.</div>
        <div class="og-note"><strong>Two different questions:</strong> Google <em>Analytics</em> tells me what people do <em>on</em> the site (after they arrive); Google <em>Search Console</em> (see SEO, &sect;15) tells me what people searched on Google <em>before</em> they clicked. I use both together.</div>

        <h3>Making sense of the numbers (which report shows what)</h3>
        <p>A few GA4 words decoded, so the reports aren't confusing:</p>
        <table>
            <tr><th>Term</th><th>Plain meaning</th></tr>
            <tr><td><strong>Users</strong></td><td>How many <em>different people</em> visited (roughly &mdash; counted per device/browser).</td></tr>
            <tr><td><strong>Views</strong></td><td>How many <em>pages</em> were opened in total. One person reading 3 articles = 1 user, 3 views.</td></tr>
            <tr><td><strong>Sessions</strong></td><td>One visit (a person's whole browsing session). One user can have many sessions over time.</td></tr>
            <tr><td><strong>Engagement time</strong></td><td>How long people actually stayed reading. Higher = my content is holding attention.</td></tr>
            <tr><td><strong>Channels / Source</strong></td><td>Where they came from &mdash; <em>Organic Search</em> (Google), <em>Direct</em> (typed the URL), <em>Social</em> (Facebook/X), <em>Referral</em> (another site linked me).</td></tr>
        </table>
        <p><strong>To answer &ldquo;how many people read this article?&rdquo;</strong> go to <strong>Reports &rarr; Engagement &rarr; Pages and screens</strong>. Each row is a page; the <strong>Views</strong> column is how many times it was read, and <strong>Users</strong> is how many people. Sort by Views to see my most-read content. Click a row's title to see that single article's trend over time.</p>
        <p><strong>To see live activity right now</strong> (e.g. just after sharing a link on social): <strong>Reports &rarr; Realtime</strong> shows users on the site this minute and which pages they're on.</p>
        <p><strong>To see where my traffic comes from:</strong> <strong>Reports &rarr; Acquisition &rarr; Traffic acquisition</strong> &mdash; this tells me whether visitors arrive from Google, social posts, or direct links, so I know which promotion is working.</p>
        <div class="og-warn"><strong>Don't panic at small numbers early on.</strong> A new site gets little traffic until Google indexes it and backlinks build (weeks, not days). Watch the <em>trend</em> &mdash; steadily rising Users/Views week over week is the win, not the absolute number on day one.</div>

        <h2 id="og-trouble">19. Troubleshooting</h2>
        <table>
            <tr><th>Problem</th><th>Fix</th></tr>
            <tr><td>New review doesn't show on homepage</td><td>Homepage shows only the top 6 by Order. Lower its Order number.</td></tr>
            <tr><td>A field isn't showing</td><td>It was left blank — empty fields are hidden by design.</td></tr>
            <tr><td>"Page not found" on a review URL</td><td><strong>Settings → Permalinks → Save Changes</strong> once (refreshes URL rules).</td></tr>
            <tr><td>Menu changes not visible</td><td>Assign the menu to the <strong>Primary Menu</strong> location and Save.</td></tr>
            <tr><td>Hamburger not opening on phone</td><td>Hard-refresh to clear cached JS. If it persists, contact the developer.</td></tr>
            <tr><td>Design/layout change needed</td><td>That's a code change — handled by the developer via Git, not here.</td></tr>
        </table>

        <p style="margin-top:2em;color:#646970;"><em>A full copy of this guide also lives in the project at <code>docs/SITE-ADMIN-WIKI.md</code>.</em></p>
    </div>
    <?php
}
