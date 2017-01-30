<?php

class m_borgbackup {

    private $borgbackup_bin;
    private $borgbackup_passphrase;
    private $backup_path;
    private $backup_dir_local;

    function __construct() {
        $this->borgbackup_bin = variable_get('borgbackup_bin');
        $this->borgbackup_passphrase = variable_get('borgbackup_passphrase');
        $this->backup_path = variable_get('borgbackup_backup_path');
        $this->backup_dir_local = variable_get('borgbackup_backup_dir_local');
    }

    function hook_menu() {

        $obj = array(
            'title' => _("BorgBackup"),
            'ico' => 'images/ftp.png',
            'pos' => 100,
            'link' => 'toggle',
            'links' => array(
                array(
                   'txt' => _("List backups"),
                   'url' => 'borgbackup_list.php',
                   'ico' => '',
                   'class' => '',
                )
            )
        );

        return $obj;
    }

    function qlist() {

        global $mem;

        $result = false;
        $exec = "export BORG_PASSPHRASE='".$this->borgbackup_passphrase."'; ".$this->borgbackup_bin." list ".$this->backup_path."/".$mem->user['login'];

        if (exec($exec,$output,$return_var)) {
            $result = array();
            foreach($output as $row) {
                  $cells=array();
                  preg_match('/^(\w*)\s+([\w\s,-:]*)$/',$row,$cells);
                  $result[] = array(
                       'name' => $cells[1],
                       'date' => new DateTime($cells[2])
                  );
            }
        }

        return $result;
    }

    function mount($archive_name) {

        global $mem, $bro;

        $result = false;

        //TODO : think to check directory creation (yet empty or new)
        $bro->CreateDir($this->backup_dir_local, $archive_name);

        $exec = "export BORG_PASSPHRASE='".$this->borgbackup_passphrase."'; ".$this->borgbackup_bin." mount ".$this->backup_path."/".$mem->user['login']."::".$archive_name." ".$bro->convertabsolute($this->backup_dir_local."/".$archive_name,0);

        if ($result = exec($exec,$output,$return_var)) {
            return true;
        }

        return false;
    }
}
