<?php


class AssetControllerTest extends TestCase {

    private function getJwtToken() {
        return "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6NiwiZW1haWwiOiJ0ZXN0ZW1haWxAZW1haWwuY29tIn0.yO-AdgtzjJu44sQqHft8S6eAJEH7pcXwlHrrG41i5AU";
    }

    private function getAssetId() {
        return 10;
    }

    public function testGetAllUserAssets() {
        $this->get('/assets', ["token" => $this->getJwtToken()]);
        $this->assertEquals(200, $this->response->getStatusCode(), "GET /assets status 200");
        $this->isType("array");
    }

    public function testGetAllUserAssetsWithoutAuth() {
        $this->get('/assets');
        $this->assertEquals(403, $this->response->getStatusCode(), "GET /assets fails without auth");
    }

    public function testGetUserAssetById() {
        $this->get('/assets/' . $this->getAssetId(), ["token" => $this->getJwtToken()]);
        $this->assertEquals(200, $this->response->getStatusCode(), "GET /assets/id status 200");
    }
}
