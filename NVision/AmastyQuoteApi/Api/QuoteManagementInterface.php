<?php

namespace NVision\AmastyQuoteApi\Api;

use NVision\AmastyQuoteApi\Api\Data\QuoteInterface;
use Amasty\RequestQuote\Api\QuoteManagementInterface as OriginalQuoteManagementInterface;

interface QuoteManagementInterface extends OriginalQuoteManagementInterface
{
    /**
     * Update a specified quote.
     *
     * @return QuoteInterface | bool
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Magento\Framework\Exception\StateException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function updateQuote(): QuoteInterface | bool;

    /**
     * Create a quote with data.
     *
     * @return QuoteInterface | bool
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Magento\Framework\Exception\StateException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function createQuote(): QuoteInterface | bool;
}
