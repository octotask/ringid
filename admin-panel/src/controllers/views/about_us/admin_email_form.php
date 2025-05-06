<div class="form_content">
    <h3><?= $page_title ?></h3>
    <?php
    if ($msg != "") {
        echo "<div class='success'>$msg</div>";
    }
    ?>
    <form id="valid_admin_email" method="post" action='<?= site_url($action) ?>' enctype ="multipart/form-data">
        <table width="100%" border="0" cellspacing="3" cellpadding="2">
            <tr>
                <th valign="top"><label for="Title">Admin Name</label></th>
                <td><input type='text' name='admin_name'id ="admin_name" value="<?= $admin_name ?>" class='text required ui-widget-content ui-corner-all' /></td>
            </tr>
            <tr>
                <th valign="top"><label for="Title">Admin Email<span class="req_mark">*</span></label></th>
                <td><input type='admin_email' name='admin_email' id ="password" value="<?=$admin_email ?>" class='text required ui-widget-content ui-corner-all' /><?= form_error('admin_email', '<span>', '</span>') ?></td>
            </tr>
<?php $check = checked . "=" . "checked"; ?>
                    <tr>
                        <th><label for="status">Status</label></th>
                        <td><input type ="radio" name="status" value="Activate" <?php
                    if ($status == "Activate") {
                        echo $check;
                    }
?>/>Activate<br>
                    <input type ="radio" name="status" value="DeActivate"<?php
                    if ($status == "DeActivate" || $status == '') {
                        echo $check;
                    }
?>/> DeActivate </td>
            </tr>

            <tr>
                <th>&nbsp;</th><td><input type='submit' name='save' value='save' class='button' /><input type='button' name='cancel' value='Cancel' class='btn'onclick="window.history.back(-1)"/></td>
            </tr>
        </table>
    </form>

</div>