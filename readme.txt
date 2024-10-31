=== Page Restriction With Role ===

Contributors: mithublue, cybercraftit
Tags: Page, page restriction, page restriction with role, make page restriction, role dependent page restriction, rolewise page access, rolewise page permission
Requires at least: 3.0.1
Tested up to: 4.3.1
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

The plugin to help you make template pages in easy way and make them accessible depending on the additional role provided with this plugin and assigned to different users.


== Installation ==

1. Upload `page-restriction-with-role` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress

== How to Use ==

1. After installing the plugin, to make page templates go to plguin root folder and open slugs.php. Here you will see an array where key is page slug of the page you want to create and value is the label of the page to display.

2. Now, go to template directory of the plugin folder and create a php file with the name that you provided as the array key in previous step.

3. To make new additional role , go to wp-admin-> Additional role-> Add new. Give the name of the role that you want to create. Here you will find the checkbox list of pages you created in the template folder. Check those names of the file/page which you want to make accessible with this role.

4. Go to wp-admin->users and select a user profile and assign him the additional role you want that you created in previous step . Now, that user will have access to pages only which are accessible with that role.

Enjoy !
== Screenshots ==

1. screenshot-1
2. screenshot-2
3. screenshot-3
4. screenshot-4
5. screenshot-5


== Changelog ==

= 0.1 =


