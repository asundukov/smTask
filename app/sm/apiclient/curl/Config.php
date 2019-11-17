<?php


namespace sm\apiclient\curl;


use Psr\Log\LoggerInterface;

class Config {
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var string
     */
    private $clientId;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $apiEndpoint;

    public function __construct(string $configDir, LoggerInterface $logger) {
        $this->logger = $logger;
        $configFile = $configDir . '/sm.php';
        if (!file_exists($configFile)) {
            throw new \Exception("Cannot find sm config file " . $configFile);
        }

        require $configFile;

        $this->clientId = $smConfig['client_id'];
        $this->apiEndpoint = $smConfig['api_endpoint'];
        $this->email = $smConfig['email'];
        $this->name = $smConfig['name'];
    }

    public function getLogger(): LoggerInterface {
        return $this->logger;
    }

    public function getClientId(): string {
        return $this->clientId;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function getName(): string {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getApiEndpoint(): string {
        return $this->apiEndpoint;
    }


}
