<div>
    <div id="alert" class="card text-white shadow mb-3 bg-{{ $type }}">
        <div class="card-body">
            @if ($type === 'danger')
                @if (count($message) === 1)
                    <i class="fas fa-exclamation-triangle"></i> {{ $message[0] }}
                @else 
                    Something went wrong !
                    <ul class="m-0">
                        @foreach ($message as $msg)
                            <li>{{ $msg }}</li>
                        @endforeach
                    </ul>
                @endif 
            @endif

            @if ($type === 'success')
                <i class="fas fa-check"></i>&nbsp; {{ $message }}
            @endif
        </div>  
    </div>
</div>