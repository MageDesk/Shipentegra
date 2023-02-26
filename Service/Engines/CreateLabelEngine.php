<?php
/*
 * @author MageDesk Team
 * @copyright Copyright (c) MageDesk (https://www.magedesk.com/)
 */

namespace MageDesk\ShipEntegra\Service\Engines;

use MageDesk\ShipEntegra\Api\Data\ServiceInfoInterface;
use MageDesk\ShipEntegra\Service\Mappers\OrderMapper;
use MageDesk\ShipEntegra\Service\Endpoints\CreateOrderService;
use Magento\Sales\Model\Order;
use MageDesk\ShipEntegra\Service\Endpoints\CreateLabelService;
use Magento\Shipping\Model\Shipping\LabelGenerator;
use MageDesk\ShipEntegra\Service\Mappers\ItemLabelMapper;
use MageDesk\ShipEntegra\Service\Mappers\ServiceMapper;
use Magento\Sales\Model\Order\Shipment\TrackFactory;
use MageDesk\ShipEntegra\Model\ShipEntegraOrder;

/**
 * Class CreateOrderEngine
 */
class CreateLabelEngine
{
    /**
     * @var CreateLabelService
     */
    private $createLabelService;

    /**
     * @var OrderMapper
     */
    private $orderMapper;

    /**
     * @var LabelGenerator
     */
    private $labelGenerator;

    /**
     * @var ItemLabelMapper
     */
    private $itemMapper;

    /**
     * @var ServiceMapper
     */
    private $serviceMapper;

    /**
     * @var TrackFactory
     */
    private $trackFactory;

    /**
     * @var ShipEntegraOrder
     */
    private $shipEntegraOrder;

    /**
     * @param CreateLabelService $createLabelService
     * @param OrderMapper $orderMapper
     * @param LabelGenerator $labelGenerator
     * @param ItemLabelMapper $itemMapper
     * @param ServiceMapper $serviceMapper
     * @param TrackFactory $trackFactory
     * @param ShipEntegraOrder $shipEntegraOrder
     */
    public function __construct(
        CreateLabelService $createLabelService,
        OrderMapper $orderMapper,
        LabelGenerator $labelGenerator,
        ItemLabelMapper $itemMapper,
        ServiceMapper $serviceMapper,
        TrackFactory $trackFactory,
        ShipEntegraOrder $shipEntegraOrder
    ) {
        $this->createLabelService = $createLabelService;
        $this->orderMapper = $orderMapper;
        $this->labelGenerator = $labelGenerator;
        $this->itemMapper = $itemMapper;
        $this->serviceMapper = $serviceMapper;
        $this->trackFactory = $trackFactory;
        $this->shipEntegraOrder = $shipEntegraOrder;
    }

    /**
     * @param Order $order
     * @return void
     * @throws \Exception
     */
    public function execute(Order $order)
    {
        $shipentegraOrder = $this->shipEntegraOrder
            ->getCollection()
            ->addFieldToFilter('order_id', $order->getEntityId())
            ->getFirstItem();

        if($shipentegraOrder->getLabel()) {
            return $shipentegraOrder->getLabel();
        }

        if(!$shipentegraOrder->getShipentegraOrderId()){
            return '';
        }

       $this->createLabelService->setContent("vol");
       $this->createLabelService->setCurrency($order->getBaseCurrencyCode());
       $this->createLabelService->setOrderId($shipentegraOrder->getShipentegraOrderId());

       $items = $order->getAllVisibleItems();
       $itemsWeight = $this->getAllitemsWeight($items);
       $this->createLabelService->setWeight($itemsWeight);

       $serviceInfo = $this->serviceMapper->map($order);
       $this->createLabelService->setSpecialService($serviceInfo->getMethodCode());

        $mappedItems = $this->itemMapper->map($items, $shipentegraOrder->getShipentegraOrderId());
        $this->createLabelService->setItems($mappedItems);

        $response = $this->createLabelService->execute();
        if(isset($response['success']) && $response['success'] && $response['label']) {
            $this->addTrackingNumber($order, $response['trackingNumber'], $serviceInfo);
            $shipentegraOrder->setTrackingNumber($response['trackingNumber']);
            $shipentegraOrder->setLabel($response['label']);
            $shipentegraOrder->setserviceType($response['serviceType']);
            $shipentegraOrder->setSeOrderId($response['seOrderId']);
            $shipentegraOrder->setCourier($response['courier']);
            $shipentegraOrder->save();
            return $response['label'];
        }
    }

    /**
     * @param $items
     * @return int|mixed
     */
    private function getAllitemsWeight($items)
    {
        $weight = 0;
        foreach ($items as $item) {
            $weight += $item->getWeight();
        }
        return $weight;
    }

    /**
     * @param Order $order
     * @param $trackingNumber
     * @param ServiceInfoInterface $serviceInfo
     * @return void
     */
    private function addTrackingNumber(Order $order, $trackingNumber, ServiceInfoInterface $serviceInfo)
    {
        $shipment = $order->getShipmentsCollection()->getFirstItem();
        $shipment->addTrack(
            $this->trackFactory->create()
                ->setNumber($trackingNumber)
                ->setCarrierCode($serviceInfo->getCarrierCode())
                ->setTitle($serviceInfo->getMethodCode())
        );
        $shipment->save();
    }
}
