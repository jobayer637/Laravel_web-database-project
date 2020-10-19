@extends('layouts.app')

@push('css')
<style>
    .aus{
        padding:1px 3px; right:5px; top:0; bottom:0; position:absolute; height:12px; margin:auto;
    }
</style>
@endpush

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-3">
            <div class="card rounded-0">
                <div class="card-header rounded-0 text-center">Active Users <example-component></example-component></div>
                <div class="card rounded-0 p-3 bg-light">
                    @foreach($users as $user)
                        <div class="card-header rounded-0 mb-1 py-0 px-2 border" style="position:relative;">
                            <strong class="text-muted m-0 p-0 d-inline-block">{{$user->name}}</strong>
                            <small id="auid_{{$user->id}}" data-id="{{$user->id}}" class="activeUser badge badge-info text-white aus">offline</small>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <div class="card rounded-0">
                <div class="card-body my-1">
                    <div class="input-group">
                        <button data-id="{{ Auth::user()->id }}" id="generateAPIKEY"
                            class="btn btn-sm btn-info rounded-0">Generate API KEY</button>
                        <input id="apiKey" class="form-control rounded-0" type="text" disabled>
                    </div>
                </div>

                <div class="card-header border-top">
                    Get User (Get Method) using jQury AJAX
                </div>
                <div class="card-body">
                    <p>
                        url: 'http://blogapiservice.herokuapp.com/api/blog/service/user',<br>
                        type: 'GET',<br>
                        dataType: 'json',<br>
                        data: {<br>
                        &nbsp;&nbsp;&nbsp; apikey: "your api key",<br>
                        },<br>
                        success: function (data) {<br>
                        &nbsp;&nbsp;&nbsp; console.log(data)<br>
                        }
                    </p>
                </div>
                <!-- Guide for User register trhow api -->
                <div class="card-header rounded-0 border-top mt-3">Add User (Post method) using jQury AJAX
                </div>
                <div class="card-body rounded-0">
                    <p>
                        url: "http://blogapiservice.herokuapp.com/api/blog/service/user",<br>
                        type: 'POST',<br>
                        data: {<br>
                        &nbsp;&nbsp;&nbsp; apikey: "your api key",<br>
                        &nbsp;&nbsp;&nbsp; name: 'your name',<br>
                        &nbsp;&nbsp;&nbsp; email: 'your email',<br>
                        &nbsp;&nbsp;&nbsp; password: 'your password',<br>
                        },<br>
                        success: function (data) {<br>
                        &nbsp;&nbsp;&nbsp; console.log(data)<br>
                        }
                    </p>
                </div>
                <!-- End Guide for User register trhow api  -->

                    <!-- Guide for Get Question trhow api -->
                <div class="card-header rounded-0 border-top mt-3">Get All Question (Get method) using jQury AJAX
                </div>
                <div class="card-body rounded-0">
                    <p>
                        url: "http://blogapiservice.herokuapp.com/api/blog/service/question",<br>
                        type: 'GET',<br>
                        data: {<br>
                        &nbsp;&nbsp;&nbsp; apikey: "your api key",<br>
                        },<br>
                        success: function (data) {<br>
                        &nbsp;&nbsp;&nbsp; console.log(data)<br>
                        }
                    </p>
                </div>
                <!-- End Guide for Get Question trhow api -->

                 <!-- Guide for Get Blog trhow api -->
                <div class="card-header rounded-0 border-top mt-3">Get All Blogs (Get method) using jQury AJAX
                </div>
                <div class="card-body rounded-0">
                    <p>
                        url: "http://blogapiservice.herokuapp.com/api/blog/service/blog",<br>
                        type: 'GET',<br>
                        data: {<br>
                        &nbsp;&nbsp;&nbsp; apikey: "your api key",<br>
                        },<br>
                        success: function (data) {<br>
                        &nbsp;&nbsp;&nbsp; console.log(data)<br>
                        }
                    </p>
                </div>
                <!-- End Guide for Get Blog trhow api -->
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')


<!-- WebSocket: active-user pusher channel and  ActiveUserEvent -->
<script>
    Echo.join(`active-user`)
        .here((users) => {
            $("#tau").text(users.length)
            $.each(users, function(index, u){
                    $.each($(".activeUser"), function(i,v){
                    let au = $(v).data('id')
                    if(au==u.id) {$("#auid_"+au).text('online').removeClass('badge-info').addClass('badge-danger')}
                })
            })
        })
        .joining((user) => {
            $.each($(".activeUser"), function(i,v){
                    let au = $(v).data('id')
                    if(au==user.id) {$("#auid_"+au).text('online').removeClass('badge-info').addClass('badge-danger')}
                })
        })
        .leaving((user) => {
            $.each($(".activeUser"), function(i,v){
                    let au = $(v).data('id')
                    if(au==user.id) {$("#auid_"+au).text('offline').removeClass('badge-danger').addClass('badge-info')}
                })
        });
    </script>
<!-- WebSocket: active-user pusher channel and  ActiveUserEvent -->

<script>
    $.ajax({
        url: "{{ route('getapi') }}",
        type: 'GET',
        dataType: 'json',
        data:{
            id: $("#generateAPIKEY").data('id')
        },
        success: function(data){
            data != '' ? $("#apiKey").val(data[0].key): ''
        }
    })

    $("#generateAPIKEY").on('click', function(){
        $.ajax({
            url: "{{ route('generatekey') }}",
            type: 'GET',
            dataType: 'json',
            data:{
                id: $(this).data('id')
            },
            success: function(data){
                 $("#apiKey").val(data.key);
            }
        })
    })
</script>

@endpush