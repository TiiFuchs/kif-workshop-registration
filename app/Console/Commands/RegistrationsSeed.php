<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RegistrationsSeed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'registrations:seed {num=100}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fills registration table with dummy data.';

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
        //
        $num = $this->argument('num');
        factory(\App\Registration::class, $num)->create();
        $this->info("$num registration entries created.");
    }
}
