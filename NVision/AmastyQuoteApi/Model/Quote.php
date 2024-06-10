<?php

namespace NVision\AmastyQuoteApi\Model;

use NVision\AmastyQuoteApi\Api\Data\QuoteInterface;
use Magento\Quote\Api\Data\CartExtensionInterface;

/**
 * @method  setRemarks
 */
class Quote implements QuoteInterface
{
    public function __construct(
        private \Amasty\RequestQuote\Api\Data\CustomerAccount\QuoteInterface $amastyQuote
    )
    {
    }

    public function getId()
    {
        return $this->amastyQuote->getId();
    }

    public function setId($id)
    {
        return $this->amastyQuote->setId($id);
    }

    public function getCreatedAt()
    {
        return $this->amastyQuote->getCreatedAt();
    }

    public function setCreatedAt($createdAt)
    {
        return $this->amastyQuote->setCreatedAt($createdAt);
    }

    public function getUpdatedAt()
    {
        return $this->amastyQuote->getUpdatedAt();
    }

    public function setUpdatedAt($updatedAt)
    {
        return $this->amastyQuote->setUpdatedAt($updatedAt);
    }

    public function getConvertedAt()
    {
        return $this->amastyQuote->getConvertedAt();
    }

    public function setConvertedAt($convertedAt)
    {
        return $this->amastyQuote->setConvertedAt($convertedAt);
    }

    public function getIsActive()
    {
        return $this->amastyQuote->getIsActive();
    }

    public function setIsActive($isActive)
    {
        return $this->amastyQuote->setIsActive($isActive);
    }

    public function getIsVirtual()
    {
        return $this->amastyQuote->getIsVirtual();
    }

    public function getItemsCount()
    {
        return $this->amastyQuote->getItemsCount();
    }

    public function setItemsCount($itemsCount)
    {
        return $this->amastyQuote->setItemsCount($itemsCount);
    }

    public function getItemsQty()
    {
        return $this->amastyQuote->getItemsQty();
    }

    public function setItemsQty($itemQty)
    {
        return $this->amastyQuote->setItemsQty($itemQty);
    }

    public function getCustomer()
    {
        return $this->amastyQuote->getCustomer();
    }

    public function setCustomer(\Magento\Customer\Api\Data\CustomerInterface $customer = null)
    {
        return $this->amastyQuote->setCustomer($customer);
    }

    public function getBillingAddress()
    {
        return $this->amastyQuote->getBillingAddress();
    }

    public function setBillingAddress(AddressInterface|\Magento\Quote\Api\Data\AddressInterface $billingAddress = null)
    {
        return $this->amastyQuote->setBillingAddress($billingAddress);
    }

    public function getReservedOrderId()
    {
        return $this->amastyQuote->getReservedOrderId();
    }

    public function setReservedOrderId($reservedOrderId)
    {
        return $this->amastyQuote->setReservedOrderId($reservedOrderId);
    }

    public function getOrigOrderId()
    {
        return $this->amastyQuote->getOrigOrderId();
    }

    public function setOrigOrderId($origOrderId)
    {
        return $this->amastyQuote->setOrigOrderId($origOrderId);
    }

    public function getCurrency()
    {
        return $this->amastyQuote->getCurrency();
    }

    public function setCurrency(CurrencyInterface|\Magento\Quote\Api\Data\CurrencyInterface $currency = null)
    {
        return $this->amastyQuote->setCurrency($currency);
    }

    public function getCustomerIsGuest()
    {
        return $this->amastyQuote->getCustomerIsGuest();
    }

    public function setCustomerIsGuest($customerIsGuest)
    {
        return $this->amastyQuote->setCustomerIsGuest($customerIsGuest);
    }

    public function getCustomerNote()
    {
        return $this->amastyQuote->getCustomerNote();
    }

    public function setCustomerNote($customerNote)
    {
        return $this->amastyQuote->setCustomerNote($customerNote);
    }

    public function getCustomerNoteNotify()
    {
        return $this->amastyQuote->getCustomerNoteNotify();
    }

    public function setCustomerNoteNotify($customerNoteNotify)
    {
        return $this->amastyQuote->setCustomerNoteNotify($customerNoteNotify);
    }

    public function getCustomerTaxClassId()
    {
        return $this->amastyQuote->getCustomerTaxClassId();
    }

    public function setCustomerTaxClassId($customerTaxClassId)
    {
        return $this->amastyQuote->setCustomerTaxClassId($customerTaxClassId);
    }

    public function getStoreId()
    {
        return $this->amastyQuote->getStoreId();
    }

    public function setStoreId($storeId)
    {
        return $this->amastyQuote->setStoreId($storeId);
    }

    public function getStatus(): int
    {
        return $this->amastyQuote->getStatus();
    }

    public function setStatus(int $status): void
    {
        $this->amastyQuote->setStatus($status);
    }

    public function isShippingConfigure(): bool
    {
        return $this->amastyQuote->isShippingConfigure();
    }

    public function setShippingConfigure(bool $shippingConfigure): void
    {
        $this->amastyQuote->setShippingConfigure($shippingConfigure);
    }

    public function getCustomerFirstname(): ?string
    {
        return $this->amastyQuote->getCustomerFirstname();
    }

    public function getCustomerLastname(): ?string
    {
        return $this->amastyQuote->getCustomerLastname();
    }

    public function getCustomerEmail(): ?string
    {
        return $this->amastyQuote->getCustomerEmail();
    }

    public function getQuoteCustomerNote(): ?string
    {
        return $this->amastyQuote->getQuoteCustomerNote();
    }

    public function setQuoteCustomerNote(string $customerNote): void
    {
        $this->amastyQuote->setQuoteCustomerNote($customerNote);
    }

    public function getExtensionAttributes()
    {
        return $this->amastyQuote->getExtensionAttributes();
    }

    public function setExtensionAttributes(CartExtensionInterface $extensionAttributes)
    {
        return $this->amastyQuote->setExtensionAttributes($extensionAttributes);
    }

    public function getQuoteAdminNote(): ?string
    {
        return $this->amastyQuote->getQuoteAdminNote();
    }

    public function setQuoteAdminNote(string $adminNote): void
    {
        $this->amastyQuote->setQuoteAdminNote($adminNote);
    }

    public function setQuoteAdminDiscountNote(string $adminDiscountNote): void
    {
        $this->amastyQuote->setQuoteAdminDiscountNote($adminDiscountNote);
    }

    public function getQuoteAdminDiscountNote(): ?string
    {
        return $this->amastyQuote->getQuoteAdminDiscountNote();
    }

    public function getItems()
    {
        $items = [];
        foreach($this->amastyQuote->getItems() as $item) {
            $items[] = new QuoteItem($item);
        }
        return $items;
    }

    public function setItems(array $items = null)
    {
        //Not used
        return [];
    }

    public function __call(string $name, array $arguments)
    {
        return $this->amastyQuote->{$name}(...$arguments);
    }
}
