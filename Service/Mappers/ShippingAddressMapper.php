<?php
/*
 * @author MageDesk Team
 * @copyright Copyright (c) MageDesk (https://www.magedesk.com/)
 */

namespace MageDesk\ShipEntegra\Service\Mappers;

use Magento\Sales\Model\Order\Address;

/**
 * Class ShippingAddressMapper
 */
class ShippingAddressMapper extends AbstractMapper
{
    /**
     * @param Address $data
     * @return array
     */
    public function map($data)
    {
        $newAddress = [];
        $newAddress['name'] = $data->getFirstname() . ' ' . $data->getLastname();
        $newAddress['address'] = $data->getStreetLine(1);
        $newAddress['city'] = $data->getCity();
        $newAddress['postalCode'] = $data->getPostcode();
        $newAddress['country'] = $data->getCountryId();
        $newAddress['state'] = $data->getRegion();
        $newAddress['phone'] = $data->getTelephone();
        $newAddress['email'] = $data->getEmail();
        $newAddress['town'] = $data->getStreetLine(2);
        return $newAddress;
    }
}
