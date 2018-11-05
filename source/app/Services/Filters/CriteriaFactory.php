<?php
/**
 * Created by PhpStorm.
 * User: khaledgamal
 * Date: 11/5/18
 * Time: 8:05 PM
 */

namespace App\Services\Filters;


use App\Contracts\ICriteria;
use App\Contracts\IFactory;

Abstract class CriteriaFactory implements IFactory
{

    public static function make(string $criteriaType): ICriteria
    {
        // TODO: Implement make() method.
        switch ($criteriaType) {
            case 'simple':
                return new SimpleCriteria();
                break;
            case 'advanced':
                return new AdvancedCriteria();
                break;
            default:
                return new SimpleCriteria();
                break;
        }
    }
}