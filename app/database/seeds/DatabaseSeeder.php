<?php

class DatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* CONFIG::ALL */
        //$this->call('XSeeder');

        /* CONFIG::LOCAL ONLY */
        if (App::environment('local')) {
            /* Nothing here */

        /* CONFIG::PRODUCTION ONLY */
        } else if (App::environment('production')) {
            /* Nothing here */

        }
    }

}
