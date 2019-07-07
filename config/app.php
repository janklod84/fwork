<?php

/**
 *  components : there are all classes must to run when initialized application
 *  [ components : sont les classes qui doivent etre initialiser des le demarrage de notre Application
 */
$config = [
    'components' => [
        'cache' => 'Project\Library\Cache',
    ],
    /*
    'modules' => [
        'test' => 'Project\Modules\Test'
    ],
    'settings' => []
    */
];

return $config;