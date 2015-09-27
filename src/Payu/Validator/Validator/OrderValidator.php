<?php
namespace Payu\Validator\Validator;

use Payu\Component\Order;
use Payu\Exception\ValidationError;

class OrderValidator extends ValidatorAbstract
{
    /**
     * @return void
     * @throws \Payu\Exception\ValidationError
     */
    public function validate()
    {
        parent::validate();

        /**
         * @var $object \Payu\Component\Order
         */
        $object = $this->request->getOrder();

        // Get currency from order instance
        try {
            static::filterAndValidateCurrencyCode($object->getCurrency());
        } catch (\Exception $e) {
            throw new ValidationError($e->getMessage());
        }
    }

    /**
     * @return void
     * @throws \Payu\Exception\ValidationError
     */
    protected function validateObject()
    {
        /**
         * @var $object \Payu\Component\Order
         */
        $object = $this->request->getOrder();

        if (!$object || !$object instanceof Order) {
            throw new ValidationError('Order does not be empty.');
        }
    }

    /**
     * Filters and validates given currency code.
     *
     * @param  string $code Currency code to filter and validate.
     * @throws \InvalidArgumentException
     * @return string Three letter currency code.
     */
    public static function filterAndValidateCurrencyCode($code)
    {
        $code = strtoupper(preg_replace('/[^a-zA-Z]/', '', $code));

        if (array_key_exists($code, static::getAvailableCurrencies()) === false) {
            throw new \InvalidArgumentException('Currency code "'.$code.'" is not a valid ISO 4217 symbol');
        }

        return $code;
    }

    /**
     * Returns official list of ISO 4217 currency codes.
     *
     * @link http://www.iso.org/iso/home/standards/currency_codes.htm
     *
     * @return array
     */
    public static function getAvailableCurrencies()
    {
        return array(
          'AFN' => 'Afghani',
          'EUR' => 'Euro',
          'ALL' => 'Lek',
          'DZD' => 'Algerian Dinar',
          'USD' => 'US Dollar',
          'AOA' => 'Kwanza',
          'XCD' => 'East Caribbean Dollar',
          'ARS' => 'Argentine Peso',
          'AMD' => 'Armenian Dram',
          'AWG' => 'Aruban Florin',
          'AUD' => 'Australian Dollar',
          'AZN' => 'Azerbaijanian Manat',
          'BSD' => 'Bahamian Dollar',
          'BHD' => 'Bahraini Dinar',
          'BDT' => 'Taka',
          'BBD' => 'Barbados Dollar',
          'BYR' => 'Belarussian Ruble',
          'BZD' => 'Belize Dollar',
          'XOF' => 'CFA Franc BCEAO',
          'BMD' => 'Bermudian Dollar',
          'BTN' => 'Ngultrum',
          'INR' => 'Indian Rupee',
          'BOB' => 'Boliviano',
          'BOV' => 'Mvdol',
          'BAM' => 'Convertible Mark',
          'BWP' => 'Pula',
          'NOK' => 'Norwegian Krone',
          'BRL' => 'Brazilian Real',
          'BND' => 'Brunei Dollar',
          'BGN' => 'Bulgarian Lev',
          'BIF' => 'Burundi Franc',
          'CVE' => 'Cabo Verde Escudo',
          'KHR' => 'Riel',
          'XAF' => 'CFA Franc BEAC',
          'CAD' => 'Canadian Dollar',
          'KYD' => 'Cayman Islands Dollar',
          'CLF' => 'Unidad de Fomento',
          'CLP' => 'Chilean Peso',
          'CNY' => 'Yuan Renminbi',
          'COP' => 'Colombian Peso',
          'COU' => 'Unidad de Valor Real',
          'KMF' => 'Comoro Franc',
          'CDF' => 'Congolese Franc',
          'NZD' => 'New Zealand Dollar',
          'CRC' => 'Costa Rican Colon',
          'HRK' => 'Kuna',
          'CUC' => 'Peso Convertible',
          'CUP' => 'Cuban Peso',
          'ANG' => 'Netherlands Antillean Guilder',
          'CZK' => 'Czech Koruna',
          'DKK' => 'Danish Krone',
          'DJF' => 'Djibouti Franc',
          'DOP' => 'Dominican Peso',
          'EGP' => 'Egyptian Pound',
          'SVC' => 'El Salvador Colon',
          'ERN' => 'Nakfa',
          'ETB' => 'Ethiopian Birr',
          'FKP' => 'Falkland Islands Pound',
          'FJD' => 'Fiji Dollar',
          'XPF' => 'CFP Franc',
          'GMD' => 'Dalasi',
          'GEL' => 'Lari',
          'GHS' => 'Ghana Cedi',
          'GIP' => 'Gibraltar Pound',
          'GTQ' => 'Quetzal',
          'GBP' => 'Pound Sterling',
          'GNF' => 'Guinea Franc',
          'GYD' => 'Guyana Dollar',
          'HTG' => 'Gourde',
          'HNL' => 'Lempira',
          'HKD' => 'Hong Kong Dollar',
          'HUF' => 'Forint',
          'ISK' => 'Iceland Krona',
          'IDR' => 'Rupiah',
          'XDR' => 'SDR Special Drawing Right',
          'IRR' => 'Iranian Rial',
          'IQD' => 'Iraqi Dinar',
          'ILS' => 'New Israeli Sheqel',
          'JMD' => 'Jamaican Dollar',
          'JPY' => 'Yen',
          'JOD' => 'Jordanian Dinar',
          'KZT' => 'Tenge',
          'KES' => 'Kenyan Shilling',
          'KPW' => 'North Korean Won',
          'KRW' => 'Won',
          'KWD' => 'Kuwaiti Dinar',
          'KGS' => 'Som',
          'LAK' => 'Kip',
          'LBP' => 'Lebanese Pound',
          'LSL' => 'Loti',
          'ZAR' => 'Rand',
          'LRD' => 'Liberian Dollar',
          'LYD' => 'Libyan Dinar',
          'CHF' => 'Swiss Franc',
          'MOP' => 'Pataca',
          'MKD' => 'Denar',
          'MGA' => 'Malagasy Ariary',
          'MWK' => 'Kwacha',
          'MYR' => 'Malaysian Ringgit',
          'MVR' => 'Rufiyaa',
          'MRO' => 'Ouguiya',
          'MUR' => 'Mauritius Rupee',
          'XUA' => 'ADB Unit of Account',
          'MXN' => 'Mexican Peso',
          'MXV' => 'Mexican Unidad de Inversion UDI',
          'MDL' => 'Moldovan Leu',
          'MNT' => 'Tugrik',
          'MAD' => 'Moroccan Dirham',
          'MZN' => 'Mozambique Metical',
          'MMK' => 'Kyat',
          'NAD' => 'Namibia Dollar',
          'NPR' => 'Nepalese Rupee',
          'NIO' => 'Cordoba Oro',
          'NGN' => 'Naira',
          'OMR' => 'Rial Omani',
          'PKR' => 'Pakistan Rupee',
          'PAB' => 'Balboa',
          'PGK' => 'Kina',
          'PYG' => 'Guarani',
          'PEN' => 'Nuevo Sol',
          'PHP' => 'Philippine Peso',
          'PLN' => 'Zloty',
          'QAR' => 'Qatari Rial',
          'RON' => 'Romanian Leu',
          'RUB' => 'Russian Ruble',
          'RWF' => 'Rwanda Franc',
          'SHP' => 'Saint Helena Pound',
          'WST' => 'Tala',
          'STD' => 'Dobra',
          'SAR' => 'Saudi Riyal',
          'RSD' => 'Serbian Dinar',
          'SCR' => 'Seychelles Rupee',
          'SLL' => 'Leone',
          'SGD' => 'Singapore Dollar',
          'XSU' => 'Sucre',
          'SBD' => 'Solomon Islands Dollar',
          'SOS' => 'Somali Shilling',
          'SSP' => 'South Sudanese Pound',
          'LKR' => 'Sri Lanka Rupee',
          'SDG' => 'Sudanese Pound',
          'SRD' => 'Surinam Dollar',
          'SZL' => 'Lilangeni',
          'SEK' => 'Swedish Krona',
          'CHE' => 'WIR Euro',
          'CHW' => 'WIR Franc',
          'SYP' => 'Syrian Pound',
          'TWD' => 'New Taiwan Dollar',
          'TJS' => 'Somoni',
          'TZS' => 'Tanzanian Shilling',
          'THB' => 'Baht',
          'TOP' => 'Paanga',
          'TTD' => 'Trinidad and Tobago Dollar',
          'TND' => 'Tunisian Dinar',
          'TRY' => 'Turkish Lira',
          'TMT' => 'Turkmenistan New Manat',
          'UGX' => 'Uganda Shilling',
          'UAH' => 'Hryvnia',
          'AED' => 'UAE Dirham',
          'USN' => 'US Dollar Next day',
          'UYI' => 'Uruguay Peso en Unidades Indexadas URUIURUI',
          'UYU' => 'Peso Uruguayo',
          'UZS' => 'Uzbekistan Sum',
          'VUV' => 'Vatu',
          'VEF' => 'Bolivar',
          'VND' => 'Dong',
          'YER' => 'Yemeni Rial',
          'ZMW' => 'Zambian Kwacha',
          'ZWL' => 'Zimbabwe Dollar',
          'XBA' => 'Bond Markets Unit European Composite Unit EURCO',
          'XBB' => 'Bond Markets Unit European Monetary Unit EMU6',
          'XBC' => 'Bond Markets Unit European Unit of Account 9 EUA9',
          'XBD' => 'Bond Markets Unit European Unit of Account 17 EUA17',
          'XTS' => 'Codes specifically reserved for testing purposes',
          'XAU' => 'Gold',
          'XPD' => 'Palladium',
          'XPT' => 'Platinum',
          'XAG' => 'Silver',
        );
    }
}
