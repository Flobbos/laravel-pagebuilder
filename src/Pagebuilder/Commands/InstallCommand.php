<?php

namespace Flobbos\Pagebuilder\Commands;

use Illuminate\Support\Str;
use InvalidArgumentException;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Illuminate\Support\Facades\Artisan;

class InstallCommand extends Command{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pagebuilder:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Runs migrations and installs boiler plate content.';
    
    protected $type = 'Install';
    
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(){
        $this->comment('Running migrations.');
        
        Artisan::call('migrate');
        
        $this->comment('Running seeds.');
        Artisan::call('db:seed',['--class'=>'Flobbos\\Pagebuilder\\Database\\Seeds\\ElementTableSeeder']);
        Artisan::call('db:seed',['--class'=>'Flobbos\\Pagebuilder\\Database\\Seeds\\LanguageTableSeeder']);
        
        $this->comment('Publishing package files');
        
        Artisan::call('vendor:publish',['--provider'=>'Flobbos\\Pagebuilder\\PagebuilderServiceProvider']);
        
        $this->info('Installation completed.');
    }
}
