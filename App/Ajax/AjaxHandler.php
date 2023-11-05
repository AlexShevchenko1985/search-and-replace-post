<?php

namespace App\Ajax;



use App\Model\Model;

final class AjaxHandler
{
    public function __construct()
    {
        add_action('wp_ajax_handle', [$this, 'handle']);
        add_action('wp_ajax_handleReplace', [$this, 'handleReplace']);
    }

    public function handleReplace(): void
    {

        $searchData = (!empty($_POST['value'])) ? sanitize_text_field($_POST['value']) : '';
        $oldValue   = (!empty($_POST['oldValue'])) ? sanitize_text_field($_POST['oldValue']) : '';
        $trigger    = (!empty($_POST['trigger'])) ? sanitize_text_field($_POST['trigger']) : '';
        $ids        = (!empty($_POST['ids'])) ? sanitize_text_field($_POST['ids']) : [];

        Model::setData($ids, $searchData, $oldValue, $trigger);

        $postData = Model::getPostContentAndSeoDataIDs($ids);

        ob_start();
        if (!empty($postData)) {
            foreach ($postData as $value) {
                include SRP_PLUGIN_PATH . 'template-parts/table-item.php';

            }
        } else {
            include SRP_PLUGIN_PATH . 'template-parts/no-item.php';
        }


        $output['content'] = ob_get_contents();
        ob_end_clean();

        wp_send_json($output);
    }

    public function handle(): void
    {

        $searchData = (!empty($_POST['value'])) ? sanitize_text_field($_POST['value']) : '';


        $postData = Model::getPostContentAndSeoData($searchData);

        ob_start();
        if (!empty($postData)) {
            foreach ($postData as $value) {
                include SRP_PLUGIN_PATH . 'template-parts/table-item.php';
                $output['ids'][] = $value->post_id;
            }
        } else {
            include SRP_PLUGIN_PATH . 'template-parts/no-item.php';
        }


        $output['content'] = ob_get_contents();
        ob_end_clean();

        wp_send_json($output);
    }
}



