=== Featured Post Widget ===
Contributors: tepelstreel
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=D8AVGNDYYUNA2
Tags: sidebar, widget, post, newspaper, feature
Requires at least: 2.7
Tested up to: 3.1
Stable tag: 1.5

With the Featured Post Widget you can put a certain post in the focus and style it differently.

== Description ==

The Featured Post Widget is a customizable multiwidget, that displays a single post in the widget area. You can decide, whether or not the post thumbnail is displayed, whether the post title is above or beneath the thumbnail and a couple of more things. And of course, you can style the widget individually.

The plugin was tested up to WP 3.1 and should work with versions down to 2.7 but was never tested.

== Installation ==

1. Upload the `postfeature` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Place and customize your widgets
4. Ready

== Frequently Asked Questions ==

= I styled the widget container myself and i looks bad. What do I do? =

The styling of the widget requires some knowledge of css. If you are not familiar with that, try adding

`padding: 10px;
margin-bottom: 10px;`
 
to the style section.

= My widget should have rounded corners, how do I do that? =

Add something like

`-webkit-border-top-left-radius: 5px;
-webkit-border-top-right-radius: 5px;
-moz-border-radius-topleft: 5px;
-moz-border-radius-topright: 5px;
border-top-left-radius: 5px;
border-top-right-radius: 5px;`
 
to the widget style. This is not supported by all browsers yet, but should work in almost all of them.

= My widget should have a shadow, how do I do that? =

Add something like

`-moz-box-shadow: 10px 10px 5px #888888;
-webkit-box-shadow: 10px 10px 5px #888888;
box-shadow: 10px 10px 5px #888888;`
 
to the widget style o get a nice shadow down right of the container. This is not supported by all browsers yet, but should work in almost all of them.

== Screenshots ==

1. The plugin's work on our testingsite
2. The widget's settings section

== Changelog ==

= 1.5 =

* Bugfix for WP versions elder than 2.9

= 1.0 =

* Initial release

== Upgrade Notice ==

= 1.5 =

Bugfix for WP versions elder than 2.9
