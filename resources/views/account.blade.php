  @extends ('layouts.sidemenu')

  @section('content')






    <div class="container mt-5">
        <div class="jumbotron border">
            <div class="row">
                <div class="col-md-4 col-xs-12 col-sm-6 col-lg-4">
                    <img src="https://www.svgimages.com/svg-image/s5/man-passportsize-silhouette-icon-256x256.png" alt="stack photo" class="img">
                      </div>
                        <div class="col-md-8 col-xs-12 col-sm-6 col-lg-8">
                          <div class="container">
                              <h3>{{ Auth::user()->name }}</h3>
                              </a>




                            </div>
                              <br />
                            <ul class="container details">
                              <li><p><i class="fa fa-envelope"></i> {{ Auth::user()->email }}</p></li>
                              <li><p><span class="glyphicon glyphicon-new-window one" style="width:50px;"></span><a href="#">www.example.com</p></a>
                              <b>_____________________________________________</b>

                            </ul>

                        </div>
                    </div>
                  </div>
                </div>


                <div class="container-fluid mt-5">
                 <div class="row" id="pep">
                         <div class="col-sm-6 charlieshoogte">
                          <div class="card h-100 bg-white border">
                             <div class="card-header">Orders</div>
                             <div class="card-body">
                               <a href="#" class="btn">My Orders</a>
                               <br />
                               <a href="#" class="btn">Order History</a>
                             </div>
                           </div>
                         </div>
                         <div class="col-sm-6 charlieshoogte">
                           <div class="card h-100 bg-white border">
                             <div class="card-header">Account Preferences</div>
                             <div class="card-body">
                               <a href={{ url('/changepassword') }} class="btn">Change Password</a>
                               <br />
                               <a href={{ url('/addaddress') }} class="btn">Add address</a>
                              <br />
                               <a href={{ url('/editmail') }} class="btn">Edit mail</a>
                               <br />
                               <a href={{ url('/editdescription') }} class="btn">Edit Description</a>
                              </div>
                           </div>
                         </div>
                       </div>
                     </div>




  @endsection
