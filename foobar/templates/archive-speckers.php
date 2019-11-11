<?php get_header( edubase_wpo_theme_options('headerlayout') ); ?>

  

<?php do_action( 'edubase_wpo_layout_breadcrumbs_render' ); ?>   

  

<?php do_action( 'edubase_wpo_layout_template_before' ) ; ?>

    <section id="team" class="space">
        <div class="container">
            <div class="row">
                <!--speckers-->
                <div class="col-md-12 col-sm-12 no-padding blog-base">
                <?php 
            	  $temp = $wp_query; 
				  $wp_query = null; 
				  $wp_query = new WP_Query(); 
				  $wp_query->query('showposts=6&post_type=speckers'.'&paged='.$paged); 
				    if ($wp_query->have_posts()) : 
				        while ($wp_query->have_posts()) : $wp_query->the_post();
				    	$speckers_designation = get_post_meta( $post->ID, "_speckers_designation", true );
						$speckers_company = get_post_meta( $post->ID, "_speckers_company", true );
						$qualifications = get_post_meta( get_the_ID(), '_speckers_qualifications', true );
						$socials = get_post_meta( get_the_ID(), '_speckers_social', true );
						// print_r($socials);die;
						?>
				    		<div class="col-sm-3 team-block text-center">
			                    <div class="team-inner">
			                        <div class="team-image">
			                            <?php the_post_thumbnail(); ?>
			                            <div class="hover-team center">
			                            	<div class="inner">
			                            		<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> </h3>
			                            	<div class="profession"><?php echo $speckers_designation; ?></div>
			                            	<!--<div class="profession"><i class="icofont icofont-building-alt"></i><?php echo $speckers_company; ?></div>-->
			                                <ul class="social">
				                            	<?php if (!empty($socials)): ?>
					                        		<?php foreach ($socials as $key => $media): ?>
					                        			<li><a href="<?php echo $media['_speckers_media_link'];?>"><i class="<?php echo $media['_speckers_fa_class'];?>"></i> </a> </li>
					                        		<?php endforeach ?>
					                        	<?php endif ?>
				                            </ul>
			                            	</div>
			                            </div>
			                        </div>
			                    </div>
			                </div>
                    	<?php endwhile;
				    else:
				        echo "<h1>Not Found :( </h1>";
				        echo "No Team found. Please refine your search";
				    endif;
				?> 
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