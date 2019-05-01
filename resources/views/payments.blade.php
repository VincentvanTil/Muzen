@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-12 mt-5">

      <span class="align-text-center" style="text-align:center"><h2>Payments</h2>
        <h2>____</h2>
        <br />
        <h4>Payment Methods</h4>
        <br />
        <div class="row justify-content-center">
          <div class="col-md-4">
        <i class="far fa-credit-card fa-2x"></i> <i class="fab fa-cc-visa fa-2x"></i> <i class="fab fa-cc-paypal fa-2x"></i>
        </div>
        </div>
      </span>
    </div>
  </div>
</div>

<br />

<div class="container">
  <div class="row">
    <div class="col-md-12 mt-3">

<div id="accordion">
  <div class="card">
    <div class="card-header" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Which payments methods are available?
        </button>
      </h5>
    </div>

    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
        On the MUZEN.com domain it's possible to pay with Credit card, PayPal and iDEAL.
      </div>
    </div>
  </div>
  <br />
  <div class="card">
    <div class="card-header" id="headingTwo">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          How do I pay with PayPal?
        </button>
      </h5>
    </div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
      <div class="card-body">
        When paying with PayPal, you will be redirected to the PayPal website to enter your billing information. If you’re already registered with PayPal, you can just access your existing account. Otherwise, you can register as a guest or create a new PayPal account. After you’ve successfully completed your payment via PayPal, your order will go straight into production.
        In case of an order return, the refund will always be issued to your original method of payment.
      </div>
    </div>
  </div>
  <br />
  <div class="card">
    <div class="card-header" id="headingThree">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          How do I pay with iDEAL payment?
        </button>
      </h5>
    </div>
    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
      <div class="card-body">
        When paying with iDEAL, first you will have to choose your bank. After this you will be redirected to the website or application of your own bank to confirm the payment. When the payment is accepted, you will be redirected back to the payment confirmation page on our website.
      </div>
    </div>
  </div>
  <br />
  <div class="card">
    <div class="card-header" id="headingFour">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
          How do I pay with Creditcard?
        </button>
      </h5>
    </div>
    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
      <div class="card-body">
        Paying for your order with a credit card is safe and easy. Thanks to SSL (Secure Sockets Layer) technology, your data is securely protected. After you’ve successfully completed your payment via credit card, your order will go straight into production.
        In case of an order return, the refund will always be issued to your original method of payment.
      </div>
    </div>
  </div>
</div>
</div>
</div>
</div>

@endsection
