<?php

namespace App\Http\Controllers\API;

use App\Helpers\Doggo\DoggoBaseHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

/**
 * Class PhotoController
 */
class PhotoController extends Controller
{
    private const BASE_DOGGO_AMOUNT = 5;

    /**
     * @param DoggoBaseHelper $helper
     * @return JsonResponse
     */
    public function get(DoggoBaseHelper $helper): JsonResponse
    {
        return response()->json([
            'data' => $helper->getDoggos(self::BASE_DOGGO_AMOUNT)
        ]);
    }
}
