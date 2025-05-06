
<div class='form_content'>
    <h3><?=$page_title?></h3>
    <form id="valid_company" action='<?=site_url($action)?>' method='post'>
        <table>
            <tr>
                <th>Company Name </th>
                <td><select name="company_name"><?=$this->mod_company->get_company_options($company_name)?></select></td>
            </tr>
            <tr><th>EPS </th><td><input type="text" name="eps" value="<?=$eps?>" class="text ui-widget-content ui-corner-all width_200 " /></td></tr>
            <tr><th>P/E </th><td><input type="text" name="p_e" value="<?=$p_e?>" class="text ui-widget-content ui-corner-all width_200 " /></td></tr>
            <tr><th>Authorize Capital </th><td><input type="text" name="authorize_capital" value="<?=$authorize_capital?>" class="text ui-widget-content ui-corner-all width_200 " /></td></tr>
            <tr><th>Paid Up Capital </th><td><input type="text" name="paidup_capital" value="<?=$paidup_capital?>" class="text ui-widget-content ui-corner-all width_200 " /></td></tr>
            <tr><th>Face Value </th><td><input type="text" name="face_value" value="<?=$face_value?>" class="text ui-widget-content ui-corner-all width_200 " /></td></tr>
            <tr><th>Lot </th><td><input type="text" name="lot" value="<?=$lot?>" class="text ui-widget-content ui-corner-all width_200 " /></td></tr>
            <tr><th>No of Share </th><td><input type="text" name="no_of_share" value="<?=$no_of_share?>" class="text ui-widget-content ui-corner-all width_200 " /></td></tr>
            <tr><th>Share %</th><td><input type="text" name="share" value="<?=$share?>" class="text ui-widget-content ui-corner-all width_200 " /></td></tr>
            <tr><th>NAV </th><td><input type="text" name="nav" value="<?=$nav?>" class="text ui-widget-content ui-corner-all width_200 " /></td></tr>
         
            <tr><th>Category </th><td><select name="category">
                            
                        <option value="" <?php if($_POST['category']==''){?> selected<?php }?>>Select</option>
                             <option value="1"  <?php if($category==1){?> selected<?php }?>>Category A</option>
                              <option value="3"  <?php if($category==3){?> selected<?php }?>>Category B</option>
                             <option value="4"<?php if($category==4){?> selected<?php }?>>Category N</option>
                             <option value="2"<?php if($category==2){?> selected<?php }?>>Category Z</option>
                         </select></td></tr>
            <tr><th>&nbsp;</th><td><input type='submit' name='save' value="<?=lang('label_save')?>" class='button' /> <input type='button' name='cancel' value="<?=lang('label_cancel')?>" class='cancel' /></td>
            </tr>
        </table>
    </form>
</div>