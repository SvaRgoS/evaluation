<?php

namespace Tests;

use Artisan;
use Illuminate\Contracts\Console\Kernel;

trait CreatesApplication
{
    private static $configurationApp = null;

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        return self::initialize();
    }

    public static function initialize()
    {
        if(is_null(self::$configurationApp)) {
            $app = require __DIR__ . '/../bootstrap/app.php';

            $app->make(Kernel::class)->bootstrap();
            if (config('database.default') == 'sqlite') {
                $db = app()->make('db');
                $db->connection()->getPdo()->exec("pragma foreign_keys=1");
            }

            self::$configurationApp = $app;
        }

        return self::$configurationApp;
    }

    public function tearDown(): void
    {
        if ($this->app) {
            foreach ($this->beforeApplicationDestroyedCallbacks as $callback) {
                call_user_func($callback);
            }
        }

        $this->setUpHasRun = false;

        if (property_exists($this, 'serverVariables')) {
            $this->serverVariables = [];
        }

        if (class_exists(\Mockery::class)) {
            \Mockery::close();
        }

        $this->afterApplicationCreatedCallbacks = [];
        $this->beforeApplicationDestroyedCallbacks = [];
    }
}
