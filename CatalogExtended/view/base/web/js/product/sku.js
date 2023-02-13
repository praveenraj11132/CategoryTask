/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

define([
    'Magento_Ui/js/grid/columns/column',
    'Magento_Catalog/js/product/list/column-status-validator',
    'escaper'
], function (Column, columnStatusValidator, escaper) {
    'use strict';

    return Column.extend({
        defaults: {
            allowedTags: ['div', 'span', 'b', 'strong', 'i', 'em', 'u', 'a']
        },

        /**
         * Depends on this option, product sku can be shown or hide.
         *
         * @returns {Boolean}
         */
        isAllowed: function () {
            return columnStatusValidator.isValid(this.source(), 'sku', 'show_attributes');
        },

        /**
         * SKU column.
         *
         * @param {String} label
         * @returns {String}
         */
        getNameUnsanitizedHtml: function (label) {
            return escaper.escapeHtml(label, this.allowedTags);
        }
    });
});
