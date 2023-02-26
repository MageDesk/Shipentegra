<?php
/*
 * @author MageDesk Team
 * @copyright Copyright (c) MageDesk (https://www.magedesk.com/)
 */

namespace MageDesk\ShipEntegra\Service\Endpoints;

use MageDesk\ShipEntegra\Api\Data\EndpointDataInterface;
use MageDesk\ShipEntegra\Api\EndpointServiceInterface;
use MageDesk\ShipEntegra\Model\Data\EndpointData;
use MageDesk\ShipEntegra\Service\RequestClient\ClientService\Proxy as ClientService;

/**
 * Class AbstractService
 */
abstract class AbstractService extends EndpointData
{

    /**
     * @var string
     */
    public CONST POST_METHOD = 'POST';
    public CONST GET_METHOD = 'GET';

    /**
     * @var string
     */
    protected string $url = '';

    /**
     * @var string
     */
    protected string $type = self::POST_METHOD;

    /**
     * @var ClientService
     */
    protected ClientService $clientService;

    /**
     * AbstractService constructor.
     *
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        $data[EndpointDataInterface::URL] = $this->url;
        $data[EndpointDataInterface::TYPE] = $this->type;
        $this->_data = $data;
    }

    /**
     * @param string $key
     * @param $value
     * @return EndpointDataInterface
     */
    public function setBodyParam(string $key, $value): EndpointDataInterface
    {
        $body = $this->getBody();
        $body[$key] = $value;
        $this->setBody($body);

        return $this;
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function getBodyParam(string $key): EndpointDataInterface
    {
        $body = $this->getBody();
        return $body[$key];
    }

    /**
     * @return void
     */
    public function execute()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $this->clientService = $objectManager->create(ClientService::class);
        return $this->clientService->execute($this);
    }
}
