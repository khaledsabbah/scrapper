<?php

namespace Tests\Feature\Controllers\Api\V1;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class WebScrappingTest
 * @package Tests\Feature\Controllers\Api\V1
 */
class WebScrappingTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testSimpleTask() : void
    {
        $response = $this->call('get', '/api/v1/simpleTask/');
        $response->assertStatus(200)
            ->assertSee("lastPaginationNumber")
            ->assertSeeText("pages");
        $response= $response->getOriginalContent();
        $this->assertEquals(true, !empty($response['pages']));
        foreach ($response['pages'] as $page){
            $this->assertArrayHasKey("pageNum",$page);
            $this->assertNotEmpty($page['pageLinks']);
        }
    }
}
