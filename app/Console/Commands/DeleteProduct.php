<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DeleteProduct extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:product {--id=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete a product by id';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $id = ($this->option('id'));
        if(!$id) $this->error('parameter id not found!');
        \App\Models\Product::find($id)->delete();
        $output = "Product id: $id successfully deleted!";
        $this->info($output);
    }
}
