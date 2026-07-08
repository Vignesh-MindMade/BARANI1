{{-- resources/views/partials/team-tree.blade.php --}}
@foreach($teams as $team)
    <li>
        <div class="person">
            <img src="{{ $team->image ? asset('images/team/' . $team->image) : asset('assets/imgs/team/1.png') }}" alt="{{ $team->name }}">
            <h5>{{ $team->name }}</h5>
            <p>{{ $team->designation }}</p>
        </div>
        @if($team->children && $team->children->count() > 0)
            <ul>
                @include('partials.team-tree', ['teams' => $team->children])
            </ul>
        @endif
    </li>
@endforeach