#!/bin/bash
PATH=/sbin:/bin:/usr/sbin:/usr/bin:/usr/local/bin
umask 022

CONFIG_FILE="/usr/lib/alternc/functions.sh"
export BORG_PASSPHRASE='PASSPHRASSE'



if [ ! -r "$CONFIG_FILE" ]; then
    echo "Can't access $CONFIG_FILE."
    exit 1
fi
source "$CONFIG_FILE"

if [ `id -u` -ne 0 ]; then
    echo "$0 must be launched as root"
    exit 1
fi

borg_execution() {
        read GID LOGIN || true
        while [ "$LOGIN" ] ; do
                REP="$(get_html_path_by_name "$LOGIN")"
                REPO="/var/backups/borg/$LOGIN"
                ARCHIVE_NAME=$(date +%Y%M%d)

                if [ ! -d $REPO ]; then
                        borg init $REPO
                fi
                borg create -v --stats $REPO::$ARCHIVE_NAME $REP

		borg prune -v --list $REPO --keep-daily=7 --keep-weekly=4 --keep-monthly=6

        read GID LOGIN || true
        done
}

mysql --defaults-file=/etc/alternc/my.cnf --skip-column-names -B -e "SELECT uid,login FROM membres ORDER BY login" | borg_execution
