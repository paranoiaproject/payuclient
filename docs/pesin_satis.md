# Peşin Satış İşlemi

Peşin satış işlemi, siparişe ilişkin bilgilerle donatılmış bir istek nesnesinin istemci üzerinden servis sağlayıcıya iletilmesi şeklinde gerçekleştirilir.

## İstemcinin Hazırlanması

```php
use Payu\Client;
use Payu\Configuration;

$configuration = new Configuration();

$configuration->setMerchantId('MY_MERCHANT_01')
    ->setSecretKey('SECRET_KEY')
    ->setPaymentEndpointUrl('https://secure.payu.com.tr/order/alu/v3');

$client = new Client($configuration);
```

## Ödeme İsteğinin Oluşturulması
Ödeme isteği, *Client* nesnesi üstündeki kurucu metodlar vasıtasyıla veya isteği oluşturan bileşenlerin ayrı ayrı oluşturulması ile kolayca oluşturulabilir.

Aşağıdaki kod örneği ödeme isteğini *Client* nesnesi üzerindeki kurucu metodlarla gerçekleştirmektedir.

```php
/** @var $request \Payu\Request\PaymentRequest */
$request = $client->createPaymentRequestBuilder()
    ->buildCard('4282209027132016', '123', 5, 2019)
    ->buildOrder('ORDERNO123456', '127.0.0.1')
    ->buildBilling('John', 'Smith', 'test@test.net', '05321231212')
    ->buildAndAddProduct('The Product', 'PR1', 1, 10)
    ->build();
```

Aşağıdaki örnek kod ise istek nesnesini, kendisini oluşturan bileşenlerin manuel olarak oluşturulması ile yaratmaktadır.

```php
use Payu\Component\Card;
use Payu\Component\Order;
use Payu\Component\Billing;
use Payu\Component\Product;

$card = new Card();
$card->setNumber('4282209027132016')
    ->setCvv('123')
    ->setMonth(5)
    ->setYear(2019);

$order = new Order();
$order->setCode('ORDERNO123456')
      ->setClientIp('127.0.0.1');

$billing = new Billing();
$billing->setFirstName('John')
        ->setLastName('Smith')
        ->setPhone('05321231212')
        ->setEmail('test@test.net')
        ->setCountryCode('TR');


$product = new Product();
$product->setCode('PR1')
    ->setName('The Product')
    ->setQuantity(1)
    ->setPrice(10);

/** @var $request \Payu\Request\PaymentRequest */
$request = $client->createPaymentRequestBuilder()
    ->setCard($card)
    ->setOrder($order)
    ->setBilling($billing)
    ->addProduct($product)
    ->build();
```

## Ödeme İşleminin Gerçekleştirilmesi
Ödeme işlemi, client nesnesinin makePayment() metodunun çağırılması ile gerçekleştirilir.
```php
/**
* @var $request \Payu\Request\PaymentRequest
* @var $response \Payu\Response\PaymentResponse
*/
$response = $client->makePayment($request)
```

## İşlem Sonucunun Kontrol Edilmesi
```php
if($response->getStatus() == ResponseAbstract::STATUS_APPROVED) {
    /*
    // Odeme islemi basariyla gerceklesti.
    echo $response->getTransactionId()
    */
} else {
    /*
    // Odeme islemi hatali oldu

    echo $response->getCode();
    echo $response->getMessage();
    */
}
```


Son olarak herşeyi bir araya getirelim.
```php
use Payu\Client;
use Payu\Configuration;
use Payu\Response\ResponseAbstract;

$configuration = new Configuration();

$configuration->setMerchantId('MY_MERCHANT_01')
    ->setSecretKey('SECRET_KEY')
    ->setPaymentEndpointUrl('https://secure.payu.com.tr/order/alu/v3');

$client = new Client($configuration);

/** @var $request \Payu\Request\PaymentRequest */
$request = $client->createPaymentRequestBuilder()
    ->buildCard('4282209027132016', '123', 5, 2019)
    ->buildOrder('ORDERNO123456', '127.0.0.1')
    ->buildBilling('John', 'Smith', 'test@test.net', '05321231212', null, null, null, null, null, 'TR')
    ->buildAndAddProduct('The Product', 'PR1', 1, 10, 5)
    ->build();

$response = $client->makePayment($request)

if($response->getStatus() == ResponseAbstract::STATUS_APPROVED) {
    /*
    // Odeme islemi basariyla gerceklesti.
    echo $response->getTransactionId()
    */
} else {
    /*
    // Odeme islemi hatali oldu

    echo $response->getCode();
    echo $response->getMessage();
    */
}
```
