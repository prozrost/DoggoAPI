<?php

namespace Tests\Feature\Mocks;

use App\Helpers\Doggo\DoggoClient;
use PHPUnit\Framework\MockObject\MockObject;
use Tests\TestCase;

class DoggoClientMock extends TestCase
{
    /**
     * @var MockObject
     */
    protected $mock;

    /**
     * @return MockObject
     */
    public function getMock()
    {
        return $this->mock;
    }

    /**
     * @return $this
     */
    public function create()
    {
        $this->mock = $this->getMockBuilder(DoggoClient::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->mock->method('getNewDoggos')
            ->will($this->returnValue([
                time() . '.png',
                time() . '.png',
                time() . '.png',
                time() . '.png',
                time() . '.png'
            ]));

        $this->mock->method('getOneDoggo')
            ->will($this->returnValue([ time() . '.png' ]));

        $this->mock->method('getPhoto')
            ->will($this->returnValue(imagecreatetruecolor(120, 20)));


        return $this;
    }
}
