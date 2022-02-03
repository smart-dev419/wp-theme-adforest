<?php
/* Template Name: Merchands List */ 
/**
* The template for displaying latest commented posts page.
*
* @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
*
* @package Adforest
*/
?>
<?php 

get_header(); 

global $adforest_theme; 


$merchands = get_terms( 
	array(
		'taxonomy' => 'merchands',
		'orderby' => 'name',
		'order'   => 'ASC',
		'hide_empty' => 0,
	) 
);

$merchands_alpha = array(
	'A-D' => array('A', 'B', 'C', 'D'),
	'E-G' => array('E', 'F', 'G'),
	'H-K' => array('H', 'I', 'J', 'K' ),
	'L-O' => array('L', 'M', 'N', 'O'),
	'P-S' => array('P', 'Q', 'R', 'S'),
	'T-W' => array('T', 'U', 'V', 'W'),
	'X-Z' => array('X', 'Y', 'Z'),
	'0-9' => array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9'),
);

$merchands_sorted = array();
foreach($merchands as $merchand) {
	$letter = $merchand->name[0];
	if ( !empty($merchands_sorted[$letter]) ) {
		$merchands_sorted[$letter][] = $merchand;
	} else {
		$merchands_sorted[$letter] = [$merchand];
	}
}

?>

<style>
	body {
		background: #e9eaed;
	}
	.sa-top_merchands {
	}

	.sa-top_merchands > header {
	}

	.sa-top_merchands > ul {
		display: flex;
		flex-wrap: wrap;
	}

	.sa-top_merchands > ul > li {
		flex: 0 0 25%;
	}

	.sa-top_merchands > ul > li > a {
		display: flex;
		align-items: center;
		padding: 1.5rem;
		border-bottom: 1px solid;
		border-right: 1px solid;
		border-color: #d1d5db;
	}

	.sa-top_merchands > ul > li > a > img {
		height: 42px;
		width: 42px;
		border: 1px solid #d1d5db;
		border-radius: 50%;
		display: flex;
		align-items: center;
		justify-content: center;
		padding: 0;
	}

	.sa-top_merchands > ul > li > a > div {
		padding: 0 1rem;
		display: flex;
		flex-direction: column;
	}

	.sa-top_merchands > ul > li > a > div > span {
		font-size: 1.3rem;
		color: #bfc3c8;
		line-height: 1.5;
	}

	.sa-top_merchands > ul > li > a > div > h5 {
		color: #000;
		font-weight: bold;
		margin: 0;
		line-height: 1.5;
		font-size: 1.4rem;
	}

	.sa-top_merchands > ul > li:nth-child(4n+4) > a {
		border-right: 0;
	}

	.sa-main_merchands {}

	div#merchands {}

	div#merchands .container > div {
		background: #fff;
		margin: 2rem 0;
		border-radius: 5px;
	}

	div#merchands .container > div > header {
		border-bottom: 1px solid #d1d5db;
		height: 5rem;
		line-height: 5rem;
		padding: 0 2rem;
		color: #8f949b;
		display: flex;
		align-items: center;
	}

	div#merchands .container > div > a {
		padding: 1rem;
		display: flex;
		font-weight: 900;
		font-size: 1.4rem;
	}

	.sa-main_merchands {}

	.sa-main_merchands > ul {
		display: flex;
		flex-wrap: wrap;
	}

	.sa-main_merchands > ul > li {
		flex: 0 0 25%;
	}

	.sa-main_merchands > ul > li > a {
		display: flex;
		align-items: center;
		padding: 1.5rem;
	}

	.sa-main_merchands > ul > li > a > img {
		height: 42px;
		width: 42px;
		border: 1px solid #d1d5db;
		border-radius: 50%;
		display: flex;
		align-items: center;
		justify-content: center;
		padding: 0;
	}

	.sa-main_merchands > ul > li > a > h5 {
		color: #000;
		font-weight: bold;
		margin: 0;
		line-height: 1.5;
		font-size: 1.4rem;
		padding: 0 1rem;
	}
</style>

<div class="sa-after-header">
	<section class="sa-header-filters">
		<div class="row">
			<div class="container">
				<div id="filters">
					<li><a class="active" href="/shops">Tout</a></li>
					<li><a href="/shops?letters=A-D">A-D</a></li>
					<li><a href="/shops?letters=E-G">E-G</a></li>
					<li><a href="/shops?letters=H-K">H-K</a></li>
					<li><a href="/shops?letters=L-O">L-O</a></li>
					<li><a href="/shops?letters=P-S">P-S</a></li>
					<li><a href="/shops?letters=T-W">T-W</a></li>
					<li><a href="/shops?letters=X-Y">X-Z</a></li>
					<li><a href="/shops?letters=0-9">0-9</a></li>
				</div>
			</div>
		</div>
	</section>
</div>

<div id="merchands">
	<div class="container">
		<div class="sa-top_merchands">
			<header>Top marchands</header>
			<?php 
			$merchands = get_terms( 
				array(
					'taxonomy' => 'merchands',
					'orderby' => 'count',
					'order'   => 'DESC',
					'hide_empty' => 0,
					'number' => 8
				) 
			);
			echo "<ul class='sa-top_merchands_list'>";
			foreach ($merchands as $merchand) {
				$thumb_id = get_term_meta ( $merchand->term_id, 'merchand-image-id', true );
				if (!empty($thumb_id)) {
					echo "<li class='item'>";
					echo "<a href='".esc_url( get_category_link( $merchand->term_id ) )."'>";
					echo wp_get_attachment_image ( $thumb_id, array(150, 150), array('alt' => $merchand->name) );
					echo "<div><h5>".$merchand->name."</h5><span><i class='fa fa-fire'></i> ".$merchand->count." codes promo hot</span></div>";
					echo "</a>";
					echo "</li>";
				}
			}
			echo "</ul>";
			?>
		</div><!-- -->
		<div class="sa-main_merchands">
			<?php

			if (isset($_GET['letters']) ) {

				if ( $merchands_alpha[$_GET['letters']] ) {
					foreach ($merchands_sorted as $section_letter => $merchands) {
						if ( in_array($section_letter, $merchands_alpha[$_GET['letters']])) {
							echo "<header><h3><b>$section_letter</b></h3></header>";
							echo "<ul>";
							foreach ( $merchands as $merchand ) {
								$thumb_id = get_term_meta ( $merchand->term_id, 'merchand-image-id', true );
								if (!empty($thumb_id)) {
									echo "<li class='item'>";
									echo "<a href='".esc_url( get_category_link( $merchand->term_id ) )."'>";
									echo wp_get_attachment_image ( $thumb_id, array(150, 150), array('alt' => $merchand->name) );
									echo "<h5>".$merchand->name."</h5>";
									echo "</a>";
									echo "</li>";
								}
							}
							echo "</ul>";
						}
					}
				} else {
 					echo "no shops found!";
				}

			} else {
				foreach ($merchands_alpha as $section_letter => $letters) {
					
					$content = "<header><h3><b>$section_letter</b></h3></header>";
					$content .= "<ul>";
					foreach ( $letters as $letter ) {
						if ($merchands_sorted[$letter]) {
							foreach ( $merchands_sorted[$letter] as $merchand ) {
								$thumb_id = get_term_meta ( $merchand->term_id, 'merchand-image-id', true );
								if (!empty($thumb_id)) {
									$content .= "<li class='item'>";
									$content .= "<a href='".esc_url( get_category_link( $merchand->term_id ) )."'>";
									$content .= wp_get_attachment_image ( $thumb_id, array(150, 150), array('alt' => $merchand->name) );
									$content .= "<h5>".$merchand->name."</h5>";
									$content .= "</a>";
									$content .= "</li>";
								}
							}
						}
					}
					$content .= "</ul>";
					$content .= "<a href=''>Voir tout $section_letter</a>";
					//if ($empty) echo "EMPTY";
					echo $content;
				}
			}
			?>
		</div>
	</div>
</div>

<?php get_footer(); ?>