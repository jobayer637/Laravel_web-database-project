<div id="rsApps" class="">
    <div class="card rounded-0 shadow-sm">
         <div class="card-header"><h4 class="ml-3 text-center"><b>Recent Five Question</b></h4></div>
        <div class="card-header">
            @foreach (App\Question::latest()->take(5)->get() as $item)
                <ul class="list-group list-group-flush">
                    <a href="{{ url('view-question',$item->id) }}" class="list-group-item bg-light text-decoration-none"> <h5 class="my-1">{{ $item->question }}</h5> </a>
                </ul>
            @endforeach
        </div>
    </div>

    <div class="card rounded-0 my-3 shadow-sm">
        <div class="card-header rounded-0 text-center"> <h5>Active Users </h5> <example-component></example-component></div>
        <div class="card rounded-0 p-3 bg-light">
            @foreach(App\User::all() as $user)
                <div class="card-header rounded-0 mb-1 py-0 px-2 border" style="position:relative;">
                    <strong class="text-muted m-0 p-0 d-inline-block">{{$user->name}}</strong>
                    <small id="auid_{{$user->id}}" data-id="{{$user->id}}" class="activeUser badge badge-info text-white aus" style="padding:1px 3px; right:5px; top:0; bottom:0; position:absolute; height:12px; margin:auto;">offline</small>
                </div>
            @endforeach
        </div>
    </div>

    <div class="card rounded-0 shadow-sm">
        <div class="card-header"><h4 class="ml-3 text-center"><b>Recent Five Blogs</b></h4></div>
        <div class="card-header">
            @foreach (App\Blog::latest()->take(5)->get() as $item)
                <ul class="list-group list-group-flush">
                    <a href="{{ url('view-blog',$item->id) }}" class="list-group-item bg-light text-decoration-none"><h5 class="my-1">{{ $item->title }}</h5> </a>
                </ul>
            @endforeach
        </div>
    </div>

</div>


@push('js')
    <script>
        var rsapp = new Vue({
            el: '#rsApps',
            data:{
                latestQuestions: {},
                href : "",
            },
            mounted(){
                this.getRecentQuestion();
                this.allActUser()
            },
            methods:{
                allActUser(){
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
                },

                getRecentQuestion(){
                    axios
                    .get('/api/recent-question')
                    .then((ques) => {
                        this.latestQuestions = ques.data
                    })
                },
                viewQuestion(id){
                   this.href = `{{ url('view-question/${id}') }}`
                }
            }
        })
    </script>
@endpush
