<?php
namespace IQU\Render;

class Render
{
    const HOME_PAGE = 'home-page';
    const VIEW_EXT = '.phtml';

    private $viewsPath;

    public function __construct()
    {
        $this->viewsPath = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR;
    }

    public function show($output, $view)
    {
        global $globalOutput;
        $globalOutput = $output;

        $viewFile = $this->viewsPath . $view . self::VIEW_EXT;
        if (!file_exists($viewFile)) {
            include $this->viewsPath . self::HOME_PAGE . self::VIEW_EXT;
            return;
        }
        include $viewFile;
    }
}