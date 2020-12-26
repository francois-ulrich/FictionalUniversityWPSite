<?php
get_header();

// Get parent page ID
$parentPageId = wp_get_post_parent_id(get_the_ID());

if($parentPageId){
    $findChildrenOf = $parentPageId;
} else {
    $findChildrenOf = get_the_ID();
}

// Associative array of arguments for the wp_list_pages() function called for the menu
$wpListPagesArgs = array(
    "title_li" => NULL,
    "child_of" => $findChildrenOf,
);

// Get if page isn't a parent nor a children
$notChildrenOrParent = $parentPageId || (get_pages(array(
    "child_of" => get_the_ID()
)));

// Loop through all blog posts
while (have_posts()) {
    // Tells wordpress to get all the infos of the post
    the_post();
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
            if( $parentPageId ){
                ?>
                    <div class="metabox metabox--position-up metabox--with-home-link">
                        <p>
                            <a class="metabox__blog-home-link" href="<?php echo get_permalink($parentPageId); ?>"><i class="fa fa-home" aria-hidden="true"></i> Back to <?php echo get_the_title( $parentPageId ); ?></a> 
                            <span class="metabox__main"><?php echo the_title(); ?></span>
                        </p>
                    </div>
                <?php
            }
        ?>

        <?php if($notChildrenOrParent){ ?>
            <div class="page-links">
                <h2 class="page-links__title"><a href="<?php echo get_permalink($parentPageId); ?>"><?php echo get_the_title( $parentPageId ); ?></a></h2>
                <ul class="min-list">
                    <?php 
                        echo wp_list_pages($wpListPagesArgs);
                    ?>
                </ul>
            </div>
        <?php } ?>
        

        <div class="generic-content">
            <?php 
                the_content();
            ?>
        </div>

    </div>

    <div class="page-section page-section--beige">
        <div class="container container--narrow generic-content">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officia voluptates vero vel temporibus aliquid possimus, facere accusamus modi. Fugit saepe et autem, laboriosam earum reprehenderit illum odit nobis, consectetur dicta. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos molestiae, tempora alias atque vero officiis sit commodi ipsa vitae impedit odio repellendus doloremque quibusdam quo, ea veniam, ad quod sed.</p>

            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officia voluptates vero vel temporibus aliquid possimus, facere accusamus modi. Fugit saepe et autem, laboriosam earum reprehenderit illum odit nobis, consectetur dicta. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos molestiae, tempora alias atque vero officiis sit commodi ipsa vitae impedit odio repellendus doloremque quibusdam quo, ea veniam, ad quod sed.</p>
        </div>
    </div>

<?php
}
get_footer();
