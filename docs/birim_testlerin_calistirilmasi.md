# Birim Testlerin Çalıştırılması
Birim testleri çalıştırmak için sisteminizde [PHPUnit](https://phpunit.de) kurulu olmalıdır.

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
