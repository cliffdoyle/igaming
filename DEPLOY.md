# Deploying OntarioGamers to Oracle Cloud (Free Tier)

This guide takes your local Docker site live on a free Oracle Cloud server in
the Toronto region. Same `docker compose` you already run locally — just on a
rented computer with a public IP.

> You can be live on the server's IP address **without buying a domain**.
> Add a real domain (and free SSL) later without changing anything else.

---

## Overview

```
1. Create a free Ubuntu server (Compute instance) in Oracle
2. Open the firewall ports (80, 443)
3. SSH into the server
4. Install Docker
5. git clone your repo
6. Create the .env file with real passwords
7. docker compose -f docker-compose.prod.yml up -d
8. Visit http://<server-ip>  ->  YOU ARE LIVE
```

---

## Step 1 — Create the server (Compute instance)

In the Oracle Cloud console (you're already in Toronto region):

1. Click the hamburger menu (top-left) -> **Compute** -> **Instances**
2. Click **Create instance**
3. **Name:** `ontariogamers`
4. **Image and shape:**
   - Image: **Canonical Ubuntu** (22.04 or newer)
   - Shape: click **Change shape** and pick one marked **"Always Free eligible"**
     (e.g. `VM.Standard.A1.Flex` with 1 OCPU / 6 GB, or `VM.Standard.E2.1.Micro`)
5. **Networking:** leave defaults (it creates a VCN for you). Make sure
   **"Assign a public IPv4 address"** is **Yes**.
6. **Add SSH keys:**
   - Choose **Generate a key pair for me**
   - Click **Save private key** (download it) — you'll need this file to log in.
     Keep it safe; you can't download it again.
7. Click **Create**. Wait ~1 minute until state is **Running**.
8. Copy the **Public IP address** shown on the instance page.

---

## Step 2 — Open the firewall ports

Oracle blocks web traffic by default. Open ports 80 (HTTP) and 443 (HTTPS).

1. On the instance page, under **Primary VNIC**, click the **Subnet** link.
2. Click the **Security List** (usually "Default Security List for ...").
3. Click **Add Ingress Rules** and add these (one rule each):

   | Source CIDR | IP Protocol | Destination Port |
   |-------------|-------------|------------------|
   | `0.0.0.0/0` | TCP         | `80`             |
   | `0.0.0.0/0` | TCP         | `443`            |

4. Click **Add Ingress Rules** to save.

---

## Step 3 — SSH into the server

On your machine, open a terminal where you saved the private key file
(e.g. `ssh-key.key`).

**Windows (PowerShell):**
```powershell
# restrict key permissions (required once)
icacls .\ssh-key.key /inheritance:r
icacls .\ssh-key.key /grant:r "$($env:USERNAME):(R)"

ssh -i .\ssh-key.key ubuntu@<SERVER_IP>
```

**Linux/Mac:**
```bash
chmod 600 ssh-key.key
ssh -i ssh-key.key ubuntu@<SERVER_IP>
```

The default username on Oracle Ubuntu images is `ubuntu`.

---

## Step 4 — Install Docker on the server

Once logged in (you'll see `ubuntu@ontariogamers:~$`):

```bash
# update system
sudo apt update && sudo apt upgrade -y

# install Docker + compose plugin
sudo apt install -y docker.io docker-compose-v2 git

# let your user run docker without sudo
sudo usermod -aG docker $USER
newgrp docker

# Oracle Ubuntu blocks ports at the OS firewall too — open them:
sudo iptables -I INPUT 6 -m state --state NEW -p tcp --dport 80 -j ACCEPT
sudo iptables -I INPUT 6 -m state --state NEW -p tcp --dport 443 -j ACCEPT
sudo netfilter-persistent save
```

> If `netfilter-persistent` isn't found, run:
> `sudo apt install -y iptables-persistent` then re-run the save command.

---

## Step 5 — Clone your repo

```bash
cd ~
git clone https://github.com/cliffdoyle/igaming.git
cd igaming
```

---

## Step 6 — Create the .env file with real passwords

```bash
cp .env.example .env

# generate two strong passwords
openssl rand -base64 24   # copy this for DB_PASSWORD
openssl rand -base64 24   # copy this for DB_ROOT_PASSWORD

nano .env                 # paste the values, save with Ctrl+O, exit Ctrl+X
```

Your `.env` should look like:
```
DB_NAME=ontariogamers
DB_USER=wp_user
DB_PASSWORD=<the first random string>
DB_ROOT_PASSWORD=<the second random string>
```

---

## Step 7 — Launch the site

```bash
docker compose -f docker-compose.prod.yml up -d
```

Check it's running:
```bash
docker compose -f docker-compose.prod.yml ps
```

---

## Step 8 — Finish the WordPress install

Open a browser:

```
http://<SERVER_IP>
```

You'll see the WordPress 5-minute install (because the server has a fresh
database — your local content does NOT copy over automatically).

1. Pick language, set site title **OntarioGamers**, create an admin user
   (use a strong password).
2. Log in -> **Plugins** -> activate **OntarioGamers Core**
   (this seeds the static pages and registers casino/slot types).
3. **Appearance -> Themes** -> activate **OntarioGamers**.
4. **Settings -> Permalinks** -> select **Post name** -> Save (fixes URLs).
5. Re-create your casino/slot reviews here (content lives in this server's DB).

**You are now live on the internet.**

---

## Updating the site later (your normal workflow)

When you change theme/plugin code on Windows and push to GitHub:

```bash
# on the server
cd ~/igaming
git pull
# code changes apply instantly (bind-mounted). If needed:
docker compose -f docker-compose.prod.yml restart
```

Content (reviews, pages) is edited directly in wp-admin — no git needed.

---

## Optional — Free nicer URL (no domain purchase)

Use a free subdomain that points at your IP:

- **nip.io** (zero signup): just visit `http://<SERVER_IP>.nip.io`
- **DuckDNS** (free): create `ontariogamers.duckdns.org` -> point to your IP

---

## Later — Real domain + free SSL

When you buy `ontariogamers.com`:

1. In your domain registrar, create an **A record** pointing to `<SERVER_IP>`.
2. On the server, add HTTPS with free Let's Encrypt (e.g. via a reverse proxy
   like Caddy or nginx-proxy + certbot). Ask for the SSL setup steps when ready.

---

## Useful commands

```bash
# view logs
docker compose -f docker-compose.prod.yml logs -f wordpress

# stop the site
docker compose -f docker-compose.prod.yml down

# stop AND wipe the database (careful!)
docker compose -f docker-compose.prod.yml down -v

# restart after a reboot (auto-starts due to restart: unless-stopped)
docker compose -f docker-compose.prod.yml up -d
```
