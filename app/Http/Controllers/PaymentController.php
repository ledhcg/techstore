<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatusEnum;
use App\Enums\PaymentStatusEnum;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\ShippingFee;
use App\Service\PaymentService;
use App\Http\Controllers\CartController;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use YooKassa\Model\Notification\NotificationSucceeded;
use YooKassa\Model\Notification\NotificationWaitingForCapture;
use YooKassa\Model\NotificationEventType;

class PaymentController extends Controller
{
    public function index(){
        $dataProducts = Product::all();
        $dataCategories = Category::all();
        $dataShippingFee = ShippingFee::find(1);
        $dataPaymentMethods = PaymentMethod::all();
        $orders = Order::all();
        $urlPhoto = asset("data/images/upload/products/");
        return view('main.payment_test', [
            'dataProducts' => $dataProducts,
            'dataCategories'=>$dataCategories,
            'urlPhoto' => $urlPhoto,
            'page' => 'CARTDETAILS',
            'dataShippingFee' =>  $dataShippingFee,
            'dataPaymentMethods' => $dataPaymentMethods,
            'orders' => $orders,
        ]);
    }

    /**
     * @param Request $request
     * @param PaymentService $paymentService
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
    public function create(Request $request, PaymentService $paymentService){
        $amount = (float)$request->input('amount');
        $description = $request->input('description');

        $order = Order::create([
            'user_id' => Auth::user()->id,
            'client_name' => $request->input('client_name'),
            'client_email' => $request->input('client_email'),
            'client_address' => $request->input('client_address'),
            'client_phone' => $request->input('client_phone'),
            'order_note' => $request->input('order_note'),
            'order_ship' => $request->input('order_ship'),
            'order_discount' => $request->input('order_discount'),
            'order_payment' => $request->input('order_payment'),
            'order_payment_status' => PaymentStatusEnum::CREATED,
            'order_tracking' => $request->input('order_tracking'),
            'order_status' => OrderStatusEnum::CREATED,
            'order_total' => $amount,
            'order_description' => $description,
        ]);

        if($order){
            foreach(Cart::instance('cart')->content() as $cartItem) {
                $orderDetail = OrderDetail::create([
                    'order_id' => $request->input('order_tracking'),
                    'product_id' => $cartItem->id,
                    'product_price' => $cartItem->price,
                    'product_quantity' => $cartItem->qty,
                ]);
            }
            $link = $paymentService->createPayment($amount, $description, [
                'user_id' => Auth::user()->id,
                'client_name' => $request->input('client_name'),
                'client_email' => $request->input('client_email'),
                'client_address' => $request->input('client_address'),
                'client_phone' => $request->input('client_phone'),
                'order_note' => $request->input('order_note'),
                'order_ship' => $request->input('order_ship'),
                'order_discount' => $request->input('order_discount'),
                'order_payment' => $request->input('order_payment'),
                'order_tracking' => $request->input('order_tracking'),
            ]);

            $orderController = new OrderController();
            $orderController->destroyCheckout();
            $cartController = new CartController();
            $cartController->destroyCart();
            return redirect()->away($link);
        }

//        $link = $paymentService->createPayment($amount, $description, [
//            'user_id' => Auth::user()->id,
//            'client_name' => $request->input('client_name'),
//            'client_email' => $request->input('client_email'),
//            'client_address' => $request->input('client_address'),
//            'client_phone' => $request->input('client_phone'),
//            'order_note' => $request->input('order_note'),
//            'order_ship' => $request->input('order_ship'),
//            'order_discount' => $request->input('order_discount'),
//            'order_payment' => $request->input('order_payment'),
//            'order_tracking' => $request->input('order_tracking'),
//        ]);
//        return redirect()->away($link);
    }

    public function callback(Request $request, PaymentService $paymentService){
        $source = file_get_contents('php://input');
        $requestBody = json_decode($source, true);
        \Log::info($source);
        $notification = (isset($requestBody['event']) && $requestBody['event'] === NotificationEventType::PAYMENT_SUCCEEDED)
            ? new NotificationSucceeded($requestBody)
            : new NotificationWaitingForCapture($requestBody);
        $payment = $notification->getObject();
        \Log::info(json_encode( $payment));

        if(isset($payment->status) && $payment->status === 'waiting_for_capture'){
            $paymentService->getClient()->capturePayment([
               'amount' =>  $payment->amount,
            ], $payment->id, uniqid('', true));
        }
        if(isset($payment->status) && $payment->status === 'succeeded'){
            if((bool)$payment->paid === true){
                $order = Order::where('order_tracking', $payment->metadata->order_tracking)->first();
                $order->order_payment_status = PaymentStatusEnum::SUCCEEDED;
                $order->save();
                //\Log::info($payment->metadata->user_id);
//                $order = Order::create([
//                    'user_id' => $payment->metadata->user_id,
//                    'client_name' => $payment->metadata->client_name,
//                    'client_email' => $payment->metadata->client_email,
//                    'client_phone' => $payment->metadata->client_phone,
//                    'client_address' => $payment->metadata->client_address,
//                    'order_status' => 1,
//                    'order_note' => $payment->metadata->order_note,
//                    'order_total' => $payment->amount->value,
//                    'order_discount' => $payment->metadata->order_discount,
//                    'order_payment' => $payment->metadata->order_payment,
//                    'order_ship' => $payment->metadata->order_ship,
//                    'order_tracking' => $payment->metadata->order_tracking,
//                    'order_description' => $payment->description,
//                ]);

//                if($order){
//                    foreach($payment->metadata->dataCart as $cartItem) {
//                        $orderDetail = OrderDetail::create([
//                            'order_id' => $payment->metadata->order_tracking,
//                            'product_id' => $cartItem->id,
//                            'product_price' => $cartItem->price,
//                            'product_quantity' => $cartItem->qty,
//                        ]);
//                    }
//                }
            }
        }


    }
}
