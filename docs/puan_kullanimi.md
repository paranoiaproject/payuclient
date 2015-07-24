# Puan Kullanım İşlemi
Puan ile satış işlemi (satışta puan kullanımı), normal satış işleminden farklı olarak, istek nesnesinin yaratılması sırasında sipariş bölümü oluşturulurken puan bilgisinin eklenmesi ile gerçekleşir.

```php
...
->buildOrder('ORDERNO123456', '127.0.0.1', 3, 'TRY', 10.50)
...
```

veya


```php
$order = new Order();
$order->setLoyaltyAmount(10.50)
    ...
```

Puan sorgulama işlemini incelemek için [buraya tıklayınız.](/docs/puan_sorgulama.md)

## Banka listesi ve puan ile ödeme seçenekleri

|  Banka Adı |    Puan ile Ödeme   | Nakit + Puan ile ödeme  |     Puan İadesi    |
|------------|:-------------------:|:-----------------------:|:------------------:|
|Yapı Kredi  | :heavy_check_mark:  |   :heavy_check_mark:    | :heavy_check_mark: |
|Garanti     | :heavy_check_mark:  |   :heavy_check_mark:    | :heavy_check_mark: |
|Akbank      | :heavy_check_mark:  |   :heavy_check_mark:    | :heavy_check_mark: |
|Finansbank  | :heavy_check_mark:  |   * Uygun Değil         | :heavy_check_mark: |
|İş Bankası  | :heavy_check_mark:  |   * Uygun Değil         | :heavy_check_mark: |
|Denizbank   | :heavy_check_mark:  |   * Uygun Değil         | :heavy_check_mark: |
|Halkbank    | :heavy_check_mark:  |   * Uygun Değil         | :heavy_check_mark: |
|HSBC        | :heavy_check_mark:  |   * Uygun Değil         | :heavy_check_mark: |

* Belirtilen bankaların uygulamaları sebebiyle, Nakit+Puanla Ödeme özelliği kullanılamamaktadır.

![PayU Bankalar](http://www.payu.com.tr/sites/turkey/files/pictures/bankalar2.png "PayU Bankalar")

## Kaynaklar
- [http://www.payu.com.tr/katma-degerli-servisler/puan-kullanimi](http://www.payu.com.tr/katma-degerli-servisler/puan-kullanimi)
- [https://secure.payu.com.tr/docs/loyalty-points](https://secure.payu.com.tr/docs/loyalty-points/)


