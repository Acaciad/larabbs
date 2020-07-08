<?php

namespace App\Observers;

use App\Models\Links;
use Cache;
use App\User;
class LinkObserver
{
    // 在保存时清空 cache_key 对应的缓存
    public function saved(Links $link)
    {
        Cache::forget($link->cache_key);
    }
}
