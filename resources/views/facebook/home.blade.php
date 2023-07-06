

@extends('facebook/master')

@section('facebook')
<div class=" container-fluid">
    <div class="row">
        <div class="col-12 d-flex p-0">
            <div style="height:100%;" class="col-3 d-none position-fixed p-3 overflow-auto d-md-block d-lg-block">
                <a href="{{ url('profile/page',Auth::user()->id) }}" class="w-100 btn notification-hover py-2 my-1 d-flex">
                    <i class="fa-solid fa-circle-user fs-4" style="color: #595454;"></i>
                    <span class="fw-bold ms-3">Profile</span>
                </a>
                <a href="{{ url('friend/page') }}" class="w-100 btn notification-hover py-2 my-1 d-flex">
                    <i class="fa-solid fa-user-group fs-4" style="color: #1e2aad;"></i>
                    <span class="fw-bold ms-3">Friends</span>
                </a>
                <div class="w-100 btn notification-hover py-2 my-1 d-flex">
                    <i class="fa-solid fa-shield-halved fs-4" style="color: #a5bf14;"></i>
                    <span class="fw-bold ms-3">Feeds</span>
                </div>
                <div class="w-100 btn notification-hover py-2 my-1 d-flex">
                    <i class="fa-solid fa-circle-user fs-4" style="color: #776f78;"></i>
                    <span class="fw-bold ms-3">Groups</span>
                </div>
                <div class="w-100 btn notification-hover py-2 my-1 d-flex">
                    <i class="fa-solid fa-clapperboard fs-4" style="color: #776e78;"></i>
                    <span class="fw-bold ms-3">Watch</span>
                </div>
                <div class="w-100 btn notification-hover py-2 my-1 d-flex">
                    <i class="fa-solid fa-clock-rotate-left fs-4" style="color: #725874;"></i>
                    <span class="fw-bold ms-3">Memory</span>
                </div>
                <div class="w-100 btn notification-hover py-2 my-1 d-flex">
                    <i class="fa-solid fa-bookmark fs-4" style="color: #6a506c;"></i>
                    <span class="fw-bold ms-3">Save</span>
                </div>
                <form method="POST" action="{{ route('logout') }}" class="w-100 btn notification-hover py-2 my-1 d-flex">
                    @csrf
                    <button class="btn bg-danger">Log Out</button>
                </form>
                <div class="w-100 btn notification-hover py-2 my-1 d-flex">
                    <i class="fa-solid fa-angle-down fs-4" style="color: #4a3b4b;"></i>
                    <span class="fw-bold ms-3">See More</span>
                </div>
            </div>
            <div style="height: 100%;" class="col-12 col-md-6 col-lg-6 offset-md-3 offset-lg-3 overflow-auto">
                <div class="container mt-3">
                    <div class="row px-4">
                        <div class="py-2 border rounded shadow">
                            <div class="d-flex align-items-center">
                                <div style="width:60px; height:60px; border-radius:50%; border:4px solid rgb(209, 210, 204);" class="d-flex justify-content-center overflow-hidden">
                                    @php
                                        $profileImage=App\Models\Info::where('user_id',Auth::user()->id)->get()->toArray();
                                    @endphp
                                    @if ($profileImage!=null)
                                        <img style="object-fit: cover;" class="w-100" src="{{ asset('storage/images/profile_images/'.$profileImage[0]['profile_image']) }}" alt="Photo">
                                    @else
                                        <img style="object-fit: cover;" class="w-100" src="{{ asset('storage/images/404_images/profile.jpg') }}" alt="Photo">
                                    @endif
                                </div>
                                <div class="ms-3 flex-fill">
                                    <button type="button" style="background: rgba(240, 238, 233, 0.957);" class="form-control rounded-pill text-start" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        What on you mind, {{ Auth::user()->name }}?
                                    </button>
                                </div>
                            </div>
                            <hr class="my-2">
                            <div class="d-flex">
                                <div class="col text-center">
                                    <button class="btn fw-bold notification-hover">Live Video</button>
                                </div>
                                <div class="col text-center">
                                    <button class="btn fw-bold notification-hover">Photo/Video</button>
                                </div>
                                <div class="col text-center">
                                    <button class="btn fw-bold notification-hover">Felling/Actavity</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row px-4">
                        @foreach ($post as $p)
                        <div class=" card my-1 shadow">
                            <div class="card-header d-flex bg-body p-2">
                                <div style="width:60px; height:60px; border-radius:50%; border:4px solid rgb(209, 210, 204);" class="d-flex justify-content-center overflow-hidden">
                                    @if ($p->profile_image!=null)
                                        <img style="object-fit: cover;" class="w-100" src="{{ asset('storage/images/profile_images/'.$p->profile_image) }}" alt="Photo">
                                    @else
                                        <img style="object-fit: cover;" class="w-100" src="{{ asset('storage/images/404_images/profile.jpg') }}" alt="Photo">
                                    @endif
                                </div>
                                <div class="py-2 ms-3 flex-fill">
                                    <h6 class="mb-0"><a class=" text-decoration-none" href="{{ url('profile/page',$p->user_id) }}">{{ $p->name }}</a></h6>
                                    <small>{{ $p->created_at->diffForHumans() }}</small>
                                </div>
                                <div class=" d-flex align-items-center">
                                    @if (Auth::user()->id==$p->user_id)
                                        <a href="{{ url("post/delete",$p->post_id) }}" title="Delete Post" class="me-3 btn fs-5">
                                            <i class="fa-solid text-danger fa-trash"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <p class="mt-2" style="text-align: justify;">
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
                                            {{ App\Models\Like::where('post_id',$p->post_id)->where('like','like')->get()->count(); }}
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
                                    @php
                                        $like=App\Models\Like::where('post_id',$p->post_id)->where('user_id',Auth::user()->id)->where('like','like')->get()->count();
                                    @endphp
                                    <button style="color:{{ $like=='1'? 'blue':'' }}" type="button" data_id="{{ $p->post_id }}" class="btn btn-secondary likeBtn col"><i class="fa-solid fa-thumbs-up"></i></button>
                                    <button type="button" data_id="{{ $p->post_id }}" data-bs-toggle="modal" data-bs-target="#commentModal" class="btn btn-secondary mx-1 col commentBtn">Comment</button>
                                    <button type="button" class="btn btn-secondary col">Share</button>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div style="height: 100%;" class="col-3 offset-9 p-2 position-fixed d-none d-md-block d-lg-block overflow-auto">
                <div style="width: 80%;" class="float-end">
                    <h5 class="ms-2">Contacts</h5>
                    @foreach ($friends as $friend)
                        <a href="{{ url('messenger/message',$friend->user_id) }}" class="d-flex btn text-start p-0 notification-hover p-1 m-1 rounded">
                            <div style="border-radius: 50%; width:40px; height:40px; border:4px solid rgb(204, 196, 196);" class="col-2 d-flex justify-content-center overflow-hidden">
                                @if ($friend->profile_image !=null)
                                    <img style="object-fit: cover;" class="w-100" src="{{ asset('storage/images/profile_images/'.$friend->profile_image) }}" alt="photo">
                                @else
                                <img style="object-fit: cover;" class="w-100" src="{{ asset('storage/images/404_images/profile.jpg') }}" alt="Photo">
                                @endif
                            </div>
                            <div class="ms-2 d-flex align-items-center">
                                <small class="fw-bold">{{ $friend->name }}</small>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<!--For Add  Modal -->

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form class="modal-content" action="{{ url("post/add") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Post</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <textarea class="form-control mb-3" name="desc" id=""  rows="3" placeholder="What on your mind?" required></textarea>
                <input type="file" class="form-control" name="image" accept="image/jpeg,image/jpg,image/png" id="">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save Post</button>
            </div>
        </form>
    </div>
</div>

<!-- Comment Modal -->
<div class="modal fade" id="commentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div style="max-width: 600px;" class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div id="commentModalContent" class="modal-content">
            <div class="modal-header p-2">
                <div style="width:70px; height:70px; border-radius:50%; border:4px solid rgb(219, 218, 211);" class="d-flex justify-content-center overflow-hidden">
                    <img style="object-fit: cover;" id="profileModalImage" class="w-100" src="" alt="Photo">
                </div>
                <div class="py-2 ms-3 flex-fill">
                    <h6 class="mb-0">Soe Naing Win</h6>
                    <small id="modalDate">Date</small>
                </div>
                <button type="button" class="btn-close me-4" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-1">
                <p style="text-align: justify" class="mx-2" id="modalDesc"></p>
                <img id="modalImage" class="w-100" src="" alt="Photo">
                <div class="p-1">
                    <a href="#"><i class="fa-regular fa-thumbs-up me-2"></i><span id="modalLikeShow">0</span></a>
                    <a href="#" class="float-end"><i class="fa-regular fa-comment me-2"></i><span id="modalCommentCount">0</span></a>
                </div>
                <hr class="my-1">
                <div class="d-flex p-1">
                    <button id="modalLikeBtn" data_id="" class="btn btn-secondary likeBtn col"><i class="fa-solid fa-thumbs-up"></i></button>
                    <label for="modalInput" class="btn btn-secondary mx-1 col">Comment</label>
                    <button class="btn btn-secondary col">Share</button>
                </div>
                <hr class="my-1">
                <div id="modalCommentShow">
                    {{-- Ajax Date --}}
                </div>
            </div>
            <div class="modal-footer">
                <form class="col d-flex">
                    <input id="modalCommentId" value="" type="hidden" name="">
                    <div class="col-11 pe-2">
                        <input class="form-control" type="text" placeholder="Write Comment............." name="" id="modalInput" required>
                    </div>
                    <div class="col-1">
                        <button id="modalCommentBtn" type="submit" class="btn btn-primary"><i class="fa-solid fa-paper-plane"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('facebookJs')
<script>
    $(document).ready(function(){
        /// For Comment Modal  ////////////////////////////////////////
        $('.commentBtn').click(function(){
            $id=$(this).attr('data_id');
            $.ajax({
                type:"get",
                url:"{{ url('ajax/show/modal') }}",
                dataType:'json',
                data:{
                    'id':$id,
                },
                success:function(response){
                    $('#modalDate').text(response[0]['post_date']);
                    $('#modalImage').attr("src",`{{ asset("storage/images/post_images/`+response[0][0][`post_image`]+`") }}`);
                    $('#modalDesc').html(response[0][0]['desc']);
                    $('#modalCommentId').val(response[0][0]['id']);
                    $('#modalLikeBtn').attr('data_id',response[0][0]['id']);
                    $('#modalLikeShow').text(response[1]);
                    $('#profileModalImage').attr('src',`{{ asset("storage/images/profile_images/`+ response[3][0][`profile_image`] +`") }}`);
                    if(response[4]==1){
                        $('#modalLikeBtn').css("color",'blue');
                    }else{
                        $('#modalLikeBtn').css("color",'white');
                    }
                    $commentList="";
                    $commentCount=0;
                    for($i=0; $i<response[2].length; $i++){
                        $comDate=response[2][$i]['created_at'];
                        $commentCount+=1;
                        $commentList+=`
                            <div class="d-flex mb-3 me-2">
                                <div>
                                    <div style="clip-path: circle(30%); width:100px;" class="m-0 d-flex align-items-center justify-content-center">
                                        <img class=" w-75" src="{{ asset('storage/images/profile_images/`+ response[2][$i][`profile_image`] +`') }}" alt="Photo">
                                    </div>
                                </div>
                                <div class="p-2 flex-fill rounded" style="background:gainsboro;">
                                    <span class="fw-bold mb-2">${response[2][$i]['name']}</span>
                                    <small class=" float-end">{{ Carbon\Carbon::parse("")->diffForHumans() }} </small>
                                    <p style="text-align: justify;">
                                        ${response[2][$i]['comment']}
                                    </p>
                                </div>
                            </div>
                        `;
                    }
                    $('#modalCommentCount').text($commentCount);
                    $('#modalCommentShow').html($commentList);
                }
            });
        });

        // For Add Like    //////////////////////////////////////////////////////
        $(".likeBtn").click(function(){
            $id=$(this).attr('data_id');
            $like=$('[name="like'+$id+'"]').text();
            $btn=$(this);
            $.ajax({
                type:"get",
                url:"{{ url('ajax/like/add') }}",
                dataType:'json',
                data:{
                    'id':$id,
                },
                success:function(response){
                    if(response['like']=='like'){
                        $('[name="like'+$id+'"]').text(Number($like)+1);
                        $('#modalLikeShow').text(Number($like)+1);
                        $btn.css("color", "blue");
              
                    }else{
                        $('[name="like'+$id+'"]').text(Number($like)-1);
                        $('#modalLikeShow').text(Number($like)-1);
                        $btn.css("color", "white");
                    }
                }
            });
        });

        // Add Comment //////////////////////////////////
        $('#modalCommentBtn').click(function(){
            $com=$('#modalInput').val();
            $postId=$('#modalCommentId').val();
            if($com!=null){
                $.ajax({
                    type:'get',
                    url:"{{ url('ajax/add/comment') }}",
                    dataType:'json',
                    data:{
                        'post_id':$postId,
                        'comment':$com,
                    },
                });
            }
        });
    });
</script>
@endsection
