<?php

declare(strict_types=1);

namespace NVision\AmastyQuoteApi\Model\Quote;

use NVision\AmastyQuoteApi\Api\Data\QuoteInterface;
use Amasty\RequestQuote\Api\QuoteRepositoryInterface;
use Amasty\RequestQuote\Model\ConfigProvider;
use Amasty\RequestQuote\Model\Quote\Action\MoveInCart;
use Amasty\RequestQuote\Model\Quote\Action\MoveInQuote;
use Amasty\RequestQuote\Model\QuoteFactory;
use Amasty\RequestQuote\Model\Quote\CustomerAccount\QuoteRepository as CustomerQuoteRepository;
use NVision\AmastyQuoteApi\Model\Quote;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Customer\Model\CustomerRegistry;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NotFoundException;
use Magento\Framework\Validator\EmailAddress as EmailAddressValidator;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Webapi\Rest\Request;
use Magento\Catalog\Api\ProductRepositoryInterface;

class QuoteManagement extends \Amasty\RequestQuote\Model\Quote\QuoteManagement implements \NVision\AmastyQuoteApi\Api\QuoteManagementInterface
{
    /**
     * @var ConfigProvider
     */
    private $configProvider;

    /**
     * @var StoreManagerInterface
     */
    private $storeManager;

    /**
     * @var QuoteRepositoryInterface
     */
    private $quoteRepository;
    /**
     * @var CustomerRepositoryInterface
     */
    private $customerRepository;

    /**
     * @var CustomerRegistry
     */
    private $customerRegistry;

    /**
     * @var QuoteFactory
     */
    private $quoteFactory;

    /**
     * @var MoveInCart
     */
    private $moveInCart;

    /**
     * @var MoveInQuote
     */
    private $moveInQuote;

    /**
     * @var EmailAddressValidator
     */
    private $emailAddressValidator;

    /**
     * @var Request
     */
    private $request;

    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;

    /**
     * @var CustomerQuoteRepository
     */
    private $customerQuoteRepository;

    public function __construct(
        ConfigProvider              $configProvider,
        StoreManagerInterface       $storeManager,
        QuoteRepositoryInterface    $quoteRepository,
        CustomerRepositoryInterface $customerRepository,
        CustomerRegistry            $customerRegistry,
        QuoteFactory                $quoteFactory,
        MoveInCart                  $moveInCart,
        MoveInQuote                 $moveInQuote,
        EmailAddressValidator       $emailAddressValidator,
        Request                     $request,
        ProductRepositoryInterface  $productRepository,
        CustomerQuoteRepository     $customerQuoteRepository,
    )
    {
        $this->configProvider = $configProvider;
        $this->storeManager = $storeManager;
        $this->quoteRepository = $quoteRepository;
        $this->customerRepository = $customerRepository;
        $this->customerRegistry = $customerRegistry;
        $this->quoteFactory = $quoteFactory;
        $this->moveInCart = $moveInCart;
        $this->moveInQuote = $moveInQuote;
        $this->emailAddressValidator = $emailAddressValidator;
        $this->request = $request;
        $this->productRepository = $productRepository;
        $this->customerQuoteRepository = $customerQuoteRepository;

        Parent::__construct($configProvider, $storeManager, $quoteRepository, $customerRepository, $customerRegistry,
            $quoteFactory, $moveInCart, $moveInQuote, $emailAddressValidator);
    }


    public function updateQuote(): QuoteInterface|bool
    {
        $quoteData = $this->request->getBodyParams();

        if ($quoteData) {
            try {
                $quote = $this->quoteRepository->get($quoteData['id']);
            } catch (\Exception $e) {
                throw new NotFoundException(__("The quote requested can't be found."));
            }

            try {
                $quote->setStatus((int)$quoteData['status']);
                $quote->setCustomerNote($quoteData['quote_customer_note']);

                if ($quoteData['items'] !== []) {
                    $newItems = $quoteData['items'];

                    //Check existing quoteItems and update them
                    foreach ($quote->getAllItems() as $item) {
                        $key = array_search($item->getId(), array_column($quoteData['items'], 'id'));

                        if ($key !== false) {
                            $item->setQty((int)$quoteData['items'][$key]['qty']);
                            if (array_key_exists('price', $quoteData['items'][$key]) && $quoteData['items'][$key]['price'] !== '') {
                                $item->setCustomPrice((float)$quoteData['items'][$key]['price']);
                                $item->setOriginalCustomPrice((float)$quoteData['items'][$key]['price']);
                                $item->getProduct()->setIsSuperMode(true);
                            }
                            if (array_key_exists('external_id', $quoteData['items'][$key]) && $quoteData['items'][$key]['external_id'] !== '') {
                                $item->setExternalId($quoteData['items'][$key]['external_id']);
                            }
                            unset($newItems[$key]); //Remove found quote item from newItems.
                        } else {
                            $item->delete(); //Item is found in quote but not in the request, so delete the item.
                        }
                    }
                    $this->addProductsToQuote($quote, $newItems); //Add new quote items to quote.
                }

                $this->quoteRepository->save($quote);
                $amastyQuote = $this->customerQuoteRepository->get((int)$quote->getId());
                return new Quote($amastyQuote);
            } catch (\Exception $e) {
                throw new CouldNotSaveException(__("The quote can't be updated."));
            }
        }
        return false;
    }

    public function createQuote(): QuoteInterface|bool
    {
        $quoteData = $this->request->getBodyParams();

        if ($quoteData) {
            $quote = $this->createCustomerQuoteCart((int)$quoteData['customer_id'], (int)$quoteData['store_id'], (int)$quoteData['status'], $quoteData);

            if ($quoteData['items'] !== []) {
                $this->addProductsToQuote($quote, $quoteData['items']);
            }

            try {
                $this->quoteRepository->save($quote);
                $amastyQuote = $this->customerQuoteRepository->get((int)$quote->getId());
                return new Quote($amastyQuote);
            } catch (\Exception $e) {
                throw new CouldNotSaveException(__("The quote can't be created."));
            }
        }
        return false;
    }

    private function addProductsToQuote($quote, $quoteItems): void
    {
        foreach ($quoteItems as $quoteItemData) {
            $product = $this->productRepository->get($quoteItemData['sku']);

            if ($product) {
                $quoteItem = $quote->addProduct($product, (int)$quoteItemData['qty']);
                if (array_key_exists('price', $quoteItemData) && $quoteItemData['price'] !== '') {
                    $quoteItem->setCustomPrice((float)$quoteItemData['price']);
                    $quoteItem->setOriginalCustomPrice((float)$quoteItemData['price']);
                    $quoteItem->getProduct()->setIsSuperMode(true);
                }
                if (array_key_exists('external_id', $quoteItemData) && $quoteItemData['external_id'] !== '') {
                    $quoteItem->setExternalId($quoteItemData['external_id']);
                }
            }
        }
    }

    private function createCustomerQuoteCart(int $customerId, int $storeId, int $newStatus, $additionalData = null): \Amasty\RequestQuote\Api\Data\QuoteInterface
    {
        $customer = $this->customerRepository->getById($customerId);
        $quote = $this->quoteFactory->create();
        $quote->setStoreId($storeId);
        $quote->setCustomer($customer);
        $quote->setCustomerIsGuest(0);
        $quote->setStatus($newStatus);
        $quote->setQuoteCurrencyCode($this->storeManager->getStore()->getBaseCurrencyCode());

        if ($additionalData['quote_customer_note']) {
            $quote->setCustomerNote($additionalData['quote_customer_note']);
        }
        return $quote;
    }
}
