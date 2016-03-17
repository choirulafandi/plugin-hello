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

    private function __construct()
    {
        add_action('peepso_init', array(&$this, 'init'));

        if (is_admin()) {
            add_action('admin_init', array(&$this, 'check_peepso'));
        }

        register_activation_hook(__FILE__, array(&$this, 'activate'));
    }

PeepSoHelloworld::get_instance();

// EOF