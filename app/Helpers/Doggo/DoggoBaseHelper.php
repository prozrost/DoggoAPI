<?php

namespace App\Helpers\Doggo;

/**
 * Class DoggoBaseHelper
 */
class DoggoBaseHelper
{
    /**
     * @var DoggoClient
     */
    private $doggoClient;

    /**
     * @var DoggoStorageSaver
     */
    private $doggoStorage;

    /**
     * @var DoggoCacheHelper
     */
    private $doggoCache;

    public function __construct()
    {
        $this->doggoClient = new DoggoClient();
        $this->doggoStorage = new DoggoStorageSaver();
        $this->doggoCache = new DoggoCacheHelper();
    }

    /**
     * @param int $amount
     * @return array
     */
    public function getDoggos(int $amount): array
    {
        $photos = $this->doggoCache->get();

        if (empty($photos)) {
            $photos = $this->createAndSaveNewDoggos($amount);

            $this->doggoCache->save($photos);

            return $photos;
        }

        $this->doggoStorage->delete($photos[0]);

        $photos[0] = $this->createAndSaveNewDoggos(1)[0];

        return $photos;
    }

    /**
     * @param int $amount
     * @return array
     */
    private function createAndSaveNewDoggos(int $amount): array
    {
        $start = 0;
        $names = [];

        $photoUrls = $amount === 1 ? $this->doggoClient->getOneDoggo() : $this->doggoClient->getNewDoggos();

        foreach ($photoUrls as $photoUrl) {
            if ($start < $amount) {
                $photo = $this->doggoClient->getPhoto($photoUrl);

                $photoBaseName = basename($photoUrl);

                $this->doggoStorage->save($photo, $photoBaseName);

                $names[] = $photoBaseName;

                $start++;
            }
        }

        return $names;
    }
}
