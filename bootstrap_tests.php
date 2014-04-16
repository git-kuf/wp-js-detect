<?php
ob_start();

//change this to your path
$path = dirname( dirname( dirname( dirname( dirname( dirname( __FILE__ ) ) ) ) ) ) . '/tmp/wordpress-tests-lib/includes/bootstrap.php';

if ( file_exists( $path ) ) {
    $GLOBALS['wp_tests_options'] = array(
        'active_plugins' => array(
            'wp-js-detect/wp-js-detect.php',
        )
    );
    require_once $path;
} else {
    exit( "Couldn't find  wordpress-tests-lib/bootstrap.php. Path : " . $path );
}