<?php

use eloquentFilter\QueryFilter\QueryFilter;
use eloquentFilter\ServiceProvider;
use Mockery as m;

/**
 * Class TestCase.
 */
class TestCase extends Orchestra\Testbench\TestCase
{
    /**
     * @var m\LegacyMockInterface|m\MockInterface
     */
    public $request;

    public function setUp(): void
    {
        parent::setUp();

        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
        $this->withFactories(__DIR__.'/database/factories');

        $this->request = m::mock(\Illuminate\Http\Request::class);

        $this->app->singleton(
            'eloquentFilter',
            function () {
                return new QueryFilter($this->request->query());
            }
        );
    }
}
