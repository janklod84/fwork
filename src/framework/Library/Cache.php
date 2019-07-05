<?php
namespace Project\Library;


/**
 * Class Cache
 *
 * @package Project\Library\Cache
 */
class Cache
{

     public function __construct()
     {
     }


    /**
     * Set cache
     *
     * time() : current time
     *
     * @param string $key
     * @param mixed $data
     * @param int $seconds [1h = 3600s]
     * @return bool
     */
     public function set($key, $data, $seconds = 3600)
     {
         $content['data'] = $data;
         $content['end_time'] = time() + $seconds;

         if(file_put_contents(CACHE.'/' . md5($key) . '.txt', serialize($content)))
         {
              return true;
         }

         return false;
     }

    /**
     * Get cache item
     *
     *
     * @param $key
     * @return  mixed
     */
     public function get($key)
     {
         $file = CACHE . '/' . md5($key) . '.txt';
         if(file_exists($file))
         {
            $content = unserialize(file_get_contents($file));

             // determine if valid cache time [ actual ]
             // если текущее время меньше или равно срок годности данный кэш (cache)
             if(time() <= $content['end_time']) // актуален
             {
                 return $content['data'];
             }
             unlink($file); // так как не актуален мы удаляем данный файл
         }

          return false; // в случае если файл не существует
     }


    /**
     * Delete data from cache
     *
     * @param $key
     * @return void
     */
     public function delete($key)
     {
         $file = CACHE . '/' . md5($key) . '.txt';
         if(file_exists($file))
         {
             unlink($file);
         }
     }


}