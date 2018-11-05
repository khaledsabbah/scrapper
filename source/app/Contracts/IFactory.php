<?php
/**
 * Created by PhpStorm.
 * User: khaledgamal
 * Date: 11/5/18
 * Time: 8:09 PM
 */

namespace App\Contracts;


interface IFactory
{
    public static function make(string $criteriaType) :ICriteria;
}