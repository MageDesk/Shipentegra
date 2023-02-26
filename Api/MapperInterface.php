<?php
/*
 * @author MageDesk Team
 * @copyright Copyright (c) MageDesk (https://www.magedesk.com/)
 */

namespace MageDesk\ShipEntegra\Api;

/**
 * Interface MapperInterface
 */
interface MapperInterface
{

    /**
     * @param $data
     * @return array
     */
    public function map($data);
}
