<?php

class m_borgbackup {

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

}
