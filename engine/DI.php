<?php
namespace IQU;

class DI
{
    /**
     * @return Router
     */
    static public function router()
    {
        $request = new DataSource\HttpRequest();
        return new Router($request);
    }

    /**
     * @return Render\Render
     */
    static public function render()
    {
        return new Render\Render();
    }

    static public function validationService()
    {
        return new Service\Hangman\Validation();
    }

    static public function hangman()
    {
        $validationService = self::validationService();
        $storage = self::storageSession();
        $storageWords = self::storageWords();
        return new Service\Hangman($storage, $storageWords, $validationService);
    }

    static public function storageSession()
    {
        return new Store\HangmanStore();
    }

    static public function storageWords()
    {
        return new Store\HangmanWords();
    }
}