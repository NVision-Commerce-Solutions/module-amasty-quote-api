<?php

namespace NVision\AmastyQuoteApi\Plugin;

use Amasty\RequestQuote\Api\Data\CustomerAccount\QuoteItemInterface;
use Amasty\RequestQuote\Model\Quote\CustomerAccount\ConvertCartItem as RequestQuoteConvertCartItem;
use Magento\Quote\Api\Data\CartItemInterface;

class ConvertCartItem
{
    /**
     * @param RequestQuoteConvertCartItem $subject
     * @param QuoteItemInterface $result
     * @param CartItemInterface $cartItem
     * @return QuoteItemInterface
     */
    public function afterExecute(RequestQuoteConvertCartItem $subject, QuoteItemInterface $result, CartItemInterface $cartItem): QuoteItemInterface
    {
        // Get extension_attribute 'external_id' form cartItem and add it to the quote item.
        if ($cartItem->getExternalId()) {
            $result->setExternalId($cartItem->getExternalId());
        }
        return $result;
    }
}
