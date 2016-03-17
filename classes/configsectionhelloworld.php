<?php

class PeepSoConfigSectionHelloworld extends PeepSoConfigSectionAbstract
{
    // Builds the groups array
    public function register_config_groups()
    {
        $this->context='left';
        $this->group_custom_greeting();
    }

    /**
     * Custom Notif Box
     */
    private function group_custom_greeting()
    {
        // # Message Custom Notification
        $this->set_field(
            'peepso_helloworld_use_custom_message',
            __('Switch this on to enable the custom notification in the frontend','afandihello'),
            'message'
        );


        // # Notification
        $this->set_field(
            'peepso_helloworld_use_custom',
            __('Use Notification', 'afandihello'),
            'yesno_switch'
        );

        $this->set_field(
            'peepso_helloworld_custom_message',
            __('Custom Notification', 'afandihello'),
            'text'
        );

        // The next has to be a number
        $this->args('int', TRUE);
        $this->args('validation', array('required','numeric'));

        // If we didn't specify a default during plugin activation, we can do it now
        $this->args('default', 1);

        $this->set_field(
            'peepso_helloworld_custom_user_id',
            __('Custom user Id', 'afandihello'),
            'text'
        );


        $this->set_group(
            'peepso_helloworld_custom_greeting',
            __('Customize Notif Message', 'afandihello')
        );
    }
}