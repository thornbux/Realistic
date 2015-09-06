<?php
/*-----------------------------------------------------------------------------------

	Plugin Name: Realistic Popular Posts
	Description: A widget that displays popular posts.
	Version: 1.0

-----------------------------------------------------------------------------------*/

class realistic_popular_posts_widget extends WP_Widget {

	public function __construct() {
		parent::__construct(
	 		'realistic_popular_posts_widget',
			__('Realistic: Popular Posts','realistic'),
			array( 'description' => __( 'Displays most Popular Posts with Thumbnail.','realistic' ) )
		);
	}

 	public function form( $instance ) {
		$defaults = array(
			'category' => 1,
			'date' => 1,
			'days' => 30,
			'show_thumb' => 1,
			'show_excerpt' => 0,
			'excerpt_length' => 10,
		);
		$instance = wp_parse_args((array) $instance, $defaults);
		$title = isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : __( 'Popular Posts','realistic' );
		$qty = isset( $instance[ 'qty' ] ) ? intval( $instance[ 'qty' ] ) : 5;
		$category = isset( $instance[ 'category' ] ) ? intval( $instance[ 'category' ] ) : 1;
		$date = isset( $instance[ 'date' ] ) ? intval( $instance[ 'date' ] ) : 1;
		$days = isset( $instance[ 'days' ] ) ? intval( $instance[ 'days' ] ) : 0;
		$show_thumb = isset( $instance[ 'show_thumb' ] ) ? intval( $instance[ 'show_thumb' ] ) : 1;
		$show_excerpt = isset( $instance[ 'show_excerpt' ] ) ? esc_attr( $instance[ 'show_excerpt' ] ) : 1;
		$excerpt_length = isset( $instance[ 'excerpt_length' ] ) ? intval( $instance[ 'excerpt_length' ] ) : 10;
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:','realistic' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		
		<p>
	       <label for="<?php echo $this->get_field_id( 'days' ); ?>"><?php _e( 'Popular limit (days), 0 for No-limit', 'realistic' ); ?>
	       <input id="<?php echo $this->get_field_id( 'days' ); ?>" name="<?php echo $this->get_field_name( 'days' ); ?>" type="number" min="1" step="1" value="<?php echo $days; ?>" />
	       </label>
       </p>
	   
		<p>
			<label for="<?php echo $this->get_field_id( 'qty' ); ?>"><?php _e( 'Number of Posts to show','realistic' ); ?></label> 
			<input id="<?php echo $this->get_field_id( 'qty' ); ?>" name="<?php echo $this->get_field_name( 'qty' ); ?>" type="number" min="1" step="1" value="<?php echo $qty; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id("show_thumb"); ?>">
				<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("show_thumb"); ?>" name="<?php echo $this->get_field_name("show_thumb"); ?>" value="1" <?php if (isset($instance['show_thumb'])) { checked( 1, $instance['show_thumb'], true ); } ?> />
				<?php _e( 'Show Thumbnails', 'realistic'); ?>
			</label>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id("date"); ?>">
				<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("date"); ?>" name="<?php echo $this->get_field_name("date"); ?>" value="1" <?php if (isset($instance['date'])) { checked( 1, $instance['date'], true ); } ?> />
				<?php _e( 'Show post date', 'realistic'); ?>
			</label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id("category"); ?>">
				<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("category"); ?>" name="<?php echo $this->get_field_name("category"); ?>" value="1" <?php checked( 1, $instance['category'], true ); ?> />
				<?php _e( 'Show Category', 'realistic'); ?>
			</label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id("show_excerpt"); ?>">
				<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("show_excerpt"); ?>" name="<?php echo $this->get_field_name("show_excerpt"); ?>" value="1" <?php checked( 1, $instance['show_excerpt'], true ); ?> />
				<?php _e( 'Show excerpt', 'realistic'); ?>
			</label>
		</p>
		
		<p>
	       <label for="<?php echo $this->get_field_id( 'excerpt_length' ); ?>"><?php _e( 'Excerpt Length:', 'realistic' ); ?>
	       <input id="<?php echo $this->get_field_id( 'excerpt_length' ); ?>" name="<?php echo $this->get_field_name( 'excerpt_length' ); ?>" type="number" min="1" step="1" value="<?php echo $excerpt_length; ?>" />
	       </label>
       </p>
		<?php 
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['qty'] = intval( $new_instance['qty'] );
		$instance['category'] = intval( $new_instance['category'] );
		$instance['date'] = intval( $new_instance['date'] );
		$instance['days'] = intval( $new_instance['days'] );
		$instance['show_thumb'] = intval( $new_instance['show_thumb'] );
		$instance['show_excerpt'] = intval( $new_instance['show_excerpt'] );
		$instance['excerpt_length'] = intval( $new_instance['excerpt_length'] );
		return $instance;
	}

	public function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		$category = $instance['category'];
		$date = $instance['date'];
		$days = $instance['days'];
		$qty = (int) $instance['qty'];
		$show_thumb = (int) $instance['show_thumb'];
		$show_excerpt = $instance['show_excerpt'];
		$excerpt_length = $instance['excerpt_length'];

		echo $before_widget;
		if ( ! empty( $title ) ) echo $before_title . $title . $after_title;
		echo self::get_popular_posts( $qty, $category, $date, $days, $show_thumb, $show_excerpt, $excerpt_length );
		echo $after_widget;
	}

	public function get_popular_posts( $qty, $category, $date, $days, $show_thumb, $show_excerpt, $excerpt_length ) {

		// Custom CSS Output
		if ( $show_thumb == 1 ) {
			$css = 'padding-left:80px;';
		} else {
			$css = 'padding-left:10px;';			
		}
		
		global $post;
 	        $popular_days = array();
		if ( $days ) {
			$popular_days = array(
        		//set date ranges
        		'after' => "$days day ago",
        		'before' => 'today',
        		//allow exact matches to be returned
        		'inclusive' => true,
        	);
		}
		
		$popular = get_posts( array( 
    	   	     'suppress_filters' => false, 
      		     'ignore_sticky_posts' => 1, 
      		     'orderby' => 'comment_count', 
       		     'numberposts' => $qty,
       		     'date_query' => $popular_days) );

		echo '<div class="widget-container recent-posts-wrap"><ul>';
		foreach($popular as $post) :
			setup_postdata($post);
		?>
			<?php echo '<li class="post-box horizontal-container" style="'. $css .'">'; ?>
				<?php if ( $show_thumb == 1 ) : ?>
				<div class="widget-post-img">
					<a rel="nofollow" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
						<img width="70" height="70" src="<?php echo realistic_get_thumbnail( 'tiny' ); ?>" class="attachment-featured wp-post-image" alt="<?php the_title_attribute(); ?>">				
						<?php $format = get_post_format( $post->ID );
						realistic_post_format_icon( $format ); ?>
					</a>
				</div>
				<?php endif; ?>
					<div class="widget-post-data">
						<h4><a rel="nofollow" href="<?php the_permalink()?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h4>
						<?php if ( $date == 1 || $category == 1 ) : ?>
							<div class="widget-post-info">
								<?php if ( $date == 1 ) :
									realistic_posted();
								endif; ?>
								<?php if ( $category == 1 ) :
									_e(' in ', 'realistic');
									$thecategory = get_the_category();
									echo '<span class="category"><a href="' . get_category_link( $thecategory[0]->term_id ) . '" title="' . sprintf( __( "View all posts in %s", "realistic" ), $thecategory[0]->name ) . '" ' . '>' . $thecategory[0]->name.'</a></span>';	
								endif; ?>
							</div> <!--end .post-info-->
						<?php endif; ?>
						<?php if ( $show_excerpt == 1 ) : ?>
							<div class="widget-post-excerpt">
								<?php echo realistic_excerpt( $excerpt_length ); ?>
							</div>
						<?php endif; ?>
					</div>
			<?php endforeach; 
		wp_reset_postdata();
		echo '</ul></div>'."\r\n";
	}

}
add_action( 'widgets_init', create_function( '', 'register_widget( "realistic_popular_posts_widget" );' ) );