<div class="form_content">
    <form action="<?=site_url('static_pages')?>" method="post">
    <table>
        <tr>
            <th>Search Field</th><td><select name="searchField"><?=$this->mod_static_pages->get_search_options($_REQUEST['searchField'])?></select></td>
            <th>Search Keyword</th><td><input type="text" name="searchValue" class="text ui-widget-content ui-corner-all width_160" value="<?=$_REQUEST['searchValue']?>" class="" /></td>
        </tr>
        <tr><th colspan="6"><input type="submit" name="apply_filter" value="Apply Filter" class="button" /></th></tr>
    </table>
    </form>
</div>
<div class='grid_area' style="width:880px;">
    <?php
    if ($msg != "") {
        echo "<div class='success'>$msg</div>";
    }
    ?>
    <div class="tooolbars">
        <button id="add" title="static_pages/new_page"  class="jadd_button"><?=lang('label_add')?></button>
        <button title="static_pages/edit_page" class="jedit_button"><?=lang('label_edit')?></button>
        <button title="static_pages/delete_page" class="jdelete_button"><?=lang('label_delete')?></button>
        <button title="static_pages/page_status/1" class="jstatus_button"><?=lang('label_activate')?></button>
        <button title="static_pages/page_status/0" class="jstatus_button"><?=lang('label_deactivate')?></button>
    </div>
    <hr />
<?php echo $grid_data ?>
</div>