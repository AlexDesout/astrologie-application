<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DigestAuthentication
{
    public function handle(Request $request, Closure $next)
    {
        // Vérifier si le client a envoyé un en-tête d'authentification
        if (!$request->hasHeader('Authorization')) {
            var_dump(($request->header("Authorization")));
            return response()->json(['error' => 'Authentication required.'], 401);
        }

        // Extraire les informations d'authentification de l'en-tête
        $authHeader = $request->header('Authorization');
        $authInfo = $this->parseAuthHeader($authHeader);

        // Vérifier si les informations d'authentification sont valides
        if (!$this->isAuthValid($authInfo)) {
            return response()->json(['error' => 'Invalid authentication information.'], 401);
        }

        // Authentifier l'utilisateur
        $user = $this->authenticateUser($authInfo);

        if (!$user) {
            return response()->json(['error' => 'Invalid username or password.'], 401);
        }

        // Stocker l'utilisateur authentifié dans l'objet Request
        $request->setUserResolver(function () use ($user) {
            return $user;
        });

        // Passer la requête au middleware suivant
        return $next($request);
    }

    private function parseAuthHeader($header)
    {
        // Extraire les informations d'authentification de l'en-tête
        $authHeader = substr($header, 7);
        $authParts = explode(',', $authHeader);

        $authInfo = [];
        foreach ($authParts as $part) {
            $part = trim($part);
            list($key, $value) = explode('=', $part);
            $authInfo[$key] = str_replace('"', '', $value);
        }

        return $authInfo;
    }

    private function isAuthValid($authInfo)
    {
        // Vérifier si toutes les informations d'authentification sont présentes
        $requiredKeys = ['username', 'realm', 'nonce', 'uri', 'qop', 'response'];
        foreach ($requiredKeys as $key) {
            if (!isset($authInfo[$key])) {
                return false;
            }
        }

        // Vérifier si le nonce est valide
        $nonce = $authInfo['nonce'];
        $timestamp = substr($nonce, 0, strpos($nonce, ':'));
        $currentTime = time();
        if ($currentTime - $timestamp > 300) {
            return false;
        }

        return true;
    }

    private function authenticateUser($authInfo)
    {
        // Récupérer l'utilisateur correspondant au nom d'utilisateur
        $user = User::where('username', $authInfo['username'])->first();

        if (!$user) {
            return null;
        }

        // Calculer le hash de


        $realm = $authInfo['realm'];
        $nonce = $authInfo['nonce'];
        $uri = $authInfo['uri'];
        $qop = $authInfo['qop'];
        $password = $user->password;
        $HA1 = md5($user->username . ':' . $realm . ':' . $password);
        $HA2 = md5($authInfo['method'] . ':' . $uri);
        $response = md5($HA1 . ':' . $nonce . ':' . $authInfo['nc'] . ':' . $authInfo['cnonce'] . ':' . $qop . ':' . $HA2);
    
        // Vérifier si le hash de réponse correspond à celui envoyé par le client
        if ($response !== $authInfo['response']) {
            return null;
        }
    
        return $user;
    }
}
