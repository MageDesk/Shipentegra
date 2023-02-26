<?php
/*
 * @author MageDesk Team
 * @copyright Copyright (c) MageDesk (https://www.magedesk.com/)
 */

namespace MageDesk\ShipEntegra\Service\RequestClient;

use Magento\Framework\HTTP\Client\Curl as HttpClient;
use Magento\Framework\HTTP\Client\CurlFactory as HttpClientFactory;
use MageDesk\ShipEntegra\DataProvider\ConfigDataProvider;
use MageDesk\ShipEntegra\Service\Endpoints\AuthService;

class TokenCheckService
{

    /**
     * @var HttpClientFactory
     */
    private $httpClientFactory;

    /**
     * @var ConfigDataProvider
     */
    private $configDataProvider;

    /**
     * @var HttpClient
     */
    private $httpClient;

    /**
     * @var AuthService
     */
    private $authService;

    /**
     * @param HttpClientFactory $httpClientFactory
     * @param ConfigDataProvider $configDataProvider
     * @param AuthService $authService
     */
    public function __construct(
        HttpClientFactory $httpClientFactory,
        ConfigDataProvider $configDataProvider,
        AuthService $authService
    ) {
        $this->httpClientFactory = $httpClientFactory;
        $this->configDataProvider = $configDataProvider;
        $this->authService = $authService;
    }

    /**
     * @return HttpClient
     */
    public function getHttpClient(): HttpClient
    {
        if (null === $this->httpClient) {
            $this->httpClient = $this->httpClientFactory->create();
        }

        return $this->httpClient;
    }

    /**
     * @return bool
     */
    public function checkToken(): bool
    {
        $this->authService->setClientId($this->configDataProvider->getClientId());
        $this->authService->setClientSecret($this->configDataProvider->getClientSecret());
        $fullUrl = $this->configDataProvider->getUrl() . $this->authService->getUrl();

        $this->getHttpClient()->post(
            $fullUrl,
            $this->authService->getBody()
        );

        $response = json_decode($this->getHttpClient()->getBody());
        if(!isset($response->data->accessToken)) {
            return false;
        }
        $this->configDataProvider->setAccessToken($response->data->accessToken);

        return true;
    }
}
