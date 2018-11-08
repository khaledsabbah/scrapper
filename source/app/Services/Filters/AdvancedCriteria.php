<?php
/**
 * Created by PhpStorm.
 * User: khaledgamal
 * Date: 11/5/18
 * Time: 8:16 PM
 */

namespace App\Services\Filters;


use App\Contracts\ICriteria;

class AdvancedCriteria implements ICriteria
{

    public function meetCriteria(\DOMNodeList $domNodeList): array
    {
        dd($domNodeList);
        $links= [];
        for ($i = $domNodeList->length; --$i >= 0; ) {
            $href = $domNodeList->item($i)->getAttribute('href');
            $hrefContents= array_filter(explode('&', $href), function($linkPart){
                return strpos(strtolower($linkPart),'id=')==0;
            });
            if(!empty($hrefContents)){
                $links[]=$href;
            }
        }
        dd($links);
        return $links;
    }
}