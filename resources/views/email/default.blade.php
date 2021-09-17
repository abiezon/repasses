@component('mail::message')
    # {{$title}}

    {{$message_header}} **{{$name}}**, {{-- break line --}}

    Um novo repasse foi publicado para seu acompanhamento. {{-- break line --}}
    
    Obrigado, {{-- break line --}}
    {{ config('app.name') }}
@endcomponent