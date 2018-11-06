<?php
/**
 * Created by PhpStorm.
 * User: khaledgamal
 * Date: 11/5/18
 * Time: 4:43 PM
 */

namespace App\Contracts;


/**
 * Interface ICriteria
 * @package App\Contracts
 */
interface ICriteria
{
    /**
     * @param \DOMNodeList $domNodeList
     * @return array
     */
    public function meetCriteria(\DOMNodeList $domNodeList) :array ;
}