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

	$language_file = 'postfeature';
	
	$widget_opts = array( 'description' => __('You can feature a certain post in this widget and display it, where and however you want, in your widget areas. A backup post can be given to avoid dubble content.', $language_file) );
	$control_opts = array( 'width' => 400 );
	
	parent::WP_Widget(false, $name = 'Featured Post Widget', $widget_opts, $control_opts);

}
 
function form($instance) {
	
	$language_file = 'postfeature';
	
	if ($instance['notext']) $instance['alignment'] = 'notext';
	
	$title = esc_attr($instance['title']);
	$thumb = esc_attr($instance['thumb']);
	$image = esc_attr($instance['image']);
	$article = esc_attr($instance['article']);
	$backup = esc_attr($instance['backup']);
	$class = esc_attr($instance['class']);
	$headclass = esc_attr($instance['headclass']);
	$dateclass = esc_attr($instance['dateclass']);
	$width = esc_attr($instance['width']);
	$headline = esc_attr($instance['headline']);
	$date = esc_attr($instance['date']);
	$excerpt = esc_attr($instance['excerpt']);
	$linespace = esc_attr($instance['linespace']);
	$alignment = esc_attr($instance['alignment']);
	$noshorts = esc_attr($instance['noshorts']);
	$readmore = esc_attr($instance['readmore']);
	$rmtext = esc_attr($instance['rmtext']);
	$adsense = esc_attr($instance['adsense']);
	$style = esc_attr($instance['style']);
	
	$features = get_posts('numberposts=-1');
	foreach ( $features as $feature ) :
	
		$posts[] = array($feature->ID, $feature->post_title );
	
	endforeach;
	
	$options = array (array('top', __('Above thumbnail', $language_file)) , array('bottom', __('Under thumbnail', $language_file)), array('none', __('Don&#39;t show title', $language_file)));
	
	$items = array (array('none', __('Under image', $language_file)), array('right', __('Left of image', $language_file)), array('left', __('Right of image', $language_file)), array('notext', __('Don&#39;t show excerpt', $language_file)));
	
	$date_options = array (array('top', __('Above post', $language_file)) , array('bottom', __('Under post', $language_file)), array('none', __('Don&#39;t show date', $language_file)));
	
	$base_id = 'widget-'.$this->id_base.'-'.$this->number.'-';
	$base_name = 'widget-'.$this->id_base.'['.$this->number.']';
	
	$field[] = array ('type' => 'text', 'id_base' => $base_id, 'name_base' => $base_name, 'field_name' => 'title', 'label' => __('Title:', $language_file), 'value' => $title, 'class' => 'widefat', 'space' => 1);
	$field[] = array ('type' => 'select', 'id_base' => $base_id, 'name_base' => $base_name, 'field_name' => 'article', 'label' => __('Choose here the post, you want to appear in the widget.', $language_file), 'value' => $article, 'options' => $posts, 'default' => __('Take a random post', $language_file), 'class' => 'widefat', 'style' => 'width:100%', 'space' => 1);
	$field[] = array ('type' => 'select', 'id_base' => $base_id, 'name_base' => $base_name, 'field_name' => 'backup', 'label' => __('Choose here the backup post. It will appear, when a single post page shows the featured article.', $language_file), 'value' => $backup, 'options' => $posts, 'default' => __('Take a random post', $language_file), 'class' => 'widefat', 'style' => 'width:100%', 'space' => 1);	
	$field[] = array ('type' => 'checkbox', 'id_base' => $base_id, 'name_base' => $base_name, 'field_name' => 'class', 'label' => __('I want to style the headline and the date in this widget with my own class(es).', $language_file), 'value' => $class, 'space' => 1);	
	$field[] = array ('type' => 'text', 'id_base' => $base_id, 'name_base' => $base_name, 'field_name' => 'headclass', 'label' => __('Write here the name of your class for the headline:', $language_file), 'value' => $headclass, 'class' => 'widefat', 'space' => 1);
	$field[] = array ('type' => 'text', 'id_base' => $base_id, 'name_base' => $base_name, 'field_name' => 'dateclass', 'label' => __('Write here the name of your class for the date:', $language_file), 'value' => $dateclass, 'class' => 'widefat', 'space' => 1);
	$field[] = array ('type' => 'text', 'id_base' => $base_id, 'name_base' => $base_name, 'field_name' => 'image', 'label' => sprintf(__('To use an image of the post instead of the post thumbnail, enter the number of that image. The word %s will bring the last image of the post.', $language_file), '&#39;last&#39;'), 'value' => $image, 'size' => 6, 'space' => 1);	
	$field[] = array ('type' => 'number', 'id_base' => $base_id, 'name_base' => $base_name, 'field_name' => 'width', 'label' => __('This is the width in px of the thumbnail (if choosing an image):', $language_file), 'value' => $width, 'size' => 4, 'step' => 1, 'space' => 1);
	$field[] = array ('type' => 'checkbox', 'id_base' => $base_id, 'name_base' => $base_name, 'field_name' => 'thumb', 'label' => sprintf(__('Check to %snot%s display the thumbnail of the post.', $language_file), '<strong>', '</strong>'), 'value' => $thumb, 'space' => 1);
	$field[] = array ('type' => 'select', 'id_base' => $base_id, 'name_base' => $base_name, 'field_name' => 'headline', 'label' => __('Choose, whether or not to display the title and whether it comes above or under the thumbnail.', $language_file), 'value' => $headline, 'options' => $options, 'class' => 'widefat', 'style' => 'width:100%', 'space' => 1);
	$field[] = array ('type' => 'select', 'id_base' => $base_id, 'name_base' => $base_name, 'field_name' => 'date', 'label' => __('Choose, whether or not to display the publishing date and whether it comes above or under the post.', $language_file), 'value' => $date, 'options' => $date_options, 'class' => 'widefat', 'style' => 'width:100%', 'space' => 1);
	$field[] = array ('type' => 'textarea', 'id_base' => $base_id, 'name_base' => $base_name, 'field_name' => 'excerpt', 'class' => 'widefat', 'label' => __('If the excerpt of the post is not defined, by default the first 3 sentences of the post are showed. You can enter your own excerpt here, if you want.', $language_file), 'value' => $excerpt, 'space' => 1);
	$field[] = array ('type' => 'select', 'id_base' => $base_id, 'name_base' => $base_name, 'field_name' => 'alignment', 'label' => __('Choose, whether or not to display the excerpt and whether it comes under the thumbnail or next to it (the latter will only work with an image of the post).', $language_file), 'value' => $alignment, 'options' => $items, 'class' => 'widefat', 'style' => 'width:100%', 'space' => 1);	
	$field[] = array ('type' => 'checkbox', 'id_base' => $base_id, 'name_base' => $base_name, 'field_name' => 'linespace', 'label' => __('Check to have each sentence in a new line.', $language_file), 'value' => $linespace, 'space' => 1);
	$field[] = array ('type' => 'checkbox', 'id_base' => $base_id, 'name_base' => $base_name, 'field_name' => 'noshorts', 'label' => __('Check to suppress shortcodes in the widget (in case the content is showing).', $language_file), 'value' => $noshorts, 'space' => 1);
	$field[] = array ('type' => 'checkbox', 'id_base' => $base_id, 'name_base' => $base_name, 'field_name' => 'readmore', 'label' => __('Check to have an additional &#39;read more&#39; link at the end of the excerpt.', $language_file), 'value' => $readmore, 'space' => 1);
	$field[] = array ('type' => 'text', 'id_base' => $base_id, 'name_base' => $base_name, 'field_name' => 'rmtext', 'label' => __('Write here some text for the &#39;read more&#39; link. By default, it is', $language_file).' [&#8230;]:', 'value' => $rmtext, 'class' => 'widefat', 'space' => 1);
	
	if (defined('AE_AD_TAGS') && AE_AD_TAGS==1) :
	
	$field[] = array ('type' => 'checkbox', 'id_base' => $base_id, 'name_base' => $base_name, 'field_name' => 'adsense', 'label' => __('Check if you want to invert the Google AdSense Tags that are defined with the Ads Easy Plugin. E.g. when they are turned off for the sidebar, they will appear in the widget.', $language_file), 'value' => $adsense, 'space' => 1);
	
	endif;
	$field[] = array ('type' => 'textarea', 'id_base' => $base_id, 'name_base' => $base_name, 'field_name' => 'style', 'class' => 'widefat', 'label' => sprintf(__('Here you can finally style the widget. Simply type something like%sto get just a gray outline and a padding of 10 px. If you leave that section empty, your theme will style the widget.', $language_file), '<br /><strong>border: 2px solid;<br />border-color: #cccccc;<br />padding: 10px;</strong><br />'), 'value' => $style, 'space' => 1);
	$field[] = array ('type' => 'resize', 'id_base' => $base_id, 'field_name' => array('excerpt', 'style'));

	foreach ($field as $args) :
	
		$menu_item = new A5_WidgetControlClass($args);
 
 	endforeach;
	
} // form
 
function update($new_instance, $old_instance) {
	 
	$instance = $old_instance;
	
	$instance['title'] = strip_tags($new_instance['title']);
	$instance['article'] = strip_tags($new_instance['article']);
	$instance['backup'] = strip_tags($new_instance['backup']);	 
	$instance['class'] = strip_tags($new_instance['class']);
	$instance['headclass'] = strip_tags($new_instance['headclass']);
	$instance['dateclass'] = strip_tags($new_instance['dateclass']);
	$instance['thumb'] = strip_tags($new_instance['thumb']);	
	$instance['image'] = strip_tags($new_instance['image']);	 
	$instance['width'] = strip_tags($new_instance['width']);	 
	$instance['headline'] = strip_tags($new_instance['headline']);
	$instance['date'] = strip_tags($new_instance['date']);
	$instance['excerpt'] = strip_tags($new_instance['excerpt']);
	$instance['linespace'] = strip_tags($new_instance['linespace']);
	$instance['alignment'] = strip_tags($new_instance['alignment']);
	$instance['noshorts'] = strip_tags($new_instance['noshorts']);
	$instance['readmore'] = strip_tags($new_instance['readmore']);
	$instance['rmtext'] = strip_tags($new_instance['rmtext']);
	$instance['adsense'] = strip_tags($new_instance['adsense']);
	$instance['style'] = strip_tags($new_instance['style']);
	
	return $instance;
}

function widget($args, $instance) {
	
$language_file = 'postfeature';

if ($instance['notext']) $instance['alignment'] = 'notext';
	
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

$fpw_tags = $imagetags->get_tags($post, 'postfeature_cache', $language_file);

$fpw_image_alt = $fpw_tags['image_alt'];
$fpw_image_title = $fpw_tags['image_title'];
$fpw_title_tag = $fpw_tags['title_tag'];

$fpw_style = ($instance['alignment'] != 'notext' && $instance['alignment'] != 'none') ? ' style="text-align: '.$instance['alignment'].';"' : '';

$eol = "\r\n";

// headline, if wanted

if ($instance['headline'] != 'none') :

	$head_class = ($instance['class']) ? ' class="'.$instance['headclass'].'"' : '';
	
	$fpw_headline = $eol.'<p'.$head_class.$fpw_style.'><a href="'.get_permalink().'" title="'.$fpw_title_tag.'">'.get_the_title().'</a></p>';
	
endif;

if ($instance['date'] != 'none') :

	$date_class = ($instance['class']) ? ' class="'.$instance['dateclass'].'"' : '';
	
	$post_date = $eol.'<p'.$date_class.$fpw_style.'>'.get_the_date().'</p>';

endif;

// thumbnail, if wanted

if (!$instance['thumb']) :
	
	if ($instance['image']) : 
	
		$args = array (
		'content' => $post->post_content,
		'width' => $instance['width'],
		'option' => 'postfeature_cache',
		'number' => $instance['image']
		);
		   
		$fpw_image = new A5_Thumbnail;
	
		$fpw_image_info = $fpw_image->get_thumbnail($args);
		
		$fpw_thumb = $fpw_image_info['thumb'];
		
		$fpw_width = $fpw_image_info['thumb_width'];

		$fpw_height = $fpw_image_info['thumb_height'];
		
		$fpw_float = ($instance['alignment'] != 'notext') ? $instance['alignment'] : 'none';
		
		if ($instance['alignment'] == 'left') $fpw_margin = ' margin-right: 1em;';
		if ($instance['alignment'] == 'right') $fpw_margin = ' margin-left: 1em;';
		
		if ($fpw_thumb) :
		
			if ($fpw_width) $fpw_img_tag = '<img title="'.$fpw_image_title.'" src="'.$fpw_thumb.'" alt="'.$fpw_image_alt.'" width="'.$fpw_width.'" height="'.$fpw_height.'" style="float: '.$fpw_float.';'.$fpw_margin.'" />';
				
			else $fpw_img_tag = '<img title="'.$fpw_image_title.'" src="'.$fpw_thumb.'" alt="'.$fpw_image_alt.'" style="maxwidth: '.$instance['width'].'; float: '.$fpw_float.';'.$fpw_margin.'" />';
			
		endif;
		
	else :
	
		$fpw_img_tag = get_the_post_thumbnail();
	
	endif;
	
		$fpw_image = '<a href="'.get_permalink().'">'.$fpw_img_tag.'</a>'.$eol;
	
endif;

// excerpt, if wanted

if (!$instance['alignment'] != 'notext') :

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

	$fpw_text = str_replace('<p>', '<p'.$fpw_style.'>', apply_filters('excerpt', A5_Excerpt::get_excerpt($args)));

endif;

// writing the stuff in the widget

if ($instance['headline'] == 'top') echo $fpw_headline.$eol;

if ($instance['date'] == 'top') echo $post_date.$eol;

if (!$instance['thumb']) echo $fpw_image;

if ($instance['alignment'] == 'left' || $instance['alignment'] == 'right') echo $eol.do_shortcode($fpw_text).$eol;

echo '<div style="clear: both;"></div>'.$eol;

if ($instance['headline'] == 'bottom') echo $fpw_headline.$eol;

if ($instance['alignment'] == 'none') echo do_shortcode($fpw_text).$eol;

if ($instance['date'] == 'bottom') echo $post_date.$eol;

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