<?php
/*
 * Wordpress admin option menu for Rotating Posts plugin.
 */

function rp_option_menu()
{
  load_plugin_textdomain("rotating-posts", str_replace(ABSPATH, "", dirname(__FILE__) . "/lang") , dirname(plugin_basename(__FILE__)) . "/lang");
  
	$hidden_field_name      = "rp_submit_hidden";
	$str_number_posts       = __("Number of posts", 'rotating-posts');
	$str_timer_sec          = __("Duration between rotations", 'rotating-posts');
	$str_thumbnails         = __("Display thumbnails", 'rotating-posts');
	$str_arrows             = __("Display graphic arrows", 'rotating-posts');
	$str_date_time          = __("Display date and time", 'rotating-posts');
	$str_date_time_str      = __("date and time format string", 'rotating-posts');
	$str_title              = __("Display title", 'rotating-posts');
	$str_author             = __("Display author", 'rotating-posts');
	$str_author_prefix      = __("prefix before author", 'rotating-posts');
	$str_categories         = __("Display categories", 'rotating-posts');
	$str_comments           = __("Display comments", 'rotating-posts');
	$str_random_posts       = __("Display random posts", 'rotating-posts');
	$str_custom_content     = __("Display custom field instead of post content", 'rotating-posts');
	$str_left               = __("Left button", 'rotating-posts');
	$str_right              = __("Right button", 'rotating-posts');
	$str_pause_normal       = __("Pause button", 'rotating-posts');
	$str_pause_pressed      = __("Pause button pressed", 'rotating-posts');
	$str_override_css       = __("Override css", 'rotating-posts');
	$str_read_more          = __("'Read more' link text", 'rotating-posts');

	$str_error_text = "<div class='updated'><p><strong>" . sprintf(__("Error in %s using default of %s", 'rotating-posts'), "<i>%s</i>", "<u>%s</u>") . "</strong></p></div>\n";

	if (isset($_POST[$hidden_field_name]))
	{
		echo "<div class='updated'><p><strong>" . __("Settings saved", 'rotating-posts') . "</strong></p></div>\n";

		if ("" != $_POST[RP_OPTION_NUMBER_POSTS] && $_POST[RP_OPTION_NUMBER_POSTS] > 0)
		{
			update_option(RP_OPTION_NUMBER_POSTS, $_POST[RP_OPTION_NUMBER_POSTS]);
		}
		else
		{
			printf($str_error_text, $str_number_posts, RP_OPTION_NUMBER_POSTS_DEFAULT);
			update_option(RP_OPTION_NUMBER_POSTS, RP_OPTION_NUMBER_POSTS_DEFAULT);
		}

		if ("" != $_POST[RP_OPTION_TIMER_SEC] && $_POST[RP_OPTION_TIMER_SEC] > 0)
		{
			update_option(RP_OPTION_TIMER_SEC, $_POST[RP_OPTION_TIMER_SEC]);
		}
		else
		{
			printf($str_error_text, $str_timer_sec, RP_OPTION_TIMER_SEC_DEFAULT);
			update_option(RP_OPTION_TIMER_SEC, RP_OPTION_TIMER_SEC_DEFAULT);
		}

		if ("true" == $_POST[RP_OPTION_THUMBNAILS])
		{
			update_option(RP_OPTION_THUMBNAILS, "true");
		}
		else
		{
			update_option(RP_OPTION_THUMBNAILS, "false");
		}

		if ("true" == $_POST[RP_OPTION_ARROWS])
		{
			update_option(RP_OPTION_ARROWS, "true");
		}
		else
		{
			update_option(RP_OPTION_ARROWS, "false");
		}

		if ("true" == $_POST[RP_OPTION_DATE_TIME])
		{
			update_option(RP_OPTION_DATE_TIME, "true");
		}
		else
		{
			update_option(RP_OPTION_DATE_TIME, "false");
		}

		if ("" != $_POST[RP_OPTION_DATE_TIME_STR])
		{
			update_option(RP_OPTION_DATE_TIME_STR, $_POST[RP_OPTION_DATE_TIME_STR]);
		}
		else
		{
			printf($str_error_text, $str_date_time_str, RP_OPTION_DATE_TIME_STR_DEFAULT);
			update_option(RP_OPTION_DATE_TIME_STR, RP_OPTION_DATE_TIME_STR_DEFAULT);
		}

		if ("true" == $_POST[RP_OPTION_TITLE])
		{
			update_option(RP_OPTION_TITLE, "true");
		}
		else
		{
			update_option(RP_OPTION_TITLE, "false");
		}

		if ("true" == $_POST[RP_OPTION_AUTHOR])
		{
			update_option(RP_OPTION_AUTHOR, "true");
		}
		else
		{
			update_option(RP_OPTION_AUTHOR, "false");
		}

		if ("" != $_POST[RP_OPTION_AUTHOR_PREFIX])
		{
			update_option(RP_OPTION_AUTHOR_PREFIX, $_POST[RP_OPTION_AUTHOR_PREFIX]);
		}
		else
		{
			printf($str_error_text, $str_author_prefix, RP_OPTION_AUTHOR_PREFIX_DEFAULT);
			update_option(RP_OPTION_AUTHOR_PREFIX, RP_OPTION_AUTHOR_PREFIX_DEFAULT);
		}

		if ("true" == $_POST[RP_OPTION_CATEGORIES])
		{
			update_option(RP_OPTION_CATEGORIES, "true");
		}
		else
		{
			update_option(RP_OPTION_CATEGORIES, "false");
		}

		if ("true" == $_POST[RP_OPTION_COMMENTS])
		{
			update_option(RP_OPTION_COMMENTS, "true");
		}
		else
		{
			update_option(RP_OPTION_COMMENTS, "false");
		}

		if ("true" == $_POST[RP_OPTION_RANDOM_POSTS])
		{
			update_option(RP_OPTION_RANDOM_POSTS, "true");
		}
		else
		{
			update_option(RP_OPTION_RANDOM_POSTS, "false");
		}

		if ("true" == $_POST[RP_OPTION_CUSTOM_CONTENT])
		{
			update_option(RP_OPTION_CUSTOM_CONTENT, "true");
		}
		else
		{
			update_option(RP_OPTION_CUSTOM_CONTENT, "false");
		}

		if ("" != $_POST[RP_OPTION_USE_THIS_CATEGORY])
		{
			update_option(RP_OPTION_USE_THIS_CATEGORY, $_POST[RP_OPTION_USE_THIS_CATEGORY]);
		}

		if ("" != $_POST[RP_OPTION_LEFT])
		{
			update_option(RP_OPTION_LEFT, $_POST[RP_OPTION_LEFT]);
		}
		else
		{
			printf($str_error_text, $str_left, RP_OPTION_LEFT_DEFAULT);
			update_option(RP_OPTION_LEFT, RP_OPTION_LEFT_DEFAULT);
		}

		if ("" != $_POST[RP_OPTION_RIGHT])
		{
			update_option(RP_OPTION_RIGHT, $_POST[RP_OPTION_RIGHT]);
		}
		else
		{
			printf($str_error_text, $str_right, RP_OPTION_RIGHT_DEFAULT);
			update_option(RP_OPTION_RIGHT, RP_OPTION_RIGHT_DEFAULT);
		}

		if ("" != $_POST[RP_OPTION_PAUSE_NORMAL])
		{
			update_option(RP_OPTION_PAUSE_NORMAL, $_POST[RP_OPTION_PAUSE_NORMAL]);
		}
		else
		{
			printf($str_error_text, $str_pause_normal, RP_OPTION_PAUSE_NORMAL_DEFAULT);
			update_option(RP_OPTION_PAUSE_NORMAL, RP_OPTION_PAUSE_NORMAL_DEFAULT);
		}

		if ("" != $_POST[RP_OPTION_PAUSE_PRESSED])
		{
			update_option(RP_OPTION_PAUSE_PRESSED, $_POST[RP_OPTION_PAUSE_PRESSED]);
		}
		else
		{
			printf($str_error_text, $str_pause_pressed, RP_OPTION_PAUSE_PRESSED_DEFAULT);
			update_option(RP_OPTION_PAUSE_PRESSED, RP_OPTION_PAUSE_PRESSED_DEFAULT);
		}

		if ("true" == $_POST[RP_OPTION_OVERRIDE_CSS])
		{
			update_option(RP_OPTION_OVERRIDE_CSS, "true");
		}
		else
		{
			update_option(RP_OPTION_OVERRIDE_CSS, "false");
		}

		if ("" != $_POST[RP_OPTION_READ_MORE])
		{
			update_option(RP_OPTION_READ_MORE, $_POST[RP_OPTION_READ_MORE]);
		}
		else
		{
			printf($str_error_text, $str_read_more, RP_OPTION_READ_MORE_DEFAULT);
			update_option(RP_OPTION_READ_MORE, RP_OPTION_READ_MORE_DEFAULT);
		}
	}

	?>
		<div class="wrap">
			<h2><?php _e("Rotating Posts", 'rotating-posts'); ?></h2>
			<form name="form1" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
				<input type="hidden" name="<?php echo $hidden_field_name; ?>" value="submit">
				<table class="form-table">
					<tr valign="top">
						<th scope="row"><?php echo $str_number_posts; ?></th>
						<td><input type="text" name="<?php echo RP_OPTION_NUMBER_POSTS; ?>" value="<?php echo get_option(RP_OPTION_NUMBER_POSTS); ?>" class="small-text"/></td>
					</tr>
					<tr valign="top">
						<th scope="row"><?php echo $str_timer_sec; ?></th>
						<td>
							<input type="text" name="<?php echo RP_OPTION_TIMER_SEC; ?>" value="<?php echo get_option(RP_OPTION_TIMER_SEC); ?>" class="small-text"/>
							<span class="setting-description"><?php _e("seconds", 'rotating-posts'); ?></span>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><?php echo $str_read_more; ?></th>
						<td>
							<input type="text" name="<?php echo RP_OPTION_READ_MORE; ?>" value="<?php echo get_option(RP_OPTION_READ_MORE); ?>" />
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><?php _e("Display options", 'rotating-posts'); ?></th>
						<td>
							<input type="checkbox" name="<?php echo RP_OPTION_TITLE; ?>" value="true" <?php if("true" == get_option(RP_OPTION_TITLE)){echo "checked";} ?>/> <?php echo $str_title; ?><br/>
							<input type="checkbox" name="<?php echo RP_OPTION_DATE_TIME; ?>" value="true" <?php if("true" == get_option(RP_OPTION_DATE_TIME)){echo "checked";} ?>/> <?php echo $str_date_time; ?> <?php _e("with", 'rotating-posts'); ?>
								<?php echo $str_date_time_str; ?> <input type="text" name="<?php echo RP_OPTION_DATE_TIME_STR; ?>" value="<?php echo get_option(RP_OPTION_DATE_TIME_STR); ?>" />
								<span class="setting-description"><?php printf(__("See WordPress document on %s", 'rotating-posts'), "<a href='http://codex.wordpress.org/Formatting_Date_and_Time'>" . __("Formatting Date and Time", 'rotating-posts') . "</a>."); ?></span><br/>
							<input type="checkbox" name="<?php echo RP_OPTION_AUTHOR; ?>" value="true" <?php if("true" == get_option(RP_OPTION_AUTHOR)){echo "checked";} ?>/> <?php echo $str_author; ?> <?php _e("with", 'rotating-posts'); ?>
								<?php echo $str_author_prefix; ?> <input type="text" name="<?php echo RP_OPTION_AUTHOR_PREFIX; ?>" value="<?php echo get_option(RP_OPTION_AUTHOR_PREFIX); ?>" /><br/>
							<input type="checkbox" name="<?php echo RP_OPTION_CATEGORIES; ?>" value="true" <?php if("true" == get_option(RP_OPTION_CATEGORIES)){echo "checked";} ?>/> <?php echo $str_categories; ?><br/>
							<input type="checkbox" name="<?php echo RP_OPTION_COMMENTS; ?>" value="true" <?php if("true" == get_option(RP_OPTION_COMMENTS)){echo "checked";} ?>/> <?php echo $str_comments; ?><br/>
							<input type="checkbox" name="<?php echo RP_OPTION_ARROWS; ?>" value="true" <?php if("true" == get_option(RP_OPTION_ARROWS)){echo "checked";} ?>/> <?php echo $str_arrows; ?><br/>
							<input type="checkbox" name="<?php echo RP_OPTION_THUMBNAILS; ?>" value="true" <?php if("true" == get_option(RP_OPTION_THUMBNAILS)){echo "checked";} ?>/> <?php echo $str_thumbnails; ?>.
								<span class="setting-description"><?php printf(__("If checked, add a custom field to each post with name %s and the thumbnail URL as the value.", 'rotating-posts'), "<strong>rp_thumbnail</strong>"); ?></span>
								<span class="setting-description"><?php printf(__("This can be done in the %s section when adding or editing a post.", 'rotating-posts'), "<strong>" . __("Custom Fields", 'rotating-posts') . "</strong>"); ?></span><br/>
							<input type="checkbox" name="<?php echo RP_OPTION_OVERRIDE_CSS; ?>" value="true" <?php if("true" == get_option(RP_OPTION_OVERRIDE_CSS)){echo "checked";} ?>/> <?php echo $str_override_css; ?>.
								<span class="setting-description"><?php printf(__("If checked, you can customize the CSS for Rotating Posts in your theme's CSS file. Use the %s to get started.", 'rotating-posts'), "<a href='" . ROTATING_POSTS_URL_CSS . "'>" . __("provided CSS", 'rotating-posts') . "</a>"); ?></span><br/>
							<input type="checkbox" name="<?php echo RP_OPTION_CUSTOM_CONTENT; ?>" value="true" <?php if("true" == get_option(RP_OPTION_CUSTOM_CONTENT)){echo "checked";} ?>/> <?php echo $str_custom_content; ?>.
								<span class="setting-description"><?php printf(__("If checked, add a custom field to each post with name %s and the customized content as the value. For example, this could be used to insert an image instead of the content of your post.", 'rotating-posts'), "<strong>rp_content</strong>"); ?></span>
								<span class="setting-description"><?php printf(__("This can be done in the %s section when adding or editing a post.", 'rotating-posts'), "<strong>" . __("Custom Fields", 'rotating-posts') . "</strong>"); ?></span><br/>
							<input type="checkbox" name="<?php echo RP_OPTION_RANDOM_POSTS; ?>" value="true" <?php if("true" == get_option(RP_OPTION_RANDOM_POSTS)){echo "checked";} ?>/> <?php echo $str_random_posts; ?>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><?php _e("Show posts from category", 'rotating-posts'); ?></th>
						<td>
							<select name="<?php echo RP_OPTION_USE_THIS_CATEGORY; ?>">
								<option value="0" <?php if("0" == get_option(RP_OPTION_USE_THIS_CATEGORY)){echo "selected";}?>><?php _e("Show all categories", 'rotating-posts'); ?></option>
								<?php wp_dropdown_cats(NULL, get_option(RP_OPTION_USE_THIS_CATEGORY)); ?>
							</select>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><?php _e("Change navigation buttons", 'rotating-posts'); ?></th>
						<td>
							<img src="<?php echo get_option(RP_OPTION_LEFT); ?>" style="vertical-align:middle;"/><input type="text" name="<?php echo RP_OPTION_LEFT; ?>" value="<?php echo get_option(RP_OPTION_LEFT); ?>" class="regular-text code"/> <?php echo $str_left; ?><br/>
							<img src="<?php echo get_option(RP_OPTION_RIGHT); ?>" style="vertical-align:middle;"/><input type="text" name="<?php echo RP_OPTION_RIGHT; ?>" value="<?php echo get_option(RP_OPTION_RIGHT); ?>" class="regular-text code"/> <?php echo $str_right; ?><br/>
							<img src="<?php echo get_option(RP_OPTION_PAUSE_NORMAL); ?>" style="vertical-align:middle;"/><input type="text" name="<?php echo RP_OPTION_PAUSE_NORMAL; ?>" value="<?php echo get_option(RP_OPTION_PAUSE_NORMAL); ?>" class="regular-text code"/> <?php echo $str_pause_normal; ?><br/>
							<img src="<?php echo get_option(RP_OPTION_PAUSE_PRESSED); ?>" style="vertical-align:middle;"/><input type="text" name="<?php echo RP_OPTION_PAUSE_PRESSED; ?>" value="<?php echo get_option(RP_OPTION_PAUSE_PRESSED); ?>" class="regular-text code"/> <?php echo $str_pause_pressed; ?><br/>
						</td>
					</tr>
				</table>
				<p class="submit">
					<input type="submit" class="button-primary" value="<?php _e('Save Changes', 'rotating-posts') ?>" />
				</p>
			</form>
		</div>

	<?php
}
?>