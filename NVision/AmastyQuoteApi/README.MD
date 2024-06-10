# NVision amasty quote
This module adds custom enpoints for creating and updating quotes through the Magento 2 API.
It depends on the Amasty [request a quote](https://amasty.com/request-a-quote-for-magento-2.html) module.

## Endpoints

#### create new quote

```http
POST /rest/V1/quote
```
Example Body:

    "status": 1,
    "shipping_configure": false,
    "quote_customer_note": "test note",
    "id": 3,
    "is_active": false,
    "is_virtual": false,
    "customer_id": 4,
    "currency": "EUR",
    "customer_note_notify": true,
    "store_id": 1,
    "items": [
        {
            "customer_note": "",
            "sku": "sku1",
            "qty": 1,
            "name": "product 1",
            "price": 100,
            "external_id" : "external guid"
        }
    ]

#### Update quote

```http
PUT /rest/V1/quote
```
Example Body:

    "status": 1,
    "shipping_configure": false,
    "quote_customer_note": "test note",
    "id": 84,
    "is_active": false,
    "is_virtual": false,
    "customer_id": 4,
    "currency": "EUR",
    "customer_note_notify": true,
    "store_id": 1,
    "items": [
         {
            "id": 106,
            "sku": "product 1",
            "qty": 2,
            "external_id": "45"
        }
    ]

## More information
Administrated by: NVision Commerce Solutions

For more information on this module contact [NVision Commerce Solutions](https://n.vision)

