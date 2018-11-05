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

            $this->scrappyService->getPageDom();

        } catch (\Exception $exception) {
            die($exception->getMessage());
        }

    }

}
