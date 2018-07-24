<?php

namespace PHPixie\FrameworkBundle\Console;

use \PHPixie\Console\Exception\CommandException;

class GenerateBundle extends \PHPixie\Console\Command\Implementation
{
    protected $frameworkBuilder;
    
    public function __construct($config, $frameworkBuilder)
    {
        $this->frameworkBuilder = $frameworkBuilder;
        
        $config->description("Generate and a new bundle");
        
        $config->argument('name')
            ->required()
            ->description("Bundle name");
        
        $config->option('namespace')
            ->description("Bundle namespace. Defaults to the root namespace of your project.");
        
        $config->option('overwrite')
            ->flag()
            ->description("Whether to overwrite bundle files if they exist.");
        
        $config->option('skip-register')
            ->flag()
            ->description("Whether to skip registering the bundle within the project.");
        
        parent::__construct($config);
    }
    
    public function run($argumentData, $optionData)
    {
        $projectNamespace = explode("\\", get_class($this->frameworkBuilder));
        $projectNamespace = $projectNamespace[0];
        
        $bundleName = ucfirst($argumentData->getRequired('name'));
        $namespace = $optionData->get('namespace', $projectNamespace);
        
        $lowerName = strtolower($bundleName[0]).substr($bundleName, 1);
        $root = $this->frameworkBuilder->assets()->root();
        $actions = $this->frameworkBuilder->components()->filesystem()->actions();
        
        $path = $root->path('bundles/'.$lowerName).'/';
        if(file_exists($path)) {
            if($optionData->get('overwrite', false)){
                $actions->remove($path);
            } else {
                throw new CommandException("Path already exists: $path");
            }
        }
        
        
        $src = $this->getTemplateDirectory();
        
        $actions->copy($src, $path);
        $srcPath = $path.'src/';

        $actions->move($srcPath.'BNAMEBundle.php', $srcPath."{$bundleName}Bundle.php");
        $actions->move($srcPath.'BNAMEBuilder.php', $srcPath."{$bundleName}Builder.php");
        
        $this->replaceRecursive($path, [
            'BNAME' => $bundleName,
            'bname' => $lowerName,
            'NS'    => $namespace
        ]);

        $bundleNamespace = "$namespace\\$bundleName";
        $bundleClass = "\\$bundleNamespace\\{$bundleName}Bundle";
        $this->writeLine("Generated bundle $bundleName");
        
        if($optionData->get('skip-register', false)) {
            return;
        }
        
        $this->updateComposerJson($root->path('composer.json'), $lowerName, $bundleNamespace);
        $this->registerBundle($projectNamespace.'\Framework\Bundles', $bundleClass);
        $this->writeLine("Registered bundle $bundleClass");
        $this->writeLine("IMPORTANT: run 'composer install' to make generated classes autoloadable");
    }
    
    protected function replaceRecursive($path, $replaceMap)
    {
        $from = array_keys($replaceMap);
        $to = array_values($replaceMap);
        
        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator(
                $path,
                \RecursiveDirectoryIterator::SKIP_DOTS
            ),
            \RecursiveIteratorIterator::SELF_FIRST
        );
        
        foreach($iterator as $item) {
            if (!$item->isLink() && $item->isDir()) {
                continue;
            }
            
            $str = file_get_contents($item);
            $str = str_replace($from, $to, $str);
            file_put_contents($item, $str);
        }
    }
    
    protected function updateComposerJson($path, $lowerName, $namespace)
    {
        $this->writeLine("Updating composer.json");
        $composer = json_decode(file_get_contents($path), true);
        $srcPath = "bundles/$lowerName/src/";
        $composer['autoload']['psr-4'][$namespace."\\"] = array($srcPath);
        $composer = json_encode($composer, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        file_put_contents($path, $composer);
    }
    
    protected function registerBundle($bundlesClass, $bundle)
    {
        $this->writeLine("Registering bundle");
        
        $reflector = new \ReflectionClass($bundlesClass);
        $path = $reflector->getFileName();
        $str = file_get_contents($path);
        
        if(strpos($str, $bundle) !== false) {
            $this->writeLine("Class $bundle is already referenced in $bundlesClass. Skipping.");
            return;
        }
        
        $placeholder = '/*GeneratorPlaceholder*/';
        
        if(($pos = strpos($str, $placeholder)) === false) {
            $this->writeLine("No generator placeholder '$placeholder'' in $bundlesClass. Skipping.");
            return;
        }
        
        $pad = '';
        while($str[--$pos] == ' ') {
            $pad.=' ';
        }
        
        $str = str_replace($placeholder, ",new $bundle(\$this->builder)\n".$pad.$placeholder, $str);
        file_put_contents($path, $str);
    }
    
    protected function getTemplateDirectory()
    {
        return __DIR__.'/../../../../assets/bundleTemplate/';
    }
}