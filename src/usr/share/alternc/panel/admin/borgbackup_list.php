<?php
    require_once("../class/config.php");
    include_once("head.php");
?>

    <h3><?php __("Borgbackup list"); ?></h3>
    <hr id="topbar"/>
    <br />

    <?php $backupsList = $borgbackup->qlist(); ?>

    <table class="tlist" style="clear:both;">
        <tr>
            <th><?php __("Name"); ?></th>
            <th><?php __("Created on"); ?></th>
        </tr>
        <?php foreach ($backupsList as $key => $backup) {
            $parity = $key%2;
            ?>
            <tr class="lst<?php echo $parity; ?>">
                <td id="backup<?php ?>"><?php echo $backup['name']; ?></td>
                <td id="backup<?php ?>"><?php echo $backup['date']->format('Y-m-d H:i:s') ?></td>
            </tr>
            <tr class="lst<?php echo $parity; ?>">
                <td colspan="2">
                    <div id="adminlistbtn">
                         <span class="ina<?php if ($parity == 0) echo "v"; ?>">
                             <a href="borgbackup_domount.php?name=<?php echo $backup['name']; ?>"><?php __("Mount backup"); ?></a>
                         </span>&nbsp;
                    </div>
                </td>
            </tr>
        <?php }; ?>
    </table>



<?php include_once("foot.php"); ?>
