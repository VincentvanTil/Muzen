@extends('layouts.app')

@section('content')
<div class="container mt-5" id="product-section">
  <div class="row">
   <div class="col-md-6">
     <!-- The product image will be placed here -->
     <img
        src="images/description/eye.jpg"
        alt="Colourful eye"
        class="responsive"
        />
    </div>
    <div class="col-md-6">
       <h1>{{$product->product_name}}</h1>
           <p class="description">
             {{$product->product_description}}
           </p>
<!-- WHO IS THE AUTHOR -->
           <p=class="description">
           <i>Artist: Karel</i>
         </p>
           <h2 class="product-price">$129.00</h2>
           <div class="row">
           </div>
            <button class ="btn btn-lg btn-primary">
              Add to Cart
               </button>
               <button class ="btn btn-sm btn-primary">
                 <img
                 src="images/description/heart.png"
                 />
               </button>
                 <p class="description">
                   In Stock
                 </p>
                 <!-- PRODUCT TAGS -->
                 <p class="description">
                   #red #colourful #eye #PHP #googlechrome
                 </p>
          </div>
         </div>
       </div>
@endsection
