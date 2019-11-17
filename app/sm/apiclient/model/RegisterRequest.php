<?php

namespace sm\apiclient\model;

class RegisterRequest {
    public $client_id;
    public $email;
    public $name;

    public function __construct(string $client_id, string $email, string $name) {
        $this->client_id = $client_id;
        $this->email = $email;
        $this->name = $name;
    }
}