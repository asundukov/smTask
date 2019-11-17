<?php


namespace sm\apiclient\curl;


use Psr\Log\LoggerInterface;

class CurlHelper {

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var string
     */
    private $basePath;

    /**
     * CurlHelper constructor.
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger, string $basePath) {
        $this->logger = $logger;
        $this->basePath = $basePath;
    }


    function curlGet(string $apiPath): string {
        $curl = $this->defaultCurl($apiPath);
        $this->logger->info('GET request to '. $apiPath);
        return curl_exec($curl);
    }

    function curlPost(string $apiPath, $data): string {
        $curl = $this->defaultCurl($apiPath);
        $dataString = json_encode($data);

        curl_setopt($curl, CURLOPT_POSTFIELDS, $dataString);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($curl, CURLOPT_POST, 1);

        $this->logger->info('POST request to '. $apiPath);
        $result = curl_exec($curl);
        return $result;
    }

    function defaultCurl(string $apiPath) {
        $curl = \curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->basePath . $apiPath);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        return $curl;
    }
}