<aside id="sidebar-news" class="sidebar">
    <h2 class="widget-title">Categories</h2>
    <ul class="categories">
        <?php
        // Retrieve and display news categories
        $categories = get_categories(array('taxonomy' => 'news_category')); // Replace 'news_category' with your custom taxonomy name
        foreach ($categories as $category) {
            echo '<li><a href="' . get_term_link($category->term_id, 'news_category') . '">' . $category->name . '</a></li>';
        }
        ?>
    </ul>

    <h2 class="widget-title">Recent Articles</h2>
    <ul class="recent-articles">
        <?php
        // Retrieve and display recent news posts
        $recent_posts = wp_get_recent_posts(array(
            'post_type'      => 'news',
            'numberposts'    => 5
        ));

        foreach ($recent_posts as $recent) {
            echo '<li><a href="' . get_permalink($recent['ID']) . '">' . $recent['post_title'] . '</a></li>';
        }
        ?>
    </ul>
</aside>
