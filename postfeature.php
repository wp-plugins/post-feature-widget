<?php
/*
Plugin Name: Featured Post Widget
Plugin URI: http://wasistlos.waldemarstoffel.com/plugins-fur-wordpress/featured-post-widget
Description: Featured Post Widget is yet another plugin to make your blog a bit more newspaper-like. Just by entering the ID, you can put a post in the 'featured' area and display thumbnail, headline, excerpt or all three of them (if available) in the fully customizable widget.
Version: 1.9
Author: Waldemar Stoffel
Author URI: http://www.waldemarstoffel.com
License: GPL3
*/

/*  Copyright 2011  Waldemar Stoffel  (email : stoffel@atelier-fuenf.de)

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.

*/


/* Stop direct call */

if(preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF'])) { die("Sorry, you don't have direct access to this page."); }

/* attach JavaScript file for textarea reszing */

$fpw_path = WP_CONTENT_URL.'/plugins/'.plugin_basename(dirname(__FILE__)).'/';

function fpw_js_sheet() {
   global $fpw_path;
   wp_enqueue_script('ta-resize-script', $fpw_path.'ta-expander.js', false, false, true);
}

add_action('admin_print_scripts-widgets.php', 'fpw_js_sheet');

//Additional links on the plugin page

add_filter('plugin_row_meta', 'fpw_register_links',10,2);

function fpw_register_links($links, $file) {
	
	$base = plugin_basename(__FILE__);
	if ($file == $base) {
		$links[] = '<a href="http://wordpress.org/extend/plugins/post-feature-widget/faq/" target="_blank">'.__('FAQ','postfeature').'</a>';
		$links[] = '<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=D8AVGNDYYUNA2" target="_blank">'.__('Donate','postfeature').'</a>';
	}
	
	return $links;

}
// extending the widget class
 
class Featured_Post_Widget extends WP_Widget {
 
 function Featured_Post_Widget() {
	 
	 $widget_opts = array( 'description' => __('You can feature a certain post in this widget and display it, where and however you want, in your widget areas. The ID of a backup post can be given to avoid dubble content.', 'postfeature') );
	 $control_opts = array( 'width' => 400 );

	 
	 parent::WP_Widget(false, $name = 'Featured Post', $widget_opts, $control_opts);
 }
 
function form($instance) {
	
	$title = esc_attr($instance['title']);
	$thumb = esc_attr($instance['thumb']);
	$image = esc_attr($instance['image']);
	$article = esc_attr($instance['article']);
	$backup = esc_attr($instance['backup']);
	$width = esc_attr($instance['width']);
	$subtitle = esc_attr($instance['subtitle']);	
	$excerpt = esc_attr($instance['excerpt']);
	$style = esc_attr($instance['style']);
	
	if (empty($style)) {
		
		$style_height=25;
	
	}
	
	else {
		
		$fpw_elements=str_replace(array("\r\n", "\n", "\r"), '|', $style);
		$style_height=count(explode('|', $fpw_elements))*23;
		
	}
	
	if (empty($excerpt)) {
		
		$excerpt_height=25;
	
	}
	
	else {
		
		$fpw_elements=str_replace(array("\r\n", "\n", "\r"), '|', $excerpt);
		$excerp_height=count(explode('|', $fpw_elements))*23;
		
	}
 
 ?>
 
<p>
 <label for="<?php echo $this->get_field_id('title'); ?>">
 <?php _e('Title:', 'postfeature'); ?>
 <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
 </label>
</p>
<p>
 <label for="<?php echo $this->get_field_id('article'); ?>">
 <?php _e('Give here the ID of the post, you want to appear in the widget:', 'postfeature'); ?>
 <input size="6" id="<?php echo $this->get_field_id('article'); ?>" name="<?php echo $this->get_field_name('article'); ?>" type="text" value="<?php echo $article; ?>" />
 </label>
</p>
<p>
 <label for="<?php echo $this->get_field_id('backup'); ?>">
 <?php _e('Give here the ID of the backup post, it will appear, when a single post page shows the featured article:', 'postfeature'); ?>
 <input size="6" id="<?php echo $this->get_field_id('backup'); ?>" name="<?php echo $this->get_field_name('backup'); ?>" type="text" value="<?php echo $backup; ?>" />
 </label>
</p>
<p>
 <label for="<?php echo $this->get_field_id('image'); ?>">
 <input id="<?php echo $this->get_field_id('image'); ?>" name="<?php echo $this->get_field_name('image'); ?>" <?php if(!empty($image)) {echo "checked=\"checked\""; } ?> type="checkbox" />&nbsp;<?php _e('Check to get the first image of the post as thumbnail.', 'postfeature'); ?>
 </label>
</p>
<p>
 <label for="<?php echo $this->get_field_id('width'); ?>">
 <?php _e('This is the width in px of the thumbnail (if choosing the first image):', 'postfeature'); ?>
 <input size="4" id="<?php echo $this->get_field_id('width'); ?>" name="<?php echo $this->get_field_name('width'); ?>" type="text" value="<?php echo $width; ?>" />
 </label>
</p>
<p>
 <label for="<?php echo $this->get_field_id('thumb'); ?>">
 <input id="<?php echo $this->get_field_id('thumb'); ?>" name="<?php echo $this->get_field_name('thumb'); ?>" <?php if(!empty($thumb)) {echo "checked=\"checked\""; } ?> type="checkbox" />&nbsp;<?php _e('Check to <strong>not</strong> display the thumbnail of the post.', 'postfeature'); ?>
 </label>
</p>
<p>
 <label for="<?php echo $this->get_field_id('subtitle'); ?>">
 <input id="<?php echo $this->get_field_id('subtitle'); ?>" name="<?php echo $this->get_field_name('subtitle'); ?>" <?php if(!empty($subtitle)) {echo "checked=\"checked\""; } ?> type="checkbox" />&nbsp;<?php _e('Check to display the title of the post <strong>under</strong> the thumbnail (it is above by default).', 'postfeature'); ?>
 </label>
</p>
<p>
 <label for="<?php echo $this->get_field_id('excerpt'); ?>">
 <?php _e('If the excerpt of the post is not defined, by default the first 3 sentences of the post are showed. You can enter your own excerpt here, if you want.', 'postfeature'); ?>
 <textarea class="widefat expand<?php echo $excerpt_height; ?>-1000" id="<?php echo $this->get_field_id('excerpt'); ?>" name="<?php echo $this->get_field_name('excerpt'); ?>"><?php echo $excerpt; ?></textarea>
 </label>
</p>
<p>
 <label for="<?php echo $this->get_field_id('style'); ?>">
 <?php _e('Here you can finally style the widget. Simply type something like<br /><strong>border: 2px solid;<br />border-color: #cccccc;<br />padding: 10px;</strong><br />to get just a gray outline and a padding of 10 px. If you leave that section empty, your theme will style the widget.', 'postfeature'); ?>
 <textarea class="widefat expand<?php echo $style_height; ?>-1000" id="<?php echo $this->get_field_id('style'); ?>" name="<?php echo $this->get_field_name('style'); ?>"><?php echo $style; ?></textarea>
 </label>
</p>
<?php
 }
 


function update($new_instance, $old_instance) {
	 
	 $instance = $old_instance;
	 
	 $instance['title'] = strip_tags($new_instance['title']);
	 $instance['article'] = strip_tags($new_instance['article']);
	 $instance['backup'] = strip_tags($new_instance['backup']);	 
	 $instance['thumb'] = strip_tags($new_instance['thumb']);	 
	 $instance['image'] = strip_tags($new_instance['image']);	 
	 $instance['width'] = strip_tags($new_instance['width']);	 
	 $instance['subtitle'] = strip_tags($new_instance['subtitle']);
	 $instance['excerpt'] = strip_tags($new_instance['excerpt']);
	 $instance['style'] = strip_tags($new_instance['style']);

	 return $instance;
}
 
function widget($args, $instance) {
	
	extract( $args );
	
	$title = apply_filters('widget_title', $instance['title']);
	
	if (empty($instance['style'])) {
		
		$fpw_before_widget=$before_widget;
		$fpw_after_widget=$after_widget;
		
	}
	
	else {
		
		$style=str_replace(array("\r\n", "\n", "\r"), '', $instance['style']);
		
		$fpw_before_widget="<div id=\"".$widget_id."\" style=\"".$style."\">";
		$fpw_after_widget="</div>";
		
	}
	
	echo $fpw_before_widget;
	
	if ( $title ) {
		
		echo $before_title . $title . $after_title;
		
	}
	
	global $wp_query;
		
	$fpw_post_id = get_post($instance['article']);
	$fpw_post_name = $fpw_post_id->post_name;
	
	if ($instance['article'] == $wp_query->get( 'p' ) || $fpw_post_name == $wp_query->get ( 'name' )) { $fpw_post = 'p='.$instance['backup']; }
	
	else { $fpw_post = 'p='.$instance['article']; }
 
/* This is the actual function of the plugin, it fills the widget with the customized post */

 global $post;
 $fpw_posts = get_posts($fpw_post);
 foreach($fpw_posts as $post) :
 
   setup_postdata($post);
   
   // post tile above thumbnail
   
   if (!$instance['subtitle']) {
	   
	   ?>
       <p>
       <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
       </p>
	   <?php 
   
   }
   
   // thumbnail, if wanted
   
   if ($instance['image']) {
	   
	   $fpw_thumb = '';
	   
	   $fpw_image = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
	   $fpw_thumb = $matches [1] [0];
	   
	   if ($fpw_thumb) {	   
	   
	   $fpw_image_title=$post->get_the_title;
	   $fpw_size=getimagesize($fpw_thumb);
	   $fpw_x=$instance['width'];
	   $fpw_y=intval($fpw_size[1]/($fpw_size[0]/$fpw_x));
	   
	   ?>
       <a href="<?php the_permalink(); ?>">
	   <?php echo "<img title=\"".$fpw_image_title."\" src=\"".$fpw_thumb."\" alt=\"".$fpw_image_title."\" width=\"".$fpw_x."\" height=\"".$fpw_y."\" />"; ?>
       </a>
	   <?php
	
   }}
   
   else {
	   
   if (function_exists('has_post_thumbnail')) {
	   
	   if (has_post_thumbnail() && !$instance['thumb']) {
		   
		   ?>
           <a href="<?php the_permalink(); ?>">
		   <?php the_post_thumbnail(); ?>
           </a>
		   <?php
		
	   }}
       
    }
	
	// post title beneath thumbnail
	
	if ($instance['subtitle']) {
	   
	   ?>
       <p>
       <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
       </p>
	   <?php 
   
   }	

		   
/* show the excerpt of the post */
	
	$fpw_excerpt=$instance['excerpt'];
	
	if (!$fpw_excerpt) {
		
		$fpw_excerpt=$post->post_excerpt;
		
	}
	
/* in case the excerpt is not definded by theme or anything else, the first 3 sentences of the content are given */
	
	if (!$fpw_excerpt) {
		
		$fpw_text=preg_replace('/\[caption(.*?)\[\/caption\]/', '', get_the_content());
		
		$fpw_short=array_slice(preg_split("/([\t.!?]+)/", $fpw_text, -1, PREG_SPLIT_DELIM_CAPTURE), 0, 6);
			
		$fpw_excerpt=implode($fpw_short);
	
	}
	
	echo "<p>".$fpw_excerpt."</p>";
	
	
	endforeach;

 
 echo $fpw_after_widget;
 
 }
 
}

add_action('widgets_init', create_function('', 'return register_widget("Featured_Post_Widget");'));


// import laguage files

load_plugin_textdomain('postfeature', false , basename(dirname(__FILE__)).'/languages');


?>