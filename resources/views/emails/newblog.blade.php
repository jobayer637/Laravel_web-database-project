@component('mail::message')
# SUGGEST YOU A NEW BLOG

Blog title: {{ $blog->title }} <br>

Created by: {{ $blog->user->name }}<br>

{{ $blog->created_at->diffForHumans() }}

@component('mail::button', ['url' => 'http://127.0.0.1:8000/view-blog/'.$blog->id])
New Blog 
@endcomponent

Admin: Jobayer Hossain <br>
Dept. of CSE, BUBT
@endcomponent
