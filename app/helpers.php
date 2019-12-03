<?php

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;


if (!function_exists('route_class')) {
    /**
     * 根据当前路由 生成 class
     * @return mixed
     */
    function route_class()
    {
        return str_replace('.', '-', Route::currentRouteName());
    }
}


if (!function_exists('if_route')) {
    /**
     * Check if the name of the current route matches one of specific values
     *
     * @param array|string $routeNames
     *
     * @return bool
     */
    function if_route($routeNames)
    {
        return app('active')->checkRoute($routeNames);
    }
}


if (!function_exists('active_class')) {
    /**
     * Get the active class if the condition is not falsy
     *
     * @param        $condition
     * @param string $activeClass
     * @param string $inactiveClass
     *
     * @return string
     */
    function active_class($condition, $activeClass = 'active', $inactiveClass = '')
    {
        return app('active')->getClassIf($condition, $activeClass, $inactiveClass);
    }
}

if (!function_exists('if_query')) {
    /**
     * Check if one of the following condition is true:
     * + the value of $value is `false` and the current querystring contain the key $key
     * + the value of $value is not `false` and the current value of the $key key in the querystring equals to $value
     * + the value of $value is not `false` and the current value of the $key key in the querystring is an array that
     * contains the $value
     *
     * @param string $key
     * @param mixed $value
     *
     * @return bool
     */
    function if_query($key, $value)
    {
        return app('active')->checkQuery($key, $value);
    }
}

if (!function_exists('markDownToHtml')) {

    function markDownToHtml($body, $rule = 'markdownNoH1_6', $limit = null)
    {
        $html = app('Parsedown')->setBreaksEnabled(TRUE)->text($body);
        /** XSS 防注入 */
        $html = clean($html, $rule);
        $html = str_replace("<pre><code>", '<pre><code class=" language-php">', $html);
        return $html;
    }
}

if (!function_exists('getImageUrl')) {

    function getImageUrl($relativePath = '')
    {
        if ($relativePath) {
            return asset($relativePath);
        }
        return asset('images/public/default_avatar.jpg');
    }
}


if (!function_exists('make_excerpt')) {

    function make_excerpt($value, $length = 200)
    {
        $excerpt = trim(preg_replace('/\r\n|\r|\n+/', ' ', strip_tags($value)));
        return Str::limit($excerpt, $length);
    }
}

/**
 * 文章浏览量计算
 */
if (!function_exists('topic_view')) {

    function topic_view($topic_id, $ip)
    {
        $cache_key = $ip . ':' . $topic_id;
        if (!Cache::has($cache_key)) {
            Cache::put($cache_key, time(), 3600);
            DB::table('topics')->where('id', $topic_id)->increment('view_count');
        }
    }
}


