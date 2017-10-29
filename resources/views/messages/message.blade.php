<img class="img-thumbnail" src="{{ $message->image }}" />

<p class="card-text">
    <div class="text-muted">
        Escrito por:
        <a href="/user/{{ $message->user->username }}">
            {{ $message->user->name }}
        </a>
    </div>

    {{ $message->content }}

    <a href="/message/{{ $message->id }}">
        Leer más
    </a>

    <div class="card-text text-muted float-right">
        {{ $message->created_at }}
    </div>
</p>
