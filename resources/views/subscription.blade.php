@extends ('layouts.sidemenu')

@section ('content')

<div class="container mt-5">
  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img class="d-block w-100" src="images/mini carousel/package1.png" alt="First slide">
        <div class="carousel-caption d-none d-md-block">
          <div class="img-overlay">
          <a href="{{ route('subscription.buy', 1)}}" class="btn btn-primary">BUY</a>
        </div>
        </div>
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="images/mini carousel/package2.png" alt="Second slide">
        <div class="carousel-caption d-none d-md-block">
          <div class="img-overlay">
          <a href="{{ route('subscription.buy', 2)}}" class="btn btn-primary">BUY</a>
        </div>
        </div>
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="images/mini carousel/package3.png" alt="Third slide">
        <div class="carousel-caption d-none d-md-block">
          <div class="img-overlay">
          <a href="{{ route('subscription.buy', 3)}}" class="btn btn-primary">BUY</a>
        </div>
        </div>

      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>

  <div class="row">
    <div class="col-md-4">
      <div class="card">
      <img class="card-img-top" src="images/mini carousel/package1.png" alt="Card image cap">
        <div class="card-body">
          <h5 class="card-title">One month</h5>
        </div>
          <div class="card-footer">
             <a href="{{ route('subscription.buy', 1)}}" class="btn btn-primary">Buy</a>
          </div>
      </div>
    </div>
	<div class="col-md-4">
      <div class="card">
      <img class="card-img-top" src="images/mini carousel/package2.png" alt="Card image cap">
        <div class="card-body">
          <h5 class="card-title">One month</h5>
        </div>
          <div class="card-footer">
             <a href="{{ route('subscription.buy', 2)}}" class="btn btn-primary">Buy</a>
          </div>
      </div>
    </div>
	<div class="col-md-4">
      <div class="card">
      <img class="card-img-top" src="images/mini carousel/package3.png" alt="Card image cap">
        <div class="card-body">
          <h5 class="card-title">One month</h5>
        </div>
          <div class="card-footer">
             <a href="{{ route('subscription.buy', 3)}}" class="btn btn-primary">Buy</a>
          </div>
      </div>
    </div>
  </div>
      <!-- <div class="col-md-4">
      <div class="card bg-white border-white" style="width:17rem;height:20rem">
          <img class="card-img-top" src="images/mini carousel/package3.png" alt="Card image cap">
            <div class="card-body">
              <div class="card-title"><h5>Six Months</h5></div>
              Buying this package will allow you to upload endlessly for six months
            </div>
            <div class="card-footer">
              <button type="button" class="btn btn-primary">Buy</button>
          </div>
          </div>
    </div>
    <div class="col-md-4">
    <div class="card bg-white border-white" style="width:17rem;height:20rem">
        <img class="card-img-top" src="..." alt="Card image cap">
          <div class="card-body">
            <div class="card-title"><h5>One Year</h5></div>
            Buying this package will allow you to upload endlessly for one year
          </div>
          <div class="card-footer">
            <button type="button" class="btn btn-primary">Buy</button>
          </div>
        </div>
      </div> -->
    </div>
  </div>


@endsection
