# 3D Secure ile Satış İşlemi

3D secure bir işlem yapmak için konfigürasyon sınıfımıza bir geri dönüş adresi eklememiz gerekli. Böylelikle PayU;
gönderdiğimiz işlemin sonucu bize bildirebilir.

## Örnek akış

```php
use Payu\Client;
use Payu\Configuration;

$configuration = new Configuration();

$configuration->setMerchantId('MY_MERCHANT_01')
    ->setSecretKey('SECRET_KEY')
    ->setPaymentEndpointUrl('https://secure.payu.com.tr/order/alu/v3')
    ->setPaymentReturnPointUrl('http://localhost:8001/callback.php'); //İşlemin sonucunu almak istediğim url

...

$response = $client->makePayment($request);

if ($response->getStatus() == ResponseAbstract::STATUS_UNAUTHORIZED) {
    header("Location: " . $response->getUrl3DS());
    die();
} elseif ($response->getStatus() == ResponseAbstract::STATUS_APPROVED) {
    echo $response->getTransactionId();
} else {
    /*
    // Odeme islemi hatali oldu

    echo $response->getCode();
    echo $response->getMessage();
    */
}


```

## Callback.php

```php
use Payu\Response\ResponseAbstract;
use Payu\Parser\PaymentResponseParser;


$response = (new PaymentResponseParser())->parse($_POST);

if ($response->getStatus() == ResponseAbstract::STATUS_APPROVED) {
    echo $response->getTransactionId();
} else {
    /*
    // Odeme islemi hatali oldu

    echo $response->getCode();
    echo $response->getMessage();
    */
}
```

