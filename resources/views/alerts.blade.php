<div class="mt-3 mb-3">

@if(session('success'))
<div class="bg-[#DCFCE7] text-[#23543F] px-4 py-2 rounded shadow-md mb-4 mt-4">
    {{ session('success') }}
</div>
@endif
@if($errors->any())
<div class="bg-red-200 text-red-800 p-2">
<ul>
    @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
</ul>
</div>
@endif

</div>
