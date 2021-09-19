<?php

namespace App\Console\Commands;

use App\Models\Category;
use Illuminate\Console\Command;
use Str;

class GenSlugCagegoryCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gen:slug';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        Category::get()->each(function ($cate) {
            $cate->slug = Str::slug($cate->name) . '-' . Str::random(6);
            $cate->save();
        });

        return 0;
    }
}
