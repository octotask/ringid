<div class="form_content" style="width:780px;">
    <h3><?=$page_title?></h3>
    <?php
  if ($error_msg != "") {
        echo "<div class='error'>$error_msg</div>";

  }
    ?>
    <form id="upload_ipo_file" method="post" action='<?=site_url($action)?>' enctype ="multipart/form-data">
        <table width="100%" border="0" cellspacing="3" cellpadding="2">
            <tr>
                <th valign="top"><label for="Title">Company Name<span class="req_mark">*</span></label></th>
                <td><input type='text' name='company_name'id ="company_name" value="<?=$company_name?>" class='text required ui-widget-content ui-corner-all width_200' /><?=form_error('company_name', '<span>', '</span>')?></td>
                   </tr>

                   <tr>
                       <th><label for="company_description">Description<span class="req_mark">*</span></label></th>
                       <td><textarea name='company_description' id= "content" rows="10" cols="50" class="tinymce"><?=$company_description; ?></textarea><?=form_error('company_description', '<span>', '</span>')?></td>
                </tr>
                  <tr>
                <th valign="top"><label for="Link">File<span class="req_mark">*</span></label></th>
                <td><input type="hidden" name="h_file" value="<?=$file_name?>" /> <input type="file" name="file_name" id="file_name" class='button' size="40"/><?=form_error('file_name', '<span>', '</span>')?><label>[Note: File Type(doc,docx,xml,pdf,jpg,gif,jpeg,png)]</label></td>
            </tr>
            <tr>
                <th><label for="status">Status</label></th>
                <td>
                    <input type ="radio" name="status" value="1" checked /> Publish
                    <input type ="radio" name="status" value="0" <?php if($status==0){echo 'checked';}?> /> Not Publish
                </td>
            </tr>

            <tr>
                <th>&nbsp;</th><td><input type='submit' name='save' value='save' class='button' /><input type='button' name='cancel' value='Cancel' class='btn'onclick="window.history.back(-1)"/></td>
            </tr>
        </table>
    </form>

</div>