

@extends('facebook/master')

@section('facebook')

<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-md-6 col-lg-6 offset-md-3 offset-lg-3">
            <div class=" card my-1 shadow">
                <div class="card-header d-flex bg-body p-2">
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
                    <div class="py-2 ms-3 flex-fill">
                        <h6 class="mb-0">Soe Naing Win</h6>
                        <small>{{ Carbon\Carbon::parse($post[0]['created_at'] )->diffForHumans() }}</small>
                    </div>
                    <div class=" d-flex align-items-center">
                        <a href="{{ url("post/delete",$post[0]['id']) }}" title="Delete Post" class="me-3 btn fs-5">
                            <i class="fa-solid text-danger fa-trash"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body p-2">
                    <div>
                        <p style="text-align: justify;">
                            {{ $post[0]['desc'] }}
                        </p>
                        @if ($post[0]['post_image']!=null)
                            <img class="w-100" src="{{ asset("storage/images/post_images/".$post[0]['post_image']) }}" alt="Photo">
                        @endif
                    </div>
                    <div class="p-1">
                        <a href="#"><i class="fa-regular fa-thumbs-up me-2"></i>
                            <span name="like{{ $post[0]['id'] }}">
                                {{ App\Models\Like::where('user_id',Auth::user()->id)->where('post_id',$post[0]['id'])->get()->count(); }}
                            </span>
                        </a>
                        <a class="float-end commentBtn" data_id="{{ $post[0]['id'] }}" href="#" data-bs-toggle="modal" data-bs-target="#commentModal">
                            <i class="fa-regular fa-comment me-2"></i>
                            <span>
                                {{ App\Models\Comment::where('user_id',Auth::user()->id)->where('post_id',$post[0]['id'])->get()->count(); }}
                            </span>
                        </a>
                        <hr class="my-1">
                        <div class="d-flex p-1">
                            <button type="button" data_id="{{ $post[0]['id'] }}" class="btn btn-secondary likeBtn col">Like</button>
                            <button type="button" data_id="{{ $post[0]['id'] }}" href="#" data-bs-toggle="modal" data-bs-target="#commentModal" class="btn btn-secondary mx-1 col commentBtn">Comment</button>
                            <button type="button" class="btn btn-secondary col">Share</button>
                        </div>
                        <hr class="my-1">
                        <div class="col d-flex p-1">
                            <div class="col-11 pe-2">
                                <input class="form-control" type="text" name="" id="notiComment">
                            </div>
                            <div class="col-1">
                                <button post_id="{{ $post[0]['id'] }}" id="modalCommentBtn" class="btn btn-info"><i class="fa-solid fa-paper-plane"></i></</button>
                            </div>
                        </div>
                        <hr class="my-2">
                    </div>
                </div>

                @foreach ($com as $c)
                <div class="p-2">
                    <div class="d-flex mb-2">
                        <div style="width:60px; height:60px; border-radius:50%; border:4px solid rgb(209, 210, 204);" class="d-flex justify-content-center overflow-hidden">
                            @php
                                $profileImage=$c->profile_image
                            @endphp
                            @if ($profileImage!=null)
                                <img style="object-fit: cover;" class="w-100" src="{{ asset('storage/images/profile_images/'.$c->profile_image) }}" alt="Photo">
                            @else
                                <img style="object-fit: cover;" class="w-100" src="{{ asset('storage/images/404_images/profile.jpg') }}" alt="Photo">
                            @endif
                        </div>
                        <div class="p-2 ms-3 flex-fill rounded" style="background:gainsboro;">
                            <span class="fw-bold mb-2">{{ $c->name }}</span>
                            <small class=" float-end">{{ Carbon\Carbon::parse($c->comment_date)->diffForHumans() }} </small>
                            <p style="text-align: justify;">
                                {{ $c->comment }}
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection

@section('facebookJs')
<script>
    $(document).ready(function(){
         // For Add Like    //////////////////////////////////////////////////////
         $(".likeBtn").click(function(){
            $id=$(this).attr('data_id');
            $like=$('[name="like'+$id+'"]').text();
            $('[name="like'+$id+'"]').text(Number($like)+1);
            $('#modalLikeShow').text(Number($like)+1);
            $.ajax({
                type:"get",
                url:"{{ url('ajax/like/add') }}",
                dataType:'json',
                data:{
                    'id':$id,
                },
            });
        });

        // Add Comment //////////////////////////////////
        $('#modalCommentBtn').click(function(){
            $com=$('#notiComment').val();
            $postId=$(this).attr('post_id');
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
                location.reload();
            }
        });
    });
</script>
@endsection
