<?php
/*
Plugin Name: Featured Post Widget
Plugin URI: http://wasistlos.waldemarstoffel.com/plugins-fur-wordpress/featured-post-widget
Description: Featured Post Widget is yet another plugin to make your blog a bit more newspaper-like. Just by choosing a post from a dropdown, you can put it in the 'featured' area and display thumbnail, headline, excerpt or all three of them (if available) in the fully customizable widget.
Version: 3.1
Author: Waldemar Stoffel
Author URI: http://www.waldemarstoffel.com
License: GPL3
Text Domain: postfeature
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

if(preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF'])) die(__('Sorry, you don&#39;t have direct access to this page.'));

/* attach JavaScript file for textarea reszing */

function fpw_js_sheet() {
   
   wp_enqueue_script('ta-expander-script', plugins_url('ta-expander.js', __FILE__), array('jquery'), '2.0', true);

}

add_action('admin_print_scripts-widgets.php', 'fpw_js_sheet');

//Additional links on the plugin page

add_filter('plugin_row_meta', 'fpw_register_links',10,2);

function fpw_register_links($links, $file) {
	
	global $fpw_language_file;
	
	$base = plugin_basename(__FILE__);
	if ($file == $base) :
	
		$links[] = '<a href="http://wordpress.org/extend/plugins/post-feature-widget/faq/" target="_blank">'.__('FAQ', $fpw_language_file).'</a>';
		$links[] = '<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=D8AVGNDYYUNA2" target="_blank">'.__('Donate', $fpw_language_file).'</a>';
	
	endif;
	
	return $links;

}

define( 'PFW_PATH', plugin_dir_path(__FILE__) );

if (!class_exists('A5_Thumbnail')) require_once PFW_PATH.'class-lib/A5_ImageClasses.php';
if (!class_exists('A5_Excerpt')) require_once PFW_PATH.'class-lib/A5_ExcerptClass.php';
if (!class_exists('Featured_Post_Widget')) require_once PFW_PATH.'class-lib/FP_WidgetClass.php';

// import laguage files

$fpw_language_file = 'postfeature';

load_plugin_textdomain($fpw_language_file, false , basename(dirname(__FILE__)).'/languages');

?>