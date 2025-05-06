<div class='grid_area' style="width:880px;">
    <?php
    if ($msg != "") {
        echo "<div class='success'>$msg</div>";
    }
    ?>
    <div class="tooolbars">
        <button id="add" title="about_us/add_about_us"  class="jadd_button">ADD</button>
        <button title="about_us/edit_about_us" class="jedit_button">EDIT</button>
        <button title="about_us/publish_about_us" class="jstatus_button">Publish</button>
         <button title="about_us/unpublish_about_us" class="jstatus_button">UnPublish</button>
       <button title="about_us/delete_about_us" class="jdelete_button">Delete</button>
    </div>
    <hr />publish_about_us
    <?php echo $grid_data ?>
</div>