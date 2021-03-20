<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class addview extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'addview {model}';
    protected $path = "resources\\views\\admin\\page";

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
        $this->info($this->argument('model'));
        $file =Str::ucfirst($this->argument('model')) ;
        $dir = $this->path.'\\'.$this->argument('model');
        File::makeDirectory($dir, 777, true , true);
//        File::put($dir , 'add'.$file.'.blade.php',true);
//        File::put($dir, 'edit'.$file.'.blade.php',true);
//        File::put($dir , 'list'.$file.'.blade.php',true);
//        Storage::put($dir, )
        if (!file_exists($dir.'\\'."add".$file.'.blade.php')) {
            fopen($dir.'\\'."add".$file.'.blade.php', "w");
        }
        if (!file_exists($dir.'\\'."edit".$file.'.blade.php')) {
            fopen($dir.'\\'."edit".$file.'.blade.php', "w");
        }
        if (!file_exists($dir.'\\'."list".$file.'.blade.php')) {
            fopen($dir.'\\'."list".$file.'.blade.php', "w");
        }




//        fopen($dir.'\\'."edit".$file.'.blade.php', "x+");
//        fopen($dir.'\\'."list".$file.'.blade.php', "x+");
//        fopen("edit".$file.'.blade.php', "w");
//        fopen("list".$file.'.blade.php', "w");
        $this->info('making '.$dir);

        return 0;
    }
}
