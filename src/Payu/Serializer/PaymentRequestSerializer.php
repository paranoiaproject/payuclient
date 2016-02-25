<?php
namespace Payu\Serializer;

class PaymentRequestSerializer extends SerializerAbstract
{
    /**
     * @return array
     */
    private function serializeOrder()
    {
        /** @var $order \Payu\Component\Order */
        $order = $this->request->getOrder();

        $data = array(
            'ORDER_REF'                    => $order->getCode(),
            'ORDER_DATE'                   => $order->getDate(),
            'PAY_METHOD'                   => $order->getPaymentMethod(),
            'PRICES_CURRENCY'              => $order->getCurrency(),
            'SELECTED_INSTALLMENTS_NUMBER' => $order->getInstallment(),
            'ORDER_TIMEOUT'                => $order->getTimeout(),
            'CLIENT_IP'                    => $order->getClientIp()
        );

        if ((float) $order->getLoyaltyAmount() != 0) {
            $data['USE_LOYALTY_POINTS'] = 'YES';
            if ((float) $order->getLoyaltyAmount() != (float) $this->request->getBasket()->getTotalPrice()) {
                $data['LOYALTY_POINTS_AMOUNT'] = (float) $order->getLoyaltyAmount();
            }
        }

        if ($order->isRecurringPayment() === true) {
            $data['LU_ENABLE_TOKEN'] = 1;
        }

        return $data;
    }

    /**
     * @return array
     */
    private function serializeBilling()
    {
        /** @var $billing  \Payu\Component\Billing */
        $billing = $this->request->getBilling();

        return array(
            'BILL_LNAME'       => $billing->getLastName(),
            'BILL_FNAME'       => $billing->getFirstName(),
            'BILL_EMAIL'       => $billing->getEmail(),
            'BILL_PHONE'       => $billing->getPhone(),
            'BILL_COUNTRYCODE' => $billing->getCountryCode(),
            'BILL_FAX'         => $billing->getFax(),
            'BILL_ADDRESS'     => $billing->getAddress(),
            'BILL_ZIPCODE'     => $billing->getZipCode(),
            'BILL_CITY'        => $billing->getCity(),
            'BILL_STATE'       => $billing->getState()
        );
    }

    /**
     * @return array
     */
    private function serializeDelivery()
    {
        /** @var $delivery \Payu\Component\Delivery */
        $delivery = $this->request->getDelivery();
        if (!$delivery) {
            return array();
        }

        return array(
            'DELIVERY_FNAME'       => $delivery->getFirstName(),
            'DELIVERY_LNAME'       => $delivery->getLastName(),
            'DELIVERY_EMAIL'       => $delivery->getEmail(),
            'DELIVERY_PHONE'       => $delivery->getPhone(),
            'DELIVERY_COMPANY'     => $delivery->getCompany(),
            'DELIVERY_ADDRESS'     => $delivery->getAddress(),
            'DELIVERY_ZIPCODE'     => $delivery->getZipCode(),
            'DELIVERY_CITY'        => $delivery->getCity(),
            'DELIVERY_STATE'       => $delivery->getState(),
            'DELIVERY_COUNTRYCODE' => $delivery->getCountryCode()
        );
    }

    /**
     * @return array
     */
    private function serializeBasket()
    {
        $i    = 0;
        $data = array();
        /** @var $product \Payu\Component\Product */
        foreach ($this->request->getBasket() as $product) {
            $data['ORDER_PNAME[' . $i . ']'] = $product->getName();
            $data['ORDER_PCODE[' . $i . ']'] = $product->getCode();
            $data['ORDER_PRICE[' . $i . ']'] = $product->getPrice();
            $data['ORDER_QTY[' . $i . ']']   = $product->getQuantity();
            $data['ORDER_PINFO[' . $i . ']'] = $product->getInfo();
            $data['ORDER_VER[' . $i . ']']   = $product->getVersion();
            $data['ORDER_VAT[' . $i . ']']   = $product->getVat();
            $data['ORDER_PRICE_TYPE[' . $i . ']']   = $product->getPriceType();
            $i++;
        }

        return $data;
    }

    /**
     * @return serialize
     */
    public function serialize()
    {
        $concatenatedData = array_merge(
            $this->serializeCard(),
            $this->serializeOrder(),
            $this->serializeBilling(),
            $this->serializeDelivery(),
            $this->serializeBasket()
        );

        $filteredData               = array_filter($concatenatedData);
        $filteredData['MERCHANT']   = $this->configuration->getMerchantId();
        $filteredData['ORDER_HASH'] = $this->calculateHash($filteredData);

        return $filteredData;
    }
}
