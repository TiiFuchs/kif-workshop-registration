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
                           value="{{ old('name') }}"
                           autocomplete="off" autocorrect="off" autocapitalize="off">
                    <span class="help-block">Bitte gib deinen Nickname genauso wie auf deinem Namensschild an.</span>
                </div>
                <div class="form-group">
                    <label for="uni">Universität</label>
                    <input type="text" name="uni" id="uni" class="form-control" placeholder="Universität"
                    value="{{ old('uni') }}">
                </div>
                <div class="form-group">
                    <label for="email">E-Mail Adresse</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="E-Mail Adresse"
                    value="{{ old('email') }}"
                    autocomplete="off" autocorrect="off" autocapitalize="off">
                    <span class="help-block">Wenn wir dich über spontane Änderungen benachrichtigen sollen, gib uns eine E-Mail Adresse.</span>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="workshops[]" value="ebd">
                        EBD Workshop
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="workshops[]" value="theater">
                        Theatervorführung
                    </label>
                </div>
                <button type="submit" class="btn btn-primary">Anmelden</button>
            </form>

        </div>
    </div>


@stop
