<?php

namespace Wheelpros\CatalogExtended\Model\Data;

use Magento\Framework\DataObject;
use Wheelpros\CatalogExtended\Api\Data\StatusInterface;

class Status extends DataObject implements StatusInterface
{

    /**
     * @inheritDoc
     */
    public function getError(): bool
    {
        return $this->getData(self::ERROR);
    }

    /**
     * @inheritDoc
     */
    public function setError(bool $error)
    {
        return $this->setData(self::ERROR, $error);
    }

    /**
     * @inheritDoc
     */
    public function getMessage(): string
    {
        return $this->getData(self::MESSAGE);
    }

    /**
     * @inheritDoc
     */
    public function setMessage(string $message)
    {
        return $this->setData(self::MESSAGE, $message);
    }
}
