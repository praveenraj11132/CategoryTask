<?php

namespace Wheelpros\CatalogExtended\Api\Data;

interface ProductImageInterface
{
    /**
     * Media Type
     *
     * @const
     */
    public const MEDIA_TYPE = 'media_type';

    /**
     * Media URI
     *
     * @const
     */
    public const MEDIA_URI = 'media_uri';

    /**
     * Retrieve Media types
     *
     * @return string[]
     */
    public function getMediaType(): array;

    /**
     * Set Media types
     *
     * @param string[] $mediaType
     * @return $this
     */
    public function setMediaType(array $mediaType);

    /**
     * Retrieve Media Uri
     *
     * @return string
     */
    public function getMediaUri(): string;

    /**
     * Set Media Uri
     *
     * @param string $mediaUri
     * @return $this
     */
    public function setMediaUri(string $mediaUri);
}
