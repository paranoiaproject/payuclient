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
    
    public function goodCurrencyProvider()
    {
        return array(
          array('TRY', 'TRY'),
          array('EUR', 'EUR'),
          array('GBP', 'GBP'),
          array('USD', 'USD'),
          // Lowercase
          array('usd', 'USD'),
          array('gbp', 'GBP'),
          array('eur', 'EUR'),
          array('try', 'TRY'),
        );
    }
}
