@extends('layouts.app')

@section('content')

<div class="jumbotron jumbotron-sm">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-lg-12">
                <h1 class="h1">
                    Contact us <small>Feel free to contact us</small></h1>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="well well-sm">
                <form action="{{ route('contact.sendMail')}}" method="POST">
                  @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">
                                Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" required="required" />
                        </div>
                        <div class="form-group">
                            <label for="email">
                                Email Address</label>
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span>
                                </span>
                                <input type="email" class="form-control" name="email" id="email" placeholder="Enter email" required="required" /></div>
                        </div>
</div>

<div class="col-md-6">
    <div class="form-group">
        <label for="name">
            Message</label>
        <textarea name="message" id="message" class="form-control" rows="9" cols="25" name="message" required="required"
            placeholder="Message"></textarea>
    </div>
</div>
<div class="col-md-12">
    <button type="submit" class="btn btn-primary pull-right" id="btnContactUs">
        Send Message</button>
</div>
</div>
</form>
</div>
</div>
<div class="col-md-4">
<form>
<legend><span class="glyphicon glyphicon-globe"></span> Our office</legend>
<address>
<strong>MUZEN Inc.</strong><br>
795 Folsom Ave, Suite 600<br>
San Francisco, CA 94107<br>
<abbr title="Phone">
P:</abbr>
(123) 456-7890
</address>
<address>
<strong>Full Name</strong><br>
<a href="">0881446@hr.nl</a>
</address>
</form>
</div>
</div>
</div>

@endsection
