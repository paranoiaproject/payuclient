<?php
/**
 * Currency test
 */
namespace Payu\Test;

use Payu\Component\Currency;

class CurrencyTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider goodCurrencyProvider
     */
    public function testGoodCurrencyCodeWorks($code, $expected)
    {
        $cur = (string) new Currency($code);
        $this->assertEquals($cur, $expected);
    }

    /**
     * @dataProvider badCurrencyProvider
     * @expectedException InvalidArgumentException
     */
    public function testInvalidCurrencyCodeShouldThrowException($code)
    {
        $cur = new Currency();
        $cur->setCode($code);
    }

    public function testCurrencyNameBehavior()
    {
        $code = 'TRY';
        $label = 'Turkish Lira';

        $this->assertEquals($label, Currency::getNameByCode($code));
    }

    public function badCurrencyProvider()
    {
        return [
            ['trl'],
            ['false'],
            [true],
            [-1],
            ['Euro'],
            ['XXX'],
        ];
    }

    public function goodCurrencyProvider()
    {
        return array(
          array('TRY', 'TRY'),
          array('EUR', 'EUR'),
          array('GBP', 'GBP'),
          array('USD', 'USD'),
          array('usd', 'USD'),
          array('gbp', 'GBP'),
          array('eur', 'EUR'),
          array('try', 'TRY'),
        );
    }
}
