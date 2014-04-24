Wp Js Detect
============
 - Contributors: wpkuf
 - Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business=kuflievskiy@gmail.com&item_name=Donation+for+Wp+Js+Detect
 - Tags: javascript,js, disabled js,disabled javascript,disabled javascript notification,disabled javascript message, warning 
 - Requires at least: 3.5
 - Tested up to: 3.9
 - Stable tag: 1.0.9
 - License: GPLv2 or later
 - License URI: http://www.gnu.org/licenses/gpl-2.0.html

This plugin is used to display a notification message if the browser's Javascript is disabled.

Travis CI
=========

[![Build Status](https://travis-ci.org/kuflievskiy/wp-js-detect.png?branch=master)](https://travis-ci.org/kuflievskiy/wp-js-detect)

Description
===========
A WordPress plugin that can show simple notifications whenever it detects site visitors that have turned off JavaScript in their browser.
This warning is completely customizable from a page in the WordPress backend.

Features
========
Plugin has an option page in the wordpress admin panel where you can customize the notification message about disabled JS.

Documentation
=============

Documentation will be maintained on the [GitHub Wiki here](https://github.com/kuflievskiy/wp-js-detect/wiki).
Plugin Translation https://github.com/kuflievskiy/wp-js-detect/wiki/Plugin-Translation

Add-ons
-------
There are no addons fo this simple plugin yet.

Contributing and reporting bugs
-------------------------------
You can post issues here: https://github.com/kuflievskiy/wp-js-detect/issues
You can contact me via email to notify about bug.

Support
-------
Use the WordPress.org forums for community support - I cannot offer support directly for free. If you spot a bug, you can of course log it on [Github](https://github.com/kuflievskiy/wp-js-detect) instead where I can act upon it more efficiently.

If you want help with a customisation, hire a developer!

Installation
------------
1. Unpack and upload it to the /wp-content/plugins/ directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Edit notification message if needed on the http://YOUR_SITE_DOMAIN_NAME/wp-admin/admin.php?page=js-detect-settings page.
4. Enjoy!

Automatic installation
----------------------
Automatic installation is the easiest option as WordPress handles the file transfers itself and you don't even need to leave your web browser. To do an automatic install, log in to your WordPress admin panel, navigate to the Plugins menu and click Add New.

In the search field type "Download Monitor" and click Search Plugins. Once you've found the plugin you can view details about it such as the the point release, rating and description. Most importantly of course, you can install it by clicking _Install Now_.

Manual installation
-------------------
The manual installation method involves downloading the plugin and uploading it to your webserver via your favourite FTP application.

* Download the plugin file to your computer and unzip it
* Using an FTP program, or your hosting control panel, upload the unzipped plugin folder to your WordPress installation's `wp-content/plugins/` directory.
* Activate the plugin from the Plugins menu within the WordPress admin.

Frequently Asked Questions
--------------------------

Screenshots
-----------
1. This is a notification if js is disabled.
2. Plugin options page. 

Changelog
---------
### 1.0.0
* First plugin version.

### 1.0.1
* NEW : Option to store and manage notification text has been added.

### 1.0.2
* NEW : Plugin security has been improved.
* NEW : The WPML plugin support has been added. You can read more about WPML config here http://wpml.org/documentation/support/language-configuration-files/

### 1.0.3
* NEW : Plugin option tabs has been added.

### 1.0.4
* NEW : Ability to customize pop-up window from the backend has been added.

### 1.0.5
* NEW : Plugins JS and CSS locates in the separate files for now!  .js and .css files are included in the footer section of the site, so it should decrease the time of the site's loading. And you can pack these (.js+.css)files for now via other plugins!

### 1.0.6
* bugfix: plugin url variable has been replaced with plugins_url function https://github.com/kuflievskiy/wp-js-detect/issues/2

### 1.0.7
* NEW : Ability to translate plugin has been added.

### 1.0.8
* bugfix: Several minor warnings and notices have been fixed.

### 1.0.9
* bugfix: https://github.com/kuflievskiy/wp-js-detect/issues/3
* enhancement: https://github.com/kuflievskiy/wp-js-detect/issues/4
