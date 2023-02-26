<?php

declare(strict_types=1);

namespace MageDesk\ShipEntegra\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface ShipEntegraOrderSearchResultsInterface extends SearchResultsInterface
{
    /**
     * @return \MageDesk\ShipEntegra\Api\Data\ShipEntegraOrderInterface[]
     */
    public function getItems(): array;

    /**
     * @param \MageDesk\ShipEntegra\Api\Data\ShipEntegraOrderInterface[] $items
     */
    public function setItems(array $items): static;
}
