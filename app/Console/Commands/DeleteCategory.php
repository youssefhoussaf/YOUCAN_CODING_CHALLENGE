<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DeleteCategory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:category {--id=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete a category by id';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $id = ($this->option('id'));
        if(!$id) $this->error('parameter id not found!');
        \App\Models\Category::find($id)->delete();
        $output = "Category id: $id successfully deleted!";
        $this->info($output);
    }
}
