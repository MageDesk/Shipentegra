<?php
/*
 * @author MageDesk Team
 * @copyright Copyright (c) MageDesk (https://www.magedesk.com/)
 */

namespace MageDesk\ShipEntegra\Service\Engines;

use MageDesk\ShipEntegra\Service\Mappers\OrderMapper;
use MageDesk\ShipEntegra\Service\Endpoints\CreateOrderService;
use Magento\Sales\Model\Order;
use Magento\Sales\Api\OrderRepositoryInterface;
use MageDesk\ShipEntegra\Api\ShipEntegraOrderRepositoryInterface;
use MageDesk\ShipEntegra\Api\Data\ShipEntegraOrderInterface;

/**
 * Class CreateOrderEngine
 */
class CreateOrderEngine
{
    /**
     * @var CreateOrderService
     */
    private $createOrderService;

    /**
     * @var OrderMapper
     */
    private $orderMapper;

    /**
     * @var OrderRepositoryInterface
     */
    private $orderRepository;

    /**
     * @var ShipEntegraOrderRepositoryInterface
     */
    private $shipEntegraOrderRepository;

    /**
     * @var ShipEntegraOrderInterface
     */
    private $shipEntegraOrder;

    /**
     * @param CreateOrderService $createOrderService
     * @param OrderMapper $orderMapper
     * @param OrderRepositoryInterface $orderRepository
     * @param ShipEntegraOrderRepositoryInterface $shipEntegraOrderRepository
     * @param ShipEntegraOrderInterface $shipEntegraOrder
     */
    public function __construct(
        CreateOrderService $createOrderService,
        OrderMapper $orderMapper,
        OrderRepositoryInterface $orderRepository,
        ShipEntegraOrderRepositoryInterface $shipEntegraOrderRepository,
        ShipEntegraOrderInterface $shipEntegraOrder
    ) {
        $this->createOrderService = $createOrderService;
        $this->orderMapper = $orderMapper;
        $this->orderRepository = $orderRepository;
        $this->shipEntegraOrderRepository = $shipEntegraOrderRepository;
        $this->shipEntegraOrder = $shipEntegraOrder;
    }

    /**
     * @param Order $order
     * @return void
     * @throws \Exception
     */
    public function execute($order)
    {
        $orderData = $this->orderMapper->map($order);
        $this->createOrderService->setBody($orderData);
        $response = $this->createOrderService->execute($orderData);
        $package = [
            'width' => $orderData['width'],
            'height' => $orderData['height'],
            'length' => $orderData['length'],
            'weight' => $orderData['weight'],
            'quantity' => $orderData['packageQuantity']
        ];
        if(isset($response['success']) && $response['success'] && $response['orderId']) {
            $order->getShipmentsCollection()->getFirstItem()->setPackages([$package]);
            $this->shipEntegraOrder->setOrderId($order->getId());
            $this->shipEntegraOrder->setShipentegraOrderId($response['orderId']);
            $this->shipEntegraOrderRepository->save($this->shipEntegraOrder);
        }
    }
}
