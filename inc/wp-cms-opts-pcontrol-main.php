<?php
/**
* Main options page include
*
* @since 2.1
* @lastupdate 3.0
*
*/
?>

<?php

// Setup 2 arrays to hold roles with relevant capabilities for form
global $wp_roles;
$roles = $wp_roles->get_names();
foreach ( $roles as $role_def => $role_def_n ) {
	$all_wp_roles_caps[] = get_role($role_def);
}

// Setup arrays of roles that have required caps
foreach ( $all_wp_roles_caps as $wp_role_caps ) {

	if ( array_key_exists('edit_posts', $wp_role_caps->capabilities) ){
		$wp_role_edit_posts[] = $wp_role_caps->name;
	}

	if ( array_key_exists('edit_pages', $wp_role_caps->capabilities) ){
		$wp_role_edit_pages[] = $wp_role_caps->name;
	}

}
?>

<div class="wrap">

	<div id="icon-options-general" class="icon32"><br /></div>
	<h2>WP-CMS Post Control Publishing Controls</h2>

	<h3><a href="<?php echo admin_url('options-general.php?page=wpcms_pcontrol'); ?>" title="Main post control options">Post Control</a> | <a href="<?php echo admin_url('options-general.php?page=wpcms_pcontrol_ex'); ?>" title="Core WordPress publishing functions">Core Functions</a></h3>

	<form method="post" action="options.php">
		<?php
		//Output nonce, action, and option_page fields for a settings page
		// @param string $option_group A settings group name. IMPORTANT - This should match the group name used in register_setting()
		settings_fields('wpcms_pcontrol_options');
		?>

		<p class="submit">
		<input type="submit" class="button-primary" value="<?php _e('Save Post Control options') ?>" />
		</p>

		<?php $options = get_option('wpcms_pcontrolopts'); ?>

		<div id="icon-themes" class="icon32"><br /></div>
		<h2>Page Controls</h2>
		<p>Check option <strong>to hide page controls </strong> available to different <a href="http://codex.wordpress.org/Roles_and_Capabilities" title="WordPress roles and capabilities">user roles</a>.</p>
		<p>Page creation and editing is only available to administrator and editor level users.</p>


		<table class="form-table">

			<?php
			$mypagecontrols = array(
			'Attributes' => 'pageparentdiv',
			'Author (ONLY if multiple)' => 'authordiv',
			'Custom Fields' => 'postcustom',
			'Discussion' => 'commentstatusdiv',
			'Comments' => 'commentsdiv',
			'Featured Image' => 'postimagediv',
			'Slug' => 'slugdiv',
			'Revisions' => 'revisionsdiv'
			);

			//Generate form from array
			foreach($mypagecontrols as $key => $value) { ?>

			<tr>
				<th scope="row"><?php echo $key; ?></th>
				<td>
					<fieldset>
					<legend class="screen-reader-text"><span><?php echo $key; ?></span></legend>


						<?php

						foreach ($wp_role_edit_pages as $page_role) {
							?>
							<label for="wpcms_pcontrolopts[<?php echo $value; ?>_page_<?php echo $page_role; ?>]">
							<input name="wpcms_pcontrolopts[<?php echo $value; ?>_page_<?php echo $page_role; ?>]" type="checkbox" id="<?php echo $value; ?>" value="<?php echo $value; ?>"
							<?php
							if (isset($options[''.$value.'_page_'.$page_role.''])) {
								checked(''.$value.'', $options[''.$value.'_page_'.$page_role.'']);
							}
							?>
							 />
							<?php echo ucfirst( esc_html($page_role) ); ?>
							</label>

							<?php
						}

						?>

					</fieldset>
				</td>
			</tr>

			<?php
			}
			?>

		</table>


		<div id="icon-themes" class="icon32"><br /></div>
		<h2>Post Controls</h2>
		<p>Check option <strong>to hide post controls </strong> available to different <a href="http://codex.wordpress.org/Roles_and_Capabilities" title="WordPress roles and capabilities">user roles</a>.</p>

		<table class="form-table">

			<?php
			$mypostcontrols = array(
			'Author (if multiple)' => 'authordiv',
			'Categories' => 'categorydiv',
			'Comments' => 'commentsdiv',
			'Custom fields' => 'postcustom',
			'Discussion' => 'commentstatusdiv',
			'Excerpt' => 'postexcerpt',
			'Featured Image' => 'postimagediv',
			'Format' => 'formatdiv',
			'Revisions' => 'revisionsdiv',
			'Slug' => 'slugdiv',
			'Tags' => 'tagsdiv-post_tag',
			'Trackbacks' => 'trackbacksdiv'
			);

			//Generate form from array
			foreach($mypostcontrols as $key => $value) { ?>

			<tr>
				<th scope="row"><?php echo $key; ?></th>
				<td>
					<fieldset>
					<legend class="screen-reader-text"><span><?php echo $key; ?></span></legend>

						<?php
						foreach ($wp_role_edit_posts as $post_role) {
							?>

							<label for="wpcms_pcontrolopts[<?php echo $value; ?>_post_<?php echo $post_role; ?>]">
							<input name="wpcms_pcontrolopts[<?php echo $value; ?>_post_<?php echo $post_role; ?>]" type="checkbox" id="<?php echo $value; ?>" value="<?php echo $value; ?>"
							<?php
							if (isset($options[''.$value.'_post_'.$post_role.''])) {
								checked(''.$value.'', $options[''.$value.'_post_'.$post_role.'']);
							}
							?>
							 />
							<?php echo ucfirst( esc_html($post_role) ); ?>
							</label>

							<?php
						}
						?>

					</fieldset>
				</td>
			</tr>

			<?php
			}
			?>

		</table>


		<div id="icon-tools" class="icon32"><br /></div>
		<h2>Advanced Controls</h2>
		<p>These options apply <strong>to all edit screens</strong> available to different <a href="http://codex.wordpress.org/Roles_and_Capabilities" title="WordPress roles and capabilities">user roles</a>.</p>

		<table class="form-table">

			<?php
			$mywpcorecontrols = array(
			'Remove media upload' => 'media_buttons',
			'Remove word count' => 'word_count'
			);

			//Generate form from array
			foreach($mywpcorecontrols as $key => $value) { ?>

			<tr>
				<th scope="row"><?php echo $key; ?></th>
				<td>
					<fieldset>
					<legend class="screen-reader-text"><span><?php echo $key; ?></span></legend>

							<?php
							foreach ($wp_role_edit_posts as $core_role) {
								?>

								<label for="wpcms_pcontrolopts[<?php echo $value; ?>_wpcore_<?php echo $core_role; ?>]">
								<input name="wpcms_pcontrolopts[<?php echo $value; ?>_wpcore_<?php echo $core_role; ?>]" type="checkbox" id="<?php echo $value; ?>" value="<?php echo $value; ?>"
								<?php
								if (isset($options[''.$value.'_wpcore_'.$core_role.''])) {
									checked(''.$value.'', $options[''.$value.'_wpcore_'.$core_role.'']);
								}
								?>
								 />
								<?php echo ucfirst( esc_html($core_role) ); ?>
								</label>

								<?php
							}
							?>

					</fieldset>
				</td>
			</tr>

			<?php
			}
			?>

		</table>


		<?php /*
		DONT NEED THIS ANY MORE WITH WPCORE settings_fields()
		<input type="hidden" name="wpcms_pcontrol_nonce" value="<?php echo wp_create_nonce('wpcms_pcontrol_nonce'); ?>" />
		*/
		?>

		<p class="submit">
		<input type="submit" class="button-primary" value="<?php _e('Save Post Control options') ?>" />
		</p>

	</form>

<?php include("wp-cms-opts-pcontrol-common.php"); ?>

</div>