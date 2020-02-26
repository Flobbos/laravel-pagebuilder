<?php

namespace Flobbos\Pagebuilder\Commands;

use Illuminate\Support\Str;
use InvalidArgumentException;
use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class ViewCommand extends GeneratorCommand{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pagebuilder:views {path} {--route=pagebuilder.pages}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates views for your resources generation.';
    
    protected $type = 'Views';
    private $current_stub;
    
    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub(){
        return [
            'index.blade.php'=>__DIR__.'/../../resources/stubs/views/pages/index.stub',
            'create.blade.php'=>__DIR__.'/../../resources/stubs/views/pages/create.stub',
            'edit.blade.php'=>__DIR__.'/../../resources/stubs/views/pages/edit.stub'
            ];
    }
    
    protected function getPathInput(){
        return trim($this->argument('path'));
    }
    
    /**
     * Get the destination class path.
     *
     * @param  string  $name
     * @return string
     */
    protected function getPath($name){
        return resource_path('views/vendor/'.$this->getDirectoryName($name));
    }
    
    protected function getDirectoryName($name){
        return  Str::plural(strtolower(Str::kebab(str_replace('.', '/', $name))));
    }
    
    /**
     * Replace the service variable in the stub using pluralization
     *
     * @param  string  $stub
     * @param  string  $name
     * @return string
     */
    protected function replaceDummyRoute($name){
        return $this->option('route');
    }
    
    protected function replaceViewPath($name){
        return str_replace('/', '.', $this->argument('path'));
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
        $replace = [
            'DummyViewPath' => $this->replaceViewPath($name),
            'DummyRoute' => $this->replaceDummyRoute($name)
        ];
        return str_replace(
            array_keys($replace), array_values($replace), $this->generateClass($name)
        );
    }
    
    protected function generateClass($name){
        $stub = $this->files->get($this->current_stub);
        return $this->replaceNamespace($stub, $name)->replaceClass($stub, $name);
    }
    
    /**
     * Determine if the class already exists.
     *
     * @param  string  $rawName
     * @return bool
     */
    protected function alreadyExists($rawName){
        return $this->files->exists($this->getPath($this->getPathInput()));
    }
    
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(){
        $this->comment('Building new resource views.');
        
        $path = $this->getPath(strtolower(Str::kebab($this->getPathInput())));
        if ($this->alreadyExists($this->getPathInput())) {
            $this->error($this->type.' already exists!');
            return false;
        }
        
        // Next, we will generate the path to the location where this class' file should get
        // written. Then, we will build the class and make the proper replacements on the
        // stub files so that it gets the correctly formatted namespace and class name.
        foreach($this->getStub() as $name=>$stub){
            $this->current_stub = $stub;
            $this->makeDirectory($path.'/'.$name);
            $this->files->put($path.'/'.$name, $this->buildClass($this->getPathInput()));
        }
        $this->info($this->type.' created successfully.');
    }
}
