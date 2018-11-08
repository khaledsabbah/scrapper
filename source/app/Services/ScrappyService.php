<?php
/**
 * Created by PhpStorm.
 * User: khaledgamal
 * Date: 11/5/18
 * Time: 3:16 PM
 */

namespace App\Services;


use App\Entities\Page;
use App\Exceptions\WebsiteNotFoundException;
use App\Libs\CurlRequest;
use App\Libs\PageDomXPath;
use App\Services\Filters\CriteriaFactory;
use App\Transformers\PageTransformer;

/**
 * Class ScrappyService
 * @package App\Services
 */
class ScrappyService
{
    /**
     * @param string $url
     * @return array
     * @throws WebsiteNotFoundException
     */
    public function getPageDomLinks(string $url , string $criteriaType, bool $proxy=false): array
    {
        $pageNum = 1;
        $numOfPagesScrapped=2;
        $totalPages = [];
        while ($pageNum < $numOfPagesScrapped) {
            $pageDome = CurlRequest::curlGetRequest($url, 'GET', $proxy);
            $links = CriteriaFactory::make($criteriaType)->meetCriteria(PageDomXPath::getXpathObj($pageDome)->query('//a'));
            $totalPages[] = PageTransformer::transform($pageNum, $links);
            $pageNum++;
        }
        return $totalPages;

    }


    /**
     * @param string|null $url
     * @param bool $proxy
     * @return int
     * @throws WebsiteNotFoundException
     */
    public function getTotalPagesNumber(string $url = null, bool $proxy=false): int
    {
        $lastPageNum = 0;
        $pageNum = 1;
        while ($pageNum > 0) {
            $pageDome = CurlRequest::curlGetRequest($url . $pageNum, 'GET', $proxy);
            $paginationCriteria = CriteriaFactory::make('pagination');
            $xPathObj = PageDomXPath::getXpathObj($pageDome);
            $paginations = $paginationCriteria->meetCriteria($xPathObj->query("(//li[@class='next'])"));
            if (empty($paginations)) {
                $lastPageNum = $paginationCriteria->getLastPaginationNum($xPathObj->query("(//li[@class='page-link'])[last()]"));
                $pageNum = -5;
            } else {
                $pageNum += 15;
            }
        }
        return $lastPageNum;

    }


}