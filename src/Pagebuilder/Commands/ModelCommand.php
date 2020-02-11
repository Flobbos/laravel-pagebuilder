<?php

namespace Flobbos\Pagebuilder\Commands;

use Illuminate\Support\Str;
use InvalidArgumentException;
use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Illuminate\Support\Str;

class ModelCommand extends GeneratorCommand{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pagebuilder:model {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a Pagebuilder model';
    
    protected $type = 'Model';
    
    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace){
        return $rootNamespace;
    }
    
    protected function replaceDummyTable($name){
        $class = Str::replace($this->getNamespace($name).'\\', '', $name);
        return Str::plural(strtolower(snake_case($class)));
    }
    
    protected function replaceDummyClass($name){
        return Str::replace($this->getNamespace($name).'\\', '', $name);
    }
    
    /**
     * Build the class with the given name.
     *
     * Remove the base controller import if we are already in base namespace.
     *
     * @param  string  $name
     * @return string
     */
    protected function buildClass($name){
        
        $replace = [
            'DummyClass' => $this->replaceDummyClass($name),
            'DummyTable' => $this->replaceDummyTable($name)
        ];
        //dd($replace);
        return Str::replace(
            array_keys($replace), array_values($replace), parent::buildClass($name)
        );
    }
    
    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub(){
        return __DIR__.'/../../resources/stubs/models/article.stub';
    }
    
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(){
        $this->comment('Building pagebuilder model');
        $name = $this->qualifyClass($this->getNameInput());
        $path = $this->getPath($name);
        if ($this->alreadyExists($this->getNameInput())) {
            $this->error($this->type.' already exists!');
            return false;
        }
        
        // Next, we will generate the path to the location where this class' file should get
        // written. Then, we will build the class and make the proper replacements on the
        // stub files so that it gets the correctly formatted namespace and class name.
        $this->makeDirectory($path);
        $this->files->put($path, $this->buildClass($name));

        $this->info($this->type.' created successfully.');
        
    }
}
