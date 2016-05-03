@extends("layouts.blank")

@section("content")

    <div class="row">
        <div class="col-md-4">

            @foreach ($messages as $msg)
                <p class="alert alert-{{$msg->type}}">{{ $msg->text }}</p>
            @endforeach

            <form action="{{ url('/participate') }}" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="name">Name</label>
                    <input class="form-control" type="text" name="name" id="name" placeholder="Name"
                    value="{{ old('name') }}">
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
