<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Docente;
use App\Models\Estudiante;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    public function viewLoginForm() {
        return view('login');
    }

    public static function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if (!Auth::attempt($credentials)) {
            return back()->withErrors([
                'email' => 'Correo o contraseña incorrectos.',
            ])->onlyInput('email');
        }

        $request->session()->regenerate();
        $usuario = Auth::user();
        if ($usuario->isDocente()) {
            $docente = Docente::where('usuario_id', $usuario->id)->first();
            if ($docente) {
                return redirect()->route('docentes.inicio', ['id' => $docente->id]);
            }
        } elseif ($usuario->isEstudiante()) {
            $estudiante = Estudiante::where('usuario_id', $usuario->id)->first();
            if ($estudiante) {
                return redirect()->route('estudiantes.inicio', ['id' => $estudiante->id]);
            }
        }
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return back()->withErrors([
            'email' => 'Tipo de usuario no reconocido.',
        ])->onlyInput('email');
    }

    public static function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('user.login');
    }

    public static function createPerfil(Request $request) {
        $validate = $request->validate([
            'nombre' => 'required|string',
            'apellido' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string',
            'role' => 'required|string'
        ]);
        $perfil = User::create([
            'email' => $validate['email'],
            'password' => bcrypt($validate['password']),
            'role' => $validate['role']
        ]);
        if ($validate['role'] === 'docente') {
            $docente_datos = [
                'nombre' => $validate['nombre'],
                'apellido' => $validate['apellido'],
                'email' => $validate['email'],
                'telefono' => null,
                'direccion' => null,
                'fecha_nacimiento' => null,
                'sexo' => null,
                'profesion' => null,
                'usuario_id' => $perfil->id
            ];
            $docente = Docente::create($docente_datos);
        } elseif ($validate['role'] === 'estudiante') {
            $estudiante_datos = [
                'nombre' => $validate['nombre'],
                'apellido' => $validate['apellido'],
                'email' => $validate['email'],
                'telefono' => null,
                'direccion' => null,
                'fecha_nacimiento' => null,
                'sexo' => null,
                'usuario_id' => $perfil->id
            ];
            $estudiante = Estudiante::create($estudiante_datos);
        }
        return redirect()->route('user.login');
    }
    

    public static function getPerfil($id) {
        $perfil = User::find($id);
        if ($perfil) {
            return response()->json($perfil, 200);
        }
        return response()->json('Perfil no encontrado', 404);
    }

    public static function updatePerfil(Request $request, $id) {
        $perfil = User::find($id);
        if ($perfil) {
            $validate = $request->validate([
                'nombre' => 'required|string',
                'apellido' => 'required|string',
                'email' => 'required|email',
                'password' => 'required|string'
            ]);

            $perfil->update($validate);
            return response()->json($perfil, 200);
        }
        return response()->json('Perfil no encontrado', 404);
    }

    public static function deletePerfil($id) {
        $perfil = User::find($id);
        if ($perfil) {
            $perfil->delete();
            return response()->json('Perfil eliminado', 200);
        }
        return response()->json('Perfil no encontrado', 404);
    }
    
    public function viewCreatePerfil() {
        return view('register');
    }

    public function viewUpdatePerfil($id) {
        $perfil = User::find($id);
        if ($perfil) {
            return view('perfiles.update', compact('perfil'));
        }
        return response()->json('Perfil no encontrado', 404);
    }

    public function viewExcecuteCode() {
        return view('programar');
    }

    public function excecuteCode(Request $request) {
        $validate = $request->validate([
            'code' => 'required|string',
            'language' => 'required|string',
            'stdin' => 'nullable|string'
        ]);
        $code = $request->input('code');
        $language = $request->input('language');
        $stdin = $request->input('stdin', '');

        $api_url = env('JDOODLE_API_URL', 'https://api.jdoodle.com/v1/execute');
        $client = env('JDOODLE_CLIENT_ID');
        $secret = env('JDOODLE_CLIENT_SECRET');
        
        $response = Http::post($api_url, [
            'clientId' => $client,
            'clientSecret' => $secret,
            'script' => $code,
            'language' => $language,
            'versionIndex' => '0',
            'stdin' => $stdin
        ]);
        if ($response->successful()) {
            $result = $response->json();

            return response()->json([
                'output' => $result['output'] ?? '',
                'statusCode' => $result['statusCode'] ?? '',
                'memory' => $result['memory'] ?? '',
                'cpuTime' => $result['cpuTime'] ?? '',
                'error' => $result['error'] ?? ''
            ]);
        } else {
            return response()->json('Error al ejecutar el código', 500);
        }
    }
}
