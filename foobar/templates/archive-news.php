<?php get_header( edubase_wpo_theme_options('headerlayout') ); ?>

  

<?php do_action( 'edubase_wpo_layout_breadcrumbs_render' ); ?>   

  

<?php do_action( 'edubase_wpo_layout_template_before' ) ; ?>

    <section id="blog" class="space-top">
        <div class="container">
            <div class="row">
                <!--Blog-->
                <div class="col-md-12 col-sm-12 no-padding blog-base">
                <?php 
            	  $temp = $wp_query; 
				  $wp_query = null; 
				  $wp_query = new WP_Query(); 
				  $wp_query->query('showposts=6&post_type=news'.'&paged='.$paged); 
				    if ($wp_query->have_posts()) : 
				        while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
		                	<article class="col-sm-4 blog-block animate-in move-up">
		                        <div class="inner">
		                        <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> </h4>
		                            <div class="blog-image">
					                    <div class="date">Posted: <?php the_time('jS F, Y '); ?></div>
					                    <p class="entry-content"><?php echo wp_trim_words( get_the_content(), 30, '...' );?></p>
		                                 <?php the_post_thumbnail(); ?>
		                            </div>
		                           
		                        </div>
		                    </article>
                    	<?php endwhile;
				    else:
				        echo "<h1>Not Found :( </h1>";
				        echo "No post found. Please refine your search";
				    endif;
				?> 
				<div class="col-sm-12 no-padding text-center shots-pagination animate-in move-up">
					<?php previous_posts_link('&laquo; Newer') ?>
					<?php next_posts_link('Older &raquo;') ?>
                    <ul class="pagination">
                        
                    </ul>
                </div>
                </div>
            </div>
        </div>
    </section>
    <?php 
	  $wp_query = null; 
	  $wp_query = $temp;  // Reset
	?>

<?php do_action( 'edubase_wpo_layout_template_after' ) ; ?>
<?php get_footer(); ?>