<?php
/**
 * Template Name: Front Page Custom
 * Description: A custom template for displaying the front page with custom post type 'news' posts.
 */

get_header();
?>

<div class="content-sidebar-wrap">
    <div id="primary" class="content-area">
        <main id="main" class="site-main">
            <?php
            $news_ids = array(); 

            // Custom post type query
            $args = array(
                'post_type'      => 'news', 
                'posts_per_page' => 3 // numri i postimeve per faqe
            );

            $news_query = new WP_Query($args);

            if ($news_query->have_posts()) :
                while ($news_query->have_posts()) :
                    $news_query->the_post();

                    
                    $news_ids[] = get_the_ID();


                    $subtitle = get_field('subtitle');
                    ?>

                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <header class="entry-header">
                            <h1 class="entry-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h1>
                            <?php if ($subtitle) : ?>
                                <h2 class="news-subtitle"><?php echo $subtitle; ?></h2>
                            <?php endif; ?>
                        </header>

                        <div class="entry-content">
                            <?php the_content(); ?>
                        </div>
                    </article>
                    <hr>
                    <?php
                endwhile;

                // Remove duplicate post IDs
                $news_ids = array_unique($news_ids);
            endif;

            wp_reset_postdata();
            ?>
        </main><!-- #main -->
    </div><!-- #primary -->

    <aside id="sidebar-news" class="sidebar">
        <?php if (is_active_sidebar('news-sidebar')) : ?>
            <?php dynamic_sidebar('news-sidebar'); ?>
        <?php endif; ?>
    </aside>
</div><!-- .content-sidebar-wrap -->

<?php
get_footer();
