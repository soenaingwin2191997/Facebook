

@php
    use App\Models\Notification;
    $noti=Notification::join('infos','notifications.user_id','infos.user_id')->join('users','notifications.user_id','users.id')->get();
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        .notification-hover:hover{
            background-color: rgb(224, 236, 236);
        }
    </style>
</head>
<body>

    <div style="z-index: 50;" class=" container-fluid d-flex justify-content-center bg-white p-1 position-sticky top-0 shadow">
        <div class="col d-none d-md-block d-lg-block">
            <div style="background: rgb(244, 244, 236)" class="d-flex align-items-center py-1 rounded-pill">
                <button class="btn"><i class="fa-solid fa-magnifying-glass"></i></button>
                {{-- <input class="btn text-start bg-white" placeholder="Search Facebook" type="text" name="search" id=""> --}}
                <div class="dropdown">
                <input class="btn text-start bg-white dropdown-toggle" placeholder="Search Facebook" data-bs-toggle="dropdown" aria-expanded="false" type="text" name="search" id="searchInput">
                    <ul id="searchBody" class="dropdown-menu">
                        {{-- Ajax Data --}}
                    </ul>
                  </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-6 d-flex justify-content-around align-items-center">
            <a href="{{ url('home/page') }}" class="fs-4 btn"><i class="fa-solid fa-house"></i></a>
            <span class="fs-5 btn"><i class="fa-solid fa-circle-play"></i></span>
            <a href="{{ url('friend/page') }}" class="fs-4 btn"><i class="fa-solid fa-people-group"></i></a>
            <div class="dropdown">
                <button class="btn fs-4" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-bell"></i>
                </button>
                <ul style="width: 400px;" class="dropdown-menu p-3">
                    <h5 class="mb-4">Notification</h5>
                    @foreach ($noti as $not)
                    <a href="{{ url('notification/page',$not->post_id) }}" class="d-flex btn text-start notification-hover rounded p-2">
                        <div style="border-radius: 50%; width:60px; height:60px; border:4px solid rgb(201, 195, 195);" class="col-2 d-flex justify-content-center overflow-hidden">
                            <img style="object-fit: cover;" class="w-100" src="{{ asset('storage/images/profile_images/'.$not->profile_image) }}" alt="photo">
                        </div>
                        <div class="ms-3">
                            <span class="fw-bold">{{ $not->name }}</span>
                            <span>{{ $not->action }}</span>
                            <h6>{{ $not->created_at->diffForHumans() }}</h6>
                        </div>
                    </a>
                    @endforeach
                </ul>
            </div>

        </div>
        <div class="col d-none d-md-block d-lg-block p-1">
            <div class="d-flex align-items-center justify-content-end">
                {{-- <button type="button" style="width:40px; height:40px; background:rgb(225, 218, 218); border-radius:50%;" class="d-flex mx-1 justify-content-center align-items-center" href="#">
                    <i class="fa-solid fa-circle-user fs-4 text-dark"></i>
                </button> --}}

                <div class="dropdown">
                    <button type="button" data-bs-toggle="dropdown" aria-expanded="false" style="width:40px; height:40px; background:rgb(219, 210, 210); border-radius:50%;" class="d-flex mx-1 justify-content-center align-items-center">
                        <i class="fa-brands fa-facebook-messenger fs-4 text-dark"></i>
                    </button>
                    <div style="width:300px;" class="dropdown-menu p-1">
                        <a href="{{ url('notification/page') }}" class="d-flex btn text-start notification-hover rounded p-1 m-1">
                            <div style="border-radius: 50%; width:50px; height:50px; border:4px solid rgb(204, 196, 196);" class="col-2 d-flex justify-content-center overflow-hidden">
                                <img style="object-fit: cover;" class="w-100" src="{{ asset('Lisa/wp4235801-lisa-blackpink-computer-wallpapers.jpg') }}" alt="photo">
                            </div>
                            <div class="ms-3">
                                <span class="d-block">Name <small>Date</small></span>
                                <small class="d-block">Date</small>
                            </div>
                        </a>
                    </div>
                  </div>
                <a href="{{ url('profile/page',Auth::user()->id) }}" title="Account" class="me-3">
                    <div style="width:40px; height:40px; border-radius:50%; border:2px solid black;" class="d-flex justify-content-center overflow-hidden">
                        @php
                            $profileImage=App\Models\Info::where('user_id',Auth::user()->id)->get()->toArray();
                        @endphp
                        @if ($profileImage!=null)
                            <img style="object-fit: cover;" class="w-100" src="{{ asset('storage/images/profile_images/'.$profileImage[0]['profile_image']) }}" alt="Photo">
                        @else
                            <img style="object-fit: cover;" class="w-100" src="{{ asset('storage/images/404_images/profile.jpg') }}" alt="Photo">
                        @endif
                    </div>
                </a>
            </div>
        </div>
    </div>


    @yield('facebook')


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
    @yield('facebookJs')
    <script>
        $(document).ready(function(){
            $('#searchInput').keyup(function(){
                $searchKey=$(this).val();
                $.ajax({
                    type:'get',
                    url:"{{ url('ajax/search/data') }}",
                    dataType:'json',
                    data:{
                        'key':$searchKey,
                    },
                    success:function(response){
                        // console.log(response[0]);
                        $list='';
                        for($i=0; $i<response[0].length; $i++){
                            $list+=`
                                <li><a class="dropdown-item" href="{{ url('profile/page/`+ response[0][$i][`id`] +`') }}">${response[0][$i]['name']}</a></li>
                            `;
                        }
                        $('#searchBody').html($list);
                    }
                })
            })
        })
    </script>
</html>
