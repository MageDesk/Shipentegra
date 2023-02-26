<?php

declare(strict_types=1);

namespace MageDesk\ShipEntegra\Model;

use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Data\Collection\AbstractDb;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\Context;
use Magento\Framework\Registry;
use MageDesk\ShipEntegra\Api\Data\ShipEntegraOrderInterface;
use MageDesk\ShipEntegra\Api\Data\ShipEntegraOrderInterfaceFactory;

class ShipEntegraOrder extends AbstractModel
{
    public function __construct(
        Context $context,
        Registry $registry,
        private readonly DataObjectHelper $dataObjectHelper,
        private readonly  ShipEntegraOrderInterfaceFactory $shipEntegraOrderDataFactory,
        ResourceModel\ShipEntegraOrder $resource,
        AbstractDb $resourceCollection = null,
        array $data = []
    ) {
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * @return void
     */
    protected function _construct() {
        $this->_init('MageDesk\ShipEntegra\Model\ResourceModel\ShipEntegraOrder');
    }

    public function getDataModel(): ShipEntegraOrderInterface
    {
        $data = $this->getData();

        $dataObject = $this->shipEntegraOrderDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $dataObject,
            $data,
            ShipEntegraOrderInterfaceFactory::class
        );

        return $dataObject;
    }
}
