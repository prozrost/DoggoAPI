<?php

namespace Tests\Feature;

use App\Helpers\Doggo\DoggoClient;
use Illuminate\Support\Facades\Storage;
use Tests\Feature\Mocks\DoggoClientMock;
use Tests\TestCase;

/**
 * Class DoggoTest
 */
class DoggoTest extends TestCase
{
    private const DOGGO_URL = 'api/doggos';

    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $clientMockObject = (new DoggoClientMock())->create();

        $this->app->bind(DoggoClient::class, function () use ($clientMockObject) {
            return $clientMockObject->getMock();
        });

        Storage::fake();
    }

    /**
     * @return void
     */
    public function testResponseHasFiveItems(): void
    {
       $response = $this->get(self::DOGGO_URL)->getOriginalContent();

       $this->assertCount(5, $response['data']);
    }

    /**
     * @return void
     */
    public function testFilesExist(): void
    {
        $response = $this->get(self::DOGGO_URL)->getOriginalContent();

        $this->assertCount(5, $response['data']);

        $files = Storage::allFiles('doggos/');

        $this->assertCount(5, $files);
    }

    /**
     * @return void
     */
    public function testNewFirstDoggoOthersOld(): void
    {
        $response = $this->get(self::DOGGO_URL)->getOriginalContent();

        $responseSecond = $this->get(self::DOGGO_URL)->getOriginalContent();

        $this->assertCount(5, $responseSecond['data']);

        foreach ($response['data'] as $key => $firstElement) {
            if ($key === 0) {
                $this->assertNotEquals($firstElement, $responseSecond['data'][$key]);
                continue;
            }

            $this->assertEquals($response['data'][$key], $responseSecond['data'][$key]);
        }
    }
}
