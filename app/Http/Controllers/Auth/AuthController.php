<?php

namespace App\Http\Controllers\Auth;
use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

//Se agrega tres clases para tener mejor funcionamiento

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Session;

class AuthController extends Controller{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;


    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
        $this->middleware('guest', ['except' => 'getLogout']);

    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */



//login
/*
Este metodo me envia a la vista y me muestra formulario de acceso
*/
protected function getLogin(){
        return view("login");
    }


/*
Este metodo es cuando se trata de acceder al sistema
verifica que este la contraseña
si las credenciales son correctas da acceso
si no enie mensaje de error
*/

public function postLogin(Request $request){
        $this->validate($request, [
          'email' => 'required',
          'password' => 'required',
    ]);
    $credentials = $request->only('email', 'password');

    if ($this->auth->attempt($credentials, $request->has('remember'))){
        return view("home");
      }
    return "Email o contraseña incorrecta";
    }

//login
 //registro
 /*
Formulario de registro que colocando la ruta register
pues este muestre formulario registro
 */

protected function getRegister(){
        return view("registro");
    }

/*
Cuando se trate de registrar un nuevo usuario al sistema
se reciba esa informacion en el post y cree nuevo usuario
con los datos necesario y lo guarde
*/

protected function postRegister(Request $request){
    $this->validate($request, [
        'name' => 'required',
        'email' => 'required',
        'password' => 'required',
    ]);

    $data = $request;

    $user=new User;
    $user->name=$data['name'];
    $user->email=$data['email'];
    $user->password=bcrypt($data['password']);


    if($user->save()){
         return "se ha registrado correctamente el usuario";
    }
}

//registro
/*
Esta funcion de salida termina la sesion y redirige al login
*/
protected function getLogout(){
        $this->auth->logout();

        Session::flush();

        return redirect('login');
    }

}
