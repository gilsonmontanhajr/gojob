<?php

namespace PHPixie\FrameworkBundle\Console;

use \PHPixie\Console\Exception\CommandException;

class InstallWebAssets extends \PHPixie\Console\Command\Implementation
{
    protected $assets;
    protected $bundles;
    protected $filesystem;
    
    public function __construct($config, $assets, $bundles, $filesystem)
    {
        $this->assets  = $assets;
        $this->bundles = $bundles;
        $this->filesystem = $filesystem;
        
        $config->description("Symlink or copy bundle web files to the projects web folder");
        
        $config->option('copy')
            ->flag()
            ->description("Whether to copy web directories instead of symlinking them");
        
        parent::__construct($config);
    }
    
    public function run($argumentData, $optionData)
    {
        $actions = $this->filesystem->actions();
        $copy = $optionData->get('copy', false);
        
        if($copy) {
            $this->writeLine("Copying web asset directories:");
        }else {
            $this->writeLine("Symlinking web asset directories:");
        }
        
        $path = $this->assets->webRoot()->path('bundles');
        
        $actions->remove($path);
        $actions->createDirectory($path);
        
        foreach($this->bundles->bundles() as $name => $bundle) {
            if(!($bundle instanceof \PHPixie\Bundles\Bundle\Provides\WebRoot)) {
                continue;
            }
                
            if(($bundleRoot = $bundle->webRoot()) === null) {
                continue;
            }
            
            $this->writeLine("Bundle: $name");
            $bundlePath = $path.'/'.$name;
            
            if($copy) {
                $actions->copy($bundleRoot->path(), $path.'/'.$name);
                continue;
            }
            
            try{
                $actions->symlink($bundleRoot->path(), $path.'/'.$name);
            } catch (\Exception $e) {
                $message = 'Failed to create a symlink. If using Windows re-run this command as administrator.';
                throw new CommandException($message);
            }
        }
    }
}
