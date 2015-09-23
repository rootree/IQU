<?php
namespace IQU\Store;

class HangmanStore
{
    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function reset($word, $countOfTies)
    {
        $_SESSION['usedLetter'] = [];
        $_SESSION['rightLetter'] = [];
        $_SESSION['word'] = $word;
        $_SESSION['countOfTies'] = $countOfTies;
    }

    /**
     * @return mixed
     */
    public function getUsedLetter()
    {
        return $_SESSION['usedLetter'];
    }


    /**
     * @return mixed
     */
    public function getRightLetter()
    {
        return $_SESSION['rightLetter'];
    }

    /**
     * @return mixed
     */
    public function getWord()
    {
        return strtolower($_SESSION['word']);
    }

    /**
     * @return mixed
     */
    public function getCountOfTies()
    {
        return $_SESSION['countOfTies'];
    }

    /**
     * @param mixed $usedLetter
     */
    public function addUsedLetter($usedLetter)
    {
        $_SESSION['usedLetter'][] = $usedLetter;
    }

    /**
     * @param mixed $rightLetter
     */
    public function addRightLetter($rightLetter)
    {
        $_SESSION['rightLetter'][] = $rightLetter;
    }

    /**
     * @param mixed $word
     */
    public function setWord($word)
    {
        $_SESSION['word'] = $word;
    }

    /**
     * @param mixed $countOfTies
     */
    public function setCountOfTies($countOfTies)
    {
        $_SESSION['countOfTies'] = $countOfTies;
    }
}