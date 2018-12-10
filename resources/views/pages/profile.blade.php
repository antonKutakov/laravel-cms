@extends('layout')

@section('content')
<div class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">

                <div class="leave-comment mr0"><!--leave comment-->
                    @if(session('status'))
                        <div class="alert alert-success">
                            {{session('status')}}
                        </div>
                    @endif
                    <h3 class="text-uppercase">My profile</h3>
                    <br>
                    @include('admin.errors')
                    <img src="{{$user->getImage()}}" alt="" class="profile-image">
                    <form class="form-horizontal contact-form" role="form" method="post" action="/profile" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <div class="col-md-12">
                                <input type="text" class="form-control" id="name" name="name"
                                placeholder="Name" value="{{$user->name}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <input type="email" class="form-control" id="email" name="email"
                                       placeholder="Email" value="{{$user->email}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <input type="password" class="form-control" id="password" name="password"
                                       placeholder="password">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
								<input type="file" class="form-control" id="image" name="avatar">	
                            </div>
                        </div>
                        <button type="submit" class="btn send-btn">Update</button>

                    </form>
                </div><!--end leave comment-->
            </div>
            @include('pages._sidebar')
        </div>
    </div>
</div>
@endsection