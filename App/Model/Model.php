<?php

namespace App\Model;

class Model
{

    public static function setData($iDs, $searchData, $oldValue, $trigger): void
    {
        global $wpdb;
        $table = $wpdb->posts;
        $col = '';
        switch ($trigger) {
            case 'input-search-title':
                $col   = 'post_title';
                $table = $wpdb->posts;
                break;
            case 'input-search-content':
                $col   = 'post_content';
                $table = $wpdb->posts;
                break;
            case 'input-search-meta-title':
                $colName   = '_yoast_wpseo_title';
                $col       = 'meta_value';
                $table = $wpdb->postmeta;
                break;
            case 'input-search-meta-description':
                $colName   = '_yoast_wpseo_metadesc';
                $col       = 'meta_value';
                $table     = $wpdb->postmeta;
                break;
        }


        if('wp_posts' === $table){
            $data = "UPDATE {$table}
                     SET {$col} = REPLACE({$col}, '{$oldValue}', '{$searchData}')
                     WHERE ID IN ({$iDs})";
        }

        if('wp_postmeta' === $table){
            $data = "UPDATE {$table}
                     SET {$col} = REPLACE({$col}, '{$oldValue}', '{$searchData}')
                     WHERE post_id IN ({$iDs}) AND meta_key = '{$colName}';
                     ";
        }

        $wpdb->query($data);
    }

    public static function getPostContentAndSeoData(string $searchData = ''): array|object|null
    {
        global $wpdb;

        $sql = "SELECT DISTINCT 
                p.ID AS post_id,
                p.post_title AS title,
                p.post_content AS content,
                m1.meta_key AS seo_title_key,
                m1.meta_value AS seo_title_value,
                m2.meta_key AS seo_metadesc_key,
                m2.meta_value AS seo_metadesc_value
            FROM
                {$wpdb->posts} p
            LEFT JOIN
                wp_postmeta m1 ON p.ID = m1.post_id AND m1.meta_key = '_yoast_wpseo_title'
            LEFT JOIN
                wp_postmeta m2 ON p.ID = m2.post_id AND m2.meta_key = '_yoast_wpseo_metadesc'
            WHERE
                (p.post_title LIKE '%{$searchData}%' OR p.post_content LIKE '%{$searchData}%')
                AND (p.post_type = 'post' OR p.post_type = 'page') 
            ORDER BY
                p.ID;";

        return $wpdb->get_results($sql);
    }


    public static function getPostContentAndSeoDataIDs(string $ids = ''): array|object|null
    {
        global $wpdb;

        $sql = "SELECT
                p.ID AS post_id,
                p.post_title AS title,
                p.post_content AS content,
                m1.meta_key AS seo_title_key,
                m1.meta_value AS seo_title_value,
                m2.meta_key AS seo_metadesc_key,
                m2.meta_value AS seo_metadesc_value
            FROM
                wp_posts p
            LEFT JOIN
                wp_postmeta m1 ON p.ID = m1.post_id AND m1.meta_key = '_yoast_wpseo_title'
            LEFT JOIN
                wp_postmeta m2 ON p.ID = m2.post_id AND m2.meta_key = '_yoast_wpseo_metadesc'
            WHERE
                p.ID IN ({$ids})
            ORDER BY
                p.ID;";

        return $wpdb->get_results($sql);
    }


}