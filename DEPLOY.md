# OntarioGamers — Server & Deployment Guide

Everything about how **ontariogamers.ca** is hosted, how to get into the server,
how code gets deployed (automatically, via GitHub Actions), backups, and how to
rebuild it all from scratch.

> **Never commit secrets.** Passwords live only in `/root/igaming/.env` on the
> server; private SSH keys live only on the admin's Windows machine and in
> GitHub Actions secrets. This file intentionally contains neither.

---

## Contents

1. [At a glance](#1-at-a-glance)
2. [Architecture](#2-architecture)
3. [The server (DigitalOcean droplet)](#3-the-server-digitalocean-droplet)
4. [Accessing the server with SSH](#4-accessing-the-server-with-ssh)
5. [What runs on the server](#5-what-runs-on-the-server)
6. [How the OntarioGamers stack is configured](#6-how-the-ontariogamers-stack-is-configured)
7. [Deploying code (automatic via GitHub Actions)](#7-deploying-code-automatic-via-github-actions)
8. [Backups & restore](#8-backups--restore)
9. [Useful commands](#9-useful-commands)
10. [Troubleshooting](#10-troubleshooting)
11. [Rebuilding from scratch](#11-rebuilding-from-scratch)
12. [Security notes](#12-security-notes)

---

## 1. At a glance

| Item | Value |
|------|-------|
| Live site | https://ontariogamers.ca |
| Admin | https://ontariogamers.ca/wp-admin |
| Hosting | DigitalOcean droplet, Toronto (`tor1`) |
| Server IP | `143.110.219.173` |
| Hostname | `ubuntu-s-1vcpu-2gb-tor1` |
| SSH | `ssh -i "$env:USERPROFILE\.ssh\hetzner_ed25519" root@143.110.219.173` |
| Repo | https://github.com/cliffdoyle/igaming (branch `main`) |
| Code on server | `/root/igaming` (a git clone of the repo) |
| Containers | `igaming-wordpress-1` (WordPress), `igaming-db-1` (MySQL 8.0) |
| DNS / SSL | Cloudflare (proxied, SSL mode **Flexible**) → server port 80 |
| Domain | `ontariogamers.ca` on Cloudflare (auto-renew — keep a valid card on file) |
| Email | Cloudflare Email Routing: `info@` and `partners@ontariogamers.ca` → Gmail |
| Deploys | Automatic on `git push` to `main` (GitHub Actions → SSH → `git pull`) |
| Backups | Nightly DB (03:15 UTC) + uploads (03:30 UTC) to `/root/db-backups`, `/root/uploads-backups` |

---

## 2. Architecture

```
   Visitor
     │  HTTPS
     ▼
 ┌───────────────┐   Cloudflare: DNS, CDN, free SSL, hides email addresses,
 │  Cloudflare   │   Email Routing (info@ / partners@ → Gmail)
 └──────┬────────┘
        │  HTTP :80  (SSL mode "Flexible")
        ▼
 ┌──────────────────────────── DigitalOcean droplet 143.110.219.173 ───────────────┐
 │                                                                                 │
 │   igaming-wordpress-1  (wordpress:latest, host port 80)                         │
 │     ├─ /var/www/html                         ← docker volume igaming_wp_data    │
 │     ├─ wp-content/themes/ontariogamers       ← bind mount /root/igaming/...     │
 │     └─ wp-content/plugins/ontariogamers-core ← bind mount /root/igaming/...     │
 │            │                                                                    │
 │            ▼                                                                    │
 │   igaming-db-1  (mysql:8.0, NOT exposed to the internet)                        │
 │     └─ /var/lib/mysql                        ← docker volume igaming_db_data    │
 │                                                                                 │
 │   (also on this server: ZuriStay hotel API + usasmartgamers.com — see §5)       │
 └─────────────────────────────────────────────────────────────────────────────────┘
        ▲
        │  SSH (deploy key, can ONLY run /root/deploy-igaming.sh)
 ┌──────┴────────┐
 │ GitHub Actions│  ← triggered by `git push` to main
 └───────────────┘
```

**Two kinds of change, two paths:**

| What you change | Where it lives | How it goes live |
|-----------------|----------------|------------------|
| **Code** — theme, plugin, compose file | Git repo → `/root/igaming` | `git push` → auto-deploy (§7) |
| **Content** — reviews, pages, posts, menus, images | MySQL DB + uploads volume | Edit in wp-admin. No git. |

Content is **not** in git. It is protected by the nightly backups (§8).

---

## 3. The server (DigitalOcean droplet)

| Spec | Value |
|------|-------|
| Provider / region | DigitalOcean, Toronto (`tor1`) |
| Plan | Basic droplet, 1 vCPU / 2 GB RAM |
| Disk | 48 GB SSD (~20 GB used) |
| Swap | 2 GB swapfile (`/swapfile`) |
| OS | Ubuntu 24.04 LTS |
| Docker | Docker 29 + Docker Compose v5 (runs as `root`, no `sudo` needed) |
| Firewall | `ufw` inactive; only ports 22, 80, 443, 8082 are listening (see §12) |
| Login | `root`, SSH **key only** (password login disabled) |

The droplet is shared by **three** sites/apps (see §5). RAM is the tightest
resource — check `free -h` before adding anything new.

---

## 4. Accessing the server with SSH

The server is always managed from the Windows machine over SSH (it has no
desktop/browser). Cloudflare and GitHub are managed from a normal browser.

### 4.1 SSH keys (on the Windows machine, `C:\Users\v-comollo\.ssh\`)

| Key file | Used for | Access level on server |
|----------|----------|------------------------|
| `hetzner_ed25519` | **Admin login** (you) | Full root shell |
| `og_deploy_ed25519` | GitHub Actions auto-deploy for OntarioGamers | Can ONLY run `/root/deploy-igaming.sh` |
| `deploy_droplet`, `id_ed25519` | Other projects | Not for this server |

> The admin key is named `hetzner_…` for historical reasons — it is the correct
> key for this DigitalOcean server.

### 4.2 Log in (Windows PowerShell)

```powershell
ssh -i "$env:USERPROFILE\.ssh\hetzner_ed25519" root@143.110.219.173
```

You'll land at `root@ubuntu-s-1vcpu-2gb-tor1:~#`. Type `exit` to leave.

**Optional shortcut** — add this to `C:\Users\v-comollo\.ssh\config` (create
the file if missing) so you can just type `ssh og`:

```
Host og
    HostName 143.110.219.173
    User root
    IdentityFile ~/.ssh/hetzner_ed25519
    IdentitiesOnly yes
```

### 4.3 Run one command without logging in

```powershell
ssh -i "$env:USERPROFILE\.ssh\hetzner_ed25519" root@143.110.219.173 "docker ps"
```

### 4.4 Run a multi-line script from PowerShell

PowerShell mangles quotes and `$(...)` inside ssh strings. Base64-encode the
script instead:

```powershell
$script = @'
cd /root/igaming
git log --oneline -3
docker compose -f docker-compose.prod.yml ps
'@
$b64 = [Convert]::ToBase64String([Text.Encoding]::UTF8.GetBytes(($script -replace "`r","")))
ssh -i "$env:USERPROFILE\.ssh\hetzner_ed25519" root@143.110.219.173 "echo $b64 | base64 -d | bash"
```

### 4.5 Copy files to/from the server

```powershell
# upload
scp -i "$env:USERPROFILE\.ssh\hetzner_ed25519" .\file.zip root@143.110.219.173:/root/
# download (e.g. latest DB backup)
scp -i "$env:USERPROFILE\.ssh\hetzner_ed25519" root@143.110.219.173:/root/db-backups/ontariogamers_2026-10-12_031502.sql.gz .
```

### 4.6 Lost the admin key?

Log into the DigitalOcean dashboard → **Droplets → ubuntu-s-1vcpu-2gb-tor1 →
Access → Launch Droplet Console** (browser console, no key needed). From there,
append a new public key to `/root/.ssh/authorized_keys`.

---

## 5. What runs on the server

Four independent Docker Compose projects share the droplet:

| Project | Folder | Containers | Port | Domain |
|---------|--------|------------|------|--------|
| **igaming** (this site) | `/root/igaming` | `igaming-wordpress-1`, `igaming-db-1` | **80** | ontariogamers.ca |
| **usasmartgamers** | `/root/usasmartgamers` | `usasmartgamers-wordpress-1` (uses `igaming-db-1` for its DB) | **8082** | usasmartgamers.com (Cloudflare Origin Rule → port 8082) |
| **hotel** (ZuriStay) | `/root/hotel-management-system/deploy` | `hotel-caddy-1`, `hotel-api-1`, `hotel-redis-1` | **443** (Caddy) | api.zuristay.com, *.zuristay.com |
| **ictscan** (Python/FastAPI tool) | `/root/ictscan` | `ictscan` (384 MB memory cap, no CPU cap) | 8765, internal only | — |

> ⚠️ `igaming-db-1` also hosts the **usasmartgamers** database. Restarting or
> recreating the igaming DB briefly takes usasmartgamers down too.

> ⚠️ Port 80 belongs to OntarioGamers and port 443 to Caddy (ZuriStay). Do not
> let another app grab either.

### Files & folders in `/root`

| Path | What it is |
|------|------------|
| `/root/igaming/` | Git clone of this repo — **managed by auto-deploy, don't edit here** |
| `/root/igaming/.env` | DB passwords (`DB_NAME`, `DB_USER`, `DB_PASSWORD`, `DB_ROOT_PASSWORD`). Not in git. |
| `/root/deploy-igaming.sh` | Script run by GitHub Actions to deploy (§7) |
| `/root/deploy-igaming.log` | One line per deploy: time, old commit → new commit |
| `/root/backup-db.sh` | Nightly OntarioGamers DB backup |
| `/root/backup-uploads.sh` | Nightly OntarioGamers media/uploads backup |
| `/root/db-backups/` | DB dumps (`ontariogamers_*.sql.gz`, last 14 kept) + `backup.log` |
| `/root/uploads-backups/` | Uploads archives (`uploads_*.tar.gz`, last 5 kept) + `backup.log` |
| `/root/usasmartgamers/`, `/root/backup-usasmartgamers.sh`, `/root/usasmartgamers-backups/` | usasmartgamers site + its backups |
| `/root/hotel-management-system/` | ZuriStay hotel API |

### Docker volumes (where the real data lives)

| Volume | Contents |
|--------|----------|
| `igaming_db_data` | MySQL data (all OntarioGamers content + usasmartgamers DB) |
| `igaming_wp_data` | WordPress core + `wp-content/uploads` (images) + other plugins |
| `usasmartgamers_wp_data` | usasmartgamers WordPress files |
| `hotel_caddy_data`, `hotel_caddy_config`, `hotel_redis_data` | ZuriStay |

> `docker compose down -v` or `docker volume rm` **deletes this data**. Never
> run them without a fresh backup.

---

## 6. How the OntarioGamers stack is configured

Defined in [`docker-compose.prod.yml`](docker-compose.prod.yml):

- **wordpress** (`wordpress:latest`) on host port **80**.
  - Core files in volume `igaming_wp_data`.
  - **Bind mounts** from the git checkout — this is why a `git pull` is enough
    to deploy code:
    - `./wp-content/themes/ontariogamers` → theme
    - `./wp-content/plugins/ontariogamers-core` → plugin
    - `./docker/apache/zz-ontariogamers-hardening.conf` → Apache config:
      blocks `xmlrpc.php` (403, before PHP runs) and trusts Cloudflare's IP
      ranges so logs and WordPress see the **real visitor IP**. Update the
      ranges if [Cloudflare's list](https://www.cloudflare.com/ips/) changes.
  - `WP_HOME` / `WP_SITEURL` are fixed to `https://ontariogamers.ca`.
  - Trusts Cloudflare's `X-Forwarded-Proto: https` so WordPress knows the
    visitor is on HTTPS (prevents redirect loops with Flexible SSL).
- **db** (`mysql:8.0`) — no `ports:` mapping, so it's reachable only from
  containers on the Docker network, never from the internet.
- Credentials come from `/root/igaming/.env` (template: [`.env.example`](.env.example)).

### Cloudflare

- DNS for `ontariogamers.ca` points (proxied, orange cloud) to `143.110.219.173`.
- SSL/TLS mode: **Flexible** (visitor ↔ Cloudflare is HTTPS, Cloudflare ↔
  server is HTTP on port 80).
- Cloudflare obfuscates email addresses in page HTML (`/cdn-cgi/l/email-protection`)
  — normal, they display correctly in browsers.
- Email Routing: `info@ontariogamers.ca` and `partners@ontariogamers.ca` forward
  to the team Gmail (see the in-dashboard admin guide, section 17).

---

## 7. Deploying code (automatic via GitHub Actions)

### 7.1 Your everyday workflow

```powershell
git add .
git commit -m "Describe the change"
git push
```

That's it. Within ~30 seconds the change is live. Watch it in GitHub →
**Actions** tab → **Deploy** (or run `gh run watch` locally).

**What triggers a deploy:** a push to `main` that changes any of:

- `wp-content/**` (theme, plugin)
- `docker-compose.prod.yml`
- `docker/apache/**` (Apache hardening config)
- `.github/workflows/deploy.yml`

Pushes that only touch docs/drafts (`*.md`, `*.docx`, …) do **not** deploy.
To deploy manually anyway: **Actions → Deploy → Run workflow** (or
`gh workflow run deploy.yml`).

### 7.2 How it works

```
git push ─► GitHub Actions (.github/workflows/deploy.yml)
              │  ssh -i DEPLOY_SSH_KEY root@143.110.219.173
              ▼
           server authorized_keys: this key is FORCED to run
           /root/deploy-igaming.sh  (whatever command is requested)
              │
              ├─ git fetch origin main && git merge --ff-only origin/main
              ├─ if docker-compose.prod.yml or docker/apache/* changed →
              │     apache2ctl configtest in a throwaway container (abort if bad),
              │     then docker compose up -d --force-recreate wordpress
              ├─ else if any .php changed → graceful Apache reload (clears PHP opcache)
              └─ append to /root/deploy-igaming.log
              ▼
           theme/plugin are bind-mounted → live immediately
              ▼
           Actions "Smoke test" step: checks https://ontariogamers.ca/ returns 200
           (non-200 = warning only, since Cloudflare may challenge GitHub's IPs)
```

### 7.3 The pieces

**Workflow:** [`.github/workflows/deploy.yml`](.github/workflows/deploy.yml).
Runs one deploy at a time (`concurrency: deploy-production`).

**GitHub repo secrets** (Settings → Secrets and variables → Actions):

| Secret | Value |
|--------|-------|
| `DEPLOY_SSH_KEY` | Private key `og_deploy_ed25519` |
| `DEPLOY_HOST` | `143.110.219.173` |
| `DEPLOY_KNOWN_HOSTS` | The server's ed25519 host key (pins the server identity, prevents MITM) |

**Server `authorized_keys` entry** (in `/root/.ssh/authorized_keys`):

```
command="/root/deploy-igaming.sh",no-port-forwarding,no-X11-forwarding,no-agent-forwarding,no-pty ssh-ed25519 AAAA… github-actions-igaming-deploy
```

The `command=` restriction means this key can never open a shell or run
anything else — even if it leaked, the worst an attacker could do is trigger a
deploy of what's already on GitHub.

**Server deploy script** `/root/deploy-igaming.sh`:

```bash
#!/bin/bash
set -euo pipefail
exec 9>/tmp/deploy-igaming.lock
flock 9
cd /root/igaming
before=$(git rev-parse HEAD)
git fetch --quiet origin main
git merge --ff-only --quiet origin/main
after=$(git rev-parse HEAD)
if [ "$before" != "$after" ]; then
  changed=$(git diff --name-only "$before" "$after")
  if echo "$changed" | grep -qE '^(docker-compose\.prod\.yml|docker/apache/)'; then
    # Test the Apache config in a throwaway container first, so a broken
    # file never takes the live site down.
    docker run --rm -v "$PWD/docker/apache/zz-ontariogamers-hardening.conf:/etc/apache2/conf-enabled/zz-ontariogamers-hardening.conf:ro" \
      wordpress:latest apache2ctl configtest >/dev/null 2>&1 \
      || { echo "Apache configtest FAILED - container not recreated"; exit 1; }
    # --force-recreate: single-file bind mounts keep pointing at the old file
    # after git replaces it, so the container must be recreated.
    echo "Server config changed - recreating wordpress container"
    docker compose -f docker-compose.prod.yml up -d --force-recreate wordpress
  elif echo "$changed" | grep -q '\.php$'; then
    # PHP opcache re-checks files only every 2s; without this, the first
    # requests after a multi-file deploy can mix old and new code (HTTP 500).
    docker exec igaming-wordpress-1 apache2ctl -k graceful 2>/dev/null
    echo "PHP changed - Apache reloaded gracefully (opcache cleared)"
  fi
fi
echo "Deployed: $(git log --oneline -1)"
echo "[$(date -Is)] $before -> $after" >> /root/deploy-igaming.log
```

The server pulls over HTTPS from the **public** repo, so it needs no GitHub
credentials. (If the repo is ever made private, add a read-only deploy key on
the server for `git fetch`.)

### 7.4 Rules

- **Never edit files in `/root/igaming` directly on the server.** The deploy
  only fast-forwards; server-side edits make it fail. Change locally and push.
- **Never force-push `main`** (`git push --force`). A rewritten history can't be
  fast-forwarded and the deploy will fail.
- One-time data changes (e.g. updating a live page's content) are done in PHP
  "migration" functions in the plugin, guarded by a WordPress option so they
  run exactly once — see `ontariogamers_contact_partners_email_v2()` in
  [`seed-pages.php`](wp-content/plugins/ontariogamers-core/includes/seed-pages.php).
  They run on the first page load after the deploy.

### 7.5 Deploy test / rollback

```powershell
# trigger the deploy key by hand (runs the deploy script, same as Actions)
ssh -i "$env:USERPROFILE\.ssh\og_deploy_ed25519" -o IdentitiesOnly=yes root@143.110.219.173 deploy
```

**Rollback:** revert the bad commit and push — it deploys like any change:

```powershell
git revert <bad-commit-sha>
git push
```

### 7.6 Rotate or revoke the deploy key

```powershell
# 1. new key (empty passphrase; note: -N '' — NOT -N '""' in PowerShell)
ssh-keygen -t ed25519 -N '' -C github-actions-igaming-deploy -f $env:USERPROFILE\.ssh\og_deploy_ed25519_new
# 2. update the GitHub secret
Get-Content $env:USERPROFILE\.ssh\og_deploy_ed25519_new -Raw | gh secret set DEPLOY_SSH_KEY
```

3. On the server, edit `/root/.ssh/authorized_keys`: replace the public key in
   the `github-actions-igaming-deploy` line with the new `.pub` contents (keep
   the `command=…` prefix). **To revoke entirely**, just delete that line.

---

## 8. Backups & restore

### 8.1 What's backed up (root crontab, times in UTC)

```
15 3 * * * /root/backup-db.sh             >> /root/db-backups/backup.log 2>&1
30 3 * * * /root/backup-uploads.sh        >> /root/uploads-backups/backup.log 2>&1
45 3 * * * /root/backup-usasmartgamers.sh >> /root/usasmartgamers-backups/backup.log 2>&1
```

| Backup | Output | Kept | Approx size |
|--------|--------|------|-------------|
| OntarioGamers DB (`mysqldump`, gzipped) | `/root/db-backups/ontariogamers_YYYY-MM-DD_HHMMSS.sql.gz` | last 14 | ~190 KB each |
| OntarioGamers uploads (`wp-content/uploads`) | `/root/uploads-backups/uploads_YYYY-MM-DD_HHMMSS.tar.gz` | last 5 | ~160 MB each |

Code is backed up by git/GitHub. Check the last run:
`tail -3 /root/db-backups/backup.log /root/uploads-backups/backup.log`.

> ⚠️ Backups live **on the same droplet**. If the droplet is lost, so are they.
> Periodically download one to your PC (§4.5), or enable DigitalOcean's paid
> droplet backups/snapshots for an off-server copy.

### 8.2 Take a backup right now (e.g. before risky work)

```bash
/root/backup-db.sh && /root/backup-uploads.sh
```

### 8.3 Restore the database

```bash
cd /root/igaming
ls -t /root/db-backups/*.sql.gz | head        # pick a file
zcat /root/db-backups/ontariogamers_<STAMP>.sql.gz | \
  docker compose -f docker-compose.prod.yml exec -T db \
  sh -c 'exec mysql -uroot -p"$MYSQL_ROOT_PASSWORD" "$MYSQL_DATABASE"'
```

### 8.4 Restore uploads (images)

```bash
docker exec -i igaming-wordpress-1 tar xzf - -C /var/www/html/wp-content \
  < /root/uploads-backups/uploads_<STAMP>.tar.gz
```

---

## 9. Useful commands

Run on the server, inside `/root/igaming`:

```bash
cd /root/igaming

# status / logs
docker compose -f docker-compose.prod.yml ps
docker compose -f docker-compose.prod.yml logs -f --tail=100 wordpress
docker ps --format '{{.Names}}\t{{.Status}}\t{{.Ports}}'    # all apps
tail /root/deploy-igaming.log                                # deploy history
git log --oneline -5                                         # what's deployed

# restart (code changes do NOT need this — only config/hangs)
docker compose -f docker-compose.prod.yml restart wordpress

# apply docker-compose.prod.yml changes (auto-deploy does this for you)
docker compose -f docker-compose.prod.yml up -d

# server health
free -h; df -h /; uptime
```

**WP-CLI** (no install needed — runs a throwaway container):

```bash
cd /root/igaming && set -a && . ./.env && set +a
WP="docker run --rm --user 33 -e HOME=/tmp --volumes-from igaming-wordpress-1 --network igaming_default \
  -e WORDPRESS_DB_HOST=db -e WORDPRESS_DB_USER=$DB_USER -e WORDPRESS_DB_PASSWORD=$DB_PASSWORD -e WORDPRESS_DB_NAME=$DB_NAME \
  wordpress:cli wp"

$WP option get home              # https://ontariogamers.ca
$WP plugin list
$WP user list
$WP cache flush
$WP user update <login> --user_pass='<new password>'   # reset an admin password
```

**MySQL shell:**

```bash
cd /root/igaming
docker compose -f docker-compose.prod.yml exec db sh -c 'mysql -uroot -p"$MYSQL_ROOT_PASSWORD" "$MYSQL_DATABASE"'
```

**PHP syntax check** of a local file before pushing (from Windows):

```powershell
Get-Content .\wp-content\plugins\ontariogamers-core\includes\seed-pages.php -Raw |
  ssh -i "$env:USERPROFILE\.ssh\hetzner_ed25519" root@143.110.219.173 "docker exec -i igaming-wordpress-1 php -l"
```

---

## 10. Troubleshooting

| Symptom | Likely cause / fix |
|---------|--------------------|
| Actions **Deploy** fails at "Deploy over SSH" with `Not possible to fast-forward` | Someone edited files on the server or force-pushed. SSH in, `cd /root/igaming && git status`; save anything needed, then `git reset --hard origin/main` and re-run the workflow. |
| Deploy fails with `Host key verification failed` | Server was rebuilt / host key changed. Update `DEPLOY_KNOWN_HOSTS`: `ssh root@143.110.219.173 "cat /etc/ssh/ssh_host_ed25519_key.pub"` → secret value `143.110.219.173 ssh-ed25519 AAAA…`. |
| Deploy fails with `Permission denied (publickey)` | `DEPLOY_SSH_KEY` secret and the server's `authorized_keys` line don't match — see §7.6. |
| Pushed but nothing changed on site | Did the push touch `wp-content/**`? Check Actions ran. Then hard-refresh / purge Cloudflare cache (Cloudflare → Caching → Purge Everything). |
| Site shows "Error establishing a database connection" | `docker compose -f docker-compose.prod.yml ps` — is `db` up? `docker compose ... up -d`. Check `free -h` (out of memory?). |
| White screen / 500 after a deploy | PHP error in the theme/plugin. `docker compose ... logs --tail=100 wordpress`, fix locally, push (or `git revert` + push). A 500 lasting only a second or two right after a deploy is PHP's opcache serving a mix of old and new files — the deploy script's graceful Apache reload prevents this. |
| Too many redirects | Cloudflare SSL mode must be **Flexible** (or the `X-Forwarded-Proto` block in the compose file was removed). |
| Server slow / containers restarting | RAM: `free -h`, `docker stats --no-stream`. Four apps share 1 vCPU / 2 GB. |
| Site loads forever, `uptime` load ≫ 1, `igaming-wordpress-1` near 100% CPU | Probably a bot flood. Find the target: `docker logs --since 10m igaming-wordpress-1 \| awk '{print $7}' \| sort \| uniq -c \| sort -rn \| head` and the source: `… awk '{print $1}' …`. Block the path in `docker/apache/zz-ontariogamers-hardening.conf` (as done for `xmlrpc.php` on 27 Oct 2026), or block the IP/path in Cloudflare → Security → WAF. |
| Site hangs for you but the server is idle and `curl -H 'Host: ontariogamers.ca' http://143.110.219.173/` is fast | Cloudflare edge/route problem for your location, not the server. Check `https://ontariogamers.ca/cdn-cgi/trace` (`colo=` shows the Cloudflare city), [cloudflarestatus.com](https://www.cloudflarestatus.com), and a multi-location test such as check-host.net. |

---

## 11. Rebuilding from scratch

If the droplet is ever lost or you move hosts:

1. **Create a droplet** — DigitalOcean → Create → Droplet → Ubuntu 24.04,
   Toronto, Basic 1 vCPU / 2 GB. Add your `hetzner_ed25519.pub` as the SSH key.
2. **Install Docker & add swap:**
   ```bash
   apt update && apt upgrade -y
   curl -fsSL https://get.docker.com | sh
   fallocate -l 2G /swapfile && chmod 600 /swapfile && mkswap /swapfile && swapon /swapfile
   echo '/swapfile none swap sw 0 0' >> /etc/fstab
   ```
3. **Get the code + secrets:**
   ```bash
   cd /root && git clone https://github.com/cliffdoyle/igaming.git && cd igaming
   cp .env.example .env
   openssl rand -base64 24   # use for DB_PASSWORD
   openssl rand -base64 24   # use for DB_ROOT_PASSWORD
   nano .env
   ```
4. **Start it:** `docker compose -f docker-compose.prod.yml up -d`
5. **Restore content** from your latest downloaded backups (§8.3, §8.4) — or, on
   a brand-new site, finish the WordPress installer and activate the
   **OntarioGamers Core** plugin + **OntarioGamers** theme, then set
   **Settings → Permalinks → Post name**.
6. **Recreate the backup scripts + crontab** (§8.1; script contents are in the
   old server's `/root/backup-db.sh` and `/root/backup-uploads.sh` — keep a copy
   locally).
7. **Recreate auto-deploy:** copy `deploy-igaming.sh` from §7.3 to
   `/root/deploy-igaming.sh` (`chmod 700`), add the `authorized_keys` line from
   §7.3, and update the `DEPLOY_HOST` / `DEPLOY_KNOWN_HOSTS` secrets.
8. **Point Cloudflare** DNS A records for `ontariogamers.ca` (and `www`) at the
   new IP (proxied), SSL mode Flexible.

---

## 12. Security notes

- Root SSH login is **key-only** (`PasswordAuthentication no`).
- `ufw` is inactive; exposure is controlled by what listens: **22** (SSH),
  **80** (OntarioGamers), **443** (Caddy/ZuriStay), **8082** (usasmartgamers,
  reached via Cloudflare Origin Rule). MySQL is not exposed.
- The origin IP is published in this (public) repo, so someone could hit the
  server directly on port 80, bypassing Cloudflare. To harden later, restrict
  ports 80/8082 to [Cloudflare's IP ranges](https://www.cloudflare.com/ips/)
  with `ufw` (keep 22 open first!).
- Keys in `/root/.ssh/authorized_keys`:

  | Comment | Purpose | Restricted? |
  |---------|---------|-------------|
  | `hetzner-ontariogamers` | Admin login | No (full root) |
  | `github-actions-deploy` | Another CI pipeline (owner not documented — likely ZuriStay) | No |
  | `usasmartgamers-github-deploy` | usasmartgamers CI | Yes — `rrsync` into `/root/usasmartgamers/src` only |
  | `github-actions-igaming-deploy` | OntarioGamers CI (§7) | Yes — can only run `/root/deploy-igaming.sh` |

  Backups of this file are kept as `/root/.ssh/authorized_keys.bak.*`.
- WordPress core lives in the `igaming_wp_data` volume, so recreating the
  container does **not** change the core version. Core applies minor/security
  updates itself; do major updates from **Dashboard → Updates** (take a backup
  first, §8.2). Keep other plugins updated in wp-admin.
- **PHP / Apache security patches come from the Docker image, not from
  WordPress.** No PHP runs on the host — only inside the two `wordpress:latest`
  containers (OntarioGamers and usasmartgamers). Recreating a container does
  **not** pull a newer image. To patch PHP when a CVE comes out:

  ```bash
  docker pull wordpress:latest
  docker run --rm --entrypoint php wordpress:latest -r 'echo PHP_VERSION;'   # confirm patched version
  /root/backup-db.sh && /root/backup-usasmartgamers.sh                      # backups first
  cd /root/igaming        && docker compose -f docker-compose.prod.yml up -d --no-deps --force-recreate wordpress
  cd /root/usasmartgamers && docker compose -f docker-compose.prod.yml up -d --no-deps --force-recreate wordpress
  for c in igaming-wordpress-1 usasmartgamers-wordpress-1; do docker exec $c php -r 'echo PHP_VERSION,"\n";'; done
  docker image prune -f
  ```

  If `latest` ever moves to a new PHP minor version (e.g. 8.3 → 8.4), check
  plugin compatibility first, or pin `image: wordpress:php8.3-apache`.
  History: 24 Oct 2026, upgraded PHP 8.3.31 → 8.3.36 for CVE-2026-109618 /
  CVE-2026-109619 (critical RCE).
- **`xmlrpc.php` is blocked** (Apache returns 403, see §6). On 27 Oct 2026 a
  password brute-force flood on it (~30,000 requests/hour) pinned the single
  CPU at 100% and made the site hang. No login succeeded (response sizes all
  matched failed attempts; no new users, posts or PHP files in uploads). If a
  future plugin (e.g. Jetpack) needs XML-RPC, remove the `<Files>` block.
  For extra protection, also add a Cloudflare WAF rule blocking
  `URI Path contains "xmlrpc.php"` so floods never reach the server.
