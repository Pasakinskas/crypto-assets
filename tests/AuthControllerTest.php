<?php


use App\Models\User;

class AuthControllerTest extends TestCase {

    public function testSuccessfulLogin() {
        $user = User::get()[0];
        $this->post('/auth', [
            "email" => $user["email"],
            "password" => "password"
        ]);

        $this->assertEquals(200, $this->response->getStatusCode());
        $resBody = json_decode($this->response->content(), true);
        $this->assertEquals("true", $resBody["success"]);
    }

    public function testBadLogin() {
        $this->post('/auth', [
            "email" => "testmail@email.com",
            "password" => "incorrectPassword"
        ]);

        $this->assertEquals(401, $this->response->getStatusCode());

        $resBody = json_decode($this->response->content(), true);
        $this->assertArrayHasKey("error", $resBody);
        $this->assertArrayNotHasKey("token", $resBody);
    }

    public function testNoEmailEnteredLogin() {
        $this->post('/auth', [
            "password" => "incorrectPassword"
        ]);

        $this->assertEquals(422, $this->response->getStatusCode());
    }

    public function testNoPasswordEnteredLogin() {
        $this->post('/auth', [
            "email" => "testemail@email.com"
        ]);

        $this->assertEquals(422, $this->response->getStatusCode());
    }
}
