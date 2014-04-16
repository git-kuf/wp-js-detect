<?php

/**
 *
 * @package pmtsystem
 */
class WordPress_Plugin_Tests extends WP_UnitTestCase {


    /**
     * Ensure that the plugins have been installed and activated.
     */
    function test_plugins_activated() {

        $this->assertTrue( is_plugin_active( 'wp-js-detect/wp-js-detect.php' ) );
    }

}