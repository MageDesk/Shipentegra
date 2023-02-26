<?php 

declare(strict_types=1);

namespace MageDesk\ShipEntegra\Model\Data;

use Magento\Framework\Api\AbstractExtensibleObject;
use MageDesk\ShipEntegra\Api\Data\ShipEntegraOrderExtensionInterface;
use MageDesk\ShipEntegra\Api\Data\ShipEntegraOrderInterface;

class ShipEntegraOrder extends AbstractExtensibleObject implements ShipEntegraOrderInterface
{
    public function getEntityId(): ?int
    {
        return $this->_get(self::ENTITY_ID);
    }

    public function setEntityId(int $entity_id): ShipEntegraOrderInterface
    {
        return $this->setData(self::ENTITY_ID, $entity_id);
    }

    public function getShipentegraOrderId(): ?string
    {
        return $this->_get(self::SHIPENTEGRA_ORDER_ID);
    }

    public function setShipentegraOrderId(string $shipentegra_order_id): ShipEntegraOrderInterface
    {
        return $this->setData(self::SHIPENTEGRA_ORDER_ID, $shipentegra_order_id);
    }

    public function getCourier(): ?string
    {
        return $this->_get(self::COURIER);
    }

    public function setCourier(string $courier): ShipEntegraOrderInterface
    {
        return $this->setData(self::COURIER, $courier);
    }

    public function getTrackingNumber(): ?string
    {
        return $this->_get(self::TRACKING_NUMBER);
    }

    public function setTrackingNumber(string $tracking_number): ShipEntegraOrderInterface
    {
        return $this->setData(self::TRACKING_NUMBER, $tracking_number);
    }

    public function getLabel(): ?string
    {
        return $this->_get(self::LABEL);
    }

    public function setLabel(string $label): ShipEntegraOrderInterface
    {
        return $this->setData(self::LABEL, $label);
    }

    public function getSeOrderId(): ?string
    {
        return $this->_get(self::SE_ORDER_ID);
    }

    public function setSeOrderId(string $se_order_id): ShipEntegraOrderInterface
    {
        return $this->setData(self::SE_ORDER_ID, $se_order_id);
    }

    public function getServiceType(): ?int
    {
        return $this->_get(self::SERVICE_TYPE);
    }

    public function setServiceType(int $service_type): ShipEntegraOrderInterface
    {
        return $this->setData(self::SERVICE_TYPE, $service_type);
    }

    public function getOrderId(): ?int
    {
        return $this->_get(self::ORDER_ID);
    }

    public function setOrderId(int $order_id): ShipEntegraOrderInterface
    {
        return $this->setData(self::ORDER_ID, $order_id);
    }

    public function getExtensionAttributes(): ?ShipEntegraOrderExtensionInterface
    {
        return $this->_getExtensionAttributes();
    }

    public function setExtensionAttributes(
        ShipEntegraOrderExtensionInterface $extensionAttributes
    ): static {
        return $this->_setExtensionAttributes($extensionAttributes);
    }
}
