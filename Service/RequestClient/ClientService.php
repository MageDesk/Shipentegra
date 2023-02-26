<?php
/*
 * @author MageDesk Team
 * @copyright Copyright (c) MageDesk (https://www.magedesk.com/)
 */

declare(strict_types=1);

namespace MageDesk\ShipEntegra\Service\RequestClient;

use MageDesk\ShipEntegra\Api\EndpointServiceInterface;
use Magento\Framework\HTTP\Client\Curl as HttpClient;
use Magento\Framework\HTTP\Client\CurlFactory as HttpClientFactory;
use MageDesk\ShipEntegra\DataProvider\ConfigDataProvider;
use MageDesk\ShipEntegra\Service\RequestClient\TokenCheckService;
use MageDesk\ShipEntegra\Service\Endpoints\AbstractService;

/**
 * Class ClientService
 */
class ClientService
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
     * @var TokenCheckService
     */
    private $tokenCheckService;

    /**
     * @param HttpClientFactory $httpClientFactory
     * @param ConfigDataProvider $configDataProvider
     * @param TokenCheckService $tokenCheckService
     */
    public function __construct(
        HttpClientFactory $httpClientFactory,
        ConfigDataProvider $configDataProvider,
        TokenCheckService $tokenCheckService
    ) {
        $this->httpClientFactory = $httpClientFactory;
        $this->configDataProvider = $configDataProvider;
        $this->tokenCheckService = $tokenCheckService;
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
     * @param AbstractService $endpointService
     * @return array
     * @throws \Exception
     */
    public function execute(AbstractService $endpointService): array
    {
        if(!$this->getAccessToken()){
            throw new \Exception('Access token is not set');
        }

        $this->getHttpClient()->addHeader('Content-Type', 'application/json');
        $this->getHttpClient()->addHeader('Authorization', 'Bearer ' . $this->getAccessToken());
        $this->executeRequest($endpointService);

        return json_decode($this->getHttpClient()->getBody(), true)['data'];
    }

    /**
     * @return null|string
     */
    private function getAccessToken(): ?string
    {
        if(!$this->configDataProvider->getAccessToken()) {
           $this->tokenCheckService->checkToken();
        }
        return $this->configDataProvider->getAccessToken();
    }

    /**
     * @param AbstractService $endpointService
     * @return void
     * @throws \Exception
     */
    private function executeRequest(AbstractService $endpointService): void
    {
        $url = $endpointService->getUrl();
        $body = $endpointService->getBody();
        $fullUrl = $this->configDataProvider->getUrl() . $url;
        try{
            switch ($endpointService->getType()) {
                case AbstractService::GET_METHOD:
                    $this->getHttpClient()->get($fullUrl);
                    break;
                case AbstractService::POST_METHOD:
                    $this->getHttpClient()->post($fullUrl, json_encode($body));
                    break;
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
        $this->checkResponseStatus();
    }

    /**
     * @return void
     */
    private function checkResponseStatus(): void
    {
        if ($this->getHttpClient()->getStatus() === 401) {
            $this->tokenCheckService->checkToken();
        }
    }
}
