<?php

if (preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF'])) {
    die('You are not allowed to call this page directly.');
}

/*
Plugin Name: WP JS Detect
Plugin URI:  https://github.com/git-kuf/wp-js-detect
Description: This plugin is used to display a notification message if the browser's Javascript is disabled.
Version: 1.0.4
Author: Kuflievskiy Alex <kuflievskiy@gmail.com>
Author URI: https://github.com/git-kuf/
License: GPLv2 license
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
interface JsDetectInterface
{
    public function __construct();
    public function install();
    public function uninstall();
    public function plugin_settings();
    public function wp_non_js_notification();
    public function plugin_settings_link($links);
	public function paypal_donate_button();	
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
        add_action('wp_head', array($this, 'wp_non_js_notification'));
        add_action('admin_menu', array($this, 'admin_menu_customization'));

        register_activation_hook(__FILE__, array($this, 'install'));
        register_deactivation_hook(__FILE__, array($this, 'uninstall'));
        
 
        $plugin = plugin_basename(__FILE__); 
        add_filter("plugin_action_links_$plugin", array($this, 'plugin_settings_link') );
    }
    
    /**
     * Function install
     * This public function is used to add plugin option.
     *
     * @param     -
     * @return    -
     *
     */
    public function install()
    {
        $wp_non_js_notification_text = __('For full functionality of this site it is necessary to enable JavaScript. Here are the <a href="http://www.enable-javascript.com/" target="_blank"> instructions how to enable JavaScript in your web browser</a>.');
        add_option('wp_non_js_notification_text', $wp_non_js_notification_text, '', 'yes');
		
		$plugin_path = get_bloginfo('url') . '/wp-content/plugins/wp-js-detect/';
		$wp_non_js_notification_css = "
		/*no JS message*/
            #jsDisabled {
                position: fixed;
                width: 100%;
                height: 100%;
                background: url(".$plugin_path."images/dark-bg.png) repeat;
                z-index: 2000;
            }
            #jsDisabled p {
                position: absolute;
                top: 50%;
                left: 50%;
                width: 100%;
                width: 500px;
                margin-left: -323px;
                margin-top: -75px;
                border-radius: 5px;
                box-shadow: 0 0 10px #000;
                padding: 30px 30px 30px 120px;
                background: #fef5f2 url(".$plugin_path."images/symbol_error.png) 30px 50% no-repeat;
                font-size: 20px;
                text-align: left;
                color: #333;
                line-height: 26px;
            }
            #jsDisabled p a {
                color: #d13131;
            }
		";
		add_option('wp_non_js_notification_css', $wp_non_js_notification_css, '', 'yes');
    }

    /**
     * Function uninstall
     * This public function is used to remove plugin options.
     *
     * @param    -
     * @return    -
     *
     */
    public function uninstall()
    {
        delete_option('wp_non_js_notification_text');
        delete_option('wp_non_js_notification_css');		
    }

    /**
     * Function admin_menu_customization
     * This public function is used for
     *
     * @param
     * @return
     *
     */
    public function admin_menu_customization()
    {
        add_menu_page('Js Detect', 'Js Detect', 'administrator', 'js-detect-settings', array($this, 'plugin_settings'), '', 99999999);
    }

    /**
     * Function plugin_settings
     * This public function is used to update plugin settings.
     *
     * @param    -
     * @return    -
     *
     */
    public function plugin_settings()
    {
        if (isset($_POST['wp_non_js_notification_text'])) 
		{
            update_option('wp_non_js_notification_text', $_POST['wp_non_js_notification_text']);
        }
        if (isset($_POST['wp_non_js_notification_css'])) 
		{
            update_option('wp_non_js_notification_css', $_POST['wp_non_js_notification_css']);
        }		
        ?>
        <div class="wrap">
            <div id="icon-tools" class="icon32"><br/></div>
            <h2>Js Detect Settings</h2>
            <a class="nav-tab <?php echo ($_GET['tab'] == '') ? 'nav-tab-active' : ''; ?>" href="/wp-admin/admin.php?page=js-detect-settings">Plugin Settings</a>
            <a class="nav-tab <?php echo ($_GET['tab'] == 'css') ? 'nav-tab-active' : ''; ?>" href="/wp-admin/admin.php?page=js-detect-settings&tab=css">Plugin CSS</a>			
            <a class="nav-tab <?php echo ($_GET['tab'] == 'contact') ? 'nav-tab-active' : ''; ?>" href="/wp-admin/admin.php?page=js-detect-settings&tab=contact">Contacts Me</a>
            <?php if($_GET['tab'] === 'contact'): ?>
                <table cellspacing="0" class="widefat post fixed" style="width: 100%">
                        <thead>
                        <tr>
                            <th></th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th></th>
                        </tr>
                        </tfoot>
                        <tbody>
                        <tr>
                            <td class="column">
                                <p>Author: Kuflievskiy Alex </p>
                                <p>Email: <a href="mailto:kuflievskiy@gmail.com">kuflievskiy@gmail.com</a></p>
                                <p>Author URI: <a href="https://github.com/git-kuf/" target="_blank">https://github.com/git-kuf/</a></p>                            
                            </td>
                        </tr>
                        </tbody>
                </table>
            <?php elseif($_GET['tab'] === 'css'): ?>
                <table cellspacing="0" class="widefat post fixed" style="width: 100%">
                    <thead>
                    <tr>
                        <th style="width:200px;" class="manage-column"></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th class="manage-column"></th>
                        <th></th>
                    </tr>
                    </tfoot>
                    <tbody>
                    <tr>
                        <td class="column">
                            <label for="wp_non_js_notification_css">No Js Notification CSS:</label>
                        </td>
                        <td align="right" class="column">
                            <form action="#" method="post">
                                <textarea rows="50" class="large-text code" id="wp_non_js_notification_css"
                                          name="wp_non_js_notification_css"><?php echo get_option('wp_non_js_notification_css'); ?></textarea>
                                <input type="submit" value="<?php _e('Update'); ?>"
                                       class="button button-primary button-large">
                            </form>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="column">
							<?php echo $this->paypal_donate_button(); ?>
                        </td>
                    </tr>
                    </tbody>
                </table>			
            <?php else: ?>
                <table cellspacing="0" class="widefat post fixed" style="width: 100%">
                    <thead>
                    <tr>
                        <th style="width:200px;" class="manage-column"></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th class="manage-column"></th>
                        <th></th>
                    </tr>
                    </tfoot>
                    <tbody>
                    <tr>
                        <td class="column">
                            <label for="wp_non_js_notification_text">No Js Notification:</label>
                        </td>
                        <td align="right" class="column">
                            <form action="#" method="post">
                                <textarea rows="10" class="large-text code" id="wp_non_js_notification_text"
                                          name="wp_non_js_notification_text"><?php echo get_option('wp_non_js_notification_text'); ?></textarea>
                                <input type="submit" value="<?php _e('Update'); ?>"
                                       class="button button-primary button-large">
                            </form>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="column">
							<?php echo $this->paypal_donate_button(); ?>
                        </td>
                    </tr>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    <?php
    }

    /**
     *  Function wp_non_js_notification
     *  This function is used to output the notification.
     *
     */
    public function wp_non_js_notification()
    {
        ?>
        <div id="jsDisabled"><p><?php echo get_option('wp_non_js_notification_text'); ?></p></div>
        <script language="javascript">
            var item = document.getElementById('jsDisabled');
            if (item.style.display === "block" || !item.style.display) {
                item.style.display = 'none';
            }
        </script>
        <style>
            <?php echo get_option('wp_non_js_notification_css'); ?>
        </style>
    <?php
    }
    
    /**
     *  Function plugin_settings_link
     *  This function is used to add settings links on plugin page
     *  @param $links
     *  @return $links - array - extended array of the links.
     *
     */
    public function plugin_settings_link($links) 
	{ 

      array_unshift($links, '<a target="_blank" href="/wp-admin/admin.php?page=js-detect-settings">Settings</a>'); 
      array_unshift($links, '<a target="_blank" href="https://github.com/git-kuf/wp-js-detect/">GitHub Project Link</a>'); 
      array_unshift($links, '<a target="_blank" href="https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business=kuflievskiy@gmail.com&item_name=Donation+for+Wp+Js+Detect">Donate Author</a>'); 
      
      return $links; 
    }    
	
	/**
	 *	Function paypal_donate_button
	 *	This function is used to output paypal donate button.
	 *
	*/
	public function paypal_donate_button()
	{
		?>
		<p><?php _e('Donate to support further development.'); ?></p>
		<p><?php _e('I’m glad that you like my wordpress plugin and that you want to show your appreciation by
			donating. With your help I can make these plugins even better!'); ?></p>
		<p><?php _e('You can donate money using the PayPal-button below (any amount makes me happy!)'); ?></p>
		<p>
			<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business=kuflievskiy@gmail.com&item_name=Donation+for+Wp+Js+Detect"
			   target="_blank" title="Make a Donation for Wp Js Detect Plugin">
				<img src="https://www.paypal.com/en_US/i/btn/btn_donateCC_LG.gif" alt=""/>
			</a>
		</p>		
		<?php
	}
}

new JsDetect();