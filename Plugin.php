<?php namespace LeMaX10\Preload;

use System\Classes\PluginBase;

/**
 * Fields Plugin Information File
 * @package LeMaX10\Preload
 * @author Vladimir Pyankov, rdlrobot@gmail.com
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'Preloader',
            'description' => 'Preload manager for php7.4',
            'author'      => 'LeMaX10',
            'icon'        => 'icon-leaf',
        ];
    }
}
