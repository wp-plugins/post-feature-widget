<?php

/**
 *
 * Class FPW Widget
 *
 * @ Featured Post Widget
 *
 * building the actual widget
 *
 */
class Featured_Post_Widget extends WP_Widget {
 
function Featured_Post_Widget() {

	global $fpw_language_file;
	
	$widget_opts = array( 'description' => __('You can feature a certain post in this widget and display it, where and however you want, in your widget areas. A backup post can be given to avoid dubble content.', $fpw_language_file) );
	$control_opts = array( 'width' => 400 );
	
	
	parent::WP_Widget(false, $name = 'Featured Post Widget', $widget_opts, $control_opts);

}
 
function form($instance) {
	
	global $fpw_language_file;
	
	$title = esc_attr($instance['title']);
	$thumb = esc_attr($instance['thumb']);
	$image = esc_attr($instance['image']);
	$article = esc_attr($instance['article']);
	$backup = esc_attr($instance['backup']);
	$class = esc_attr($instance['class']);
	$myclass = esc_attr($instance['myclass']);	
	$width = esc_attr($instance['width']);
	$headline = esc_attr($instance['headline']);	
	$excerpt = esc_attr($instance['excerpt']);
	$linespace = esc_attr($instance['linespace']);
	$notext = esc_attr($instance['notext']);
	$noshorts = esc_attr($instance['noshorts']);
	$readmore = esc_attr($instance['readmore']);
	$rmtext = esc_attr($instance['rmtext']);
	$adsense = esc_attr($instance['adsense']);
	$style = esc_attr($instance['style']);
	
	$features = get_posts('numberposts=-1');
 
?>
 
<p>
 <label for="<?php echo $this->get_field_id('title'); ?>">
 <?php _e('Title:', $fpw_language_file); ?>
 <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
 </label>
</p>
<p>
  <label for="<?php echo $this->get_field_id( 'article' ); ?>"><?php _e('Choose here the post, you want to appear in the widget.', $fpw_language_file); ?></label>
  <select id="<?php echo $this->get_field_id( 'article' ); ?>" name="<?php echo $this->get_field_name( 'article' ); ?>" class="widefat" style="width:100%;">
  <?php
	if (empty($article)) echo '<option value="">'.__('Take a random post', $fpw_language_file).'</option>';  
	
	foreach ( $features as $feature ) :
	
		$selected = ( $feature->ID == $article ) ? 'selected="selected"' : '' ;
		$option = '<option value="'.$feature->ID.'" '.$selected.' >'.$feature->post_title.'</option>';
		echo $option;
	
	endforeach;
  ?>
  </select>
</p>
<p>
  <label for="<?php echo $this->get_field_id( 'backup' ); ?>"><?php _e('Choose here the backup post. It will appear, when a single post page shows the featured article.', $fpw_language_file); ?></label>
  <select id="<?php echo $this->get_field_id( 'backup' ); ?>" name="<?php echo $this->get_field_name( 'backup' ); ?>" class="widefat" style="width:100%;">
  <?php
	if (empty($backup)) echo '<option value="">'.__('Take a random post', $fpw_language_file).'</option>';
	
	foreach ( $features as $feature ) :
		
		$selected = ( $feature->ID == $backup ) ? 'selected="selected"' : '' ;
		$option = '<option value="'.$feature->ID.'" '.$selected.' >'.$feature->post_title.'</option>';
		echo $option;
	
	endforeach;
  ?>
  </select>
</p>
<p>
 <label for="<?php echo $this->get_field_id('class'); ?>">
 <input id="<?php echo $this->get_field_id('class'); ?>" name="<?php echo $this->get_field_name('class'); ?>" type="checkbox" value="1" <?php echo checked( 1, $class, false ); ?> />&nbsp;<?php _e('I want to style the first paragraph in this widget with my own class.', $fpw_language_file); ?>
 </label>
</p>
<p>
 <label for="<?php echo $this->get_field_id('myclass'); ?>">
 <?php _e('Write here the name of your class:', $fpw_language_file); ?>
 <input class="widefat" id="<?php echo $this->get_field_id('myclass'); ?>" name="<?php echo $this->get_field_name('myclass'); ?>" type="text" value="<?php echo $myclass; ?>" />
 </label>
</p>
<p>
 <label for="<?php echo $this->get_field_id('image'); ?>">
 <input id="<?php echo $this->get_field_id('image'); ?>" name="<?php echo $this->get_field_name('image'); ?>" type="checkbox" value="1" <?php echo checked( 1, $image, false ); ?> />&nbsp;<?php _e('Check to get the first image of the post as thumbnail.', $fpw_language_file); ?>
 </label>
</p>
<p>
 <label for="<?php echo $this->get_field_id('width'); ?>">
 <?php _e('This is the width in px of the thumbnail (if choosing the first image):', $fpw_language_file); ?>
 <input size="4" id="<?php echo $this->get_field_id('width'); ?>" name="<?php echo $this->get_field_name('width'); ?>" type="text" value="<?php echo $width; ?>" />
 </label>
</p>
<p>
 <label for="<?php echo $this->get_field_id('thumb'); ?>">
 <input id="<?php echo $this->get_field_id('thumb'); ?>" name="<?php echo $this->get_field_name('thumb'); ?>" type="checkbox" value="1" <?php echo checked( 1, $thumb, false ); ?> />&nbsp;<?php _e('Check to <strong>not</strong> display the thumbnail of the post.', $fpw_language_file); ?>
 </label>
</p>
<p>
 <label for="<?php echo $this->get_field_id('headline'); ?>"><?php _e('Choose, whether or not to display the title and whether it comes above or under the thumbnail.', $fpw_language_file); ?></label>
 <select id="<?php echo $this->get_field_id('headline'); ?>" name="<?php echo $this->get_field_name('headline'); ?>" class="widefat" style="width:100%;">
 <?php
 	$items = array ('top' => __('Above thumbnail', $fpw_language_file) , 'bottom' => __('Under thumbnail', $fpw_language_file), 'none' => __('Don&#39;t show title', $fpw_language_file));
	foreach ($items as $key => $val) :
	
		$selected = ($key == $headline) ? 'selected="selected"' : '' ;
		$option = '<option value="'.$key.'" '.$selected.' >'.$val.'</option>';
		echo $option;
	
	endforeach;
 ?>
 </select>
</p>
<p>
 <label for="<?php echo $this->get_field_id('excerpt'); ?>">
 <?php _e('If the excerpt of the post is not defined, by default the first 3 sentences of the post are showed. You can enter your own excerpt here, if you want.', $fpw_language_file); ?>
 <textarea class="widefat" id="<?php echo $this->get_field_id('excerpt'); ?>" name="<?php echo $this->get_field_name('excerpt'); ?>"><?php echo $excerpt; ?></textarea>
 </label>
</p>
<p>
 <label for="<?php echo $this->get_field_id('linespace'); ?>">
 <input id="<?php echo $this->get_field_id('linespace'); ?>" name="<?php echo $this->get_field_name('linespace'); ?>" type="checkbox" value="1" <?php echo checked( 1, $linespace, false ); ?> />&nbsp;<?php _e('Check to have each sentense in a new line.', $fpw_language_file); ?>
 </label>
</p>
<p>
 <label for="<?php echo $this->get_field_id('notext'); ?>">
 <input id="<?php echo $this->get_field_id('notext'); ?>" name="<?php echo $this->get_field_name('notext'); ?>" type="checkbox" value="1" <?php echo checked( 1, $notext, false ); ?> />&nbsp;<?php _e('Check to <strong>not</strong> display the excerpt.', $fpw_language_file); ?>
 </label>
</p>
<p>
 <label for="<?php echo $this->get_field_id('noshorts'); ?>">
 <input id="<?php echo $this->get_field_id('noshorts'); ?>" name="<?php echo $this->get_field_name('noshorts'); ?>" type="checkbox" value="1" <?php echo checked( 1, $noshorts, false ); ?> />&nbsp;<?php _e('Check to suppress shortcodes in the widget (in case the content is showing).', $fpw_language_file); ?>
 </label>
</p>
<p>
 <label for="<?php echo $this->get_field_id('readmore'); ?>">
 <input id="<?php echo $this->get_field_id('readmore'); ?>" name="<?php echo $this->get_field_name('readmore'); ?>" type="checkbox" value="1" <?php echo checked( 1, $readmore, false ); ?> />&nbsp;<?php _e('Check to have an additional &#39;read more&#39; link at the end of the excerpt.', $fpw_language_file); ?>
 </label>
</p>
<p>
 <label for="<?php echo $this->get_field_id('rmtext'); ?>">
 <?php echo __('Write here some text for the &#39;read more&#39; link. By default, it is', $fpw_language_file).' [&#8230;]:'; ?>
 <input class="widefat" id="<?php echo $this->get_field_id('rmtext'); ?>" name="<?php echo $this->get_field_name('rmtext'); ?>" type="text" value="<?php echo $rmtext; ?>" />
 </label>
</p>
<?php
if (defined('AE_AD_TAGS') && AE_AD_TAGS==1) :
?>
<p>
 <label for="<?php echo $this->get_field_id('adsense'); ?>">
 <input id="<?php echo $this->get_field_id('adsense'); ?>" name="<?php echo $this->get_field_name('adsense'); ?>" type="checkbox" value="1" <?php echo checked( 1, $adsense, false ); ?> />&nbsp;<?php _e('Check if you want to invert the Google AdSense Tags that are defined with the Ads Easy Plugin. E.g. when they are turned off for the sidebar, they will appear in the widget.', $fpw_language_file); ?>
 </label>
</p>
<?php
endif;
?>
<p>
 <label for="<?php echo $this->get_field_id('style'); ?>">
 <?php echo __('Here you can finally style the widget. Simply type something like', $fpw_language_file).'<br /><strong>border: 2px solid;<br />border-color: #cccccc;<br />padding: 10px;</strong><br />'.__('to get just a gray outline and a padding of 10 px. If you leave that section empty, your theme will style the widget.', $fpw_language_file); ?>
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
} // form
 
function update($new_instance, $old_instance) {
	 
	$instance = $old_instance;
	
	$instance['title'] = strip_tags($new_instance['title']);
	$instance['article'] = strip_tags($new_instance['article']);
	$instance['backup'] = strip_tags($new_instance['backup']);	 
	$instance['thumb'] = strip_tags($new_instance['thumb']);	 
	$instance['image'] = strip_tags($new_instance['image']);	 
	$instance['width'] = strip_tags($new_instance['width']);	 
	$instance['headline'] = strip_tags($new_instance['headline']);
	$instance['excerpt'] = strip_tags($new_instance['excerpt']);
	$instance['linespace'] = strip_tags($new_instance['linespace']);
	$instance['notext'] = strip_tags($new_instance['notext']);
	$instance['noshorts'] = strip_tags($new_instance['noshorts']);
	$instance['readmore'] = strip_tags($new_instance['readmore']);
	$instance['rmtext'] = strip_tags($new_instance['rmtext']);
	$instance['adsense'] = strip_tags($new_instance['adsense']);
	$instance['style'] = strip_tags($new_instance['style']);
	
	return $instance;
}

function widget($args, $instance) {
	
global $fpw_language_file;
	
extract( $args );

$title = apply_filters('widget_title', $instance['title']);

if (empty($instance['style'])) :
	
	$fpw_before_widget=$before_widget;
	$fpw_after_widget=$after_widget;

else :
	
	$style=str_replace(array("\r\n", "\n", "\r"), ' ', $instance['style']);
	
	$fpw_before_widget='<div id="'.$widget_id.'" style="'.$style.'">';
	$fpw_after_widget='</div>';
	
endif;

// hooking into ads easy for the google tags

if (AE_AD_TAGS == 1 && $instance['adsense']) :
	
	$ae_options = get_option('ae_options');
	
	do_action('google_end_tag');
	
	if ($ae_options['ae_sidebar']==1) do_action('google_ignore_tag');

	else do_action('google_start_tag');
	
endif;

// widget starts

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

$imagetags = new A5_ImageTags;

$fpw_tags = $imagetags->get_tags($post, $fpw_language_file);

$fpw_image_alt = $fpw_tags['image_alt'];
$fpw_image_title = $fpw_tags['image_title'];
$fpw_title_tag = $fpw_tags['title_tag'];

// headline, if wanted

if ($instance['headline'] != 'none') :

	$fpw_class = ($instance['class']) ? ' class="'.$instance['myclass'].'"' : '';
	
	$eol = "\r\n";

	$fpw_headline = '<p'.$fpw_class.'>'.$eol.'<a href="'.get_permalink().'" title="'.$fpw_title_tag.'">'.get_the_title().'</a>'.$eol.'</p>';
	
endif;

// thumbnail, if wanted

if (!$instance['thumb']) :
	
	if ($instance['image']) : 
	
		$args = array (
		'content' => $post->post_content,
		'width' => $instance['width']
		);
		   
		$fpw_image = new A5_Thumbnail;
	
		$fpw_image_info = $fpw_image->get_thumbnail($args);
		
		$fpw_thumb = $fpw_image_info['thumb'];
		
		$fpw_width = $fpw_image_info['thumb_width'];

		$fpw_height = $fpw_image_info['thumb_height'];
		
		if ($fpw_thumb) :
		
			if ($fpw_width) $fpw_img_tag = '<img title="'.$fpw_image_title.'" src="'.$fpw_thumb.'" alt="'.$fpw_image_alt.'" width="'.$fpw_width.'" height="'.$fpw_height.'" />';
				
			else $fpw_img_tag = '<img title="'.$fpw_image_title.'" src="'.$fpw_thumb.'" alt="'.$fpw_image_alt.'" style="maxwidth: '.$instance['width'].';" />';
			
		endif;
		
	else :
	
		$fpw_img_tag = get_the_post_thumbnail();
	
	endif;
	
		$fpw_image = '<a href="'.get_permalink().'">'.$fpw_img_tag.'</a>'.$eol.'<div style="clear: both;"></div>'.$eol;
	
endif;

// excerpt, if wanted

if (!$instance['notext']) :

$rmtext = ($instance['rmtext']) ? $instance['rmtext'] : '[&#8230;]';

$shortcode = ($instance['noshorts']) ? false : 1;

	$args = array(
	'usertext' => $instance['excerpt'],
	'excerpt' => $post->post_excerpt,
	'content' => $post->post_content,
	'shortcode' => $shortcode,
	'linespace' => $instance['linespace'],
	'link' => get_permalink(),
	'title' => $fpw_title_tag,
	'readmore' => $instance['readmore'],
	'rmtext' => $rmtext
	);

	$fpw_text = A5_Excerpt::get_excerpt($args);

endif;

// writing the stuff in the widget

if ($instance['headline'] == 'top') echo $fpw_headline.$eol;

if (!$instance['thumb']) echo $fpw_image;

if ($instance['headline'] == 'bottom') echo $fpw_headline.$eol;

if (!$instance['notext']) echo '<p>'.do_shortcode($fpw_text).'</p>'.$eol;

endforeach;

// hooking into ads easy for the google tags

echo $fpw_after_widget;

if (AE_AD_TAGS == 1 && $instance['adsense']) :
	
	$ae_options = get_option('ae_options');
	
	do_action('google_end_tag');
	
	if ($ae_options['ae_sidebar']==1) do_action('google_start_tag');

	else do_action('google_ignore_tag');
	
endif;

} // widget
 
} // Featured Post Widget

add_action('widgets_init', create_function('', 'return register_widget("Featured_Post_Widget");'));

?>