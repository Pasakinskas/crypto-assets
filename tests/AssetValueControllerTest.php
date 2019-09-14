<?php


use App\Models\Asset;
use App\Models\User;
use Firebase\JWT\JWT;

class AssetValueControllerTest extends TestCase {

    public function testGetAllAssetsValue() {
        $this->get("/assets/value", $this->getAuthHeaders());
        $this->assertEquals(200, $this->response->getStatusCode());

        $resBody = json_decode($this->response->content(), true);
        $this->assertArrayHasKey("currency", $resBody);
        $this->assertArrayHasKey("assetValue", $resBody);

        $value = (float) $resBody["assetValue"];
        $this->assertNotEquals(0, $value);
    }

    public function testGetOneAssetValue() {
        $this->get("/assets/" . $this->getFirstAssetId() . "/value", $this->getAuthHeaders());
        $this->assertEquals(200, $this->response->getStatusCode());

        $resBody = json_decode($this->response->content(), true);
        $this->assertArrayHasKey("currency", $resBody);
        $this->assertArrayHasKey("assetValue", $resBody);

        $value = (float) $resBody["assetValue"];
        $this->assertNotEquals(0, $value);
    }

    public function testGetAllAssetsInNonDefaultCurrency() {
        $this->get("/assets/value?currency=eur", $this->getAuthHeaders());
        $this->assertEquals(200, $this->response->getStatusCode());

        $resBody = json_decode($this->response->content(), true);
        $this->assertArrayHasKey("currency", $resBody);
        $this->assertArrayHasKey("assetValue", $resBody);

        $value = (float) $resBody["assetValue"];
        $currency = $resBody["currency"];
        $this->assertEquals("EUR", $currency);
        $this->assertNotEquals(0, $value);
    }

    public function getAllAssetsInBadCurrency() {
        $this->get("/assets/value?currency=errrrr", $this->getAuthHeaders());
        $this->assertEquals(200, $this->response->getStatusCode());

        $resBody = json_decode($this->response->content(), true);
        $currency = $resBody["currency"];

        $this->assertEquals("USD", $currency);
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
