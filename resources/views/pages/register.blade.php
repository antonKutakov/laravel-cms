@extends('layout')

@section('content')
<div class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
    
                    <div class="leave-comment mr0"><!--leave comment-->
                        
                        <h3 class="text-uppercase">Register</h3>
                        @include('admin.errors')
                        <br>
                        <form class="form-horizontal contact-form" role="form" method="post" action="/register">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <div class="col-md-12">
                                    <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Name" value="{{old('name')}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <input type="text" class="form-control" id="email" name="email"
                                           placeholder="Email" value="{{old('email')}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <input type="password" class="form-control" id="password" name="password"
                                           placeholder="password">
                                </div>
                            </div>
                            <button type="submit" class="btn send-btn">Register</button>
    
                        </form>
                    </div><!--end leave comment-->
                </div>
                @include('pages._sidebar')
            </div>
        </div>
    </div>
@endsection