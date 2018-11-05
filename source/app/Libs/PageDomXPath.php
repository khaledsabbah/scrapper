<?php
/**
 * Created by PhpStorm.
 * User: khaledgamal
 * Date: 11/5/18
 * Time: 7:18 PM
 */

namespace App\Libs;


/**
 * Class DomXPath
 * @package App\Libs
 */
class PageDomXPath
{

    /**
     * @param string $page
     * @return DomXPath
     */
    public static function getXpathObj(string $page) : \DomXPath
    {
        $pageDom = new \DomDocument();
        libxml_use_internal_errors(true);
        @$pageDom->loadHTML($page);
        libxml_use_internal_errors(false);
        $pageXPath = new \DOMXPath($pageDom);
        return $pageXPath;
    }

}