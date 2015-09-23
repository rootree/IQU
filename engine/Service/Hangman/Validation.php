<?php
namespace IQU\Service\Hangman;

class Validation
{
    public function isAcceptableLetter($letter)
    {
        return preg_match ('/^[a-zA-Z]{1}$/', $letter);
    }
}