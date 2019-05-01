@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-12 mt-5">

      <span class="align-text-center" style="text-align:center"><h2>FAQ</h2>
        <h2>____</h2>
        <br />
        <h4>WHAT IS SO SPECIAL ABOUT MUZEN?</h4>
        <br />
        <div class="row justify-content-center">
          <div class="col-md-4">
            <b>Muzen is an exceptional webshop that allows talented people to not only view,
              enjoy and buy beautiful art, but also gives them the opportunity to sell their own.</b>
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
                  What is the delivery time for my order?
                </button>
              </h5>
            </div>

            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
              <div class="card-body">
                The delivery time of your order depends on the individual production time of your chosen items. The vast majority of our products are made to order and can take up to 10 working days since they are produced individually for you after you place your order. We recommend that you check the relevant information on the item’s product page under the “Shipping Info” tab.
                Once you place an order, you will also receive a confirmation Email that allows you to track your order from the beginning of the production to the delivery to your door!
              </div>
            </div>
          </div>
          <br />
          <div class="card">
            <div class="card-header" id="headingTwo">
              <h5 class="mb-0">
                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                  How do I return my order?
                </button>
              </h5>
            </div>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
              <div class="card-body">
                You can return everything you ordered from MUZEN within 100 days of receipt. Simply go to our contact form and send us a message about the product you want to return.
                Don't forget to mention your ordernumber and a short explanation about your return reason.
                Please note that we have to deduct the 4.90€ return cost from your refund, as all items have been produced individually for you.
              </div>
            </div>
          </div>
          <br />
          <div class="card">
            <div class="card-header" id="headingThree">
              <h5 class="mb-0">
                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                  Can I change or cancel my order?
                </button>
              </h5>
            </div>
            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
              <div class="card-body">
                <p class="font-weight-bold">Cancellations: </p>
                Unfortunately, cancellations are not possible after you have placed your order as we produce everything on demand and individually for you and the order information are automatically forwarded to our producer.
                <br />
                <br />
                <p class="font-weight-bold">Order changes: </p>
                As we produce all orders on demand and individually for you, orders cannot be changed or altered after they have been placed because your items go into production immediately.
              </div>
            </div>
          </div>
          <br />
          <div class="card">
            <div class="card-header" id="headingFour">
              <h5 class="mb-0">
                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                  How do I cancel my subscription?
                </button>
              </h5>
            </div>
            <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
              <div class="card-body">
                Unfortunately it's  not possible to cancel your subscription. Once your subscription is ordered and paid for, it's not possible to change your subscription.
                When your subscription uploads are spent, you can always buy a new subscription.
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endsection
