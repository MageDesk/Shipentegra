<?php

declare(strict_types=1);

namespace MageDesk\ShipEntegra\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use MageDesk\ShipEntegra\Api\Data\ShipEntegraOrderInterface;
use MageDesk\ShipEntegra\Api\Data\ShipEntegraOrderSearchResultsInterface;

interface ShipEntegraOrderRepositoryInterface
{
    /**
     * @param int $id
     * @return \MageDesk\ShipEntegra\Api\Data\ShipEntegraOrderInterface
     */
    public function get(int $id): \MageDesk\ShipEntegra\Api\Data\ShipEntegraOrderInterface;

    /**
      * @param \Magento\Framework\Api\SearchCriteriaInterface $criteria
      * @return \MageDesk\ShipEntegra\Api\Data\ShipEntegraOrderSearchResultsInterface
      */
    public function getList(SearchCriteriaInterface $criteria): \MageDesk\ShipEntegra\Api\Data\ShipEntegraOrderSearchResultsInterface;

    /**
     * @param \MageDesk\ShipEntegra\Api\Data\ShipEntegraOrderInterface $entity
     * @return \MageDesk\ShipEntegra\Api\Data\ShipEntegraOrderInterface
     */
    public function save(ShipEntegraOrderInterface $entity): \MageDesk\ShipEntegra\Api\Data\ShipEntegraOrderInterface;

    /**
      * @param \MageDesk\ShipEntegra\Api\Data\ShipEntegraOrderInterface $entity
      * @return bool
      */
    public function delete(ShipEntegraOrderInterface $entity): bool;

    /**
     * @param int $id
     * @return bool
     */
    public function deleteById(int $id): bool;
}
