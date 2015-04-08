# Taksitli Satış İşlemi

Taksitli satış işlemi, peşin satış işleminden farklı olarak, istek nesnesinin yaratılması sırasında sipariş bölümü oluşturulurken taksit bilgisinin eklenmesi ile gerçekleştirilir.


```php
...
->buildOrder('ORDERNO123456', '127.0.0.1', 3)
...
```

veya

```php
$order = new Order();
$order->setInstallment(3)
    ...
```

Peşin satış işlemini incelemek için [buraya tıklayınız.](/docs/pesin_satis.md)