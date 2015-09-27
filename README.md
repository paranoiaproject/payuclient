# PHP İçin Payu İstemcisi

# Nedir ?
PHP geliştiricilerinin Payu üzerinden ödeme ve puan sorgulama işlemlerini kolayca gerçekleştirebilmesini sağlayan bir PHP kütüphanesidir.

# Neden ?
Entegrasyon detaylarıyla uğraşmadan mevcut uygulamaya kolayca entegrasyonu sağlanarak geliştirme maliyetini düşürür.

# Nasıl ?
Payu istemci kütüphanesi composer desteklidir.  Mevcut uygulamanızın gereksinimler (requirements) alanına "ibrahimgunduz34/payuclient" bileşenini ekleyebilir veya aşağıdaki komutu çalıştırarak kurulumu gerçekleştirebilirsiniz.

```shell
$ composer require ibrahimgunduz34/payuclient:dev-master
```

Entegrasyon detayları ile ilgili dökümanları [buraya tıklayarak](/docs/index.md) inceleyebilirsiniz.

# Unit Test'lerin Çalıştırılması
Unit testleri çalıştırmak için sisteminizde [PHPUnit](https://phpunit.de) kurulu olmalıdır.

PHPUnit'i çalıştırılabilir PHP Arşiv Paketi (PHAR) halinde kurmak için:

```
$ wget https://phar.phpunit.de/phpunit.phar
$ chmod +x phpunit.phar
$ mv phpunit.phar /usr/local/bin/phpunit
```

veya Mac OS X kullanıcısı iseniz [Homebrew](http://brew.sh/) yardımıyla kurmak için:

```
$ brew update
$ brew install phpunit
```

komutlarını vermeniz yeterlidir. Kurulum sonrası unit testleri çalıştırmak için aşağıdaki komutu verebilirsiniz:

```
$ cd /path/to/payuclient
$ phpunit -c tests/phpunit.xml

PHPUnit 3.7.38 by Sebastian Bergmann.
Configuration read from payuclient/tests/phpunit.xml

........................

Time: 1.58 seconds, Memory: 6.75Mb

OK (24 tests, 27 assertions)
```

---

Katkıda bulunan geliştiriciler için [buraya tıklayınız](/docs/contributors.md)
