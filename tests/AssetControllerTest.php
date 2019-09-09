<?php


class AssetControllerTest extends TestCase {
    public function testGetAllUsers() {
        $this->get('/assets');
        $this->assertEquals(200, $this->response->getStatusCode(), "GET /assets status 200");
    }
}
