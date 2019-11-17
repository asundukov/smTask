<?php

namespace sm\apiclient;

use SM\ApiClient\model\PostsResponse;

interface SmApiCilent {
    public function getPosts(int $page): PostsResponse;
}