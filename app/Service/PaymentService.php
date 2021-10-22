<?php

namespace App\Service;

use YooKassa\Client;
use Gloudemans\Shoppingcart\Facades\Cart;


class PaymentService{
    public function getClient(){
        $client = new Client();
        $client->setAuth(config('services.yookassa.shop_id'), config('services.yookassa.secret_key'));
        return $client;
    }

    /**
     * @param float $amount
     * @param string $description
     * @param array $options
     * @return string
     * @throws \YooKassa\Common\Exceptions\ApiException
     * @throws \YooKassa\Common\Exceptions\BadApiRequestException
     * @throws \YooKassa\Common\Exceptions\ExtensionNotFoundException
     * @throws \YooKassa\Common\Exceptions\ForbiddenException
     * @throws \YooKassa\Common\Exceptions\InternalServerError
     * @throws \YooKassa\Common\Exceptions\NotFoundException
     * @throws \YooKassa\Common\Exceptions\ResponseProcessingException
     * @throws \YooKassa\Common\Exceptions\TooManyRequestsException
     * @throws \YooKassa\Common\Exceptions\UnauthorizedException
     */
    public function createPayment(float $amount, string $description, array $options = []){
        $client = $this->getClient();
        $return_url = route('user.checkoutComplete', ['orderTracking'=>$options['order_tracking']]);
        //\Log::info(Cart::instance('cart')->content());
        $payment = $client->createPayment(
            array(
                'amount' => array(
                    'value' => $amount,
                    'currency' => 'RUB',
                ),
                'confirmation' => array(
                    'type' => 'redirect',
                    'return_url' => $return_url,
                ),
                'metadata' => [
                    'user_id' => $options['user_id'],
                    'client_name' => $options['client_name'],
                    'client_email' => $options['client_email'],
                    'client_address' => $options['client_address'],
                    'client_phone' => $options['client_phone'],
                    'order_note' => $options['order_note'],
                    'order_ship' => $options['order_ship'],
                    'order_discount' => $options['order_discount'],
                    'order_payment' => $options['order_payment'],
                    'order_tracking' => $options['order_tracking'],
                    //'dataCart' => Cart::instance('cart')->content(),
                ],

                'capture' => false,
                'description' => $description,
            ),
            uniqid('', true)
        );
        return $payment->getConfirmation()->getConfirmationUrl();
    }
}
