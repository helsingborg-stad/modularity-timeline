<?php

namespace ModularityTimeline\Admin;

class Settings
{
    public function __construct()
    {
        add_action('acf/init', array($this, 'registerSettings'));
    }

    /**
     * Register settings
     * @return void
     */
    public function registerSettings()
    {
        if (function_exists('acf_add_options_sub_page')) {
            acf_add_options_sub_page(array(
                'page_title'  => __("Modularity Timeline", 'modularity-timeline'),
                'menu_title'  => __("Modularity Timeline Settings", 'modularity-timeline'),
                'menu_slug'   => 'modularity-timeline-settings',
                'parent_slug' => 'options-general.php',
                'capability'  => 'manage_options'
            ));
        }
    }
}
