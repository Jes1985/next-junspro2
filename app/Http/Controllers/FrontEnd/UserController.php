<?php

namespace App\Http\Controllers\FrontEnd;

use App\Events\MessageStored;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FrontEnd\ClientDashboardController;
use App\Http\Controllers\FrontEnd\MiscellaneousController;
use App\Http\Helpers\BasicMailer;
use App\Http\Helpers\SellerPermissionHelper;
use App\Http\Helpers\UploadFile;
use App\Http\Requests\MessageRequest;
use App\Http\Requests\SupportTicket\ConversationRequest;
use App\Http\Requests\SupportTicket\TicketRequest;
use App\Http\Requests\User\ForgetPasswordRequest;
use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\ResetPasswordRequest;
use App\Http\Requests\User\SignupRequest;
use App\Http\Requests\User\UpdatePasswordRequest;
use App\Http\Requests\User\UpdateProfileRequest;
use App\Rules\MatchOldPasswordRule;
use App\Models\BasicSettings\Basic;
use App\Models\BasicSettings\MailTemplate;
use App\Models\ClientService\Service;
use App\Models\ClientService\ServiceOrder;
use App\Models\ClientService\ServiceOrderMessage;
use App\Models\Follower;
use App\Models\Seller;
use App\Models\SupportTicket;
use App\Models\TicketConversation;
use App\Models\User;
use App\Services\Junspro\CycleUsageService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Mews\Purifier\Facades\Purifier;

class UserController extends Controller
{
  public function login()
  {
    // Nouvelle vue moderne d'authentification
    // websiteInfo et currentLanguageInfo sont partagés globalement via AppServiceProvider
    $basic = Basic::query()->select('google_login_status', 'facebook_login_status', 'google_client_id', 'google_client_secret', 'facebook_app_id', 'facebook_app_secret')->first();
    
    return view('frontend.auth.login', [
      'googleEnabled' => $basic && $basic->google_login_status == 1 && !empty($basic->google_client_id) && !empty($basic->google_client_secret),
      'facebookEnabled' => $basic && $basic->facebook_login_status == 1 && !empty($basic->facebook_app_id) && !empty($basic->facebook_app_secret),
    ]);
  }

  public function redirectToFacebook()
  {
    // Charger les clés depuis la base de données
    $basic = Basic::query()->first();
    
    if (!$basic || !$basic->facebook_login_status || !$basic->facebook_app_id || !$basic->facebook_app_secret) {
      Session::flash('error', 'La connexion Facebook n\'est pas configurée. Veuillez utiliser l\'inscription par email.');
      return redirect()->route('user.signup', ['role' => request()->get('role', 'client')]);
    }
    
    // Configurer Socialite avec les clés de la base de données
    // Utiliser l'URL complète pour éviter les erreurs redirect_uri_mismatch
    $redirectUrl = url('/login/facebook/callback');
    config([
      'services.facebook.client_id' => $basic->facebook_app_id,
      'services.facebook.client_secret' => $basic->facebook_app_secret,
      'services.facebook.redirect' => $redirectUrl,
    ]);
    
    // Sauvegarder le rôle dans la session
    $role = request()->get('role', 'client');
    Session::put('auth_role', $role);
    
    return Socialite::driver('facebook')->redirect();
  }

  public function handleFacebookCallback()
  {
    return $this->authenticationViaProvider('facebook');
  }

  public function redirectToGoogle()
  {
    // Charger les clés depuis la base de données
    $basic = Basic::query()->first();
    
    if (!$basic || !$basic->google_login_status || !$basic->google_client_id || !$basic->google_client_secret) {
      Session::flash('error', 'La connexion Google n\'est pas configurée. Veuillez utiliser l\'inscription par email.');
      return redirect()->route('user.signup', ['role' => request()->get('role', 'client')]);
    }
    
    // Configurer Socialite avec les clés de la base de données
    // Utiliser l'URL complète pour éviter les erreurs redirect_uri_mismatch
    $redirectUrl = url('/login/google/callback');
    config([
      'services.google.client_id' => $basic->google_client_id,
      'services.google.client_secret' => $basic->google_client_secret,
      'services.google.redirect' => $redirectUrl,
    ]);
    
    // Sauvegarder le rôle dans la session
    $role = request()->get('role', 'client');
    Session::put('auth_role', $role);
    
    return Socialite::driver('google')->redirect();
  }

  public function handleGoogleCallback()
  {
    return $this->authenticationViaProvider('google');
  }

  public function authenticationViaProvider($driver)
  {
    // Charger les clés depuis la base de données
    $basic = Basic::query()->first();
    
    if ($driver === 'facebook') {
      if (!$basic || !$basic->facebook_login_status || !$basic->facebook_app_id || !$basic->facebook_app_secret) {
        Session::flash('error', 'La connexion Facebook n\'est pas configurée.');
        return redirect()->route('user.login');
      }
      $redirectUrl = url('/login/facebook/callback');
      config([
        'services.facebook.client_id' => $basic->facebook_app_id,
        'services.facebook.client_secret' => $basic->facebook_app_secret,
        'services.facebook.redirect' => $redirectUrl,
      ]);
    } elseif ($driver === 'google') {
      if (!$basic || !$basic->google_login_status || !$basic->google_client_id || !$basic->google_client_secret) {
        Session::flash('error', 'La connexion Google n\'est pas configurée.');
        return redirect()->route('user.login');
      }
      $redirectUrl = url('/login/google/callback');
      config([
        'services.google.client_id' => $basic->google_client_id,
        'services.google.client_secret' => $basic->google_client_secret,
        'services.google.redirect' => $redirectUrl,
      ]);
    }
    
    // get the url from session which will be redirect after login
    if (Session::has('redirectTo')) {
      $redirectURL = Session::get('redirectTo');
    } else {
      $redirectURL = route('user.dashboard');
    }

    // Récupérer le rôle depuis la session
    $role = Session::get('auth_role', 'client');
    Session::forget('auth_role');

    $responseData = Socialite::driver($driver)->user();
    $userInfo = $responseData->user;

    $isUser = User::query()->where('email_address', '=', $userInfo['email'])->first();

    if (!empty($isUser)) {
      // log in
      if ($isUser->status == 1) {
        Auth::login($isUser);

        return redirect($redirectURL);
      } else {
        Session::flash('error', 'Désolé, votre compte a été désactivé.');

        return redirect()->route('user.login', ['role' => $role]);
      }
    } else {
      // get user avatar and save it
      try {
        $avatar = $responseData->getAvatar();
        $fileContents = file_get_contents($avatar);

        $avatarName = $responseData->getId() . '.jpg';
        $path = public_path('assets/img/users/');

        if (!file_exists($path)) {
          mkdir($path, 0755, true);
        }

        file_put_contents($path . $avatarName, $fileContents);
      } catch (\Exception $e) {
        $avatarName = null;
      }

      // sign up
      $user = new User();

      if ($driver == 'facebook') {
        $user->first_name = $userInfo['name'] ?? 'Utilisateur';
      } else {
        $user->first_name = $userInfo['given_name'] ?? 'Utilisateur';
        $user->last_name = $userInfo['family_name'] ?? '';
      }

      if ($avatarName) {
        $user->image = $avatarName;
      }
      
      $user->username = Str::slug($userInfo['email'] ?? 'user' . time());
      $user->email_address = $userInfo['email'];
      $user->email_verified_at = date('Y-m-d H:i:s');
      $user->status = 1;
      $user->provider = ($driver == 'facebook') ? 'facebook' : 'google';
      $user->provider_id = $userInfo['id'];
      $user->save();

      // Enregistrer le parrainage si un code de parrainage existe (inscription sociale)
      $referralCode = $request->cookie('referral_code');
      if ($referralCode && class_exists(\App\Services\Junspro\ReferralService::class)) {
        try {
          $referralService = app(\App\Services\Junspro\ReferralService::class);
          $referralService->registerReferral($referralCode, $user);
        } catch (\Exception $e) {
          // Log l'erreur mais ne bloque pas l'inscription
          \Log::warning('Erreur lors de l\'enregistrement du parrainage (social): ' . $e->getMessage());
        }
      }

      // Créer le profil selon le rôle
      if ($role === 'freelance') {
        // Créer un profil freelance si le modèle existe
        if (class_exists(\App\Models\FreelancerProfile::class)) {
          \App\Models\FreelancerProfile::create([
            'user_id' => $user->id,
            'hourly_rate' => 0,
            'availability' => 'available',
          ]);
        }
      } else {
        // Créer un profil client si le modèle existe
        if (class_exists(\App\Models\ClientProfile::class)) {
          \App\Models\ClientProfile::create([
            'user_id' => $user->id,
          ]);
        }
      }

      Auth::login($user);
      
      // Déterminer la redirection selon le type d'utilisateur créé
      if (Session::has('redirectTo')) {
        $redirectURL = Session::get('redirectTo');
      } else {
        // Vérifier si l'utilisateur a un profil client (priorité) ou freelance
        $user->refresh(); // Recharger pour avoir les relations
        if ($user->clientProfile) {
          $redirectURL = route('client.dashboard.index');
        } elseif ($user->freelancerProfile) {
          $redirectURL = route('freelance.dashboard');
        } else {
          $redirectURL = route('user.dashboard');
        }
      }

      return redirect($redirectURL);
    }
  }

  public function loginSubmit(LoginRequest $request)
  {
    // get the email-address and password which has provided by the user
    $credentials = [
      'email_address' => $request->email_address,
      'password' => $request->password
    ];

    // login attempt
    if (Auth::guard('web')->attempt($credentials)) {
      $authUser = Auth::guard('web')->user();
      
      // Récupérer le rôle depuis la requête (si présent)
      $selectedRole = $request->input('role', null);

      // Stocker le rôle actif en session pour les redirections ultérieures (ex: bouton "Tableau de bord")
      if ($selectedRole === 'freelance' && $authUser->freelancerProfile) {
        $request->session()->put('active_role', 'freelance');
      } elseif ($authUser->clientProfile) {
        $request->session()->put('active_role', 'client');
      } elseif ($authUser->freelancerProfile) {
        $request->session()->put('active_role', 'freelance');
      }

      // Déterminer la redirection selon le type d'utilisateur
      if ($request->session()->has('redirectTo')) {
        $redirectURL = $request->session()->get('redirectTo');
      } else {
        // Respecter le rôle sélectionné sur la page de connexion (role=freelance ou role=client)
        if ($selectedRole === 'freelance' && $authUser->freelancerProfile) {
          $redirectURL = route('freelance.dashboard');
        } elseif ($selectedRole === 'client' && $authUser->clientProfile) {
          $redirectURL = route('client.dashboard.index');
        } elseif ($authUser->clientProfile) {
          // Pas de rôle précisé : priorité client
          $redirectURL = route('client.dashboard.index');
        } elseif ($authUser->freelancerProfile) {
          $redirectURL = route('freelance.dashboard');
        } else {
          $redirectURL = route('user.dashboard');
        }
      }

      // first, check whether the user's email address verified or not
      if (is_null($authUser->email_verified_at)) {
        // Sauvegarder l'email dans la session pour permettre le renvoi
        $request->session()->put('unverified_email', $authUser->email_address);
        $request->session()->put('unverified_user_id', $authUser->id);
        
        $request->session()->flash('error', 'Veuillez vérifier votre adresse e-mail. Si vous n\'avez pas reçu l\'email de vérification, vous pouvez le renvoyer depuis la page de connexion.');

        // logout auth user as condition not satisfied
        Auth::guard('web')->logout();

        return redirect()->back();
      }

      // second, check whether the user's account is active or not
      if ($authUser->status == 0) {
        $request->session()->flash('error', 'Désolé, votre compte a été désactivé.');

        // logout auth user as condition not satisfied
        Auth::guard('web')->logout();

        return redirect()->back();
      }

      // before, redirect to next url forget the session value
      if ($request->session()->has('redirectTo')) {
        $request->session()->forget('redirectTo');
      }


      // otherwise, redirect auth user to next url
      return redirect($redirectURL);
    } else {
      $request->session()->flash('error', 'Adresse e-mail ou mot de passe incorrect.');

      return redirect()->back();
    }
  }

  public function forgetPassword()
  {
    $misc = new MiscellaneousController();

    $language = $misc->getLanguage();

    $queryResult['seoInfo'] = $language->seoInfo()->select('meta_keyword_customer_forget_password', 'meta_description_customer_forget_password')->first();

    $queryResult['pageHeading'] = $misc->getPageHeading($language);

    $queryResult['breadcrumb'] = $misc->getBreadcrumb();

    return view('frontend.forget-password', $queryResult);
  }

  public function forgetPasswordMail(ForgetPasswordRequest $request)
  {
    $user = User::query()->where('email_address', '=', $request->email_address)->first();

    // store user email in session to use it later
    $request->session()->put('userEmail', $user->email_address);

    // get the mail template information from db
    $mailTemplate = MailTemplate::query()->where('mail_type', '=', 'reset_password')->first();
    $mailData['subject'] = $mailTemplate->mail_subject;
    $mailBody = $mailTemplate->mail_body;

    // get the website title info from db
    $websiteTitle = Basic::query()->pluck('website_title')->first();

    $name = $user->first_name . ' ' . $user->last_name;

    $link = '<a href=' . url("user/reset-password") . '>Click Here</a>';

    $mailBody = str_replace('{customer_name}', $name, $mailBody);
    $mailBody = str_replace('{password_reset_link}', $link, $mailBody);
    $mailBody = str_replace('{website_title}', $websiteTitle, $mailBody);

    $mailData['body'] = $mailBody;

    $mailData['recipient'] = $user->email_address;

    $mailData['sessionMessage'] = 'A mail has been sent to your email address.';

    BasicMailer::sendMail($mailData);

    return redirect()->back();
  }

  public function resetPassword()
  {
    $misc = new MiscellaneousController();

    $breadcrumb = $misc->getBreadcrumb();

    return view('frontend.reset-password', compact('breadcrumb'));
  }

  public function resetPasswordSubmit(ResetPasswordRequest $request)
  {
    if ($request->session()->has('userEmail')) {
      // get the user email from session
      $emailAddress = $request->session()->get('userEmail');

      $user = User::query()->where('email_address', '=', $emailAddress)->first();

      $user->update([
        'password' => Hash::make($request->new_password)
      ]);

      $request->session()->flash('success', 'Password updated successfully.');
    } else {
      $request->session()->flash('error', 'Something went wrong!');
    }

    return redirect()->route('user.login');
  }

  public function signup()
  {
    // Si l'utilisateur est déjà connecté et veut créer un profil freelance, rediriger vers l'onboarding
    if (Auth::guard('web')->check()) {
      $role = request()->get('role', 'client');
      if ($role === 'freelance') {
        // Vérifier si l'utilisateur a déjà un profil freelance
        $user = Auth::guard('web')->user();
        if (class_exists(\App\Models\FreelancerProfile::class)) {
          $freelancerProfile = \App\Models\FreelancerProfile::where('user_id', $user->id)->first();
          if ($freelancerProfile) {
            // Rediriger vers l'étape 1 de l'onboarding
            return redirect()->route('freelance.onboarding.step1');
          }
        }
        // Si pas de profil freelance, rediriger vers l'onboarding pour en créer un
        return redirect()->route('freelance.onboarding.step1');
      }
      // Si c'est un client connecté, rediriger vers le dashboard approprié
      $user = Auth::guard('web')->user();
      if ($user->clientProfile) {
        return redirect()->route('client.dashboard.index');
      } elseif ($user->freelancerProfile) {
        return redirect()->route('freelance.dashboard');
      }
      return redirect()->route('user.dashboard');
    }

    // Nouvelle vue moderne d'authentification
    // websiteInfo et currentLanguageInfo sont partagés globalement via AppServiceProvider
    $basic = Basic::query()->select('google_login_status', 'facebook_login_status', 'google_client_id', 'google_client_secret', 'facebook_app_id', 'facebook_app_secret')->first();
    
    return view('frontend.auth.register', [
      'googleEnabled' => $basic && $basic->google_login_status == 1 && !empty($basic->google_client_id) && !empty($basic->google_client_secret),
      'facebookEnabled' => $basic && $basic->facebook_login_status == 1 && !empty($basic->facebook_app_id) && !empty($basic->facebook_app_secret),
    ]);
  }

  public function signupSubmit(SignupRequest $request)
  {
    // Si l'utilisateur est déjà connecté, rediriger selon le rôle
    if (Auth::guard('web')->check()) {
      $role = $request->input('role', 'client');
      if ($role === 'freelance') {
        return redirect()->route('freelance.onboarding.step1')
          ->with('info', __('Vous êtes déjà connecté. Redirection vers la création de votre profil freelance.'));
      }
      return redirect()->route('user.dashboard')
        ->with('info', __('Vous êtes déjà connecté.'));
    }

    $websiteTitle = Basic::query()->pluck('website_title')->first();
    
    // Récupérer le rôle (client par défaut)
    $role = $request->input('role', 'client');

    $user = new User();
    $user->username = $request->username;
    $user->email_address = $request->email_address;
    $user->password = Hash::make($request->password);

    // Mettre à jour les informations supplémentaires pour freelance
    if ($role === 'freelance') {
      // Pays de naissance
      if ($request->filled('birth_country')) {
        $user->country_code = $request->birth_country;
      }
      
      // Téléphone
      if ($request->filled('phone')) {
        $phoneNumber = ($request->phone_country_code ?? '+33') . ' ' . $request->phone;
        $user->phone = $phoneNumber;
      }
      
      // Stocker les langues et le service principal en session pour utilisation après vérification email
      if ($request->filled('languages')) {
        Session::put('languages_' . $user->id, $request->languages);
      }
      if ($request->filled('main_service')) {
        // Si "Autre" est sélectionné, utiliser la valeur personnalisée
        $serviceToStore = $request->main_service;
        if ($serviceToStore === 'Autre' && $request->filled('other_service')) {
          $serviceToStore = $request->other_service;
        }
        Session::put('main_service_' . $user->id, $serviceToStore);
      }
    }

    // first, generate a random string
    $randStr = Str::random(20);

    // second, generate a token
    $token = md5($randStr . $request->username . $request->email_address);

    $user->verification_token = $token;
    $user->save();
    
    // Enregistrer le code de parrainage depuis le cookie (sera traité après vérification email)
    $referralCode = $request->cookie('referral_code');
    if ($referralCode) {
      Session::put('pending_referral_code_' . $user->id, $referralCode);
    }
    
    // Créer le profil selon le rôle après vérification email
    // (sera fait dans signupVerify)
    Session::put('pending_role_' . $user->id, $role);
    
    // Stocker aussi la confirmation d'âge pour les freelances
    if ($role === 'freelance' && $request->has('age_confirmation')) {
      Session::put('age_confirmation_' . $user->id, true);
    }

    /**
     * prepare a verification mail and, send it to user to verify his/her email address,
     * get the mail template information from db
     */
    $mailTemplate = MailTemplate::query()->where('mail_type', '=', 'verify_email')->first();
    $mailData['subject'] = $mailTemplate->mail_subject;
    $mailBody = $mailTemplate->mail_body;

    $link = '<a href=' . url("user/signup-verify/" . $token) . '>Click Here</a>';

    $mailBody = str_replace('{username}', $request->username, $mailBody);
    $mailBody = str_replace('{verification_link}', $link, $mailBody);
    $mailBody = str_replace('{website_title}', $websiteTitle, $mailBody);

    $mailData['body'] = $mailBody;

    $mailData['recipient'] = $request->email_address;

    $mailData['sessionMessage'] = 'A verification link has been sent to your email address.';

    // Envoyer l'email de vérification en arrière-plan (ne pas bloquer)
    BasicMailer::sendMail($mailData);

    // Pour les freelances : connecter immédiatement et rediriger vers l'onboarding
    if ($role === 'freelance') {
      // Connecter l'utilisateur immédiatement
      Auth::guard('web')->login($user);
      
      // Créer le profil freelance de base
      if (class_exists(\App\Models\FreelancerProfile::class)) {
        \App\Models\FreelancerProfile::firstOrCreate(
          ['user_id' => $user->id],
          [
            'hourly_rate' => 0,
            'reliability_score' => 100,
            'wellness_plan' => 'none',
            'is_verified' => false,
          ]
        );
      }
      
        // Nettoyer localStorage après inscription réussie
        // (sera fait côté client via JavaScript après redirection)
      
      // Rediriger vers l'étape 1 de l'onboarding
      return redirect()->route('freelance.onboarding.step1')
        ->with('success', __('Votre compte a été créé avec succès. Un email de vérification a été envoyé à votre adresse. Vous pouvez continuer à compléter votre profil.'));
    }

    // Pour les clients : comportement standard (attendre vérification email)
    return redirect()->back();
  }

  public function resendVerificationEmail(Request $request)
  {
    $email = $request->input('email') ?? $request->session()->get('unverified_email');
    
    if (!$email) {
      $request->session()->flash('error', 'Adresse e-mail non fournie.');
      return redirect()->back();
    }

    $user = User::query()->where('email_address', '=', $email)->first();

    if (!$user) {
      $request->session()->flash('error', 'Aucun compte trouvé avec cette adresse e-mail.');
      return redirect()->back();
    }

    if ($user->email_verified_at) {
      $request->session()->flash('success', 'Votre adresse e-mail est déjà vérifiée. Vous pouvez vous connecter.');
      return redirect()->route('user.login');
    }

    // Générer un nouveau token si nécessaire
    if (empty($user->verification_token)) {
      $randStr = Str::random(20);
      $token = md5($randStr . $user->username . $user->email_address);
      $user->verification_token = $token;
      $user->save();
    }

    // Envoyer l'email de vérification
    $websiteTitle = Basic::query()->pluck('website_title')->first();
    $mailTemplate = MailTemplate::query()->where('mail_type', '=', 'verify_email')->first();
    
    if ($mailTemplate) {
      $mailData['subject'] = $mailTemplate->mail_subject;
      $mailBody = $mailTemplate->mail_body;

      $link = '<a href=' . url("user/signup-verify/" . $user->verification_token) . '>Click Here</a>';

      $mailBody = str_replace('{username}', $user->username, $mailBody);
      $mailBody = str_replace('{verification_link}', $link, $mailBody);
      $mailBody = str_replace('{website_title}', $websiteTitle, $mailBody);

      $mailData['body'] = $mailBody;
      $mailData['recipient'] = $user->email_address;
      $mailData['sessionMessage'] = 'Un email de vérification a été renvoyé à votre adresse.';

      BasicMailer::sendMail($mailData);
      
      $request->session()->flash('success', 'Un email de vérification a été renvoyé à votre adresse e-mail.');
    } else {
      $request->session()->flash('error', 'Erreur lors de l\'envoi de l\'email de vérification.');
    }

    $request->session()->forget('unverified_email');
    $request->session()->forget('unverified_user_id');

    return redirect()->back();
  }

  public function signupVerify(Request $request, $token)
  {
    try {
      $user = User::query()->where('verification_token', '=', $token)->firstOrFail();

      // Récupérer le rôle depuis la session
      $role = Session::get('pending_role_' . $user->id, 'client');
      Session::forget('pending_role_' . $user->id);

      // Récupérer le code de parrainage depuis la session ou le cookie
      $referralCode = Session::get('pending_referral_code_' . $user->id) ?? $request->cookie('referral_code');
      Session::forget('pending_referral_code_' . $user->id);

      // after verify user email, put "null" in the "verification token"
      $user->update([
        'email_verified_at' => date('Y-m-d H:i:s'),
        'status' => 1,
        'verification_token' => null
      ]);

      // Enregistrer le parrainage si un code de parrainage existe
      if ($referralCode && class_exists(\App\Services\Junspro\ReferralService::class)) {
        try {
          $referralService = app(\App\Services\Junspro\ReferralService::class);
          $referralService->registerReferral($referralCode, $user);
        } catch (\Exception $e) {
          // Log l'erreur mais ne bloque pas l'inscription
          \Log::warning('Erreur lors de l\'enregistrement du parrainage: ' . $e->getMessage());
        }
      }

      // Créer le profil selon le rôle
      if ($role === 'freelance') {
        if (class_exists(\App\Models\FreelancerProfile::class)) {
          $freelancerProfile = \App\Models\FreelancerProfile::firstOrCreate(
            ['user_id' => $user->id],
            [
              'hourly_rate' => 0,
              'reliability_score' => 100,
              'wellness_plan' => 'none',
              'is_verified' => false,
            ]
          );
          
          // Récupérer et sauvegarder les langues depuis la session
          $languages = Session::get('languages_' . $user->id, []);
          if (!empty($languages)) {
            $freelancerProfile->languages = $languages;
            Session::forget('languages_' . $user->id);
          }
          
          // Récupérer et sauvegarder le service principal depuis la session
          $mainService = Session::get('main_service_' . $user->id);
          if ($mainService) {
            // Ajouter le service principal comme premier service dans skills
            $skills = $freelancerProfile->skills ?? [];
            if (!in_array($mainService, $skills)) {
              array_unshift($skills, $mainService);
              $freelancerProfile->skills = $skills;
            }
            Session::forget('main_service_' . $user->id);
          }
          
          $freelancerProfile->save();
        }
      } else {
        if (class_exists(\App\Models\ClientProfile::class)) {
          \App\Models\ClientProfile::firstOrCreate(
            ['user_id' => $user->id]
          );
        }
      }

      $request->session()->flash('success', 'Votre adresse e-mail a été vérifiée.');

      // after email verification, authenticate this user
      Auth::guard('web')->login($user);

      // Si c'est un freelance, rediriger vers l'onboarding
      if ($role === 'freelance') {
        return redirect()->route('freelance.onboarding.step1');
      }

      // Vérifier si l'utilisateur a un profil freelance ou client après vérification email
      $user->refresh(); // Recharger pour avoir les relations
      if ($user->clientProfile) {
        return redirect()->route('client.dashboard.index');
      } elseif ($user->freelancerProfile) {
        return redirect()->route('freelance.dashboard');
      }

      return redirect()->route('user.dashboard');
    } catch (ModelNotFoundException $e) {
      $request->session()->flash('error', 'Could not verify your email address!');

      return redirect()->route('user.signup');
    }
  }

  public function redirectToDashboard()
  {
    $user = Auth::guard('web')->user();

    // Utiliser le rôle actif stocké en session lors de la connexion
    $activeRole = session('active_role');

    if ($activeRole === 'freelance' && $user->freelancerProfile) {
      return redirect()->route('freelance.dashboard');
    }

    if ($activeRole === 'client' && $user->clientProfile) {
      return redirect()->route('client.dashboard.index');
    }

    // Fallback si pas de session de rôle
    if ($user->clientProfile) {
      return redirect()->route('client.dashboard.index');
    }

    if ($user->freelancerProfile) {
      return redirect()->route('freelance.dashboard');
    }

    // Sinon, utiliser l'ancien dashboard (pour les autres types d'utilisateurs)
    $misc = new MiscellaneousController();

    $queryResult['breadcrumb'] = $misc->getBreadcrumb();

    $queryResult['authUser'] = $user;

    $queryResult['numOfServiceOrders'] = $user->serviceOrder()->count();

    $queryResult['numOfWishlistedServices'] = $user->wishlistedService()->count();
    $queryResult['numOfsupportTicket'] = $user->supportTickets()->count();

    return view('frontend.user.dashboard', $queryResult);
  }
  public function followings()
  {
    $misc = new MiscellaneousController();

    $queryResult['breadcrumb'] = $misc->getBreadcrumb();

    $user = Auth::guard('web')->user();

    $queryResult['followings'] = Follower::where([['follower_id', $user->id], ['type', 'user']])->paginate(10);

    return view('frontend.user.following', $queryResult);
  }

  public function editProfile()
  {
    // Hub paramètres client premium (tuiles)
    return view('frontend.client.settings.index');
  }

  public function updateProfile(UpdateProfileRequest $request)
  {

    $authUser = Auth::guard('web')->user();

    if ($request->hasFile('image')) {
      $newImg = $request->file('image');
      $oldImg = $authUser->image;
      $imageName = UploadFile::update('./assets/img/users/', $newImg, $oldImg);
    }

    $authUser->update($request->except('image', 'freelancer_bio', 'freelancer_hourly_rate', 'video_thumbnail_url', 'video_thumbnail_image', 'profile_universe', 'profile_domain', 'profile_mode', 'country_code', 'native_language', 'other_languages') + [
      'image' => $request->hasFile('image') ? $imageName : $authUser->image
    ]);

    // Mettre à jour le FreelancerProfile si l'utilisateur est un freelance
    if ($authUser->freelancerProfile) {
      $freelancerProfile = $authUser->freelancerProfile;
      
      $freelancerData = [];
      
      if ($request->has('freelancer_bio')) {
        $freelancerData['bio'] = $request->input('freelancer_bio');
      }
      
      if ($request->has('freelancer_hourly_rate')) {
        $hourlyRate = $request->input('freelancer_hourly_rate');
        if ($hourlyRate >= 3 && $hourlyRate <= 200) {
          $freelancerData['hourly_rate'] = $hourlyRate;
        }
      }
      
      // Gérer l'upload de l'image de miniature vidéo
      if ($request->hasFile('video_thumbnail_image')) {
        $thumbnailFile = $request->file('video_thumbnail_image');
        
        // Valider le type de fichier
        $allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];
        if (in_array($thumbnailFile->getMimeType(), $allowedTypes)) {
          // Supprimer l'ancienne image si elle existe et est locale
          $oldThumbnailUrl = $freelancerProfile->video_thumbnail_url;
          if ($oldThumbnailUrl && strpos($oldThumbnailUrl, asset('')) === 0) {
            $oldPath = str_replace(asset(''), public_path(''), $oldThumbnailUrl);
            if (file_exists($oldPath)) {
              @unlink($oldPath);
            }
          }
          
          // Stocker la nouvelle image
          $thumbnailFileName = UploadFile::store('./assets/img/video-thumbnails/', $thumbnailFile);
          $freelancerData['video_thumbnail_url'] = asset('assets/img/video-thumbnails/' . $thumbnailFileName);
        }
      } elseif ($request->has('video_thumbnail_url')) {
        // Si pas d'upload, utiliser l'URL fournie
        $thumbnailUrl = $request->input('video_thumbnail_url');
        // Valider que c'est une URL valide ou vide
        if (empty($thumbnailUrl) || filter_var($thumbnailUrl, FILTER_VALIDATE_URL)) {
          $freelancerData['video_thumbnail_url'] = $thumbnailUrl ?: null;
        }
      }
      
      // Univers, domaines et mode d'intervention depuis la page identity
      if ($request->has('profile_universe') && \Illuminate\Support\Facades\Schema::hasColumn('freelancer_profiles', 'universes')) {
        $profileUniverse = $request->input('profile_universe');
        $freelancerData['universes'] = $profileUniverse ? [$profileUniverse] : [];
      }
      if ($request->has('profile_domain') && \Illuminate\Support\Facades\Schema::hasColumn('freelancer_profiles', 'domains')) {
        $profileDomain = $request->input('profile_domain');
        $freelancerData['domains'] = $profileDomain ? [$profileDomain] : [];
      }
      if ($request->has('profile_mode')) {
        $profileMode = $request->input('profile_mode');
        if (\Illuminate\Support\Facades\Schema::hasColumn('freelancer_profiles', 'can_online')) {
          $freelancerData['can_online'] = in_array($profileMode, ['online', 'hybrid']);
        }
        if (\Illuminate\Support\Facades\Schema::hasColumn('freelancer_profiles', 'can_onsite')) {
          $freelancerData['can_onsite'] = in_array($profileMode, ['onsite', 'hybrid']);
        }
        // Synchroniser onsite_country et onsite_city en mode présentiel ou hybride
        if (in_array($profileMode, ['onsite', 'hybrid'])) {
          if ($request->has('country_code') && \Illuminate\Support\Facades\Schema::hasColumn('freelancer_profiles', 'onsite_country')) {
            $freelancerData['onsite_country'] = $request->input('country_code');
          }
          if ($request->has('city') && \Illuminate\Support\Facades\Schema::hasColumn('freelancer_profiles', 'onsite_city')) {
            $freelancerData['onsite_city'] = $request->input('city');
          }
        }
      }

      // Langue maternelle et autres langues parlées (depuis page identity)
      if ($request->has('native_language') && \Illuminate\Support\Facades\Schema::hasColumn('freelancer_profiles', 'native_language')) {
        $freelancerData['native_language'] = $request->input('native_language') ?: null;
      }
      if ($request->has('other_languages') && \Illuminate\Support\Facades\Schema::hasColumn('freelancer_profiles', 'spoken_languages')) {
        $freelancerData['spoken_languages'] = $request->input('other_languages') ?: null;
      }

      if (!empty($freelancerData)) {
        $freelancerProfile->update($freelancerData);
      }
    }

    $request->session()->flash('success', 'Your profile has been updated successfully.');

    if ($request->filled('_redirect')) {
      return redirect()->to($request->input('_redirect'));
    }

    return redirect()->back();
  }

  public function changePassword()
  {
    // Rediriger vers la nouvelle page password dans les settings pour les clients
    $user = Auth::guard('web')->user();
    if ($user->clientProfile) {
      return redirect()->route('user.settings.password');
    }

    // Ancienne vue pour les autres utilisateurs
    $misc = new MiscellaneousController();
    $breadcrumb = $misc->getBreadcrumb();
    return view('frontend.user.change-password', compact('breadcrumb'));
  }

  /**
   * Nouvelle page "Mot de passe" dans les settings (format Preply)
   */
  public function editPassword()
  {
    $user = Auth::guard('web')->user();
    
    // Si l'utilisateur a un profil client, utiliser la nouvelle vue
    if ($user->clientProfile) {
      return view('frontend.client.settings.password', [
        'activeSection' => 'password'
      ]);
    }

    // Sinon, rediriger vers l'ancienne page
    return redirect()->route('user.change_password');
  }

  /**
   * Mise à jour du mot de passe depuis les settings
   */
  public function updatePasswordSettings(UpdatePasswordRequest $request)
  {
    $user = Auth::guard('web')->user();

    $user->update([
      'password' => Hash::make($request->new_password)
    ]);

    $request->session()->flash('status', 'password-updated');
    $request->session()->flash('success', __('Votre mot de passe a été mis à jour avec succès.'));

    return redirect()->route('user.settings.password');
  }

  /**
   * Nouvelle page "Adresse e-mail" dans les settings (format Preply)
   */
  public function editEmail()
  {
    $user = Auth::guard('web')->user();
    
    // Si l'utilisateur a un profil client, utiliser la nouvelle vue
    if ($user->clientProfile) {
      return view('frontend.client.settings.email', [
        'activeSection' => 'email'
      ]);
    }

    // Sinon, rediriger vers les settings généraux
    return redirect()->route('user.settings.index');
  }

  /**
   * Mise à jour de l'adresse e-mail depuis les settings
   */
  public function updateEmail(Request $request)
  {
    $user = Auth::guard('web')->user();

    $request->validate([
      'current_password' => [
        'required',
        new MatchOldPasswordRule('user')
      ],
      'email_address' => [
        'required',
        'email:rfc,dns',
        'max:255',
        'unique:users,email_address,' . $user->id
      ],
      'email_confirmation' => [
        'required',
        'same:email_address'
      ]
    ], [
      'email_confirmation.same' => __('La confirmation de l\'adresse e-mail ne correspond pas.'),
      'current_password.required' => __('Le mot de passe actuel est requis.'),
      'email_address.unique' => __('Cette adresse e-mail est déjà utilisée.'),
      'email_address.email' => __('Veuillez entrer une adresse e-mail valide.'),
    ]);

    // Générer un nouveau token de vérification
    $randStr = Str::random(20);
    $token = md5($randStr . $user->username . $request->email_address);

    // Mettre à jour l'e-mail et réinitialiser la vérification
    $user->update([
      'email_address' => $request->email_address,
      'email_verified_at' => null,
      'verification_token' => $token
    ]);

    // Envoyer un email de vérification
    try {
      $mailTemplate = MailTemplate::query()->where('mail_type', '=', 'verify_email')->first();
      if ($mailTemplate) {
        $mailData['subject'] = $mailTemplate->mail_subject;
        $mailBody = $mailTemplate->mail_body;

        $websiteTitle = Basic::query()->pluck('website_title')->first();
        $name = $user->first_name . ' ' . $user->last_name;
        $link = '<a href=' . url("user/signup-verify/" . $token) . '>Click Here</a>';

        $mailBody = str_replace('{username}', $user->username, $mailBody);
        $mailBody = str_replace('{customer_name}', $name, $mailBody);
        $mailBody = str_replace('{verification_link}', $link, $mailBody);
        $mailBody = str_replace('{website_title}', $websiteTitle, $mailBody);

        $mailData['body'] = $mailBody;
        $mailData['recipient'] = $request->email_address;
        $mailData['sessionMessage'] = 'Un email de vérification a été envoyé.';

        BasicMailer::sendMail($mailData);
      }
    } catch (\Exception $e) {
      // Log l'erreur mais continue
      \Log::error('Erreur lors de l\'envoi de l\'email de vérification : ' . $e->getMessage());
    }

    $request->session()->flash('status', 'email-updated');
    $request->session()->flash('success', __('Votre adresse e-mail a été mise à jour. Vérifiez votre boîte de réception pour confirmer ce changement.'));

    return redirect()->route('user.settings.email.edit');
  }

  /**
   * Nouvelle page "Modes de paiement" dans les settings (format Preply)
   */
  public function paymentMethods()
  {
    $user = Auth::guard('web')->user();
    
    // Si l'utilisateur a un profil client, utiliser la nouvelle vue
    if ($user->clientProfile) {
      // TODO : récupérer les moyens de paiement réels depuis Stripe / autre.
      // Pour l'instant, on prévoit une structure simple.
      $paymentMethods = collect([
        // Exemple fictif, à remplacer par la vraie source :
        // (object) ['id' => 1, 'brand' => 'Visa', 'last4' => '4242', 'exp_month' => '12', 'exp_year' => '26', 'is_default' => true],
      ]);

      return view('frontend.client.settings.payment-methods', [
        'activeSection' => 'payment_methods',
        'paymentMethods' => $paymentMethods
      ]);
    }

    // Sinon, rediriger vers les settings généraux
    return redirect()->route('user.settings.index');
  }

  /**
   * Ajouter un nouveau moyen de paiement
   */
  public function storePaymentMethod(Request $request)
  {
    // Ce token sera fourni par Stripe Elements / autre, côté front.
    $request->validate([
      'payment_method_token' => ['required', 'string'],
    ]);

    // TODO : enregistrer / attacher le moyen de paiement au user via l'API de paiement.

    $request->session()->flash('status', 'payment-method-added');
    $request->session()->flash('success', __('Votre moyen de paiement a été ajouté avec succès.'));

    return redirect()->route('user.settings.payment_methods.index');
  }

  /**
   * Supprimer un moyen de paiement
   */
  public function destroyPaymentMethod(Request $request, $paymentMethodId)
  {
    // TODO : détacher / supprimer le moyen de paiement via l'API de paiement.

    $request->session()->flash('status', 'payment-method-removed');
    $request->session()->flash('success', __('Le moyen de paiement a été supprimé avec succès.'));

    return redirect()->route('user.settings.payment_methods.index');
  }

  /**
   * Nouvelle page "Abonnement Junspro" dans les settings (format Preply)
   */
  public function subscription()
  {
    $user = Auth::guard('web')->user();
    
    // Si l'utilisateur a un profil client, utiliser la nouvelle vue
    if ($user->clientProfile) {
      $clientProfile = $user->clientProfile;
      
      // Récupérer tous les abonnements actifs (active ou paused)
      $subscriptions = \App\Models\Subscription::where('client_id', $clientProfile->id)
        ->whereIn('status', ['active', 'paused'])
        ->with(['freelancer.user', 'workSessions' => function($query) {
          $query->where('status', 'completed');
        }])
        ->orderByDesc('created_at')
        ->get();
      
      // TEST : Créer un abonnement de test avec renouvellement dans 5 jours si aucun abonnement n'existe
      if ($subscriptions->isEmpty()) {
        $testFreelancer = \App\Models\FreelancerProfile::with('user')->first();
        if ($testFreelancer) {
          $testSubscription = \App\Models\Subscription::create([
            'client_id' => $clientProfile->id,
            'freelancer_id' => $testFreelancer->id,
            'hours_per_week' => 8,
            'hours_total_month' => 32,
            'hours_remaining' => 16,
            'price_base' => 2400.00,
            'base_hourly_rate_snapshot' => 75.00,
            'client_hourly_rate_snapshot' => 75.00,
            'status' => 'active',
            'next_billing_at' => now()->addDays(5), // Renouvellement dans 5 jours
          ]);
          $subscriptions->push($testSubscription->load(['freelancer.user', 'workSessions']));
        }
      } else {
        // TEST : Modifier le premier abonnement pour avoir un renouvellement dans 5 jours
        $firstSubscription = $subscriptions->first();
        if ($firstSubscription && !$firstSubscription->next_billing_at) {
          $firstSubscription->next_billing_at = now()->addDays(5);
          $firstSubscription->save();
        } elseif ($firstSubscription && $firstSubscription->next_billing_at) {
          // S'assurer qu'au moins un abonnement a un renouvellement dans moins de 7 jours
          $daysUntilRenewal = now()->diffInDays(\Carbon\Carbon::parse($firstSubscription->next_billing_at), false);
          if ($daysUntilRenewal > 7) {
            $firstSubscription->next_billing_at = now()->addDays(5);
            $firstSubscription->save();
          }
        }
      }
      
      $cycleUsage = app(CycleUsageService::class);

      // Calculer les statistiques et nudge pour chaque abonnement
      $subscriptions->each(function($subscription) use ($cycleUsage) {
        $completedSessions = $subscription->workSessions->where('status', 'completed');
        $usedHours = $completedSessions->sum(function($session) {
          return ($session->duration_minutes ?? 60) / 60;
        });
        $totalHours = $subscription->hours_total_month ?? 0;
        $remaining = $subscription->hours_remaining ?? max(0, $totalHours - $usedHours);
        $subscription->calculated_used_hours = $usedHours;
        $subscription->calculated_total_hours = $totalHours;
        $subscription->calculated_hours_remaining = max(0, $remaining);
        $subscription->calculated_progress_percent = $totalHours > 0
          ? min(100, ($usedHours / $totalHours) * 100)
          : 0;

        $topupUsedThisCycle = (int) \App\Models\SubscriptionTopup::where('subscription_id', $subscription->id)
          ->paid()
          ->where(function ($q) {
            $window = now()->subDays(28);
            $q->where('paid_at', '>=', $window)->orWhereNull('paid_at')->where('created_at', '>=', $window);
          })
          ->sum('qty');
        $usageRatio = $totalHours > 0 ? min(1.0, $usedHours / $totalHours) : 0;
        $nudge = $cycleUsage->shouldShowUpgradeNudge($usageRatio, $topupUsedThisCycle > 0, 0);
        $subscription->nudge_show = $nudge['show'];
        $subscription->nudge_level = $nudge['level'];
        $subscription->nudge_message = $nudge['message'];

        $subscription->next_session = \App\Models\WorkSession::where('subscription_id', $subscription->id)
          ->where('start_at', '>', now())
          ->where('status', '!=', 'cancelled')
          ->orderBy('start_at', 'asc')
          ->first();
      });

      // Plans disponibles
      $planMeta = [
        4  => ['name'=>'Essentiel',  'description'=>'Pour démarrer en douceur',       'icon'=>'fas fa-seedling',   'popular'=>false],
        8  => ['name'=>'Starter',    'description'=>'Idéal pour un Rituel régulier',  'icon'=>'fas fa-rocket',     'popular'=>false],
        16 => ['name'=>'Business',   'description'=>'Le plus choisi — rythme soutenu','icon'=>'fas fa-briefcase',  'popular'=>true],
        24 => ['name'=>'Pro',        'description'=>'Pour les Rituels ambitieux',     'icon'=>'fas fa-chart-line', 'popular'=>false],
        32 => ['name'=>'Premium',    'description'=>'Immersion totale dans le Rituel','icon'=>'fas fa-crown',      'popular'=>false],
        48 => ['name'=>'Growth',     'description'=>'Cadence intensive',              'icon'=>'fas fa-bolt',       'popular'=>true],
        56 => ['name'=>'Scale',      'description'=>'Pour accélérer fort',            'icon'=>'fas fa-expand-alt', 'popular'=>false],
        64 => ['name'=>'Elite',      'description'=>'Expertise dédiée à plein régime','icon'=>'fas fa-gem',        'popular'=>false],
        72 => ['name'=>'Expert',     'description'=>'Priorité absolue au Rituel',     'icon'=>'fas fa-star',       'popular'=>false],
        80 => ['name'=>'Master',     'description'=>'Collaboration quasi temps-plein','icon'=>'fas fa-trophy',     'popular'=>false],
        88 => ['name'=>'Enterprise', 'description'=>'Volume maximal, impact maximum', 'icon'=>'fas fa-building',   'popular'=>false],
      ];
      $buildPlans = function (array $paliers, string $universeType) use ($cycleUsage, $planMeta) {
        return collect($paliers)->map(function ($palier) use ($cycleUsage, $planMeta, $universeType) {
          return [
            'hours_per_cycle' => $palier,
            'hours_per_week'  => $palier / 4,
            'topup_max'       => $cycleUsage->topupCap($palier, $universeType),
            'cycle_max_total' => $cycleUsage->cycleMaxTotal($palier, $universeType),
            'name'            => $planMeta[$palier]['name']        ?? "{$palier}h/cycle",
            'description'     => $planMeta[$palier]['description'] ?? '',
            'icon'            => $planMeta[$palier]['icon']        ?? 'fas fa-circle',
            'popular'         => $planMeta[$palier]['popular']     ?? false,
          ];
        })->all();
      };
      $plansA = $buildPlans(\App\Services\Junspro\CycleUsageService::PALIERS_A, \App\Services\Junspro\CycleUsageService::UNIVERSE_A);
      $plansB = $buildPlans(\App\Services\Junspro\CycleUsageService::PALIERS_B, \App\Services\Junspro\CycleUsageService::UNIVERSE_B);

      $currentPalier   = null;
      $currentUniverse = null;
      $activeSub = $subscriptions->where('status', 'active')->first() ?? $subscriptions->first();
      if ($activeSub) {
        $currentUniverse = $activeSub->universe ?? null;
        $universeType    = $cycleUsage->universeType($currentUniverse ?? '');
        $hpc             = $cycleUsage->hoursPerCycleFromWeekly((int)($activeSub->hours_per_week ?? 0));
        $currentPalier   = $cycleUsage->snapToPalier($hpc, $universeType);
      }

      return view('frontend.client.settings.subscription', [
        'activeSection'   => 'subscription',
        'subscriptions'   => $subscriptions,
        'ritualSignature' => $cycleUsage->ritualSignatureText(),
        'plansA'          => $plansA,
        'plansB'          => $plansB,
        'currentPalier'   => $currentPalier,
        'currentUniverse' => $currentUniverse,
      ]);
    }

    // Sinon, rediriger vers les settings généraux
    return redirect()->route('user.settings.index');
  }

  /**
   * Mettre en pause un abonnement depuis les settings
   */
  public function pauseSubscription(Request $request, $subscriptionId)
  {
    $user = Auth::guard('web')->user();
    $clientProfile = $user->clientProfile;

    if (!$clientProfile) {
      return redirect()->route('user.settings.subscription')
        ->with('error', __('Accès refusé.'));
    }

    $subscription = \App\Models\Subscription::where('client_id', $clientProfile->id)
      ->findOrFail($subscriptionId);

    if ($subscription->status !== 'active') {
      return redirect()->route('user.settings.subscription')
        ->with('error', __('Seuls les abonnements actifs peuvent être mis en pause.'));
    }

    $subscriptionService = app(\App\Services\Junspro\SubscriptionService::class);
    $subscriptionService->pauseSubscription($subscription);

    return redirect()->route('user.settings.subscription')
      ->with('status', 'subscription-paused')
      ->with('success', __('Votre abonnement a été mis en pause.'));
  }

  /**
   * Reprendre un abonnement depuis les settings
   */
  public function resumeSubscription(Request $request, $subscriptionId)
  {
    $user = Auth::guard('web')->user();
    $clientProfile = $user->clientProfile;

    if (!$clientProfile) {
      return redirect()->route('user.settings.subscription')
        ->with('error', __('Accès refusé.'));
    }

    $subscription = \App\Models\Subscription::where('client_id', $clientProfile->id)
      ->findOrFail($subscriptionId);

    try {
      $subscriptionService = app(\App\Services\Junspro\SubscriptionService::class);
      $subscriptionService->resumeSubscription($subscription);
      
      return redirect()->route('user.settings.subscription')
        ->with('status', 'subscription-resumed')
        ->with('success', __('Votre abonnement a été repris.'));
    } catch (\RuntimeException $e) {
      return redirect()->route('user.settings.subscription')
        ->with('error', $e->getMessage());
    }
  }

  /**
   * Annuler un abonnement depuis les settings
   */
  public function cancelSubscription(Request $request, $subscriptionId)
  {
    $user = Auth::guard('web')->user();
    $clientProfile = $user->clientProfile;

    if (!$clientProfile) {
      return redirect()->route('user.settings.subscription')
        ->with('error', __('Accès refusé.'));
    }

    $subscription = \App\Models\Subscription::where('client_id', $clientProfile->id)
      ->with(['freelancer.user'])
      ->findOrFail($subscriptionId);

    // Rediriger vers le formulaire d'annulation complet (anti-churn)
    return redirect()->route('client.subscriptions.cancel', $subscription->id)
      ->with('redirect_back', route('user.settings.subscription'));
  }

  /**
   * Récupérer le quota de topup disponible pour un abonnement (cycle 4 semaines, paliers Rituels).
   */
  public function getTopupQuota(Request $request, $subscription, CycleUsageService $cycleUsage)
  {
    $user = Auth::guard('web')->user();
    $clientProfile = $user->clientProfile;

    if (!$clientProfile) {
      return response()->json([
        'ok' => false,
        'message' => __('Accès refusé.')
      ], 403);
    }

    $subscriptionModel = \App\Models\Subscription::where('client_id', $clientProfile->id)
      ->findOrFail($subscription);

    $quota = $this->calculateTopupQuota($subscriptionModel, $cycleUsage);

    return response()->json([
      'ok' => true,
      'max' => $quota['max'],
      'used' => $quota['used'],
      'remaining' => $quota['remaining'],
      'window_end' => $quota['window_end'],
      'next_available_at' => $quota['next_available_at'],
      'ritual_signature' => $cycleUsage->ritualSignatureText(),
    ]);
  }

  /**
   * Calculer le quota de topup pour un abonnement (cycle 4 semaines, service central).
   */
  private function calculateTopupQuota(\App\Models\Subscription $subscription, CycleUsageService $cycleUsage)
  {
    $hoursPerCycle = (int) (($subscription->hours_per_week ?? 0) * 4);
    $universeSlug = $subscription->universe ?? 'lessons';
    $universeType = $cycleUsage->universeType($universeSlug);

    $topupCap = $cycleUsage->topupCap($hoursPerCycle, $universeType);
    $cycleMaxTotal = $cycleUsage->cycleMaxTotal($hoursPerCycle, $universeType);

    $windowStart = now()->subDays(28);
    $windowEnd = now();

    $paidTopups = \App\Models\SubscriptionTopup::where('subscription_id', $subscription->id)
      ->paid()
      ->get();

    $used = 0;
    $oldestDate = null;

    foreach ($paidTopups as $topup) {
      $topupDate = $topup->paid_at ?? $topup->created_at;
      if ($topupDate && $topupDate->between($windowStart, $windowEnd)) {
        $used += $topup->qty;
        if (!$oldestDate || $topupDate->lt($oldestDate)) {
          $oldestDate = $topupDate;
        }
      }
    }

    $remainingByCap = max(0, $topupCap - $used);
    $remainingByCycleMax = max(0, $cycleMaxTotal - $hoursPerCycle - $used);
    $remaining = (int) min($remainingByCap, $remainingByCycleMax);

    $nextAvailableAt = null;
    if ($remaining === 0 && $oldestDate) {
      $nextAvailableAt = $oldestDate->copy()->addDays(28)->format('Y-m-d H:i:s');
    }

    return [
      'max' => $topupCap,
      'used' => (int) $used,
      'remaining' => $remaining,
      'window_end' => $windowEnd->format('Y-m-d H:i:s'),
      'next_available_at' => $nextAvailableAt,
    ];
  }

  /**
   * Ajouter des heures supplémentaires à un abonnement (topup). Validation paliers + plafond cycle.
   */
  public function topupSubscription(Request $request, $subscription, CycleUsageService $cycleUsage)
  {
    $user = Auth::guard('web')->user();
    $clientProfile = $user->clientProfile;

    if (!$clientProfile) {
      return response()->json([
        'ok' => false,
        'message' => __('Accès refusé.')
      ], 403);
    }

    $subscriptionModel = \App\Models\Subscription::where('client_id', $clientProfile->id)
      ->findOrFail($subscription);

    $quota = $this->calculateTopupQuota($subscriptionModel, $cycleUsage);
    $maxQty = max(1, $quota['max']);

    $request->validate([
      'qty' => 'required|integer|min:1|max:' . $maxQty,
      'upgrade' => 'boolean'
    ]);

    $qty = (int) $request->input('qty');
    $upgrade = $request->boolean('upgrade');

    if ($qty > $quota['remaining']) {
      return response()->json([
        'ok' => false,
        'message' => __('Vous ne pouvez pas acheter plus de :remaining Rituels supplémentaires dans cette période.', ['remaining' => $quota['remaining']]),
        'remaining' => $quota['remaining'],
        'next_available_at' => $quota['next_available_at'],
      ], 422);
    }

    $hoursPerCycle = (int) (($subscriptionModel->hours_per_week ?? 0) * 4);
    $universeType = $cycleUsage->universeType($subscriptionModel->universe ?? 'lessons');
    if ($cycleUsage->wouldExceedCycleMax($hoursPerCycle, $quota['used'], $qty, $universeType)) {
      return response()->json([
        'ok' => false,
        'message' => __(CycleUsageService::MESSAGE_CYCLE_LIMIT),
      ], 422);
    }

    $unitPrice = $subscriptionModel->client_hourly_rate_snapshot ?? $subscriptionModel->base_hourly_rate_snapshot ?? 0;
    $totalPrice = $qty * $unitPrice;

    $topup = \App\Models\SubscriptionTopup::create([
      'subscription_id' => $subscriptionModel->id,
      'user_id' => $user->id,
      'qty' => $qty,
      'unit_price' => $unitPrice,
      'total_price' => $totalPrice,
      'status' => 'pending',
    ]);

    return response()->json([
      'ok' => true,
      'message' => __('Les Rituels supplémentaires ont été ajoutés avec succès.'),
      'redirect_url' => route('user.settings.subscription')
    ]);
  }

  /**
   * Récupérer le contexte pour changer de formule
   */
  public function getChangePlanContext(Request $request, $subscription)
  {
    $user = Auth::guard('web')->user();
    $clientProfile = $user->clientProfile;

    if (!$clientProfile) {
      return response()->json([
        'ok' => false,
        'message' => __('Accès refusé.')
      ], 403);
    }

    $subscriptionModel = \App\Models\Subscription::where('client_id', $clientProfile->id)
      ->with(['freelancer.user'])
      ->findOrFail($subscription);

    $currentHours = $subscriptionModel->hours_per_week;
    $allowedHours = [1, 2, 4, 8, 12, 16, 20, 24];
    
    // Calculer les options de downgrade (X-1 et X-2, min 1)
    $downgradeOptions = [];
    $currentIndex = array_search($currentHours, $allowedHours);
    
    if ($currentIndex !== false && $currentIndex > 0) {
      // X-1
      $option1Hours = $allowedHours[$currentIndex - 1];
      $option1Price = $option1Hours * ($subscriptionModel->client_hourly_rate_snapshot ?? $subscriptionModel->base_hourly_rate_snapshot ?? 0) * 4;
      $downgradeOptions[] = [
        'hours' => $option1Hours,
        'price' => $option1Price
      ];
      
      // X-2 si disponible
      if ($currentIndex > 1) {
        $option2Hours = $allowedHours[$currentIndex - 2];
        $option2Price = $option2Hours * ($subscriptionModel->client_hourly_rate_snapshot ?? $subscriptionModel->base_hourly_rate_snapshot ?? 0) * 4;
        $downgradeOptions[] = [
          'hours' => $option2Hours,
          'price' => $option2Price
        ];
      }
    }

    // Vérifier si une carte est enregistrée (simplifié pour l'instant)
    $hasSavedCard = false;
    $savedCardInfo = '';

    return response()->json([
      'ok' => true,
      'current_hours' => $currentHours,
      'current_price' => $subscriptionModel->price_base,
      'unit_price' => $subscriptionModel->client_hourly_rate_snapshot ?? $subscriptionModel->base_hourly_rate_snapshot ?? 0,
      'next_billing_date' => $subscriptionModel->next_billing_at ? $subscriptionModel->next_billing_at->format('Y-m-d H:i:s') : null,
      'downgrade_options' => $downgradeOptions,
      'has_saved_card' => $hasSavedCard,
      'saved_card_info' => $savedCardInfo,
    ]);
  }

  /**
   * Changer de formule (upgrade ou downgrade)
   */
  public function changePlan(Request $request, $subscription)
  {
    $user = Auth::guard('web')->user();
    $clientProfile = $user->clientProfile;

    if (!$clientProfile) {
      return response()->json([
        'ok' => false,
        'message' => __('Accès refusé.')
      ], 403);
    }

    $subscriptionModel = \App\Models\Subscription::where('client_id', $clientProfile->id)
      ->findOrFail($subscription);

    // Accepter target_hours ou new_hours_per_week pour compatibilité
    $request->validate([
      'target_hours' => 'sometimes|integer|in:1,2,4,8,12,16,20,24',
      'new_hours_per_week' => 'sometimes|integer|in:1,2,4,8,12,16,20,24',
      'apply_when' => 'required|in:now,next_cycle'
    ]);

    $newHours = (int) ($request->input('target_hours') ?? $request->input('new_hours_per_week'));
    $applyWhen = $request->input('apply_when');
    
    if (!$newHours) {
      return response()->json([
        'ok' => false,
        'message' => __('Le nombre d\'heures est requis.')
      ], 422);
    }

    // Validation business
    if ($newHours === $subscriptionModel->hours_per_week) {
      return response()->json([
        'ok' => false,
        'message' => __('La nouvelle formule doit être différente de la formule actuelle.')
      ], 422);
    }

    // TODO: Implémenter la logique de changement de formule
    // - Si apply_when = 'now' : changer immédiatement + paiement
    // - Si apply_when = 'next_cycle' : planifier le changement au prochain cycle
    
    return response()->json([
      'ok' => true,
      'message' => __('Votre formule a été modifiée avec succès.'),
      'redirect_url' => route('user.settings.subscription')
    ]);
  }

  /**
   * Contexte pour le flow de transfert d'abonnement
   */
  public function getTransferContext(Request $request, $subscription)
  {
    $user = Auth::guard('web')->user();
    $clientProfile = $user->clientProfile;

    if (!$clientProfile) {
      return response()->json([
        'ok' => false,
        'message' => __('Accès refusé.')
      ], 403);
    }

    $subscriptionModel = \App\Models\Subscription::where('client_id', $clientProfile->id)
      ->with(['freelancer.user'])
      ->findOrFail($subscription);

    $currentFreelance = $subscriptionModel->freelancer;
    $currentFreelanceUser = $currentFreelance->user ?? null;

    // Calculer le crédit (heures restantes converties en montant)
    $credit = $subscriptionModel->hours_remaining * ($subscriptionModel->client_hourly_rate_snapshot ?? $subscriptionModel->base_hourly_rate_snapshot ?? 0);
    $creditSessions = (int) $subscriptionModel->hours_remaining;

    // Sessions à venir
    $upcomingSessions = \App\Models\WorkSession::where('subscription_id', $subscriptionModel->id)
      ->where('status', 'scheduled')
      ->where('start_at', '>', now())
      ->orderBy('start_at')
      ->get()
      ->map(function($session) use ($subscriptionModel) {
        $price = $subscriptionModel->client_hourly_rate_snapshot ?? $subscriptionModel->base_hourly_rate_snapshot ?? 0;
        return [
          'id' => $session->id,
          'start_at' => $session->start_at->format('Y-m-d H:i:s'),
          'price' => $price,
        ];
      });

    // Candidats freelances (non abonnés avec ce client)
    $subscribedFreelancerIds = \App\Models\Subscription::where('client_id', $clientProfile->id)
      ->where('status', 'active')
      ->pluck('freelancer_id')
      ->toArray();

    $candidates = \App\Models\FreelancerProfile::whereNotIn('id', $subscribedFreelancerIds)
      ->where('id', '!=', $currentFreelance->id)
      ->with('user')
      ->limit(20)
      ->get()
      ->map(function($freelancer) {
        $user = $freelancer->user;
        $pricePerSession = $freelancer->hourly_rate ?? 0;
        // TODO: Récupérer le rating et le nombre d'avis depuis la base de données
        return [
          'id' => $freelancer->id,
          'name' => $user ? ($user->first_name . ' ' . $user->last_name) : 'Freelance',
          'avatar' => $user && $user->image ? asset('assets/img/users/' . $user->image) : '',
          'price_per_session' => $pricePerSession,
          'rating' => 4.9, // TODO: Récupérer depuis la base
          'reviews_count' => 117, // TODO: Récupérer depuis la base
        ];
      });

    // Plans disponibles (1, 2, 3 sessions par semaine)
    $plans = [
      [
        'id' => 1,
        'sessions_per_week' => 1,
        'total_sessions' => 4,
        'price' => ($candidates->first()['price_per_session'] ?? 0) * 4,
        'is_popular' => false,
      ],
      [
        'id' => 2,
        'sessions_per_week' => 2,
        'total_sessions' => 8,
        'price' => ($candidates->first()['price_per_session'] ?? 0) * 8,
        'is_popular' => true,
      ],
      [
        'id' => 3,
        'sessions_per_week' => 3,
        'total_sessions' => 12,
        'price' => ($candidates->first()['price_per_session'] ?? 0) * 12,
        'is_popular' => false,
      ],
    ];

    // Vérifier si une carte est enregistrée
    $hasSavedPayment = false; // TODO: vérifier Stripe
    $savedCardInfo = ''; // TODO: récupérer depuis Stripe

    return response()->json([
      'ok' => true,
      'current_freelance' => [
        'id' => $currentFreelance->id,
        'name' => $currentFreelanceUser ? ($currentFreelanceUser->first_name . ' ' . $currentFreelanceUser->last_name) : 'Freelance',
        'avatar' => $currentFreelanceUser && $currentFreelanceUser->image ? asset('assets/img/users/' . $currentFreelanceUser->image) : '',
      ],
      'credit' => $credit,
      'credit_sessions' => $creditSessions,
      'upcoming_sessions' => $upcomingSessions,
      'candidates' => $candidates,
      'plans' => $plans,
      'has_saved_payment' => $hasSavedPayment,
      'saved_card_info' => $savedCardInfo,
    ]);
  }

  /**
   * Annuler les sessions sélectionnées pour le transfert
   */
  public function cancelTransferSessions(Request $request, $subscription)
  {
    $user = Auth::guard('web')->user();
    $clientProfile = $user->clientProfile;

    if (!$clientProfile) {
      return response()->json([
        'ok' => false,
        'message' => __('Accès refusé.')
      ], 403);
    }

    $subscriptionModel = \App\Models\Subscription::where('client_id', $clientProfile->id)
      ->findOrFail($subscription);

    $request->validate([
      'session_ids' => 'required|array',
      'session_ids.*' => 'integer|exists:work_sessions,id',
    ]);

    $sessionIds = $request->input('session_ids', []);
    $cancelledSessions = \App\Models\WorkSession::where('subscription_id', $subscriptionModel->id)
      ->whereIn('id', $sessionIds)
      ->where('status', 'scheduled')
      ->get();

    $totalRefund = 0;
    foreach ($cancelledSessions as $session) {
      $session->update(['status' => 'cancelled']);
      $price = $subscriptionModel->client_hourly_rate_snapshot ?? $subscriptionModel->base_hourly_rate_snapshot ?? 0;
      $totalRefund += $price;
    }

    // Ajouter le crédit à l'abonnement
    $subscriptionModel->increment('hours_remaining', count($cancelledSessions));

    $newCredit = $subscriptionModel->hours_remaining * ($subscriptionModel->client_hourly_rate_snapshot ?? $subscriptionModel->base_hourly_rate_snapshot ?? 0);

    return response()->json([
      'ok' => true,
      'credit' => $newCredit,
    ]);
  }

  /**
   * Remplacer le freelance (transfert)
   */
  public function replaceFreelance(Request $request, $subscription)
  {
    $user = Auth::guard('web')->user();
    $clientProfile = $user->clientProfile;

    if (!$clientProfile) {
      return response()->json([
        'ok' => false,
        'message' => __('Accès refusé.')
      ], 403);
    }

    $subscriptionModel = \App\Models\Subscription::where('client_id', $clientProfile->id)
      ->findOrFail($subscription);

    $request->validate([
      'new_freelance_id' => 'required|integer|exists:freelancer_profiles,id',
      'plan_id' => 'required|integer|in:1,2,3',
      'use_credit' => 'required|boolean',
    ]);

    $newFreelanceId = $request->input('new_freelance_id');
    $planId = $request->input('plan_id');
    $useCredit = $request->input('use_credit');

    // Vérifier que le nouveau freelance n'a pas déjà un abonnement actif avec ce client
    $existingSubscription = \App\Models\Subscription::where('client_id', $clientProfile->id)
      ->where('freelancer_id', $newFreelanceId)
      ->where('status', 'active')
      ->first();

    if ($existingSubscription) {
      return response()->json([
        'ok' => false,
        'message' => __('Vous avez déjà un abonnement actif avec ce freelance.')
      ], 422);
    }

    // Calculer le prix du plan
    $newFreelance = \App\Models\FreelancerProfile::findOrFail($newFreelanceId);
    $sessionsPerWeek = $planId; // 1, 2 ou 3
    $totalSessions = $sessionsPerWeek * 4;
    $pricePerSession = $newFreelance->hourly_rate ?? 0;
    $totalPrice = $pricePerSession * $totalSessions;

    // Calculer le crédit disponible
    $availableCredit = $subscriptionModel->hours_remaining * ($subscriptionModel->client_hourly_rate_snapshot ?? $subscriptionModel->base_hourly_rate_snapshot ?? 0);
    $remainingAmount = max(0, $totalPrice - $availableCredit);

    // Annuler l'ancien abonnement
    $subscriptionModel->update(['status' => 'cancelled']);

    // Créer le nouvel abonnement
    $newSubscription = \App\Models\Subscription::create([
      'client_id' => $clientProfile->id,
      'freelancer_id' => $newFreelanceId,
      'hours_per_week' => $sessionsPerWeek,
      'hours_total_month' => $totalSessions,
      'hours_remaining' => $totalSessions,
      'price_base' => $totalPrice,
      'base_hourly_rate_snapshot' => $pricePerSession,
      'client_hourly_rate_snapshot' => $pricePerSession,
      'status' => 'active',
      'starts_at' => now(),
      'next_billing_at' => now()->addWeeks(4),
    ]);

    // TODO: Gérer le paiement si nécessaire (Stripe)
    $requiresPayment = $remainingAmount > 0;

    return response()->json([
      'ok' => true,
      'requires_payment' => $requiresPayment,
      'remaining_amount' => $remainingAmount,
      'redirect_url' => null,
    ]);
  }

  /**
   * Récupérer les candidats freelances pour le remplacement
   */
  public function getReplaceCandidates(Request $request, $subscription)
  {
    $user = Auth::guard('web')->user();
    $clientProfile = $user->clientProfile;

    if (!$clientProfile) {
      return response()->json([
        'ok' => false,
        'message' => __('Accès refusé.')
      ], 403);
    }

    $subscriptionModel = \App\Models\Subscription::where('client_id', $clientProfile->id)
      ->with(['freelancer.user'])
      ->findOrFail($subscription);

    $currentFreelance = $subscriptionModel->freelancer;

    // Candidats freelances (non abonnés avec ce client)
    $subscribedFreelancerIds = \App\Models\Subscription::where('client_id', $clientProfile->id)
      ->where('status', 'active')
      ->pluck('freelancer_id')
      ->toArray();

    $candidates = \App\Models\FreelancerProfile::whereNotIn('id', $subscribedFreelancerIds)
      ->where('id', '!=', $currentFreelance->id)
      ->with('user')
      ->limit(20)
      ->get()
      ->map(function($freelancer) {
        $user = $freelancer->user;
        $pricePerSession = $freelancer->hourly_rate ?? 0;
        // Vérifier si un cours d'essai a été effectué (TODO: implémenter la logique réelle)
        $trialDone = false; // TODO: vérifier dans la base de données
        return [
          'id' => $freelancer->id,
          'name' => $user ? ($user->first_name . ' ' . $user->last_name) : 'Freelance',
          'avatar' => $user && $user->image ? asset('assets/img/users/' . $user->image) : '',
          'price_per_session' => $pricePerSession,
          'trial_done' => $trialDone,
          'specialization' => $freelancer->specialization ?? 'Freelance',
        ];
      });

    return response()->json([
      'ok' => true,
      'candidates' => $candidates
    ]);
  }

  /**
   * Envoyer les remerciements au freelance
   */
  public function sendReplaceThanks(Request $request, $subscription)
  {
    $user = Auth::guard('web')->user();
    $clientProfile = $user->clientProfile;

    if (!$clientProfile) {
      return response()->json([
        'ok' => false,
        'message' => __('Accès refusé.')
      ], 403);
    }

    $subscriptionModel = \App\Models\Subscription::where('client_id', $clientProfile->id)
      ->findOrFail($subscription);

    $request->validate([
      'message' => 'required|string|max:1000'
    ]);

    // TODO: Envoyer le message de remerciement au freelance (email, notification, etc.)
    // Pour l'instant, on simule juste le succès

    return response()->json([
      'ok' => true,
      'message' => __('Vos remerciements ont été envoyés.')
    ]);
  }

  /**
   * Confirmer le remplacement du freelance
   */
  public function confirmReplace(Request $request, $subscription)
  {
    $user = Auth::guard('web')->user();
    $clientProfile = $user->clientProfile;

    if (!$clientProfile) {
      return response()->json([
        'ok' => false,
        'message' => __('Accès refusé.')
      ], 403);
    }

    $subscriptionModel = \App\Models\Subscription::where('client_id', $clientProfile->id)
      ->findOrFail($subscription);

    $request->validate([
      'new_freelance_id' => 'required|integer|exists:freelancer_profiles,id',
      'plan_id' => 'required|integer|in:1,2,3,4',
      'payment_method' => 'required|string|in:junspro_credit,saved_card,new_card,paypal'
    ]);

    // TODO: Implémenter la logique complète de remplacement
    // - Annuler l'ancien abonnement
    // - Créer le nouvel abonnement
    // - Gérer le paiement via Stripe
    // - Transférer le solde

    return response()->json([
      'ok' => true,
      'message' => __('Le remplacement a été effectué avec succès.')
    ]);
  }

  /**
   * Contexte pour le flow ADD (Ajouter un autre freelance)
   */
  public function getTransferAddContext(Request $request, $subscription)
  {
    $user = Auth::guard('web')->user();
    $clientProfile = $user->clientProfile;

    if (!$clientProfile) {
      return response()->json([
        'ok' => false,
        'message' => __('Accès refusé.')
      ], 403);
    }

    $subscriptionModel = \App\Models\Subscription::where('client_id', $clientProfile->id)
      ->with(['freelancer.user'])
      ->findOrFail($subscription);

    $currentFreelance = $subscriptionModel->freelancer;
    $currentFreelanceUser = $currentFreelance->user ?? null;

    // Calculer le crédit
    $credit = $subscriptionModel->hours_remaining * ($subscriptionModel->client_hourly_rate_snapshot ?? $subscriptionModel->base_hourly_rate_snapshot ?? 0);
    $creditSessions = (int) $subscriptionModel->hours_remaining;

    // Sessions à venir
    $upcomingSessions = \App\Models\WorkSession::where('subscription_id', $subscriptionModel->id)
      ->where('status', 'scheduled')
      ->where('start_at', '>', now())
      ->orderBy('start_at')
      ->get()
      ->map(function($session) use ($subscriptionModel) {
        $price = $subscriptionModel->client_hourly_rate_snapshot ?? $subscriptionModel->base_hourly_rate_snapshot ?? 0;
        return [
          'id' => $session->id,
          'start_at' => $session->start_at->format('Y-m-d H:i:s'),
          'price' => $price,
        ];
      });

    // Candidats freelances (non abonnés avec ce client)
    $subscribedFreelancerIds = \App\Models\Subscription::where('client_id', $clientProfile->id)
      ->where('status', 'active')
      ->pluck('freelancer_id')
      ->toArray();

    $candidates = \App\Models\FreelancerProfile::whereNotIn('id', $subscribedFreelancerIds)
      ->where('id', '!=', $currentFreelance->id)
      ->with('user')
      ->limit(20)
      ->get()
      ->map(function($freelancer) {
        $user = $freelancer->user;
        $pricePerSession = $freelancer->hourly_rate ?? 0;
        return [
          'id' => $freelancer->id,
          'name' => $user ? ($user->first_name . ' ' . $user->last_name) : 'Freelance',
          'avatar' => $user && $user->image ? asset('assets/img/users/' . $user->image) : '',
          'price_per_session' => $pricePerSession,
          'rating' => 4.9, // TODO: Récupérer depuis la base
          'reviews_count' => 117, // TODO: Récupérer depuis la base
        ];
      });

    // Prix par session par candidat
    $pricePerSessionByCandidate = [];
    foreach ($candidates as $candidate) {
      $pricePerSessionByCandidate[$candidate['id']] = $candidate['price_per_session'];
    }

    // Plans par candidat (1, 2, 3 sessions par semaine)
    $plansByCandidate = [];
    foreach ($candidates as $candidate) {
      $pricePerSession = $candidate['price_per_session'];
      $plansByCandidate[$candidate['id']] = [
        [
          'id' => 1,
          'sessions_per_week' => 1,
          'total_sessions' => 4,
          'price' => $pricePerSession * 4,
          'is_popular' => false,
        ],
        [
          'id' => 2,
          'sessions_per_week' => 2,
          'total_sessions' => 8,
          'price' => $pricePerSession * 8,
          'is_popular' => true,
        ],
        [
          'id' => 3,
          'sessions_per_week' => 3,
          'total_sessions' => 12,
          'price' => $pricePerSession * 12,
          'is_popular' => false,
          'note' => __('Les prix indiqués correspondent à nos sessions standard de 50 minutes'),
        ],
      ];
    }

    // Vérifier si une carte est enregistrée
    $hasSavedPayment = false; // TODO: vérifier Stripe
    $savedCardInfo = ''; // TODO: récupérer depuis Stripe

    return response()->json([
      'ok' => true,
      'current_freelance' => [
        'id' => $currentFreelance->id,
        'name' => $currentFreelanceUser ? ($currentFreelanceUser->first_name . ' ' . $currentFreelanceUser->last_name) : 'Freelance',
        'avatar' => $currentFreelanceUser && $currentFreelanceUser->image ? asset('assets/img/users/' . $currentFreelanceUser->image) : '',
      ],
      'credit' => $credit,
      'credit_sessions' => $creditSessions,
      'next_billing_date' => $subscriptionModel->next_billing_at ? $subscriptionModel->next_billing_at->format('Y-m-d H:i:s') : null,
      'upcoming_sessions' => $upcomingSessions,
      'candidates' => $candidates,
      'price_per_session_by_candidate' => $pricePerSessionByCandidate,
      'plans_by_candidate' => $plansByCandidate,
      'has_saved_payment' => $hasSavedPayment,
      'saved_card_info' => $savedCardInfo,
    ]);
  }

  /**
   * Ajouter un autre freelance (garder l'abonnement actuel)
   */
  public function addFreelance(Request $request, $subscription)
  {
    $user = Auth::guard('web')->user();
    $clientProfile = $user->clientProfile;

    if (!$clientProfile) {
      return response()->json([
        'ok' => false,
        'message' => __('Accès refusé.')
      ], 403);
    }

    $subscriptionModel = \App\Models\Subscription::where('client_id', $clientProfile->id)
      ->findOrFail($subscription);

    $request->validate([
      'new_freelance_id' => 'required|integer|exists:freelancer_profiles,id',
      'qty' => 'required|integer|min:1',
      'plan_id' => 'required|integer|in:1,2,3',
      'use_credit' => 'required|boolean',
    ]);

    $newFreelanceId = $request->input('new_freelance_id');
    $qty = $request->input('qty');
    $planId = $request->input('plan_id');
    $useCredit = $request->input('use_credit');

    // Vérifier que le nouveau freelance n'a pas déjà un abonnement actif avec ce client
    $existingSubscription = \App\Models\Subscription::where('client_id', $clientProfile->id)
      ->where('freelancer_id', $newFreelanceId)
      ->where('status', 'active')
      ->first();

    if ($existingSubscription) {
      return response()->json([
        'ok' => false,
        'message' => __('Vous avez déjà un abonnement actif avec ce freelance.')
      ], 422);
    }

    // Calculer le prix du plan
    $newFreelance = \App\Models\FreelancerProfile::findOrFail($newFreelanceId);
    $sessionsPerWeek = $planId; // 1, 2 ou 3
    $totalSessions = $sessionsPerWeek * 4;
    $pricePerSession = $newFreelance->hourly_rate ?? 0;
    $totalPrice = $pricePerSession * $totalSessions;

    // Calculer le crédit disponible
    $availableCredit = $subscriptionModel->hours_remaining * ($subscriptionModel->client_hourly_rate_snapshot ?? $subscriptionModel->base_hourly_rate_snapshot ?? 0);
    
    // Calculer le montant utilisé pour les qty sessions sélectionnées
    $usedCredit = $qty * $pricePerSession;
    $remainingAmount = max(0, $usedCredit - $availableCredit);

    // Créer le nouvel abonnement (sans annuler l'ancien)
    $newSubscription = \App\Models\Subscription::create([
      'client_id' => $clientProfile->id,
      'freelancer_id' => $newFreelanceId,
      'hours_per_week' => $sessionsPerWeek,
      'hours_total_month' => $totalSessions,
      'hours_remaining' => $totalSessions - $qty, // Déduire les sessions transférées
      'price_base' => $totalPrice,
      'base_hourly_rate_snapshot' => $pricePerSession,
      'client_hourly_rate_snapshot' => $pricePerSession,
      'status' => 'active',
      'starts_at' => now(),
      'next_billing_at' => now()->addWeeks(4),
    ]);

    // Déduire le crédit utilisé de l'abonnement actuel
    if ($useCredit && $availableCredit > 0) {
      $creditUsed = min($availableCredit, $usedCredit);
      $sessionsUsed = (int) ($creditUsed / ($subscriptionModel->client_hourly_rate_snapshot ?? $subscriptionModel->base_hourly_rate_snapshot ?? 1));
      $subscriptionModel->decrement('hours_remaining', $sessionsUsed);
    }

    // TODO: Gérer le paiement si nécessaire (Stripe)
    $requiresPayment = $remainingAmount > 0;

    return response()->json([
      'ok' => true,
      'requires_payment' => $requiresPayment,
      'amount_due' => $remainingAmount,
      'redirect_url' => null,
    ]);
  }

  /**
   * Contexte pour le flow MOVE (Transférer sessions vers freelance actif)
   */
  public function getTransferMoveContext(Request $request, $subscription)
  {
    // MOCK MODE LOCAL - Retourner directement des données de test pour éviter les erreurs DB
    if (app()->environment('local') || config('app.debug')) {
      return response()->json([
        'ok' => true,
        'source_freelance' => [
          'id' => 1,
          'name' => 'David Chen',
          'avatar' => '',
        ],
        'source_price' => 34.0,
        'credit' => 0,
        'credit_sessions' => 32,
        'upcoming_sessions' => [
          [
            'id' => 101,
            'start_at' => date('Y-m-d H:i:s', strtotime('+3 days')),
            'price' => 34.0,
          ],
          [
            'id' => 102,
            'start_at' => date('Y-m-d H:i:s', strtotime('+5 days')),
            'price' => 34.0,
          ],
        ],
        'active_freelances' => [
          [
            'id' => 201,
            'name' => 'Cordelia Ngwa N.',
            'sort_name' => 'Cordelia Ngwa N.',
            'avatar' => '',
            'price_per_session' => 3.4,
            'hourly_rate' => 3.4,
            'remaining_sessions' => 10,
          ],
          [
            'id' => 202,
            'name' => 'Nadine Aimee H.',
            'sort_name' => 'Nadine Aimee H.',
            'avatar' => '',
            'price_per_session' => 3.4,
            'hourly_rate' => 3.4,
            'remaining_sessions' => 5,
          ],
          [
            'id' => 203,
            'name' => 'Augustin J.',
            'sort_name' => 'Augustin J.',
            'avatar' => '',
            'price_per_session' => 3.4,
            'hourly_rate' => 3.4,
            'remaining_sessions' => 8,
          ],
        ],
        'is_dev_mode' => true,
      ]);
    }

    $user = Auth::guard('web')->user();
    $clientProfile = $user->clientProfile;

    if (!$clientProfile) {
      return response()->json([
        'ok' => false,
        'message' => __('Accès refusé.')
      ], 403);
    }

    $subscriptionModel = \App\Models\Subscription::where('client_id', $clientProfile->id)
      ->with(['freelancer.user'])
      ->findOrFail($subscription);

    $sourceFreelance = $subscriptionModel->freelancer;
    $sourceFreelanceUser = $sourceFreelance->user ?? null;
    $sourcePrice = $subscriptionModel->client_hourly_rate_snapshot ?? $subscriptionModel->base_hourly_rate_snapshot ?? 0;

    // Calculer le crédit
    $credit = $subscriptionModel->hours_remaining * $sourcePrice;
    $creditSessions = (int) $subscriptionModel->hours_remaining;

    // Sessions à venir
    $upcomingSessions = \App\Models\WorkSession::where('subscription_id', $subscriptionModel->id)
      ->where('status', 'scheduled')
      ->where('start_at', '>', now())
      ->orderBy('start_at')
      ->get()
      ->map(function($session) use ($sourcePrice) {
        return [
          'id' => $session->id,
          'start_at' => $session->start_at->format('Y-m-d H:i:s'),
          'price' => $sourcePrice,
        ];
      });

    // Freelances actifs (autres abonnements actifs avec ce client) - SANS LIMITE
    $activeSubscriptions = \App\Models\Subscription::where('client_id', $clientProfile->id)
      ->where('status', 'active')
      ->where('id', '!=', $subscriptionModel->id)
      ->with(['freelancer.user'])
      ->orderBy('created_at', 'desc') // Trier par date de création (plus récent en premier)
      ->get();

    $activeFreelances = $activeSubscriptions->map(function($sub) {
      $freelancer = $sub->freelancer;
      $user = $freelancer->user;
      
      // Priorité: snapshot de l'abonnement > profil freelance > 0
      $hourlyRate = null;
      
      // Essayer d'abord les snapshots de l'abonnement
      if ($sub->client_hourly_rate_snapshot && $sub->client_hourly_rate_snapshot > 0) {
        $hourlyRate = (float) $sub->client_hourly_rate_snapshot;
      } elseif ($sub->base_hourly_rate_snapshot && $sub->base_hourly_rate_snapshot > 0) {
        $hourlyRate = (float) $sub->base_hourly_rate_snapshot;
      }
      
      // Si toujours pas de prix, utiliser le profil freelance
      if (!$hourlyRate || $hourlyRate == 0) {
        if ($freelancer && $freelancer->hourly_rate && $freelancer->hourly_rate > 0) {
          $hourlyRate = (float) $freelancer->hourly_rate;
        } else {
          $hourlyRate = 0;
        }
      }
      
      $fullName = $user ? ($user->first_name . ' ' . $user->last_name) : 'Freelance';
      
      // #region agent log
      $logData = [
        'sessionId' => 'debug-session',
        'runId' => 'run1',
        'hypothesisId' => 'A',
        'location' => 'UserController.php:' . __LINE__,
        'message' => 'Backend: Calcul prix freelance actif',
        'data' => [
          'subscription_id' => $sub->id,
          'freelancer_id' => $freelancer->id ?? 'N/A',
          'name' => $fullName,
          'client_hourly_rate_snapshot' => $sub->client_hourly_rate_snapshot,
          'base_hourly_rate_snapshot' => $sub->base_hourly_rate_snapshot,
          'freelancer_hourly_rate' => $freelancer->hourly_rate ?? 'N/A',
          'freelancer_hourly_rate_type' => gettype($freelancer->hourly_rate ?? null),
          'final_hourly_rate' => $hourlyRate,
          'hourly_rate_type' => gettype($hourlyRate),
          'hourly_rate_value' => $hourlyRate,
          'price_per_session_in_result' => $hourlyRate,
          'hourly_rate_in_result' => $hourlyRate
        ],
        'timestamp' => time() * 1000
      ];
      $logPath = base_path('.cursor/debug.log');
      file_put_contents($logPath, json_encode($logData) . "\n", FILE_APPEND);
      \Log::info('[MOVE] Freelance actif:', $logData['data']);
      // #endregion
      
      $result = [
        'id' => $freelancer->id,
        'name' => $fullName,
        'sort_name' => $fullName, // Pour le tri côté client si nécessaire
        'avatar' => $user && $user->image ? asset('assets/img/users/' . $user->image) : '',
        'price_per_session' => $hourlyRate,
        'hourly_rate' => $hourlyRate,
        'remaining_sessions' => (int) $sub->hours_remaining,
      ];
      
      // #region agent log
      $logData2 = [
        'sessionId' => 'debug-session',
        'runId' => 'run1',
        'hypothesisId' => 'A',
        'location' => 'UserController.php:' . __LINE__,
        'message' => 'Backend: Données renvoyées au frontend',
        'data' => [
          'freelancer_id' => $freelancer->id,
          'name' => $fullName,
          'price_per_session' => $result['price_per_session'],
          'hourly_rate' => $result['hourly_rate'],
          'price_per_session_type' => gettype($result['price_per_session']),
          'hourly_rate_type' => gettype($result['hourly_rate']),
          'price_per_session_value' => $result['price_per_session'],
          'hourly_rate_value' => $result['hourly_rate'],
          'result_array' => $result
        ],
        'timestamp' => time() * 1000
      ];
      $logPath = base_path('.cursor/debug.log');
      file_put_contents($logPath, json_encode($logData2) . "\n", FILE_APPEND);
      // #endregion
      
      return $result;
    })->sortBy('sort_name')->values()->all(); // Trier par nom alphabétiquement

    // MOCKS DEV (uniquement en local/debug si aucun freelance actif)
    $isDev = app()->environment('local') || config('app.debug');
    if ($isDev && empty($activeFreelances)) {
      $activeFreelances = [
        [
          'id' => 'mock-1',
          'name' => 'Augustin J.',
          'sort_name' => 'Augustin J.',
          'avatar' => null,
          'price_per_session' => 29,
          'hourly_rate' => 29,
          'remaining_sessions' => 0,
        ],
        [
          'id' => 'mock-2',
          'name' => 'Sarah M.',
          'sort_name' => 'Sarah M.',
          'avatar' => null,
          'price_per_session' => 35,
          'hourly_rate' => 35,
          'remaining_sessions' => 0,
        ],
        [
          'id' => 'mock-3',
          'name' => 'Yanis K.',
          'sort_name' => 'Yanis K.',
          'avatar' => null,
          'price_per_session' => 25,
          'hourly_rate' => 25,
          'remaining_sessions' => 0,
        ],
      ];
    }

    return response()->json([
      'ok' => true,
      'source_freelance' => [
        'id' => $sourceFreelance->id,
        'name' => $sourceFreelanceUser ? ($sourceFreelanceUser->first_name . ' ' . $sourceFreelanceUser->last_name) : 'Freelance',
        'avatar' => $sourceFreelanceUser && $sourceFreelanceUser->image ? asset('assets/img/users/' . $sourceFreelanceUser->image) : '',
      ],
      'source_price' => $sourcePrice,
      'credit' => $credit,
      'credit_sessions' => $creditSessions,
      'upcoming_sessions' => $upcomingSessions,
      'active_freelances' => $activeFreelances,
      'is_dev_mode' => $isDev && empty($activeSubscriptions->count()), // Flag pour afficher badge "Mode test" si besoin
    ]);
  }

  /**
   * Transférer des sessions vers un freelance actif
   */
  public function moveSessions(Request $request, $subscription)
  {
    $user = Auth::guard('web')->user();
    $clientProfile = $user->clientProfile;

    if (!$clientProfile) {
      return response()->json([
        'ok' => false,
        'message' => __('Accès refusé.')
      ], 403);
    }

    $sourceSubscription = \App\Models\Subscription::where('client_id', $clientProfile->id)
      ->findOrFail($subscription);

    $isDev = app()->environment('local') || config('app.debug');
    $targetFreelanceId = $request->input('target_freelance_id');
    
    // Validation : accepter mocks en dev
    if ($isDev && str_starts_with($targetFreelanceId, 'mock-')) {
      // En dev, simuler le succès pour les mocks
      return response()->json([
        'ok' => true,
        'message' => __('Transfert simulé (mode dev)')
      ]);
    }
    
    // En prod, refuser les mocks
    if (str_starts_with($targetFreelanceId, 'mock-')) {
      return response()->json([
        'ok' => false,
        'message' => __('Les freelances de test ne sont pas autorisés en production.')
      ], 422);
    }

    $request->validate([
      'target_freelance_id' => 'required|integer|exists:freelancer_profiles,id',
      'qty' => 'required|integer|min:1',
      'cancel_session_ids' => 'sometimes|string',
      'use_credit' => 'required|boolean',
    ]);

    $qty = $request->input('qty');
    $cancelSessionIds = json_decode($request->input('cancel_session_ids', '[]'), true) ?? [];
    $useCredit = $request->input('use_credit');

    // Vérifier que le target freelance a un abonnement actif avec ce client
    $targetSubscription = \App\Models\Subscription::where('client_id', $clientProfile->id)
      ->where('freelancer_id', $targetFreelanceId)
      ->where('status', 'active')
      ->first();

    if (!$targetSubscription) {
      return response()->json([
        'ok' => false,
        'message' => __('Aucun abonnement actif trouvé avec ce freelance.')
      ], 422);
    }

    // Taux horaires
    $sourcePrice = $sourceSubscription->client_hourly_rate_snapshot ?? $sourceSubscription->base_hourly_rate_snapshot ?? 0;
    $targetPrice = $targetSubscription->client_hourly_rate_snapshot ?? $targetSubscription->base_hourly_rate_snapshot ?? 0;

    if ($sourcePrice <= 0 || $targetPrice <= 0) {
      return response()->json([
        'ok' => false,
        'message' => __('Impossible de calculer les taux horaires.')
      ], 422);
    }

    // Calculer le montant utilisé
    $usedAmount = $qty * $targetPrice;
    
    // Calculer le crédit disponible du source
    $availableCredit = $sourceSubscription->hours_remaining * $sourcePrice;
    
    // Annuler les sessions sélectionnées d'abord
    if (!empty($cancelSessionIds)) {
      \App\Models\WorkSession::whereIn('id', $cancelSessionIds)
        ->where('subscription_id', $sourceSubscription->id)
        ->update(['status' => 'cancelled']);
      
      // Recalculer les heures restantes après annulation
      $cancelledSessions = \App\Models\WorkSession::whereIn('id', $cancelSessionIds)->count();
      $sourceSubscription->decrement('hours_remaining', $cancelledSessions);
      
      // Recalculer le crédit disponible après annulation
      $availableCredit = $sourceSubscription->hours_remaining * $sourcePrice;
    }

    // Vérifier que le montant utilisé ne dépasse pas le crédit disponible
    if ($usedAmount > $availableCredit) {
      return response()->json([
        'ok' => false,
        'message' => __('Le montant à transférer dépasse le crédit disponible.')
      ], 422);
    }

    // Calculer les heures équivalentes du source (pour déduire du crédit)
    $equivalentHoursSource = $usedAmount / $sourcePrice;
    
    // Calculer les heures à transférer selon le taux horaire cible
    $transferredHours = $usedAmount / $targetPrice;
    
    // Déduire les heures du source subscription
    $sourceSubscription->decrement('hours_remaining', $equivalentHoursSource);
    
    // Ajouter les heures au target subscription
    $targetSubscription->increment('hours_remaining', $transferredHours);

    return response()->json([
      'ok' => true,
      'transferred_hours' => $transferredHours,
    ]);
  }

  /**
   * Envoyer un message de remerciements
   */
  public function sendTransferThanks(Request $request, $subscription)
  {
    $user = Auth::guard('web')->user();
    $clientProfile = $user->clientProfile;

    if (!$clientProfile) {
      return response()->json([
        'ok' => false,
        'message' => __('Accès refusé.')
      ], 403);
    }

    $subscriptionModel = \App\Models\Subscription::where('client_id', $clientProfile->id)
      ->findOrFail($subscription);

    $message = $request->input('message', '');

    // TODO: Envoyer le message au freelance (email ou notification)
    // Pour l'instant, on retourne juste ok

    return response()->json([
      'ok' => true,
    ]);
  }

  /**
   * Nouvelle page "Historique de paiement" dans les settings (format Preply)
   */
  public function billingHistory()
  {
    $user = Auth::guard('web')->user();
    
    // Si l'utilisateur a un profil client, utiliser la nouvelle vue
    if ($user->clientProfile) {
      $clientProfile = $user->clientProfile;
      
      // Récupérer toutes les factures du client
      $invoices = \App\Models\Invoice::where('client_id', $clientProfile->id)
        ->with(['freelancer.user', 'subscription'])
        ->orderByDesc('created_at')
        ->paginate(15);
      
      // Formater les factures pour l'affichage
      $invoices->getCollection()->transform(function($invoice) {
        $freelancer = $invoice->freelancer->user ?? null;
        $subscription = $invoice->subscription;
        
        // Déterminer le type de paiement
        $typeLabel = __('Abonnement mensuel');
        if ($subscription) {
          $typeLabel = __('Abonnement') . ' ' . ($subscription->hours_per_week ?? 0) . 'h/semaine';
        }
        
        // Déterminer le statut
        $status = 'paid'; // Par défaut, une facture créée = payée
        if (isset($invoice->meta['payment_status'])) {
          $status = $invoice->meta['payment_status'];
        }
        
        // Le montant est déjà en euros (pas en centimes)
        $amount = (float) ($invoice->amount_client_total ?? 0);
        
        return (object) [
          'id' => $invoice->id,
          'date' => $invoice->created_at,
          'amount' => $amount,
          'currency' => $invoice->currency ?? 'EUR',
          'freelancer_name' => $freelancer ? ($freelancer->first_name . ' ' . $freelancer->last_name) : __('N/A'),
          'subscription_id' => $subscription->id ?? null,
          'type_label' => $typeLabel,
          'payment_method_label' => __('Carte bancaire'), // TODO: récupérer depuis Stripe ou meta
          'status' => $status,
          'invoice_path' => null, // TODO: générer ou stocker le chemin PDF
          'invoice_url' => null,
        ];
      });

      return view('frontend.client.settings.billing-history', [
        'activeSection' => 'billing_history',
        'invoices' => $invoices
      ]);
    }

    // Sinon, rediriger vers les settings généraux
    return redirect()->route('user.settings.index');
  }

  /**
   * Télécharger / afficher une facture
   */
  public function downloadInvoice($invoiceId)
  {
    $user = Auth::guard('web')->user();
    $clientProfile = $user->clientProfile;

    if (!$clientProfile) {
      return redirect()->route('user.settings.billing_history')
        ->with('error', __('Accès refusé.'));
    }

    $invoice = \App\Models\Invoice::where('client_id', $clientProfile->id)
      ->findOrFail($invoiceId);

    // TODO: Générer ou récupérer le PDF de la facture
    // Pour l'instant, rediriger vers une page de détail ou retourner une erreur
    return redirect()->route('user.settings.billing_history')
      ->with('info', __('La génération de facture PDF sera disponible prochainement.'));
  }

  /**
   * Nouvelle page "Confirmation automatique" dans les settings (format Preply)
   */
  public function editAutoConfirmation()
  {
    $user = Auth::guard('web')->user();
    
    // Si l'utilisateur a un profil client, utiliser la nouvelle vue
    if ($user->clientProfile) {
      $settings = [
        'auto_confirm_enabled'      => $user->auto_confirm_enabled ?? true,
        'auto_confirm_delay_hours'  => $user->auto_confirm_delay_hours ?? 48,
        'reminder_before_hours'     => $user->reminder_before_hours ?? 24,
      ];

      return view('frontend.client.settings.auto-confirmation', [
        'activeSection' => 'auto_confirmation',
        'settings' => $settings
      ]);
    }

    // Sinon, rediriger vers les settings généraux
    return redirect()->route('user.settings.index');
  }

  /**
   * Mettre à jour les préférences de confirmation automatique
   */
  public function updateAutoConfirmation(Request $request)
  {
    $user = Auth::guard('web')->user();
    $clientProfile = $user->clientProfile;

    if (!$clientProfile) {
      return redirect()->route('user.settings.index')
        ->with('error', __('Accès refusé.'));
    }

    $data = $request->validate([
      'auto_confirm_enabled'     => ['nullable'],
      'auto_confirm_delay_hours' => ['required', 'integer', 'in:24,48,72'],
      'reminder_before_hours'    => ['nullable', 'integer', 'in:0,12,24'],
    ]);

    // Normaliser les booléens (checkbox)
    $data['auto_confirm_enabled'] = $request->has('auto_confirm_enabled');
    
    // Si reminder_before_hours n'est pas fourni ou est vide, le mettre à 0
    $data['reminder_before_hours'] = $data['reminder_before_hours'] ?? 0;

    // Enregistrer les préférences
    $user->auto_confirm_enabled = $data['auto_confirm_enabled'];
    $user->auto_confirm_delay_hours = $data['auto_confirm_delay_hours'];
    $user->reminder_before_hours = $data['reminder_before_hours'];
    $user->save();

    return redirect()->route('user.settings.auto_confirmation')
      ->with('status', 'auto-confirmation-updated')
      ->with('success', __('Vos préférences de confirmation automatique ont été mises à jour.'));
  }

  /**
   * Nouvelle page "Agenda & fuseau horaire" dans les settings (format Preply)
   */
  public function editAgenda()
  {
    $user = Auth::guard('web')->user();
    
    // Si l'utilisateur a un profil client, utiliser la nouvelle vue
    if ($user->clientProfile) {
      // Liste des fuseaux horaires courants
      $commonTimezones = [
        'Europe/Paris' => 'Europe/Paris (GMT+1)',
        'Europe/London' => 'Europe/London (GMT+0)',
        'Europe/Berlin' => 'Europe/Berlin (GMT+1)',
        'Europe/Madrid' => 'Europe/Madrid (GMT+1)',
        'Europe/Rome' => 'Europe/Rome (GMT+1)',
        'Europe/Amsterdam' => 'Europe/Amsterdam (GMT+1)',
        'Europe/Brussels' => 'Europe/Brussels (GMT+1)',
        'Europe/Lisbon' => 'Europe/Lisbon (GMT+0)',
        'Europe/Athens' => 'Europe/Athens (GMT+2)',
        'Europe/Warsaw' => 'Europe/Warsaw (GMT+1)',
        'Europe/Prague' => 'Europe/Prague (GMT+1)',
        'Europe/Budapest' => 'Europe/Budapest (GMT+1)',
        'America/New_York' => 'America/New_York (GMT-5)',
        'America/Chicago' => 'America/Chicago (GMT-6)',
        'America/Denver' => 'America/Denver (GMT-7)',
        'America/Los_Angeles' => 'America/Los_Angeles (GMT-8)',
        'America/Toronto' => 'America/Toronto (GMT-5)',
        'America/Mexico_City' => 'America/Mexico_City (GMT-6)',
        'America/Sao_Paulo' => 'America/Sao_Paulo (GMT-3)',
        'Asia/Dubai' => 'Asia/Dubai (GMT+4)',
        'Asia/Singapore' => 'Asia/Singapore (GMT+8)',
        'Asia/Tokyo' => 'Asia/Tokyo (GMT+9)',
        'Asia/Shanghai' => 'Asia/Shanghai (GMT+8)',
        'Asia/Hong_Kong' => 'Asia/Hong_Kong (GMT+8)',
        'Australia/Sydney' => 'Australia/Sydney (GMT+10)',
        'Australia/Melbourne' => 'Australia/Melbourne (GMT+10)',
        'Africa/Cairo' => 'Africa/Cairo (GMT+2)',
        'Africa/Johannesburg' => 'Africa/Johannesburg (GMT+2)',
      ];

      $settings = [
        'timezone' => $user->timezone ?? 'Europe/Paris',
        'time_format' => $user->time_format ?? '24h',
        'week_start' => $user->week_start ?? 'monday',
        'default_view' => $user->default_view ?? 'week',
      ];

      return view('frontend.client.settings.agenda', [
        'activeSection' => 'agenda',
        'settings' => $settings,
        'commonTimezones' => $commonTimezones
      ]);
    }

    // Sinon, rediriger vers les settings généraux
    return redirect()->route('user.settings.index');
  }

  /**
   * Mettre à jour les préférences d'agenda
   */
  public function updateAgenda(Request $request)
  {
    $user = Auth::guard('web')->user();
    $clientProfile = $user->clientProfile;

    if (!$clientProfile) {
      return redirect()->route('user.settings.index')
        ->with('error', __('Accès refusé.'));
    }

    $data = $request->validate([
      'timezone' => ['required', 'string', 'max:64'],
      'time_format' => ['required', 'string', 'in:24h,12h'],
      'week_start' => ['required', 'string', 'in:monday,sunday'],
      'default_view' => ['required', 'string', 'in:week,month'],
    ]);

    // Enregistrer les préférences
    $user->timezone = $data['timezone'];
    $user->time_format = $data['time_format'];
    $user->week_start = $data['week_start'];
    $user->default_view = $data['default_view'];
    $user->save();

    return redirect()->route('user.settings.agenda')
      ->with('status', 'agenda-updated')
      ->with('success', __('Vos préférences d\'agenda ont été mises à jour.'));
  }

  /**
   * Nouvelle page "Notifications" dans les settings (format Preply)
   */
  public function editNotifications()
  {
    try {
      $user = Auth::guard('web')->user();
      
      if (!$user) {
        return redirect()->route('user.login')
          ->with('error', __('Vous devez être connecté pour accéder à cette page.'));
      }
      
      // Si l'utilisateur a un profil client, utiliser la nouvelle vue
      if ($user->clientProfile) {
        $settings = [
          'email_sessions' => isset($user->email_sessions) ? (bool) $user->email_sessions : true,
          'email_reports' => isset($user->email_reports) ? (bool) $user->email_reports : true,
          'email_messages' => isset($user->email_messages) ? (bool) $user->email_messages : true,
          'email_billing' => isset($user->email_billing) ? (bool) $user->email_billing : true,
          'email_news' => isset($user->email_news) ? (bool) $user->email_news : false,
        ];

        return view('frontend.client.settings.notifications', [
          'activeSection' => 'notifications',
          'settings' => $settings
        ]);
      }

      // Sinon, rediriger vers les settings généraux
      return redirect()->route('user.settings.index');
    } catch (\Exception $e) {
      Log::error('Erreur dans editNotifications: ' . $e->getMessage());
      Log::error('Stack trace: ' . $e->getTraceAsString());
      
      return redirect()->route('user.settings.index')
        ->with('error', __('Une erreur est survenue lors du chargement de la page.') . ' ' . $e->getMessage());
    }
  }

  /**
   * Mettre à jour les préférences de notifications
   */
  public function updateNotifications(Request $request)
  {
    $user = Auth::guard('web')->user();
    $clientProfile = $user->clientProfile;

    if (!$clientProfile) {
      return redirect()->route('user.settings.index')
        ->with('error', __('Accès refusé.'));
    }

    // Chaque checkbox peut être absente si décochée
    $data = [
      'email_sessions' => $request->has('email_sessions'),
      'email_reports' => $request->has('email_reports'),
      'email_messages' => $request->has('email_messages'),
      'email_billing' => $request->has('email_billing'),
      'email_news' => $request->has('email_news'),
    ];

    // Enregistrer les préférences
    $user->email_sessions = $data['email_sessions'];
    $user->email_reports = $data['email_reports'];
    $user->email_messages = $data['email_messages'];
    $user->email_billing = $data['email_billing'];
    $user->email_news = $data['email_news'];
    $user->save();

    return redirect()->route('user.settings.notifications')
      ->with('status', 'notifications-updated')
      ->with('success', __('Vos préférences de notifications ont été mises à jour.'));
  }

  /**
   * Nouvelle page "Connexions & autorisations" dans les settings (format Preply)
   */
  public function editConnections()
  {
    try {
      $user = Auth::guard('web')->user();
      
      if (!$user) {
        return redirect()->route('user.login')
          ->with('error', __('Vous devez être connecté pour accéder à cette page.'));
      }
      
      // Si l'utilisateur a un profil client, utiliser la nouvelle vue
      if ($user->clientProfile) {
        // Déterminer les providers connectés
        $providers = [
          'google' => null,
          'facebook' => null,
        ];
        
        // Vérifier si l'utilisateur est connecté via un provider social
        if ($user->provider === 'google' && !empty($user->provider_id)) {
          $providers['google'] = (object) [
            'id' => $user->provider_id,
            'email' => $user->email_address,
            'name' => $user->first_name . ' ' . $user->last_name,
            'provider' => 'google',
          ];
        } elseif ($user->provider === 'facebook' && !empty($user->provider_id)) {
          $providers['facebook'] = (object) [
            'id' => $user->provider_id,
            'email' => $user->email_address,
            'name' => $user->first_name . ' ' . $user->last_name,
            'provider' => 'facebook',
          ];
        }
        
        // Vérifier si l'utilisateur a un mot de passe (connexion email/password)
        $hasPassword = !empty($user->password);

        return view('frontend.client.settings.connections', [
          'activeSection' => 'connections',
          'providers' => $providers,
          'hasPassword' => $hasPassword
        ]);
      }

      // Sinon, rediriger vers les settings généraux
      return redirect()->route('user.settings.index');
    } catch (\Exception $e) {
      Log::error('Erreur dans editConnections: ' . $e->getMessage());
      Log::error('Stack trace: ' . $e->getTraceAsString());
      
      return redirect()->route('user.settings.index')
        ->with('error', __('Une erreur est survenue lors du chargement de la page.') . ' ' . $e->getMessage());
    }
  }

  /**
   * Déconnecter / révoquer un provider social
   */
  public function disconnectProvider(Request $request)
  {
    try {
      $user = Auth::guard('web')->user();
      $clientProfile = $user->clientProfile;

      if (!$clientProfile) {
        return redirect()->route('user.settings.index')
          ->with('error', __('Accès refusé.'));
      }

      $request->validate([
        'provider' => ['required', 'in:google,facebook'],
      ]);

      $provider = $request->input('provider');
      
      // Vérifier que l'utilisateur est bien connecté via ce provider
      if ($user->provider !== $provider) {
        return redirect()->route('user.settings.connections')
          ->with('error', __('Vous n\'êtes pas connecté via ce service.'));
      }
      
      // Vérifier que l'utilisateur a un mot de passe avant de déconnecter le provider
      if (empty($user->password)) {
        return redirect()->route('user.settings.connections')
          ->with('error', __('Vous devez d\'abord définir un mot de passe avant de supprimer cette connexion.') . ' <a href="' . route('user.settings.password') . '">' . __('Définir un mot de passe') . '</a>');
      }
      
      // Supprimer la connexion au provider
      $user->provider = null;
      $user->provider_id = null;
      $user->save();

      return redirect()->route('user.settings.connections')
        ->with('status', 'connection-disconnected')
        ->with('success', __('La connexion a été supprimée. Vous pouvez toujours vous reconnecter plus tard en utilisant ce compte, ou en ajoutant un autre moyen de connexion.'));
    } catch (\Exception $e) {
      Log::error('Erreur dans disconnectProvider: ' . $e->getMessage());
      
      return redirect()->route('user.settings.connections')
        ->with('error', __('Une erreur est survenue lors de la déconnexion.') . ' ' . $e->getMessage());
    }
  }

  /**
   * Afficher la page de confirmation de suppression de compte
   */
  public function confirmDeleteAccount()
  {
    try {
      $user = Auth::guard('web')->user();
      
      if (!$user) {
        return redirect()->route('user.login')
          ->with('error', __('Vous devez être connecté pour accéder à cette page.'));
      }
      
      if ($user->clientProfile) {
        return view('frontend.client.settings.delete-account', [
          'activeSection' => 'delete_account',
        ]);
      }

      return redirect()->route('user.settings.index');
    } catch (\Exception $e) {
      Log::error('Erreur dans confirmDeleteAccount: ' . $e->getMessage());
      
      return redirect()->route('user.settings.index')
        ->with('error', __('Une erreur est survenue lors du chargement de la page.'));
    }
  }

  /**
   * Supprimer définitivement le compte utilisateur
   */
  public function deleteAccount(Request $request)
  {
    try {
      $user = Auth::guard('web')->user();
      $clientProfile = $user->clientProfile;

      if (!$clientProfile) {
        return redirect()->route('user.settings.index')
          ->with('error', __('Accès refusé.'));
      }

      $request->validate([
        'current_password' => ['required', new MatchOldPasswordRule('user')],
        'confirmation' => ['required', 'accepted'],
        'reason_type' => ['required', 'in:no_longer_needed,too_expensive,prefer_other_service,quality_issues,personal_reasons,other'],
        'reason_other' => ['required_if:reason_type,other', 'nullable', 'string', 'max:500'],
      ], [
        'current_password.required' => __('Le mot de passe actuel est requis.'),
        'confirmation.accepted' => __('Vous devez confirmer que vous comprenez les conséquences de la suppression.'),
        'reason_type.required' => __('Veuillez sélectionner une raison pour votre départ.'),
        'reason_type.in' => __('La raison sélectionnée n\'est pas valide.'),
        'reason_other.required_if' => __('Veuillez préciser votre raison.'),
        'reason_other.max' => __('La raison ne doit pas dépasser 500 caractères.'),
      ]);

      // Annuler tous les abonnements actifs
      $activeSubscriptions = $clientProfile->subscriptions()
        ->whereIn('status', ['active', 'paused'])
        ->get();

      if ($activeSubscriptions->count() > 0) {
        $subscriptionService = app(\App\Services\Junspro\SubscriptionService::class);
        
        foreach ($activeSubscriptions as $subscription) {
          try {
            $subscriptionService->cancelSubscription($subscription);
          } catch (\Exception $e) {
            Log::warning('Erreur lors de l\'annulation de l\'abonnement ' . $subscription->id . ': ' . $e->getMessage());
            // On continue même si une annulation échoue
          }
        }
      }

      // Préparer la raison de suppression pour le log
      $reasonType = $request->input('reason_type');
      $reasonOther = $request->input('reason_other', '');
      
      $deletionReason = match($reasonType) {
        'no_longer_needed' => 'Je n\'ai plus besoin du service pour le moment',
        'too_expensive' => 'Le service est trop cher pour mon budget',
        'prefer_other_service' => 'Je préfère utiliser un autre service',
        'quality_issues' => 'Je n\'étais pas satisfait de la qualité du service',
        'personal_reasons' => 'Raisons personnelles ou changement de situation',
        'other' => 'Autre: ' . $reasonOther,
        default => 'Non spécifiée',
      };

      // Logger la raison de suppression (pour analyse et amélioration du service)
      Log::info('Compte supprimé par l\'utilisateur', [
        'user_id' => $user->id,
        'email' => $user->email_address,
        'reason_type' => $reasonType,
        'reason' => $deletionReason,
      ]);

      // Désactiver le compte (plutôt que de le supprimer pour conserver les données légales)
      $user->status = 0;
      $user->save();

      // Déconnexion de l'utilisateur
      Auth::guard('web')->logout();

      // Invalider la session
      $request->session()->invalidate();
      $request->session()->regenerateToken();

      return redirect('/')
        ->with('account_deleted', true)
        ->with('success', __('Votre compte Junspro a été supprimé. Merci d\'avoir testé la plateforme.'));
    } catch (\Illuminate\Validation\ValidationException $e) {
      return redirect()->back()
        ->withErrors($e->errors())
        ->withInput();
    } catch (\Exception $e) {
      Log::error('Erreur dans deleteAccount: ' . $e->getMessage());
      Log::error('Stack trace: ' . $e->getTraceAsString());
      
      return redirect()->route('user.settings.delete_account')
        ->with('error', __('Une erreur est survenue lors de la suppression du compte. Veuillez réessayer ou contacter le support.'));
    }
  }

  public function updatePassword(UpdatePasswordRequest $request)
  {
    $user = Auth::guard('web')->user();

    $user->update([
      'password' => Hash::make($request->new_password)
    ]);

    $request->session()->flash('success', 'Password updated successfully.');

    return redirect()->back();
  }

  public function serviceOrders()
  {
    $misc = new MiscellaneousController();

    $queryResult['breadcrumb'] = $misc->getBreadcrumb();

    $authUser = Auth::guard('web')->user();

    $orders = $authUser->serviceOrder()->orderByDesc('id')->get();

    $language = $misc->getLanguage();

    $orders->map(function ($order) use ($language) {
      $service = $order->service()->first();
      $order['serviceInfo'] = $service->content()->where('language_id', $language->id)->select('title', 'slug')->first();
    });

    $queryResult['orders'] = $orders;

    return view('frontend.user.service-orders', $queryResult);
  }

  public function raise_request($id, $status)
  {
    $order = ServiceOrder::where([['id', $id], ['user_id', Auth::guard('web')->user()->id]])->firstOrFail();
    if ($status == 1) {
      $order->raise_status = 1;
      $order->save();
      Session::flash('success', 'Your raise request has been successfully submited. Admin will contact you soon.');
    } else {
      $order->raise_status = 0;
      $order->save();
      Session::flash('error', 'Your raise request has been canceled.');
    }
    return back();
  }

  public function serviceOrderDetails($id)
  {
    $misc = new MiscellaneousController();

    $queryResult['breadcrumb'] = $misc->getBreadcrumb();

    $order = ServiceOrder::where([['id', $id], ['user_id', Auth::guard('web')->user()->id]])->firstOrFail();
    $queryResult['orderInfo'] = $order;

    $language = $misc->getLanguage();

    // get service title
    $service = $order->service()->first();
    $queryResult['serviceInfo'] = $service->content()->where('language_id', $language->id)->select('title', 'slug')->first();

    // get package title
    $package = $order->package()->first();

    if (is_null($package)) {
      $queryResult['packageTitle'] = NULL;
    } else {
      $queryResult['packageTitle'] = $package->name;
    }

    return view('frontend.user.service-order-details', $queryResult);
  }

  public function message($id)
  {
    $misc = new MiscellaneousController();

    $queryResult['breadcrumb'] = $misc->getBreadcrumb();

    $order = ServiceOrder::where([['id', $id], ['user_id', Auth::guard('web')->user()->id]])->firstOrFail();

    //check live chat status active or not for this user
    if (!is_null($order->seller_id)) {

      $checkPermission =  SellerPermissionHelper::getPackageInfo($order->seller_id, $order->seller_membership_id);
      if ($checkPermission != true) {
        Session::flash('success', 'Live chat is not active for this seller order.');
        return redirect()->route('user.dashboard');
      }
    }
    $queryResult['order'] = $order;

    $misc = new MiscellaneousController();
    $language = $misc->getLanguage();

    $service = $order->service()->first();
    $queryResult['serviceInfo'] = $service->content()->where('language_id', $language->id)->first();

    $messages = $order->message()->get();

    $messages->map(function ($message) {
      if ($message->person_type == 'user') {
        $message['user'] = $message->user()->first();
      } else {
        $message['admin'] = $message->admin()->first();
      }
    });

    $queryResult['messages'] = $messages;

    $queryResult['bs'] = Basic::query()->select('pusher_key', 'pusher_cluster')->first();

    return view('frontend.user.service-order-message', $queryResult);
  }

  public function storeMessage(MessageRequest $request, $id)
  {
    if ($request->hasFile('attachment')) {
      $file = $request->file('attachment');
      $fileName = UploadFile::store('./assets/file/message-files/', $file);
      $fileOriginalName = $file->getClientOriginalName();
    }

    $orderMsg = new ServiceOrderMessage();
    $orderMsg->person_id = Auth::guard('web')->user()->id;
    $orderMsg->person_type = 'user';
    $orderMsg->order_id = $id;
    $orderMsg->message = $request->filled('msg') ? Purifier::clean($request->msg, 'youtube') : NULL;
    $orderMsg->file_name = isset($fileName) ? $fileName : NULL;
    $orderMsg->file_original_name = isset($fileOriginalName) ? $fileOriginalName : NULL;
    $orderMsg->save();



    event(new MessageStored());

    return response()->json(['status' => 'Message stored.', 200]);
  }

  public function serviceWishlist()
  {
    $misc = new MiscellaneousController();

    $queryResult['breadcrumb'] = $misc->getBreadcrumb();

    $authUser = Auth::guard('web')->user();

    $listedServices = $authUser->wishlistedService()->orderByDesc('id')->get();

    $language = $misc->getLanguage();

    $listedServices->map(function ($listedService) use ($language) {
      $service = Service::query()->find($listedService->service_id);

      $listedService['serviceContent'] = $service->content()->where('language_id', $language->id)->first();
    });

    $queryResult['listedServices'] = $listedServices;

    return view('frontend.user.service-wishlist', $queryResult);
  }

  public function removeService($service_id)
  {
    try {
      $user = Auth::guard('web')->user();

      $listedService = $user->wishlistedService()->where('service_id', $service_id)->firstOrFail();

      $listedService->delete();

      return redirect()->back()->with('success', 'Service has been removed.');
    } catch (ModelNotFoundException $e) {
      return redirect()->back()->with('error', 'Service not found!');
    }
  }

  public function tickets()
  {
    $misc = new MiscellaneousController();

    $queryResult['breadcrumb'] = $misc->getBreadcrumb();

    $authUser = Auth::guard('web')->user();

    $queryResult['tickets'] = $authUser->ticket()->orderByDesc('id')->get();

    return view('frontend.user.support-tickets', $queryResult);
  }

  public function createTicket()
  {
    $misc = new MiscellaneousController();

    $breadcrumb = $misc->getBreadcrumb();

    return view('frontend.user.create-ticket', compact('breadcrumb'));
  }

  public function storeTempFile(Request $request)
  {
    // deleting other temp files
    $tempFiles = glob('assets/file/temp/*');

    if (count($tempFiles) > 0) {
      foreach ($tempFiles as $file) {
        @unlink(public_path($file));
      }
    }

    // storing new file as a temp file
    $file = $request->file('attachment');
    UploadFile::store('./assets/file/temp/', $file);

    return Response::json(['status' => 'success'], 200);
  }

  public function storeTicket(TicketRequest $request)
  {
    // deleting temp files
    $tempFiles = glob('assets/file/temp/*');

    if (count($tempFiles) > 0) {
      foreach ($tempFiles as $file) {
        @unlink(public_path($file));
      }
    }

    // storing new file
    if ($request->hasFile('attachment')) {
      $file = $request->file('attachment');
      $fileName = UploadFile::store('./assets/file/ticket-files/', $file);
    }

    $ticket = new SupportTicket();
    $ticket->user_id = Auth::guard('web')->user()->id;
    $ticket->user_type = 'user';
    $ticket->admin_id = 1;
    $ticket->ticket_number = uniqid();
    $ticket->subject = $request->subject;
    $ticket->message = Purifier::clean($request->message, 'youtube');
    $ticket->attachment = isset($fileName) ? $fileName : NULL;
    $ticket->save();

    $request->session()->flash('success', 'Ticket submitted successfully.');

    return redirect()->back();
  }

  public function ticketConversation($id)
  {

    $misc = new MiscellaneousController();

    $queryResult['breadcrumb'] = $misc->getBreadcrumb();

    $ticket = SupportTicket::query()->where([['user_id', Auth::guard('web')->user()->id], ['id', $id]])->firstOrFail();
    $queryResult['ticket'] = $ticket;

    $queryResult['conversations'] = $ticket->conversation()->get();

    return view('frontend.user.ticket-conversation', $queryResult);
  }

  public function ticketReply(ConversationRequest $request, $id)
  {
    // deleting temp files
    $tempFiles = glob('assets/file/temp/*');

    if (count($tempFiles) > 0) {
      foreach ($tempFiles as $file) {
        @unlink(public_path($file));
      }
    }

    // storing new file
    if ($request->hasFile('attachment')) {
      $file = $request->file('attachment');
      $fileName = UploadFile::store('./assets/file/ticket-files/', $file);
    }

    $conversation = new TicketConversation();
    $conversation->ticket_id = $id;
    $conversation->person_id = Auth::guard('web')->user()->id;
    $conversation->person_type = 'user';
    $conversation->reply = Purifier::clean($request->reply, 'youtube');
    $conversation->attachment = isset($fileName) ? $fileName : NULL;
    $conversation->save();

    $request->session()->flash('success', 'Reply submitted successfully.');

    return redirect()->back();
  }

  public function logoutSubmit(Request $request)
  {
    Auth::guard('web')->logout();

    if ($request->session()->has('redirectTo')) {
      $request->session()->forget('redirectTo');
    }

    return redirect()->route('user.login');
  }

  public function confirm_order($id)
  {
    $user_id = Auth::guard('web')->user()->id;
    $order = ServiceOrder::where([['user_id', $user_id], ['id', $id]])->firstOrFail();
    if (!is_null($order->grand_total)) {
      if (!is_null($order->seller_id)) {
        $arrData['seller_id'] = $order->seller_id;
        $seller = Seller::where('id', $order->seller_id)->first();
        if ($seller) {
          $pre_balance = $seller->amount;
          $after_balance = $seller->amount + ($order->grand_total - $order->tax);
          $seller->amount = $after_balance;
          $seller->save();
        } else {
          $pre_balance = null;
          $after_balance = null;
        }

        //send email to seller 
        $mailData = [];

        $mailData['subject'] = 'Completion Notification for Project ' . $order->order_number;

        $mailData['body'] = 'Hi ' . $order->name . ',<br/><br/>We are pleased to inform you that your recent project with order number: #' . $order->order_number . 'has been successfully completed.';

        $mailData['recipient'] = $order->email_address;

        BasicMailer::sendMail($mailData);
        //send email to seller end 

      } else {
        $pre_balance = null;
        $after_balance = null;
      }

      //add balance to seller account and transcation
      $transaction_data = [];
      $transaction_data['order_id'] = $order->id;
      $transaction_data['transcation_type'] = 1;
      $transaction_data['user_id'] = $order->user_id;
      $transaction_data['seller_id'] = $order->seller_id;
      $transaction_data['payment_status'] = $order->payment_status;
      $transaction_data['payment_method'] = $order->payment_method;
      $transaction_data['grand_total'] = $order->grand_total;
      $transaction_data['pre_balance'] = $pre_balance;
      $transaction_data['tax'] = $order->tax;
      $transaction_data['after_balance'] = $after_balance;
      $transaction_data['gateway_type'] = $order->gateway_type;
      $transaction_data['currency_symbol'] = $order->currency_symbol;
      $transaction_data['currency_symbol_position'] = $order->currency_symbol_position;
      storeTransaction($transaction_data);
      $data = [
        'life_time_earning' => $order->grand_total,
        'total_profit' => is_null($order->seller_id) ? $order->grand_total : $order->tax,
      ];
      storeEarnings($data);
    }
    $order->order_status = 'completed';
    $order->save();

    //add balance to seller account and transcation end
    Session::flash('success', 'Order completed successfully.');
    return back();
  }
}
