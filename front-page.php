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


$args2 = array(
    "category_name" => "conference",
    "posts_per_page"=> 10,
);

$query2 = new WP_Query( $args2 );
 


// The Query
$args = array(
    "category_name" => "nouvelle",
    "posts_per_page" => 3, //afficher les 3 derniere nouvelles "posts_per_page" => "3"
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
 //////////////////////////////////////////////// Nouvelles ////////////////////////
 echo '<h4> '.category_description( get_category_by_slug( 'conference' ) ). '<h4>'   ;
 /* The 2nd Query (without global var) */
 
// The 2nd Loop
while ( $query2->have_posts() ) {
    $query2->the_post();
   
    echo '<h4>' . get_the_title( $query2->post->ID ) . '</h4>';
    echo '<p>' . SUBSTR(get_the_excerpt(),0,300) . '</p>';
    echo '<p>' . get_the_date('j') . '</p>';
    echo '<p>' . get_the_date('m') . '</p>';
    echo '<p>' . get_the_date('y') . '</p>';
    the_post_thumbnail( 'thumbnail' );  
    
}
 
// Restore original Post Data
wp_reset_postdata();

echo '<h2> '.category_description( get_category_by_slug( 'nouvelle' ) ). '<h2>'   ;
 
// The Loop
while ( $query1->have_posts() ) {
    $query1->the_post();
    echo '<h4>' . get_the_title() . '</h4>';
    the_post_thumbnail( 'thumbnail' );  
}
 
wp_reset_postdata();
 

?>
        
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
