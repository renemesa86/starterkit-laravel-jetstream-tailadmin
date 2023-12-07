<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Config;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Models\Tag;
use DateTime;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->has('search')) {

            $search = $request->input('search');

            $users = User::where('name', 'LIKE', '%' . $search . '%')
                ->paginate(20);

        } else {
            $users = User::with('roles')->paginate(10);
        }

        return view('users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbbiden');
        $config = Config::first();        

        $roles = Role::pluck('rol','id');

        return view('users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->validated());
        $user->password = Hash::make($request->input('password'));
        $user->birthdate = $request->birthdate;
        $user->deathdate = $request->deathdate;
        $user->phone = $request->phone;
        $user->description = $request->description;

        if($request->has('active')){
            $user->status = $request->active;
        } else {
            $user->status = 0;
        }

        $user->roles()->sync($request->input('roles', []));
        $user->tags()->sync($request->input('tags',[]));

        // Manejo de la foto si se proporciona una nueva
        if ($request->hasFile('profile_photo_path')) {
            $imagen = $request->file('profile_photo_path');

            $nombreImagen = time() . '.' . $imagen->getClientOriginalExtension();
            // Redimensionar y recortar la imagen
            $imagenRedimensionada = Image::make($imagen)
                ->fit(300, 300) // Cambia 300 a la resolución deseada
                ->save(public_path('storage/profile-photos/' . $nombreImagen)); // Guardar en la carpeta storage/fotos

            $urlFotoRedimensionada ='profile-photos/' . $nombreImagen;
            $user->profile_photo_path = $urlFotoRedimensionada;
        }

        $user->save();

        return redirect()->route('users.index')->with('success','El usuario fue creado satisfactoriamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $emailCodificado = base64_encode($user->email);

        return view('users.show', compact('user','emailCodificado'));
    }

    /**
     * Display the specified resource.
     */
    public function showDetails(Int $id)
    {
        $config = Config::get()->first();

        $contactar = $config->contact_module == 1 ? true : false;
        $dateofdeath = $config->dateofdeath == 1 ? true : false;
        
        $user = User::find($id);

        $emailCodificado = base64_encode($user);
        
        $fecha = new DateTime($user->deathdate);
        $day = strval($fecha->format('d'));
        $month = strval($fecha->format('F'));
        $year = strval($fecha->format('Y'));

        return view('users.show-details', compact('user','emailCodificado','contactar',
        'dateofdeath','day','month','year'));
    }

     /**
     * Display the specified resource.
     */
    public function personas(Request $request)
    {
        $config = Config::first();
        $peopleDisabled = $config->people_module == 0 ? true : false;
        $agendar = $config->scheduling_module == 1 ? true : false;
        
        abort_if($peopleDisabled, Response::HTTP_FORBIDDEN, '403 Forbidden');

        $valorSeleccionado = $request->input('nombre');
        $valorSeleccionadoItems = $request->input('itemsPerPage');

        if($request->has('itemsPerPage')){ 
            session([
                'valorSeleccionado' => $valorSeleccionado,
                'valorSeleccionadoItems' => $valorSeleccionadoItems
            ]);
        } 

        $itemsPerPage = [
            ['value' => 10, 'label' => 10],
            ['value' => 20, 'label' => 20],
            ['value' => 30, 'label' => 30]
        ];

        // $tipoIndustria = TipoIndustria::all()->map(function ($item) {
        //     return [
        //         'value' => $item->id,
        //         'label' => $item->name
        //     ];
        // });

        if ($request->input('nombre') != null) {
            $users = User::where('name', 'LIkE', '%'.  $valorSeleccionado. '%')
                ->orderByDesc('id')
                ->paginate(session('valorSeleccionadoItems'));
        } else {
            $users = User::orderByDesc('id')
                ->paginate(session('valorSeleccionadoItems'));
        }


        return view('personas', compact(
            'users',
            'itemsPerPage',
            'valorSeleccionado',
            'valorSeleccionadoItems',
            'agendar'
        ));
 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {       
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $config = Config::first();

        $roles = Role::pluck('rol', 'id');
        $user->load('roles');

        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        try {

            $validatedData = $request->validated();

            $user->update([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'description' => $validatedData['description'],
                'phone' => $validatedData['phone'],
            ]);

            if($request->filled('password')){
                $user->password = Hash::make($request->input('password'));
            }

            if($request->has('status')){
                $user->status = $request->status;
            } else {
                $user->status = 0;
            }

            $user->roles()->sync($request->input('roles', []));

            // Manejo de la foto si se proporciona una nueva
            if (array_key_exists('profile_photo_path',$validatedData) ) {

                $imagen = $request->file('profile_photo_path'); 

                $nombreImagen = time() . '.' . $imagen->getClientOriginalExtension();

                // Redimensionar y recortar la imagen
                $imagenRedimensionada = Image::make($imagen)
                    ->fit(300, 300) // Cambia 300 a la resolución deseada
                    ->save(public_path('storage/profile-photos/' . $nombreImagen)); // Guardar en la carpeta storage/fotos

                $urlFotoRedimensionada ='profile-photos/' . $nombreImagen;

                $user->profile_photo_path = $urlFotoRedimensionada;
                
            }

            $user->save();

            return redirect()->route('users.index')->with('success',"El usuario fue actualizado correctamente.");
        }
        catch (ValidationException $e) {
            $errors = $e->validator->errors();

            return redirect()->back()->withErrors($errors)->withInput();
        }
        catch (\Exception $e){
            return redirect()->back()->with('error','Ocurrió un error inesperado: '.$e->getMessage());
        }


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->delete();

        return redirect()->route('users.index');
    }

}
