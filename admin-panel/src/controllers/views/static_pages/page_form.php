<div class='form_content' style="width:850px;">
    <h3><?=$form_page_title?></h3>
<form id="valid_page" action='<?=$action?>' method='post'>
    <table cellpadding=0 cellspacing=1>
        <tbody>
            <tr>
                <th>Page Language <span class="req_mark">*</span></th>
                <td>
                    <select name="page_language"><?=$this->mod_static_pages->get_language_opt($page_language)?></select>
                    <?=form_error('page_language','<span>','</span>')?>
                </td>
            </tr>
            <tr>
                <th>Page Category <span class="req_mark">*</span></th>
                <td>
                    <select name="page_category"><?=$this->mod_static_pages->get_page_category($page_category)?></select>
                    <?=form_error('page_category','<span>','</span>')?>
                </td>
            </tr>
            <tr>
                <th><?=lang('label_page_name')?> <span class='req_mark'>*</span></th>
                <td><input type='text' name='page_name' value='<?=set_value('page_name',$page_name)?>' class='text ui-widget-content ui-corner-all required width_200' /><?=form_error('page_name','<span>','</span>')?></td>
            </tr>
            <tr>
                <th><?=lang('label_page_title')?> <span class='req_mark'>*</span></th>
                <td><input type='text' name='page_title' value='<?=set_value('page_title',$page_title)?>' class='text ui-widget-content ui-corner-all required width_200' /><?=form_error('page_title','<span>','</span>')?></td>
            </tr>
           <tr>
               <th><?=lang('label_page_des')?></th>
                <td><textarea name='page_des' class="tinymce" id='wysiwyg' rows="5" cols="40"><?=$page_des?></textarea>
                </td>
            </tr>
            <tr><th>&nbsp;</th>
                <td><input type='submit' name='save' value='Save' class="button" /> <input type='button' value='cancel' class="cancel" /></td>
            </tr>
        </tbody>
    </table>
</form>
</div>
