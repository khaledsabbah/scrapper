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
     * @var string
     */
    private $simpleTaskUrls = "https://www.homegate.ch/mieten/immobilien/kanton-zuerich/trefferliste?ep=";
    /**
     * @var array
     */
    private $advancedTaskUrls = ["https://www.newhome.ch/de/kaufen/immobilien/haus/bauernhaus/ort_effretikon/5.0_zimmer/detail.aspx?pc=new& id=N875 &liste=1"];

    /**
     * @return array
     * @throws WebsiteNotFoundException
     */
    public function getPageDomLinks(): array
    {
        $pageNum = 1;
        $totalPages = [];
        while ($pageNum < 3) {
            $pageDome = CurlRequest::curlGetRequest($this->simpleTaskUrls . $pageNum, 'GET');
            $links = CriteriaFactory::make('simple')->meetCriteria(PageDomXPath::getXpathObj($pageDome)->query('//a'));
            $totalPages[] = PageTransformer::transform($pageNum, $links);
            $pageNum++;
        }
        return $totalPages;

    }

    /**
     * @return int
     * @throws WebsiteNotFoundException
     */
    public function getTotalPagesNumber() :int
    {
        $lastPageNum = 0;
        $pageNum = 1;
        while ($pageNum > 0) {
            $pageDome = CurlRequest::curlGetRequest($this->simpleTaskUrls . $pageNum, 'GET');
            $paginationCriteria = CriteriaFactory::make('pagination');
            $xPathObj = PageDomXPath::getXpathObj($pageDome);
            $paginations = $paginationCriteria->meetCriteria($xPathObj->query("(//li[@class='next'])"));
            if (empty($paginations)) {
                $lastPageNum = $paginationCriteria->getLastPaginationNum($xPathObj->query("(//li[@class='page-link'])[last()]"));
                $pageNum = -5;
            }else{
                $pageNum += 15;
            }
        }
        return $lastPageNum;

    }


}