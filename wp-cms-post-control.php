<?php
/*
Plugin Name: WP-CMS Post Control
Version: 2.92
Plugin URI: http://wp-cms.com/our-wordpress-plugins/wp-cms-post-control-plugin/
Description: Hides unwanted items within the write/edit screens and options for each user role. Also controls autosave, revisions, trash time and flash uploader.
Author: Jonny Allbut
Author URI: http://jonnya.net
License: GPL
*/

/*
View readme.txt in this directory for full documentation or view documentation online at http://wordpress.org/extend/plugins/wp-cms-post-control
Official download repository: http://wordpress.org/extend/plugins/wp-cms-post-control - The latest version (and all older versions) of Post Control should always be downloaded from here only.

NOTE COMPATIBILITY VERSIONS

- The latest version of this plugin always supports the current latest public release of WordPress
- Compatibility with older versions is not supported
- You really should upgrade your version of WordPress to make it faster, secure and get more features!

v2.92 - Tested against WordPress 4.2.1
v2.91 - Fix WordPress plugin update
v2.9  - Tested against WordPress 3.9.1
v2.82 - Tested against WordPress 3.81
v2.81 - Tested against WordPress 3.61
v2.8  - Tested against WordPress 3.61
v2.7  - Tested against WordPress 3.6
v2.6  - Last version to be compatible with WordPress 3.5x (no longer supported)
v2.5  - Last version to be compatible with WordPress 3.4x (no longer supported)
v2.4  - Last version to be compatible with WordPress 3.0x (no longer supported)
v2.22 - Last version to be compatible with WordPress 2.9x (no longer supported)
v1.21 - Last version to be compatible with WordPress 2.8x (no longer supported)
*/

include("inc/wp-cms-class-pcontrol.php");

/**
* Setup Post Control
*
* @since 2.0
* @lastupdate 2.1
*
*/
function wpcms_pcontrol_init(){
	register_setting( 'wpcms_pcontrol_options', 'wpcms_pcontrolopts', 'wpcms_pcontrol_validate' );
	register_setting( 'wpcms_pcontrol_options_ex', 'wpcms_pcontrolopts_ex', 'wpcms_pcontrol_validate_ex' );
}



/**
* Run Post Control
*
* @since 2.0
* @lastupdate 2.0
*
*/
function wpcms_pcontrol_run() {

	$wpcms_pcontrol_doit = new wpcms_pcontrol;

	// Just load what we need when we need it

	add_action('load-post.php', array($wpcms_pcontrol_doit, 'pccore_page'));
	add_action('load-post-new.php', array($wpcms_pcontrol_doit, 'pccore_page'));
	add_action('load-post.php', array($wpcms_pcontrol_doit, 'pccore_post'));
	add_action('load-post-new.php', array($wpcms_pcontrol_doit, 'pccore_post'));
}



/**
* Run Post Control extended functions
*
* @since 2.1
* @lastupdate 2.7
*
*/
function wpcms_pcontrol_ex_init(){

	$ex_doit = new wpcms_pcontrol_engine;

	$options = get_option('wpcms_pcontrolopts_ex');

	//Check for some options
	if (is_array($options)) {

		foreach ($options as $key => $value) {

			if ( $key == 'revisions' && $value == 'off' ) {
				add_filter( 'wp_revisions_to_keep', '__return_null', 9, 2 );
			}

			if ( $key == 'autosave' && $value == 'off' ) {
				wp_deregister_script('autosave');
			}

		}

	}

}



/**
* Run Post Control extended functions that need to be run early
* Controls number of revisions and days content held in trash
*
* @since 2.2
* @lastupdate 2.9
*
*/
function wpcms_pcontrol_ex_revisions(){

	$ex_doit = new wpcms_pcontrol_engine;

	$options = get_option('wpcms_pcontrolopts_ex');

	//Check for some options
	if (is_array($options)) {

		foreach ($options as $key => $value) {

			if ( $key == 'revision_num' && $value != '' ) {

				if ($value == 0) {
					//Saved as unlimited so do nothing
				} else {
					define('WP_POST_REVISIONS', $value );
				}
			}

			if ( $key == 'trash_num' && $value != '' ) {
				define('EMPTY_TRASH_DAYS', $value );
			}

		}

	}

}



/**
* Adds options page
*
* @since 2.0
* @lastupdate 2.21
*
*/
function wpcms_pcontrol_add_page() {
	// Access level is set here - set to 'edit users' which is logical for post control operation and is usually an admin only role function
	add_options_page('WP-CMS Post Control Options', 'Post Control', 'edit_users', 'wpcms_pcontrol', 'wpcms_pcontrol_do_page');
}



/**
* Adds extended core options page
*
* @since 2.1
* @lastupdate 2.21
*
*/
function wpcms_pcontrol_add_page_ex() {
	// Access level is set here - set to 'edit users' which is logical for post control operation and is usually an admin only role function
	add_options_page('WP-CMS Post Control Core Functions', 'Post Control Core', 'edit_users', 'wpcms_pcontrol_ex', 'wpcms_pcontrol_do_page_ex');
}



/**
* Add link to plugins listing to jump to admin
*
* @since 2.0
* @lastupdate 2.0
*
*/
function wpcms_pcontrol_meta($links, $file) {

	$plugin = plugin_basename(__FILE__);

	// create link
	if ($file == $plugin) {
		return array_merge(
			$links,
			array( sprintf( '<a href="options-general.php?page=wpcms_pcontrol">Post Control settings</a>', $plugin, __('Post Control Settings') ) )
		);
	}
	return $links;
}



/**
* Options page content
*
* @since 2.005
* @lastupdate 2.1
*
*/
function wpcms_pcontrol_do_page() {
	include("inc/wp-cms-opts-pcontrol-main.php");
}



/**
* Options page ex content
*
* @since 2.02
* @lastupdate 2.1
*
*/
function wpcms_pcontrol_do_page_ex() {
	include("inc/wp-cms-opts-pcontrol-ex.php");
}



/**
* Processes main post control options
*
* @since 2.0
* @lastupdate 2.3
*
*/
function wpcms_pcontrol_validate($input) {

	if ($input !='') { // Catch if no options selected

		// PAGE OPERATIONS
		$pc_administrator_pageopsall = array();
		$pc_editor_pageopsall = array();

		foreach($input as $key => $value) {

			$adminmatch = "/_page_administrator/";
			$editormatch = "/_page_editor/";

			if (preg_match($adminmatch, $key)) {
			    $pc_administrator_pageopsall[] = wp_kses_data($value);

			} elseif (preg_match($editormatch, $key)) {
				$pc_editor_pageopsall[] = wp_kses_data($value);

			}

		}

	}

	if (isset($pc_administrator_pageopsall)) {
	$input['pc_administrator_pageops'] = $pc_administrator_pageopsall;
	}

	if (isset($pc_editor_pageopsall)) {
	$input['pc_editor_pageops'] = $pc_editor_pageopsall;
	}

	if (isset($pc_administrator_pageopsall) || isset($pc_editor_pageopsall)) {

		// POST OPERATIONS
		$pc_administrator_postopsall = array();
		$pc_editor_postopsall = array();
		$pc_author_postopsall = array();
		$pc_contributor_postopsall = array();

		foreach($input as $key => $value) {

			$adminmatch = "/_post_administrator/";
			$editormatch = "/_post_editor/";
			$authormatch = "/_post_author/";
			$contributormatch = "/_post_contributor/";

			if (preg_match($adminmatch, $key)) {
			    $pc_administrator_postopsall[] = wp_kses_data($value);
			    //print_r($pc_administrator_postopsall);

			} elseif (preg_match($editormatch, $key)) {
				$pc_editor_postopsall[] = wp_kses_data($value);

			} elseif (preg_match($authormatch, $key)) {
				$pc_author_postopsall[] = wp_kses_data($value);

			} elseif (preg_match($contributormatch, $key)) {
				$pc_contributor_postopsall[] = wp_kses_data($value);

			}

		}

		$input['pc_administrator_postops'] = $pc_administrator_postopsall;
		$input['pc_editor_postops'] = $pc_editor_postopsall;
		$input['pc_author_postops'] = $pc_author_postopsall;
		$input['pc_contributor_postops'] = $pc_contributor_postopsall;

	// CORE FUNCTION OPERATIONS
	$pc_administrator_wpcoreopsall = array();
	$pc_editor_wpcoreopsall = array();
	$pc_author_wpcoreopsall = array();
	$pc_contributor_wpcoreopsall = array();

	foreach($input as $key => $value) {

		$adminmatch = "/_wpcore_administrator/";
		$editormatch = "/_wpcore_editor/";
		$authormatch = "/_wpcore_author/";
		$contributormatch = "/_wpcore_contributor/";

		if (preg_match($adminmatch, $key)) {
		    $pc_administrator_wpcoreopsall[] = wp_kses_data($value);

		} elseif (preg_match($editormatch, $key)) {
			$pc_editor_wpcoreopsall[] = wp_kses_data($value);

		} elseif (preg_match($authormatch, $key)) {
			$pc_author_wpcoreopsall[] = wp_kses_data($value);

		} elseif (preg_match($contributormatch, $key)) {
			$pc_contributor_wpcoreopsall[] = wp_kses_data($value);

		}

	}

	$input['pc_administrator_wpcoreops'] = $pc_administrator_wpcoreopsall;
	$input['pc_editor_wpcoreops'] = $pc_editor_wpcoreopsall;
	$input['pc_author_wpcoreops'] = $pc_author_wpcoreopsall;
	$input['pc_contributor_wpcoreops'] = $pc_contributor_wpcoreopsall;

	}

	return $input;
}



/**
* Processes common extended post control options
*
* @since 2.1
* @lastupdate 2.9
*
*/
function wpcms_pcontrol_validate_ex($input) {

	if ($input !='') {

		foreach($input as $key => $value) {

			if (is_numeric($value)) {
				$input[$key] = $value;
			} elseif ($value == 'off') {
				//Set value or set nothing
				$input[$key] = ( $input[$key] == $value ? $value : '' );
			} else {
				//Silence is golden
				$input[$key] = '';
			}

		}

	}

	return $input;

}



/**
* If user DELETES plugin, lets delete the options like a well behaved plugin should.
* Options are persistent on activation and deactivation - if you want to delete, use delete!
*
* @since 2.1
* @lastupdate 2.1
*
*/
function wpcms_pcontrol_uninstall() {
	delete_option('wpcms_pcontrolopts');
	delete_option('wpcms_pcontrolopts_ex');
}



//Post Control Go!

//This one seems to need to be called early
add_action( 'plugins_loaded', 'wpcms_pcontrol_ex_revisions' );

add_action('init', 'wpcms_pcontrol_ex_init');

add_action('admin_init', 'wpcms_pcontrol_run');
add_action('admin_init', 'wpcms_pcontrol_init');

add_action('admin_menu', 'wpcms_pcontrol_add_page');
add_action('admin_menu', 'wpcms_pcontrol_add_page_ex');

add_filter( 'plugin_row_meta', 'wpcms_pcontrol_meta', 10, 2 );
register_uninstall_hook(__FILE__, 'wpcms_pcontrol_uninstall');
?>