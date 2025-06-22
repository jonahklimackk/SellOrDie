#!/usr/bin/env bash
set -euo pipefail

# ---------------------------------------------------
# backup-db.sh
# Usage: ./backup-db.sh <database_name> [backup_dir]
# ---------------------------------------------------

if [ $# -lt 1 ]; then
  echo "Usage: $0 <database_name> [backup_dir]"
  exit 1
fi

DB_NAME="$1"
BACKUP_DIR="${2:-./backups}"
TIMESTAMP="$(date +%Y%m%d_%H%M%S)"
OUT_FILE="${BACKUP_DIR}/${DB_NAME}_${TIMESTAMP}.sql"
GZ_FILE="${OUT_FILE}.gz"

mkdir -p "$BACKUP_DIR"

# ——————————————————————————————————————————————
# Load .env if present, exporting DB_ vars properly
# ——————————————————————————————————————————————
if [ -f .env ]; then
  # export all variables defined in .env
  set -o allexport
  # shellcheck disable=SC1091
  source .env
  set +o allexport
fi

# ——————————————————————————————————————————————
# Fallbacks in case any DB_ var is missing
# ——————————————————————————————————————————————
DB_HOST="${DB_HOST:-127.0.0.1}"
DB_PORT="${DB_PORT:-3306}"
DB_USER="${DB_USERNAME:-root}"
DB_PASS="${DB_PASSWORD:-}"

echo "→ Backing up \`$DB_NAME\` to \`$OUT_FILE\` …"

mysqldump \
  -h "$DB_HOST" \
  -P "$DB_PORT" \
  -u "$DB_USER" \
  -p"$DB_PASS" \
  "$DB_NAME" \
  > "$OUT_FILE"

echo "→ Compressing…"
gzip -9 "$OUT_FILE"

echo "✔ Backup complete: $GZ_FILE"

