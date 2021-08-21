@props(['errors'])

@if ($errors->any())
    <div {{ $attributes }}>
        <div class="text-lg text-danger">
            {{ __('Whoops! Something went wrong.') }}
        </div>

        <ul class="text-sm text-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
