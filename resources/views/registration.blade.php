@extends("layouts.blank")

@section("content")

    <div class="row">
        <div class="col-sm-6 col-md-4">

            @if (count($errors) > 0)
                <div class="alert alert-warning">
                    <ul class="list-unstyled">
                        @foreach ($errors->all() as $error)
                            <li>{!! $error !!}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @foreach ($messages as $message)
                <p class="alert alert-{{ $message->class }}">{!! $message->text !!}</p>
            @endforeach

            <form action="{{ url('/participate') }}" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="name">Nickname</label>
                    <input class="form-control" type="text" name="name" id="name" placeholder="Nickname"
                           autocomplete="off" autocorrect="off" autocapitalize="off"
                           @if(!$isActive) disabled @endif
                           value="{{ old('name') }}">
                    <span class="help-block">Bitte gib deinen Nickname genauso wie auf deinem Namensschild an.</span>
                </div>
                <div class="form-group">
                    <label for="uni">Universität</label>
                    <input type="text" name="uni" id="uni" class="form-control" placeholder="Universität"
                           @if(!$isActive) disabled @endif
                           value="{{ old('uni') }}">
                </div>
                <div class="form-group">
                    <label for="email">E-Mail Adresse</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="E-Mail Adresse"
                           autocomplete="off" autocorrect="off" autocapitalize="off"
                           @if(!$isActive) disabled @endif
                           value="{{ old('email') }}">
                    <span class="help-block">Wenn wir dich über spontane Änderungen benachrichtigen sollen, gib uns eine E-Mail Adresse.
                        Dies ist insbesondere dann nützlich, wenn du auf der Warteliste stehst und spontan ein Platz frei wird.</span>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="workshops[]" value="ebd"
                               @if(!$isActive) disabled @endif>
                        EBD Workshop
                    </label>
                    <span class="help-block">
                        Treffen: Fr, 9:00 Uhr im KIF Café.
                    </span>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="workshops[]" value="theater"
                               @if(!$isActive) disabled @endif>
                        Theatervorführung
                    </label>
                    <span class="help-block">
                        Treffen: Fr, 18:45 Uhr im KIF Café.
                    </span>
                </div>
                <button type="submit" class="btn btn-primary"
                        @if(!$isActive) disabled @endif>
                    Anmelden</button>
            </form>

        </div>
    </div>


@stop
