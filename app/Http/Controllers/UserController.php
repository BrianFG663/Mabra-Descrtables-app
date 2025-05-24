<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return response()->json(['mensaje' => 'verdadero', 'url' => route('inicio')]); //devuelvo esto para analizar con fetch
        }
        
        return response()->json(['mensaje' => 'falso'], 422);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function formularioEmpleado(){

        $permisos = Permission::all();
        return view('registrarempleado',compact('permisos'));
        
    }

    public function verificarCorreo(Request $request){

        $correo = $request->correo;
        $user = User::where('email', $correo)->first();
        if(!empty($user)){
            return response()->json(['mensaje' => 'false']);
        }else{
           
            return response()->json(['mensaje' => 'true']);
        }
    }

    public function registrarEmpleado(Request $request){

        User::create(
            ['name'=>ucfirst($request->name),
            'permission_id'=>$request->permission,
            'email'=>$request->email,
            'lastname'=>ucfirst($request->lastname),
            'password'=>'empleado']
        );


        return view('inicio');
    }

}
