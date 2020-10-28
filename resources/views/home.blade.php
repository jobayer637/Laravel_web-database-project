@extends('layouts.frontend.app')

@push('css')
    <style>
        p{
            font-size: 18px;
        }
    </style>
@endpush

@section('left-section')
    <div id="homeApp">
        @foreach ($blogs as $blog)
        <div class="card rounded-0 mb-2 shadow-sm">
            <div class="card-header py-4">
                <h3 class="my-0 text-secondary"  type="button"><b>{{ $blog->title }}</b></h3>
                <span>
                    <small>{{ $blog->user->name }}</small> | 
                    <small>{{ $blog->created_at->diffForHumans() }}</small>
                </span>
                <p  class="mt-3 text-reset">{{ \Illuminate\Support\Str::limit($blog->body, 220, $end='...') }}</p>
                <a href="{{ route('view-blog',$blog->id) }}" class="btn btn-danger rounded-0">READ MORE</a>
            </div>
        </div>
        @endforeach
        {{ $blogs }}
    </div>
@endsection


@push('js')
    <script>
        var app = new Vue({
            el: "#homeApp",
            data: {
                qbody: ''
            },
            mounted() {
                this.activeUser();
                this.diffForHuman()
            },
            methods: {
                activeUser() {
                    Echo.join('active-user')
                        .here((e) => {
                            console.log(e)
                        })
                },

                diffForHuman() {
                    Vue.filter('diffForHuman', function(v) {
                        return moment(v).fromNow();
                    })
                },

                nextPage(id){
                    
                }
            }
        })

    </script>
@endpush
