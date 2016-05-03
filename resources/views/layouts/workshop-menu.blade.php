@can('generate-lists')

<ul class="nav navbar-nav">
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
            EBD-Workshop <span class="caret"></span>
        </a>

        <ul class="dropdown-menu" role="menu">
            <li><a href="{{ url('/list/ebd/30?mode=fcfs') }}">First Come First
                    Serve</a></li>
            <li><a href="{{ url('/list/ebd/30?mode=shuffle') }}">Shuffle</a></li>
        </ul>
    </li>


    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
            Theatervorführung <span class="caret"></span>
        </a>

        <ul class="dropdown-menu" role="menu">
            <li><a href="{{ url('/list/theater/30?mode=fcfs') }}">First Come First
                    Serve</a></li>
            <li><a href="{{ url('/list/theater/30?mode=shuffle') }}">Shuffle</a>
            </li>
        </ul>
    </li>
</ul>

@endcan