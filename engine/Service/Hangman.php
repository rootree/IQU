<?php
namespace IQU\Service;

class Hangman
{
    const DEFAULT_TRIES = 6;

    /**
     * @var \IQU\Store\HangmanStore
     */
    private $storeService;

    /**
     * @var \IQU\Store\HangmanWords
     */
    private $wordsService;

    /**
     * @var \IQU\Service\Hangman\Validation
     */
    private $validationService;

    public function __construct(
        \IQU\Store\HangmanStore $storeService,
        \IQU\Store\HangmanWords $wordsService,
        \IQU\Service\Hangman\Validation $validationService
    )
    {
        $this->storeService = $storeService;
        $this->wordsService = $wordsService;
        $this->validationService = $validationService;
    }

    public function decreaseCountOfTries()
    {
        $numberOfTr = $this->storeService->getCountOfTies();
        $numberOfTr--;
        $this->storeService->setCountOfTies($numberOfTr);
    }

    public function openLetter($letter)
    {
        if (in_array($letter, $this->storeService->getUsedLetter())) {
            return false;
        }
        $this->storeService->addUsedLetter($letter);
        if (strpos(strtolower($this->storeService->getWord()), $letter) === false) {
            return false;
        }
        $this->storeService->addRightLetter($letter);
        return true;
    }

    /**
     * @return mixed
     */
    public function getWord()
    {
        $word = $this->storeService->getWord();
        $rightLetters = $this->storeService->getRightLetter();
        $allLetters = strlen($word);

        for ($i = 0; $i < $allLetters; $i++) {
            if (!in_array($word[$i], $rightLetters)) {
                $word[$i] = '_';
            }
        }

        return $word;
    }

    /**
     * @return bool
     */
    public function isEndOfTheGame()
    {
        return ($this->storeService->getCountOfTies() == 0) || $this->isWordFound();
    }

    /**
     * @return bool
     */
    public function isWordFound()
    {
        $word = $this->storeService->getWord();
        $freq = [];
        $len = strlen($word);
        for ($i = 0; $i < $len; $i++) {
            $letter = $word[$i];
            if (empty($letter) ) {
                continue;
            }
            if ($this->validationService->isAcceptableLetter($letter) && !in_array($letter, $freq)) {
                $freq[] = $letter;
            }
        }
        return count($freq) == count($this->storeService->getRightLetter());
    }

    /**
     * @return mixed
     */
    public function getCountOfTries()
    {
        return $this->storeService->getCountOfTies();
    }

    public function reset()
    {
        $this->storeService->reset($this->generateWord(), self::DEFAULT_TRIES);
        return true;
    }

    public function generateWord()
    {
        $possible = $this->wordsService->getWords();
        return $possible[mt_rand(0, count($possible) - 1)];
    }
}