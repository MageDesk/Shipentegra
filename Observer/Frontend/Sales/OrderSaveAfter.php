<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace MageDesk\ShipEntegra\Observer\Frontend\Sales;

use Exception;
use MageDesk\ShipEntegra\Service\Engines\CreateOrderEngine;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Sales\Api\OrderRepositoryInterface;
use Psr\Log\LoggerInterface;

/**
 * Class OrderSaveAfter
 */
class OrderSaveAfter implements ObserverInterface
{
    /**
     * @var CreateOrderEngine
     */
    private $createOrderEngine;

    /**
     * @var OrderRepositoryInterface
     */
    private $orderRepository;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @param CreateOrderEngine $createOrderEngine
     * @param OrderRepositoryInterface $orderRepository
     * @param LoggerInterface $logger
     */
    public function __construct(
        CreateOrderEngine $createOrderEngine,
        OrderRepositoryInterface $orderRepository,
        LoggerInterface $logger
    ) {
        $this->createOrderEngine = $createOrderEngine;
        $this->orderRepository = $orderRepository;
        $this->logger = $logger;
    }

    /**
     * Execute observer
     *
     * @param Observer $observer
     * @return void
     * @throws Exception
     */
    public function execute(Observer $observer) {
        try{
            $orderId = $observer->getEvent()->getOrder()->getId();
            $order = $this->orderRepository->get($orderId);
            $this->createOrderEngine->execute($order);
        } catch (Exception $e) {
            $this->logger->error($e->getMessage());
        }
    }
}

