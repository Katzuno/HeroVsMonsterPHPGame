<?php


class RoutesContoller
{
    private $_url = [];

    /**
     * We will build a collection of internal URL's
     * @param $url
     */
    public function add($url)
    {
        $this->$url[] = $url;
    }

    public function submit()
    {
        $urlParam = isset($_GET['uri']) ? $_GET['uri'] : '/';

        foreach ($this->_url as $key => $value)
        {
            if (preg_match("#^$value$#", $urlParam))
            {
                echo 'Match';
            }
        }
    }
}