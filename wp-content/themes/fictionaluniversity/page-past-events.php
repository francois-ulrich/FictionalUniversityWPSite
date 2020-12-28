<?php
    get_header();

    // Today's date
    $today = date('Ymd');

    // Custom query for past events
    $pastEvents = new WP_Query(array(
        'paged' => get_query_var('paged', 1),
        'posts_per_page' => 10,
        'post_type' => 'event',
        'meta_key' => 'event_date',
        'orderby' => 'meta_value_num',
        'order' => 'ASC',
        'meta_query' => array( // Use meta_query if you want aditionnal conditions 
            array( // Condition: Get all events, where event_date came before today
                'key' => 'event_date',
                'compare' => '<',
                'value' => $today,
                'type' => 'numeric', // We are comparing numbers
            )
        )
    ));
?>

<div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri("images/ocean.jpg")  ?>);"></div>
    <div class="page-banner__content container container--narrow">
        <h1 class="page-banner__title"><?php echo the_title(); ?></h1>
    </div>
</div>

<div class="container container--narrow page-section">
    <?php
        // Loop through all posts
        while($pastEvents->have_posts()){
            // Get current post data
            $pastEvents->the_post();

            // Create date object for the event
            $eventDate = new DateTime(get_field('event_date'));
            ?>

            <div class="event-summary">
                <a class="event-summary__date t-center" href="#">
                    <span class="event-summary__month"><?php echo $eventDate->format("M"); ?></span>
                    <span class="event-summary__day"><?php echo $eventDate->format("d");; ?></span>
                </a>
                <div class="event-summary__content">
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
                    </p>
                </div>
            </div>

            <?php
        }
        // Display pagination
        echo paginate_links(array(
            'total' => $pastEvents->max_num_pages
        ));
    ?>
</div>

<?php
get_footer();
?>