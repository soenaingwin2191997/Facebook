
@extends('facebook/master')

@section('facebook')

<div class="container-fluid">
    <div class="row">
        <div style="height:100%;" class="col-3 d-none position-fixed p-3 overflow-auto d-md-block d-lg-block">
            <div style="width: 80%;">
                <h5 class="ms-2">Contacts</h5>
                @foreach ($messengers as $messenger)
                    <a href="{{ url('messenger/message',$messenger->user_id) }}" class="d-flex btn text-start p-0 notification-hover p-1 m-1 rounded">
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
        <div style="height: 90%;" class="col-12 position-relative col-md-6 col-lg-6 position-fixed offset-md-3 offset-lg-3">
            <div  class="col-12 shadow">
                <div class="d-flex btn text-start p-0 p-1 m-1 rounded">
                    <div style="border-radius: 50%; width:60px; height:60px; border:4px solid rgb(204, 196, 196);" class="col-2 d-flex justify-content-center overflow-hidden">
                        @if ($friend[0]['profile_image'] !=null)
                            <img style="object-fit: cover;" class="w-100" src="{{ asset('storage/images/profile_images/'.$friend[0]['profile_image']) }}" alt="photo">
                        @else
                            <img style="object-fit: cover;" class="w-100" src="{{ asset('storage/images/404_images/profile.jpg') }}" alt="Photo">
                        @endif
                    </div>
                    <div class="ms-2 d-flex align-items-center">
                        <small class="fw-bold">{{ $friend[0]['name'] }}</small>
                    </div>
                </div>
            </div>
            <div id="messageBody" style="height: 70%;" class="col overflow-auto shadow-sm px-3">
                {{-- @foreach ($messages as $message)
                    @if ($message->sender==Auth::user()->id and $message->receiver==$friend[0]['friend_id'])
                    <div class="col mb-3 d-flex">
                        <div class=" flex-fill"></div>
                        <div style="width:70%; text-align:justify;" class="p-2 rounded shadow text-end">
                            {{ $message->message }}
                        </div>
                    </div>
                    @elseif ($message->sender==$friend[0]['friend_id'] and $message->receiver==Auth::user()->id)
                        <div class="col mb-3">
                            <div style="width: 70%; text-align:justify;" class="p-2 rounded shadow">
                                {{ $message->message }}
                            </div>
                        </div>
                    @endif
                @endforeach --}}
            </div>
            <div style="bottom: 0; width:96%;" class="col-12 p-3 position-absolute shadow d-flex">
                <input id="messageUserId" type="hidden" value="{{ Auth::user()->id }}" name="">
                <input id="messageFriendId" type="hidden" value="{{ $friend[0]['friend_id'] }}" name="">
                <div class="col-10">
                    <input class="form-control" type="text" name="" id="messageInput">
                </div>
                <div class="col-1 ms-2">
                    <button id="messageBtn" class="btn btn-info">Sent</button>
                </div>
            </div>
           
        </div>
        
        <div style="height: 100%;" class="col-3 offset-9 p-2 position-fixed d-none d-md-block d-lg-block overflow-auto">
            <div style="width: 80%;" class="float-end">
                <h5 class="ms-2">Contacts</h5>
                {{-- @foreach ($messengers as $messenger)
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
                @endforeach --}}
            </div>
        </div>
    </div>
</div>

@endsection

@section('facebookJs')
<script>
    $(document).ready(function(){
       setInterval(() => {
        $message=$('#messageInput').val();
        $sender=$('#messageUserId').val();
        $receiver=$('#messageFriendId').val();

        $.ajax({
            type:'get',
            url:"{{ url('ajax/show/message') }}",
            dataType:'json',
            data:{

            },
            success:function(response){
                $list='';
                for($i=0; $i<response[0].length; $i++){
                    // console.log(response[0][$i]['sender']);
                    if(response[0][$i]['sender']==$sender && response[0][$i]['receiver']==$receiver){
                        $list+=`
                        <div class="col mb-3 d-flex">
                        <div class=" flex-fill"></div>
                            <div style="width:70%; text-align:justify;" class="p-2 rounded shadow text-end">
                                ${response[0][$i]['message']}
                            </div>
                        </div>
                        `;
                    }else if(response[0][$i]['sender']==$receiver && response[0][$i]['receiver']==$sender){
                        $list+=`
                        <div class="col mb-3">
                            <div style="width: 70%; text-align:justify;" class="p-2 rounded shadow">
                                ${response[0][$i]['message']}
                            </div>
                        </div>
                        `;
                    }
                }
                $('#messageBody').html($list);
                scrollTop();
            }
        });

       }, 500);

        //  For Click Send Button /////////////////////////////////////////////
        $('#messageBtn').click(function(){
            $message=$('#messageInput').val();
            $sender=$('#messageUserId').val();
            $receiver=$('#messageFriendId').val();

            if($message!=null){
                $.ajax({
                    type:'get',
                    url:"{{ url('ajax/add/message') }}",
                    dataType:'json',
                    data:{
                        'message':$message,
                        'sender':$sender,
                        'receiver':$receiver,
                    },

                });
                $('#messageInput').val("");
                scrollTop();
            }
        });

        function scrollTop(){
            $scroll = $('#messageBody').prop('scrollHeight');
            $('#messageBody').scrollTop($scroll);
        }
    });
</script>
@endsection
