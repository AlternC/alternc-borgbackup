<?php

class m_borgbackup {

    private $borgbackup_bin="";
    private $borgbackup_passphrase="";
    private $backup_path="";

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
}

