<?php if (common::is_logged_in()): ?>
    <div class="top_menu">
        <ul class="sf-menu">
            <li><a href="<?=site_url() ?>" class="white">Home</a></li>
            <li class="current"><a href="#a" class="white">Settings</a>
                <ul>
                    <li><a href="<?=site_url('news') ?>">Top Left Content</a>
                        <ul>
                            <li><a href="<?=site_url('news') ?>">Left Side News</a></li>
                            <li><a href="<?=site_url('news/archive_news') ?>">Archive News</a></li>
                        </ul>    
                    </li>
                    <li><a href="<?=site_url('news_link') ?>">Top Right Content</a>
                         <ul>
                            <li><a href="<?=site_url('news_link') ?>">Right Side News</a></li>
                            <li><a href="<?=site_url('news_link/archive_news') ?>">Archive News</a></li>
                        </ul>   
                    </li>
                    <li><a href="<?=site_url('news/update_user') ?>">Admin Setting</a>
                        <ul><li>  <a href="<?=site_url('news/add_user') ?>">Add User</a></li>
                            <li>  <a href="<?=site_url('news/update_user') ?>">Update User</a></li>
                        </ul>
                    </li>
                    <li><a href="<?=site_url('about_us/admin_email') ?>">Admin Email Setting</a></li>
                </ul>
            </li>
            <li><a href="<?=site_url('static_pages') ?>" class="white">Static Page</a>
                <ul>
                    <li><a href="<?=site_url('static_pages') ?>">Manage Pages</a></li>
                    <li><a href="<?=site_url('static_pages/new_page') ?>">Add New Page</a></li>
                </ul>
            </li>
            <li><a href="<?=site_url('feedback') ?>" class="white">Feedback</a></li>
            <li><a href="<?=site_url('company') ?>" class="white">Company</a></li>
            <li><a href="<?=site_url('company/new_tradecompany') ?>" class="white">Add Company</a></li>
            <li class="current"><a href="<?=site_url('ipo_form') ?>" class="white">IPO Form Setting</a>
                 <li><a href="<?=site_url('seo') ?>" class="white">Seo</a></li>
        </ul>
    </div>
    <div class="clear"></div>
<?php endif; ?>