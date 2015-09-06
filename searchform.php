<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
    <div class="search-form mdl-textfield mdl-js-textfield">
    <span class="screen-reader-text"><?php esc_attr_e( 'Search for', 'realistic' ); ?></span>
    <input type="search" class="search-field mdl-textfield__input" placeholder="<?php esc_attr_e( 'Search &#8230;', 'realistic' ); ?>" value="" name="s" title="<?php esc_attr_e( 'Search for:', 'realistic' ); ?>">
	<button type="submit" class="search-submit mdl-button mdl-js-button mdl-button--icon">
		<i class="material-icons">search</i>
	</button>	
 </div>
</form>