<?php

declare(strict_types=1);

namespace MageDesk\ShipEntegra\Model;

use Magento\Framework\Api\ExtensibleDataObjectConverter;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use MageDesk\ShipEntegra\Api\Data\ShipEntegraOrderInterface;
use MageDesk\ShipEntegra\Api\Data\ShipEntegraOrderInterfaceFactory;
use MageDesk\ShipEntegra\Api\Data\ShipEntegraOrderSearchResultsInterface;
use MageDesk\ShipEntegra\Api\Data\ShipEntegraOrderSearchResultsInterfaceFactory;
use MageDesk\ShipEntegra\Api\ShipEntegraOrderRepositoryInterface;
use MageDesk\ShipEntegra\Model\ResourceModel\ShipEntegraOrder as ResourceShipEntegraOrder;
use MageDesk\ShipEntegra\Model\ResourceModel\ShipEntegraOrder\CollectionFactory as ShipEntegraOrderCollectionFactory;

class ShipEntegraOrderRepository implements ShipEntegraOrderRepositoryInterface
{
    public function __construct(
        private readonly ResourceShipEntegraOrder $resource,
        private readonly ShipEntegraOrderFactory $shipEntegraOrderFactory,
        private readonly ShipEntegraOrderCollectionFactory $shipEntegraOrderCollectionFactory,
        private readonly ShipEntegraOrderSearchResultsInterfaceFactory $searchResultsFactory,
        private readonly CollectionProcessorInterface $collectionProcessor,
        private readonly JoinProcessorInterface $extensionAttributesJoinProcessor,
        private readonly ExtensibleDataObjectConverter $extensibleDataObjectConverter
    ) {
    }

    /**
     * @throws \Exception
     */
    public function save(ShipEntegraOrderInterface $entity): ShipEntegraOrderInterface
    {
        $shipEntegraOrderData = $this->extensibleDataObjectConverter->toNestedArray(
            $entity,
            [],
            ShipEntegraOrderInterface::class
        );

        $shipEntegraOrderModel = $this->shipEntegraOrderFactory->create()->setData($shipEntegraOrderData);

        try {
            $this->resource->save($shipEntegraOrderModel);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the shipEntegraOrder: %1',
                $exception->getMessage()
            ));
        }
        return $shipEntegraOrderModel->getDataModel();
    }

    /**
     * @throws NoSuchEntityException
     */
    public function get(int $id): ShipEntegraOrderInterface
    {
        $shipEntegraOrder = $this->shipEntegraOrderFactory->create();
        $this->resource->load($shipEntegraOrder, $id);
        if (!$shipEntegraOrder->getId()) {
            throw new NoSuchEntityException(__('ShipEntegraOrder with id "%1" does not exist.', $id));
        }
        return $shipEntegraOrder->getDataModel();
    }

    public function getList(SearchCriteriaInterface $criteria): ShipEntegraOrderSearchResultsInterface
    {
        $collection = $this->shipEntegraOrderCollectionFactory->create();

        $this->extensionAttributesJoinProcessor->process(
            $collection,
            ShipEntegraOrderInterface::class
        );

        $this->collectionProcessor->process($criteria, $collection);

        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);

        $items = [];
        foreach ($collection as $model) {
            $items[] = $model->getDataModel();
        }

        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * @throws CouldNotDeleteException
     */
    public function delete(ShipEntegraOrderInterface $shipEntegraOrder): bool
    {
        try {
            $shipEntegraOrderModel = $this->shipEntegraOrderFactory->create();
            $this->resource->load($shipEntegraOrderModel, $shipEntegraOrder->getEntityId());
            $this->resource->delete($shipEntegraOrderModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the ShipEntegraOrder: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    public function deleteById(int $id): bool
    {
        return $this->delete($this->get($id));
    }
}
