<?php
/**
 * Created by PhpStorm.
 * User: khaledgamal
 * Date: 11/5/18
 * Time: 8:56 PM
 */

namespace App\Transformers;


use App\Contracts\Itransform;
use App\Entities\Page;

abstract class PageTransformer implements Itransform
{
    public static function transform(int $pageNum, array $pageLinks): Page
    {
        $page = new Page();
        $page->setPageNumber($pageNum);
        $page->setPageLinks($pageLinks);
        return $page;
    }

}