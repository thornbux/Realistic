<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Realistic
 */

?>

	</div>
	<footer id="colophon" class="site-footer mdl-mega-footer" role="contentinfo">
		<div class="site-info mdl-mega-footer--bottom-section">
			<?php realistic_copyrights(); ?>
		</div><!-- .site-info -->	
	</footer><!-- #colophon -->
</div><!-- .mdl-layout -->
<script type="text/javascript">
jQuery(document).ready(function() {
	//move-to-top arrow
	jQuery("body").prepend("<div id='move-to-top' class='animate mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--accent'><i class='material-icons'>expand_less</i></div>");
	var scrollDes = 'html,body';
	if(navigator.userAgent.match(/opera/i)){
		scrollDes = 'html';
	}
	//show ,hide
	jQuery(window).scroll(function () {
		if (jQuery(this).scrollTop() > 300) {
			jQuery('#move-to-top').addClass('filling').removeClass('hiding');
		} else {
			jQuery('#move-to-top').removeClass('filling').addClass('hiding');
		}
	});
	// scroll to top when click 
	jQuery('#move-to-top').click(function () {
		jQuery(scrollDes).animate({ 
			scrollTop: 0
		},{
			duration :500
		});
	});
});
</script>
<?php wp_footer(); ?>
</body>
</html>
