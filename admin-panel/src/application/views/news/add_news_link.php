<div class="form_content" style="width:880px;">
    <h3><?=$page_title?></h3>
    <?php
    if ($msg != "") {
        echo "<div class='success'>$msg</div>";
    }
    ?>
    <form id="valid_news_link" method="post" action='<?=site_url($action)?>' enctype ="multipart/form-data">
        <table width="100%" border="0" cellspacing="3" cellpadding="2">
               <tr>
               <th>Language<span class="req_mark">*</span></th>
                       <td>
                       <input type="radio" name="language" value="1" checked>Bangla
                       <input type="radio" name="language" value="2">English
                       </td>
                       <?=form_error('language', '<span>', '</span>')?>
               </tr>

             <tr>
                <th>Company Name <span class="req_mark">*</span></th>
                <td><select name="company_name"><?=$this->mod_site->get_company_options($company_name)?></select></td>
             </tr>
            <tr>
                <th valign="top"><label for="Title">Title<span class="req_mark">*</span></label></th>
                <td><input type='text' name='news_title'id ="news_title" value="<?=$news_title ?>" class='text required ui-widget-content ui-corner-all width_350' /><?=form_error('news_title', '<span>', '</span>')?></td>
            </tr>

                <tr>
                       <th><label for="news_description">Description<span class="req_mark">*</span></label></th>
                       <td><textarea name='news_description' id= "content" rows="10" cols="50" class="tinymce"><?=$news_description; ?></textarea><?=form_error('news_description', '<span>', '</span>')?></td>
                </tr>
                 <tr>
                <th valign="top"><label for="News_link">Link<span class="req_mark">*</span></label></th>
                <td><input type='text' name='news_link'id ="news_link" value="<?=$news_link
            ?>" class='text required ui-widget-content ui-corner-all' style="width:320px; font-size:12px;" /><?=form_error('news_link', '<span>', '</span>')
            ?></td>
            </tr>
                        <tr>
                            <th><label for="status">Status</label></th>

                            <td><input type ="radio" name="status" value="1" checked/>Publish<br>
                        <input type ="radio" name="status" value="0" <?php if($status==0){echo 'checked';}?>/> Not Publish </td>
                        </tr>
           
            <tr>
                <th>&nbsp;</th><td><input type='submit' name='save' value='save' class='button' /><input type='button' name='cancel' value='Cancel' class='btn'onclick="window.history.back(-1)"/></td>
            </tr>
        </table>
    </form>

</div>