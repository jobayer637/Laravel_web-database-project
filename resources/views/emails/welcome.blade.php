@component('mail::message')
# Hey! {{ $user->name }}

Welcome to my blog site

@component('mail::button', ['url' => 'http://127.0.0.1:8000/home'])
Goto Home Page
@endcomponent

Admin: Jobayer Hossain<br>
Department of CSE, BUBT <br>
@component('mail::button', ['url' => 'https://web.skype.com/8:live:web.jobayer?inviteId=iGQk8oD5iiVj'])
Skype
@endcomponent

@endcomponent
