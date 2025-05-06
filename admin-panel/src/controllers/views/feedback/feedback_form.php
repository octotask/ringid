<div class='form_content'>
    <h3><?=$page_title?></h3>
    <form id="valid_feedback" action='<?=site_url($action)?>' method='post'>
        <table>
            <tr><th>First Name <span class="req_mark">*</span></th><td><input type="text" name="first_name" value="<?=$first_name?>" class="text ui-widget-content ui-corner-all width_200 " /><?=form_error('first_name','<span>','</span>')?></td></tr>
                <tr><th>Last Name <span class="req_mark">*</span></th><td><input type="text" name="last_name" value="<?=$last_name?>" class="text ui-widget-content ui-corner-all width_200 " /><?=form_error('last_name','<span>','</span>')?></td></tr>
                <tr><th>Email <span class="req_mark">*</span></th><td><input type="text" name="email" value="<?=$email?>" class="text ui-widget-content ui-corner-all width_200 " /><?=form_error('email','<span>','</span>')?></td></tr>
                <tr><th>Company Name:</th><td><input type="text" name="company" value="<?=$company?>" class="text ui-widget-content ui-corner-all width_200 " /></td></tr>
                <tr><th>Phone Number:</th><td><input type="text" name="phone" value="<?=$phone?>" class="text ui-widget-content ui-corner-all width_200 " /></td></tr>
                <tr><th>Comments <span class="req_mark">*</span></th><td><textarea name="comments" rows="5" cols="40" class="ui-widget-content ui-corner-all "><?=$comments?></textarea><?=form_error('comments','<span class="block">','</span>')?></td></tr>
                <tr><th>Reply Message <span class="req_mark">*</span></th><td><textarea name="feedback_reply" rows="5" cols="40" class="ui-widget-content ui-corner-all "><?=$feedback_reply?></textarea><?=form_error('feedback_reply','<span class="block">','</span>')?></td></tr>
            <tr><th>&nbsp;</th><td><input type='submit' name='save' value="<?=lang('label_save')?>" class='button' /> <input type='button' name='cancel' value="<?=lang('label_cancel')?>" class='cancel' /></td>
            </tr>
        </table>
    </form>
</div>