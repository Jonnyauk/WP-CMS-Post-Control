## WP-CMS Post Control

Latest stable realease: <a href="http://wordpress.org/extend/plugins/wp-cms-post-control/">Official WordPress plugin directory</a>
Tags: post, page, metabox, autosave, revisions, tags, categories, excerpt, trackbacks, custom fields, discussion, comment, author, upload, slug, featured image, word count, trash
Requires at least: 3.6
Tested up to: 4.4
Stable tag: 2.931
License: GPLv2 or later

### Post Control gives you complete control over your write options **for every user level/role**. It not only allows you to hide unwanted items like custom fields, trackbacks, revisions etc. but also gives you a whole lot more control over how WordPress deals with creating content.

Simplify and customise the write post and page areas of WordPress to show just the controls you need. Great for de-cluttering - do you really need those pingback and trackback options, not using tags, want only administrators to be able to set categories... now you can decide what each individual level of user can see and use!

It also features other advanced configuration options like disable autosaves, limit the number of revisions saved and how many days before trash is auto-emptied by WordPress.

**NEW** - Control number of days before trash is emptied

**NEW** - Remove word count on a per user basis (feature request)

**NEW** - Control exactly how many revisions are saved when you are amending your content or even turn off revisions. This stops your database getting clogged up and is great when you are designing a site!

You can control the display of the following post options for each core WordPress role (administrator, editor, author and contributor):

* Post Author (if multiple)
* Post Categories
* Post Comments
* Post Custom fields
* Post Discussion
* Post Excerpt
* Post Featured Image (NEW WordPress 3.1+ support!)
* Post Format
* Post Revisions
* Post Slug (NEW WordPress 3.1+ support!)
* Post Tags
* Post Trackbacks
* NEW - Word count

You can control the display of the following page options:

* Page Attributes
* Page Author (ONLY if multiple)
* Page Custom Fields
* Page Discussion
* Page Featured Image (NEW WordPress 3.1+ support!)
* Page Slug (NEW WordPress 3.1+ support!)
* Page Revisions
* NEW - Word count

You can control the display of the following global post/page options:

* Limit the number of post and page revisions saved (updated for WordPress 3.6 and above)
* Post/Page Media upload
* Disable Autosave
* Disable Post Revisions (updated for WordPress 3.6 and above)
* NEW - Set the number of days before the trash is auto emptied by WordPress

Installation
----------------------------------------------------------------------

### First time install

You can use the built-in WordPress add plugin system to install Post Control once logged into your site, it's quick and easy!

Simply search for 'WP-CMS Post Control' and you can install it straight from your WordPress admin area.

If you want to manually upload and install:

1. Get the latest version of this plugin at the <a href="http://wordpress.org/extend/plugins/wp-cms-post-control/">official WordPress plugin directory</a>
2. Decompress .zip file, retaining the complete, original file structure
3. Upload the whole directory `wp-cms-post-control` and all containing files to your plugins directory - normally `/wp-content/plugins/`
4. Activate the plugin through the 'Plugins' menu in WordPress
5. Configure options through `Settings > Post Control` and `Settings > Post Control Core`

### Update existing install

If your server supports it, the automatic plugin update feature of WordPress is the easiest way to keep this plugin updated.

If you are updating via FTP, simply delete the entire folder called `wp-cms-post-control` from your plugins directory and replace with the newest version.

**IMPORTANT** When you upgrade, you may need to go to the options page and re-save your Post Control options to refresh the settings. In most cases everything will be fine, but this will ensure that if there have been any updates to WordPress the plugin will refresh and update the relevant Post Control options.

Frequently Asked Questions & support forum
----------------------------------------------------------------------

Please visit <a href="http://wordpress.org/plugins/wp-cms-post-control/">official WordPress plugin directory for FAQ and other documentation.</a>

Changelog
----------------------------------------------------------------------

### 2.931
* 2nd December 2015
* Tested and verified upto WordPress 4.4
* Fixed issue with post options

### 2.92
* 28th April 2015
* REQUIRES WORDPRESS 3.6 OR ABOVE
* Tested and verified with WordPress 4.2.1
* Fixed issue with options array

### 2.91
* 11th August 2014
* REQUIRES WORDPRESS 3.6 OR ABOVE
* Tested and verified with WordPress 3.9.1

### 2.9
* 5th August 2014
* REQUIRES WORDPRESS 3.6 OR ABOVE
* Tested and verified with WordPress 3.9.1

### 2.82
* 24th March 2014
* REQUIRES WORDPRESS 3.6 OR ABOVE
* Tested and verified with WordPress 3.8x

### 2.81
* 25th October 2013
* REQUIRES WORDPRESS 3.6 OR ABOVE
* Improve compatibility with older versions of PHP, corrects code error from incompatible code as reported by users.

### 2.8
* 22nd October 2013
* REQUIRES WORDPRESS 3.6 OR ABOVE
* New option to remove word count (as per user request)

### 2.7
* 25th August 2013
* REQUIRES WORDPRESS 3.6 OR ABOVE
* Code update required to support WordPress 3.6x revisions

### 2.6
* 10th July 2013
* REQUIRES WORDPRESS 3.5 OR ABOVE
* Remove legacy Flash uploader option - no longer valid or relevant
* Added new control for comments on page edit screen
* Changed support link to WordPress forum

### 2.5
* 10th April 2011
* REQUIRES WORDPRESS 3.1 OR ABOVE
* Create post and page control for custom post thumbnails/featured image meta panel
* Create post and page control for slug meta panel
* Create post control for format meta panel
* Increased number of post revisions available as per user request to 50 (thanks!)

### 2.4
* 4th November 2010
* REQUIRES WORDPRESS 3.0 OR ABOVE
* Hopefully fixes update notice issues as reported by users (thanks!)
* Increased number of post revisions available as per user request (thanks!)

### 2.3
* 31st July 2010
* REQUIRES WORDPRESS 3.0 OR ABOVE
* Fully tested and compatible with WordPress 3.0 post and page editors
* Fixed another bug with no values set
* Compatibility with WordPress 3.0 page editing

### 2.22

* 18th June 2010
* LAST VERSION TO BE COMPATIBLE WITH WORDPRESS 2.9
* WordPress 3.0 first pass compatibility

### 2.21
* 16th June 2010
* Tested upto WordPress 3.0-RC3
* Amended roles and capabilities
* Fully prepared and ready for WordPress 3.0 launch, whoot!

### 2.2
* 12th June 2010
* Bug that caused error messages when no options selected fixed
* Introduced new revisions number control

### 2.12
* 23th March 2010
* Bug that caused error messages fixed

### 2.11
* 22th March 2010
* Bug hunt

### 2.1
* 22th March 2010
* Added new Core Functions sub-menu page
* Added new disable autosave control
* Added new disable revisions control
* Added new disable flash uploader control
* Added cleanup of options on delete of plugin (not deactivation)

### 2.01
* 20th March 2010
* Fixed bug when values empty
* Amended data sanitisation input

### 2.0
* 19th March 2010
* Complete re-write of codebase = major efficiency improvements
* New code eliminates all previous reported user issues
* WordPress 2.9.2 compatibility updates
* Introduced multi-user level controls
* New remove media upload control

### v1.2.1
* 31st March 2009
* WordPress 2.7 author control

### v1.2
* 17th December 2008
* WordPress 2.7 compatibility build, re-write plugin controls to support new 'Crazy Horse' interface
* Fix basic text formatting in custom message box, remove strip slashes to allow basic formatting like <b> and <i>
* Changed option array function for more control
* Changed formatting of plugin options buttons

### v1.11
* 6th September 2008
* Option to hide editor sidebar shortcuts and 'Press It' function
* Remove redundant preview code
* Improved formatting for message box text and title input

### v1.1
* 5th September 2008
* Found potential conflict with options variables declared within a theme functions file
* Conflicting PHP variables for reference - 'options' and 'newoptions'
* Should solve conflicts with wrongly coded variables from other plugins/themes

### v1.03
* 4th September 2008
* Fix the bug introduced in v1.02 that broke the form fields
* After comments feedback, changed and documented admin control

### v1.02
* 3rd September 2008
* Bug catches, may help plugin compatibility on different servers

### v1.01
* 2nd August 2008
* Option to insert message panel
* General tidying on admin page

### v1.0
* 1st August 2008
* Option to disable post and page revisions
* Option to disable autosaves

### v0.4
* 1st August 2008
* Option to select uploader (Flash or standard)
* Option to hide revisions control
* Option to hide word count
* Option to hide Advanced Options header
* Fixed page custom field control
* Redesigned admin page

### v0.3
* 28th July 2008
* Introduced Admin user control

### v0.2
* 26th July 2008
* Included clean-up of database on de-activation