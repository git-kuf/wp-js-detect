<?php
// Header ----------------------------------------------------------------------
ob_start();
// use wp-load
if (file_exists('../../../../wp-load.php')) {
    // seconds, minutes, hours, days
    $expires = 60*60;
    header("Pragma: public");
    header("Cache-Control: maxage=".$expires);
    header('Expires: ' . gmdate('D, d M Y H:i:s', time()+$expires) . ' GMT');
    header('Content-type: text/css');
    
	require_once('../../../../wp-load.php');
} 
else {
	die('/*Could not load WP, edit/add dynamic.css.php*/');
}
ob_end_clean();

do_action('plugin_wp_js_detect_css');
// -----------------------------------------------------------------------------