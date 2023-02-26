<?php
/*
 * @author MageDesk Team
 * @copyright Copyright (c) MageDesk (https://www.magedesk.com/)
 */

namespace MageDesk\ShipEntegra\Api\Data;

interface VolumeCalculationInterface
{
    /**
     * String constants for property names
     */
    public const CONTAINER_DIMENTIONS = "container_dimentions";
    public const CONTAINER_VOLUME = "container_volume";
    public const TOTAL_WEIGHT = "total_weight";
    public const CONTAINER_DATA = "container_data";
    public const CONTAINER_VOL_WEIGHT = "container_vol_weight";
    public const TOTAL_VOL_WEIGHT = "total_vol_weight";
    public const ITEMS = "items";
    public const IS_ITEMS_VALID = "is_items_valid";

    /**
     * @param array $allItems
     * @return float
     */
    public function execute(array $allItems): float;

    /**
     * Getter for ContainerDimentions.
     *
     * @return array|null
     */
    public function getContainerDimentions(): ?array;

    /**
     * Setter for ContainerDimentions.
     *
     * @param array|null $containerDimentions
     *
     * @return void
     */
    public function setContainerDimentions(?array $containerDimentions): void;

    /**
     * Getter for ContainerVolume.
     *
     * @return float|null
     */
    public function getContainerVolume(): ?float;

    /**
     * Setter for ContainerVolume.
     *
     * @param float|null $containerVolume
     *
     * @return void
     */
    public function setContainerVolume(?float $containerVolume): void;

    /**
     * Getter for TotalWeight.
     *
     * @return float|null
     */
    public function getTotalWeight(): ?float;

    /**
     * Setter for TotalWeight.
     *
     * @param float|null $totalWeight
     *
     * @return void
     */
    public function setTotalWeight(?float $totalWeight): void;

    /**
     * Getter for ContainerData.
     *
     * @return array|null
     */
    public function getContainerData(): ?array;

    /**
     * Setter for ContainerData.
     *
     * @param array|null $containerData
     *
     * @return void
     */
    public function setContainerData(?array $containerData): void;

    /**
     * Getter for ContainerVolWeight.
     *
     * @return float|null
     */
    public function getContainerVolWeight(): ?float;

    /**
     * Setter for ContainerVolWeight.
     *
     * @param float|null $containerVolWeight
     *
     * @return void
     */
    public function setContainerVolWeight(?float $containerVolWeight): void;

    /**
     * Getter for TotalVolWeight.
     *
     * @return float|null
     */
    public function getTotalVolWeight(): ?float;

    /**
     * Setter for TotalVolWeight.
     *
     * @param float|null $totalVolWeight
     *
     * @return void
     */
    public function setTotalVolWeight(?float $totalVolWeight): void;

    /**
     * Getter for Items.
     *
     * @return array|null
     */
    public function getItems(): ?array;

    /**
     * Setter for Items.
     *
     * @param array|null $items
     *
     * @return void
     */
    public function setItems(?array $items): void;

    /**
     * Getter for IsItemsValid.
     *
     * @return bool|null
     */
    public function getIsItemsValid(): ?bool;

    /**
     * Setter for IsItemsValid.
     *
     * @param bool|null $isItemsValid
     *
     * @return void
     */
    public function setIsItemsValid(?bool $isItemsValid): void;
}
