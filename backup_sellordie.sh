#!/usr/bin/env bash
#
# backup_sellordie.sh
# Makes a timestamped archive of the current directory,
# including hidden files, into ~/backups/.

set -euo pipefail

# Where to store backups
BACKUP_ROOT="${HOME}/backups"
# Timestamp format
TIMESTAMP="$(date +'%Y-%m-%d_%H-%M-%S')"
# Name of this project directory
PROJECT_NAME="$(basename "$(pwd)")"
# Full path
BACKUP_DIR="${BACKUP_ROOT}/${PROJECT_NAME}_backup_${TIMESTAMP}"

echo "Creating backup at ${BACKUP_DIR} …"

# Make sure the root exists
mkdir -p "${BACKUP_DIR}"

# Copy everything, including hidden files
cp -a . "${BACKUP_DIR}"

echo "Backup complete!"

