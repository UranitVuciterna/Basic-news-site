<?php
/**
 * Template for displaying  news articles.
 */

get_header();

while (have_posts()) {
    the_post();
    ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header class="entry-header">
            <h1 class="entry-title">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h1>
        </header>

        <div class="featured-image">
            <?php if (has_post_thumbnail()) {
                
                the_post_thumbnail();
            }
            ?>
            <?php the_content(); ?>
        </div>
    </article>

<?php
} 

get_footer();
?>