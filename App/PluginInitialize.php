<?php

namespace App;

use App\Ajax\AjaxHandler;
use App\Base\Singleton;


/**
 * Core theme class
 *
 * @package App
 * @method static PluginInitialize getInstance()
 * @var PluginInitialize $instance
 */
final class PluginInitialize extends Singleton
{
    /**
     * Core constructor.
     */
    protected function __construct()
    {
        parent::__construct();


        add_action('init', [$this, 'themeSetup']);
        add_action('admin_enqueue_scripts', [$this, 'themeEnqueueScripts']);
        add_action('after_setup_theme', [$this, 'registerNavMenus']);
        add_action('admin_menu', [$this, 'addAdminMenuPage']);

        $this->ajax();
    }

    public function addAdminMenuPage(): void
    {
        add_menu_page(
            __('Search and replace', 'src'),
            __('Search and replace', 'src'),
            'manage_options',
            'search-and-replace',
            [$this, 'renderAdminPage']
        );
    }

    public function renderAdminPage(): void
    {
        include SRP_PLUGIN_PATH . 'templates/admin/admin-template.php';
    }


    public function themeSetup(): void
    {

        add_theme_support('menus');
        add_theme_support('widgets');
        add_theme_support('custom-logo');
        add_theme_support('post-thumbnails');

        # Example of image sizes:
        add_image_size('hd-size', 1920, 1080, ['center', 'center']);

    }


    public function ajax():void
    {
        new AjaxHandler();
    }

    public function themeEnqueueScripts(): void
    {

        wp_enqueue_script('admin-srp-jQuery', 'https://code.jquery.com/jquery-1.11.2.min.js', [], '1.0.0', true);
        wp_enqueue_style('admin-srp-style', SRP_PLUGIN_URL . '/dist/app.css');
        wp_enqueue_script('admin-srp-script', SRP_PLUGIN_URL . '/dist/app.js', [], '1.0.0', true);

    }

    public function registerNavMenus(): void
    {

        $menus = [
            'primary' => esc_html__('Primary', 'tbc')
        ];

        register_nav_menus($menus);

    }

}
