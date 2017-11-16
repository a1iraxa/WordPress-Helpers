<?php get_header(); ?>
<?php 
    global $edubase_wpopconfig; 
    $edubase_wpopconfig = $edubase_wpoengine->getPageConfig( $post->ID );   
    get_header( $edubase_wpoengine->getHeaderLayout($post->ID) );
    if( isset($edubase_wpopconfig['breadcrumb']) && $edubase_wpopconfig['breadcrumb'] ){
        do_action( 'edubase_wpo_layout_breadcrumbs_render' ); 
    } 
    ?>
<!-- Library-->
<section id="library" class="space">
    <div class="container">
        <div class="row">
            <?php 
                $output = '';
                $tutorials_parent_term  = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
                 
                if ($tutorials_parent_term->parent != 0) {
                    $child_terms = get_terms('pdf-category', array('parent' => $tutorials_parent_term->term_id, 'orderby' => 'id', 'hide_empty' => false));
                    
                    foreach ($child_terms as $child_term) {
                        $args = array(
                            'post_type' => 'tutorials',
                            'posts_per_page' => 1,
                            'order'         =>'ASC',
                            'orderby'       => 'post_date',
                            'tax_query' => array(
                              array(
                                'taxonomy' => 'pdf-category',
                                'field' => 'id',
                                'terms' => array($child_term->term_id)
                              )
                            )
                          );
                        $first_cat_post = get_posts($args);
                        $category_fa_class = get_term_meta($child_term->term_id,'tutorial_category_fa_class', true);
                        $category_image = get_term_meta($child_term->term_id,'tutorial_category_image', true);
                        ?>
                        <a href="<?php echo get_permalink( $first_cat_post[0]->ID ) ?>" class="col-sm-3 course-block">
                                <div class="inner">
                                    <div class="icon center">
                                        <i class="icofont <?php echo $category_fa_class ?> "></i>
                                    </div>
                                    <div class="heading center">
                                        <h3><?php echo $child_term->name ?></h3>
                                    </div>
                                </div>
                            </a>
                        <?php
                    }
                }else{ ?>
                    <!--Library Category-->
                    <section id="library-category" class="space">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-8 category-block">
                                    <div class="panel-group accordion" id="accordion">
                                        <?php 
                                            $terms = get_terms('pdf-category', array('parent' => $tutorials_parent_term->term_id, 'hide_empty' => false));
                                            // echo "<pre>";
                                            // print_r($tutorials_parent_term);
                                            // die;
                                            $panel = 1;
                                            
                                            foreach ($terms as $term) { 
                                                $term_fa_class = get_term_meta($term->term_id,'tutorial_category_fa_class', true);
                                                $collapsed = ($panel == 1) ? '' : 'collapsed' ;
                                                $in_class = ($panel == 1) ? 'in' : '' ;
                                                $child_terms = get_terms('pdf-category', array('parent' => $term->term_id, 'hide_empty' => false, 'orderby' => 'id'));
                                                ?>
                                                <div class="panel panel-default">
                                                        <div class="panel-heading">
                                                            <h4 class="panel-title">
                                                                <a class="accordion-toggle <?php echo $collapsed;?>" data-toggle="collapse" data-parent="#accordion" href="#panel<?php echo $panel; ?>"><i class="icofont <?php echo $term_fa_class; ?>"></i><?php echo $term->name;?></a>
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
                                                                                'order'         =>'ASC',
                                                                                'orderby'       => 'post_date',
                                                                                'tax_query' => array(
                                                                                  array(
                                                                                    'taxonomy' => 'pdf-category',
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
                                        	<?php $terms = get_terms('pdf-category', array('parent' => $tutorials_parent_term->term_id, 'hide_empty' => false, 'number' => 6)); ?>
                                            <?php foreach ($terms as $sidebar_parent_term) { ?>
                                                <?php 
                                                    $sidebar_child_terms = get_terms('pdf-category', array('parent' => $sidebar_parent_term->term_id, 'hide_empty' => false, 'number' => 2));
                                                    foreach ($sidebar_child_terms as $sidebar_term) { 
                                                        $category_fa_class = get_term_meta($sidebar_term->term_id,'tutorial_category_fa_class', true);
                                                        $args = array(
                                                                'post_type' => 'tutorials',
                                                                'posts_per_page' => 1,
                                                                'tax_query' => array(
                                                                  array(
                                                                    'taxonomy' => 'pdf-category',
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
                <?php }
            ?>
        </div>
    </div>
    </section>
<?php get_footer(); ?>