=== Featured Post Widget ===
Contributors: tepelstreel
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=D8AVGNDYYUNA2
Tags: sidebar, widget, post, newspaper, feature, featured, image
Requires at least: 2.7
Tested up to: 3.3
Stable tag: 2.1

With the Featured Post Widget you can put a certain post in the focus and style it differently.

== Description ==

The Featured Post Widget is a customizable multiwidget, that displays a single post in the widget area. You can decide, whether or not the post thumbnail is displayed, whether the post title is above or beneath the thumbnail and a couple of more things. And of course, you can style the widget individually.

The plugin was tested up to WP 3.3 and should work with versions down to 2.7 but was never tested.

== Installation ==

1. Upload the `post-feature-widget` folder to the `/wp-content/plugins/` directory
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
 
to the widget style to get a nice shadow down right of the container. This is not supported by all browsers yet, but should work in almost all of them.

== Screenshots ==

1. The plugin's work on our testingsite
2. The widget's settings section

== Changelog ==

= 2.1 =

* Minor bugfix, showing the excerpt.

= 2.0 =

* The widget now supports a customizable 'read more' link.

= 1.9 =

* Trying to get expandable textareas work.

= 1.8.2 =

* Bugfix with backup post; plugin works now also with slugs.

= 1.8.1 =

* Small bugfix with the backup post.

= 1.8 =

* A second post can now be defined as a backup, that will show up, if the widget is showing on a single post page, showing the feaured post. Just to avoid doublettes.

= 1.7 =

* Small changes in the handling that provide more accurate working.

= 1.6 =

* Dutch translation added.

= 1.5 =

* German translation added.

= 1.0 =

* Initial release

== Upgrade Notice ==

= 1.5 =

The Featured Post Widget is now available with German translation

= 1.6 =

The Featured Post Widget is now available with Dutch translation

= 1.7 =

Small changes in the handling that provide more accurate working

= 1.8 =

A second post can now be defined as a backup, that will show up, if the widget is showing on a single post page, showing the featured post. Just to avoid doublettes.

= 1.8.1 =

Small bugfix with the backup post

= 1.8.2 =

Backup post works now with slugs and id's

= 1.9 =

Expandable teaxtareas

= 2.0 =

You can now define a 'read more' link for the featured post

= 2.1 =

Bugfix with excerpt