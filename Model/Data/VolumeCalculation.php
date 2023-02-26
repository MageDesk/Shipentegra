<?php
/*
 * @author MageDesk Team
 * @copyright Copyright (c) MageDesk (https://www.magedesk.com/)
 */

namespace MageDesk\ShipEntegra\Model\Data;

use MageDesk\ShipEntegra\Api\Data\VolumeCalculationInterface;
use Magento\Framework\DataObject;

/**
 * Class VolumeCalculation
 */
abstract class VolumeCalculation extends DataObject implements VolumeCalculationInterface
{
    /**
     * @param array $allItems
     * @return float
     */
    abstract public function execute(array $allItems): float;

    /**
     * Getter for ContainerDimentions.
     *
     * @return array|null
     */
    public function getContainerDimentions(): ?array
    {
        return $this->getData(self::CONTAINER_DIMENTIONS);
    }

    /**
     * Setter for ContainerDimentions.
     *
     * @param array|null $containerDimentions
     *
     * @return void
     */
    public function setContainerDimentions(?array $containerDimentions): void
    {
        $this->setData(self::CONTAINER_DIMENTIONS, $containerDimentions);
    }

    /**
     * Getter for ContainerVolume.
     *
     * @return float|null
     */
    public function getContainerVolume(): ?float
    {
        return $this->getData(self::CONTAINER_VOLUME) === null ? null
            : (float)$this->getData(self::CONTAINER_VOLUME);
    }

    /**
     * Setter for ContainerVolume.
     *
     * @param float|null $containerVolume
     *
     * @return void
     */
    public function setContainerVolume(?float $containerVolume): void
    {
        $this->setData(self::CONTAINER_VOLUME, $containerVolume);
    }

    /**
     * Getter for TotalWeight.
     *
     * @return float|null
     */
    public function getTotalWeight(): ?float
    {
        return $this->getData(self::TOTAL_WEIGHT) === null ? null
            : (float)$this->getData(self::TOTAL_WEIGHT);
    }

    /**
     * Setter for TotalWeight.
     *
     * @param float|null $totalWeight
     *
     * @return void
     */
    public function setTotalWeight(?float $totalWeight): void
    {
        $this->setData(self::TOTAL_WEIGHT, $totalWeight);
    }

    /**
     * Getter for ContainerData.
     *
     * @return array|null
     */
    public function getContainerData(): ?array
    {
        return $this->getData(self::CONTAINER_DATA) === null ? null
            : (float)$this->getData(self::CONTAINER_DATA);
    }

    /**
     * Setter for ContainerData.
     *
     * @param array|null $containerData
     *
     * @return void
     */
    public function setContainerData(?array $containerData): void
    {
        $this->setData(self::CONTAINER_DATA, $containerData);
    }

    /**
     * Getter for ContainerVolWeight.
     *
     * @return float|null
     */
    public function getContainerVolWeight(): ?float
    {
        return $this->getData(self::CONTAINER_VOL_WEIGHT) === null ? null
            : (float)$this->getData(self::CONTAINER_VOL_WEIGHT);
    }

    /**
     * Setter for ContainerVolWeight.
     *
     * @param float|null $containerVolWeight
     *
     * @return void
     */
    public function setContainerVolWeight(?float $containerVolWeight): void
    {
        $this->setData(self::CONTAINER_VOL_WEIGHT, $containerVolWeight);
    }

    /**
     * Getter for TotalVolWeight.
     *
     * @return float|null
     */
    public function getTotalVolWeight(): ?float
    {
        return $this->getData(self::TOTAL_VOL_WEIGHT) === null ? null
            : (float)$this->getData(self::TOTAL_VOL_WEIGHT);
    }

    /**
     * Setter for TotalVolWeight.
     *
     * @param float|null $totalVolWeight
     *
     * @return void
     */
    public function setTotalVolWeight(?float $totalVolWeight): void
    {
        $this->setData(self::TOTAL_VOL_WEIGHT, $totalVolWeight);
    }

    /**
     * Getter for Items.
     *
     * @return array|null
     */
    public function getItems(): ?array
    {
        return $this->getData(self::ITEMS);
    }

    /**
     * Setter for Items.
     *
     * @param array|null $items
     *
     * @return void
     */
    public function setItems(?array $items): void
    {
        $this->setData(self::ITEMS, $items);
    }

    /**
     * Getter for Is Items Valid.
     *
     * @return bool|null
     */
    public function getIsItemsValid(): ?bool
    {
        return $this->getData(self::IS_ITEMS_VALID);
    }

    /**
     * Setter for Is Items Valid.
     *
     * @param bool|null $isItemsValid
     *
     * @return void
     */
    public function setIsItemsValid(?bool $isItemsValid): void
    {
        $this->setData(self::IS_ITEMS_VALID, $isItemsValid);
    }
}
