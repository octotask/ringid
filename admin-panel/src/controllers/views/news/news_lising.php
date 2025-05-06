<div class='grid_area' style="width:880px;">
    <h3><?=$page_title?></h3>
    <?php
    if ($msg != "") {
        echo "<div class='success'>$msg</div>";
    }
    ?>
    <div class="tooolbars">
        <button id="add" title="news/add_news"  class="jadd_button">ADD</button>
        <button title="news/edit_news" class="jedit_button">EDIT</button>
        <button title="news/publish_news" class="jstatus_button">Publish</button>
        <button title="news/unpublish_news" class="jstatus_button">UnPublish</button>
        <button title="news/delete_news" class="jdelete_button">Delete</button>
        <button title="news/go_archive" class="jedit_button">Archive</button>
    </div>
    <hr />
    <?php echo $grid_data ?>
</div>