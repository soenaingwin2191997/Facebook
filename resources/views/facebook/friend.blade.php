
@extends('facebook/master')

@section('facebook')

<div class="container-fluid">
    <div class="row">
        <div style="height:100%;" class="col-3 d-none position-fixed p-3 overflow-auto d-md-block d-lg-block">
            <a href="#" class="w-100 btn notification-hover py-2 my-1 d-flex">
                <i class="fa-solid fa-house fs-4" style="color: #aba4ac"></i>
                <span class="fw-bold ms-3">Home</span>
            </a>
            <a href="#" class="w-100 btn notification-hover py-2 my-1 d-flex">
                <i class="fa-solid fa-user-shield fs-4" style="color: #4853cc"></i>
                <span class="fw-bold ms-3">Friend Requests</span>
            </a>
            <a href="#Suggestions" class="w-100 btn notification-hover py-2 my-1 d-flex">
                <i class="fa-solid fa-user-plus fs-4" style="color: #a5bf14"></i>
                <span class="fw-bold ms-3">Suggestions</span>
            </a>
            <a href="#Friends" class="w-100 btn notification-hover py-2 my-1 d-flex">
                <i class="fa-solid fa-user-check fs-4" style="color: #7abd66"></i>
                <span class="fw-bold ms-3">All Friends</span>
            </a>
            <div class="w-100 btn notification-hover py-2 my-1 d-flex">
                <i class="fa-solid fa-circle-user fs-4" style="color: #776f78;"></i>
                <span class="fw-bold ms-3">Groups</span>
            </div>
        </div>
        <div id="requests" class="col-12 col-md-6 col-lg-6 d-flex flex-wrap p-1 offset-md-3 offset-lg-3">
            <div class="col-12 fs-4 fw-bold my-2">Friend Requests</div>
            @foreach ($request as $req)
                <div style="padding: 2px;" class="col-6 col-md-4 col-lg-4">
                    <div class="card p-1">
                        <img class="w-100 rounded mb-2" src="{{ asset('storage/images/profile_images/'.$req->profile_image) }}" alt="photo">
                        <small class=" d-block fw-bold" style="font-size:14px;">{{ $req->name }}</small>
                        <h6 style="font-size:13px;">500 mutual friends</h6>
                        <a href="{{ url('add/friend',$req->friend_user_id) }}" class="btn btn-success mb-2">Confirm</a>
                        <button class="btn btn-danger">Delete</button>
                    </div>
                </div>
            @endforeach
        </div>
        <div id="Suggestions" class="col-12 col-md-6 col-lg-6 d-flex flex-wrap p-1 offset-md-3 offset-lg-3">
            <div class="col-12 fs-4 fw-bold my-2">Suggestions</div>
            @foreach ($suggestions as $sug)
                @if ($sug->auth_user_id !=Auth::user()->id)
                    @if ($sug->request_user_id == Auth::user()->id)
                        <div style="padding: 2px;" class="col-6 col-md-4 col-lg-4">
                            <div class="card p-1">
                                <img class="w-100 rounded mb-2" src="{{ asset('storage/images/profile_images/'.$sug->profile_image) }}" alt="photo">
                                <small class=" d-block fw-bold" style="font-size:14px;">{{ $sug->name }}</small>
                                <h6 style="font-size:13px;">500 mutual friends</h6>
                                <a href="{{ url('add/request',$sug->auth_user_id) }}" class="btn btn-success mb-2">Request</a>
                                <button class="btn btn-danger">Remove</button>
                            </div>
                        </div>
                    @else
                    <div style="padding: 2px;" class="col-6 col-md-4 col-lg-4">
                        <div class="card p-1">
                            <img class="w-100 rounded mb-2" src="{{ asset('storage/images/profile_images/'.$sug->profile_image) }}" alt="photo">
                            <small class=" d-block fw-bold" style="font-size:14px;">{{ $sug->name }}</small>
                            <h6 style="font-size:13px;">500 mutual friends</h6>
                            <a href="{{ url('add/request',$sug->auth_user_id) }}" class="btn btn-success mb-2">Add Friend</a>
                            <button class="btn btn-danger">Remove</button>
                        </div>
                    </div>
                    @endif
                @endif
            @endforeach
        </div>
        <div id="Friends" class="col-12 col-md-6 col-lg-6 d-flex flex-wrap p-1 offset-md-3 offset-lg-3">
            <div class="col-12 fs-4 fw-bold my-2">All Friends</div>
            @foreach ($friend as $fri)
                <div style="padding: 2px;" class="col-6 col-md-4 col-lg-4">
                    <div class="card p-1">
                        <img class="w-100 rounded mb-2" src="{{ asset('storage/images/profile_images/'.$fri->profile_image) }}" alt="photo">
                        <small class=" d-block fw-bold" style="font-size:14px;">{{ $fri->name }}</small>
                        <h6 style="font-size:13px;">500 mutual friends</h6>
                        <a href="{{ url('add/request',$fri->friend_user_id) }}" class="btn btn-success mb-2">UnFriend</a>
                    </div>
                </div>
            @endforeach
        </div>
        <div style="height: 100%;" class="col-3 offset-9 p-2 position-fixed d-none d-md-block d-lg-block overflow-auto">
            <div style="width: 80%;" class="float-end">
                <h5 class="ms-2">Contacts</h5>
                @foreach ($messengers as $messenger)
                    <a href="#" class="d-flex btn text-start p-0 notification-hover p-1 m-1 rounded">
                        <div style="border-radius: 50%; width:40px; height:40px; border:4px solid rgb(204, 196, 196);" class="col-2 d-flex justify-content-center overflow-hidden">
                            @if ($messenger->profile_image !=null)
                                <img style="object-fit: cover;" class="w-100" src="{{ asset('storage/images/profile_images/'.$messenger->profile_image) }}" alt="photo">
                            @else
                                <img style="object-fit: cover;" class="w-100" src="{{ asset('storage/images/404_images/profile.jpg') }}" alt="Photo">
                            @endif
                        </div>
                        <div class="ms-2 d-flex align-items-center">
                            <small class="fw-bold">{{ $messenger->name }}</small>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection

@section('facebookJs')
<script>
    $(document).ready(function(){

    });
</script>
@endsection
