<?php

namespace IQU\Command\Hangman;

use IQU\Command;

class StartGame implements Command\Command {

    /**
     * @var \IQU\Service\Hangman
     */
    private $hangmanService;

    public function __construct(
        \IQU\Service\Hangman $hangmanService
    ) {
        $this->hangmanService = $hangmanService;
    }

    public function run(\IQU\DataSource\HttpRequest $request) {
        $this->hangmanService->reset();
        return [
            'word' => $this->hangmanService->getWord(),
            'triesLeft' => $this->hangmanService->getCountOfTries()
        ];
    }
}