# Taksitli Satış İşlemi

Aşağıdaki örnek kod, taksitli satış işlemini gerçekleştirmektedir. Örnekde kullanılan tüm parametreler zorunludur. Opsiyonel parametreler için referans dökünınını inceleyebilirsiniz.

```php
use Payu\Client;
use Payu\Configuration;
use Payu\Component\Card;
use Payu\Component\Order;
use Payu\Component\Billing;
use Payu\Component\Product;

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
	  ->setClientIp('127.0.0.1')
	  ->setInstallment(3);

$billing = new Billing();
$billing->setFirstName('John')
		->setLastName('Smith')
		->setPhone('05321231212')
		->setEmail('test@test.net')
		->setCountryCode('TR');


$product = new Product();
$product->setCode('PR1')
	->setName('The Product')
	->setQuantiy(1)
	->setPrice(10);

/** @var $request \Payu\Request\PaymentRequest */
$request = $client->createPaymentRequestBuilder()
	->setCard($card)
	->setOrder($order)
	->setBilling($billing)
	->addProduct($product)
	->build();

/** @var $response \Payu\Response\PaymentResponse */
$response = $client->makePayment($request);
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

Alternatif olarak kurucu metodları kullanarak ödeme işlemini gerçekleştirebilirsiniz.

```php
use Payu\Client;
use Payu\Configuration;

$configuration = new Configuration();

$configuration->setMerchantId('MY_MERCHANT_01')
    ->setSecretKey('SECRET_KEY')
    ->setPaymentEndpointUrl('https://secure.payu.com.tr/order/alu/v3');

$client = new Client($configuration);

/** @var $request \Payu\Request\PaymentRequest */
$request = $client->createPaymentRequestBuilder()
	->buildCard('4282209027132016', '123', 5, 2019)
	->buildOrder('ORDERNO123456', '127.0.0.1', 3)
	->buildBilling('John', 'Smith', 'test@test.net', '05321231212')
	->buildAndAddProduct('The Product', 'PR1', 1, 10)
	->build();

/** @var $response \Payu\Response\PaymentResponse */
$response = $client->makePayment($request);
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