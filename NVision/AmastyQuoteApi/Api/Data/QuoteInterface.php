<?php

namespace NVision\AmastyQuoteApi\Api\Data;

interface QuoteInterface extends \Amasty\RequestQuote\Api\Data\CustomerAccount\QuoteInterface
{
    /**
     * @return \NVision\AmastyQuoteApi\Api\Data\QuoteItemInterface[]
     */
    public function getItems();
}
