@extends('layouts.frontend.app')

@push('css')
<style>
    p{
        font-size: 20px;
    }
</style>    
@endpush

@section('left-section')
    <div id="viewBlogs">
        <div class="card rounded-0 mb-2 shadow">
            <div class="card-header">
                <h3><b>Q. {{ $question->question }}</b></h3>
                <span class="text-muted">{{ $question->created_at->diffForHumans() }} | Share | views {{ $question->view }} | Answer | Porgress</span>
            </div>
        </div>

        <div class="card rounded-0 shadow">
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
        </div>

@if(Auth::check())
         <div class="card rounded-0 mt-2 shadow">
            <div class="card-header"><h2>Leave an answer</h2></div>
            <div class="card-header">
                <textarea v-model="ansBody" class="form-control rounded-0" rows="4" placeholder="Write your answer....."></textarea>
                <button v-on:click="newAnswer()" class="btn btn-primary rounded-0 mt-2">leave answer</button>
            </div>
        </div>

        <div class="card rounded-0 my-2 shadow" v-for="answer in answers" v-if="answer.id!=ansDeleteId">
            <div class="card-header">
               <div class="media">
                <img src="https://sb-content-file.s3-ap-northeast-1.amazonaws.com/smallbridge_favicon.png" class="mr-3" alt="..." width="70px">
                <div class="media-body">
                    <h4 class="m-0 d-inline-block">@{{ answer.user.name }}</h4> 
                    <button class="btn btn-outline-danger btn-sm float-right rounded-0" v-if="user.id===answer.user.id" v-on:click="deleteAns(answer.id)"><i class="fas fa-trash"></i></button>

                    <button class="btn btn-sm btn-outline-info rounded-0 float-right mr-1" v-if="user.id===answer.user.id" v-on:click="openUpdateBox(answer.id, answer.answer)" data-toggle="modal" data-target="#staticBackdrop"><i class="fas fa-edit"></i></button>
                    <br>
                    <small>@{{ answer.created_at | diffForJobayer}}</small>
                    <p class="mt-2"> @{{ answer.answer }} </p>
                </div>
                </div>
            </div>
        </div>
@else
        <div class="card rounded-0 mt-2 shadow">
            <div class="card-header"><h4>Please <a href="{{ route('login') }}">Login</a> to see ths answers ans leave an answer</h4></div>
        </div>
@endif


{{-- Answer Update Modal --}}
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog  modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <textarea v-model="ansUpdateBox" class="form-control rounded-0" rows="4" placeholder="Write your answer....."></textarea>
        <button v-on:click="updateAnswer()" class="btn btn-success rounded-0 mt-2">update answer</button>
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
            el: "#viewBlogs",
            data: {
                id: {!!$question->id!!},
                answers: {},
                user: {!! Auth::check() ? Auth::user()->toJson() : null !!},
                ansBody: '',
                ansDeleteId: '',
                ansUpdateBox: '',
                updateAnsId: ''
            },
            mounted() {
                this.laravelEcho();
                this.getAns()
                this.dfHuman()    
            },
            methods: {
                async dfHuman(){
                    Vue.filter('diffForJobayer', function(value){
                        return moment(value).fromNow();
                    })
                },
                async laravelEcho() {
                    Echo.join('active-user')
                        .here((e) => {
                            console.log(e)
                        })
                    Echo.channel('new-answer.'+this.id)
                        .listen('AnswerEvent', (res)=>{
                            this.answers.unshift(res.answer)
                        })
                    Echo.channel('update-answer.'+this.id)
                        .listen('UpdateAnswerEvent', (res)=>{
                            this.answers.find(ans => ans.id===res.answer.id ? ans.answer=res.answer.answer : '')
                        })
                    // Echo.channel('delete-answer.'+this.id)
                    //     .listen('DeleteAnswerEvent', (res)=>{
                    //         let index = this.answers.findIndex(ans => ans.id===res.answer)
                    //         this.answers.splice(index,1)
                    //     })
                },

                async getAns(){
                axios
                    .get('/api/question/answer/'+this.id)
                    .then((res) => {
                        this.answers = res.data
                    })
                },
                async newAnswer(){
                    axios
                     .post('/api/question/answer',{
                         api_token: this.user.api_token,
                         id: this.user.id,
                         qid: this.id,
                         answer: this.ansBody
                     })
                    .then((res) => {
                        if(this.answers.id===res.data.id)
                        this.answers.unshift(res.data)
                        this.ansBody = ''
                    })
                },

                async openUpdateBox(id, ans){
                    this.ansUpdateBox = ans
                    this.updateAnsId = id
                },

                async updateAnswer(){
                    await axios
                    .post('/api/update-answer/',{
                        id: this.updateAnsId,
                        answer: this.ansUpdateBox
                    })
                    .then((res)=>{
                        this.answers.find(ans => ans.id === this.updateAnsId ? ans.answer = res.data.answer: '')  
                        $('#staticBackdrop').modal('hide')
                    })
                },

                async deleteAns(id){
                    this.ansDeleteId = id
                    axios
                    .delete('/api/delete-answer/'+id)
                    .then((res)=>{
                        this.ansDeleteId = id
                        let index = this.answers.findIndex(ans => ans.id == id)
                        this.answers.splice(index,1)
                    })
                }

            }
        })

    </script>
@endpush
