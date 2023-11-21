<?php

namespace App\Console\Commands;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;

class InitializeTestEnvironment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:initialize-test-environment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Initialize the testing environment with just one command.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if (App::environment() === 'production') {
            throw new Exception('this command must never be executed in a NON development environment');
        }

        $this->call('migrate:fresh', ['--seed' => false], $this->output);

        $this->info("\n\nLoading Roles...");
        $this->call('roles:load', [], $this->output);

        $this->info("\n\nSeeding Data");
        $this->call('db:seed');

        $this->call('passport:install', [], $this->output);
    }
}
