<?php
/*
Plugin Name: Rotating Posts
Plugin URI: http://wordpress.org/extend/plugins/rotating-posts/
Description: Easily create customizable rotating posts like those seen on popular news sites.
Version: 1.11
Author: Mark Inderhees
Author URI: http://mark.inderhees.net
Text Domain: rotating-posts

---------------------------------------------------------------------
This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You can see a copy of GPL at <http://www.gnu.org/licenses/>
---------------------------------------------------------------------
*/
define("RP_VERSION", "1.11");

define("ROTATING_POSTS_DIR", dirname(__FILE__));
define("ROTATING_POSTS_URL", plugins_url() . "/" . dirname(plugin_basename(__FILE__)));
define("ROTATING_POSTS_URL_CSS", ROTATING_POSTS_URL . "/rotating-posts.css");

define("RP_OPTION_VERSION", "rp_version");
define("RP_OPTION_NUMBER_POSTS", "rp_number_posts");
define("RP_OPTION_NUMBER_POSTS_DEFAULT", "5");
define("RP_OPTION_TIMER_SEC", "rp_timer_sec");
define("RP_OPTION_TIMER_SEC_DEFAULT", "5");
define("RP_OPTION_THUMBNAILS", "rp_thumbnails");
define("RP_OPTION_THUMBNAILS_DEFAULT", "false");
define("RP_OPTION_ARROWS", "rp_arrows");
define("RP_OPTION_ARROWS_DEFAULT", "false");
define("RP_OPTION_TITLE", "rp_title");
define("RP_OPTION_TITLE_DEFAULT", "true");
define("RP_OPTION_DATE_TIME", "rp_date_time");
define("RP_OPTION_DATE_TIME_DEFAULT", "true");
define("RP_OPTION_DATE_TIME_STR", "rp_date_time_str");
define("RP_OPTION_DATE_TIME_STR_DEFAULT", "F jS, Y");
define("RP_OPTION_AUTHOR", "rp_author");
define("RP_OPTION_AUTHOR_DEFAULT", "true");
define("RP_OPTION_AUTHOR_PREFIX", "rp_author_prefix");
define("RP_OPTION_AUTHOR_PREFIX_DEFAULT", __("by", 'rotating-posts'));
define("RP_OPTION_CATEGORIES", "rp_categories");
define("RP_OPTION_CATEGORIES_DEFAULT", "true");
define("RP_OPTION_COMMENTS", "rp_comments");
define("RP_OPTION_COMMENTS_DEFAULT", "true");
define("RP_OPTION_USE_THIS_CATEGORY", "rp_use_this_category");
define("RP_OPTION_USE_THIS_CATEGORY_DEFAULT", "0");
define("RP_OPTION_LEFT", "rp_left");
define("RP_OPTION_LEFT_DEFAULT", ROTATING_POSTS_URL . "/images/left.jpg");
define("RP_OPTION_RIGHT", "rp_right");
define("RP_OPTION_RIGHT_DEFAULT", ROTATING_POSTS_URL . "/images/right.jpg");
define("RP_OPTION_PAUSE_NORMAL", "rp_pause_normal");
define("RP_OPTION_PAUSE_NORMAL_DEFAULT", ROTATING_POSTS_URL . "/images/pause.jpg");
define("RP_OPTION_PAUSE_PRESSED", "rp_pause_pressed");
define("RP_OPTION_PAUSE_PRESSED_DEFAULT", ROTATING_POSTS_URL . "/images/pause_on.jpg");
define("RP_OPTION_OVERRIDE_CSS", "rp_override_css");
define("RP_OPTION_OVERRIDE_CSS_DEFAULT", "false");
define("RP_OPTION_READ_MORE", "rp_read_more");
define("RP_OPTION_READ_MORE_DEFAULT", "<br/>" . __("Read more", 'rotating-posts'));
define("RP_OPTION_RANDOM_POSTS", "rp_random_posts");
define("RP_OPTION_RANDOM_POSTS_DEFAULT", "false");
define("RP_OPTION_CUSTOM_CONTENT", "rp_custom_content");
define("RP_OPTION_CUSTOM_CONTENT_DEFAULT", "false");

include_once(ROTATING_POSTS_DIR . "/rp-admin.php");

function rotating_posts($category_name = '')
{
	if (isset($_GET["debug"]))
	{
		define("RP_DEBUG", true);
	}
	
	load_plugin_textdomain("rotating-posts", str_replace(ABSPATH, "", dirname(__FILE__) . "/lang") , dirname(plugin_basename(__FILE__)) . "/lang");

	$rp_number_posts			= get_option(RP_OPTION_NUMBER_POSTS);
	$rp_use_this_category		= get_option(RP_OPTION_USE_THIS_CATEGORY);
	$rp_timer_sec				= get_option(RP_OPTION_TIMER_SEC);
	$rp_display_thumbnails		= ("true" == get_option(RP_OPTION_THUMBNAILS));
	$rp_display_title			= ("true" == get_option(RP_OPTION_TITLE));
	$rp_display_arrows			= ("true" == get_option(RP_OPTION_ARROWS));
	$rp_display_date_time		= ("true" == get_option(RP_OPTION_DATE_TIME));
	$rp_display_author			= ("true" == get_option(RP_OPTION_AUTHOR));
	$rp_display_categories		= ("true" == get_option(RP_OPTION_CATEGORIES));
	$rp_display_comments		= ("true" == get_option(RP_OPTION_COMMENTS));
	$rp_custom_content			= ("true" == get_option(RP_OPTION_CUSTOM_CONTENT));
	$rp_left					= get_option(RP_OPTION_LEFT);
	$rp_right					= get_option(RP_OPTION_RIGHT);
	$rp_pause_normal			= get_option(RP_OPTION_PAUSE_NORMAL);
	$rp_pause_pressed			= get_option(RP_OPTION_PAUSE_PRESSED);

	echo "<div id='rp_frame'>\n";

	$rp_query = "";
	$rp_query .= "showposts={$rp_number_posts}&";
	if ('' == $category_name)
	{
		$rp_query .= "cat={$rp_use_this_category}";
	}
	else
	{
		$rp_query .= "category_name={$category_name}";
	}
	
	if ("true" == get_option(RP_OPTION_RANDOM_POSTS))
	{
		$rp_query .= "&orderby=rand";
	}

	$rp_WPQuery = new WP_Query($rp_query);

	if ($rp_WPQuery->post_count < $rp_number_posts)
	{
		// override value with actual count
		$rp_number_posts = $rp_WPQuery->post_count;
	}

	if (defined("RP_DEBUG"))
	{
		echo $rp_query . "\n";
		echo $rp_number_posts . "\n";
	}

	if ($rp_WPQuery->have_posts())
	{
		for ($count = 0; $count < $rp_number_posts; $count++)
		{
			$rp_WPQuery->the_post();

			global $more;
			$more = false;

			if (0 == $count)
			{
				$postStyle = "";
			}
			else
			{
				$postStyle = "display:none;";
			}
			$postPermalink = get_permalink();
			$postTitle = get_the_title();
			$postTime = get_the_time(get_option(RP_OPTION_DATE_TIME_STR));
			$postAuthor = get_the_author();
			$postCategory = get_the_category_list(", ");
			$postComments = get_comments_link();
			$rp_by_author_text = get_option(RP_OPTION_AUTHOR_PREFIX) . " " . $postAuthor;
			$rp_posted_in_category_text = sprintf(__("Posted in %s", 'rotating-posts'), $postCategory);
			$rp_comments_text = __("Comments", 'rotating-posts');

			if (!$rp_custom_content)
			{
				$postContent = get_the_content(get_option(RP_OPTION_READ_MORE));
				$postContent = apply_filters('the_content', $postContent);
				$postContent = str_replace(']]>', ']]&gt;', $postContent);
			}
			else
			{
				$postContentArray = get_post_custom_values("rp_content");
				$postContent = $postContentArray[0];
			}

			echo "<div id='rp_post{$count}' class='rp_post' style='{$postStyle}'>\n";

			if ($rp_display_title)
			{
				echo "        <div class='rp_post_title'><h2><a href='{$postPermalink}'>{$postTitle}</a></h2></div>\n";
			}

			if ($rp_display_date_time && $rp_display_author)
			{
				echo "        <div class='rp_post_time_author'><span class='rp_post_time'>{$postTime}</span><span class='rp_post_author'> {$rp_by_author_text}</span></div>\n";
			}
			else if ($rp_display_date_time)
			{
				echo "        <div class='rp_post_time_author'><span class='rp_post_time'>{$postTime}</span></div>\n";
			}
			else if ($rp_display_author)
			{
				echo "        <div class='rp_post_time_author'><span class='rp_post_author'>{$rp_by_author_text}</span></div>\n";
			}

			echo "        <div class='rp_post_content'>{$postContent}</div>\n";

			if ($rp_display_categories && $rp_display_comments)
			{
				echo "        <p class='rp_post_metadata'>{$rp_posted_in_category_text} | <a href='{$postComments}'>{$rp_comments_text}</a></p>\n";
			}
			else if ($rp_display_categories)
			{
				echo "        <p class='rp_post_metadata'>{$rp_posted_in_category_text}</p>\n";
			}
			else if ($rp_display_comments)
			{
				echo 
					"        <p class='rp_post_metadata'><a href='{$postComments}'>{$rp_comments_text}</a></p>\n";
			}

			echo "    </div>\n";

			$thumbnailURL[$count] = get_post_custom_values("rp_thumbnail");
		}

		echo "    <div id='rp_nav'>\n";
		echo "        <span id='rp_nav_arrows'>\n";
		if ($rp_display_arrows)
		{
			echo "            <a id='rp_nav_left' class='rp_nav_button' onClick='rp_change_text(window.rp_current_post - 1)'><img src='{$rp_left}'/></a>\n";
			echo "            <a id='rp_nav_pause' class='rp_nav_button' onClick='rp_stop_timer()'><img id='rp_nav_pause_normal' src='{$rp_pause_normal}'/><img id='rp_nav_pause_pressed' src='{$rp_pause_pressed}'/></a>\n";
			echo "            <a id='rp_nav_right' class='rp_nav_button' onClick='rp_change_text(window.rp_current_post + 1)'><img src='{$rp_right}'/></a>\n";
		}
		else
		{
			echo "            <a id='rp_nav_left' class='rp_nav_button' onClick='rp_change_text(window.rp_current_post - 1)'><span class='rp_nav_arrow_text'><</span></a>\n";
			echo "            <a id='rp_nav_pause' class='rp_nav_button' onClick='rp_stop_timer()'><span id='rp_nav_pause_normal' class='rp_nav_arrow_text'>||</span><span id='rp_nav_pause_pressed' class='rp_nav_arrow_text'>||</span></a>\n";
			echo "            <a id='rp_nav_right' class='rp_nav_button' onClick='rp_change_text(window.rp_current_post + 1)'><span class='rp_nav_arrow_text'>></span></a>\n";
		}
		echo "        </span>\n";

		echo "        <span id='rp_nav_thumbnails'>\n";
		for ($i = 0; $i < $rp_number_posts; $i++)
		{
			if (0 == $i)
			{
				$thumbnailClass = "rp_nav_thumbnail_on";
			}
			else
			{
				$thumbnailClass = "rp_nav_thumbnail_off";
			}

			if ($rp_display_thumbnails)
			{
				echo "            <a class='rp_nav_thumbnail' onClick='rp_change_text({$i})'><img id='rp_nav_thumbnail{$i}' class='{$thumbnailClass}' src='{$thumbnailURL[$i][0]}'/></a>\n";
			}
			else
			{
				$i_plus = $i + 1;
				echo "            <a class='rp_nav_thumbnail' onClick='rp_change_text({$i})'><span id='rp_nav_thumbnail{$i}' class='{$thumbnailClass}'>{$i_plus}</span></a>\n";
			}
		}
		echo "        </span>\n";
		echo "        <script type='text/javascript'>\n";
		echo "            window.rp_current_post = 0;\n";
		echo "            window.rp_number_posts = {$rp_number_posts};\n";
		echo "            window.rp_timer_sec = {$rp_timer_sec};\n";
		echo "            rp_start_timer();\n";
		echo "        </script>\n";
		echo "    </div>\n";
	}

	echo "</div>\n";
}

function rp_shortcode($atts)
{
	ob_start();
	extract(shortcode_atts(array('category_name' => ''), $atts));
	rotating_posts($category_name);
	$output = ob_get_contents();
	ob_end_clean();

	return $output;
}

function rp_option_menu_init()
{
	add_options_page(__("Rotating Posts Settings", 'rotating-posts'), __("Rotating Posts", 'rotating-posts'), 8, "rp-admin.php", "rp_option_menu");
}

function load_scripts()
{
	wp_enqueue_script("rotatingposts", ROTATING_POSTS_URL . "/rotating-posts.js", false, "1.0");
}

function load_styles()
{
	if ("false" == get_option(RP_OPTION_OVERRIDE_CSS))
	{
		wp_enqueue_style("rotatingposts", ROTATING_POSTS_URL_CSS, false, "1.1");
	}
}

function rp_activate()
{
	//update option values if rp has not been updated yet
	if (version_compare(RP_VERSION, get_option(RP_OPTION_VERSION, ">")))
	{
		update_option(RP_OPTION_VERSION, RP_VERSION);

		if (NULL == get_option(RP_OPTION_NUMBER_POSTS))
		{
			update_option(RP_OPTION_NUMBER_POSTS, RP_OPTION_NUMBER_POSTS_DEFAULT);
		}

		if (NULL == get_option(RP_OPTION_TIMER_SEC))
		{
			update_option(RP_OPTION_TIMER_SEC, RP_OPTION_TIMER_SEC_DEFAULT);
		}

		if (NULL == get_option(RP_OPTION_THUMBNAILS))
		{
			update_option(RP_OPTION_THUMBNAILS, RP_OPTION_THUMBNAILS_DEFAULT);
		}

		if (NULL == get_option(RP_OPTION_ARROWS))
		{
			update_option(RP_OPTION_ARROWS, RP_OPTION_ARROWS_DEFAULT);
		}

		if (NULL == get_option(RP_OPTION_TITLE))
		{
			update_option(RP_OPTION_TITLE, RP_OPTION_TITLE_DEFAULT);
		}

		if (NULL == get_option(RP_OPTION_DATE_TIME))
		{
			update_option(RP_OPTION_DATE_TIME, RP_OPTION_DATE_TIME_DEFAULT);
		}

		if (NULL == get_option(RP_OPTION_DATE_TIME_STR))
		{
			update_option(RP_OPTION_DATE_TIME_STR, RP_OPTION_DATE_TIME_STR_DEFAULT);
		}

		if (NULL == get_option(RP_OPTION_AUTHOR))
		{
			update_option(RP_OPTION_AUTHOR, RP_OPTION_AUTHOR_DEFAULT);
		}

		if (NULL == get_option(RP_OPTION_AUTHOR_PREFIX))
		{
			update_option(RP_OPTION_AUTHOR_PREFIX, RP_OPTION_AUTHOR_PREFIX_DEFAULT);
		}

		if (NULL == get_option(RP_OPTION_CATEGORIES))
		{
			update_option(RP_OPTION_CATEGORIES, RP_OPTION_CATEGORIES_DEFAULT);
		}

		if (NULL == get_option(RP_OPTION_COMMENTS))
		{
			update_option(RP_OPTION_COMMENTS, RP_OPTION_COMMENTS_DEFAULT);
		}

		if (NULL == get_option(RP_OPTION_USE_THIS_CATEGORY))
		{
			update_option(RP_OPTION_USE_THIS_CATEGORY, RP_OPTION_USE_THIS_CATEGORY_DEFAULT);
		}

		if (NULL == get_option(RP_OPTION_LEFT))
		{
			update_option(RP_OPTION_LEFT, RP_OPTION_LEFT_DEFAULT);
		}

		if (NULL == get_option(RP_OPTION_RIGHT))
		{
			update_option(RP_OPTION_RIGHT, RP_OPTION_RIGHT_DEFAULT);
		}

		if (NULL == get_option(RP_OPTION_PAUSE_NORMAL))
		{
			update_option(RP_OPTION_PAUSE_NORMAL, RP_OPTION_PAUSE_NORMAL_DEFAULT);
		}

		if (NULL == get_option(RP_OPTION_PAUSE_PRESSED))
		{
			update_option(RP_OPTION_PAUSE_PRESSED, RP_OPTION_PAUSE_PRESSED_DEFAULT);
		}

		if (NULL == get_option(RP_OPTION_OVERRIDE_CSS))
		{
			update_option(RP_OPTION_OVERRIDE_CSS, RP_OPTION_OVERRIDE_CSS_DEFAULT);
		}

		if (NULL == get_option(RP_OPTION_READ_MORE))
		{
			update_option(RP_OPTION_READ_MORE, RP_OPTION_READ_MORE_DEFAULT);
		}

		if (NULL == get_option(RP_OPTION_RANDOM_POSTS))
		{
			update_option(RP_OPTION_RANDOM_POSTS, RP_OPTION_RANDOM_POSTS_DEFAULT);
		}

		if (NULL == get_option(RP_OPTION_CUSTOM_CONTENT))
		{
			update_option(RP_OPTION_CUSTOM_CONTENT, RP_OPTION_CUSTOM_CONTENT_DEFAULT);
		}
	}
}

function rp_uninstall()
{
	delete_option(RP_OPTION_VERSION);
	delete_option(RP_OPTION_NUMBER_POSTS);
	delete_option(RP_OPTION_TIMER_SEC);
	delete_option(RP_OPTION_THUMBNAILS);
	delete_option(RP_OPTION_ARROWS);
	delete_option(RP_OPTION_TITLE);
	delete_option(RP_OPTION_DATE_TIME);
	delete_option(RP_OPTION_DATE_TIME_STR);
	delete_option(RP_OPTION_AUTHOR);
	delete_option(RP_OPTION_AUTHOR_PREFIX);
	delete_option(RP_OPTION_CATEGORIES);
	delete_option(RP_OPTION_COMMENTS);
	delete_option(RP_OPTION_USE_THIS_CATEGORY);
	delete_option(RP_OPTION_LEFT);
	delete_option(RP_OPTION_RIGHT);
	delete_option(RP_OPTION_PAUSE_NORMAL);
	delete_option(RP_OPTION_PAUSE_PRESSED);
	delete_option(RP_OPTION_OVERRIDE_CSS);
	delete_option(RP_OPTION_READ_MORE);
	delete_option(RP_OPTION_RANDOM_POSTS);
	delete_option(RP_OPTION_CUSTOM_CONTENT);
}

add_action("admin_menu", "rp_option_menu_init");
add_action("wp_print_scripts", "load_scripts");
add_action("wp_print_styles", "load_styles");
register_activation_hook(__FILE__, "rp_activate");
register_uninstall_hook(__FILE__, "rp_uninstall");
add_shortcode('rotating-posts', 'rp_shortcode');
?>
