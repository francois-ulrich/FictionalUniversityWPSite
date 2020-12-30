<?php


get_header();
// Loop through all blog posts
while (have_posts()) {
    // Tells wordpress to get all the infos of the post
    the_post();

    // Today's date
    $today = date('Ymd');

    // Custom query for home events
    $homepageEvents = new WP_Query(array(
        'posts_per_page' => -1,
        'post_type' => 'event',
        'meta_key' => 'event_date',
        'orderby' => 'meta_value_num',
        'order' => 'ASC',
        'meta_query' => array( // Use meta_query if you want aditionnal conditions 
            array( // Condition: Get all events, where event_date is later than today
                'key' => 'event_date',
                'compare' => '>=',
                'value' => $today,
                'type' => 'numeric', // We are comparing numbers
            ),
            // Only get events related to the program
            array(
                'key' => 'related_programs',
                'compare' => 'LIKE',
                'value' => strval(get_the_ID()),
            )
        )
    ));

    ?>
        <div class="page-banner">
            <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri("images/ocean.jpg")  ?>);"></div>
            <div class="page-banner__content container container--narrow">
                <h1 class="page-banner__title"><?php the_title(); ?></h1>
                <div class="page-banner__intro">
                    <p>Insert text</p>
                </div>
            </div>
        </div>

        <div class="container container--narrow page-section">
            <?php 
                // Show breadcrumb only if in a child page
                ?>
                    <div class="metabox metabox--position-up metabox--with-home-link">
                        <p>
                            <a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('program'); ?>"><i class="fa fa-home" aria-hidden="true"></i> Programs Home</a> 
                            <span class="metabox__main"><?php the_title(); ?></span>
                        </p>
                    </div>
                <?php
            ?>

            <div class="generic-content">
                <?php the_content(); ?>
            </div>

            <?php
            if($homepageEvents->found_posts > 0){
            ?>
                <hr class="section-break">

                <h3 class="headline headline--medium">Upcoming <?php the_title(); ?> events</h3>

                <?php 
                    while($homepageEvents->have_posts()){
                        $homepageEvents->the_post();

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
                                    <a href="<?php the_permalink(); ?>" class="nu gray">Learn&nbsp;more</a>
                                </p>
                            </div>
                        </div>

                        <?php
                    }
                ?>
            <?php
            }
            ?>

        </div>
    <?php
}
get_footer();