<?php get_header(); ?>

<?php 

    global $edubase_wpopconfig; 



    $edubase_wpopconfig = $edubase_wpoengine->getPageConfig( $post->ID );   

    get_header( $edubase_wpoengine->getHeaderLayout($post->ID) );



    if( isset($edubase_wpopconfig['breadcrumb']) && $edubase_wpopconfig['breadcrumb'] ){

        do_action( 'edubase_wpo_layout_breadcrumbs_render' ); 

    } 
    $check_tax = wp_get_post_terms($post->ID, 'pdf-category', array("fields" => "all"));
    if (!empty($check_tax) && count($check_tax)>0) {
        $current_tax = 'pdf-category';
    }else{
        $current_tax = 'ppt-category';
    }
?>



<?php if(have_posts()) : while(have_posts()) : the_post(); ?>

<?php 

global $post, $wp_query;

//Returns All Term Items for "tutorials-category"

$term_list = wp_get_post_terms($post->ID, $current_tax, array("fields" => "all"));

$category_fa_class = get_term_meta($term_list[0]->term_id,'tutorial_category_fa_class', true);

//$category_image = get_term_meta($term_list[0]->term_id,'categoryimage_image', true);
$parent_terms = get_terms($current_tax, array('parent' => $term_list[0]->parent, 'hide_empty' => false, 'order'=>'ASC','orderby'=> 'ID',)); 
$child_terms = get_terms($current_tax, array('parent' => $term_list[0]->term_id, 'hide_empty' => false, 'order'=>'ASC','orderby'=> 'ID',
)); 
?>

<?php if (!empty($child_terms) && count($child_terms)> 0): ?>
    <?php $category_image = get_term_meta($term_list[0]->term_id,'tutorial_category_image', true); ?>
<?php else: ?>
    <?php $category_image = get_term_meta($term_list[0]->parent,'tutorial_category_image', true); ?>
<?php endif ?>
<?php 

$args = array(

    'post_type' => 'tutorials',

    'posts_per_page' => -1,

    'order'         =>'ASC',

    'orderby'       => 'date',

    'tax_query' => array(

      array(

        'taxonomy' => $current_tax,

        'field' => 'id',

        'terms' => array($term_list[0]->term_id)

      )

    )

  );

$all_posts = get_posts($args);

?>

<!--Single Course-->

<section id="single-course" class="space">

    <div class="container">

        <div class="row">

            <aside class="col-sm-4">

                <div class="widget logo">

                    <img src="<?php echo $category_image['url']; ?>" alt="<?php echo esc_html( $term_list[0]->name ); ?>">

                </div>

                <div class="widget lessons">

                    <ul>

                        <!-- <li><h3><?php echo esc_html( $term_list[0]->name ); ?></h3></li> -->

                        <?php if (!empty($all_posts)): ?>

                            <?php foreach ($all_posts as $my_post): ?>

                                <!-- <li><a href="<?php echo $my_post->guid ?>"><?php echo $my_post->post_title ?></a> </li>             -->

                            <?php endforeach ?>

                        <?php endif ?>

                            <?php if (!empty($child_terms) && count($child_terms)> 0): ?>
                                <?php foreach ($child_terms as $child_term) { ?>

                                    <li><h3><?php echo $child_term->name ?></h3></li>

                                    <?php 

                                        $args = array(

                                            'post_type' => 'tutorials',

                                            'posts_per_page' => -1,

                                            'order'         =>'ASC',

                                            'orderby'       => 'date',

                                            'tax_query' => array(

                                              array(

                                                'taxonomy' => $current_tax,

                                                'field' => 'id',

                                                'terms' => array($child_term->term_id)

                                              )

                                            )

                                          );

                                        $sidebar_all_posts = get_posts($args);

                                    ?>

                                    <?php foreach ($sidebar_all_posts as $sidebar_post) { ?>
                                        <li <?php if ($post->ID == $sidebar_post->ID) echo ' class="active"'; ?>>
                                            <a href="<?php echo get_permalink( $sidebar_post->ID ); ?>">
                                                <?php echo $sidebar_post->post_title;?> 
                                            </a> 
                                        </li>

                                    <?php } ?>

                                <?php } ?>

                            <?php else: ?>

                                <?php foreach ($parent_terms as $child_term) { ?>

                                    <li><h3><?php echo $child_term->name ?></h3></li>

                                    <?php 

                                        $args = array(

                                            'post_type' => 'tutorials',

                                            'posts_per_page' => -1,

                                            'order'         =>'ASC',

                                            'orderby'       => 'post_date',

                                            'tax_query' => array(

                                              array(

                                                'taxonomy' => $current_tax,

                                                'field' => 'id',

                                                'terms' => array($child_term->term_id)

                                              )

                                            )

                                          );

                                        $sidebar_all_posts = get_posts($args);

                                    ?>

                                    <?php foreach ($sidebar_all_posts as $sidebar_post) { ?>

                                        <li <?php if ($post->ID == $sidebar_post->ID) echo ' class="active"'; ?>>
                                            <a href="<?php echo get_permalink( $sidebar_post->ID ); ?>">
                                                <?php echo $sidebar_post->post_title;?> 
                                            </a> 
                                        </li>

                                    <?php } ?>

                                <?php } ?>

                            <?php endif ?>
    


                            

                    </ul>

                </div>

            </aside>

            <div class="col-sm-8 leason-detail">

                <h5><?php the_title( ); ?></h5>

                <div class="col-sm-12 no-padding buttons">

                    <?php previous_post_link('%link', '<i class="icofont icofont-double-left"></i> Previous Chapter'); ?>

                    <?php next_post_link('%link', 'Next Chapter <i class="icofont icofont-double-right"></i>') ?>

                </div>

                <?php 
                if( empty( $post->post_content) ) {
                echo "No Content Available";
                }
                else {
                the_content();
                }
                 ?>
                <div class="col-sm-12 no-padding buttons">

                    <?php previous_post_link('%link', '<i class="icofont icofont-double-left"></i> Previous Chapter'); ?>

                    <?php next_post_link('%link', 'Next Chapter <i class="icofont icofont-double-right"></i>') ?>

                </div>

            </div>

        </div>

    </div>

</section>



        <?php endwhile; ?>

    <?php endif; ?>

<?php get_footer(); ?>