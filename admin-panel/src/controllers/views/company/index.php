<div class="form_content">
    <form action="<?=site_url('company')?>" method="post">
    <table>
        <tr>
            <th>Search Field</th><td><select name="searchField"><?=$this->mod_company->get_search_options($_REQUEST['searchField'])?></select></td>
            <th>Search Keyword</th><td><input type="text" name="searchValue" class="text ui-widget-content ui-corner-all width_160" value="<?=$_REQUEST['searchValue']?>" class="" /></td>
        </tr>
        <tr><th colspan="6"><input type="submit" name="apply_filter" value="Apply Filter" class="button" /></th></tr>
    </table>
    </form>
</div>
<div class='grid_area'>
    <?php
    if ($msg != "") {
        echo "<div class='success'>$msg</div>";
    }
    ?>
    <div class="tooolbars">
        <button id="add" title="company/new_company"  class="jadd_button">Add</button>
        <button title="company/edit_company" class="jedit_button">Edit</button>
        <button title="company/delete_company" class="jdelete_button">Delete</button>
        <button title="company/company_status/1" class="jstatus_button"><?=lang('label_activate')?></button>
        <button title="company/company_status/0" class="jstatus_button"><?=lang('label_deactivate')?></button>
    </div>
    <hr />
<?php echo $grid_data ?>
</div>