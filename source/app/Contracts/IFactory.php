<?php
/**
 * Created by PhpStorm.
 * User: khaledgamal
 * Date: 11/5/18
 * Time: 8:09 PM
 */

namespace App\Contracts;


/**
 * Interface IFactory
 * @package App\Contracts
 */
interface IFactory
{
    /**
     * @param string $criteriaType
     * @return ICriteria
     */
    public static function make(string $criteriaType) :ICriteria;
}