<?php

declare(strict_types=1);

namespace MageDesk\ShipEntegra\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class ShipEntegraOrder extends AbstractDb
{
    public const MAIN_TABLE = 'magedesk_shipentegra_shipentegraorder';

    public const ID_FIELD_NAME = 'entity_id';

    protected function _construct()
    {
        $this->_init(self::MAIN_TABLE, self::ID_FIELD_NAME);
    }
}
