<?php

namespace Flobbos\Pagebuilder\Commands;

use Illuminate\Support\Str;
use InvalidArgumentException;
use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class ControllerCommand extends GeneratorCommand{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pagebuilder:controller {name} {--route=pagebuilder.pages} {--views=vendor.pagebuilder.pages}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a controller for pages.';
    
    protected $type = 'Controller';
    
    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace){
        return $rootNamespace.'\Http\Controllers';
    }
    
    protected function replaceViewPath(){
        return $this->option('views');
    }
    
    protected function replaceDummyRoute(){
        return $this->option('route');
    }
    
    protected function replaceDummySetClass(){
        return Str::singular(strtolower(str_replace('Controller', '', $this->getNameInput())));
    }
    
    protected function replaceDummyVariable(){
        return Str::singular(strtolower(str_replace('Controller', '', $this->getNameInput())));
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
        $controllerNamespace = $this->getNamespace($name);

        $replace["use {$controllerNamespace}\Controller;\n"] = '';
        $replace = array_merge($replace, [
            'DummyViewPath' => $this->replaceViewPath(),
            'DummyRoute' => $this->replaceDummyRoute(),
            'DummySetClass' => $this->replaceDummySetClass(),
            'DummyVariable' => $this->replaceDummyVariable(),
        ]);
        //dd($replace);
        return str_replace(
            array_keys($replace), array_values($replace), parent::buildClass($name)
        );
    }
    
    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub(){
        return __DIR__.'/../../resources/stubs/controllers/page_controller.stub';
    }
    
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(){
        $this->comment('Building pagebuilder resource controller');
        
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
