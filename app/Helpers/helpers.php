<?php

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

if (! function_exists('site_setting')) {
    /**
     * Lê um grupo do site_settings com cache.
     * Ex.: site_setting('footer'), site_setting('footer', 'email', 'n/a')
     */
    function site_setting(string $group, ?string $key = null, $default = null) {
        $data = Cache::remember("sitesettings:{$group}", 600, function () use ($group) {
            $row = DB::table('site_settings')->where('group', $group)->first();
            if (! $row) return [];
            $json = is_array($row->data) ? $row->data : json_decode($row->data ?? '[]', true);
            return is_array($json) ? $json : [];
        });

        if ($key === null) return $data;
        return data_get($data, $key, $default);
    }
}
