<?php

namespace Wheelpros\CatalogExtended\Model\Data;

use Magento\Framework\DataObject;
use Wheelpros\CatalogExtended\Api\Data\ProductImageInterface;

class ProductImage extends DataObject implements ProductImageInterface
{
    /**
     * @inheritDoc
     */
    public function getMediaType(): array
    {
        return $this->getData(self::MEDIA_TYPE);
    }

    /**
     * @inheritDoc
     */
    public function setMediaType(array $mediaType)
    {
        return $this->setData(self::MEDIA_TYPE, $mediaType);
    }

    /**
     * @inheritDoc
     */
    public function getMediaUri(): string
    {
        return $this->getData(self::MEDIA_URI);
    }

    /**
     * @inheritDoc
     */
    public function setMediaUri(string $mediaUri)
    {
        return $this->setData(self::MEDIA_URI, $mediaUri);
    }
}
