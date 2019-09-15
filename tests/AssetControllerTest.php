<?php

use App\Models\Asset;
use App\Models\User;
use Firebase\JWT\JWT;

class AssetControllerTest extends TestCase {

    public function testGetAllUserAssets() {
        $this->get("/assets", $this->getAuthHeaders());
        $this->assertEquals(200, $this->response->getStatusCode());
        $this->isType("array");
    }

    public function testGetAllUserAssetsWithoutAuth() {
        $this->get("/assets");
        $this->assertEquals(403, $this->response->getStatusCode());
    }

    public function testGetUserAssetById() {
        $this->get("/assets/" . $this->getFirstAssetId(), $this->getAuthHeaders());
        $this->assertEquals(200, $this->response->getStatusCode());
    }

    public function testCreateNewAsset() {
        $this->post("/assets", [
            "label" => "my new investment",
            "currency" => "BTC",
            "value" => 0.05
        ], $this->getAuthHeaders());

        $this->assertEquals(201, $this->response->getStatusCode());

        $resBody = json_decode($this->response->content(), true);
        $this->assertArrayHasKey("id", $resBody);
        $this->assertArrayHasKey("currency", $resBody);
        $this->assertArrayHasKey("value", $resBody);
        $this->assertArrayHasKey("created_at", $resBody);
    }

    public function testFailToCreateWithNoLabel() {
        $this->post("/assets", [
            "currency" => "BTC",
            "value" => 0.05
        ], $this->getAuthHeaders());

        $this->assertEquals(422, $this->response->getStatusCode());
    }

    public function testFailToCreateWithBadCurrency() {
        $this->post("/assets", [
            "label" => "my new investment",
            "currency" => "BTCCC",
            "value" => 0.05
        ], $this->getAuthHeaders());

        $this->assertEquals(400, $this->response->getStatusCode());
    }

    public function testDeleteAssetById() {
        $this->delete("/assets/" . $this->getFirstAssetId(), [], $this->getAuthHeaders());
        $this->assertEquals(204, $this->response->getStatusCode());
    }

    public function testFailDeleteWithBadId() {
        $this->delete("/assets/" . "44444", [], $this->getAuthHeaders());
        $this->assertEquals(404, $this->response->getStatusCode());
    }

    private function getAuthHeaders() {
        $user = User::where("email", "test@user.com")->first();
        $token = JWT::encode([
            "id" => $user->id,
            "email" => $user->email,
        ], env("JWT_SECRET"));

        return [ "token" => $token ];
    }

    private function getFirstAssetId() {
        $testUserId = User::where("email", "test@user.com")->first()["id"];
        return Asset::where("user_id", $testUserId)->first()["id"];
    }
}
