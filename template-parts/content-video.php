<?php
/**
 * Template part for displaying posts.
 *
 * @package Realistic
 */

?>
	<article id="post-<?php the_ID(); ?>" <?php post_class('post-box small-post-box mdl-card mdl-shadow--2dp mdl-grid mdl-cell mdl-cell--12-col'); ?>>  
		<div class="post-img mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--4-col-phone">
			<?php echo realistic_get_first_embed_video(  $post_id  ); ?>
		</div>
		<div class="post-data  mdl-cell mdl-cell--8-col-desktop mdl-cell--4-col-tablet mdl-cell--4-col-phone">
		
			<button id="post-actions<?php the_ID(); ?>" class="post-actions mdl-button mdl-js-button mdl-button--icon">
				<i class="material-icons">more_vert</i>
			</button>	
			<ul class="post-actions-menu mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" for="post-actions<?php the_ID(); ?>">
				<?php edit_post_link('Edit', '<li class="mdl-menu__item">', '</li>'); ?>
			</ul>
			<?php the_title( sprintf( '<h2 class="entry-title post-title mdl-card__title-text"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
			
			<?php realistic_archives_meta(); ?>
			<div class="entry-content post-excerpt">
				<?php /* translators: %s: Name of current post */ ?>
				<span class="mdl-typography--font-light mdl-typography--subhead">
					<?php archives_excerpt(); ?>
				</span>
			</div><!-- .entry-content -->
		</div><!-- .post-data -->
	</article><!-- #post-## -->