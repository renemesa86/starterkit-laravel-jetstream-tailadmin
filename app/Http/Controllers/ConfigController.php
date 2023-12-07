<?php

namespace App\Http\Controllers;

use App\Models\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class ConfigController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('config_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $conf = Config::first();

        if ($conf == null) {         
            $conf = new Config();
            $conf->sitename = 'Directorio';
            $conf->logo = '/storage/logo.png';
            $conf->company_module = 0;
            $conf->people_module = 0;
            $conf->scheduling_module = 0;
            $conf->URL_frontpage = '/';
            $conf->dateofdeath = 0;
            $conf->save();           
        }   

        return view('config.index', compact('conf'));
    }

    public function save(Request $request, Config $config)
    {
        abort_if(Gate::denies('config_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $companyModule = 0;
        $peopleModule = 0;
        $schedulingModule = 0;
        $contactModule = 0;
        $dateofdeath = 0;

        if($request->has('company_module')){
            $companyModule = $request->company_module == 'on' ? 1 : 0;            
        }

        if($request->has('people_module')){      
            $peopleModule  = $request->people_module == 'on' ? 1 : 0;            
        }

        if($request->has('scheduling_module')){           
            $schedulingModule = $request->scheduling_module == 'on' ? 1 : 0; 
        }

        if($request->has('contact_module')){           
            $contactModule = $request->contact_module == 'on' ? 1 : 0; 
        }

        if($request->has('dateofdeath')){           
            $dateofdeath = $request->dateofdeath == 'on' ? 1 : 0; 
        }

        $reglas = [
            'logo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'sitename' => 'required'
        ];

        $request->validate($reglas);

        $config::find($request->id)->update([
            'sitename' => $request->sitename,
            'company_module' => $companyModule,
            'people_module' => $peopleModule,
            'scheduling_module' => $schedulingModule,
            'contact_module' => $contactModule,
            'URL_frontpage' => $request->URL_frontpage,
            'dateofdeath' => $dateofdeath
        ]); 

        Artisan::call('route:clear');

        if ($request->hasFile('logo')) {

            $imagen = $request->file('logo');
            $rutaImagen = $imagen->store('images', 'public');

            $conf = Config::first();
            $conf->logo = '/storage/' . $rutaImagen;
            $conf->save();            
        }

        return redirect()->back()->with('success', 'Los datos fueron guardados satisfactoriamente.');
    }
}
