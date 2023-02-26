/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

define([
    'uiComponent',
    'Magento_Checkout/js/model/shipping-rates-validator',
    'Magento_Checkout/js/model/shipping-rates-validation-rules',
    'MageDesk_ShipEntegra/js/model/shipping-rates-validator',
    'MageDesk_ShipEntegra/js/model/shipping-rates-validation-rules'
], function (
    Component,
    defaultShippingRatesValidator,
    defaultShippingRatesValidationRules,
    mgdskShippingRatesValidator,
    mgdsjShippingRatesValidationRules
) {
    'use strict';

    mgdskShippingRatesValidator.registerValidator('mgdskShpntgr', mgdskShippingRatesValidator);
    mgdsjShippingRatesValidationRules.registerRules('mgdskShpntgr', mgdsjShippingRatesValidationRules);

    return Component;
});
