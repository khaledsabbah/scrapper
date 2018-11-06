<?php

namespace Tests\Feature\Services;

use App\Services\ScrappyService;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class ScrappingServiceTest
 * @package Tests\Feature\Services
 */
class ScrappingServiceTest extends TestCase
{
    /**
     * @var
     */
    private $scrappyService;

    /**
     ** @return void
     */
    public function setUp() :void 
    {
        $this->scrappyService = new ScrappyService();
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetPageDomLinks(): void
    {
        $response = $this->scrappyService->getPageDomLinks();
        $this->assertNotEmpty($response);
        foreach ($response as $page) {
            $this->assertEquals('integer',gettype($page->getPageNumber()));
            $this->assertNotEmpty($page->getPageLinks());
            $this->assertEquals(20, count($page->getPageLinks()));
        }

    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetTotalPagesNumber() :void
    {
        $response = $this->scrappyService->getTotalPagesNumber();
        $this->assertEquals('integer',gettype($response));
        $this->assertEquals(50,$response);
    }
}
