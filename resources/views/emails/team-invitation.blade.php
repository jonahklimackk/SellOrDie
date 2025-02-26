@component('mail::message')
{{ __('You have been challenged to the ":team" fight!', ['team' => $invitation->team->name]) }}

@if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::registration()))
{{ __('If you do not have a sell or die  account, you may can create one for free by clicking the button below. After creating an account, you may click the challenge acceptance button in this email to accept the fight invitation:') }}

@component('mail::button', ['url' => $affiliateLink])
{{ __('Create Account') }}
@endcomponent

{{ __('If you already have an account, you may accept this challenge by clicking the button below:') }}

@else
{{ __('You may accept this challenge by clicking the button below:') }}
@endif


@component('mail::button', ['url' => $acceptUrl])
{{ __('Accept Challenge') }}
@endcomponent

{{ __('If you did not expect to receive a challenge to this fight, you may discard this email.') }}
@endcomponent
