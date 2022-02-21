<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;

class MakeCrudCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:crud {crud}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make files for crud';

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

        $_ = fn($x) => $x;
        $crud = $this->argument("crud");

        Artisan::call("make:view admin/{$_(Str::snake($crud))}_create");
        Artisan::call("make:view admin/{$_(Str::snake($crud))}_edit");
        Artisan::call("make:view admin/{$_(Str::snake($crud))}_all");
        Artisan::call("datatables:make {$_(Str::ucfirst(Str::camel($crud)))}");
        Artisan::call("make:model {$_(Str::ucfirst(Str::camel($crud)))} -m");
        Artisan::call("make:controller Admin/{$_(Str::ucfirst(Str::camel($crud)))}Controller -r");

        $this->info("Crud {$crud} created.");
    }
}
