<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class KeycloakController extends Controller
{
    public function redirectToKeycloak()
    {
        // Redireciona para o Keycloak. O 'scope' garante que o Keycloak envie os roles no token.
        return Socialite::driver('keycloak')
            ->scopes(['openid', 'profile', 'email'])
            ->redirect();
    }

    public function handleKeycloakCallback()
    {
        try {
            $keycloakUser = Socialite::driver('keycloak')->user();
        } catch (\Exception $e) {
            // Se a troca do code falhar (expiração, erro, etc.)
            return redirect('/login')->withErrors(['sso' => 'Falha na autenticação SSO. Tente novamente.']);
        }

        // 1. Tenta encontrar o usuário pelo Keycloak ID (Login normal após JIT)
        $user = User::where('keycloak_uuid', $keycloakUser->getId())->first();

        if ($user) {
            // Usuário já vinculado, apenas faz login
            Auth::login($user);
        } else {
            // 2. Primeiro login. Tenta encontrar pelo e-mail (JIT Provisioning/Linking)
            $user = User::where('email', $keycloakUser->getEmail())->first();

            if ($user) {
                // 2a. Usuário legado encontrado. Vincula a conta.
                $user->keycloak_uuid = $keycloakUser->getId();
                $user->password = null; // Desativa a autenticação local por senha
                $user->save();
                Auth::login($user);
            } else {
                // 2b. Usuário 100% novo (criado em outro app, logando aqui pela 1ª vez). Cria a conta.
                $newUser = User::create([
                    'keycloak_uuid' => $keycloakUser->getId(),
                    'name' => $keycloakUser->getName(),
                    'email' => $keycloakUser->getEmail(),
                    'password' => null,
                    // Adicione o role padrão do Laravel aqui, se necessário.
                ]);
                $newUser->assignRole('user');
                Auth::login($newUser);
            }
        }

        return redirect()->intended('/dashboard');
    }

    public function keycloakLogout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // 2. Obtém as variáveis de ambiente
        $keycloakBaseUrl = config('services.keycloak.base_url');
        $realm = config('services.keycloak.realms');
        $clientId = config('services.keycloak.client_id');

        // Define a URL para onde o Keycloak deve retornar após o logout.
        // Usamos a rota de login do Laravel (ex: /login)
        $postLogoutRedirectUri = route('login');

        // 3. Constrói a URL de Logout do Keycloak (OIDC End Session Endpoint)
        // Formato: {BASE_URL}/realms/{REALM}/protocol/openid-connect/logout?post_logout_redirect_uri={URL_DE_RETORNO}&client_id={CLIENT_ID}

        $logoutUrl = $keycloakBaseUrl . '/realms/' . $realm .
            '/protocol/openid-connect/logout?post_logout_redirect_uri=' . urlencode($postLogoutRedirectUri) .
            '&client_id=' . urlencode($clientId);

        // 4. Redireciona o usuário para o Keycloak para encerrar a sessão SSO
        return redirect()->to($logoutUrl);
    }
}
