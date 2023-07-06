@extends('facebook/master')

@section('facebook')
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-12 col-md-10 col-lg-10">
                <div style="max-height: 350px; width:100%" class="col shadow  bg-danger rounded overflow-hidden">
                    @if ($user[0]['cover_image']!=null)
                        <img class="w-100 border rounded" src="{{asset('storage/images/cover_images/'.$user[0]['cover_image'])}}" alt="photo">
                    @else
                        <img class="w-100 border rounded" src="{{asset('storage/images/404_images/image_no_found.jpg')}}" alt="Photo">
                    @endif
                </div>
                <div style="width: 100%; height:100px;" class="col position-relative">
                    <div style="width: 150px; height:150px; bottom:0px; border: 8px solid white; border-radius:50%" class="d-flex shadow position-absolute justify-content-center overflow-hidden">
                        @if ($user[0]['profile_image']!=null)
                            <img style="object-fit:cover;" class="w-100 border rounded" src="{{asset('storage/images/profile_images/'.$user[0]['profile_image'])}}" alt="photo">
                        @else
                            <img style="object-fit:cover;" class="w-100 border rounded" src="{{asset('storage/images/404_images/profile.jpg')}}" alt="Photo">
                        @endif
                    </div>
                    <div style="margin-left: 160px;" class="pt-3">
                        <span class=" h5">{{ $user[0]['name'] }}</span>
                        @if ($user[0]['id']==Auth::User()->id)
                            <button class="btn bg-dark float-end text-white me-2" data-bs-toggle="modal" data-bs-target="#profileImageEdit">Edit Profile</button>
                        @endif
                        <span class=" d-block"><i class="fa-regular fa-clock me-2"></i>{{ Auth::user()->created_at->diffForHumans() }}</span>
                    </div>
                </div>
                <div class="col my-3 shadow p-2">
                    <a class="btn bg-dark text-white" href="#">Home</a>
                    <a class="btn bg-dark text-white" href="#">About</a>
                    <a class="btn bg-dark text-white" href="#">Photo</a>
                    <a class="btn bg-dark text-white" href="#">Post</a>
                </div>
                <div class="col d-block d-md-block d-lg-flex">
                    <div class="col-12 col-md-12 col-lg-5">
                        <div class="col p-1">
                            <div class="card my-2 p-3 shadow">
                                <h5>Intro</h5>
                                @if ($user[0]['id']==Auth::user()->id)
                                    <button class="btn bg-dark text-white mb-2">Add Bio</button>
                                @endif
                                @if ($user[0]['work']!=null)
                                    <h6 class="mb-2"><i class="fa-solid fa-briefcase me-2"></i> Works at<span class="ms-2 text-info">{{ $user[0]['work'] }}</span></h6>
                                @endif
                                @if ($user[0]['education']!=null)
                                    <h6 class="my-2"><i class="fa-solid fa-user-graduate me-2"></i> Education<span class="ms-2 text-info">{{ $user[0]['education'] }}</span></h6>
                                @endif
                                @if ($user[0]['address']!=null)
                                    <h6 class="my-2"><i class="fa-solid fa-location-dot me-2"></i>Address<span class="ms-2 text-info">{{ $user[0]['address'] }}</span></h6>
                                @endif
                                @if ($user[0]['live']!=null)
                                    <h6 class="my-2"><i class="fa-solid fa-house me-2"></i> Live in<span class="ms-2 text-info">{{ $user[0]['live'] }}</span></h6>
                                @endif
                                @if ($user[0]['marital_status']!=null)
                                    <h6 class="my-2"><i class="fa-solid fa-heart me-2"></i> Status<span class="ms-2 text-info">{{ $user[0]['marital_status'] }}</span></h6>
                                @endif
                                @if ($user[0]['birthday']!=null)
                                    <h6 class="my-2"><i class="fa-solid fa-cake-candles me-2"></i> Birthday<span class="ms-2 text-info">{{ $user[0]['birthday'] }}</span></h6>
                                @endif
                                @if ($user[0]['id']==Auth::user()->id)
                                    <button type="button" class="btn bg-dark text-white"  data-bs-toggle="modal" data-bs-target="#profileEdit">Edit Info</button>
                                @endif
                            </div>
                        </div>
                        <div class="col p-1">
                            <h6 class="my-2 text-end me-2"><a href="#">See All Photo</a></h6>
                            <div class="card d-flex flex-row flex-wrap p-2 shadow">
                                <div style="min-width: 120px;" class="col p-1">
                                    <img class="w-100" src="{{ asset("Lisa/wp5290502-lisa-blackpink-computer-wallpapers.jpg") }}" alt="">
                                </div>
                                <div style="min-width: 120px;" class="col p-1">
                                    <img class="w-100" src="{{ asset("Lisa/wp5290502-lisa-blackpink-computer-wallpapers.jpg") }}" alt="">
                                </div>
                                <div style="min-width: 120px;" class="col p-1">
                                    <img class="w-100" src="{{ asset("Lisa/wp5290502-lisa-blackpink-computer-wallpapers.jpg") }}" alt="">
                                </div>
                                <div style="min-width: 120px;" class="col p-1">
                                    <img class="w-100" src="{{ asset("Lisa/wp5290502-lisa-blackpink-computer-wallpapers.jpg") }}" alt="">
                                </div>
                                <div style="min-width: 120px;" class="col p-1">
                                    <img class="w-100" src="{{ asset("Lisa/wp5290502-lisa-blackpink-computer-wallpapers.jpg") }}" alt="">
                                </div>
                                <div style="min-width: 120px;" class="col p-1">
                                    <img class="w-100" src="{{ asset("Lisa/wp5290502-lisa-blackpink-computer-wallpapers.jpg") }}" alt="">
                                </div>
                                <div style="min-width: 120px;" class="col p-1">
                                    <img class="w-100" src="{{ asset("Lisa/wp5290502-lisa-blackpink-computer-wallpapers.jpg") }}" alt="">
                                </div>
                                <div style="min-width: 120px;" class="col p-1">
                                    <img class="w-100" src="{{ asset("Lisa/wp5290502-lisa-blackpink-computer-wallpapers.jpg") }}" alt="">
                                </div>
                                <div style="min-width: 120px;" class="col p-1">
                                    <img class="w-100" src="{{ asset("Lisa/wp5290502-lisa-blackpink-computer-wallpapers.jpg") }}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col p-1">
                        @foreach ($post as $p)
                        <div class=" card my-2 shadow">
                            <div class="card-header d-flex p-2 bg-body">
                                <div style="width:60px; height:60px; border-radius:50%; border:4px solid rgb(207, 207, 199);" class="d-flex justify-content-center overflow-hidden">
                                    @php
                                        $profileImage=App\Models\Info::where('user_id',$p->user_id)->get()->toArray();
                                    @endphp
                                    @if ($profileImage!=null)
                                        <img style="object-fit: cover;" class="w-100" src="{{ asset('storage/images/profile_images/'.$profileImage[0]['profile_image']) }}" alt="Photo">
                                    @else
                                        <img style="object-fit: cover;" class="w-100" src="{{ asset('storage/images/404_images/profile.jpg') }}" alt="Photo">
                                    @endif
                                </div>
                                <div class="py-2 ms-3 flex-fill">
                                    <h6 class="mb-0">{{ $p->name }}</h6>
                                    <small>{{ $p->created_at->diffForHumans() }}</small>
                                </div>
                                <div class=" d-flex align-items-center">
                                    @if (Auth::user()->id==$p->id)
                                        <a href="{{ url("post/delete",$p->id) }}" title="Delete Post" class="me-3 btn fs-5">
                                            <i class="fa-solid text-danger fa-trash"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <p style="text-align: justify;" class="p-2">
                                    {{ $p->desc }}
                                </p>
                                @if ($p->post_image!=null)
                                    <img class="w-100" src="{{ asset("storage/images/post_images/".$p->post_image) }}" alt="Photo">
                                @endif
                            </div>
                            <div class="card-footer p-0 bg-body">
                                <div class="p-1">
                                    <a href="#"><i class="fa-regular fa-thumbs-up me-2"></i>
                                        <span name="like{{ $p->post_id }}">
                                            {{ App\Models\Like::where('post_id',$p->post_id)->get()->count(); }}
                                        </span>
                                    </a>
                                    <a class="float-end commentBtn" data_id="{{ $p->post_id }}" href="#" data-bs-toggle="modal" data-bs-target="#commentModal">
                                        <i class="fa-regular fa-comment me-2"></i>
                                        <span>
                                            {{ App\Models\Comment::where('post_id',$p->post_id)->get()->count(); }}
                                        </span>
                                    </a>
                                </div>
                                <hr class="my-1">
                                <div class="d-flex p-1">
                                    <button type="button" data_id="{{ $p->post_id }}" class="btn btn-secondary likeBtn col">Like</button>
                                    <button type="button" data_id="{{ $p->post_id }}" href="#" data-bs-toggle="modal" data-bs-target="#commentModal" class="btn btn-secondary mx-1 col commentBtn">Comment</button>
                                    <button type="button" class="btn btn-secondary col">Share</button>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>


  <!-- Modal For Info -->
    <div class="modal fade" id="profileEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <form method="post" action="{{ url('profile/info/edit') }}" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Profile</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-3 bg-dark text-white">
                    <div class="mb-3">
                        <label class="form-label" for="work">Work</label>
                        <input class="form-control" type="text" value="{{ $user[0]['work'] }}" placeholder="Enter you work......" name="work" id="work">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="education">Education</label>
                        <input class="form-control" type="text" value="{{ $user[0]['education'] }}" placeholder="Enter you work......" name="education" id="education">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="address">Address</label>
                        <input class="form-control" type="text" value="{{ $user[0]['address'] }}" placeholder="Enter you address......" name="address" id="address">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="live">Live</label>
                        <input class="form-control" type="text" value="{{ $user[0]['live'] }}" placeholder="Enter you live......" name="live" id="live">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="phone">Phone</label>
                        <input class="form-control" type="number" value="{{ $user[0]['phone'] }}" placeholder="Enter you phone......" name="phone" id="phone">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="birthday">Birthday</label>
                        <input class="form-control" type="date" value="{{ $user[0]['birthday'] }}" name="birthday" id="birthday">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Gender</label>
                        <select class="form-select" name="gender"  aria-label="Default select example">
                            <option {{ $user[0]['gender']==''? 'selected':'' }}>Select you Gender</option>
                            <option {{ $user[0]['gender']=='male'?'selected':'' }} value="male">Male</option>
                            <option {{ $user[0]['gender']=='female'?'selected':'' }} value="female">Female</option>
                            <option {{ $user[0]['gender']=='other'?'selected':'' }} value="other">Other</option>
                          </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Marital Status</label>
                        <select class="form-select" name="marital_status" aria-label="Default select example">
                            <option selected>Select you marital status</option>
                            <option {{ $user[0]['marital_status']=='single'?'selected':'' }} value="single">Single</option>
                            <option {{ $user[0]['marital_status']=='fa'?'selected':'' }} value="fa">Fa</option>
                            <option {{ $user[0]['marital_status']=='rs'?'selected':'' }} value="rs">Rs</option>
                            <option {{ $user[0]['marital_status']=='other'?'selected':'' }} value="other">Other</option>
                          </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save & Update</button>
                </div>
            </form>
        </div>
    </div>

  <!-- Modal For Profile & Cover Image -->
    <div class="modal fade" id="profileImageEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <form method="post" action="{{ url('profile/image/edit') }}" enctype="multipart/form-data" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Profile</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <h5>Change Cover Image</h5>
                        @if ($user[0]['cover_image']!=null)
                            <img class="w-100 border rounded" id="coverImage" src="{{asset('storage/images/cover_images/'.$user[0]['cover_image'])}}" alt="photo">
                        @else
                            <img class="w-100 border rounded" id="coverImage" src="{{asset('storage/images/404_images/image_no_found.jpg')}}" alt="">
                        @endif
                        <input class="form-control bg-dark text-white" type="file" name="cover_image" id="coverImageFile">
                    </div><hr>
                    <div class="mb-3">
                        <h5>Change Profile Image</h5>
                        @if ($user[0]['profile_image']!=null)
                            <img class="w-100 border rounded" id="profileImage" src="{{asset('storage/images/profile_images/'.$user[0]['profile_image'])}}" alt="photo">
                        @else
                            <img class="w-100 border rounded" id="profileImage" src="{{asset('storage/images/404_images/profile.jpg')}}" alt="">
                        @endif
                        <input class="form-control bg-dark text-white" type="file" name="profile_image" id="profileImageFile">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('facebookJs')
<script>
    $(document).ready(function(){
        $('#coverImageFile').change(function(){
            $('#coverImage').attr('src',URL.createObjectURL(this.files[0]));
        });
        $('#profileImageFile').change(function(){
            $('#profileImage').attr('src',URL.createObjectURL(this.files[0]));
        });
    });
</script>
@endsection
