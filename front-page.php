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

$args3 = array(
    "category_name" => "evenements",
    "posts_per_page"=> -1,
);

$query3 = new WP_Query( $args3 );

$args2 = array(
    "category_name" => "conference",
    "posts_per_page"=> 5,
);

$query2 = new WP_Query( $args2 );
 


// The Query
$args = array(
    "category_name" => "nouvelle",
    "posts_per_page" => 4 //afficher les 3 derniere nouvelles "posts_per_page" => "3"
   // "orderby" =>"date",
   // "order" => "ASC"
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

        ///////////////////////////////////////// Conférence /////////////////////////////////////////////////////
        echo '<h2 class="titreSections"> '.category_description( get_category_by_slug( 'conference' ) ). '<h2>'   ;
      
            // The 2nd Loop
            while ( $query2->have_posts() ) {
                $query2->the_post();
                echo '<div class="conference">';
                    
                    the_post_thumbnail( 'thumbnail' ); 
                        echo '<div class="conferenceTexte">'; 
                            echo '<a href='.get_permalink().'>' . get_the_title( $query2->post->ID ) . ' :'; echo get_the_date(' j m y').  '</a>';
                            echo '<p>' . SUBSTR(get_the_excerpt(),0,300) . '</p>';
                        echo '</div>';   
                echo '</div>';
            }
        // Restore original Post Data
        wp_reset_postdata();
      
        ///////////////////////////////////////// Nouvelles /////////////////////////////////////////////////////
        echo '<h1 class="titreSections"> '.category_description( get_category_by_slug( 'nouvelle' ) ). '<h1>'   ;
        echo '<div class="nouvelleAlign">';
            // The Loop
            while ( $query1->have_posts() ) {
                echo '<div class="nouvelleItems">';
                    $query1->the_post();
                    echo '<a href='. get_permalink().'>' . get_the_title() . '</a>';
                    the_post_thumbnail( 'thumbnail' );
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
