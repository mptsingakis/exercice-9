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

get_header();

///////////////////////////////////////// Événements /////////////////////////////////////////////////////
echo '<h1 class="titreSections"> '.category_description( get_category_by_slug( 'evenements' ) ). '</h1>'   ;
         
echo '<div class="evenements">';
 
    while ( $query3->have_posts() ) {
        $query3->the_post();

        $mois = get_the_date('m');
        $column = ($mois % 3) + 1;
        $row = get_the_date('j');
        //var_dump($column, $row);
        echo'<div class="elm_Evenement" style="grid-area:'.$row.'/'.$column.'">';
            echo '<a href='.get_permalink().'>' . get_the_title( $query3->post->ID ) . ' :'; echo get_the_date(' j m y').  '</a>';   
        echo '</div>';
    }
    // Restore original Post Data
    wp_reset_postdata();

echo '</div>';

get_footer();
?>