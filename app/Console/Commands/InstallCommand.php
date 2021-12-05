<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'warehouse:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install Warehouse demo project';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->welcome();
        $this->createDbFile();
        $this->createEnvFile();

        $this->call('config:cache');
        $this->call('migrate:fresh', ['--seed' => true, '--force' => true]);
        $this->call('key:generate');

        $this->call('config:clear');
        $this->goodbye();
    }

    /**
     * Display the welcome message.
     */
    protected function welcome()
    {
        $this->info('>> Welcome to the Sqlearn installation process! <<');
    }

    /**
     * Create the initial .env file.
     */
    protected function createEnvFile()
    {
        if (!file_exists('.env')) {
            copy('.env.example', '.env');

            $this->line('.env file successfully created');
        } else {
            $this->line('.env file already exists');
        }
    }


    /**
     * Create the initial database.sqlite file.
     */
    protected function createDbFile()
    {
        if (!file_exists(database_path('database.sqlite'))) {
            touch(database_path('database.sqlite'));

            $this->line('Sqlite db successfully created');
        }
    }

    /**
     * Display the completion message.
     */
    protected function goodbye()
    {
        $this->info('>> The installation process is complete! <<');
    }


}
