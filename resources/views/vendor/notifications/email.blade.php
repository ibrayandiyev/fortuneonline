@component('mail::message')
{{-- Greeting --}}
@if (! empty($greeting))
# {{ $greeting }}
@else
@if ($level === 'error')
# @lang('Whoops!')
@else

@endif
@endif

{{-- Intro Lines --}}
@foreach ($introLines as $line)

<p style="font-size: 20px; font-family: 'Titillium Web', sans-serif; color: #4d4d4d; margin: 0px; line-height: 1.5em; text-align:center;">
    {{ $line }}
</p>
@endforeach

{{-- Action Button --}}
@isset($actionText)
<?php
    switch ($level) {
        case 'success':
        case 'error':
            $color = $level;
            break;
        default:
            $color = 'primary';
    }
?>
@component('mail::button', ['url' => $actionUrl, 'color' => $color])
{{ $actionText }}
@endcomponent
@endisset

{{-- Outro Lines --}}
@foreach ($outroLines as $line)
<p style="font-size: 16px; font-family: 'Titillium Web', sans-serif; color: #4d4d4d; margin: 0px; line-height: 1.5em; text-align:center;">
    {{ $line }}
</p>
@endforeach

{{-- Subcopy --}}
@isset($actionText)
@slot('subcopy')
@lang(
    "Si no puede verificar con el botón \":actionText\",".
    'copia y pega la siguiente ruta e ingreselo en su navegador: [:actionURL](:actionURL)',
    [
        'actionText' => $actionText,
        'actionURL' => $actionUrl,
    ]
)
@endslot
@endisset

@endcomponent
