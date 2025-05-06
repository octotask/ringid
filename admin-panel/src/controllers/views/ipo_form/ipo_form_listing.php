
<div class='grid_area' style="width:880px;">
    <?php
    if ($msg != ""&& $upload_success_msg!="") {
        echo "<div class='success'>$msg And $upload_success_msg</div>";
    }
     elseif ($msg != "") {
        echo "<div class='success'>$msg</div>";
    }
    elseif($upload_success_msg != "") {
        echo "<div class='success'>$upload_success_msg</div>";
    }
    ?>
    <div class="tooolbars">
        <button id="add" title="ipo_form/add_ipo_form"  class="jadd_button">ADD</button>
        <button title="ipo_form/edit_ipo_form" class="jedit_button">EDIT</button>
        <button title="ipo_form/publish_ipo_form" class="jstatus_button">Publish</button>
         <button title="ipo_form/unpublish_ipo_form" class="jstatus_button">UnPublish</button>
       <button title="ipo_form/delete_ipo_form" class="jdelete_button">Delete</button>
       <button title="ipo_form/go_top" class="jedit_button">Go to top</button>
    </div>
    <hr />
    <?php echo $grid_data ?>
</div>