<?php

class PeepSoHelloworldAjax implements PeepSoAjaxCallback
{
    private static $_instance = NULL;

    private function __construct() {}

    public static function get_instance()
    {
        if (NULL === self::$_instance) {
            self::$_instance = new self();
        }
        return (self::$_instance);
    }

    public function hello(PeepSoAjaxResponse $resp)
    {
        $peepsoPostbox = new PeepSoPostbox();

        $settings = PeepSoConfigSettings::get_instance();

        $status = $settings->get_option('peepso_helloworld_use_custom_message');
        $notif = $settings->get_option('peepso_helloworld_custom_message');


        $user_id = PeepSo::get_user_id();
        $email = PeepSo::get_user_id();
        $message = 'user X ';

        if ($status) {
            if ($peepsoPostbox->post()) {
                mail('caffeinated@example.com', 'My Subject', $message);
            }
        }
    }
}