<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semisemisemibold text-xl text-gray-800 leading-tight">
            Perfil de {{ $user->name }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="block mb-8">
                <x-regresar></x-regresar>
            </div>
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="  overflow-hidden  sm:rounded-lg">




                            <div class="">
                                <div class="container mx-auto ">
                                    <div class="grid grid-cols-4 sm:grid-cols-12 gap-2 mb-3">
                                        <div class="col-span-4 sm:col-span-3">
                                            <div class="bg-white shadow rounded-lg p-6">
                                                <div class="flex flex-col items-center">
 
                                                    <x-avatar 
                                                    photopath="{{ $user->profile_photo_path }}" 
                                                    userid="{{ $user->id }}"
                                                    username="{{ $user->name }}"
                                                    w="w-32"
                                                    h="h-32"
                                                    routeName="persona.detalles"
                                                    > 
                                                    </x-avatar>

                                                    <h1 class="text-xl font-semisemisemibold mt-5">{{ $user->name }}</h1>
                                                    <!-- <p class="text-gray-600">Software Developer</p> -->
                                                    @if($contactar)
                                                        <div class="mt-6 flex flex-wrap gap-4 justify-center">                                                        
                                                            <a href="{{ route('contacto.showForm', ['id' => $user->id, 't'=>'p']) }}"
                                                                class="bg-blue-500 hover:bg-blue-600 text-sm text-white py-2 px-4 rounded">
                                                                Contactar</a>  
                                                        </div>
                                                    @endif
                                                </div>
                                                <hr class="my-6 border-t border-gray-300">
                                                <div class="flex flex-col tags">
                                                    <span
                                                        class="text-gray-600 font-semisemibold  mb-2 text-lg ">Etiquetas</span>
                                                    <div class="flex flex-wrap py-3">
                                                        @foreach ($user->tags as $tag)
                                                            <span
                                                                class="inline-block bg-gray-200 rounded-full px-3 py-1 mb-2
                                                        text-sm font-semibold text-gray-700 mr-2">
                                                                {{ $tag->name }}
                                                            </span>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                
                                                @can('user_access')
                                                <hr class="my-6 border-t border-gray-300">
                                                    @foreach ($user->roles as $role)
                                                        <span
                                                            class="px-2 inline-flex text-xs leading-5 font-semisemisemibold rounded-full bg-green-100 text-green-800">
                                                            {{ $role->title }}
                                                        </span>
                                                    @endforeach
                                                @endcan
                                            </div>
                                        </div>
                                        <div class="col-span-4 sm:col-span-9">
                                            <div class="bg-white shadow rounded-lg p-6 h-full">
                                                {{-- <h2 class="text-xl font-semisemibold mb-4">Perfil de</h2> --}}
                                                <p class="text-gray-700">
                                                    {{ $user->description }}
                                                </p>

                                                @if ($user->phone)
                                                    <div class="flex  text-left pt-5 ">
                                                        <span
                                                            class="mr-2 text-gray-600  font-semisemibold  mb-1">
                                                            Teléfono: </span>
                                                        <span class="text-gray-600">{{ $user->phone }}</span>
                                                    </div>
                                                @endif

                                                @if ($user->birthdate)
                                                    <div class="flex text-left">
                                                        <span
                                                            class="text-gray-600  font-semisemibold  mb-1">
                                                            Nacimiento: </span>
                                                        {{ $user->birthdate }}
                                                    </div>
                                                @endif
                                                
                                                @if ($dateofdeath && $user->deathdate)
                                                    <div class="flex text-left">
                                                        <span
                                                            class="text-gray-600  font-semisemibold mb-1 pr-2">
                                                            Fallecimiento: </span>                                                       
                                                            {{ __($day)}}  {{ __('of')}} {{ __($month)}} {{ __('of')}} {{ __($year)}}
                                                    </div>
                                                @endif


                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>







                        </div>
                    </div>
                </div>
            </div>
            <div class="block mt-8">
                <x-regresar></x-regresar>
            </div>
        </div>
    </div>
</x-app-layout>
