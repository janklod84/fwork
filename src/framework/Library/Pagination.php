<?php
namespace Project\Library;


/**
 * Class Pagination
 * TO Refactoring
 *
 *
 * @package Project\Library
 */
class Pagination
{

    /**
     * @var int $currentPage [ Current Page ]
     * @var int $perpage     [ Number of articles to show per page]
     * @var int $total       [ Total count articles ]
     * @var int $countPages  [ Total count pages ]
     * @var string $uri      [ URI ]
     */
    public $currentPage;
    public $perpage;
    public $total;
    public $countPages;
    public $uri;


    /**
     * Pagination constructor.
     *
     *
     * @param $page
     * @param $perpage
     * @param $total
     * @return void
     */
    public function __construct($page, $perpage, $total){
        $this->perpage = $perpage;
        $this->total = $total;
        $this->countPages = $this->getCountPages();
        $this->currentPage = $this->getCurrentPage($page);
        $this->uri = $this->getParams();
    }


    /**
     * Strigify [ Get Object as string ]
     *
     * @return string
     */
    public function __toString(){
        return $this->getHtml();
    }


    /**
     * Get HTML template
     *
     * @return string
     */
    public function getHtml(){
        $back = null; // back link
        $forward = null; // next link
        $startpage = null; // start link
        $endpage = null; // end link
        $page2left = null; //  second left page
        $page1left = null; // first left page
        $page2right = null; // second right page
        $page1right = null; // first rihgt page

        if( $this->currentPage > 1 ){
            $back = "<li><a class='nav-link' href='{$this->uri}page=" .($this->currentPage - 1). "'>&lt;</a></li>";
        }

        if( $this->currentPage < $this->countPages ){
            $forward = "<li><a class='nav-link' href='{$this->uri}page=" .($this->currentPage + 1). "'>&gt;</a></li>";
        }

        if( $this->currentPage > 3 ){
            $startpage = "<li><a class='nav-link' href='{$this->uri}page=1'>&laquo;</a></li>";
        }
        if( $this->currentPage < ($this->countPages - 2) ){
            $endpage = "<li><a class='nav-link' href='{$this->uri}page={$this->countPages}'>&raquo;</a></li>";
        }
        if( $this->currentPage - 2 > 0 ){
            $page2left = "<li><a class='nav-link' href='{$this->uri}page=" .($this->currentPage-2). "'>" .($this->currentPage - 2). "</a></li>";
        }
        if( $this->currentPage - 1 > 0 ){
            $page1left = "<li><a class='nav-link' href='{$this->uri}page=" .($this->currentPage-1). "'>" .($this->currentPage-1). "</a></li>";
        }
        if( $this->currentPage + 1 <= $this->countPages ){
            $page1right = "<li><a class='nav-link' href='{$this->uri}page=" .($this->currentPage + 1). "'>" .($this->currentPage+1). "</a></li>";
        }
        if( $this->currentPage + 2 <= $this->countPages ){
            $page2right = "<li><a class='nav-link' href='{$this->uri}page=" .($this->currentPage + 2). "'>" .($this->currentPage + 2). "</a></li>";
        }

        return '<ul class="pagination">' . $startpage.$back.$page2left.$page1left.'<li class="active"><a>'.$this->currentPage.'</a></li>'.$page1right.$page2right.$forward.$endpage . '</ul>';
    }


    /**
     * Get count pages
     *
     * @return int
     */
    public function getCountPages(){
        return ceil($this->total / $this->perpage) ?: 1;
    }


    /**
     * Get current Page
     *
     *
     * @param $page
     * @return int
     */
    public function getCurrentPage($page){
        if(!$page || $page < 1) $page = 1;
        if($page > $this->countPages) $page = $this->countPages;
        return $page;
    }


    /**
     * Get Start page
     * Ex:
     *  [$this->>currentPage = 1 , 2..] , (1 - 1) * 1 = 0, (2 - 1) * 2 = 2
     *
     * @return float|int
     */
    public function getStart(){
        return ($this->currentPage - 1) * $this->perpage;
    }


    /**
     * Get params
     *  Traitement complex URL
     *
     * Ex: $uri = http://work.loc/category/phones/?page=2&lang=en
     *  getParams() => http://work.loc/category/phones/?page=2
     * @return string
     */
    public function getParams(){
        $url = $_SERVER['REQUEST_URI'];
        $url = explode('?', $url);
        $uri = $url[0] . '?';
        if(isset($url[1]) && $url[1] != ''){
            $params = explode('&', $url[1]);
            foreach($params as $param){
                if(!preg_match("#page=#", $param)) $uri .= "{$param}&amp;";
            }
        }
        return $uri;
    }
}