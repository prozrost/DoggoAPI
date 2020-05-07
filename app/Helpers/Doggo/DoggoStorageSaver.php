<?php

namespace App\Helpers\Doggo;

use Illuminate\Support\Facades\Storage;

/**
 * Class DoggoStorageSaver
 */
class DoggoStorageSaver
{
    /**
     * @param string $fileResponse
     * @param string $baseName
     */
    public function save(string $fileResponse, string $baseName): void
    {
        Storage::put('doggos/' . $baseName, $fileResponse);
    }

    /**
     * @param string $fileName
     */
    public function delete(string $fileName): void
    {
        Storage::delete('doggos/' . $fileName);
    }
}
