<?php

namespace NVision\AmastyQuoteApi\Api\Data;

interface QuoteItemInterface extends \Amasty\RequestQuote\Api\Data\CustomerAccount\QuoteItemInterface
{
    /**
     * @return string|null
     */
    public function getExternalId(): ?string;

    /**
     * @param string $externalId
     * @return void
     */
    public function setExternalId(string $externalId): void;
}
