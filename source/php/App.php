<?php

namespace ModularityTimeline;

use ModularityTimeline\Helper\CacheBust;

class App
{
    public function __construct()
    {
        //Register module
        add_action('init', array($this, 'registerModule'));
    }

    /**
     * Register the module
     * @return void
     */
    public function registerModule()
    {
        if (function_exists('modularity_register_module')) {
            modularity_register_module(
                MODULARITY_TIMELINE_MODULE_PATH,
                'Timeline'
            );
        }
    }
}
