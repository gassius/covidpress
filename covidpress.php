<?php
/*
Plugin Name: COVIDPress
Plugin URI: https://github.com/gassius/covidpress
Description: Allow display current COVID-19 related information to your visitors, to help to stop the virus.
Version: 0.1.0
Author: Carlos González Rico
Author URI: https://github.com/gassius/
License: GPLv3
*/

namespace COVIDPress;

class COVIDPressPlugin {

    public function __construct()
    {
        add_action('admin_menu', [ $this, 'initAdminSettings' ] );
        add_action('wp_footer', array($this,'displayCOVIDpressAdvisor'), 11);
    }

    public function initAdminSettings() {
        $settingsPage = add_options_page('COVIDPress', 'COVIDPress', 'manage_options', 'COVIDPressOptions', [$this,'displaySettingsPage']);
    }

    public function displaySettingsPage() {
        include_once __DIR__ .'/includes/templates/settings.php';
    }

    public function displayCOVIDpressAdvisor() {
        if ( is_admin() ) {
            return;
        }
        $this->loadAdvisorStyles();
        include_once __DIR__ .'/includes/templates/advisor.php';
    }

    public function loadAdvisorStyles() {
        wp_enqueue_style('COVIDPressAdvisorStyles', plugin_dir_url( __FILE__ ) . 'includes/styles/advisor.css', []);
    }
}

$COVIDPressPlugin = new COVIDPressPlugin();
