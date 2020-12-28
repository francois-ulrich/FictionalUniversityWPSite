<?php
    get_header();
?>

<div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri("images/ocean.jpg")  ?>);"></div>
    <div class="page-banner__content container container--narrow">
        <h1 class="page-banner__title"><?php the_archive_title(); ?></h1>
        <div class="page-banner__intro">
            <p><?php the_archive_description(); ?></p>
        </div>
    </div>
</div>

<div class="container container--narrow page-section">
    <?php
        // Loop through all posts
        while(have_posts()){
            // Get current post data
            the_post();
            ?>

            <div>
                <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                <p>
                    <?php 
                        // If post has excerpt, show it. Else, take the main content and trim it down to a few words
                        if(has_excerpt()){
                            // Echo get_... doesn't output text in <p> tags, so use that
                            echo get_the_excerpt();
                        }else{
                            echo wp_trim_words(get_the_content(), 18);
                        }
                    ?>

                    <br>

                    <a href="<?php the_permalink(); ?>" class="nu gray">Learn&nbsp;more</a>

                
                    <?php 
                    // if not last post, add hr
                    if ($wp_query->current_post +1 != $wp_query->post_count) {?>
                        <hr class='section-break'>
                    <?php } ?>

                </p>
            </div>

            <?php
        }
        ?>

        <hr class='section-break'>

        <p>Looking for a recap of past events? Check out our <a href="<?php echo site_url('/past-events') ?>">past events archive</a></p>

        <?php
        // Display pagination
        echo paginate_links();
    ?>
</div>

<?php
get_footer();
?>