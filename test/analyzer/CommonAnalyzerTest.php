<?php


namespace stat\analyzer;

use PHPUnit\Framework\TestCase;
use sm\apiclient\model\PostResponse;

abstract class CommonAnalyzerTest extends TestCase {
    protected function getPostResponse(string $month, int $length): PostResponse {
        $result = new PostResponse();
        $result->message = '';
        for ($i = 0; $i < $length; $i++) {
            $result->message .= 'a';
        }
        $result->created_time = date_create_from_format("Y-m", $month);
        return $result;
    }

    protected function getPostResponseWithUserId(string $month, int $length, string $userId): PostResponse {
        $result = $this->getPostResponse($month, $length);
        $result->from_id = $userId;
        return $result;
    }
}