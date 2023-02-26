<?php
/*
 * @author MageDesk Team
 * @copyright Copyright (c) MageDesk (https://www.magedesk.com/)
 */

namespace MageDesk\ShipEntegra\Service\Mappers;

use MageDesk\ShipEntegra\Api\MapperInterface;
use Magento\Sales\Model\Order;
use MageDesk\ShipEntegra\Service\Mappers\ShippingAddressMapper;
use MageDesk\ShipEntegra\Service\Mappers\ItemMapper;
use Magento\Framework\DataObject\Copy;
use MageDesk\ShipEntegra\Service\Calculations\VolumeCalculationService;
use MageDesk\ShipEntegra\Service\Mappers\ServiceMapper;

/**
 * Class OrderMapper
 */
class OrderMapper extends AbstractMapper
{
    /**
     * @var ShippingAddressMapper
     */
    protected $shippingAddressMapper;

    /**
     * @var ItemMapper
     */
    protected $itemMapper;

    /**
     * @var VolumeCalculationService
     */
    protected $volumeCalculationService;

    /**
     * @var ServiceMapper
     */
    protected $serviceMapper;

    /**
     * OrderMapper constructor.
     * @param Copy $objectCopyService
     * @param ShippingAddressMapper $shippingAddressMapper
     * @param ItemMapper $itemMapper
     * @param VolumeCalculationService $volumeCalculationService
     * @param ServiceMapper $serviceMapper
     */
    public function __construct(
        Copy $objectCopyService,
        ShippingAddressMapper $shippingAddressMapper,
        ItemMapper $itemMapper,
        VolumeCalculationService $volumeCalculationService,
        ServiceMapper $serviceMapper
    ) {
        parent::__construct($objectCopyService);
        $this->shippingAddressMapper = $shippingAddressMapper;
        $this->itemMapper = $itemMapper;
        $this->volumeCalculationService = $volumeCalculationService;
        $this->serviceMapper = $serviceMapper;
    }
    /**
     * @param Order $data
     * @return array
     */
    public function map($data)
    {
        $this->volumeCalculationService->execute($data->getAllItems());
        $containerPackage = $this->volumeCalculationService->getContainerDimensions();
        $serviceInfo = $this->serviceMapper->map($data);
        $newOrder = [];
        $newOrder['packageQuantity'] = 1;
        $newOrder['weight'] = $this->volumeCalculationService->getTotalWeight() ?? null;
        $newOrder['width'] = $containerPackage['width'] ?? null;
        $newOrder['height'] = $containerPackage['height'] ?? null;
        $newOrder['length'] = $containerPackage['length'] ?? null;
        $newOrder['service'] = $serviceInfo->getService() ?? 1;
        $newOrder['currency'] = $data->getOrderCurrencyCode();
        $newOrder['description'] = 'Order ID' . $data->getIncrementId();
        $newOrder['shippingAddress'] = $this->shippingAddressMapper->map($data->getShippingAddress());
        $newOrder['items'] = $this->itemMapper->map($data->getAllItems());
        return $newOrder;
    }
}
