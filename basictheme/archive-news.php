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

        <div class="entry-content">
            <?php the_content(); ?>
        </div>
    </article>

<?php
} 

get_footer();
?>