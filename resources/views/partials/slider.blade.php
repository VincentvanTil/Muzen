<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <a href="{{ url('/illustrations')}}" >
        <img class="d-block w-100" src="images/carousel/illustrations.jpg" alt="First slide">
      <div class="carousel-caption d-none d-md-block">
      </div>
      </a>
    </div>
    <div class="carousel-item">
      <a href="{{ url('/photography')}}" >
        <img class="d-block w-100" src="images/carousel/photography.jpg" alt="Second slide">
      <div class="carousel-caption d-none d-md-block">
      </div>
      </a>
    </div>
    <div class="carousel-item">
      <a href="{{ url('/3DArt')}}" >
        <img class="d-block w-100" src="images/carousel/3DArtimage.jpg" alt="Third slide">
      <div class="carousel-caption d-none d-md-block">
      </div>
      </a>

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
