<?php

namespace Mkdevs\MultiTenant\Commands;

use DB;
use Config;
use Illuminate\Console\Command;

class TenantCreate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tenant:create {database} {--connection=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new mysql database schema';

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
     * @return mixed
     */
    public function handle()
    {
        $database = preg_replace('/[^A-Za-z0-9_]/', '', $this->argument('database'));
        $database = preg_replace("/^[0-9 ]+/", "", $database);
        $connection = $this->option('connection') ?? Config::get('database.default');

        DB::purge($connection);
        Config::set('database.default', $connection);

        $query = "CREATE DATABASE IF NOT EXISTS $database";

        DB::statement($query);
    }

}
