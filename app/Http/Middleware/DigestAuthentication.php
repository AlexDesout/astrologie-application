<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DigestAuthentication
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $username = config('app.auth_digest_username');
        $password = config('app.auth_digest_password');
        $realm = 'Protected Area';
        $nonce = uniqid();
        $opaque = md5($realm);
        $digest = md5($username . ':' . $realm . ':' . $password);
    
        $header = $request->header('Authorization');
    
        if (!$header) {
            return $this->unauthorizedResponse($nonce, $realm, $opaque);
        }
    
        $pattern = '/Digest username="(.*?)", realm="(.*?)", nonce="(.*?)", uri="(.*?)", response="(.*?)", opaque="(.*?)"/';
        preg_match($pattern, $header, $matches);
    
        if (!$matches) {
            return $this->unauthorizedResponse($nonce, $realm, $opaque);
        }
    
        $clientDigest = $matches[5];
        $serverDigest = md5($username . ':' . $realm . ':' . $password);
    
        if ($clientDigest !== $serverDigest) {
            return $this->unauthorizedResponse($nonce, $realm, $opaque);
        }
    
        return $next($request);
    }
    
    private function unauthorizedResponse($nonce, $realm, $opaque)
    {
        $headers = [
            'WWW-Authenticate' => sprintf('Digest realm="%s", qop="auth", nonce="%s", opaque="%s"', $realm, $nonce, $opaque)
        ];
    
        return response('Unauthorized.', 401, $headers);
    }
    
}
