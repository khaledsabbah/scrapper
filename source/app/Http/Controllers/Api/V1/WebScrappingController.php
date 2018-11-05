<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\ApiController;
use App\Services\ScrappyService;
use Illuminate\Http\Request;


class WebScrappingController extends ApiController
{

    private $scrappyService;


    public function __construct(ScrappyService $scrappyService)
    {
        $this->scrappyService = $scrappyService;
    }

    public function simpleTask()
    {
        try {
            $data = [];
            $pages = $this->scrappyService->getPageDomLinks();
            foreach ($pages as $index => $page) {
                $data[$page->getPageNumber()]['pageNum'] = $page->getPageNumber();
                $data[$page->getPageNumber()]['pageLinks'] = $page->getPageLinks();
            }
            return $this->setStatusCode(200)
                ->respond($data);
        } catch (\Exception $exception) {
            $this->respondValidationErrors($exception->getMessage());
        }

    }

}
