<?php
/**
 * Template for displaying single news articles.
 */

get_header();

while (have_posts()) {
    the_post();
    $subtitle = get_field('subtitle');
    $author_bio = get_field('author_biography');
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
    
        <hr>
        <?php if ($author_bio) : ?>
            <div class="author-bio">
                <h3>Author Biography</h3>
                <?php echo $author_bio; ?>
            </div>
        <?php endif; ?>
    </article>

<?php
} // End of the loop.

get_footer();
?>