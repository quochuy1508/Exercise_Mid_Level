/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
define([
    'jquery',
    'productSalableQty',
    'jquery-ui-modules/widget'
], function ($, productSalableQty) {
    'use strict';

    return function (SwatchRenderer) {
        $.widget('mage.SwatchRenderer', SwatchRenderer, {

            /** @inheritdoc */
            _OnClick: function ($this, widget) {
                var productVariationsSku = this.options.jsonConfig.qty;

                this._super($this, widget);
                productSalableQty(productVariationsSku[widget.getProductId()]);
            }
        });

        return $.mage.SwatchRenderer;
    };
});
