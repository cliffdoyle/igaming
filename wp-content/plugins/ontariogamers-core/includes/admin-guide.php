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

        <h2 id="og-trouble">14. Troubleshooting</h2>
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
