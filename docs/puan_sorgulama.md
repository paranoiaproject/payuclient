# Puan Sorgulama İşlemi

Puan sorgulama işlemi, kredi kartına ilişkin bilgilerle dolu bir istek nesnesinin istemci üzerinden servis sağlayıcıya iletilmesi şeklinde gerçekleştirilir.

## İstemcinin Hazırlanması

```php
use Payu\Client;
use Payu\Configuration;

$configuration = new Configuration();

$configuration
    ->setMerchantId('MY_MERCHANT_01')
    ->setSecretKey('SECRET_KEY')
    ->setLoyaltyInquiryEndPointUrl('https://secure.payu.com.tr/api/loyalty-points/check');
;

$client = new Client($configuration);
```

## Puan Sorgulama İsteğinin Oluşturulması
Puan Sorgulama İsteği, *Client* nesnesi üstündeki kurucu metodlar vasıtasyıla veya isteği oluşturan bileşenlerin ayrı ayrı oluşturulması ile kolayca oluşturulabilir.

Aşağıdaki kod örneği ödeme isteğini *Client* nesnesi üzerindeki kurucu metodlarla gerçekleştirmektedir.

```php

/** @var $request \Payu\Request\LoyaltyInquiryRequest */
$client = new Client($configuration);
$request = $client->createLoyaltyInquiryRequestBuilder()
            ->buildCard('4282209027132016', '123', '5', '2019')
            ->buildCurrency('TRY')
            ->build();
```

Aşağıdaki örnek kod ise istek nesnesini, kendisini oluşturan bileşenlerin manuel olarak oluşturulması ile yaratmaktadır.

```php
use Payu\Component\Card;

$card = new Card();
$card->setNumber('4282209027132016')
    ->setCvv('123')
    ->setMonth(5)
    ->setYear(2019);

$currency = new Currency();
$currency->setCode('TRY');

/** @var $request \Payu\Request\LoyaltyInquiryRequest */
$request = $client->createLoyaltyInquiryRequestBuilder()
    ->setCard($card)
    ->setCurrency($currency)
    ->build();
```

## Sorgulama İşleminin Gerçekleştirilmesi
Sorgulama işlemi, client nesnesinin makeLoyaltyInquiry() metodunun çağırılması ile gerçekleştirilir.

```php
$response = $client->makeLoyaltyInquiry($request)
```

## İşlem Sonucunun Kontrol Edilmesi

```php
    if ($response->getStatus() == ResponseAbstract::STATUS_APPROVED) {
        // Puan sorgulama işlemi başarılı bir şekilde gerçekleşti
        print_r($response);
    } else {
        // Puan sorgulama işleminde bir hata oluştu.
        echo $response->getMessage();
    }

```

Son olarak herşeyi bir araya getirelim.
```php


use Payu\Client;
use Payu\Configuration;
use Payu\Component\Card;
use Payu\Component\Currency;

$configuration = new Configuration();
$configuration->setMerchantId('MY_MERCHANT_01')
              ->setSecretKey('SECRET_KEY')
              ->setLoyaltyInquiryEndPointUrl('https://secure.payu.com.tr/api/loyalty-points/check');

$client = new Client($configuration);
$request = $client->createLoyaltyInquiryRequestBuilder()
            ->buildCard('4282209027132016', '123', '5', '2019')
            ->buildCurrency('TRY')
            ->build();

$curreny = new Currency();
$curreny->setCode('TRY');

$response = $client->makeLoyaltyInquiry($request);

if ($response->getStatus() == ResponseAbstract::STATUS_APPROVED) {
    // Puan sorgulama işlemi başarılı bir şekilde gerçekleşti
    print_r($response);
} else {
    // Puan sorgulama işleminde bir hata oluştu.
    echo $response->getMessage();
}
```
