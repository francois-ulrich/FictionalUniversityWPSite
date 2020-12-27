<?php
get_header();

// Custom query for home posts
$homepagePosts = new WP_Query(array(
    'posts_per_page' => 2
));

// Today's date
$today = date('Ymd');

// Custom query for home posts
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
        )
    )
));


?>

<div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/library-hero.jpg')?>);"></div>
    <div class="page-banner__content container t-center c-white">
        <h1 class="headline headline--large">Welcome!</h1>
        <h2 class="headline headline--medium">We think you&rsquo;ll like it here.</h2>
        <h3 class="headline headline--small">Why don&rsquo;t you check out the <strong>major</strong> you&rsquo;re interested in?</h3>
        <a href="#" class="btn btn--large btn--blue">Find Your Major</a>
    </div>
</div>

<div class="full-width-split group">
    <div class="full-width-split__one">
        <div class="full-width-split__inner">
            <h2 class="headline headline--small-plus t-center">Upcoming Events</h2>
            
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
                // Clean up after custom query
                wp_reset_postdata();
            ?>


            <!-- <div class="event-summary"> 
                <a class="event-summary__date t-center" href="#">
                    <span class="event-summary__month">Mar</span>
                    <span class="event-summary__day">25</span>
                </a>
                <div class="event-summary__content">
                    <h5 class="event-summary__title headline headline--tiny"><a href="#">Poetry in the 100</a></h5>
                    <p>Bring poems you&rsquo;ve wrote to the 100 building this Tuesday for an open mic and snacks. <a href="#" class="nu gray">Learn more</a></p>
                </div>
            </div>
            <div class="event-summary">
                <a class="event-summary__date t-center" href="#">
                    <span class="event-summary__month">Apr</span>
                    <span class="event-summary__day">02</span>
                </a>
                <div class="event-summary__content">
                    <h5 class="event-summary__title headline headline--tiny"><a href="#">Quad Picnic Party</a></h5>
                    <p>Live music, a taco truck and more can found in our third annual quad picnic day. <a href="#" class="nu gray">Learn more</a></p>
                </div>
            </div> -->

            <p class="t-center no-margin"><a href="<?php echo get_post_type_archive_link('event'); ?>" class="btn btn--blue">View All Events</a></p>
        </div>
    </div>
    <div class="full-width-split__two">
        <div class="full-width-split__inner">
            <h2 class="headline headline--small-plus t-center">From Our Blogs</h2>

            <?php 
                // Loop through articles & display them
                while($homepagePosts->have_posts()){
                    $homepagePosts->the_post();
                    ?>

                    <div class="event-summary">                 
                        <a class="event-summary__date event-summary__date--beige t-center" href="<?php the_permalink(); ?>">
                            <span class="event-summary__month"><?php the_time("M"); ?></span>
                            <span class="event-summary__day"><?php the_time("d"); ?></span>
                        </a>
                        <div class="event-summary__content">
                            <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>

                            <p>
                                <?php 
                                    // If post has excerpt, show it. Else, take the main content and trim it down to a few words
                                    if(has_excerpt()){
                                        // Echo doesn't output text in <p> tags, so use that
                                        echo get_the_excerpt();
                                    }else{
                                        echo wp_trim_words(get_the_content(), 18);
                                    }
                                ?>
                                <a href="<?php the_permalink(); ?>" class="nu gray">Read&nbsp;more</a>
                            </p>
                        </div>
                    </div>

                    <?php

                    // Clean up after custom query
                    wp_reset_postdata();
                }
            ?>

            <p class="t-center no-margin"><a href="<?php echo site_url("/blog"); ?>" class="btn btn--yellow">View All Blog Posts</a></p>
        </div>
    </div>
</div>

<div class="hero-slider">
    <div data-glide-el="track" class="glide__track">
        <div class="glide__slides">
            <div class="hero-slider__slide" style="background-image: url(<?php echo get_theme_file_uri("images/bus.jpg") ?>);">
                <div class="hero-slider__interior container">
                    <div class="hero-slider__overlay">
                        <h2 class="headline headline--medium t-center">Free Transportation</h2>
                        <p class="t-center">All students have free unlimited bus fare.</p>
                        <p class="t-center no-margin"><a href="#" class="btn btn--blue">Learn more</a></p>
                    </div>
                </div>
            </div>
            <div class="hero-slider__slide" style="background-image: url(<?php echo get_theme_file_uri("images/apples.jpg") ?>);">
                <div class="hero-slider__interior container">
                    <div class="hero-slider__overlay">
                        <h2 class="headline headline--medium t-center">An Apple a Day</h2>
                        <p class="t-center">Our dentistry program recommends eating apples.</p>
                        <p class="t-center no-margin"><a href="#" class="btn btn--blue">Learn more</a></p>
                    </div>
                </div>
            </div>
            <div class="hero-slider__slide" style="background-image: url(<?php echo get_theme_file_uri("images/bread.jpg") ?>);">
                <div class="hero-slider__interior container">
                    <div class="hero-slider__overlay">
                        <h2 class="headline headline--medium t-center">Free Food</h2>
                        <p class="t-center">Fictional University offers lunch plans for those in need.</p>
                        <p class="t-center no-margin"><a href="#" class="btn btn--blue">Learn more</a></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="slider__bullets glide__bullets" data-glide-el="controls[nav]"></div>
    </div>
</div>

<?php
get_footer();
?>