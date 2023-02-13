<?php

namespace Wheelpros\CatalogExtended\Api;

/**
 * @api
 */
interface ProductImageManagementInterface
{
    /**
     * Create images for product
     *
     * @param string $sku
     * @param \Wheelpros\CatalogExtended\Api\Data\ProductImageInterface[] $images
     * @return \Wheelpros\CatalogExtended\Api\Data\StatusInterface
     */
    public function create(string $sku, array $images);
}
