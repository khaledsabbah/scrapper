<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\ApiController;
use App\Services\ScrappyService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class WebScrappingController extends ApiController
{

    private $scrappyService;


    public function __construct(ScrappyService $scrappyService)
    {
        $this->scrappyService = $scrappyService;
    }

    public function simpleTask() :JsonResponse
    {
        $data = [];
        try {
            $data['lastPaginationNumber']= $this->scrappyService->getTotalPagesNumber();
            $pages = $this->scrappyService->getPageDomLinks();
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
