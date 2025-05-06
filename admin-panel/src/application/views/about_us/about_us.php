<div class="form_content">
    <h3><?=$this->page_title
?></h3>
    <?php
    if ($msg != "") {
        echo "<div class='success'>$msg</div>";
    }
    ?>
    <form id="valid_about_us" method="post" action='<?=site_url($action)
    ?>' enctype ="multipart/form-data">
        <table width="100%" border="0" cellspacing="3" cellpadding="2">
            <tr>
                <th valign="top"><label for="Title">Title<span class="req_mark">*</span></label></th>
                <td><input type='text' name='title'id ="title" value="<?=$title ?>" class='text required ui-widget-content ui-corner-all width_250' /><?=form_error('title', '<span>', '</span>')
    ?></td>
            </tr>
            <tr>
                <th><label for="Description">Description</label><span class="req_mark">*</span></th>
                <td><textarea name='description' id= "content" rows="10" cols="50" class="tinymce"><?=$description
    ?></textarea><?=form_error('description', '<span>', '</span>')
    ?></td>
            </tr>
<?php $check = checked . "=" . "checked"; ?>

                    <tr>
                        <th><label for="status">Status</label></th>
                        <td><input type ="radio" name="status" value="Published" <?php
                    if ($status == "Published") {
                        echo $check;
                    }
?>/>Publish<br>
                    <input type ="radio" name="status" value="Not Published"<?php
                    if ($status == "Not Published" || $status == '') {
                        echo $check;
                    }
?>/> Not Publish </td>
            </tr>

            <tr>
                <th>&nbsp;</th><td><input type='submit' name='save' value='save' class='button' /><input type='button' name='cancel' value='Cancel' class='btn'onclick="window.history.back(-1)"/></td>
            </tr>
        </table>
    </form>

</div>