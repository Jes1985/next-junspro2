<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Mail\LoginOtpMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class OtpController extends Controller
{
    /**
     * Affiche la page de saisie du code OTP.
     */
    public function showForm()
    {
        if (!session('otp_user_id')) {
            return redirect()->route('user.login');
        }

        $user = User::find(session('otp_user_id'));
        if (!$user) {
            return redirect()->route('user.login');
        }

        // Masquer l'email : j***@gmail.com
        $maskedEmail = $this->maskEmail($user->email_address);

        return view('frontend.otp-verify', compact('maskedEmail'));
    }

    /**
     * Vérifie le code OTP soumis.
     */
    public function verify(Request $request)
    {
        $request->validate(['otp' => 'required|digits:6']);

        $userId = session('otp_user_id');
        if (!$userId) {
            return redirect()->route('user.login')->with('error', 'Session expirée. Veuillez vous reconnecter.');
        }

        $user = User::find($userId);
        if (!$user) {
            return redirect()->route('user.login')->with('error', 'Utilisateur introuvable.');
        }

        // Vérification du code et de l'expiration
        if (
            $user->login_otp !== $request->otp ||
            !$user->login_otp_expires_at ||
            now()->isAfter($user->login_otp_expires_at)
        ) {
            return back()->with('error', 'Code incorrect ou expiré. Veuillez réessayer.');
        }

        // Invalider le code
        $user->update([
            'login_otp'            => null,
            'login_otp_expires_at' => null,
        ]);

        // Session unique : invalider toutes les autres sessions actives
        // en régénérant la session courante (Laravel gère l'unicité par session_id)
        Session::regenerate(true);

        // Connecter l'utilisateur
        Auth::guard('web')->login($user, remember: true);

        // Restaurer la redirection prévue
        $redirectUrl = session('otp_redirect_url', route('user.dashboard'));
        session()->forget(['otp_user_id', 'otp_redirect_url']);

        // Restaurer active_role en session si disponible
        $activeRole = session('otp_active_role');
        if ($activeRole) {
            session(['active_role' => $activeRole]);
            session()->forget('otp_active_role');
        }

        return redirect($redirectUrl);
    }

    /**
     * Renvoie un nouveau code OTP.
     */
    public function resend()
    {
        $userId = session('otp_user_id');
        if (!$userId) {
            return redirect()->route('user.login')->with('error', 'Session expirée.');
        }

        $user = User::find($userId);
        if (!$user) {
            return redirect()->route('user.login');
        }

        $this->sendOtp($user);

        return back()->with('success', 'Un nouveau code a été envoyé à votre adresse email.');
    }

    /**
     * Génère et envoie un OTP à l'utilisateur.
     */
    public static function sendOtp(User $user): void
    {
        $otp = str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        $user->update([
            'login_otp'            => $otp,
            'login_otp_expires_at' => now()->addMinutes(10),
        ]);

        $name = $user->first_name ?? explode('@', $user->email_address)[0];

        Mail::to($user->email_address)->send(new LoginOtpMail($otp, $name));
    }

    /**
     * Masque partiellement l'email pour l'affichage.
     * Ex: younes@gmail.com → y***@gmail.com
     */
    private function maskEmail(string $email): string
    {
        [$local, $domain] = explode('@', $email, 2);
        $masked = substr($local, 0, 1) . str_repeat('*', max(strlen($local) - 1, 3));
        return $masked . '@' . $domain;
    }
}
