<?php

namespace App\Http\Controllers;

use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\RegisterSaveInformationRequest;
use App\Mail\CompleteDataMail;
use App\Models\BlacklistToken;


use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AuthController extends Controller
{
    public function login(Request $request) // Para loguearse
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = Client::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'message' => 'Credenciales inválidas.',
            ], 401); // Usamos 401 Unauthorized
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        $response = [
            'user_id' => $user->id,
            'token' => $token,
        ];

        return response($response, 201);
    }

    public function create_register(RegisterRequest $request) // Para registrarse y enviar correo
    {
        Log::info('Petición a create_register');
        try {
            $validatedData = $request->validated();
            $validatedData['password'] = Hash::make($validatedData['password']);
            $client = Client::create($validatedData);

            $token = JWTAuth::fromUser($client);
            //Exacto. Sin la clave secreta que tienes en Laravel (JWT_SECRET), nadie más puede decodificar el token de manera segura.
            $url = env('APP_URL_REACT') . "/register/complete/data/information?token={$token}";
            Mail::to($client->email)->send(new CompleteDataMail($url));
            Log::alert('Email enviado a: ' . $client->email);

            return response()->json($client, 201);
        } catch (\Exception $e) {
            Log::error('Error en create_register: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function sendCompleteDataEmail(RegisterSaveInformationRequest $request)
    {
        //
    }

    public function verifyEmail(RegisterSaveInformationRequest $request, $token)
    {
        // Primero, validamos los datos de la solicitud
        $validatedData = $request->validated();

        try {
            // Obtener el token desde la URL
            Log::info($token);
            $blacklisted = BlacklistToken::where('token', $token)->exists();
            if (!$token) {
                return response()->json(['error' => 'El token es requerido'], 400);
            } else if ($blacklisted) {
                return response()->json(['error' => 'Token inválido'], 401);
            }

            // Decodificar el token
            $decoded = JWT::decode($token, new Key(env('JWT_SECRET'), 'HS256'));
            // Obtener el ID del usuario desde el token (campo 'sub')
            $userId = $decoded->sub;
            Log::info('ID: ' . $userId);
            if ($userId) {
                $user = Client::where('id', $userId)->first();
                if ($user) {
                    Log::info('Usuario encontrado: ' . json_encode($user));
                    $user->username = $request->username;
                    $user->name = $request->name;
                    $user->lastname = $request->lastname;
                    $user->description = $request->description;
                    $user->save();
                    $black_list = BlacklistToken::create(['token' => $token]);
                    Log::info("message: " . $black_list);
                } else {
                    return response()->json(['error' => 'El usuario no existe'], 400);
                }
            } else {
                return response()->json(['error' => 'El token no es válido o no coincide con el ID'], 400);
            }


            return response()->json([
                'message' => 'Token válido, los datos han sido guardados correctamente',
                'user' => $user
            ]);
        } catch (\Firebase\JWT\ExpiredException $e) {
            Log::error('Token expirado: ' . $e->getMessage());
            Log::info('Token expirado: ' . $e->getMessage());
            return response()->json(['error' => 'El token ha expirado'], 401);
        } catch (\Firebase\JWT\SignatureInvalidException $e) {
            Log::error('Firma inválida del token: ' . $e->getMessage());
            return response()->json(['error' => 'La firma del token no es válida'], 401);
        } catch (\Exception $e) {
            Log::error('Error general en verifyEmail: ' . $e->getMessage());
            return response()->json(['error' => 'Hubo un error con el token o los datos ' . $e->getMessage()], 500);
        }
    }
}
