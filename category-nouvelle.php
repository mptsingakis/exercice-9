<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package underscores
 */



get_header();
?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

        endwhile; // End of the loop.

      
        ///////////////////////////////////////// Nouvelles /////////////////////////////////////////////////////
        echo '<h1 class="titreSections"> '.category_description( get_category_by_slug( 'nouvelle' ) ). '<h1>'   ;
        echo '<div class="conference">';
            // The Loop
            while (have_posts() ) {
                
                the_post();
               // $heure= substr(get_post_field("post_name"),-2);
                
                echo '<div class="conferenceItems">';
    
                    the_post_thumbnail( 'thumbnail' ); 
                    echo '<div class="conferenceText">';
                        
                        echo '<p>' . get_the_title() .'</p>';
                        echo '<p>' . SUBSTR(get_the_excerpt(),0,200) . '</p>';
                        echo  '<input type="button"  class="btnNouvelle" id="'.get_the_ID().'"value="Lire la suite..."></input>';
                        echo  '<div data-id="'.get_the_ID().'" > </div>';//Pour détecter l'état visible
                    echo '</div>';
                echo '</div>';
            }
            wp_reset_postdata();
        echo '</div>';
        
         
?>
        
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();