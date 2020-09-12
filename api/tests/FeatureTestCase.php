<?php

namespace Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\WithFaker;

abstract class FeatureTestCase extends BaseTestCase
{
    use CreatesApplication, WithFaker, RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
    }
}
