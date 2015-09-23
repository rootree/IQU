<?php
namespace IQU;

class Router
{
    private $path = '/';

    /**
     * @var DataSource\HttpRequest
     */
    private $request;

    public function __construct(DataSource\HttpRequest $request)
    {
        $this->request = $request;
    }

    /**
     * @return Command\Command|null
     */
    public function getOutputByRequest()
    {
        $this->path = $this->request->getURL();
        switch ($this->path) {
            case '/start-game':
                $hangmanService = DI::hangman();
                $command = new Command\Hangman\StartGame($hangmanService);
                break;
            case '/new-try':
                $validationService = DI::validationService();
                $hangmanService = DI::hangman();
                $command = new Command\Hangman\NewTry(
                    $hangmanService,
                    $validationService
                );
                break;
            default:
                return null;
        }

        $output = null;
        if ($command) {
            $output = $command->run($this->request);
        }

        return $output;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }
}