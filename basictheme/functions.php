<?php 

// function that enqueues a stylesheet in wp
function wordpress_resources(){

    wp_enqueue_style('style', get_stylesheet_uri());
}

add_action('wp_enqueue_scripts','wordpress_resources');

// Navigation menus
register_nav_menus(array(
    'primary' => __('Primary Menu'),
    'footer' => __('Footer Menu'),

));

/* custom post type - news articles  */ 
function custom_news_post_type() {

    $labels = array(
        'name'                => _x( 'News', 'Post Type General Name', 'basictheme' ),
        'singular_name'       => _x( 'News', 'Post Type Singular Name', 'basictheme' ),
        'menu_name'           => __( 'News', 'basictheme' ),
        'parent_item_colon'   => __( 'Parent News', 'basictheme' ),
        'all_items'           => __( 'All News', 'basictheme' ),
        'view_item'           => __( 'View News', 'basictheme' ),
        'add_new_item'        => __( 'Add New News', 'basictheme' ),
        'add_new'             => __( 'Add New', 'basictheme' ),
        'edit_item'           => __( 'Edit News', 'basictheme' ),
        'update_item'         => __( 'Update News', 'basictheme' ),
        'search_items'        => __( 'Search News', 'basictheme' ),
        'not_found'           => __( 'Not Found', 'basictheme' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'basictheme' ),
    );


    $args = array(
        'label'               => __( 'news', 'basictheme' ),
        'description'         => __( 'News and updates', 'basictheme' ),
        'labels'              => $labels,
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', 'page-attributes' ),
        'taxonomies'          => array( 'genres', 'category' ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'show_in_rest'        => true,

    );

    register_post_type( 'news', $args );

}

add_action( 'init', 'custom_news_post_type', 0 );
 
// funksion per me bo display custom post types ne front page
function include_news_on_front_page( $query ) {
    if ( $query->is_home() && $query->is_main_query() ) {
        $query->set( 'post_type', array( 'post', 'news' ) ); 
    }
}
add_action( 'pre_get_posts', 'include_news_on_front_page' );

// me regjistru sidebar
function register_custom_sidebars() {
    register_sidebar(array(
        'name'          => 'News Sidebar',
        'id'            => 'news-sidebar',
        'description'   => 'Sidebar for news categories and recent articles.',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>'
    ));
}
add_action('widgets_init', 'register_custom_sidebars');

// shortcode function so i can paste it into the custom html, displaying it on the sidebar
function custom_recent_articles_shortcode($atts) {
    $atts = shortcode_atts(array(
        'post_type' => 'news', 
        'numberposts' => 5, 
    ), $atts);

    $recent_posts = wp_get_recent_posts($atts);

    $output = '<h2>Recent Articles</h2>';
    $output .= '<ul>';
    foreach ($recent_posts as $recent) {
        $output .= '<li><a href="' . get_permalink($recent['ID']) . '">' . $recent['post_title'] . '</a></li>';
    }
    $output .= '</ul>';

    return $output;
}
add_shortcode('recent_articles', 'custom_recent_articles_shortcode');


// the code needed so the custom post types show up on the category page
add_filter('pre_get_posts', 'query_post_type');
function query_post_type($query) {
  if( is_category() ) {
    $post_type = get_query_var('post_type');
    if($post_type)
        $post_type = $post_type;
    else
        $post_type = array('nav_menu_item', 'post', 'news'); 
    $query->set('post_type',$post_type);
    return $query;
    }
}