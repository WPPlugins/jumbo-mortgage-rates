<?php
/*
Plugin Name: Jumbo Mortgage Rates Widget
Plugin URI: http://www.freerateupdate.com/mortgage-rate-widget
Description: This plugin installs a customizable <a href="http://www.freerateupdate.com/mortgage-rate-widget"> Jumbo Mortgage Rates Widget</a> that you can drag into your sidebar in the widget area of wordpress. The Jumbo mortgage rates widget is updated daily by FreeRateUpdate.com who researches wholesale mortgage lender's rate sheets and updates their <a href="http://www.freerateupdate.com/"> Jumbo mortgage rates</a>  multiple times per day.
Author: Freerateupdate.com
Version: 1.8
Author URI: http://www.freerateupdate.com/
*/

function jumbo_print_scripts() {
	wp_enqueue_script('jquery');
}

add_action('wp_print_scripts', 'jumbo_print_scripts');

class JumboWidget extends WP_Widget {
    function JumboWidget() {
        parent::WP_Widget(false, 'Jumbo Mortgage Rates');	
    }
    
    
    
    function widget($args, $instance) {
    	global $wp_query;
    	global $wpdb;

    	
        extract( $args );
        $title = apply_filters('widget_title', $instance['title']);
        $align = $instance['align'];
        ?>
              <?php echo $before_widget; ?>

                  <?php if ( $title )
                        echo $before_title . $title . $after_title; ?>
<div id="jumbo_container" style="margin-bottom: 10px;">

<span style="font-size: 11px;">FreeRateUpdate.com <a
href="http://www.freerateupdate.com/" style="text-decoration:
none;">Mortgage Rates</a></span><br>
<!-- saved from url=(0013)about:internet -->
<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000"
codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0"
width="250" height="147" id="fruwidget" align="middle">
<param name="allowScriptAccess" value="sameDomain" />
<param name="movie"
value="http://www.freerateupdate.com/widget/fruwidget-jumbo.swf"
/><param name="quality" value="high" /><param name="bgcolor"
value="#000000" /><embed
src="http://www.freerateupdate.com/widget/fruwidget-jumbo.swf"
quality="high" bgcolor="#000000" width="250" height="147"
name="fruwidget" align="middle" allowScriptAccess="sameDomain"
type="application/x-shockwave-flash"
pluginspage="http://www.macromedia.com/go/getflashplayer" />
</object>


<script type="text/javascript">
jQuery(function() {
	var align = "<?php echo $align; ?>";
	var $ = jQuery;
    
    
    var $widgetContainer = $("#jumbo_container");
    var $widgetLi = $widgetContainer.parent();
    var margin = ($widgetLi.width() - 250);
    
    var marginLeft = 0;
    var marginRight  = 0;
    if ("left" == align) {
    	marginLeft = "0px";
    	marginRight = margin + "px";
    }
    else if ("right" == align) {
    	marginLeft = margin + "px";
    	marginRight = "0px";
    }
    else if ("center" == align) {
    	marginLeft = parseInt((margin / 2)) + "px";
    	marginRight = marginLeft;
    }
    
   
    $widgetContainer.css({"marginLeft": marginLeft, "marginRight": marginRight});
    $widgetLi.css({"paddingLeft": "0px", "paddingRight": "0px"});
});

</script>      
              </div>    
              <?php echo $after_widget; ?>
        <?php

    }
    
    
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$new_instance = wp_parse_args( (array) $new_instance, array( 'title' => ''));
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['align'] = $new_instance['align'];


		return $instance;
	}    
    
    
    function form($instance) {
        $title = esc_attr($instance['title']);
        $bgcolor = esc_attr($instance['bgcolor']);
        $align = $instance['align'];
        
        $aligns = array(
            'left' => 'Left',
            'center' => 'Center',
            'right' => 'Right'
        );
        
        ?>
            <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?><br /> <input  id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
            
 
            
            
            <p>
              <label for="<?php echo $this->get_field_id('align'); ?>">Widget alignment:</label><br />
              <select name="<?php echo $this->get_field_name('align'); ?>" id="<?php echo $this->get_field_id('align'); ?>">
                <?php foreach ($aligns as $val => $text): ?>
                <option value="<?php echo $val; ?>" <?php selected($val, $align); ?>><?php echo $text; ?></option>
                <?php endforeach; ?>
              </select>
            </p> 
             
        <?php 

    }
}

add_action('widgets_init', create_function('', 'return register_widget("JumboWidget");'));
?>
