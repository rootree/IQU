<?php
namespace IQU\DataSource;

class HttpRequest
{
    private $parameters;

    public function __construct()
    {
        $this->parameters = $_REQUEST;
    }

    public function getParameter($name)
    {
        $name = strtolower($name);
        if (array_key_exists($name, $this->parameters)) {
            return strtolower($this->parameters[$name]);
        }
        return null;
    }

    public function getURL()
    {
        $ap = strpos($_SERVER['REQUEST_URI'], '?');
        if ($ap) {
            return substr($_SERVER['REQUEST_URI'], 0, $ap);
        } else {
            return $_SERVER['REQUEST_URI'];
        }
    }
}