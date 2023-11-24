<?php

namespace Tests;

use App\Models\Config;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\RefreshDatabaseState;
use Illuminate\Support\Facades\DB;

trait RefreshDatabaseCustom
{
    use RefreshDatabase;

    public function refreshTestDatabase()
    {
        if(DB::getDefaultConnection() !== 'mysql_testing'){
            dd('Database connection is not correct');
        }

        if (! RefreshDatabaseState::$migrated) {
            $this->artisan('migrate:fresh', $this->migrateFreshUsing());

            $this->app[Kernel::class]->setArtisan(null);

            RefreshDatabaseState::$migrated = true;
        }

        $this->beginDatabaseTransaction();
    }
}
