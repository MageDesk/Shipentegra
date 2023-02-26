<?php 

declare(strict_types=1);

namespace MageDesk\ShipEntegra\Model\ResourceModel\ShipEntegraOrder;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use MageDesk\ShipEntegra\Model\ShipEntegraOrder;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(ShipEntegraOrder::class, \MageDesk\ShipEntegra\Model\ResourceModel\ShipEntegraOrder::class);
    }
}
