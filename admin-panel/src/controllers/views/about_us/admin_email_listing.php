
<div class='grid_area' style="width:880px;">
    <?php
    if ($msg != "") {
        echo "<div class='success'>$msg</div>";
    }
    ?>
    <div class="tooolbars">
        <button id="add" title="about_us/add_admin_email"  class="jadd_button">ADD</button>
        <button title="about_us/edit_admin_email" class="jedit_button">EDIT</button>
        <button title="about_us/activate_admin_email" class="jedit_button">Activate</button>
         <button title="about_us/deactivate_admin_email" class="jedit_button">Deactive</button>
       <button title="about_us/delete_admin_email" class="jdelete_button">Delete</button>
    </div>

    <?php echo $grid_data ?>
</div>