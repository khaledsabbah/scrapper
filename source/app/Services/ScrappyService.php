<?php
/**
 * Created by PhpStorm.
 * User: khaledgamal
 * Date: 11/5/18
 * Time: 3:16 PM
 */

namespace App\Services;


use App\Exceptions\WebsiteNotFoundException;
use App\Libs\CurlRequest;
use App\Libs\PageDomXPath;

class ScrappyService
{
    private $simpleTaskUrls = ["https://www.homegate.ch/mieten/immobilien/kanton-zuerich/trefferliste?ep=1"];
    private $advancedTaskUrls = ["https://www.newhome.ch/de/kaufen/immobilien/haus/bauernhaus/ort_effretikon/5.0_zimmer/detail.aspx?pc=new& id=N875 &liste=1"];

    public function getPageDom()
    {
        try{
            $pageDome = CurlRequest::curlGetRequest($this->simpleTaskUrls[0], 'GET');
            $links= PageDomXPath::getXpathObj($pageDome)->query('//a');

            for ($i = $links->length; --$i >= 0; ) {
                $el = $links->item($i)->getAttribute('href');
                echo $el."<br>";
            }
        }catch (WebsiteNotFoundException $websiteNotFoundException){
            // Pages limit Logic
            die($websiteNotFoundException->getMessage());
        }

    }



}