
<div class='grid_area' style="width:880px;">
    <h3><?=$page_title?></h3>
    <?php
    if ($msg != "") {
        echo "<div class='success'>$msg</div>";
    }
    ?>
    <div class="tooolbars">
        <button id="add" title="news_link/add_news_link"  class="jadd_button">ADD</button>
        <button title="news_link/edit_news_link" class="jedit_button">EDIT</button>
        <button title="news_link/publish_news_link" class="jstatus_button">Publish</button>
         <button title="news_link/unpublish_news_link" class="jstatus_button">UnPublish</button>
       <button title="news_link/delete_news_link" class="jdelete_button">Delete</button>
       <button title="news_link/go_archive" class="jstatus_button">Archive</button>


    </div>
    <hr />
    <?php echo $grid_data ?>
</div>