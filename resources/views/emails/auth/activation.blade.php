@component('mail::message')
# Activate your account

Thank you for signing up, please activate your account.

@component('mail::button', ['url' => ''])
Activate
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
