<?php

namespace Database\Seeders;

use App\Models\Currency;
use App\Models\Expense;
use Illuminate\Database\Seeder;

class ExpenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Expense::factory(1)->create();
    }
}
