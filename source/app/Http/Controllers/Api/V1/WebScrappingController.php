<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\ApiController;
use App\Services\ScrappyService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


/**
 * Class WebScrappingController
 * @package App\Http\Controllers\Api\V1
 */
class WebScrappingController extends ApiController
{

    /**
     * @var ScrappyService
     */
    private $scrappyService;
    /**
     * @var string
     */
    private $simpleTaskUrls = "https://www.homegate.ch/mieten/immobilien/kanton-zuerich/trefferliste?ep=";
    /**
     * @var string
     */
    private $advancedTaskUrls = "https://www.newhome.ch/de/kaufen/suchen/haus_wohnung/kanton_zuerich/liste.aspx?p=1";


    /**
     * WebScrappingController constructor.
     * @param ScrappyService $scrappyService
     */
    public function __construct(ScrappyService $scrappyService)
    {
        $this->scrappyService = $scrappyService;
    }

    /**
     * @return JsonResponse
     */
    public function simpleTask() :JsonResponse
    {
        $data = [];
        try {
            $data['lastPaginationNumber']= $this->scrappyService->getTotalPagesNumber($this->simpleTaskUrls);
            $pages = $this->scrappyService->getPageDomLinks($this->simpleTaskUrls,'simple');
            foreach ($pages as $index => $page) {
                $data["pages"][$page->getPageNumber()]['pageNum'] = $page->getPageNumber();
                $data["pages"][$page->getPageNumber()]['pageLinks'] = $page->getPageLinks();
            }
        } catch (WebsiteNotFoundException $websiteNotFoundException) {
            return $this->respondValidationErrors($websiteNotFoundException->getMessage());
        } catch (\Exception $exception) {
            return $this->respondValidationErrors($exception->getMessage());
        }
        return $this->setStatusCode(200)
            ->respond($data);

    }

    public function advancedTask()
    {
        $data = [];
        try {
//            $data['lastPaginationNumber']= $this->scrappyService->getTotalPagesNumber();
            $pages = $this->scrappyService->getPageDomLinks($this->advancedTaskUrls, 'advanced', $proxy=true);
            foreach ($pages as $index => $page) {
                $data["pages"][$page->getPageNumber()]['pageNum'] = $page->getPageNumber();
                $data["pages"][$page->getPageNumber()]['pageLinks'] = $page->getPageLinks();
            }
        } catch (WebsiteNotFoundException $websiteNotFoundException) {
            return $this->respondValidationErrors($websiteNotFoundException->getMessage());
        } catch (\Exception $exception) {
            return $this->respondValidationErrors($exception->getMessage());
        }
        return $this->setStatusCode(200)
            ->respond($data);


    }

}
