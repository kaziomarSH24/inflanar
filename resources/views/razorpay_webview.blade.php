<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Razorpay Payment</title>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <!-- Ensure jQuery is available -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <p style="text-align: center">Please wait. Your payment is processing....</p>
    <p style="text-align: center">Do not press the browser back or forward button while you are on the payment page</p>

    <form action="{{ route('webview-razorpay-payment-verify',$slug) }}" method="POST" class="d-none">
        @csrf
        @php
            $payable_amount = $grand_total * $razorpay->currency->currency_rate;
            $payable_amount = round($payable_amount, 2);
        @endphp
        <input type="hidden" name="token" value="{{$token}}">
        <script src="https://checkout.razorpay.com/v1/checkout.js"
                data-key="{{ $razorpay->key }}"
                data-currency="{{ $razorpay->currency->currency_code }}"
                data-amount="{{ $payable_amount * 100 }}"
                data-buttontext="{{ __('admin.Pay') }} {{ $payable_amount }} {{ $razorpay->currency->currency_code }}"
                data-name="{{ $razorpay->name }}"
                data-description="{{ $razorpay->description }}"
                data-image="{{ asset($razorpay->image) }}"
                data-prefill.name=""
                data-prefill.email=""
                data-theme.color="{{ $razorpay->color }}">
        </script>
    </form>

    <script>
        $(document).ready(function() {
            $(".razorpay-payment-button").click();
        });
    </script>
</body>
</html>
