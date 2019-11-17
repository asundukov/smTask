<?php


namespace sm\apiclient\curl;


use Psr\Log\LoggerInterface;
use sm\apiclient\model\PostsResponse;
use sm\apiclient\model\RegisterRequest;
use sm\apiclient\model\RegisterResponse;
use sm\apiclient\SmApiCilent;

class CurlClient implements SmApiCilent {

    private $token;

    /**
     * @var \JsonMapper
     */
    private $mapper;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var Config
     */
    private $config;

    /**
     * @var CurlHelper
     */
    private $curlHelper;

    public function __construct(Config $config) {
        $this->mapper = new \JsonMapper();
        $this->logger = $config->getLogger();
        $this->config = $config;

        $this->curlHelper = new CurlHelper($this->logger, $config->getApiEndpoint());
    }

    public function getPosts(int $page): PostsResponse {
        $apiPath = '/posts?sl_token=' . $this->getToken() . '&page=' . $page;
        $data = $this->curlHelper->curlGet($apiPath);
        $posts = $this->mapper->map(json_decode($data), new PostsResponse());
        return $posts;
    }

    private function getToken(): string {
        if ($this->token == null) {
            $tokenData = $this->newToken();
            if ($tokenData->data == null) {
                throw new \Exception("Error through receiving new token.");
            }
            $this->token = $tokenData->data->sl_token;
        }
        return $this->token;
    }

    private function newToken(): RegisterResponse {
        $request = new RegisterRequest(
                $this->config->getClientId(),
                $this->config->getEmail(),
                $this->config->getName()
        );
        $content = $this->curlHelper->curlPost('/register', $request);
        $resp = $this->mapper->map(json_decode($content), new RegisterResponse());

        return $resp;
    }

}