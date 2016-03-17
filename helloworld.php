<?php
/**
 * Plugin Name: AfandiHello
 * Plugin URI: https://afandiweb.com
 * Description: Plugin Test PeepSo
 * Author: Afandi
 * Author URI: https://afandiweb.com
 * Version: 0.1
 * Copyright: (c) 2016 PeepSo All Rights Reserved.
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: AfandiHello
 * Domain Path: /language
 *
 * This software contains GPLv2 or later software courtesy of PeepSo.com, Inc
 *
 * PeepSoHelloWorld is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * PeepSoHelloWorld is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY. See the
 * GNU General Public License for more details.
 */


class AfandiHello
{
    private static $_instance = NULL;

    const PLUGIN_VERSION = '0.1';
    const PLUGIN_NAME = 'AfandiHello';
    const PLUGIN_RELEASE = ''; //ALPHA1, BETA1, RC1, '' for STABLE

    public $widgets = array(
        'AfandiHelloWidget',
    );

    private function __construct()
    {
        add_action('peepso_init', array(&$this, 'init'));

        if (is_admin()) {
            add_action('admin_init', array(&$this, 'check_peepso'));
        }

        register_activation_hook(__FILE__, array(&$this, 'activate'));
    }

    public static function get_instance()
    {
        if (NULL === self::$_instance) {
            self::$_instance = new self();
        }
        return (self::$_instance);
    }

    public function init()
    {
        PeepSo::add_autoload_directory(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR);
        PeepSoTemplate::add_template_directory(plugin_dir_path(__FILE__));

        if (is_admin()) {
            add_action('admin_init', array(&$this, 'check_peepso'));
            add_filter('peepso_admin_config_tabs', array(&$this, 'admin_config_tabs'));
        } else {
            add_action('wp_enqueue_scripts', array(&$this, 'enqueue_scripts'));
        }



        add_filter('peepso_widgets', array(&$this, 'register_widgets'));
    }


    public function check_peepso()
    {
        if (!class_exists('PeepSo'))
        {
            if (is_plugin_active(plugin_basename(__FILE__))) {
                // deactivate the plugin
                deactivate_plugins(plugin_basename(__FILE__));
                // display notice for admin
                add_action('admin_notices', array(&$this, 'disabled_notice'));
                if (isset($_GET['activate'])) {
                    unset($_GET['activate']);
                }
            }
            return (FALSE);
        }

        return (TRUE);
    }

    public function activate()
    {
        if (!$this->check_peepso()) {
            return (FALSE);
        }

        require_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'install' . DIRECTORY_SEPARATOR . 'activate.php');
        $install = new PeepSoHelloInstall();
        $res = $install->plugin_activation();
        if (FALSE === $res) {
            // error during installation - disable
            deactivate_plugins(plugin_basename(__FILE__));
        }

        return (TRUE);
    }

    /**
     * Registers a tab in the PeepSo Config Toolbar
     * PS_FILTER
     *
     * @param $tabs array
     * @return array
     */
    public function admin_config_tabs( $tabs )
    {
        $tabs['afandihello'] = array(
            'label' => __('Afandi Hello Tab', 'afandihelloworld'),
            'tab' => 'afandihello',
            'description' => __('Afandi Config Tab', 'afandihello'),
            'function' => 'AfandiConfigSectionHello',
        );

        return $tabs;
    }
}

AfandiHello::get_instance();

// EOF