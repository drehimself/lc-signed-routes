@component('mail::message')
# Confirm appointment

Please confirm your appointment for {{ $appointment->appointment_date->format('M d, Y, h:i:s A') }}

@component('mail::button', ['url' => $link])
Confirm appointment
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
