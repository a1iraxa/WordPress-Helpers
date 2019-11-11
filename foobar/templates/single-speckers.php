<?php
/**
 * $Desc
 *
 * @version    $Id$
 * @package    wpbase
 * @author     WPOpal  Team <wpopal@gmail.com, support@wpopal.com>
 * @copyright  Copyright (C) 2015 wpopal.com. All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 *
 * @website  http://www.wpopal.com
 * @support  http://www.wpopal.com/support/forum.html
 */

global $edubase_wpopconfig;
$edubase_wpopconfig = $edubase_wpoengine->getPostConfig();
$speckers_designation = get_post_meta( $post->ID, "_speckers_designation", true );
$speckers_company = get_post_meta( $post->ID, "_speckers_company", true );
$qualifications = get_post_meta( get_the_ID(), '_speckers_qualifications', true );
$socials = get_post_meta( get_the_ID(), '_speckers_social', true );
?>
<?php get_header( edubase_wpo_theme_options('headerlayout', '') );  ?>
     
<?php do_action( 'edubase_wpo_layout_breadcrumbs_render' ); ?>  

<?php  while(have_posts()): the_post(); ?>
	<section id="team-detail" <?php post_class('space'); ?>>
        <div class="container">
            <div class="row">
                <div class="col-sm-4 team-image text-center">
                    <div class="team-inner">
                        <?php the_post_thumbnail('full'); ?>
                        <ul class="social">
                        	<?php if (!empty($socials)): ?>
                        		<?php foreach ($socials as $key => $media): ?>
                        			<li><a href="<?php echo $media['_speckers_media_link'];?>"><i class="fa <?php echo $media['_speckers_fa_class'];?>"></i> </a> </li>
                        		<?php endforeach ?>
                        	<?php endif ?>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-8 team-info">
                    <div class="info-inner col-sm-12 no-padding">
                        <div class="name entry-title"> <?php the_title(); ?></div>
                        <div class="profession"><?php echo $speckers_designation; ?></div>
                        <div class="profession"><?php echo $speckers_company; ?></div>
                        <?php the_content(); ?>

                        
                    </div>
                </div>
                 <div class="main-heading col-sm-12 text-center animate-in move-up">
            <h2>Speaker Qualifications</h2>
            <p>We Are Professionals</p>
          
        </div>
                <div id="qualification" class="col-sm-12 no-padding">
                        <?php
			                if (!empty($qualifications)){ 
			                  	foreach ($qualifications as $key => $qualification) { ?>
				                  	<div class="col-sm-12  text-center no-padding qa-block">
		                               <div class="inner col-sm-6 center">
		                               	 <h3><?php echo $qualification['_speckers_qualification_title'];?></h3>
		                               </div>
		                            </div>
			                  	<?php } ?> 
			                 <?php } ?> 
                        </div>
            </div>
        </div>
    </section>
    <!--speckers-->
<?php endwhile; ?>
<!-- Related speckers start-->
<section id="team" class="space-bottom">
    <div class="container">
        <div class="main-heading col-sm-12 text-center animate-in move-up">
            <h2>Related Speakers</h2>
            <p>We Are Professionals</p>
          
        </div>
        <div class="row">
        	<?php
        	// get the custom post type's taxonomy terms
			// $custom_taxterms = wp_get_object_terms( $post->ID, 'your_taxonomy', array('fields' => 'ids') );
			// arguments
			$args = array(
			'post_type' => 'speckers',
			'post_status' => 'publish',
			'posts_per_page' => 4, // you may edit this number
			'orderby' => 'rand',
			// 'tax_query' => array(
			//     array(
			//         'taxonomy' => 'your_taxonomy',
			//         'field' => 'id',
			//         'terms' => $custom_taxterms
			//     )
			// ),
			'post__not_in' => array ($post->ID),
			);
			$related_items = new WP_Query( $args );
			if ($related_items->have_posts()) :
				while ( $related_items->have_posts() ) : $related_items->the_post();
				$speckers_designation = get_post_meta( $post->ID, "_speckers_designation", true );
				$speckers_company = get_post_meta( $post->ID, "_speckers_company", true );
				$qualifications = get_post_meta( get_the_ID(), '_speckers_qualifications', true );
				$socials = get_post_meta( get_the_ID(), '_speckers_social', true );
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
				<?php
				endwhile;
			endif;
			// Reset Post Data
			wp_reset_postdata();
        	 ?>
        </div>
    </div>
</section>
<!-- Related speckers end-->

<?php get_footer(); ?>