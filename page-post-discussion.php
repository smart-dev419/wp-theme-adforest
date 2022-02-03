<?php
/* Template Name: Discussion Post New */
/**
 * The template for displaying Pages.
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 * @package Adforest
 */
if (!is_user_logged_in()) {
	if ( wp_redirect( get_site_url() ) ) {
		exit;
	}
}
?>
<?php get_header(); ?>
<div class="main-content-area clearfix bg-gray">
	<div class="container">
		<div id="sa_discussion_post">
			<h2>Poster une discussion</h2>
			<h2>Description</h2>
			<form id="new_discussion_form" class="form-horizontal" action="" method="post" enctype="multipart/form-data" data-nonce="<?php echo esc_attr(wp_create_nonce("sa_post_discussion")); ?>">
				<div class="sa-form-control">
					<label>TITRE</label>
					<input class="sa-form-input" type="text" name="sa_title" placeholder="Donnez un titre court et descriptif à votre discussion…" required/>
					<small>aux minimaux 140 caractères restants</small>
				</div>
				<div class="sa-form-control">
					<label>DESCRIPTION</label>
					<?php 
					/*$post_id   = 51;
					$post      = get_post( $post_id, OBJECT, 'edit' );
					$content   = $post->post_content;
					$editor_id = 'editpost';*/
					$content   = '';
					$editor_id = 'sa_description';
					$options = array(
						'media_buttons' => false,// temporary
						'textarea_rows' => 8, 
						'tinymce' => true
					);
					wp_editor( $content, $editor_id, $options );
					?>
				</div>
				<div class="sa-form-control">
					<label>
						GROUPES
						<small>Quel est le sujet de votre discussion ?</small>
					</label>
					<input class="sa-form-input sa-select-input sa-form-input-group" type="text" name="sa_group" required/>
					<?php 
					$groups = get_terms( 
						array(
							'taxonomy' => 'discussion_groups',
							'orderby' => 'name',
							'order'   => 'ASC',
							'hide_empty' => 0,
						) 
					);
					if ($groups) {
						echo "<ul class='sa-select-buttons' data-input='sa-form-input-group'>";
						foreach ($groups as $group ) {
							echo "<button class='btn sa-select-btn' data-attr='{$group->term_id}'><i class='fa fa-plus'></i>&nbsp;{$group->name}</button>";
						}
					}
					?>
				</div>
				<div class="sa-form-control">
					<label><small>Votre discussion se rapporte-t-elle à une de nos catégories de deals ?</small></label>
					<input class="sa-form-input sa-select-input sa-form-input-category" type="text" name="category" required/>
					<?php 
					$tags = get_terms( 
						array(
							'taxonomy' => 'discussion_categories',
							'orderby' => 'name',
							'order'   => 'ASC',
							'hide_empty' => 0,
						) 
					);
					if ($groups) {
						echo "<ul class='sa-select-buttons' data-input='sa-form-input-category'>";
						foreach ($tags as $tag ) {
							echo "<button class='btn sa-select-btn' data-attr='{$tag->term_id}'><i class='fa fa-plus'></i>&nbsp;{$tag->name}</button>";
						}
					}
					?>
				</div>
				<button class="btn btn-light" type="submit" name="submit">Valider</button>
			</form>
		</div>
	</div>
</div>
<script>

	/* Custom Js */
	jQuery(function ($) {
		$('.sa-select-buttons > button').on('click', function(e) {
			e.preventDefault();
			let id = $(this).data('attr');
			let input_target = '.' + $(this).parent().data('input');

			if ( $(this).hasClass('btn-active') ) {
				$(input_target).val('');
				$(this).removeClass('btn-active');
				$(this).parent().removeClass('sa-selected');
			} else {
				$(input_target).val(id);
				$(this).addClass('btn-active');
				$(this).parent().addClass('sa-selected');
			}
			$(this).find('i').toggleClass('fa-check fa-plus');
		});

		$('form#new_discussion_form').on('submit', function(e){
			e.preventDefault();
			var title = $('input[name=sa_title]').val();
			var description = $('textarea[name=sa_description]').val();
			var groups = $('input[name=sa_group]').val();
			var category = $('input[name=sa_category]').val();
			var nonce = $(this).data('nonce');
			$.ajax({
				type : "post",
				dataType : "json",
				url : myAjax.ajaxurl,
				data : {
					action: 'sa_post_discussion',
					title: title,
					description: description,
					groups: groups,
					category: category,
					nonce: nonce,
				},
				beforeSend: function () {
					console.log('before')
					$('.main-content-area').addClass('sa-loading');
				},
				success: function(resp) {
					console.log(resp)
					let success = '<div class="posted"><h4>your post have been successfully posted :)</h4><a href="'+resp.url+'">'+resp.title+'</a></div>';
					let error = '<div class="posted"><h4>error, please contact admin to fix this problem :(</h4></div>';
					if ( resp ) {
						$('.main-content-area .container').html(success);
					} else {
						$('.main-content-area .container').html(error);
					}
					$('.main-content-area').removeClass('sa-loading');

				}, 
				error: function(xhr) {
					console.log(xhr);
				}
			});
			//$('form#new_discussion_form')[0].reset();
		});
	});

</script>

<style>
	.main-content-area.sa-loading .container > * {
		visibility: hidden;
		display: none;
	}

	.main-content-area.sa-loading .container::before {content: '';display: block;width: 5rem;height: 5rem;background: url(https://c.tenor.com/I6kN-6X7nhAAAAAj/loading-buffering.gif);background-size: contain;position: absolute;left: 50%;top: 50%;transform: translateX(-50%)translateY(-50%);}

	.main-content-area .container {
		position: relative;
		min-height: 60rem;
	}

	.main-content-area .posted {
		padding: 3rem 4rem;
		background: #fff;
		text-align: center;
		margin: 0 auto;
		border-radius: 5px;
		max-width: 500px;
		font-size: 2rem;
		position: absolute;
		left: 50%;
		top: 50%;
		transform: translateX(-50%)translateY(-50%);
	}

	.main-content-area .posted h3 {
		font-weight: bold;
	}
</style>
<?php get_footer(); ?>