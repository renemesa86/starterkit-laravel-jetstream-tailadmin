<x-app-layout>
    <x-slot name="header">
        <x-header title="Listado de Usuarios"></x-header>
    </x-slot>

    <div>
        <div class="max-w-6xl mx-auto py-6 px-6 lg:px-8">
            <div class="flex justify-end pb-3">
                <a href="{{ route('users.create') }}"
                    class="bg-green-500 hover:bg-green-700 text-white py-2 px-4 rounded text-sm">
                    Agregar Usuario</a>
            </div>
            <div class="flex flex-col">

                <div class="mr-auto py-3">
                    <form action="{{ route('users.index') }}" method="get" name="form1">
                        @csrf 
                        <div class="flex gap-3">
                            <div><x-input type="text" name="search" placeholder="Buscar" /></div>
                            <div class="flex items-center"><x-button type="submit" name="buscar" value="Buscar">Buscar</x-button></div>
                            
                        </div>
                    </form>
                </div>

                @include('alerts')

                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg mx-2 sm:mx-0">

                            <div
                                class="encabezado sm:flex max-w-7xl w-full bg-white content-between 
                                items-center border-b hidden ">
                                <div class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 w-[1rem] ">#</div>
                                <div class="text-sm  w-[3rem]"> Logo </div>
                                <div class="text-sm flex-1 pl-3">Nombre</div>
                                <div class="text-sm flex-1 pl-3"> Email </div>
                                <div class="text-sm flex-1 px-3 "> Email verified at </div>
                                <div class="text-sm flex-1 text-left pl-3"> Roles </div>
                                <div class="text-sm flex-1 text-left"> </div>
                            </div>
                            @foreach ($users as $user)
                                <div
                                    class="content flex flex-col sm:flex-row max-w-7xl w-full bg-white content-between  
                            items-center border-b ">
                                    <div
                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 w-[1rem] hidden sm:flex">
                                        {{ $user->id }}
                                    </div>
                                    <div class="text-sm text-left w-[3rem] h-20 sm:h-auto flex items-center">
                                           

                                            <x-avatar 
                                            photopath="{{ $user->profile_photo_path }}" 
                                            userid="{{ $user->id }}"
                                            username="{{ $user->name }}"
                                            w="w-8"
                                            h="h-8"
                                            routeName="#"
                                            > 
                                            </x-avatar>

                                    </div>
                                    <div class="text-sm flex-1 pl-3">{{ trim($user->name) }}</div>
                                    <div class="text-sm flex-1 pl-3 sm:flex"> {{ $user->email }} </div>
                                    <div class="text-sm text-left flex-1 px-3"> {{ $user->email_verified_at }}  </div>
                                    <div class="text-sm text-left flex-1 pl-3 "> 
                                        @foreach ($user->roles as $role)
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                {{ $role->title }}
                                            </span>
                                        @endforeach
                                   </div>
                                    <div class="text-sm text-center flex-1 p-5 sm:p-0">
                                      
                                        <a href="{{ route('users.edit', $user->id) }}"
                                            class="text-indigo-600 hover:text-indigo-900 mb-2 mr-2">Editar</a>
                                        <form class="inline-block"
                                            action="{{ route('users.destroy', $user->id) }}" method="POST"
                                            onsubmit="return confirm('¿Está seguro?');">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="submit"
                                                class="text-red-600 hover:text-red-900 mb-2 mr-2"
                                                value="Eliminar">
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                 
                            <div class="flex flex-col justify-center px-3 py-5">
                                {{ $users->links() }}
                            </div>

                        </div>
                    </div>
                </div>
 

               
            </div>

        </div>
    </div>
</x-app-layout>
