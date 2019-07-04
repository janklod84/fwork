<?php


class Request
{

    const URL_PARAM = [
        'REQUEST_URI',
        'QUERY_STRING',
        'PATH_INFO'
    ];

    private static $instance;

    /**
     * Get Request instance
     *
     * @return self
     */
    public static function instance()
    {
        if(is_null(self::$instance))
        {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /*
     * Get URL
     *
     * @param string $param
     * @return string
    */
    public function url($param=null)
    {
        if($param && $url = $this->server($param))
        {
            return $url;
        }
        foreach(self::URL_PARAM as $key){
            if($url = $this->server($key))
            {
                echo $key, '<br>';
                return $url;
            }
        }

    }


    /**
     * Get item from server
     *
     * @param null $key
     * @return mixed|null
     */
    public function server($key=null)
    {
        return isset($_SERVER[$key]) ? $_SERVER[$key] : null;
    }
}