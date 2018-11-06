<?php
/**
 * Created by PhpStorm.
 * User: khaledgamal
 * Date: 11/5/18
 * Time: 4:45 PM
 */

namespace App\Services\Filters;




use App\Contracts\ICriteria;

/**
 * Class SimpleCriteria
 * @package App\Services\Filters
 */
class SimpleCriteria  implements  ICriteria
{

    /**
     * @param \DOMNodeList $domNodeList
     * @return array
     */
    public function meetCriteria(\DOMNodeList  $domNodeList) :array
    {
        $links= [];
        for ($i = $domNodeList->length; --$i >= 0; ) {
            $href = $domNodeList->item($i)->getAttribute('href');
            $hrefContents= explode('/', $href);
            if(is_numeric(end($hrefContents))){
                $links[]=$href;
            }
        }
        return $links;
    }

}