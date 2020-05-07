<?php

namespace App\Helpers\Doggo;

use Illuminate\Support\Facades\Http;

/**
 * Class DoggoClient
 */
class DoggoClient
{
    private const BASE_URL = 'random.dog/';

    private const PHOTOS_URL = self::BASE_URL . 'doggos?include=png';

    private const PHOTO_URL = self::BASE_URL . 'woof?include=png';

    /**
     * @return array
     */
    public function getNewDoggos(): array
    {
        return json_decode(Http::get(self::PHOTOS_URL)->body());
    }

    /**
     * @return array
     */
    public function getOneDoggo(): array
    {
        return [Http::get(self::PHOTO_URL)->body()];
    }

    /**
     * @param string $url
     * @return string
     */
    public function getPhoto(string $url): string
    {
        return Http::get(self::BASE_URL . $url)->body();
    }
}
