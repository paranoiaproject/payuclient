# Satış

Satılan mal ya da hizmet karşılığında kullanıcının ödeme aracından (Kredi kartı vb.) para tahsilatı yapmak için gerçekleştirilen işlemdir. PayuClient ile satış işlemini gerçekleştirmek için aşağıdaki yönergeleri takip edebilirsiniz.

## Konfigürasyon ve İstemciyi Hazırlamak

PayuClient kullanarak satış işlemi gerçekleştirmek için, payu tarafından sağlanan erişim bilgilerinin kütüphaneye bildirilmesini sağlayacak **Payu\Configuration** tipinde bir nesne oluşturarak istemciye kurulum sırasında argüman olarak göndermelisiniz.

```php
use Payu\Client;
use Payu\Configuration;

$configuration = new Configuration();

$configuration->setMerchantId('MY_MERCHANT_01')
    ->setSecretKey('SECRET_KEY')
    ->setPaymentEndpointUrl('https://secure.payu.com.tr/order/alu/v3');

$client = new Client($configuration);
```

## Satış İsteği Oluşturma

İstek oluşturma işlemini gerçekleştirmeki için kütüphane ile sağlanan kurucu metodları kullanabilirsiniz. Kurucu metodlar, istekle ilgil bileşenleri doğrudan veya yardımcı kurucu metodlarla alabilirler.

### Yardımcı Kurucu Metodlarla Satış İsteğinin Oluşturması

```php
/** @var $request \Payu\Request\PaymentRequest */
$request = $client->createPaymentRequestBuilder()
    ->buildCard('4282209027132016', '123', 5, 2019)
    ->buildOrder('ORDERNO123456', '127.0.0.1')
    ->buildBilling('John', 'Smith', 'test@test.net', '05321231212')
    ->buildAndAddProduct('The Product', 'PR1', 1, 10)
    ->build();
```

### Bileşenlerle Satış İsteğinin Oluşturulması

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
        ->setEmail('test@test.net');


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

## Satış İşleminin Gerçekleştirilmesi

```php
/**
* @var $request \Payu\Request\PaymentRequest
* @var $response \Payu\Response\PaymentResponse
*/
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

## [Peşin Satış İşlemi](#pesin-satis)
```php
use Payu\Client;
use Payu\Configuration;
use Payu\Component\Card;
use Payu\Component\Order;
use Payu\Component\Billing;
use Payu\Component\Product;

// Satis islemi icin istemciyi hazirliyoruz.
$configuration = new Configuration();

$configuration->setMerchantId('MY_MERCHANT_01')
    ->setSecretKey('SECRET_KEY')
    ->setPaymentEndpointUrl('https://secure.payu.com.tr/order/alu/v3');

$client = new Client($configuration);

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
        ->setEmail('test@test.net');


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

/**
* @var $request \Payu\Request\PaymentRequest
* @var $response \Payu\Response\PaymentResponse
*/
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

## [Taksitli Satış İşlemi](#taksitli-satis)

Taksitli satış işlemi gerçekleştirilirken, taksit bilgisi, **buildOrder** yardımcı kurucu metodunun 3. parametresi olan $installment parametresi ile veya **Payu\Component\Order** sınıfının **setInstallment** metodu ile gönderileiblir.

```php
//...
->buildOrder('ORDERNO123456', '127.0.0.1', 3)
//...
```
veya
```php
$order = new Order();
$order->setCode('ORDERNO123456')
      ->setClientIp('127.0.0.1')
      //...
      ->setInstallment(3);

```

## [Tekrarlayan Ödeme İşlemi](#tekrarlayan-odeme)

Tekrarlayan ödeme işlemi gerçekleştirilirken, işlemin tekrarlayan ödeme olup olmadığı bilgisi, **buildOrder** yardımcı kurucu metodununa 9. parametresi olan $recurringPayment parametresi ile veya **Payu\Component\Order** sınıfının **setRecurringPayment** metodu ile gönderileiblir.

```php
//...
->buildOrder('ORDERNO123456', '127.0.0.1', ..., true)
//...
```
veya
```php
$order = new Order();
$order->setCode('ORDERNO123456')
      ->setClientIp('127.0.0.1')
      //...
     ->setRecurringPayment(true);
```
