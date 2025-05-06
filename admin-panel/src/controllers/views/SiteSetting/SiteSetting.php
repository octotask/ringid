<div class="form_content">
    <h3><?=$this->page_title
?></h3>
    <?php
    if ($msg != '') {
        echo "<div class='error'>" . $msg . "</div>";
    }
    ?>
    <form id="valid_news" method="post" action='<?=site_url('')
    ?>' enctype ="multipart/form-data">
        <table width="100%" border="0" cellspacing="3" cellpadding="2">
            <tr>
                <th valign="top" ><label for="Title">News  Title<span>*</span></label></th>
                <td><input type='text' name='newsTitle'id ="newsTitle" value="<?=$this->articleTitle ?>" class='text required ui-widget-content ui-corner-all' /><?=form_error('newsTitle','<span>','</span>')?></td>
            </tr>
            <tr>
                <th><label for="Description">News Description</label></th>
                <td><textarea name='newsDescription' id= "content" rows="10" cols="50" class="ui-widget-content ui-corner-all"><?=$this->articleDescriptio?></textarea><?=form_error('newsDescription','<span>','</span>')?></td>
            </tr>

            <tr>
                <th>&nbsp;</th><td><input type='submit' name='save' value='save' class='button' /><input type='button' name='cancel' value='Cancel' class='btn'onclick="window.history.back(-1)"/></td>
            </tr>
        </table>
    </form>

</div>