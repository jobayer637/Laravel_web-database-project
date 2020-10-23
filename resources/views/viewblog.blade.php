@extends('layouts.frontend.app')

@push('css')
<style>
    p{
        font-size: 17px;
        line-height: 35px;
    }
</style>    
@endpush

@section('left-section')
    <div id="viewBlogApp">
        <div class="card rounded-0 mb-2 shadow">
            <div class="card-header">
                <h3 class="text-muted"><b>{{ $blog->title }}</b></h3>
                <span class="text-success">{{ $blog->created_at->diffForHumans() }} &nbsp;|&nbsp; {{ $blog->user->name }}</span>
                <p class="mt-3">{{ $blog->body }}</p>
            </div>
        </div>


        {{-- <div class="card rounded-0 shadow">
            <div class="card-header">
                <h4>Related Questions</h4>
                @foreach ($relQues as $item)
                    @if ($item->id!=$question->id)
                        <h5 class="">
                            <a href="{{ route('view-question',$item->id) }}">{{ $item->question }}</a>
                        </h5>
                    @endif
                @endforeach
            </div>
        </div> --}}

@if(Auth::check())
         <div class="card rounded-0 mt-2 shadow">
            <div class="card-header"><h2>Leave c comment</h2></div>
            <div class="card-header">
                <textarea v-model="commentBox" class="form-control rounded-0" rows="4" placeholder="Write your comment....."></textarea>
                <button v-on:click="newComment()" class="btn btn-primary rounded-0 mt-2">leave a comment</button> <small class="ml-4">@{{ status }}</small>
            </div>
        </div>

        <div class="card rounded-0 my-2 shadow" v-for="comment in comments">
            <div class="card-header">
               <div class="media">
                <img src="https://sb-content-file.s3-ap-northeast-1.amazonaws.com/smallbridge_favicon.png" class="mr-3" alt="..." width="70px">
                <div class="media-body">
                    <h4 class="m-0 d-inline-block">@{{ comment.user.name }}</h4> 
                    <button class="btn btn-outline-danger btn-sm float-right rounded-0" v-if="user.id===comment.user.id" v-on:click="deleteComment(comment.id)"><i class="fas fa-trash"></i></button>

                    <button class="btn btn-sm btn-outline-info rounded-0 float-right mr-1" v-if="user.id===comment.user.id" v-on:click="openUpdateBox(comment.id, comment.comment)" data-toggle="modal" data-target="#staticBackdrop"><i class="fas fa-edit"></i></button>
                    <br>
                    <small>@{{ comment.created_at | diffForHuman}}</small>
                    <p class="mt-2"> @{{ comment.comment }} </p>
                </div>
                </div>
            </div>
        </div>
@else
        <div class="card rounded-0 mt-2 shadow">
            <div class="card-header"><h4>Please <a href="{{ route('login') }}">Login</a> to see ths answers ans leave an answer</h4></div>
        </div>
@endif

{{-- AnswerUpdateModal --}}
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog  modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Update Your Comment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <textarea v-model="commentUpdateBox" class="form-control rounded-0" rows="4" placeholder="Write your answer....."></textarea>
        <button v-on:click="updateComment()" class="btn btn-success rounded-0 mt-2">update comment</button>
        <button class="btn btn-warning rounded-0 mt-2"data-dismiss="modal">cancel</button>
      </div>
    </div>
  </div>
</div>
{{-- End Answer Update Modal --}}
</div>
@endsection

@push('js')
    <script>
        var viewBlog = new Vue({
            el: "#viewBlogApp",
            data: {
                comments: {},
                commentBox: '',
                blogId: {!! $blog->id !!},
                user: {!! Auth::check() ? Auth::user() : null !!},
                status: '',
                commentUpdateBox: '',
                updateCommentId: ''
            },
            mounted() {
                this.getComments()
                this.dfHuman()
                this.laravelEcho()
            },
            methods: {
                async dfHuman(){
                    Vue.filter('diffForHuman', function(value){
                        return moment(value).fromNow();
                    })
                },
                async laravelEcho() {
                    Echo.join('active-user')
                        .here((e) => {
                            console.log(e)
                        })

                    Echo.channel('new-comment.'+this.blogId)
                        .listen('NewCommentEvent', (res)=>{
                            this.comments.unshift(res.comment)
                        })
                },

                async getComments(){
                    await axios
                    .get('/api/get-comments/'+this.blogId)
                    .then((res) => {
                        this.comments = res.data
                    })
                },

                async newComment(){
                    await axios
                    .post('/api/new-comment',{
                        api_key: this.user.api_key,
                        comment: this.commentBox,
                        userId: this.user.id,
                        blogId: this.blogId,
                        id: this.blogId
                    })
                    .then((res) => {
                        this.status = 'Comment Successfully Added'
                        if(this.updateCommentId===res.comment.id)
                            this.comments.unshift(res.data)
                        this.commentBox = ''
                    })
                },

                deleteComment(id){
                    axios
                    .delete('/api/delete-comment/'+id)
                    .then((res)=>{
                        this.status = 'Comment Successfully Deleted'
                        let index = this.comments.findIndex(com => com.id===id)
                        this.comments.splice(index,1)
                    })
                },

                openUpdateBox(id, comment){
                    this.updateCommentId = id
                    this.commentUpdateBox = comment
                },
                updateComment(){
                    $("#staticBackdrop").modal('hide')
                    axios
                    .put('/api/update-comment',{
                        api_key: this.user.api_key,
                        id: this.updateCommentId,
                        comment: this.commentUpdateBox
                    })
                    .then((res) => {
                        this.comments.find(com => com.id===res.data.id ? com.comment=res.data.comment :'11')
                    })
                }

            }
        })

    </script>
@endpush
