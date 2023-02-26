<?php

declare(strict_types=1);

namespace MageDesk\ShipEntegra\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;

interface ShipEntegraOrderInterface extends ExtensibleDataInterface
{
    public const ENTITY_ID = 'entity_id';
    public const SHIPENTEGRA_ORDER_ID = 'shipentegra_order_id';
    public const COURIER = 'courier';
    public const TRACKING_NUMBER = 'tracking_number';
    public const LABEL = 'label';
    public const SE_ORDER_ID = 'se_order_id';
    public const SERVICE_TYPE = 'service_type';
    public const ORDER_ID = 'order_id';

    /**
     * @return int|null
     */
    public function getEntityId(): ?int;

    /**
     * @param int $entity_id
     * @return \MageDesk\ShipEntegra\Api\Data\ShipEntegraOrderInterface
     */
    public function setEntityId(int $entity_id): \MageDesk\ShipEntegra\Api\Data\ShipEntegraOrderInterface;

    /**
     * @return string|null
     */
    public function getShipentegraOrderId(): ?string;

    /**
     * @param string $shipentegra_order_id
     * @return \MageDesk\ShipEntegra\Api\Data\ShipEntegraOrderInterface
     */
    public function setShipentegraOrderId(string $shipentegra_order_id): \MageDesk\ShipEntegra\Api\Data\ShipEntegraOrderInterface;

    /**
     * @return string|null
     */
    public function getCourier(): ?string;

    /**
     * @param string $courier
     * @return \MageDesk\ShipEntegra\Api\Data\ShipEntegraOrderInterface
     */
    public function setCourier(string $courier): \MageDesk\ShipEntegra\Api\Data\ShipEntegraOrderInterface;

    /**
     * @return string|null
     */
    public function getTrackingNumber(): ?string;

    /**
     * @param string $tracking_number
     * @return \MageDesk\ShipEntegra\Api\Data\ShipEntegraOrderInterface
     */
    public function setTrackingNumber(string $tracking_number): \MageDesk\ShipEntegra\Api\Data\ShipEntegraOrderInterface;

    /**
     * @return string|null
     */
    public function getLabel(): ?string;

    /**
     * @param string $label
     * @return \MageDesk\ShipEntegra\Api\Data\ShipEntegraOrderInterface
     */
    public function setLabel(string $label): \MageDesk\ShipEntegra\Api\Data\ShipEntegraOrderInterface;

    /**
     * @return string|null
     */
    public function getSeOrderId(): ?string;

    /**
     * @param string $se_order_id
     * @return \MageDesk\ShipEntegra\Api\Data\ShipEntegraOrderInterface
     */
    public function setSeOrderId(string $se_order_id): \MageDesk\ShipEntegra\Api\Data\ShipEntegraOrderInterface;

    /**
     * @return int|null
     */
    public function getServiceType(): ?int;

    /**
     * @param int $service_type
     * @return \MageDesk\ShipEntegra\Api\Data\ShipEntegraOrderInterface
     */
    public function setServiceType(int $service_type): \MageDesk\ShipEntegra\Api\Data\ShipEntegraOrderInterface;

    /**
     * @return int|null
     */
    public function getOrderId(): ?int;

    /**
     * @param int $order_id
     * @return \MageDesk\ShipEntegra\Api\Data\ShipEntegraOrderInterface
     */
    public function setOrderId(int $order_id): \MageDesk\ShipEntegra\Api\Data\ShipEntegraOrderInterface;

    /**
     * @return \MageDesk\ShipEntegra\Api\Data\ShipEntegraOrderExtensionInterface|null
     */
    public function getExtensionAttributes(): ?\MageDesk\ShipEntegra\Api\Data\ShipEntegraOrderExtensionInterface;

    /**
     * @param \MageDesk\ShipEntegra\Api\Data\ShipEntegraOrderExtensionInterface $extensionAttributes
     * @return static
     */
    public function setExtensionAttributes(
        \MageDesk\ShipEntegra\Api\Data\ShipEntegraOrderExtensionInterface $extensionAttributes
    ): static;
}
