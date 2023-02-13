<?php

namespace Wheelpros\CatalogExtended\Api\Data;

interface StatusInterface
{
    /**
     * Media Type
     *
     * @const
     */
    public const ERROR = 'error';

    /**
     * Media URI
     *
     * @const
     */
    public const MESSAGE = 'message';

    /**
     * Is error
     *
     * @return bool
     */
    public function getError(): bool;

    /**
     * Set Error status
     *
     * @param bool $error
     * @return $this
     */
    public function setError(bool $error);

    /**
     * Retrieve message
     *
     * @return string
     */
    public function getMessage(): string;

    /**
     * Set message
     *
     * @param string $message
     * @return $this
     */
    public function setMessage(string $message);
}
