<div class="form_content">
    <form action="<?=site_url('user')?>" method="post">
    <table>
        <tr>
            <th>Search Field</th><td><select name="searchField"><?=$this->mod_user->get_search_options($_REQUEST['searchField'])?></select></td>
            <th>Search Keyword</th><td><input type="text" name="searchValue" class="text ui-widget-content ui-corner-all width_160" value="<?=$_REQUEST['searchValue']?>" class="" /></td>
        </tr>
        <tr><th colspan="4"><input type="submit" name="apply_filter" value="Apply Filter" class="button" /></th></tr>
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
        <?php if(common::add_permit()):?>
        <button id="add" title="user/new_user"  class="jadd_button">Add</button>
        <?php endif;?>
        <?php if(common::update_permit()): ?>
        <button title="user/edit_user" class="jedit_button">Edit</button>
        <button title="user/delete_user" class="jdelete_button">Delete</button>
        <button title="user/user_status/enabled" class="jstatus_button">Activate</button>
        <button title="user/user_status/disabled" class="jstatus_button">Inactive</button>
        <?php endif;?>
    </div>
    <hr />
<?php echo $grid_data ?>
</div>