<?php
/**
 * Created by PhpStorm.
 * User: khaledgamal
 * Date: 11/5/18
 * Time: 8:53 PM
 */

namespace App\Contracts;


use App\Entities\Page;

/**
 * Interface Itransform
 * @package App\Contracts
 */
interface Itransform
{
    /**
     * @param int $pageNum
     * @param array $pageLinks
     * @return Page
     */
    public static  function transform(int $pageNum, array $pageLinks): Page;
}