<?php

use App\Models\Asset;
use Firebase\JWT\JWT;

class AssetControllerTest extends TestCase {

    public function testGetAllUserAssets() {
        $this->get('/assets', ["token" => $this->getJwtToken()]);
        $this->assertEquals(200, $this->response->getStatusCode());
        $this->isType("array");
    }

    public function testGetAllUserAssetsWithoutAuth() {
        $this->get('/assets');
        $this->assertEquals(403, $this->response->getStatusCode());
    }

    public function testGetUserAssetById() {
        $this->get('/assets/' . $this->getAssetId(), ["token" => $this->getJwtToken()]);
        $this->assertEquals(200, $this->response->getStatusCode());
    }

    private function getJwtToken() {
        $payload = array(
            "id" => 1,
            "email" => "test@gmail.com"
        );

        return JWT::encode($payload, env("JWT_SECRET"));
    }

    private function getAssetId() {
        return Asset::where("user_id", 1)->get()[0]["id"];
    }
}
