<?php

class UsuarioController extends BaseController {

    public function __construct() {
        if (!Auth::check()) {
            return Redirect::to('/');
        }
    }

    public function index() {

        //$estados=Estado::orderBy('id','desc')->lists('nombre','id');
        $estados = Estado::lists('nombre', 'id');
        return View::make('usuario/index', ['estados' => $estados]);
    }

    public function uploadFoto() {

        if (Input::hasFile('foto')) {
            if ($this->imageValidation(Input::File('foto')) && Input::file('foto')->getClientSize() < 520000) {
                $rute = app_path('assets/images/fotos/');
                $uploadSuccess = Input::file('foto')->move($rute, \uniqid() . '.' . Input::File('foto')->getClientOriginalExtension());
                $imagen = new Imagen;
                $imagen->nombre = $uploadSuccess->getFilename();
                $imagen->tipo = 'foto';
                $imagen->save();
                return ['exito' => true, 'id' => $imagen->id];
            }
        }

        // Handle specific Exceptions
        App::error(function(Exception $exception) {
                    Log::error($exception);
                    return $exception;
                });
    }

    public function savePersonal() {
        $ud = Input::get('fotoId');
        $info = new InformacionPersonal;
        $info->nombre = Input::get('nombre');
        $info->apellidos = Input::get('apellidos');
        $info->fecha_nacimiento = Input::get('fecha');
        $info->estado_civil = Input::get('estcivil');
        $info->sexo = Input::get('sexo');
        $info->ciudad_id = Input::get('ciudades');
        $info->imagen_id = Input::get('fotoId');
        $info->usuario_id = Auth::user()->id;
        $info->save();
    }
    
    public function perfiles(){                
        $perfiles=  Usuario::find(Auth::user()->id)->perfiles;
        return View::make('usuario/perfiles', ['perfiles' => $perfiles]);
    }
    
    public function addPerfiles(){               
        $oPerfil= new Perfil;
        $exito=$oPerfil->addPerfil('http://www.empleonuevo.com/',  Input::get('titulo'));
        return ['exito'=>$exito,'msg'=>'Error'];
    }
    
    public function removePerfiles(){               
        $oPerfil= new Perfil;
        $exito=$oPerfil->addPerfil('http://www.empleonuevo.com/',  Input::get('titulo'));
        return ['exito'=>$exito,'msg'=>'Error'];
    }

}
