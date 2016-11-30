<?php
/*
Plugin Name: Cobra FM Player
Plugin URI: http://cobrasoftwares.in/
Description: Simple radio player with playlist option
Author: Adi
Version: 1
Author URI: http://github.com/skadimoolam
*/


class CobraFmPlayerWidget extends WP_Widget {
  function CobraFmPlayerWidget() {
    $widget_ops = array('classname' => 'CobraFmPlayerWidget', 'description' => 'Simple radio player with playlist option' );
    $this->WP_Widget('CobraFmPlayerWidget', 'Cobra FM Player', $widget_ops);
  }
 
  function form($instance) {
    $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
    $title = $instance['title'];
    $channel_one_url = $instance['channel_one_url'];
    $channel_one_name = $instance['channel_one_name'];
    $channel_two_url = $instance['channel_two_url'];
    $channel_two_name = $instance['channel_two_name'];
    $channel_three_url = $instance['channel_three_url'];
    $channel_three_name = $instance['channel_three_name'];
    $channel_four_url = $instance['channel_four_url'];
    $channel_four_name = $instance['channel_four_name'];
?>
  <p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
  
  <p><label for="<?php echo $this->get_field_id('channel_one_name'); ?>">Channel Name: <input class="widefat" id="<?php echo $this->get_field_id('channel_one_name'); ?>" name="<?php echo $this->get_field_name('channel_one_name'); ?>" type="text" value="<?php echo attribute_escape($channel_one_name); ?>" /></label></p>
  <p><label for="<?php echo $this->get_field_id('channel_one_url'); ?>">Channel Url: <input class="widefat" id="<?php echo $this->get_field_id('channel_one_url'); ?>" name="<?php echo $this->get_field_name('channel_one_url'); ?>" type="text" value="<?php echo attribute_escape($channel_one_url); ?>" /></label></p>
  
  <p><label for="<?php echo $this->get_field_id('channel_two_name'); ?>">Channel Name: <input class="widefat" id="<?php echo $this->get_field_id('channel_two_name'); ?>" name="<?php echo $this->get_field_name('channel_two_name'); ?>" type="text" value="<?php echo attribute_escape($channel_two_name); ?>" /></label></p>
  <p><label for="<?php echo $this->get_field_id('channel_two_url'); ?>">Channel Url: <input class="widefat" id="<?php echo $this->get_field_id('channel_two_url'); ?>" name="<?php echo $this->get_field_name('channel_two_url'); ?>" type="text" value="<?php echo attribute_escape($channel_two_url); ?>" /></label></p>
  
  <p><label for="<?php echo $this->get_field_id('channel_three_name'); ?>">Channel Name: <input class="widefat" id="<?php echo $this->get_field_id('channel_three_name'); ?>" name="<?php echo $this->get_field_name('channel_three_name'); ?>" type="text" value="<?php echo attribute_escape($channel_three_name); ?>" /></label></p>
  <p><label for="<?php echo $this->get_field_id('channel_three_url'); ?>">Channel Url: <input class="widefat" id="<?php echo $this->get_field_id('channel_three_url'); ?>" name="<?php echo $this->get_field_name('channel_three_url'); ?>" type="text" value="<?php echo attribute_escape($channel_three_url); ?>" /></label></p>

  <p><label for="<?php echo $this->get_field_id('channel_four_name'); ?>">Channel Name: <input class="widefat" id="<?php echo $this->get_field_id('channel_four_name'); ?>" name="<?php echo $this->get_field_name('channel_four_name'); ?>" type="text" value="<?php echo attribute_escape($channel_four_name); ?>" /></label></p>
  <p><label for="<?php echo $this->get_field_id('channel_four_url'); ?>">Channel Url: <input class="widefat" id="<?php echo $this->get_field_id('channel_four_url'); ?>" name="<?php echo $this->get_field_name('channel_four_url'); ?>" type="text" value="<?php echo attribute_escape($channel_four_url); ?>" /></label></p>
<?php
  }
 
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];
    $instance['channel_one_url'] = $new_instance['channel_one_url'];
    $instance['channel_two_url'] = $new_instance['channel_two_url'];
    $instance['channel_three_url'] = $new_instance['channel_three_url'];
    $instance['channel_one_name'] = $new_instance['channel_one_name'];
    $instance['channel_two_name'] = $new_instance['channel_two_name'];
    $instance['channel_three_name'] = $new_instance['channel_three_name'];
    return $instance;
  }
 
  function widget($args, $instance)
  {
    extract($args, EXTR_SKIP);
 
    echo $before_widget;
    $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
 
    if (!empty($title))
      echo $before_title . $title . $after_title;;
 
    // WIDGET CODE GOES HERE
?>
<audio controls="true" id="audioPlayer" style="width: 100%;"></audio>
<p>Select a station from the list below</p>
<ul id="playlist">
  <?php if($instance['channel_one_url'] && $instance['channel_one_name']) { ?> <li><button onclick="changeChannel('<?php echo $instance['channel_one_url']; ?>')" class="fm fm1"><?php echo $instance['channel_one_name']; ?></button></li> <?php } ?>
  <?php if($instance['channel_two_url'] && $instance['channel_two_name']) { ?> <li><button onclick="changeChannel('<?php echo $instance['channel_two_url']; ?>')" class="fm fm1"><?php echo $instance['channel_two_name']; ?></button></li> <?php } ?>
  <?php if($instance['channel_three_url'] && $instance['channel_three_name']) { ?> <li><button onclick="changeChannel('<?php echo $instance['channel_three_url']; ?>')" class="fm fm1"><?php echo $instance['channel_three_name']; ?></button></li> <?php } ?>
  <?php if($instance['channel_four_url'] && $instance['channel_four_name']) { ?> <li><button onclick="changeChannel('<?php echo $instance['channel_four_url']; ?>')" class="fm fm1"><?php echo $instance['channel_four_name']; ?></button></li> <?php } ?>
</ul>

<script> 
var player = document.getElementById('audioPlayer'); 
player.pause();

function changeChannel(url) { 
  player.src = url; 
  player.play(); 
}; 
</script> 
<?php 
 
    echo $after_widget;
  }
 
}
add_action( 'widgets_init', create_function('', 'return register_widget("CobraFmPlayerWidget");') );?>