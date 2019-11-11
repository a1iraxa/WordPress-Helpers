<?php get_header(); ?>

<?php 

    global $post, $edubase_wpopconfig;



    $edubase_wpopconfig = $edubase_wpoengine->getPageConfig( $post->ID );   

    get_header( $edubase_wpoengine->getHeaderLayout($post->ID) );



    if( isset($edubase_wpopconfig['breadcrumb']) && $edubase_wpopconfig['breadcrumb'] ){

        do_action( 'edubase_wpo_layout_breadcrumbs_render' ); 

    } 
    $the_tax = get_taxonomy( get_query_var( 'taxonomy' ) );
    $current_tax =$the_tax->query_var;
?>



<!--Library Category-->

<section id="library-category" class="space">

    <div class="container">

        <div class="row">

            <div class="col-sm-8 category-block">

                <div class="panel-group accordion" id="accordion">

                    <?php 
                        // $terms = wp_get_object_terms( $post->ID, $current_tax, array( 'fields' => 'all' ) );
                        // print_r($object_terms);
                        // die;

                        $terms = get_terms($current_tax, array('parent' => 0, 'hide_empty' => false));

                        $panel = 1;

                        

                        foreach ($terms as $term) { 

                            $collapsed = ($panel == 1) ? '' : 'collapsed' ;

                            $in_class = ($panel == 1) ? 'in' : '' ;

                            $child_terms = get_terms($current_tax, array('parent' => $term->term_id, 'hide_empty' => false));

                            ?>

                            <div class="panel panel-default">

                                    <div class="panel-heading">

                                        <h4 class="panel-title">

                                            <a class="accordion-toggle <?php echo $collapsed;?>" data-toggle="collapse" data-parent="#accordion" href="#panel<?php echo $panel; ?>"><i class="icofont icofont-autism"></i><?php echo $term->name;?></a>

                                        </h4>

                                    </div>

                                    <div id="panel<?php echo $panel; ?>" class="panel-collapse collapse <?php echo $in_class; ?>">

                                        <div class="panel-body">

                                            <ul>

                                                <?php foreach ($child_terms as $child_term) { ?>

                                                    <?php

                                                        $category_fa_class = get_term_meta($child_term->term_id,'tutorial_category_fa_class', true);

                                                        $args = array(

                                                            'post_type' => 'tutorials',

                                                            'posts_per_page' => 1,

                                                            'tax_query' => array(

                                                              array(

                                                                'taxonomy' => $current_tax,

                                                                'field' => 'id',

                                                                'terms' => array($child_term->term_id)

                                                              )

                                                            )

                                                          );

                                                        $first_cat_post = get_posts($args);

                                                     ?>

                                                    <li><a href="<?php echo get_permalink( $first_cat_post[0]->ID ) ;?>"><i class="icofont <?php echo $category_fa_class;?>"></i>

                                                    <?php echo $child_term->name;?></a> </li>

                                                <?php } ?>

                                            </ul>

                                        </div>

                                    </div>

                                </div>

                            <?php 

                            $panel++;

                        }

                        ?>

                </div>

            </div>

            <aside class="col-sm-4">

                <div class="widget " id="library">

                    <h3>Latest Courses</h3>

                    <div class="course">

                        <?php foreach ($terms as $sidebar_parent_term) { ?>

                            <?php 

                                $sidebar_child_terms = get_terms($current_tax, array('parent' => $sidebar_parent_term->term_id, 'hide_empty' => false));

                                foreach ($sidebar_child_terms as $sidebar_term) { 

                                    $category_fa_class = get_term_meta($sidebar_term->term_id,'tutorial_category_fa_class', true);

                                    $args = array(

                                            'post_type' => 'tutorials',

                                            'posts_per_page' => 1,

                                            'tax_query' => array(

                                              array(

                                                'taxonomy' => $current_tax,

                                                'field' => 'id',

                                                'terms' => array($sidebar_term->term_id)

                                              )

                                            )

                                          );

                                    $first_cat_post = get_posts($args);

                                    ?>

                                    <a href="<?php echo get_permalink( $first_cat_post[0]->ID ) ;?>" class="col-sm-12 no-padding course-block">

                                        <div class="inner">

                                            <div class="icon center">

                                                <i class="icofont <?php echo $category_fa_class;?>"></i>

                                            </div>

                                            <div class="heading center">

                                                <h3><?php echo $sidebar_term->name;?></h3>

                                            </div>

                                        </div>

                                    </a>

                            <?php } ?>

                        <?php } ?>

                    </div>

                </div>

            </aside>

        </div>

    </div>

</section>

<?php get_footer(); ?>