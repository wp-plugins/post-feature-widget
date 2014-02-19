<?php
/*
Plugin Name: Featured Post Widget
Plugin URI: http://wasistlos.waldemarstoffel.com/plugins-fur-wordpress/featured-post-widget
Description: Featured Post Widget is yet another plugin to make your blog a bit more newspaper-like. Just by choosing a post from a dropdown, you can put it in the 'featured' area and display thumbnail, headline, excerpt or all three of them (if available) in the fully customizable widget.
Version: 3.5
Author: Waldemar Stoffel
Author URI: http://www.waldemarstoffel.com
License: GPL3
Text Domain: postfeature
*/

/*  Copyright 2010 - 2014  Waldemar Stoffel  (email : stoffel@atelier-fuenf.de)

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

if(preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF'])) die('Sorry, you don\'t have direct access to this page.');

/* load classes */

define( 'PFW_PATH', plugin_dir_path(__FILE__) );

if (!class_exists('A5_Image')) require_once PFW_PATH.'class-lib/A5_ImageClass.php';
if (!class_exists('A5_Excerpt')) require_once PFW_PATH.'class-lib/A5_ExcerptClass.php';
if (!class_exists('A5_FormField')) require_once PFW_PATH.'class-lib/A5_FormFieldClass.php';
if (!class_exists('Featured_Post_Widget')) require_once PFW_PATH.'class-lib/FP_WidgetClass.php';
if (!class_exists('A5_DynamicCSS')) :

	require_once PFW_PATH.'class-lib/A5_DynamicCSSClass.php';
	
	$dynamic_css = new A5_DynamicCSS;
	
endif;

class PostFeaturePlugin {
	
	const language_file = 'postfeature';

	function __construct() {

		/* import laguage files */
		
		load_plugin_textdomain(self::language_file, false , basename(dirname(__FILE__)).'/languages');
		
		add_action('admin_enqueue_scripts', array($this, 'register_scripts'));
		add_filter('plugin_row_meta', array($this, 'register_links'),10,2);
		register_activation_hook(__FILE__, array($this, 'install'));
		register_deactivation_hook(__FILE__, array($this, 'uninstall'));
		
		// attach CSS and write your name in the comments
		
		$eol = "\r\n";
		$tab = "\t";
		
		A5_DynamicCSS::$styles .= $eol.'/* CSS portion of the Featured Post Widget */'.$eol.$eol;
		
		A5_DynamicCSS::$styles.='div[id^="featured_post_widget"].widget_featured_post_widget img {'.$eol.$tab.'height: auto;'.$eol.$tab.'max-width: 100%;'.$eol.'}'.$eol;
		
		A5_DynamicCSS::$styles.='div[id^="featured_post_widget"].widget_featured_post_widget {'.$eol.$tab.'-moz-hyphens: auto;'.$eol.$tab.'-o-hyphens: auto;'.$eol.$tab.'-webkit-hyphens: auto;'.$eol.$tab.'-ms-hyphens: auto;'.$eol.$tab.'hyphens: auto; '.$eol.'}'.$eol;
		
	}
	
	function install() {
		
		$default = array(
			'tags' => array(),
			'sizes' => array()
		);
	
		add_option('postfeature_cache', $default);
	
	}
	
	function uninstall() {
	
		delete_option('postfeature_cache');
	
	}
	
	/* attach JavaScript file for textarea reszing */
	
	function register_scripts($hook) {
		
		if ($hook != 'widgets.php') return;
		
		wp_register_script('ta-expander-script', plugins_url('ta-expander.js', __FILE__), array('jquery'), '2.0', true);
		wp_enqueue_script('ta-expander-script');
	
	
	}
	
	/* Additional links on the plugin page */
	
	function register_links($links, $file) {
		
		$base = plugin_basename(__FILE__);
		if ($file == $base) :
		
			$links[] = '<a href="http://wordpress.org/extend/plugins/post-feature-widget/faq/" target="_blank">'.__('FAQ', self::language_file).'</a>';
			$links[] = '<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=D8AVGNDYYUNA2" target="_blank">'.__('Donate', self::language_file).'</a>';
		
		endif;
		
		return $links;
	
	}

} // class

$PostFeaturePlugin = new PostFeaturePlugin;

?>