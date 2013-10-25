<?php

class HomeController extends BaseController {
    /*
      |--------------------------------------------------------------------------
      | Default Home Controller
      |--------------------------------------------------------------------------
      |
      | You may wish to use controllers instead of, or in addition to, Closure
      | based routes. That's great! Here is an example controller method to
      | get you started. To route to this controller, just add the route:
      |
      |	Route::get('/', 'HomeController@showWelcome');
      |
     */

    public function index() {
        return View::make('home/index');
    }

    public function registerForm() {
        return View::make('home/registro');
    }

    public function register() {
        if (Request::ajax()) {

            DB::transaction(function() {
                        $oUsuario = new \Usuario();
                        $oUsuario->email = Input::get('email');
                        $oUsuario->password = Hash::make(Input::get('password'));

                        //echo Hash::make(Input::get('password'));
                        $validator = Validator::make(Input::all(), [
                                    'password' => ['required', 'min:5'],
                                    'email' => ['required', 'min:5', 'email', 'unique:usuarios']]
                        );

                        if ($validator->fails()) {
                            $messages = $validator->messages();
                            return ['msg' => $messages->all('<li>:message</li>')];
                        }
                        $oUsuario->save();

                        /*                         * *Save QR COde ** */
                        $qrCode = new Endroid\QrCode\QrCode();
                        $path = app_path('assets/images/qr/');
                        $qrCode->setText("http://www.empleonuevo.com/");
                        //$qrCode->setImagePath($path);            
                        $qrName = \uniqid() . '.png';
                        $qrCode->save($path.$qrName);
                        $oImagen = new Imagen;
                        $oImagen->nombre = $qrName;
                        $oImagen->tipo = 'qr';
                        $oImagen->save();



                        /*                         * * Save Profile * */

                        $oPerfles = new Perfil;
                        $oPerfles->titulo = "Publico";
                        $oPerfles->imagen_id = $oImagen->id;
                        $oPerfles->usuario_id = $oUsuario->id;
                        $oPerfles->save();
                    });



            if (Auth::attempt(['email' => Input::get('email'), 'password' => Input::get('password')])) {
                return ['url' => URL::to('usuario'), 'login' => true];
            }
        }
    }

    public function doLogin() {
        $validator = Validator::make(Input::all(), [
                    'password' => ['required', 'min:5'],
                    'email' => ['required', 'min:5', 'email', 'unique:usuarios']]
        );
        if (Auth::attempt(['email' => Input::get('email'), 'password' => Input::get('password')])) {
            return Redirect::to('/usuario');
        } else {
            return Redirect::to('/');
        }
        //return $response;
    }

}