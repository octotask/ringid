<div class='form_content'>
    <h3><?=$page_title?></h3>
    <form id="valid_tradecompany" action='<?=site_url($action)?>' method='post'>
        <table>
            <tr>
                <th>Trading Code </th>
                <td><input type="text" name="trading_code" value="<?=$trading_code?>" class="text ui-widget-content ui-corner-all width_200 " /></td>
            </tr>
            <tr>
                <th>Industry Name </th>
                <td><select name="industry_id"><?=$industries?></select></td>
            </tr>
            <tr><th>&nbsp;</th><td><input type='submit' name='save' value="<?=lang('label_save')?>" class='button' /> <input type='button' name='cancel' value="<?=lang('label_cancel')?>" class='cancel' /></td>
            </tr>
            industries
        </table>
    </form>
</div>