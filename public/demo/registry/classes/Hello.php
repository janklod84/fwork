<?php
namespace classes;


class Hello
{

    public function friend($name='')
    {
        if($name)
        {
            $name = ', '. $name;
        }
        echo 'Bonjour' . $name .'<br>';
    }

}