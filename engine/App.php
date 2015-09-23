<?php
namespace IQU;

class App
{
    public function init()
    {
        $this->loadClasses();
    }

    private function loadClasses()
    {
        $directory = new \RecursiveDirectoryIterator(__DIR__);
        $recIterator = new \RecursiveIteratorIterator($directory);
        $regex = new \RegexIterator($recIterator, '/.php$/i');

        foreach ($regex as $item) {
            require_once $item->getPathname();
        }

    }

    public function run()
    {
        $router = DI::router();
        $output = $router->getOutputByRequest();
        DI::render()->show($output, $router->getPath());
    }
}