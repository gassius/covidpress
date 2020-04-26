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

require_once(__DIR__.'/lib/DataSources/euodpCOVID19.php');
require_once(__DIR__.'/lib/DataSources/EMMNewsBrief.php');

use COVIDPress\DataSources\euodpCOVID19;
use COVIDPress\DataSources\EMMNewsBrief;

class COVIDPressPlugin {


    protected $simplexmlAvailable = true;

    public function __construct()
    {
        $this->simplexmlAvailable = extension_loaded('simplexml');

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
        $this->loadAdvisorIncludes();
        include_once __DIR__ .'/includes/templates/advisor.php';
    }

    public function loadAdvisorIncludes() {
        wp_enqueue_script('COVIDPressAdvisorScript', plugin_dir_url( __FILE__ ) . 'includes/js/covidpress.js', [], false, true );
        wp_enqueue_style('COVIDPressAdvisorStyles', plugin_dir_url( __FILE__ ) . 'includes/styles/advisor.css', []);
    }

    public function getData() : Array
    {
        $euodpCOVID19 = new euodpCOVID19();
        return $euodpCOVID19->getDataByContinent('Europe');
    }

    public function getNews() : Array
    {
        if($this->simplexmlAvailable) {
            $EMMNewsBrief = new EMMNewsBrief('en');
            return $EMMNewsBrief->getNews(3);
        }
        return [];
    }
}

$COVIDPressPlugin = new COVIDPressPlugin();
