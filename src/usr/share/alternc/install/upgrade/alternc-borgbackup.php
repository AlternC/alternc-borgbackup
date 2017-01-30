#!/usr/bin/php
<?php

// We check that mysql php module is loaded 
if(!function_exists('mysql_connect'))  {
  if(!dl("mysql.so"))
    exit(1);
}

// we don't check our AlternC session
if(!chdir("/usr/share/alternc/panel"))
exit(1);
require("/usr/share/alternc/panel/class/config_nochk.php");

variable_set('borgbackup_bin','/usr/local/bin/borg', 'BorgBackup : absolute bin path (required with local wheezy install)');
variable_set('borgbackup_passphrase',' ', 'BorgBackup  : Passphrase to protect archive, should be set');
variable_set('borgbackup_backup_path','/var/backups/borg/', 'BorgBackup : Path where are stored all archive');
variable_set('borgbackup_backup_dir_local','backup', 'BorgBackup : Local directory user account where archive are restored');