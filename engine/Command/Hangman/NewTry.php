<?php

namespace IQU\Command\Hangman;

use IQU\Command;

class NewTry implements Command\Command
{
    /**
     * @var \IQU\Service\Hangman\Validation
     */
    private $validationHangmanService;

    /**
     * @var \IQU\Service\Hangman
     */
    private $hangmanService;

    public function __construct(
        \IQU\Service\Hangman $hangmanService,
        \IQU\Service\Hangman\Validation $validationService
    )
    {
        $this->validationHangmanService = $validationService;
        $this->hangmanService = $hangmanService;
    }

    public function run(\IQU\DataSource\HttpRequest $request)
    {
        $letter = $request->getParameter('letter');
        $return = [
            'illegalLetter' => 0,
            'isFinish' => 0,
            'isWin' => 0,
            'word' => $this->hangmanService->getWord(),
            'triesLeft' => $this->hangmanService->getCountOfTries()
        ];
        if (!$this->validationHangmanService->isAcceptableLetter($letter)) {
            $return['illegalLetter'] = 1;
            return $return;
        }

        if (!$this->hangmanService->openLetter($letter)) {
            $this->hangmanService->decreaseCountOfTries();
        }

        return [
            'illegalLetter' => 0,
            'isFinish' => $this->hangmanService->isEndOfTheGame(),
            'isWin' => $this->hangmanService->isWordFound(),
            'word' => $this->hangmanService->getWord(),
            'triesLeft' => $this->hangmanService->getCountOfTries()
        ];
    }
}