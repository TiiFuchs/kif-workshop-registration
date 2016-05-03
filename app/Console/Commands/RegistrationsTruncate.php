<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RegistrationsTruncate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'registrations:truncate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Removes all entries from registrations table.';

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
        \DB::table('registrations')->truncate();
        $this->info("Registrations truncated.");
    }
}
