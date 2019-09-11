<?php


class AuthControllerTest extends TestCase {
    public function testSuccessfulLogin() {
        $this->post('/auth', [
            "email" => "testemail@email.com",
            "password" => "testemail"
        ]);

        $this->assertEquals(200, $this->response->getStatusCode());

        $resBody = json_decode($this->response->content(), true);
        $this->assertEquals("true", $resBody["success"]);
    }

    public function testBadLogin() {
        $this->post('/auth', [
            "email" => "testemail@email.com",
            "password" => "incorrectPassword"
        ]);

        $this->assertEquals(404, $this->response->getStatusCode());

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
