#!/bin/bash
# Nightly uploads (media) backup — complements the DB-only backup-db.sh.
set -e
BACKUP_DIR=/root/uploads-backups
mkdir -p "$BACKUP_DIR"
STAMP=$(date +%F_%H%M%S)
FILE="$BACKUP_DIR/uploads_$STAMP.tar.gz"
docker exec igaming-wordpress-1 tar czf - -C /var/www/html/wp-content uploads > "$FILE"
ls -1t "$BACKUP_DIR"/uploads_*.tar.gz 2>/dev/null | tail -n +6 | xargs -r rm -f
echo "$(date '+%F %T')  uploads backup OK -> $FILE ($(du -h "$FILE" | cut -f1))"
