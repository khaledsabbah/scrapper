<?php
/**
 * Created by PhpStorm.
 * User: khaledgamal
 * Date: 11/6/18
 * Time: 12:31 AM
 */

namespace App\Services\Filters;


use App\Contracts\ICriteria;

/**
 * Class PaginationCriteria
 * @package App\Services\Filters
 */
class PaginationCriteria implements ICriteria
{

    /**
     * @param \DOMNodeList $domNodeList
     * @return array
     */
    public function meetCriteria(\DOMNodeList $domNodeList): array
    {
        return $domNodeList->length >= 1 ? [$domNodeList->item(0)] : [];
    }

    /**
     * @param \DOMNodeList $domNodeList
     * @return int
     */
    public function getLastPaginationNum(\DOMNodeList $domNodeList): int
    {
        $links = [];
        for ($i = $domNodeList->length; --$i >= 0;) {
            $href = $domNodeList->item($i)->firstChild->getAttribute('href');
            $hrefContents = explode('=', $href);
            $links[] = end($hrefContents);
        }
        return array_shift($links);
    }
}