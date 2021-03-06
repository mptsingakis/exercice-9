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
 //////////////////////////////////////////////// Nouvelles ////////////////////////

// The Query

$args = array(
    "category_name" => "nouvelle",
    "posts_per_page" =>3, //afficher les 3 derniere nouvelles "posts_per_page" => "3"
   "orderby" =>"date",
   "order" => "DSC"
);
$query1 = new WP_Query( $args );



echo '<div class="sectionNouvelles"><h2 class="titreSection"> '.category_description( get_category_by_slug( 'nouvelle' ) ). '</h2>'   ;
echo '<div class="nouvelles">';
// The Loop
while ( $query1->have_posts() ) {
    $query1->the_post();
    echo '<div class="nouvelleText">';
        echo '<h3 class="titleSection">' . get_the_title() . '</h3>';
        echo '<p class="resumeNouvelle">' . SUBSTR(get_the_excerpt(),0,300) . '</p>';
    echo '</div>';
}
echo '</div></div>';
 
wp_reset_postdata();
 
 
// The 2nd Query (without global var) 

$args2 = array(
    "category_name" => "evenement",
    "posts_per_page"=> 3,
    "orderby" =>"date",
    "order" => "DSC"

);
$query2 = new WP_Query( $args2 );
echo '<div class="sectionEvenements"><h2 class="titreSection"> '.category_description( get_category_by_slug( 'evenement' ) ). '</h2>'   ;
echo '<div class="evenements"> ';
    // The 2nd Loop
    while ( $query2->have_posts() ) {
        $query2->the_post();

        echo '<div class="evenementItems">';
            the_post_thumbnail( 'thumbnail' );  
            echo '<div class="evenementText">';
                 echo '<h3 class="titleSection">' . get_the_title( $query2->post->ID ) . '</h3>';
                echo '<p class="resumeEvt">' . SUBSTR(get_the_excerpt(),0,300) . '</p>';

                echo  '<input type="button"  class="btnNouvelle" id="'.get_the_ID().'"value="Lire la suite..."></input>';
                echo  '<div data-id="'.get_the_ID().'" > </div>';//Pour détecter l'état visible

            echo '</div>';
        echo '</div>';
    }
echo '</div></div>';
// Restore original Post Data
wp_reset_postdata();

?>
        
        

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();

?>