<#
Opens ontariogamers.ca in a separate Edge window whose traffic goes through
the DigitalOcean server in Toronto (SSH SOCKS tunnel). Use it when your own
internet route to Cloudflare is broken (e.g. Kenyan ISPs routed via Marseille)
but the site works for everyone else. Needs the admin SSH key (DEPLOY.md §4).

  powershell -ExecutionPolicy Bypass -File .\scripts\open-site-via-server.ps1
  powershell -ExecutionPolicy Bypass -File .\scripts\open-site-via-server.ps1 -Url https://usasmartgamers.com/

Close the Edge window to close the tunnel. Your normal browser is unaffected.
#>
param(
    [string]$Url = 'https://ontariogamers.ca/wp-admin/',
    [string]$KeyPath = "$env:USERPROFILE\.ssh\hetzner_ed25519",
    [string]$Server = 'root@143.110.219.173',
    [int]$Port = 1080
)
$ErrorActionPreference = 'Stop'

if (-not (Test-Path $KeyPath)) { throw "SSH key not found: $KeyPath" }

$ssh = Start-Process ssh -PassThru -WindowStyle Hidden -ArgumentList @(
    '-i', $KeyPath, '-o', 'BatchMode=yes', '-o', 'ExitOnForwardFailure=yes',
    '-o', 'ServerAliveInterval=30', '-N', '-D', "127.0.0.1:$Port", $Server)

$deadline = (Get-Date).AddSeconds(15)
while (-not (Test-NetConnection 127.0.0.1 -Port $Port -InformationLevel Quiet -WarningAction SilentlyContinue)) {
    if ($ssh.HasExited) { throw "SSH tunnel failed to start (exit code $($ssh.ExitCode))." }
    if ((Get-Date) -gt $deadline) { Stop-Process -Id $ssh.Id; throw 'SSH tunnel did not open in time.' }
    Start-Sleep -Milliseconds 500
}
Write-Host "Tunnel open via $Server. Close the Edge window when done." -ForegroundColor Green

try {
    # Separate profile so the proxy flag applies even if Edge is already open.
    $profileDir = Join-Path $env:LOCALAPPDATA 'og-tunnel-edge-profile'
    Start-Process msedge -Wait -ArgumentList @(
        "--user-data-dir=`"$profileDir`"", "--proxy-server=socks5://127.0.0.1:$Port",
        '--no-first-run', $Url)
}
finally {
    if (-not $ssh.HasExited) { Stop-Process -Id $ssh.Id }
    Write-Host 'Tunnel closed.'
}
