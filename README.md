# OntarioGamers — WordPress iGaming Affiliate Site

Local development environment for ontariogamers.com

## Prerequisites

- [Docker Desktop](https://www.docker.com/products/docker-desktop/) installed
- Git

## Quick Start

```bash
# Clone the repo
git clone <your-repo-url>
cd igaming

# Start WordPress locally
docker-compose up -d

# Wait 30 seconds for MySQL to initialize, then visit:
# WordPress site:  http://localhost:8080
# phpMyAdmin:      http://localhost:8081 (user: root / pass: root_local_dev_2026)
```

On first visit, WordPress will show the setup wizard. Use any credentials — it's local.

## Project Structure

```
igaming/
├── docker-compose.yml              ← Local dev environment
├── wp-content/
│   ├── themes/ontariogamers/       ← OUR CUSTOM THEME (version controlled)
│   │   ├── style.css               ← Theme metadata + global styles
│   │   ├── functions.php           ← Theme setup, enqueues, nav menus
│   │   ├── index.php               ← Fallback template
│   │   ├── front-page.php          ← Homepage template
│   │   ├── header.php              ← Site header
│   │   ├── footer.php              ← Site footer (disclaimers)
│   │   ├── single-casino_review.php← Casino review template
│   │   ├── single-slot_review.php  ← Slot review template
│   │   ├── archive-casino_review.php← Casino listing page
│   │   ├── archive-slot_review.php ← Slot listing page
│   │   ├── page.php                ← Generic page template
│   │   ├── sidebar.php             ← Sidebar widget area
│   │   ├── assets/
│   │   │   ├── css/main.css        ← Custom styles
│   │   │   ├── js/main.js          ← Custom scripts
│   │   │   └── images/             ← Theme images (logo, icons)
│   │   └── template-parts/
│   │       ├── casino-card.php     ← Reusable casino card component
│   │       ├── slot-card.php       ← Reusable slot card component
│   │       ├── review-box.php      ← Quick info/rating box
│   │       └── disclaimer.php      ← Responsible gambling block
│   └── plugins/ontariogamers-core/ ← OUR CUSTOM PLUGIN (post types, fields)
│       ├── ontariogamers-core.php  ← Plugin main file
│       └── includes/
│           ├── post-types.php      ← Casino Reviews, Slot Reviews CPTs
│           └── custom-fields.php   ← ACF field definitions
├── .gitignore
├── README.md
└── ROADMAP.md
```

## Deployment (when ready)

1. Buy domain + DigitalOcean droplet
2. Install WordPress on the server
3. Upload this theme to `/wp-content/themes/ontariogamers/`
4. Upload the plugin to `/wp-content/plugins/ontariogamers-core/`
5. Install free plugins (RankMath, ACF, etc.) from WordPress admin
6. Import content or recreate pages

## Stopping

```bash
docker-compose down          # Stop containers (keeps data)
docker-compose down -v       # Stop + delete all data (fresh start)
```
