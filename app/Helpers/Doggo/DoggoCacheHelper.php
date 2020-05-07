<?php

namespace App\Helpers\Doggo;

use Illuminate\Support\Facades\Cache;

/**
 * Class DoggoCacheHelper
 */
class DoggoCacheHelper
{
    public const DOGGO_DEFAULT_KEY = 'doggo';

    /**
     * @param array $photos
     * @return void
     */
    public function save(array $photos): void
    {
        Cache::put(self::DOGGO_DEFAULT_KEY, $photos);
    }

    /**
     * @return mixed
     */
    public function get()
    {
        return Cache::get(self::DOGGO_DEFAULT_KEY);
    }
}
