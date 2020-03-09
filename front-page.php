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


// The Query
$args = array(
    "category_name" => "atelier",
    "posts_per_page" => 16 ,
   //"orderby" =>"post_author","post_name",
    //"order" => "column "
    'orderby' => array(
        'post_author' => 'ASC',
        'heure',
        ),
);

$query1 = new WP_Query( $args );
 

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
        echo '<h1 class="titreSections"> '.category_description( get_category_by_slug( 'atelier' ) ). '<h1>'   ;
        echo '<div class="atelierAlign">';
            // The Loop
            while ( $query1->have_posts() ) {
                echo '<div class="atelierItems">';
                    $query1->the_post();
                    $heure= substr(get_post_field("post_name"),-2);
                    echo '<p class="center">' . get_the_title() .'</p>';
                    echo' <p>'. get_post_field('post_name').'</p>';
                    echo' <p>'.get_the_author_meta( 'display_name', $post->post_author ).'</p>';
                  
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
