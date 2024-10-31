=== Rotating Posts ===
Contributors: YukataNinja
Donate link: http://mark.inderhees.net/donate/
Tags: rotating posts, rotating, posts, news, news feed, news site
Requires at least: 2.7
Tested up to: 3.3.1
Stable tag: 1.11

Rotating Posts allows you to easily create customizable rotating posts like those seen on popular news sites.

== Description ==

Create rotating posts like those seen on popular news sites.  The plugin is highly customizable to fit your theme and desires.

[See an example](http://demo.inderhees.net/)

[See a customized CSS example](http://www.weareecs.com)

If you use this plugin and want to share your site or theme, please post about it in the [forum](http://wordpress.org/tags/rotating-posts?forum_id=10).

If you translate this plugin or are interested in translating, please let me know on the [forum](http://wordpress.org/tags/rotating-posts?forum_id=10).

== Installation ==

1. Unzip in your plugins directory.
1. Activate the plugin through the 'Plugins' menu in WordPress.
1. Customize settings under the main Settings menu -> Rotating Posts
1. Insert into your theme or page
	* Add `[rotating-posts]` to any page. Or
	* Add `<?php rotating_posts(); ?>` to your theme.  Most usually in index.php.
1. If desired, create your own CSS.

== Frequently Asked Questions ==

= Where exactly do I put the php tag? =

If you use the default theme and want your site to look like the [demo site](http://demo.inderhees.net) then your index.php should look like this:
`
<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header(); ?>

	<div id="content" class="narrowcolumn">

<?php rotating_posts(); ?>

	</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>`

= Can I have multiple Rotating Posts with different categories? =

Yes!  As of 1.10 you can use a new attribute in the shortcode:

`[rotating-posts category_name="Soccer"]`

If your category name has a space in it then you need to use the URL friendly slug you set.  Say the category name is "Seattle Sounders FC" and the slug is "ssfc" then your short code would be:

`[rotating-posts category_name="ssfc"]`

== Screenshots ==

1. With graphics
2. No graphics
3. Rotating Posts Admin

== Changelog ==

= 1.11 =
* Bug: http used when site is https

= 1.10 =
* Released June 25, 2010
* Feature: Shortcode now has option of category_name=""

= 1.01 =
* Bug: Changed links in readme
* Bug: Should only show debug info when ?debug in url
* Bug: Performance increases
* Bug: Remove settings on uninstall

= 1.0 =
* Feature: Randomize Posts
* Feature: Show Custom Field instead of post content
* Feature: Instert into page instead of theme
* CSS: "line-height: normal" for p in rp_post_content
* Code format: tabs instead of spaces
	
= 0.9.1.3 =
* Optionally display title
* Set text before author, default is by
* Supports translations
* Added language pseudoloc ps_PS

= 0.9 =
* Original Version

== Upgrade Notice ==

= 1.10 =
Add new feature, the option to have category_name in the shortcode.