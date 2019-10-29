<?php

namespace Mkdevs\MultiTenant\Commands;

use DB;
use Config;
use Illuminate\Console\Command;

class TenantSeed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tenant:seed {database} {--connection=} {--class=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed tenant\'s database';

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
        $class = $this->option('class');
        $database = $this->argument('database');        
        $connection = $this->option('connection') ?? Config::get('database.default');

        DB::purge($connection);
        Config::set('database.default', $connection);
        Config::set('database.connections.'.$connection.'.database', $database);

        $this->call('db:seed', $class ? ['--class' => $class] : []);
    }
}
