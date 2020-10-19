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
                    <div class="card-header">
                        <button class="btn btn-outline-primary rounded-0 w-100 mb-2" data-toggle="modal"
                            data-target="#apiModal">API Management</button>
                        <button class="btn btn-outline-primary rounded-0 w-100 mb-2" data-toggle="modal"
                            data-target="#userModal">User Management</button>
                        <button class="btn btn-outline-primary rounded-0 w-100 mb-2" data-toggle="modal"
                            data-target="#blogModal">Blog Management</button>
                        <button class="btn btn-outline-primary rounded-0 w-100 mb-2" data-toggle="modal"
                            data-target="#questionModal">Question Management</button>
                        <button class="btn btn-outline-primary rounded-0 w-100 mb-2" data-toggle="modal"
                            data-target="#blogCategoryModal">Blog Category Management</button>
                        <button class="btn btn-outline-primary rounded-0 w-100 mb-2" data-toggle="modal"
                            data-target="#questionCategoryModal">Question Category Management</button>
                    </div>
                </div>

                <div class="card rounded-0 mt-4">
                    <div class="card-header rounded-0 text-center">Active Users <example-component></example-component> </div>
                    <div class="card rounded-0 p-3 bg-light">
                        @foreach($users as $user)
                            <div class="card-header rounded-0 mb-1 py-1 px-2 border" style="position:relative;">
                                <strong class="text-muted m-0 p-0 d-inline-block">{{$user->name}}</strong>
                                <small id="auid_{{$user->id}}" data-id="{{$user->id}}" class="activeUser badge badge-info text-white aus">offline</small>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- <example-component></example-component> -->

            </div>
            <div class="col-md-9">

                <div class="card rounded-0">
                    <div class="card-header text-center"><h4>{{ __('User Dashboard') }} &nbsp;&nbsp; {{ Auth::user()->email }}</h4></div>
                </div>

                <div class="row my-3">
                    <div class="col-md-4 my-2">
                        <div class="card rounded-0">
                            <div class="card-header text-center">
                               <h4>Total Usrs {{ count($users) }}</h4>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 my-2">
                        <div class="card rounded-0">
                            <div class="card-header text-center">
                               <h4>Total Blogs {{ count($blogs) }}</h4>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 my-2">
                        <div class="card rounded-0">
                            <div class="card-header text-center">
                               <h4>Total Questions {{ count($questions) }}</h4>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 my-2">
                        <div class="card rounded-0">
                            <div class="card-header text-center">
                               <h4>Total Blog Category {{ count($blogCategorirs) }}</h4>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 my-2">
                        <div class="card rounded-0">
                            <div class="card-header text-center">
                               <h4>Total Question Category {{ count($questionCategories) }}</h4>
                            </div>
                        </div>
                    </div>

                </div>


                {{-- API modal --}}
                <div class="modal fade" id="apiModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content rounded-0">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Api Management</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
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
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary rounded-0"
                                    data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- End API modal --}}


                {{-- User modal --}}
                <div class="modal fade" id="userModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content rounded-0">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">User Management</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="card rounded-">
                                    <div id="showMsg" class="card-header rounded-0 text-center text-danger"></div>
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col">id</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Role</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($users as $user)
                                                <tr>
                                                    <th>{{ $user->id }}</th>
                                                    <td>{{ $user->name }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>{{ $user->role->role }}</td>
                                                    @if ($user->role->id == 2)
                                                        <td>
                                                            @csrf
                                                            @method('DELETE')
                                                            <button
                                                                data-route="{{ route('user-management.destroy', $user->id) }}"
                                                                class="userDeleteBtn btn btn-sm btn-warning rounded-0">Delete</button>
                                                        </td>
                                                    @else
                                                    <td>
                                                        <button class="btn btn-primary rounded-0 btn-sm">You are
                                                            admin</button>
                                                    </td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary rounded-0"
                                    data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- End User modal --}}


                {{-- Blog modal --}}
                <div class="modal fade" id="blogModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content rounded-0">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Blog Management</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="card rounded">
                                    <div class="row no-gutters">
                                        <div class="col-md-6">
                                            <button class="btn w-100 btn-info rounded-0 collapsed" data-toggle="collapse"
                                                data-target="#collapseOne" aria-expanded="true">All Blog</button>
                                        </div>
                                        <div class="col-md-6">
                                            <button class="btn w-100 btn-warning rounded-0 collapsed" data-toggle="collapse"
                                                data-target="#collapseTwo" aria-expanded="false"
                                                aria-controls="collapseTwo"><i class="fas fa-plus-square"></i> &nbsp; Add
                                                New Blog</button>
                                        </div>
                                    </div>

                                    <div class="accordion" id="accordionExample4">
                                        <div class="card rounded-0 bg-light">
                                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                                data-parent="#accordionExample4">
                                                <div class="card-body px-0 mt-0">
                                                    <p id="blogDeleteMsg" class="text-center text-success"></p>
                                                    <div class="table-responsive-sm">
                                                        <table class="table table-hover rounded-0">
                                                            <thead>
                                                                <tr class="">
                                                                    <th scope="col">id</th>
                                                                    <th scope="col">User</th>
                                                                    <th scope="col">Category</th>
                                                                    <th scope="col">Title</th>
                                                                    <th scope="col">Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($blogs as $blog)
                                                                    <tr>
                                                                        <td scope="col">{{ $blog->id }}</td>
                                                                        <td scope="col">{{ $blog->user->name }}</td>
                                                                        <td scope="col">{{ $blog->category->name }}</td>
                                                                        <td scope="col">{{ $blog->title }}</td>
                                                                        <td scope="col">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button data-route="{{ route('manage-blog.destroy', $blog->id) }}"
                                                                                class="blogDeleteBtn btn btn-sm btn-warning rounded-0">Delete</button>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card">
                                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                                data-parent="#accordionExample4">
                                                <div class="card-body">
                                                    <form>
                                                        @csrf
                                                        <div class="input-group mb-2">
                                                            <button readonly disabled class="btn btn-info rounded-0">Select
                                                                Category *</button>
                                                            <select id="blogCategory" class="form-control rounded-0">
                                                                <option value="0">Select a Category</option>
                                                                @foreach ($blogCategorirs as $cats)
                                                                    <option value="{{ $cats->id }}">{{ $cats->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="input-group mb-2">
                                                            <button readonly disabled class="btn btn-info rounded-0">Write
                                                                Blog Title *</button>
                                                            <input id="blogTitle" type="text"
                                                                class="form-control rounded-0" name="blogTitle"
                                                                placeholder="Write Your Blog Title">
                                                        </div>

                                                        <div class="input-group mb-2">
                                                            <button readonly disabled
                                                                class="btn btn-info rounded-0">Blog Description:)</button>
                                                            <textarea name="blogBody" rows="5" id="blogBody"
                                                                class="form-control rounded-0"
                                                                placeholder="Write your blog description...."></textarea>
                                                        </div>

                                                        <button type="button" id="addNewBlog"
                                                            class="btn btn-primary rounded-0">Save
                                                            Blog</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div id="newBlogAlert" class="alert alert-success alert-dismissible fade show rounded-0"
                                    role="alert" style="display: none">
                                    <strong id="nbstatus"></strong>
                                    <p id="nbmsg"></p>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <button type="button" class="btn btn-secondary rounded-0"
                                    data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- End Blog modal --}}


                {{-- Question modal --}}
                <div class="modal fade" id="questionModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content rounded-0">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Question Management</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="card rounded">
                                    <div class="row no-gutters">
                                        <div class="col-md-6">
                                            <button class="btn w-100 btn-info rounded-0 collapsed" data-toggle="collapse"
                                                data-target="#collapseOne" aria-expanded="true">All Question
                                                Categories</button>
                                        </div>
                                        <div class="col-md-6">
                                            <button class="btn w-100 btn-warning rounded-0 collapsed" data-toggle="collapse"
                                                data-target="#collapseTwo" aria-expanded="false"
                                                aria-controls="collapseTwo"><i class="fas fa-plus-square"></i> &nbsp; Add
                                                New</button>
                                        </div>
                                    </div>

                                    <div class="accordion" id="accordionExample3">
                                        <div class="card rounded-0 bg-light">
                                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                                data-parent="#accordionExample3">
                                                <div class="card-body px-0 mt-0">
                                                    <p id="quesDeleteMsg" class="text-center text-success"></p>
                                                    <div class="table-responsive-sm">
                                                        <table class="table table-hover rounded-0">
                                                            <thead>
                                                                <tr class="">
                                                                    <th scope="col">id</th>
                                                                    <th scope="col">User</th>
                                                                    <th scope="col">Category</th>
                                                                    <th scope="col">Question</th>
                                                                    <th scope="col">Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($questions as $question)
                                                                    <tr>
                                                                        <td scope="col">{{ $question->id }}</td>
                                                                        <td scope="col">{{ $question->user->name }}</td>
                                                                        <td scope="col">{{ $question->category->name }}</td>
                                                                        <td scope="col">{{ $question->question }}</td>
                                                                        <td scope="col">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button data-route="{{ route('manage-question.destroy', $question->id )}}"
                                                                                class="quesDeleteBtn btn btn-sm btn-warning rounded-0">Delete</button>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card">
                                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                                data-parent="#accordionExample3">
                                                <div class="card-body">
                                                    <form>
                                                        @csrf
                                                        <div class="input-group mb-2">
                                                            <button readonly disabled class="btn btn-info rounded-0">Select
                                                                Category *</button>
                                                            <select id="questionCategory" class="form-control rounded-0">
                                                                <option value="0">Select a Category</option>
                                                                @foreach ($questionCategories as $cats)
                                                                    <option value="{{ $cats->id }}">{{ $cats->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="input-group mb-2">
                                                            <button readonly disabled class="btn btn-info rounded-0">Write
                                                                Question *</button>
                                                            <input id="questionName" type="text"
                                                                class="form-control rounded-0" name="question"
                                                                placeholder="Write Your Question">
                                                        </div>

                                                        <div class="input-group mb-2">
                                                            <button readonly disabled
                                                                class="btn btn-info rounded-0">Question Description</button>
                                                            <textarea name="description" rows="5" id="questionDescription"
                                                                class="form-control rounded-0"
                                                                placeholder="Write a short description...."></textarea>
                                                        </div>

                                                        <button type="button" id="addNewQuestion"
                                                            class="btn btn-primary rounded-0">Save
                                                            Question</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div id="newQuestionAlert" class="alert alert-success alert-dismissible fade show rounded-0"
                                    role="alert" style="display: none">
                                    <strong id="nqstatus"></strong>
                                    <p id="nqmsg"></p>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <button type="button" class="btn btn-secondary rounded-0"
                                    data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- End Question modal --}}


                {{-- Blog Category modal --}}
                <div class="modal fade" id="blogCategoryModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content rounded-0">
                            <div class="modal-header text-center">
                                <h2 class="text-center">Blog Category Management</h2>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="card rounded">
                                    <div class="row no-gutters">
                                        <div class="col-md-6">
                                            <button class="btn w-100 btn-info rounded-0 collapsed" data-toggle="collapse"
                                                data-target="#collapseOne" aria-expanded="true">All Blog Categories</button>
                                        </div>
                                        <div class="col-md-6">
                                            <button class="btn w-100 btn-warning rounded-0 collapsed" data-toggle="collapse"
                                                data-target="#collapseTwo" aria-expanded="false"
                                                aria-controls="collapseTwo"><i class="fas fa-plus-square"></i> &nbsp; Add
                                                New</button>
                                        </div>
                                    </div>

                                    <div class="accordion" id="accordionExample">
                                        <div class="card rounded-0 bg-light">
                                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                                data-parent="#accordionExample">
                                                <div class="card-body px-0 mt-0">
                                                    <table class="table table-hover rounded-0">
                                                        <thead>
                                                            <tr class="">
                                                                <th scope="col">id</th>
                                                                <th scope="col">Name</th>
                                                                <th scope="col">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($blogCategorirs as $cat)
                                                                <tr>
                                                                    <th>{{ $cat->id }}</th>
                                                                    <td>{{ $cat->name }}</td>
                                                                    <td>
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button data-route=""
                                                                            class="userDeleteBtn btn btn-sm btn-warning rounded-0">Delete</button>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card">
                                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                                data-parent="#accordionExample">
                                                <div class="card-body">
                                                    <form>
                                                        @csrf
                                                        <div class="input-group">
                                                            <button readonly disabled class="btn btn-info rounded-0">Add New
                                                                Category</button>
                                                            <input id="blogCategoryName" type="text"
                                                                class="form-control rounded-0" name="name"
                                                                placeholder="Enter Category Name">
                                                            <button type="button" id="addBlogCategory"
                                                                class="btn btn-primary rounded-0">Submit</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <div id="blogCategoryAlert"
                                        class="alert alert-success alert-dismissible fade show rounded-0" role="alert"
                                        style="display: none">
                                        <strong id="bcstatus">Holy guacamole!</strong>
                                        <p id="bcmsg"></p>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <button type="button" class="btn btn-secondary rounded-0"
                                        data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- End Blog Category modal --}}


                {{-- Question Category modal --}}
                <div class="modal fade" id="questionCategoryModal" data-backdrop="static" data-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content rounded-0">
                            <div class="modal-header text-center">
                                <h2 class="text-center">Question Category Management</h2>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="card rounded">
                                    <div class="row no-gutters">
                                        <div class="col-md-6">
                                            <button class="btn w-100 btn-info rounded-0 collapsed" data-toggle="collapse"
                                                data-target="#collapseOne" aria-expanded="true">All Question
                                                Categories</button>
                                        </div>
                                        <div class="col-md-6">
                                            <button class="btn w-100 btn-warning rounded-0 collapsed" data-toggle="collapse"
                                                data-target="#collapseTwo" aria-expanded="false"
                                                aria-controls="collapseTwo"><i class="fas fa-plus-square"></i> &nbsp; Add
                                                New</button>
                                        </div>
                                    </div>

                                    <div class="accordion" id="accordionExample2">
                                        <div class="card rounded-0 bg-light">
                                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                                data-parent="#accordionExample2">
                                                <div class="card-body px-0 mt-0">
                                                    <p id="quesCatDeleteMsg" class="text-center text-success"></p>
                                                    <table class="table table-hover rounded-0">
                                                        <thead>
                                                            <tr class="">
                                                                <th scope="col">id</th>
                                                                <th scope="col">Name</th>
                                                                <th scope="col">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($questionCategories as $cat)
                                                                <tr>
                                                                    <th>{{ $cat->id }}</th>
                                                                    <td>{{ $cat->name }}</td>
                                                                    <td>
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button
                                                                            data-route="{{ route('question-category.destroy', $cat->id) }}"
                                                                            class="quesCatDeleteBtn btn btn-sm btn-warning rounded-0">Delete</button>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card">
                                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                                data-parent="#accordionExample2">
                                                <div class="card-body">
                                                    <form>
                                                        @csrf
                                                        <div class="input-group">
                                                            <button readonly disabled class="btn btn-info rounded-0">Add New
                                                                Category</button>
                                                            <input id="questionCategoryName" type="text"
                                                                class="form-control rounded-0" name="name"
                                                                placeholder="Enter Category Name">
                                                            <button type="button" id="addQuestionCategory"
                                                                class="btn btn-primary rounded-0">Submit</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div id="questionCategoryAlert"
                                    class="alert alert-success alert-dismissible fade show rounded-0" role="alert"
                                    style="display: none">
                                    <strong id="qcstatus"></strong>
                                    <p id="qcmsg"></p>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <button type="button" class="btn btn-secondary rounded-0"
                                    data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- End Question Category modal --}}

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
    {{-- Generate API KEY and Get KEY --}}
    <script>
        $.ajax({
            url: "{{ route('getapi') }}",
            type: 'GET',
            dataType: 'json',
            data: {
                id: $("#generateAPIKEY").data('id')
            },
            success: function(data) {
                data != '' ? $("#apiKey").val(data[0].key) : ''
            }
        })

        $("#generateAPIKEY").on('click', function() {
            $.ajax({
                url: "{{ route('generatekey') }}",
                type: 'GET',
                dataType: 'json',
                data: {
                    id: $(this).data('id')
                },
                success: function(data) {
                    $("#apiKey").val(data.key);
                }
            })
        })

    </script>
    {{-- End Generate API KEY and Get KEY --}}


    {{-- User Management Script using web router --}}
    <script>
        $(".userDeleteBtn").on('click', function() {
            if (!confirm('Are You Sure?')) return false
            $.ajax({
                url: $(this).data('route'),
                type: "DELETE",
                data: {
                    _token: $('input[name=_token]').val()
                },
                success: function(data) {
                    data == 1 ? $("#showMsg").text("Delete Successfull") : $("#showMsg").text(
                        "Delete failed")
                    setTimeout(function() {
                        $("#newQuestionAlert").removeClass('d-block')
                        location.reload();
                    }, 1500)
                }
            })
        })

    </script>
    {{-- End User Management Script using web router --}}


    {{-- Add Blog Category --}}
    <script>
        $("#addBlogCategory").on('click', function() {
            if ($("#blogCategoryName").val().length < 2) {
                alert('category name at least 2 char and not be null')
                return false
            }
            $.ajax({
                url: "{{ route('blog-category.store') }}",
                method: 'post',
                data: {
                    _token: $('input[name=_token]').val(),
                    name: $("#blogCategoryName").val(),
                },
                success: function(data) {
                    if (data == '' || null) {
                        $("#blogCategoryAlert").addClass('d-block')
                        $("#bcstatus").text('Opps!! Failed')
                        $("#bcmsg").text('Failed to inserted new Blog Category')
                         bcm()
                    } else {
                        $("#blogCategoryAlert").addClass('d-block')
                        $("#bcstatus").text('Yes!! Success')
                        $("#bcmsg").text('Successfully inserted new blog category')
                         bcm()
                    }
                    function bcm(){
                        setTimeout(function() {
                            $("#newQuestionAlert").removeClass('d-block')
                            location.reload();
                        }, 1500)
                    }
                }
            })
        })

    </script>
    {{-- End Add Blog Category --}}


    {{-- Question Category Management--}}
    <script>
        $("#addQuestionCategory").on('click', function() {
            if ($("#questionCategoryName").val().length < 2) {
                alert('category name at least 2 char and not be null')
                return false
            }
            $.ajax({
                url: "{{ route('question-category.store') }}",
                method: 'post',
                data: {
                    _token: $('input[name=_token]').val(),
                    name: $("#questionCategoryName").val(),
                },
                success: function(data) {
                    if (data == '' || null) {
                        $("#questionCategoryAlert").addClass('d-block')
                        $("#qcstatus").text('Opps!! Failed')
                        $("#qcmsg").text('Failed to inserted new Question Category')
                    } else {
                        $("#questionCategoryAlert").addClass('d-block')
                        $("#qcstatus").text('Yes!! Success')
                        $("#qcmsg").text('Successfully inserted new Question category')
                    }

                      setTimeout(function() {
                            $("#newQuestionAlert").removeClass('d-block')
                            location.reload();
                        }, 1500)
                }
            })
        })

        //Delete category by id
        $(".quesCatDeleteBtn").on('click', function() {
            if (!confirm('Are You Sure?')) return false
            $.ajax({
                url: $(this).data('route'),
                type: "DELETE",
                data: {
                    _token: $('input[name=_token]').val()
                },
                success: function(data) {
                    console.log(data)
                    data == 1 ? $("#quesCatDeleteMsg").text("Delete Successfull") : $(
                        "#quesCatDeleteMsg").text("Delete failed")
                    setTimeout(function() {
                        $("#newQuestionAlert").removeClass('d-block')
                        location.reload();
                    }, 1500)
                }
            })
        })

    </script>
    {{-- End Question Category Management --}}

    {{-- Question Management(crud) --}}
    <script>
        $("#addNewQuestion").on('click', function() {
            let ques = $("#questionName").val()
            let qcat = $("#questionCategory").val()
            let qdes = $("#questionDescription").val()

            if (qcat === '0') alert("Please select a category");
            else if (ques.length < 5 || ques == '' || ques === null) alert(
                "Please Write Your Question at least 5 char")
            else {
                $.ajax({
                    url: "{{ route('manage-question.store') }}",
                    type: 'post',
                    data: {
                        _token: $('input[name=_token]').val(),
                        question: ques,
                        category: qcat,
                        description: qdes
                    },
                    success: function(data) {
                        if (data == '' || null) {
                            $("#newQuestionAlert").addClass('d-block')
                            $("#nqstatus").text('Opps!! Failed')
                            $("#nqmsg").text('Failed to inserted new Question')
                            nqexit()
                        } else {
                            $("#newQuestionAlert").addClass('d-block')
                            $("#nqstatus").text('Yes!! Success')
                            $("#nqmsg").text('Successfully inserted new Question')
                            nqexit()
                        }

                        function nqexit() {
                            setTimeout(function() {
                                $("#newQuestionAlert").removeClass('d-block')
                                location.reload();
                            }, 1500)
                        }
                    }
                })
            }
        })

        //Delete question by id
        $(".quesDeleteBtn").on('click', function() {
            if (!confirm('Are You Sure?')) return false
            $.ajax({
                url: $(this).data('route'),
                type: "DELETE",
                data: {
                    _token: $('input[name=_token]').val()
                },
                success: function(data) {
                    console.log(data)
                    data == 1 ? $("#quesDeleteMsg").text("Delete Successfull") : $(
                        "#quesDeleteMsg").text("Delete failed")
                    setTimeout(function() {
                        $("#newQuestionAlert").removeClass('d-block')
                        location.reload();
                    }, 1500)
                }
            })
        })


    </script>
    {{-- End Question Management(crud) --}}

    {{-- Blog Management(crud) --}}
    <script>
        $("#addNewBlog").on('click', function() {
            let blogTitle = $("#blogTitle").val()
            let blogCategory = $("#blogCategory").val()
            let blogBody = $("#blogBody").val()

            if (blogCategory === '0') alert("Please select a category");
            else if (blogTitle.length < 5 || blogTitle == '' || blogTitle === null) alert(
                "Please Write Your Blog title at least 5 char")
            else if(blogBody.length<20 || blogBody=='' || blogBody === null)alert("Please Write Your Blog Description at least 20 char")
            else {
                $.ajax({
                    url: "{{ route('manage-blog.store') }}",
                    type: 'POST',
                    data: {
                        _token: $('input[name=_token]').val(),
                        title : blogTitle,
                        category : blogCategory,
                        body : blogBody
                    },
                    success: function(data) {
                        console.log(data)
                        if (data == '' || null) {
                            $("#newBlogAlert").addClass('d-block')
                            $("#nbstatus").text('Opps!! Failed')
                            $("#nbmsg").text('Failed to inserted new Blog')
                            nqexit()
                        } else {
                            $("#newBlogAlert").addClass('d-block')
                            $("#nbstatus").text('Yes!! Success')
                            $("#nbmsg").text('Successfully inserted new Blog')
                            nqexit()
                        }

                        function nqexit() {
                            setTimeout(function() {
                                $("#newQuestionAlert").removeClass('d-block')
                                location.reload();
                            }, 1500)
                        }
                    }
                })
            }
        })

        //Delete blog by id
        $(".blogDeleteBtn").on('click', function() {
            if (!confirm('Are You Sure?')) return false
            $.ajax({
                url: $(this).data('route'),
                type: "DELETE",
                data: {
                    _token: $('input[name=_token]').val()
                },
                success: function(data) {
                    console.log(data)
                    data == 1 ? $("#blogDeleteMsg").text("Delete Successfull") : $(
                        "#blogDeleteMsg").text("Delete failed")
                    setTimeout(function() {
                        $("#newQuestionAlert").removeClass('d-block')
                        location.reload();
                    }, 1500)
                }
            })
        })

    </script>
    {{-- End Blog Management(crud) --}}

@endpush
