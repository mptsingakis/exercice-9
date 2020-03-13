<?php
/**
 * The template for displaying archive pages
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

	$args = array(
		"category_name" => "evenement",
		"posts_per_page" =>-1, //afficher les 3 derniere nouvelles "posts_per_page" => "3"
		"orderby" =>"date",
		"order" => "DSC"
	);
	$query1 = new WP_Query( $args );

    echo '<h1 class="titreSections"> '.category_description( get_category_by_slug( 'evenements' ) ). '</h1>'   ;
         
    echo '<div class="evenementsGrid">';

	if ( have_posts() ) : ?>

		<header class="page-header">
			<?php
			//	the_archive_title( '<h1 class="page-title">', '</h1>' );
			//	the_archive_description( '<div class="archive-description">', '</div>' );
			?>
			</header><!-- .page-header -->

			<?php
			/* Start the Loop */

                while ($query1->have_posts()) :
                    $query1->the_post();
					$mois = get_the_date('m');
					$moisActuel = date('m');
					//echo date('m');
					if($mois <= $moisActuel) {
						//echo '<div>'.get_the_title( get_post() ).'  /  '.$mois.'</div>';
						$column = ($mois % 3) + 1;
                    	$row = get_the_date('j');
                    	//var_dump($column, $row);
						echo'<div class="elm_Evenement" style="grid-area:'.$row.'/'.$column.'">';
						echo'<p>'.get_the_title( get_post() ).'</p>';
						echo '<a href='.get_permalink().'>Voir l\'évènement</a>';
						echo '<p>'.get_the_date(' j / m / y').'</p>';   
						
                    	echo '</div>';
					}
                    
                   endwhile;

	endif;
		?>
        </div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
?>

