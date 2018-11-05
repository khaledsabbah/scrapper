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

class ScrappyService
{

    private $simpleTaskUrls = "https://www.homegate.ch/mieten/immobilien/kanton-zuerich/trefferliste?ep=1";
    private $advancedTaskUrls = ["https://www.newhome.ch/de/kaufen/immobilien/haus/bauernhaus/ort_effretikon/5.0_zimmer/detail.aspx?pc=new& id=N875 &liste=1"];

    public function getPageDomLinks() : array
    {
        try {
            $pageDome = CurlRequest::curlGetRequest($this->simpleTaskUrls, 'GET');
            $links = CriteriaFactory::make('simple')->meetCriteria(PageDomXPath::getXpathObj($pageDome)->query('//a'));
            return [PageTransformer::transform($pageNum=1,$links)];


        } catch (WebsiteNotFoundException $websiteNotFoundException) {
            // Pages limit Logic
            die($websiteNotFoundException->getMessage());
        }

    }


}