<x-app-layout>
    <x-slot name="header">
        <x-header title="Editar Usuario"></x-header>
    </x-slot>

    <div class="edit-user">
        <div class="max-w-4xl mx-auto py-10 sm:px-6 lg:px-8">

            <x-regresar></x-regresar>

            <div class="mt-5 md:mt-0 md:col-span-2">
                <form method="post" action="{{ route('users.update', $user->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="shadow overflow-hidden sm:rounded-md bg-white p-5">


                        <div class="grid grid-cols-1 md:grid-cols-2">
                            <div>
                                <div class="px-4 py-2 bg-white sm:p-2">
                                    <label for="name" class="block">Nombre</label>
                                    <x-input id="name" type="text" name="name" :value="old('name', $user->name)" required
                                        autofocus autocomplete="name" />
                                    @error('name')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
        
                                <div class="px-4 py-2 bg-white sm:p-2">
                                    <label for="email" class="block ">Email</label>
                                    <x-input id="email" type="text" name="email" :value="old('email', $user->email)" required
                                        autofocus autocomplete="email" />
                                    @error('email')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
        
                                <div class="px-4 py-2 bg-white sm:p-2">
                                    <label for="password" class="block ">Password</label>
                                    <x-input id="password" type="password" name="password" {{--
                                        :value="old('name', $user->password)" --}} autofocus />
                                    @error('password')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
        
                                <div class="px-4 py-2 bg-white sm:p-2">
                                    <label for="phone" class="block ">Teléfono</label>
                                    <x-input id="phone" type="tel" name="phone" :value="old('phone', $user->phone)" autofocus />
                                    @error('phone')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div align="center">
                                <div class=" px-4 py-2 bg-white sm:p-2 ">
                                    @if(empty($user->profile_photo_path))
                                    <svg class="h-52 w-52 text-zinc-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                            d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    @else
                                    <img src="{{ asset('storage/'.$user->profile_photo_path) }}" alt="Photo Profile" width="150"
                                        height="150" class=" shadow-md ">
                                    @endif
                                    <br>
                                    <label for="profile_photo_path" class="block ">Foto</label>
                                    <input type="file" name="profile_photo_path" id="profile_photo_path" 
                                    class="w-full flex text-center">
                                    @error('profile_photo_path')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                       

                       

                        <div class="px-4 py-2 bg-white sm:p-2">
                            <label for="description" class="block ">Descripción</label>
                            <textarea type="text" name="description" id="description"
                                class="w-full form-input border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm text-sm text-gray-700"
                                value="{{ $user->description }}" rows="8">{{ $user->description }}</textarea>
                            @error('description')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="px-4 py-2 bg-white sm:p-2">
                            <label for="roles" class="block ">Roles</label>
                            <select name="roles[]" id="roles"
                                class="select2 form-multiselect block rounded-md shadow-sm mt-1 w-full"
                                multiple="multiple"
                                >
                                @foreach($roles as $id => $role)
                                <option value="{{ $id }}" {{ in_array($id, old('roles', $user->
                                    roles->pluck('id')->toArray())) ? ' selected' : '' }}>
                                    {{ $role }}
                                </option>
                                @endforeach
                            </select>
                            @error('roles')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="px-4 py-2 bg-white sm:p-2 flex items-center">
                            <input type="checkbox" name="status" id="status"
                                class="form-input rounded-sm shadow-sm block p-1 " value="1" {{ $user->status == '1' ?
                            'checked' : '' }}
                            />
                            <label for="status" class="pl-2">Activo</label>
                            @error('active')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end px-4 py-3 text-right sm:px-6">
                            <x-button class="mt-1 ml-3">Guardar</x-button>
                        </div>
                    </div>
                </form>
            </div>

            <x-regresar></x-regresar>

        </div>
    </div>
</x-app-layout>
<script>
    $(document).ready(function () {
        $('.select2').select2();
    })
</script>