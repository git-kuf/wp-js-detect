<?php
/*
Plugin Name: WP JS Detect
Plugin URI:  https://github.com/git-kuf/wp-js-detect
Description: This plugin is used to display a notification message if the browser's Javascript is disabled.
Version: 1.0.0
Author: Kuflievskiy Alex <kuflievskiy@gmail.com>
Author URI: https://github.com/git-kuf/
License: GPLv3 license
*/

/*  Copyright 2013  Kuflievskiy Alex  (email: kuflievskiy@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/**
 * Interface JsDetectInterface
 *
*/
interface JsDetectInterface{
    public function __construct();
    public function wp_non_js_notification();
}

/**
 * Class JsDetect
 *
*/
class JsDetect implements JsDetectInterface
{
    /**
     *  Function __construct
     *  This is a class constructor function.
     *
     */
    public function __construct()
    {
        add_action('wp_head', array($this,'wp_non_js_notification'));
    }

    /**
     *  Function wp_non_js_notification
     *  This function is used to output the notification.
     *
     */
    public function wp_non_js_notification()
    {
    	$plugin_path=get_bloginfo('url').'/wp-content/plugins/wp-js-detect/';
    	?>
            <div id="jsDisabled">
                <p>
                     <?php 
                            _e('For full functionality of this site it is necessary to enable JavaScript.
                                Here are the <a href="http://www.enable-javascript.com/" target="_blank"> 
                                instructions how to enable JavaScript in your web browser</a>.'); 
                     
                     ?>    
                </p>
            </div>
            <script language="javascript">
                var item = document.getElementById('jsDisabled');
                if (item.style.display === "block" || !item.style.display )
                {
                    item.style.display = 'none';
                }
            </script>        
    	<style>
    	/*no JS message*/
            #jsDisabled{
                position: fixed;
                width: 100%;
                height: 100%;
                background: url(<?php echo $plugin_path; ?>images/dark-bg.png) repeat;
                z-index: 2000;
            }
            #jsDisabled p{
                position: absolute;
                top:50%;
                left: 50%;
                width: 100%;
                width: 500px;
                margin-left: -323px;
                margin-top: -75px;
                border-radius: 5px;
                box-shadow: 0 0 10px #000;
                padding: 30px 30px 30px 120px;
                background: #fef5f2 url(<?php echo $plugin_path; ?>images/symbol_error.png) 30px 50% no-repeat;
                font-size: 20px;
                text-align: left;
                color: #333;
                line-height: 26px;
            }
            #jsDisabled p a{
                color: #d13131;
            }
    	</style>
	    <?php
    }    
}
new JsDetect();