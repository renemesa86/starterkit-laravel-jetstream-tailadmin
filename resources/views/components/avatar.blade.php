@props(['photopath','userid','username','w','h','routeName'])

@if ($photopath != null)
@if ($routeName != '#')
<a href="{{ route($routeName, ['id' => $userid]) }}">
    @endif
    <img class="{{ $w }} {{ $h }} mx-auto rounded-full"
        src="{{ Str::startsWith($photopath, 'http') ? $photopath : asset('storage/'.$photopath) }}"
        alt="{{ $username }}" title="{{ $username }}">
    </img>
    @if ($routeName != '#')
</a>
@endif
@else
@if ($routeName != '#')
<a href="{{ route($routeName, ['id' => $userid]) }}">
    @endif
    <img src="/storage/profile-photos/emptyUser.jpg"
        class="{{ $w }} {{ $h }} bg-gray-300 rounded-full  shrink-0 mx-auto"
        title="{{ $username }}" alt="{{ $username }}">
    </img>
    @if ($routeName != '#')
</a>
@endif
@endif
