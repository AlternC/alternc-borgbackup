<?php

require_once("../class/config.php");

$fields = array (
    "name" => array ("request", "string", ""),
);
getFields($fields);

if (!empty($name)) {
  $error = "";

  $borgbackup->mount($name);

  include("borgbackup_list.php");
  exit();
}