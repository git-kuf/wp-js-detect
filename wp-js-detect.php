<?php
/*
Plugin Name: WP JS Detect
Plugin URI:  
Description: This plugin is used to display a notification message if the browser's Javascript is disabled.
Version: 1.0.0
Author: Kuflievskiy Alex <kuflievskiy@gmail.com>
Author URI: 
License: GPL2 license name e.g. GPL2
*/

function wp_js_detect() {
    ?>
    <noscript>
	    <div id="jsDisabled">
            <p>
                 For full functionality of this site it is necessary to enable JavaScript.
                 Here are the <a href="http://www.enable-javascript.com/" target="_blank">
                 instructions how to enable JavaScript in your web browser</a>.    
            </p>
        </div>
    </noscript>
    <?php
}
add_action('wp_footer', 'wp_js_detect');


function wp_js_detect_style()
{
	$plugin_path=get_bloginfo('url').'/wp-content/plugins/wp-js-detect/';
	?>
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

add_action('wp_head', 'wp_js_detect_style');