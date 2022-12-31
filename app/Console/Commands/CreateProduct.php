<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\QueryException;

class CreateProduct extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:product {--name=} {--description=} {--price=} {--category_id=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new product';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $name = ($this->option('name'));
        $description = ($this->option('description'));
        $price = ($this->option('price'));
        $category_id = ($this->option('category_id'));
        if(!$name) $this->error('parameter name not found!');
        if(!$description) $this->error('parameter description not found!');
        if(!$price) $this->error('parameter price not found!');
        if(!$category_id) $this->error('parameter category_id not found!');
        try {
            $product = new \App\Models\Product();
            $product->name = $name;
            $product->description = $description;
            $product->price = $price;
            $product->category_id = $category_id;
            $product->save();
            $output = "Product name '$name' successfully created!";
            $this->info($output);
        }catch (QueryException $e){
            $this->error('Error: ' . $e->getMessage());
        }
    }
}
