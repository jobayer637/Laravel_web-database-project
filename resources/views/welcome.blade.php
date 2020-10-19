@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div id="showMsg" class="card-header">User Registration</div>

                <div class="card-body">
                   <form>
                        @csrf
                        <div class="form-group">
                            <small class="text-success" id="nameStatus"></small>
                            <input id="name" class="form-control rounded-0" type="text" placeholder="Enter Name">
                        </div>
                        <div class="form-group">
                            <small class="text-success" id="mailStatus"></small>
                            <input data-check id="email" class="form-control rounded-0" type="email" placeholder="Enter Email">
                            <small id="mailChecker" class="d-none">false</small>
                        </div>
                        <div class="form-group">
                            <small class="text-success" id="passwordStatus"></small>
                            <input id="password" class="form-control rounded-0" type="password" placeholder="Enter Password">
                        </div>
                        <button class="btn btn-outline-primary rounded-0" type="button" id="save">Register</button>
                        <span><small id="showMsg2" class="ml-4 text-success"></small></span>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
        $("#save").on('click', function () {
            let name = $("#name").val()
            let email = $("#email").val()
            let password = $("#password").val()
            let password_con = $("#password").val()
            let checkMail = $("#mailChecker").text()
            var token = $('input[name=_token]').val()

            if(name.length<3)alert("Please Enter Name")
            else if(name.length>=3 && checkMail==='false')alert($("#mailStatus").text()!='' ? $("#mailStatus").text() : "Please Enter a Valid Email Address")
            else if(password.length<8)alert("Please Enter Password and Password length at least 8 char")
            else{
                 $.ajax({
                    url: "{{ route('loginresigter') }}",
                    type: 'POST',
                    data: {
                        apikey: "$2y$10$aiOUwJNSAOK6FkEyaxap5uhfXeWwUGlzRWm5N7IaayFfBnS4OKAj2",
                        name: name,
                        email:  email,
                        password: password,
                    },
                    success: function (data) {
                        if(data=!0 || data.email.length!=0){
                            $("#showMsg, #showMsg2").text("Registration Successfull");
                            $("#name").val('')
                            $("#email").val('')
                            $("#password").val('')
                        }
                    }
                })
            }
        })
    </script>

<script>
$("#email").on('change click keyup', function(){
    let email = $(this).val();
     $.ajax({
        url: "{{ route('checkmail') }}",
        type: 'GET',
        dataType: 'json',
        data:{
            email: $(this).val()
        },
        success: function (dataParent) {
                $("#mailStatus").text('')
                 $.ajax({
                url: 'https://emailverification.whoisxmlapi.com/api/v1',
                type: 'GET',
                dataType: 'json',
                data: {
                    apiKey: 'at_8NpsKkjYvNLH2wohI7HhzbQi762sx',
                    emailAddress: email
                },
                success: function (data) {
                    if (data.smtpCheck == 'true' && dataParent!=1) {
                         $("#mailChecker").text('true')
                       $("#mailStatus").text('Yes! You are perfect!!') 
                    }else if(data.smtpCheck == 'true' && dataParent===1){
                        $("#mailChecker").text('false')
                        $("#mailStatus").text('This emial has already been taken! Please try another email address') 
                    }else if(data.smtpCheck == 'false'){
                         $("#mailChecker").text('false')
                        $("#mailStatus").text('This emial is not valid!! Please Enter a valid email address') 
                    }else{ 
                         $("#mailChecker").text('false')
                        $("#mailStatus").text('') 
                    }
                }
            })
        }
    })
    
})

</script>
@endpush
