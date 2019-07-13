@component('mail::message')
# Reset Account
<h1>Welcome, {{$data['data']->name }}</h1>
<p>You have requested To Reset Your Password , so to Change Your Password Successfully Click the Link below.</p>
@component('mail::button', ['url' => admin_routes('password/reset/'.$data['token'])])
Click Here
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
