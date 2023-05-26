<?php


// Creating the widget
class OpenLigaDB_Widget extends WP_Widget {
 
  function __construct() {
    parent::__construct(
    
    // Base ID of your widget
    'openligadb_widget',
    
    // Widget name will appear in UI
    __('OpenLigaDB', 'openligadb'), 
    
      // Widget description
      array( 'description' => __( 'Show standings in your sidebar', 'openligadb' ), )
    );
  }
   
  // Creating widget front-end
   
  public function widget( $args, $instance ) {
    $title = apply_filters( 'widget_title', $instance['title'] );

    $template = 'standings';
    $league = isset($instance['league']) ? $instance['league'] : 'bl1';
    $season = isset($instance['season']) ? $instance['season'] : '';

    $shortcode = sprintf('[openligadb league="%s" season="%s" compact="true"]', $league, $season);
    $output = do_shortcode($shortcode);

    // before and after widget arguments are defined by themes
    echo $args['before_widget'];
  
    if ( ! empty( $title ) ) {
      echo
        $args['before_title']
        . $title
        . $args['after_title'];
    }

    echo $output;
  
    echo $args['after_widget'];
  }
   
  // Widget Backend
  public function form( $instance ) {
    $title = isset($instance['title']) ? $instance['title'] : '';
    $league = isset($instance['league']) ? $instance['league'] : 'bl1';
    $season = isset($instance['season']) ? $instance['season'] : '';
    // Widget admin form
    ?>
<p>
  <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title' ); ?>:</label>
  <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
</p>
<p>
  <label for="<?php echo $this->get_field_id( 'league' ); ?>"><?php _e( 'League' ); ?>:</label>
  <input class="widefat" id="<?php echo $this->get_field_id( 'league' ); ?>" name="<?php echo $this->get_field_name( 'league' ); ?>" type="text" value="<?php echo esc_attr( $league ); ?>" />
</p>
<p>
  <label for="<?= $this->get_field_id( 'season' ); ?>"><?php _e( 'Season' ); ?>:</label>
  <input class="widefat" id="<?= $this->get_field_id( 'season' ); ?>" name="<?= $this->get_field_name( 'season' ); ?>" type="text" value="<?= esc_attr( $season ) ?>"/>
</p>
    <?php
    }
   
  // Updating widget replacing old instances with new
  public function update( $new_instance, $old_instance ) {
    $instance = array();
    $instance['title'] = (!empty($new_instance['title'])) ? strip_tags( $new_instance['title'] ) : '';
    $instance['league'] = (!empty($new_instance['league'])) ? strip_tags( $new_instance['league'] ) : '';
    $instance['season'] = (empty($new_instance['season']) || is_numeric($new_instance['season'])) ? strip_tags( $new_instance['season'] ) : '';
    return $instance;
  }
} 

// Register and load the widget
add_action( 'widgets_init', function() {
  register_widget( 'OpenLigaDB_Widget' );
});