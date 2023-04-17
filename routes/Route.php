<?php

class Route
{
    private string $path;
    private $callback;
    private array $params = [];

    public function __construct($path, $callback)
    {
        $this->path = trim($path, '/');
        $this->callback = $callback;
    }

    /**
     * @param $url
     * @return bool
     */
    public function match($url): bool
    {
        $url = trim($url, '/');
        $path = preg_replace_callback('#:([\w]+)#', [$this, 'paramMatch'], $this->path);
        $regex = "#^$path$#i";

        if (!preg_match($regex, $url, $matches)) {
            return false;
        }

        array_shift($matches);
        $this->params = $matches;

        return true;
    }

    /**
     * @param $match
     * @return string
     */
    private function paramMatch($match): string
    {
        if (isset($_GET[$match[1]])) {
            return '(' . $_GET[$match[1]] . ')';
        }

        return '([^/]+)';
    }

    public function run()
    {
        return call_user_func_array($this->callback, $this->params);
    }
}