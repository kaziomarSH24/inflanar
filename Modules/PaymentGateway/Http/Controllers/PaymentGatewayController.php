<?php

namespace Modules\PaymentGateway\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Product;

use Exception;
use Redirect;
use Carbon\Carbon;
use Session;
use Luigel\Paymongo\Facades\Paymongo;
use Modules\PaymentGateway\Entities\MercadoPagoPayment;

class PaymentGatewayController extends Controller
{

    public function pay_with_paymongo($public_key, $secret_key, $webhook_sig, $payable_amount, $payable_currency, $after_success_url, $after_faild_url, $card_info){

        $success_url = route('paymongo-payment-success');
        $faild_url = route('paymongo-payment-cancled');

        config(['paymongo.public_key' => $public_key]);
        config(['paymongo.secret_key' => $secret_key]);
        config(['paymongo.webhook_signatures.payment_paid' => $webhook_sig]);
        config(['paymongo.webhook_signatures.payment_failed' => $webhook_sig]);
        config(['paymongo.webhook_signatures.source_chargeable' => $webhook_sig]);
        config(['paymongo.webhook_signatures.payment_refunded' => $webhook_sig]);
        config(['paymongo.webhook_signatures.payment_refund_updated' => $webhook_sig]);


        // create payment method
         try{
            $paymentMethod = Paymongo::paymentMethod()->create([
                'type' => 'card',
                'details' => [
                    'card_number' => $card_info['card_number'],
                    'exp_month' => $card_info['month'],
                    'exp_year' => $card_info['year'],
                    'cvc' => $card_info['cvc'],
                ]
            ]);

        }catch (Exception $e) {
            $after_faild_url = Session::get('after_faild_url');
            return redirect($after_faild_url);
        }

        $payment_method_id = $paymentMethod->id;

        $paymentIntent = Paymongo::paymentIntent()->create([
            'amount' => $payable_amount,
            'payment_method_allowed' => [
                'card'
            ],
            'payment_method_options' => [
                'card' => [
                    'request_three_d_secure' => 'automatic'
                ]
            ],
            'description' => env('APP_NAME'),
            'statement_descriptor' => env('APP_NAME'),
            'currency' => $payable_currency,
        ]);

        $payment_intent_id = $paymentIntent->id;
        Session::put('paymentIntentId', $payment_intent_id);
        Session::save();

        $code = base64_encode($secret_key);
        require_once('vendor/autoload.php');
        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', 'https://api.paymongo.com/v1/payment_intents/'.$payment_intent_id.'/attach', [
        'body' => '{"data":{"attributes":{"payment_method":"'.$payment_method_id.'","return_url":"'.route('paymongo-verify').'"}}}',
        'headers' => [
            'Accept' => 'application/json',
            'Authorization' => 'Basic '.$code.'',
            'Content-Type' => 'application/json',
        ],
        ]);

        $response = json_decode($response->getBody(), true);

        if($response['data']['attributes']['status'] == 'succeeded'){

            session()->put('after_success_url', $after_success_url);
            session()->put('after_faild_url', $after_faild_url);
            session()->put('payable_amount', $payable_amount);
            session()->put('payable_currency', $payable_currency);
            session()->put('public_key', $public_key);
            session()->put('secret_key', $secret_key);
            session()->put('webhook_sig', $webhook_sig);
            Session::put('after_success_gateway', 'Paymongo');
            Session::put('after_success_transaction', $response['data']['id']);

            return redirect($after_success_url);

        }elseif($response['data']['attributes']['status'] == 'awaiting_next_action'){

            session()->put('after_success_url', $after_success_url);
            session()->put('after_faild_url', $after_faild_url);
            session()->put('payable_amount', $payable_amount);
            session()->put('payable_currency', $payable_currency);
            session()->put('public_key', $public_key);
            session()->put('secret_key', $secret_key);
            session()->put('webhook_sig', $webhook_sig);
            Session::put('after_success_gateway', 'Paymongo');

            $checkout_url = $response['data']['attributes']['next_action']['redirect']['url'];
            return redirect()->to($checkout_url);

        }else{
            $after_faild_url = Session::get('after_faild_url');
            return redirect($after_faild_url);
        }
    }


    public function paymongo_verify(Request $request){

        $payable_amount = Session::get('payable_amount');
        $payable_currency = Session::get('payable_currency');
        $after_success_url = Session::get('after_success_url');
        $after_faild_url = Session::get('after_faild_url');
        $public_key = Session::get('public_key');
        $secret_key = Session::get('secret_key');
        $webhook_sig = Session::get('webhook_sig');

        config(['paymongo.public_key' => $public_key]);
        config(['paymongo.secret_key' => $secret_key]);
        config(['paymongo.webhook_signatures.payment_paid' => $webhook_sig]);
        config(['paymongo.webhook_signatures.payment_failed' => $webhook_sig]);
        config(['paymongo.webhook_signatures.source_chargeable' => $webhook_sig]);
        config(['paymongo.webhook_signatures.payment_refunded' => $webhook_sig]);
        config(['paymongo.webhook_signatures.payment_refund_updated' => $webhook_sig]);

        require_once('vendor/autoload.php');
        $client = new \GuzzleHttp\Client();
        $paymentIntentId = Session::get('paymentIntentId');
        $code = base64_encode($secret_key);

        $response = $client->request('GET', 'https://api.paymongo.com/v1/payment_intents/'.$paymentIntentId, [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Basic '.$code.'',
            ],
        ]);

        $response = json_decode($response->getBody(), true);

        if($response['data']['attributes']['status'] == 'succeeded'){

            Session::put('after_success_transaction', $response['data']['id']);

            return redirect($after_success_url);

        }else{
            return redirect($after_faild_url);
        }


    }

    public function pay_with_grabpay($public_key, $secret_key, $webhook_sig, $payable_amount, $payable_currency, $after_success_url, $after_faild_url){

        config(['paymongo.public_key' => $public_key]);
        config(['paymongo.secret_key' => $secret_key]);
        config(['paymongo.webhook_signatures.payment_paid' => $webhook_sig]);
        config(['paymongo.webhook_signatures.payment_failed' => $webhook_sig]);
        config(['paymongo.webhook_signatures.source_chargeable' => $webhook_sig]);
        config(['paymongo.webhook_signatures.payment_refunded' => $webhook_sig]);
        config(['paymongo.webhook_signatures.payment_refund_updated' => $webhook_sig]);


        $gcashSource = Paymongo::source()->create([
            'type' => 'grab_pay',
            'amount' => $payable_amount,
            'currency' => $payable_currency,
            'redirect' => [
                'success' => route('paymongo-payment-success'),
                'failed' => route('paymongo-payment-cancled')
            ]
        ]);

        $gcashSourceId = $gcashSource->id;
        session()->put('gcashSourceId', $gcashSourceId);
        session()->put('payableAmount', $payable_amount);

        session()->put('after_success_url', $after_success_url);
        session()->put('after_faild_url', $after_faild_url);
        session()->put('payable_amount', $payable_amount);
        session()->put('payable_currency', $payable_currency);
        session()->put('public_key', $public_key);
        session()->put('secret_key', $secret_key);
        session()->put('webhook_sig', $webhook_sig);
        Session::put('after_success_gateway', 'Grab Pay');

        return redirect($gcashSource->redirect['checkout_url']);
    }


    public function pay_with_gcash($public_key, $secret_key, $webhook_sig, $payable_amount, $payable_currency, $after_success_url, $after_faild_url){

        config(['paymongo.public_key' => $public_key]);
        config(['paymongo.secret_key' => $secret_key]);
        config(['paymongo.webhook_signatures.payment_paid' => $webhook_sig]);
        config(['paymongo.webhook_signatures.payment_failed' => $webhook_sig]);
        config(['paymongo.webhook_signatures.source_chargeable' => $webhook_sig]);
        config(['paymongo.webhook_signatures.payment_refunded' => $webhook_sig]);
        config(['paymongo.webhook_signatures.payment_refund_updated' => $webhook_sig]);


        $gcashSource = Paymongo::source()->create([
            'type' => 'gcash',
            'amount' => $payable_amount,
            'currency' => $payable_currency,
            'redirect' => [
                'success' => route('paymongo-payment-success'),
                'failed' => route('paymongo-payment-cancled')
            ]
        ]);

        $gcashSourceId = $gcashSource->id;
        session()->put('gcashSourceId', $gcashSourceId);
        session()->put('payableAmount', $payable_amount);

        session()->put('after_success_url', $after_success_url);
        session()->put('after_faild_url', $after_faild_url);
        session()->put('payable_amount', $payable_amount);
        session()->put('payable_currency', $payable_currency);
        session()->put('public_key', $public_key);
        session()->put('secret_key', $secret_key);
        session()->put('webhook_sig', $webhook_sig);
        Session::put('after_success_gateway', 'GCash');

        return redirect($gcashSource->redirect['checkout_url']);
    }

    public function paymongo_payment_success(Request $request){

        $payable_amount = Session::get('payable_amount');
        $payable_currency = Session::get('payable_currency');
        $after_success_url = Session::get('after_success_url');
        $after_faild_url = Session::get('after_faild_url');
        $public_key = Session::get('public_key');
        $secret_key = Session::get('secret_key');
        $webhook_sig = Session::get('webhook_sig');

        $gcashSourceId = Session::get('gcashSourceId');
        $payableAmount = Session::get('payableAmount');
        Session::forget('gcashSourceId');
        Session::forget('payableAmount');

        config(['paymongo.public_key' => $public_key]);
        config(['paymongo.secret_key' => $secret_key]);
        config(['paymongo.webhook_signatures.payment_paid' => $webhook_sig]);
        config(['paymongo.webhook_signatures.payment_failed' => $webhook_sig]);
        config(['paymongo.webhook_signatures.source_chargeable' => $webhook_sig]);
        config(['paymongo.webhook_signatures.payment_refunded' => $webhook_sig]);
        config(['paymongo.webhook_signatures.payment_refund_updated' => $webhook_sig]);

        try{
            $payment = Paymongo::payment()
            ->create([
                'amount' => $payable_amount,
                'currency' => $payable_currency,
                'description' => env('APP_NAME'),
                'statement_descriptor' => env('APP_NAME'),
                'source' => [
                    'id' => $gcashSourceId,
                    'type' => 'source'
                ]
            ]);

            Session::put('after_success_transaction', $payment->id);

            return redirect($after_success_url);

        }catch(Exception $e){

            return redirect($after_faild_url);
        }
    }

    public function paymongo_payment_cancled(Request $request){
        $after_faild_url = Session::get('after_faild_url');
        return redirect($after_faild_url);
    }

    public function pay_with_iyzico(Request $client_request, $iyzipay_api_key, $iyzipay_secret_key, $iyzipay_account_mode, $payable_amount, $payable_currency, $after_success_url, $after_faild_url, $user, $custom_items){

        $name = $user->name;
        $email = $user->email;
        $phone = $user->phone ? $user->phone : '1234569877';
        $address = $user->address ? $user->address : 'test address';
        $country = $user->country ? $user->country : 'test country';
        $city = $user->city ? $user->city : 'test ciy';

        $options = new \Iyzipay\Options();
        $options->setApiKey($iyzipay_api_key);
        $options->setSecretKey($iyzipay_secret_key);
        if($iyzipay_account_mode == 'Sandbox'){
            $options->setBaseUrl("https://sandbox-api.iyzipay.com");
        }else{
            $options->setBaseUrl("https://api.iyzipay.com");
        }

        $request = new \Iyzipay\Request\CreatePaymentRequest();
        $request->setLocale(\Iyzipay\Model\Locale::TR);
        $request->setConversationId("123456789");
        $request->setPrice($payable_amount);
        $request->setPaidPrice($payable_amount);
        $request->setCurrency(\Iyzipay\Model\Currency::TL);
        $request->setInstallment(1);
        $request->setBasketId(rand ( 10000 , 99999));
        $request->setPaymentChannel(\Iyzipay\Model\PaymentChannel::WEB);
        $request->setPaymentGroup(\Iyzipay\Model\PaymentGroup::PRODUCT);

        try{
            $expiry = explode(' / ', $client_request->expiry);

            $holder_name = $client_request->holder_name;
            $card_digit = str_replace(' ', '', $client_request->card_digit);
            $month = $expiry[0];
            $year = $expiry[1];
            $cvc = $client_request->cvc;

            $paymentCard = new \Iyzipay\Model\PaymentCard();
            $paymentCard->setCardHolderName($holder_name);
            $paymentCard->setCardNumber($card_digit);
            $paymentCard->setExpireMonth($month);
            $paymentCard->setExpireYear($year);
            $paymentCard->setCvc($cvc);
            $paymentCard->setRegisterCard(0);
            $request->setPaymentCard($paymentCard);

        }catch (Exception $e) {

            $notification= trans('user_validation.Please provide valid card information');
            $notification=array('messege'=>$notification,'alert-type'=>'error');

            return redirect()->back()->with($notification);
        }

        $buyer = new \Iyzipay\Model\Buyer();
        $buyer->setId("BY789");
        $buyer->setName($name);
        $buyer->setSurname($name);
        $buyer->setGsmNumber($phone);
        $buyer->setEmail($email);
        $buyer->setIdentityNumber("74300864791");
        $buyer->setRegistrationAddress($address);
        $buyer->setCity($city);
        $buyer->setCountry($country);
        $request->setBuyer($buyer);

        $shippingAddress = new \Iyzipay\Model\Address();
        $shippingAddress->setContactName($name);
        $shippingAddress->setCity($city);
        $shippingAddress->setCountry($country);
        $shippingAddress->setAddress($address);
        $shippingAddress->setZipCode("34742");
        $request->setShippingAddress($shippingAddress);

        $billingAddress = new \Iyzipay\Model\Address();
        $billingAddress->setContactName($name);
        $billingAddress->setCity($city);
        $billingAddress->setCountry($country);
        $billingAddress->setAddress($address);
        $request->setBillingAddress($billingAddress);

        $basketItems = array();

        foreach($custom_items as $index => $custom_item){
            $firstBasketItem = new \Iyzipay\Model\BasketItem();
            $random_id = rand ( 1000 , 9999).$index;
            $firstBasketItem->setId($random_id);
            $firstBasketItem->setName($custom_item->name);
            $firstBasketItem->setCategory1($custom_item->category);
            $firstBasketItem->setItemType(\Iyzipay\Model\BasketItemType::PHYSICAL);
            $firstBasketItem->setPrice($custom_item->price);
            $basketItems[] = $firstBasketItem;
        }

        $request->setBasketItems($basketItems);
        $payment = \Iyzipay\Model\Payment::create($request, $options);
        if($payment->getStatus() == 'success'){

            session()->put('after_success_url', $after_success_url);
            session()->put('after_faild_url', $after_faild_url);
            session()->put('payable_amount', $payable_amount);
            session()->put('payable_currency', $payable_currency);
            Session::put('after_success_gateway', 'Iyzico');
            Session::put('after_success_transaction', $payment->getPaymentId());

            return redirect($after_success_url);
        }else{
            return redirect($after_faild_url);
        }
    }

    public function pay_with_mercadopago(Request $request, $public_key, $access_token, $payable_amount, $payable_currency, $after_success_url, $after_faild_url, $user){

        require_once 'vendor/autoload.php';
        \MercadoPago\SDK::setAccessToken($access_token);

        try{
            $payment = new \MercadoPago\Payment();
            $payment->transaction_amount = $request->transaction_amount;
            $payment->token = $request->token;
            $payment->description = env('APP_NAME');
            $payment->installments = $request->installments;
            $payment->payment_method_id = $request->payment_method_id;
            $payment->payer = array(
            "email" => $request->payer['email']
            );
            $payment->save();
        }catch(Exception $ex){
            $notification = trans('user_validation.Payment Faild');
            return response()->json(['message' => $ex->getMessage()], 403);
        }

        if($payment->status == 'approved'){

            session()->put('after_success_url', $after_success_url);
            session()->put('after_faild_url', $after_faild_url);
            session()->put('payable_amount', $payable_amount);
            session()->put('payable_currency', $payable_currency);
            Session::put('after_success_gateway', 'Mercado pago');
            Session::put('after_success_transaction', $payment->id);

            $notification= trans('user_validation.Congratulations! Your order has been submited');
            return response()->json(['message' => $notification]);

        }else{
            $notification= trans('user_validation.Payment Faild');
            return response()->json(['message' => $notification], 403);
        }


    }
}
