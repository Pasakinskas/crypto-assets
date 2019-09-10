<?php


class AssetControllerTest extends TestCase {
    public function testGetAllAssets() {
        $this->get('/assets');
        $this->assertEquals(200, $this->response->getStatusCode(), "GET /assets status 200");
    }
}
