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
?>
<?php get_header( edubase_wpo_theme_options('headerlayout', '') );  ?>
     
<?php do_action( 'edubase_wpo_layout_breadcrumbs_render' ); ?>  

<?php do_action( 'edubase_wpo_layout_template_before' ) ; ?>
    
        <div class="post-area single-blog">
            <?php  while(have_posts()): the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            
            
            
            <header class="entry-header">
                        <?php if( edubase_wpo_theme_options('blog_show-title', true) ){ ?>   
                            <div class="entry-name">
                                <h1 class="entry-title"> <?php the_title(); ?> </h1>
                            </div>    
                        <?php } ?>
                            
                            <div class="entry-meta">
                                <?php edubase_wpo_posted_on(); ?>
                                <span class="meta-sep"> / </span>
                                <?php if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) : ?>
                                <span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'edubase' ), __( '1 Comment', 'edubase' ), __( '% Comments', 'edubase' ) ); ?></span>
                               
                                <?php endif; ?>

                                <?php edit_post_link( __( 'Edit', 'edubase' ), '<span class="edit-link">', '</span>' ); ?>
                            </div><!-- .entry-meta -->
                        </header>
                        
                <div class="entry-thumb">
                    <?php get_template_part( 'templates/content/content', get_post_format() ); ?> 
                </div>    

            
                    <div class="post-container">
                        <h1 class="entry-title"> <?php the_title(); ?> </h1>
                        <!-- .entry-header -->
                        

                        <div class="entry-content">
                            <?php
                                the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'edubase' ) );
                                wp_link_pages( array(
                                    'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'edubase' ) . '</span>',
                                    'after'       => '</div>',
                                    'link_before' => '<span>',
                                    'link_after'  => '</span>',
                                ) );
                            ?>
                        </div><!-- .entry-content -->
                        
                     </div>
    
                <?php the_tags( '<footer class="entry-meta"><span class="tag-links"><span>'.__('Tags:', 'edubase').' </span>', ', ', '</span></footer>' ); ?>
                <?php if( edubase_wpo_theme_options('show-share-post', true) ){ ?>
                
                <?php echo 'This post has been viewed'; ?> <?php echo_views(get_the_ID()); ?> <?php echo'times'; ?>
                    <!--<div class="post-share">
                        <div class="row">
                            <div class="col-sm-4">
                                <h6><?php //echo __( 'Share this Post!','edubase' ); ?></h6>
                            </div>
                            <div class="col-sm-8">
                                <?php //edubase_wpo_share_box(); ?>
                            </div>
                        </div>
                    </div>-->
                <?php } ?>
                    <hr>
                    <div class="author-about">
                        <?php get_template_part('templates/elements/author-bio'); ?>
                    </div>
                    <hr>
                <?php comments_template(); ?>
                <div> <?php if( edubase_wpo_theme_options('show-related-post', true) ){
                    $relate_count = edubase_wpo_theme_options('blog-items-show', 4);

                    edubase_wpo_related_post($relate_count, 'post', 'category');
                } ?>
                </div>
            </article>    
           <?php endwhile; ?>
        </div>
           
<?php do_action( 'edubase_wpo_layout_template_after' ) ; ?>

<?php get_footer(); ?>