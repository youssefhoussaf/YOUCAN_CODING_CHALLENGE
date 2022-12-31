<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\QueryException;

class CreateCategory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:category {--name=} {--parent_category=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new category';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $name = ($this->option('name'));
        $parent_category = ($this->option('parent_category'));
        if(!$name) $this->error('parameter name not found!');
        try {
            $category = new \App\Models\Category();
            $category->name = $name;
            $category->parent_category = $parent_category??null;
            $category->save();
            $output = "Category name '$name' successfully created!";
            $this->info($output);
        }catch (QueryException $e){
            $this->error('Error: ' . $e->getMessage());
        }
    }
}
