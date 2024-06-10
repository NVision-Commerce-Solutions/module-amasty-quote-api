<?php

namespace NVision\AmastyQuoteApi\Model;

use NVision\AmastyQuoteApi\Api\Data\QuoteItemInterface;
use Magento\Quote\Api\Data\CartExtensionInterface;

class QuoteItem implements QuoteItemInterface
{
    public function __construct(
        private \Amasty\RequestQuote\Api\Data\QuoteItemInterface $amastyQuoteItem
    )
    {
    }

    public function getItemId()
    {
        return $this->amastyQuoteItem->getItemId();
    }

    public function setItemId($itemId)
    {
        return $this->amastyQuoteItem->setItemId($itemId);
    }

    public function getSku()
    {
        return $this->amastyQuoteItem->getSku();
    }

    public function setSku($sku)
    {
        return $this->amastyQuoteItem->setSku($sku);
    }

    public function getQty()
    {
        return $this->amastyQuoteItem->getQty();
    }

    public function setQty($qty)
    {
        return $this->amastyQuoteItem->setQty($qty);
    }

    public function getName()
    {
        return $this->amastyQuoteItem->getName();
    }

    public function setName($name)
    {
        return $this->amastyQuoteItem->setName($name);
    }

    public function getPrice()
    {
        return $this->amastyQuoteItem->getPrice();
    }

    public function setPrice($price)
    {
        return $this->amastyQuoteItem->setPrice($price);
    }

    public function getProductType()
    {
        return $this->amastyQuoteItem->getProductType();
    }

    public function setProductType($productType)
    {
        return $this->amastyQuoteItem->setProductType($productType);
    }

    public function getQuoteId()
    {
        return $this->amastyQuoteItem->getQuoteId();
    }

    public function setQuoteId($quoteId)
    {
        return $this->amastyQuoteItem->setQuoteId($quoteId);
    }

    public function getProductOption()
    {
        return $this->amastyQuoteItem->getProductOption();
    }

    public function setProductOption(ProductOptionInterface|\Magento\Quote\Api\Data\ProductOptionInterface $productOption)
    {
        return $this->amastyQuoteItem->setProductOption($productOption);
    }

    public function getExtensionAttributes()
    {
        return $this->amastyQuoteItem->getExtensionAttributes();
    }

    public function setExtensionAttributes(CartItemExtensionInterface|\Magento\Quote\Api\Data\CartItemExtensionInterface $extensionAttributes)
    {
        return $this->amastyQuoteItem->setExtensionAttributes($extensionAttributes);
    }

    public function getExternalId(): ?string
    {
        return $this->amastyQuoteItem->getExternalId();
    }

    public function setCustomerNote(string $customerNote): void
    {
        $this->amastyQuoteItem->setCustomerNote($customerNote);
    }

    public function getAdminNote(): ?string
    {
        return $this->amastyQuoteItem->getAdminNote();
    }

    public function setAdminNote(string $adminNote): void
    {
        $this->amastyQuoteItem->setAdminNote($adminNote);
    }

    public function setExternalId(string $externalId): void
    {
        $this->amastyQuoteItem->setExternalId($externalId);
    }

    public function getCustomerNote(): ?string
    {
        return $this->amastyQuoteItem->getCustomerNote();
    }
}
