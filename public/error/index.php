<?php


define('DEBUG', 1);


function debug($arr)
{
    echo '<pre>';
    print_r($arr);
    echo '</pre>';
    die;
}


class NotFoundException extends Exception
{
    /*
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
    */
    public function __construct($message = "", $code = 404)
    {
        parent::__construct($message, $code);
    }
}

# use \Exception;

/**
 * Class ErrorHandler
 *  Method set_error_handler() : позволяет создавать сообственного обработчик ошибок
 */
class ErrorHandler
{

    /**
     * ErrorHandler constructor.
     *
     * @return void
     */
     public function __construct()
     {
         // set error reporting
         $status = DEBUG ? -1 : 0;
         error_reporting($status);

         # NOTICE & FATAL ERRROR
         // set own error handler for fatal and notice errors
         set_error_handler([$this, 'errorHandler']);

         // this function executed always after execution your script
         ob_start();
         register_shutdown_function([$this, 'fatalErrorHandler']);

         # EXCEPTION ERROR
         // set own error handler for exception errors
         set_exception_handler([$this, 'exceptionHandler']);
     }


    /**
     * Error handling
     * [ This method mst to return true always, if return false it does mean has not errors ]
     *
     * Ex:
     *     echo '<pre>';
     *      var_dump($errno, $errstr, $errfile, $errline);
     *     echo '</pre>';
     *   int(8) [ code 8 is E_NOTICE : error notice ]
     *   string(24) "Undef:ined variable: test"
     *   string(50) "D:\OSPanel\domains\work.loc\public\error\index.php"
     *   int(53)
     *
     * @param int $errno         [ Code error ]
     * @param string $errstr     [ Message error ]
     * @param string $errfile    [ Full path of file where has been error ]
     * @param int $errline       [ Line where has been error ]
     * @return bool
     */
     public function errorHandler($errno, $errstr, $errfile, $errline)
     {
          $this->displayError($errno, $errstr, $errfile, $errline);
          return true;
     }


    /**
     *
     */
     public function fatalErrorHandler()
     {
         // get last error
         $error = error_get_last();  # debug($error);


         if( !empty($error) && $error['type'] & ( E_ERROR | E_PARSE | E_COMPILE_ERROR | E_CORE_ERROR) )
         {
             $this->logErrors($error['message'], $error['file'], $error['line']);
             ob_end_clean();
             $this->displayError($error['type'], $error['message'], $error['file'], $error['line']);
         }else{
             ob_end_flush();
         }
     }

    /**
     * Map Exception Errors
     *
     * @param Exception $e
     * @return void
     */
    public function exceptionHandler(Exception $e)
    {
        // debug($e);
        $this->logErrors($e->getMessage(), $e->getFile(), $e->getLine());
        $this->displayError('Exception', $e->getMessage(), $e->getFile(), $e->getLine(), $e->getCode());
    }


    /**
     * Log Errors
     *
     * @param string $message
     * @param string $file
     * @param string $line
     */
    protected function logErrors($message = '', $file = '', $line = ''){

        $output =  sprintf("[%s] Error Message: %s | File: %s, | Line: %s\n==========================\n",
            date('Y-m-d H:i:s'),
            $message,
            $file,
            $line
        );

        // error_log(text, message_type, destination)
        // [ save errors to email, set message_type = 1, destination = jeanyao@ymail.com ]
        // [ save errors to file, set message_type = 3, destination = /path/to/log/error.txt ]
        error_log($output, 3, __DIR__.'/temp/errors.log'); // ROOT . '/temp/errors.log'
    }


    /**
     * Display errrors
     *
     *
     * @param int $errno
     * @param string $errstr
     * @param string $errfile
     * @param int $errline
     * @param int $response [ response code ]
     */
    protected function displayError($errno, $errstr, $errfile, $errline, $response = 500)
    {
         http_response_code($response);

         if(DEBUG)
         {
              require 'views/dev.php';
         }else{
             require 'views/prod.php';
         }
         die;
    }
}

// instance
new ErrorHandler();

# Error Notice
// echo $test;

# Error Fatal
// test();

# Error Exception

/*
try
{
     if(empty($test))
     {
          throw new  Exception('Oops!, something went wrong!');
     }

}catch(Exception $e){
     echo '<pre>';
     print_r($e);
     echo '</pre>';
}

 throw new  Exception('Oops!, something went wrong!');
*/

throw new NotFoundException('Опаа, что то пошло не так!(');
throw new  Exception('Oops!, something went wrong!', 404);