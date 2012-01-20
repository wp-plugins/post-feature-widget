<?php
/*
Plugin Name: Featured Post Widget
Plugin URI: http://wasistlos.waldemarstoffel.com/plugins-fur-wordpress/featured-post-widget
Description: Featured Post Widget is yet another plugin to make your blog a bit more newspaper-like. Just by choosing a post from a dropdown, you can put it in the 'featured' area and display thumbnail, headline, excerpt or all three of them (if available) in the fully customizable widget.
Version: 3.1
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

if(preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF'])) die("Sorry, you don't have direct access to this page."); 

/* attach JavaScript file for textarea reszing */

function fpw_js_sheet() {
   
   wp_enqueue_script('ta-expander-script', plugins_url('ta-expander.js', __FILE__), false, false, true);

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
	 
	 $widget_opts = array( 'description' => __('You can feature a certain post in this widget and display it, where and however you want, in your widget areas. A backup post can be given to avoid dubble content.', 'postfeature') );
	 $control_opts = array( 'width' => 400 );

	 
	 parent::WP_Widget(false, $name = 'Featured Post', $widget_opts, $control_opts);
 }
 
function form($instance) {
	
	$title = esc_attr($instance['title']);
	$thumb = esc_attr($instance['thumb']);
	$image = esc_attr($instance['image']);
	$article = esc_attr($instance['article']);
	$backup = esc_attr($instance['backup']);
	$class = esc_attr($instance['class']);
	$myclass = esc_attr($instance['myclass']);
	$width = esc_attr($instance['width']);
	$subtitle = esc_attr($instance['subtitle']);	
	$excerpt = esc_attr($instance['excerpt']);
	$noshorts = esc_attr($instance['noshorts']);
	$readmore = esc_attr($instance['readmore']);
	$rmtext = esc_attr($instance['rmtext']);
	$style = esc_attr($instance['style']);
	
	$features = get_posts('numberposts=-1');

?>
 
<p>
 <label for="<?php echo $this->get_field_id('title'); ?>">
 <?php _e('Title:', 'postfeature'); ?>
 <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
 </label>
</p>
<p>
  <label for="<?php echo $this->get_field_id( 'article' ); ?>"><?php _e('Choose here the post, you want to appear in the widget.', 'postfeature'); ?></label>
  <select id="<?php echo $this->get_field_id( 'article' ); ?>" name="<?php echo $this->get_field_name( 'article' ); ?>" class="widefat" style="width:100%;">
  <?php
  if (empty($article)) echo '<option value="">'.__('Take a random post', 'postfeature').'</option>';  
    foreach ( $features as $feature ) {
      $selected = ( $feature->ID == $article ) ? 'selected="selected"' : '' ;
      $option = '<option value="'.$feature->ID.'" '.$selected.' >'.$feature->post_title.'</option>';
      echo $option;
    }
  ?>
  </select>
</p>
<p>
  <label for="<?php echo $this->get_field_id( 'backup' ); ?>"><?php _e('Choose here the backup post. It will appear, when a single post page shows the featured article.', 'postfeature'); ?></label>
  <select id="<?php echo $this->get_field_id( 'backup' ); ?>" name="<?php echo $this->get_field_name( 'backup' ); ?>" class="widefat" style="width:100%;">
  <?php
  if (empty($article)) echo '<option value="">'.__('Take a random post', 'postfeature').'</option>';  
    foreach ( $features as $feature ) {
      $selected = ( $feature->ID == $backup ) ? 'selected="selected"' : '' ;
      $option = '<option value="'.$feature->ID.'" '.$selected.' >'.$feature->post_title.'</option>';
      echo $option;
    }
  ?>
  </select>
</p>
<p>
 <label for="<?php echo $this->get_field_id('class'); ?>">
 <input id="<?php echo $this->get_field_id('class'); ?>" name="<?php echo $this->get_field_name('class'); ?>" <?php if(!empty($class)) echo "checked=\"checked\""; ?> type="checkbox" />&nbsp;<?php _e('I want to style the first paragraph in this widget with my own class.', 'postfeature'); ?>
 </label>
</p>
<p>
 <label for="<?php echo $this->get_field_id('myclass'); ?>">
 <?php _e('Write here the name of your class:', 'postfeature'); ?>
 <input class="widefat" id="<?php echo $this->get_field_id('myclass'); ?>" name="<?php echo $this->get_field_name('myclass'); ?>" type="text" value="<?php echo $myclass; ?>" />
 </label>
</p>
<p>
 <label for="<?php echo $this->get_field_id('image'); ?>">
 <input id="<?php echo $this->get_field_id('image'); ?>" name="<?php echo $this->get_field_name('image'); ?>" <?php if(!empty($image)) echo "checked=\"checked\""; ?> type="checkbox" />&nbsp;<?php _e('Check to get the first image of the post as thumbnail.', 'postfeature'); ?>
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
 <input id="<?php echo $this->get_field_id('thumb'); ?>" name="<?php echo $this->get_field_name('thumb'); ?>" <?php if(!empty($thumb)) echo "checked=\"checked\""; ?> type="checkbox" />&nbsp;<?php _e('Check to <strong>not</strong> display the thumbnail of the post.', 'postfeature'); ?>
 </label>
</p>
<p>
 <label for="<?php echo $this->get_field_id('subtitle'); ?>">
 <input id="<?php echo $this->get_field_id('subtitle'); ?>" name="<?php echo $this->get_field_name('subtitle'); ?>" <?php if(!empty($subtitle)) echo "checked=\"checked\""; ?> type="checkbox" />&nbsp;<?php _e('Check to display the title of the post <strong>under</strong> the thumbnail (it is above by default).', 'postfeature'); ?>
 </label>
</p>
<p>
 <label for="<?php echo $this->get_field_id('noshorts'); ?>">
 <input id="<?php echo $this->get_field_id('noshorts'); ?>" name="<?php echo $this->get_field_name('noshorts'); ?>" <?php if(!empty($noshorts)) echo "checked=\"checked\""; ?> type="checkbox" />&nbsp;<?php _e('Check to suppress shortcodes in the widget (in case the content is showing).', 'postfeature'); ?>
 </label>
</p>
<p>
 <label for="<?php echo $this->get_field_id('excerpt'); ?>">
 <?php _e('If the excerpt of the post is not defined, by default the first 3 sentences of the post are showed. You can enter your own excerpt here, if you want.', 'postfeature'); ?>
 <textarea class="widefat" id="<?php echo $this->get_field_id('excerpt'); ?>" name="<?php echo $this->get_field_name('excerpt'); ?>"><?php echo $excerpt; ?></textarea>
 </label>
</p>
<p>
 <label for="<?php echo $this->get_field_id('readmore'); ?>">
 <input id="<?php echo $this->get_field_id('readmore'); ?>" name="<?php echo $this->get_field_name('readmore'); ?>" <?php if(!empty($readmore)) echo "checked=\"checked\""; ?> type="checkbox" />&nbsp;<?php _e('Check to have an additional &#39;read more&#39; link at the end of the excerpt.', 'postfeature'); ?>
 </label>
</p>
<p>
 <label for="<?php echo $this->get_field_id('rmtext'); ?>">
 <?php _e('Write here some text for the &#39;read more&#39; link. By default, it is [...]:', 'postfeature'); ?>
 <input class="widefat" id="<?php echo $this->get_field_id('rmtext'); ?>" name="<?php echo $this->get_field_name('rmtext'); ?>" type="text" value="<?php echo $rmtext; ?>" />
 </label>
</p>
<p>
 <label for="<?php echo $this->get_field_id('style'); ?>">
 <?php _e('Here you can finally style the widget. Simply type something like<br /><strong>border: 2px solid;<br />border-color: #cccccc;<br />padding: 10px;</strong><br />to get just a gray outline and a padding of 10 px. If you leave that section empty, your theme will style the widget.', 'postfeature'); ?>
 <textarea class="widefat" id="<?php echo $this->get_field_id('style'); ?>" name="<?php echo $this->get_field_name('style'); ?>"><?php echo $style; ?></textarea>
 </label>
</p>
<script type="text/javascript"><!--
jQuery(document).ready(function() {
	jQuery("#<?php echo $this->get_field_id('excerpt'); ?>").autoResize();
	jQuery("#<?php echo $this->get_field_id('style'); ?>").autoResize();
});
--></script>
<?php

}

function update($new_instance, $old_instance) {
	 
	 $instance = $old_instance;
	 
	 $instance['title'] = strip_tags($new_instance['title']);
	 $instance['article'] = strip_tags($new_instance['article']);
	 $instance['backup'] = strip_tags($new_instance['backup']);
	 $instance['class'] = strip_tags($new_instance['class']);
	 $instance['myclass'] = strip_tags($new_instance['myclass']);
	 $instance['thumb'] = strip_tags($new_instance['thumb']);	 
	 $instance['image'] = strip_tags($new_instance['image']);	 
	 $instance['width'] = strip_tags($new_instance['width']);	 
	 $instance['subtitle'] = strip_tags($new_instance['subtitle']);
	 $instance['excerpt'] = strip_tags($new_instance['excerpt']);
	 $instance['noshorts'] = strip_tags($new_instance['noshorts']);
	 $instance['readmore'] = strip_tags($new_instance['readmore']);
	 $instance['rmtext'] = strip_tags($new_instance['rmtext']);
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
		
		$fpw_before_widget='<div id="'.$widget_id.'" style="'.$style.'">';
		$fpw_after_widget='</div>';
		
	}
	
	echo $fpw_before_widget;
	
	if ( $title ) echo $before_title . $title . $after_title;
	
	global $wp_query;
		
	$fpw_post_id = get_post($instance['article']);
	$fpw_post_name = $fpw_post_id->post_name;
	
	$fpw_post = ($instance['article'] == $wp_query->get( 'p' ) || $fpw_post_name == $wp_query->get ( 'name' )) ? 'p='.$instance['backup'] : 'p='.$instance['article'];
	
	if ($fpw_post=='p=') $fpw_post = 'numberposts=1&orderby=rand';
 
/* This is the actual function of the plugin, it fills the widget with the customized post */

 global $post;
 $fpw_posts = get_posts($fpw_post);
 foreach($fpw_posts as $post) :
 
   setup_postdata($post);
   
   $fpw_args = array(
		'post_type' => 'attachment',
		'numberposts' => 1,
		'post_status' => null,
		'post_parent' => $post->ID
	   );
	   
	   $fpw_attachments = get_posts( $fpw_args );
	   
	   if ( $fpw_attachments ) {
        foreach ( $fpw_attachments as $attachment )
		  $fpw_image_alt = trim(strip_tags( get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true) ));
		  $fpw_image_title = trim(strip_tags( $attachment->post_title ));
        }
		
	$fpw_title_tag = __('Permalink to', 'postfeature').' '.$post->post_title;
   
   // post title above thumbnail
   
   if (!$instance['subtitle']) {
	   
	   ?>
       <p<?php if ($instance['class']) echo ' class="'.$instance['myclass'].'"'; ?>>
       <a href="<?php the_permalink(); ?>" title="<?php echo $fpw_title_tag; ?>"><?php the_title(); ?></a>
       </p>
	   <?php 
   
   }
   
  // thumbnail, if wanted

  if ($instance['image']) {
	  
	  $fpw_thumb = '';
	  $fpw_image = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
	  $fpw_thumb = $matches [1] [0];
	  
	  if ($fpw_thumb) {
		  $host_string = 'http://' . $_SERVER['HTTP_HOST'];
		  
		  if (empty($fpw_image_title)) $fpw_image_title = $post->post_title;
		  if (empty($fpw_image_alt)) $fpw_image_alt = $post->post_title;
		  
		  $fpw_x = $instance['width'];
		  
		  if (strncmp($fpw_thumb, $host_string, strlen($host_string)) == 0) $realfilepath = $_SERVER['DOCUMENT_ROOT'] . urldecode(substr($fpw_thumb, strlen($host_string)));
		  
		  else $realfilepath = $fpw_thumb;
		  
		  if (file_exists($realfilepath)) {
			  
			  $fpw_size = getimagesize($realfilepath);
			  
			  if (!empty($fpw_x)) $fpw_y = intval($fpw_size[1] / ($fpw_size[0] / $fpw_x));  
		  }
		  
		  ?>
          <a href="<?php the_permalink(); ?>">
          <?php
		  	$image_height = isset($fpw_y) ? ' height="' . $fpw_y . '"' : '';
			$image_width = ' width="' . $fpw_x . '"';
			
			echo '<img title="' . $fpw_image_title . '" src="' . $fpw_thumb . '" alt="' . $fpw_image_alt . '"' . $image_width . $image_height . " />";
		?></a><?php
        
		}
   }
   
   else {
	   
   if (function_exists('has_post_thumbnail')) {
	   
	   if (has_post_thumbnail() && !$instance['thumb']) {
		   
		   ?>
           <a href="<?php the_permalink(); ?>">
		   <?php the_post_thumbnail(); ?>
           </a>
		   <?php
		
	   }
	}
       
    }
	
	// post title beneath thumbnail
	
	if ($instance['subtitle']) {
	   
	   ?>
       <p<?php if ($instance['class']) echo ' class="'.$instance['myclass'].'"'; ?>>
       <a href="<?php the_permalink(); ?>" title="<?php echo $fpw_title_tag; ?>"><?php the_title(); ?></a>
       </p>
	   <?php 
   
   }	

		   
/* show the excerpt of the post */
	
	$fpw_excerpt=$instance['excerpt'];
	
	if (!$fpw_excerpt) $fpw_excerpt=$post->post_excerpt;
	
/* in case the excerpt is not definded by the theme or anything else, the first 3 sentences of the content are given */
	
	if (!$fpw_excerpt) {
		
		$fpw_text = trim(preg_replace('/\s\s+/', ' ', str_replace(array("\r\n", "\n", "\r", "&nbsp;"), ' ', strip_tags(preg_replace('/\[caption(.*?)\[\/caption\]/', '', get_the_content())))));
																					
		if ($instance['noshorts']) $fpw_text=strip_shortcodes($fpw_text);
		
		$fpw_short=array_slice(preg_split("/([\t.!?]+)/", $fpw_text, -1, PREG_SPLIT_DELIM_CAPTURE), 0, 6);
			
		$fpw_excerpt=implode($fpw_short);
	
	}
	
/* do we want the read more link and do we have text for it? */

	if ($instance['readmore']) {
		
		$fpw_rmtext=$instance['rmtext'];
		
		if (!$fpw_rmtext) $fpw_rmtext='[&#8230;]';
		
		$fpw_excerpt.=' <a href="'.get_permalink().'" title="'.$fpw_title_tag.'">'.$fpw_rmtext.'</a>';
		
	}
		
	echo '<p>'.do_shortcode($fpw_excerpt).'</p>';
	
	
	endforeach;

 
 echo $fpw_after_widget;
 
 }
 
}

add_action('widgets_init', create_function('', 'return register_widget("Featured_Post_Widget");'));


// import laguage files

load_plugin_textdomain('postfeature', false , basename(dirname(__FILE__)).'/languages');


?>