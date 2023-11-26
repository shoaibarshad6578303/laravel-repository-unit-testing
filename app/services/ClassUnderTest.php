<?php

namespace App\services;

use App\services\MockTestService;

class ClassUnderTest
{
    protected $mockTestService;

    public function __construct(MockTestService $mockTestService)
    {
        $this->mockTestService = $mockTestService;
    }

    public function someMethod()
    {
        // Do something and call the getName method of MockTestService
        return $this->mockTestService->getName();
    }
}