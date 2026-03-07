<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| User Interface Routes
|--------------------------------------------------------------------------
*/

// IMPORTANT: Route freelance/services/create DOIT être en PREMIER pour éviter tout conflit
// Services Freelance - Création de service
Route::get('/freelance/services/create', [\App\Http\Controllers\FrontEnd\Freelance\FreelanceServiceController::class, 'create'])
    ->middleware(['web', 'auth:web', 'change.lang'])
    ->name('freelance.services.create');

Route::post('/freelance/services/store', [\App\Http\Controllers\FrontEnd\Freelance\FreelanceServiceController::class, 'store'])
    ->middleware(['web', 'auth:web', 'change.lang'])
    ->name('freelance.services.store');

Route::get('invoice', function () {
  return view('frontend.service.invoice');
});



Route::post('/push-notification/store-endpoint', 'FrontEnd\PushNotificationController@store');
// cron job for sending expiry mail
Route::get('/subcheck', 'CronJobController@expired')->name('cron.expired');
Route::get('/check-payment', 'CronJobController@check_payment')->name('cron.check_payment');

Route::get('myfatoorah/callback', 'MyFatoorahController@callback')->name('myfatoorah_callback');

Route::get('myfatoorah/cancel', 'MyFatoorahController@cancel')->name('myfatoorah_cancel');

Route::get('midtrans/bank/notify', 'MidtransController@onlineBankNotify')->name('midtrans.bank_notify');
Route::get('midtrans/cancel', 'MidtransController@cancel')->name('midtrans.cancel');

Route::get('/change-language', 'FrontEnd\MiscellaneousController@changeLanguage')->name('change_language');

Route::post('/store-subscriber', 'FrontEnd\MiscellaneousController@storeSubscriber')->name('store_subscriber');

// Routes pour le formulaire client de mission
Route::prefix('/mission')->middleware('change.lang')->group(function () {
  Route::get('/soumettre', 'FrontEnd\ClientMissionController@showForm')->name('mission.form');
  Route::post('/soumettre', 'FrontEnd\ClientMissionController@submit')->name('mission.submit');
  Route::get('/succes/{id}', 'FrontEnd\ClientMissionController@success')->name('mission.success');
  Route::get('/stripe/success', 'FrontEnd\ClientMissionController@stripeSuccess')->name('mission.stripe.success');
  Route::get('/stripe/cancel', 'FrontEnd\ClientMissionController@stripeCancel')->name('mission.stripe.cancel');
  Route::post('/homeswap/checkout', 'FrontEnd\ClientMissionController@homeSwapCheckout')->name('mission.homeswap.checkout')->middleware('auth:web');
});

// Webhook Stripe (sans middleware CSRF et change.lang pour éviter les problèmes)
Route::post('/mission/stripe/webhook', 'FrontEnd\ClientMissionController@stripeWebhook')
    ->name('mission.stripe.webhook')
    ->withoutMiddleware(['web']);

// Webhook Stripe Junspro V2 (abonnements)
Route::post('/junspro/stripe/webhook', 'FrontEnd\JunsproStripeWebhookController@handle')
    ->name('junspro.stripe.webhook')
    ->withoutMiddleware(['web']);

// Route pour le formulaire de contact de l'assistant IA
Route::post('/assistant/contact', 'FrontEnd\AssistantContactController@store')
    ->name('assistant.contact');

// Callback Calendly (sans middleware CSRF)
Route::post('/mission/calendly/callback', 'FrontEnd\ClientMissionController@calendlyCallback')
    ->name('mission.calendly.callback')
    ->withoutMiddleware(['web']);

// Route de test
Route::get('/__ping', fn() => 'ok');

// Route de test pour vérifier que le contrôleur fonctionne
Route::get('/freelance/services/test', function() {
    return response()->json([
        'status' => 'ok',
        'message' => 'Route de test fonctionne',
        'controller_exists' => class_exists(\App\Http\Controllers\FrontEnd\Freelance\FreelanceServiceController::class),
        'method_exists' => method_exists(\App\Http\Controllers\FrontEnd\Freelance\FreelanceServiceController::class, 'create')
    ]);
})->name('freelance.services.test');

// Route de test pour appeler réellement la méthode create() et voir l'erreur
Route::get('/freelance/services/test-create', function() {
    try {
        $controller = new \App\Http\Controllers\FrontEnd\Freelance\FreelanceServiceController();
        return $controller->create(request());
    } catch (\Exception $e) {
        return response()->json([
            'error' => true,
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'trace' => explode("\n", substr($e->getTraceAsString(), 0, 2000))
        ], 500);
    }
})->middleware(['web', 'auth:web', 'change.lang'])->name('freelance.services.test-create');

Route::middleware('change.lang')->group(function () {
  Route::get('/', 'FrontEnd\HomeController@cover')->name('index');
  Route::get('/home', 'FrontEnd\HomeController@index')->name('home');
  Route::get('/pricing', [\App\Http\Controllers\FrontEnd\PricingController::class, 'index'])->name('pricing');
Route::post('/pricing/subscribe', [\App\Http\Controllers\FrontEnd\PricingController::class, 'subscribe'])->name('pricing.subscribe')->middleware('auth:web');
  Route::get('/explore', function() {
    return redirect()->route('services');
  })->name('explore');
  Route::get('/freelances', function() {
    return redirect()->route('services');
  })->name('freelances');
  
  // Route pour déposer un projet (alias vers mission.form pour cohérence)
  Route::get('/deposer-projet', function() {
    return redirect()->route('mission.form');
  })->name('deposer-projet');
  
  // Dashboard Freelance One-Page Premium (DOIT être AVANT /freelance/{id} pour éviter le conflit)
  Route::get('/freelance/dashboard', [\App\Http\Controllers\FrontEnd\Freelance\FreelanceDashboardController::class, 'index'])->name('freelance.dashboard')->middleware('auth:web');

  // Dashboard NEXUS — Espace échanges premium
  Route::get('/nexus/dashboard', [\App\Http\Controllers\FrontEnd\NexusDashboardController::class, 'index'])->name('nexus.dashboard')->middleware('auth:web');
  Route::post('/nexus/preferences', [\App\Http\Controllers\FrontEnd\NexusDashboardController::class, 'savePreferences'])->name('nexus.preferences.save')->middleware('auth:web');
  Route::get('/nexus/offer', [\App\Http\Controllers\FrontEnd\NexusDashboardController::class, 'saveOffer'])->name('nexus.offer.save')->middleware('auth:web');

  // Onboarding NEXUS — Profil échanges premium (6 étapes)
  Route::middleware(['auth:web'])->prefix('/nexus/onboarding')->name('nexus.onboarding.')->group(function () {
    Route::get('/step-1',  [\App\Http\Controllers\FrontEnd\NexusOnboardingController::class, 'step1'])->name('step1');
    Route::post('/step-1', [\App\Http\Controllers\FrontEnd\NexusOnboardingController::class, 'step1Store'])->name('step1.store');
    // Autosave silencieux — appelé en AJAX à chaque modification de champ
    Route::post('/autosave', [\App\Http\Controllers\FrontEnd\NexusOnboardingController::class, 'autosave'])->name('autosave');
    Route::get('/step-2',  [\App\Http\Controllers\FrontEnd\NexusOnboardingController::class, 'step2'])->name('step2');
    Route::post('/step-2', [\App\Http\Controllers\FrontEnd\NexusOnboardingController::class, 'step2Store'])->name('step2.store');
    Route::get('/step-3',  [\App\Http\Controllers\FrontEnd\NexusOnboardingController::class, 'step3'])->name('step3');
    Route::post('/step-3', [\App\Http\Controllers\FrontEnd\NexusOnboardingController::class, 'step3Store'])->name('step3.store');
    // Redirections de compatibilité (anciens liens step4/5/6)
    Route::get('/step-4',  [\App\Http\Controllers\FrontEnd\NexusOnboardingController::class, 'step4'])->name('step4');
    Route::post('/step-4', [\App\Http\Controllers\FrontEnd\NexusOnboardingController::class, 'step4Store'])->name('step4.store');
    Route::get('/step-5',  [\App\Http\Controllers\FrontEnd\NexusOnboardingController::class, 'step5'])->name('step5');
    Route::post('/step-5', [\App\Http\Controllers\FrontEnd\NexusOnboardingController::class, 'step5Store'])->name('step5.store');
    Route::get('/step-6',  [\App\Http\Controllers\FrontEnd\NexusOnboardingController::class, 'step6'])->name('step6');
    Route::post('/step-6', [\App\Http\Controllers\FrontEnd\NexusOnboardingController::class, 'step6Store'])->name('step6.store');
    Route::get('/complete', [\App\Http\Controllers\FrontEnd\NexusOnboardingController::class, 'complete'])->name('complete');
  });

  // Disponibilités calendrier freelance (onglet Agenda)
  Route::middleware(['auth:web'])->prefix('/freelance/calendar')->name('freelance.calendar.')->group(function () {
    Route::get('/slots', [\App\Http\Controllers\FrontEnd\Freelance\AvailabilityController::class, 'index'])->name('slots.index');
    Route::post('/slots', [\App\Http\Controllers\FrontEnd\Freelance\AvailabilityController::class, 'store'])->name('slots.store');
    Route::put('/slots/{slot}', [\App\Http\Controllers\FrontEnd\Freelance\AvailabilityController::class, 'update'])->whereNumber('slot')->name('slots.update');
    Route::delete('/slots/{slot}', [\App\Http\Controllers\FrontEnd\Freelance\AvailabilityController::class, 'destroy'])->whereNumber('slot')->name('slots.destroy');
  });
  
  // Settings Freelance (séparé des settings client)
  Route::middleware(['auth:web'])->prefix('/freelance/settings')->name('freelance.settings.')->group(function () {
    Route::get('/', [\App\Http\Controllers\FrontEnd\Freelance\FreelanceSettingsController::class, 'index'])->name('index');
    Route::get('/identity', [\App\Http\Controllers\FrontEnd\Freelance\FreelanceSettingsController::class, 'identity'])->name('identity');
    Route::get('/security', [\App\Http\Controllers\FrontEnd\Freelance\FreelanceSettingsController::class, 'security'])->name('security');
    Route::get('/email', [\App\Http\Controllers\FrontEnd\Freelance\FreelanceSettingsController::class, 'email'])->name('email');
    Route::get('/payouts', [\App\Http\Controllers\FrontEnd\Freelance\FreelanceSettingsController::class, 'payouts'])->name('payouts');
    Route::post('/payouts', [\App\Http\Controllers\FrontEnd\Freelance\FreelanceSettingsController::class, 'storePayouts'])->name('payouts.store');
    Route::get('/notifications', [\App\Http\Controllers\FrontEnd\Freelance\FreelanceSettingsController::class, 'notifications'])->name('notifications');
    Route::get('/video', [\App\Http\Controllers\FrontEnd\Freelance\FreelanceSettingsController::class, 'video'])->name('video');
    Route::post('/video', [\App\Http\Controllers\FrontEnd\Freelance\FreelanceSettingsController::class, 'updateVideo'])->name('video.update');
    Route::get('/integrations', [\App\Http\Controllers\FrontEnd\Freelance\FreelanceSettingsController::class, 'integrations'])->name('integrations');
    Route::get('/close', [\App\Http\Controllers\FrontEnd\Freelance\FreelanceSettingsController::class, 'close'])->name('close');
  });
  
  Route::get('/freelance/{id}', [\App\Http\Controllers\FrontEnd\FreelancerController::class, 'show'])->where('id', '[0-9]+')->name('freelance.show');
  Route::get('/devenir-freelance', [\App\Http\Controllers\FrontEnd\Freelance\OnboardingController::class, 'start'])->name('freelance.onboarding.start');
  Route::get('/devenir-membre-nexus', [\App\Http\Controllers\FrontEnd\NexusOnboardingController::class, 'becomeMember'])->name('nexus.become-member');
  
  // Routes onboarding freelance (protégées par auth)
  Route::middleware(['auth:web'])->prefix('/freelance/onboarding')->name('freelance.onboarding.')->group(function () {
    Route::get('/step-1', [\App\Http\Controllers\FrontEnd\Freelance\OnboardingController::class, 'step1'])->name('step1');
    Route::post('/step-1', [\App\Http\Controllers\FrontEnd\Freelance\OnboardingController::class, 'step1Store'])->name('step1.store')->withoutMiddleware('change.lang');
    Route::get('/step-2', [\App\Http\Controllers\FrontEnd\Freelance\OnboardingController::class, 'step2'])->name('step2');
    Route::post('/step-2', [\App\Http\Controllers\FrontEnd\Freelance\OnboardingController::class, 'step2Store'])->name('step2.store')->withoutMiddleware('change.lang');
    Route::get('/step-3', [\App\Http\Controllers\FrontEnd\Freelance\OnboardingController::class, 'step3'])->name('step3');
    Route::post('/step-3', [\App\Http\Controllers\FrontEnd\Freelance\OnboardingController::class, 'step3Store'])->name('step3.store')->withoutMiddleware('change.lang');
    Route::get('/step-4', [\App\Http\Controllers\FrontEnd\Freelance\OnboardingController::class, 'step4'])->name('step4');
    Route::post('/step-4', [\App\Http\Controllers\FrontEnd\Freelance\OnboardingController::class, 'step4Store'])->name('step4.store')->withoutMiddleware('change.lang');
    Route::get('/step-5', [\App\Http\Controllers\FrontEnd\Freelance\OnboardingController::class, 'step5'])->name('step5');
    Route::post('/step-5', [\App\Http\Controllers\FrontEnd\Freelance\OnboardingController::class, 'step5Store'])->name('step5.store')->withoutMiddleware('change.lang');
    Route::get('/step-6', [\App\Http\Controllers\FrontEnd\Freelance\OnboardingController::class, 'step6'])->name('step6');
    Route::post('/step-6', [\App\Http\Controllers\FrontEnd\Freelance\OnboardingController::class, 'step6Store'])->name('step6.store')->withoutMiddleware('change.lang');
    Route::get('/step-7', [\App\Http\Controllers\FrontEnd\Freelance\OnboardingController::class, 'step7'])->name('step7');
    Route::post('/step-7', [\App\Http\Controllers\FrontEnd\Freelance\OnboardingController::class, 'step7Store'])->name('step7.store')->withoutMiddleware('change.lang');
    Route::get('/step-8', [\App\Http\Controllers\FrontEnd\Freelance\OnboardingController::class, 'step8'])->name('step8');
    Route::post('/step-8', [\App\Http\Controllers\FrontEnd\Freelance\OnboardingController::class, 'step8Store'])->name('step8.store')->withoutMiddleware('change.lang');
    Route::get('/complete', [\App\Http\Controllers\FrontEnd\Freelance\OnboardingController::class, 'complete'])->name('complete');
    Route::post('/update-email', [\App\Http\Controllers\FrontEnd\Freelance\OnboardingController::class, 'updateEmail'])->name('update_email');
  });
  Route::get('/freelance/{id}/booking', [\App\Http\Controllers\FrontEnd\FreelancerController::class, 'booking'])->name('freelance.booking')->middleware('auth:web');
  Route::post('/freelance/{id}/book-slots', [\App\Http\Controllers\FrontEnd\FreelancerController::class, 'bookSlots'])->name('freelance.book-slots')->middleware('auth:web');
  Route::post('/freelance/{id}/trial', [\App\Http\Controllers\FrontEnd\FreelancerController::class, 'startTrial'])->name('freelance.trial')->middleware('auth:web');
  Route::post('/freelance/{id}/subscribe', [\App\Http\Controllers\FrontEnd\FreelancerController::class, 'subscribe'])->name('freelance.subscribe')->middleware('auth:web');
  
  // Routes Services Hub (DOIT être AVANT la route /services existante pour éviter les conflits)
  Route::prefix('/services')->middleware('change.lang')->group(function () {
    Route::get('/', [\App\Http\Controllers\FrontEnd\ServicesController::class, 'index'])->name('services');
    
    // Routes spécifiques (DOIVENT être AVANT la route générique {universe}/{category})
    Route::get('/projects', [\App\Http\Controllers\FrontEnd\ServicesController::class, 'projects'])->name('services.projects');
    Route::get('/lessons', [\App\Http\Controllers\FrontEnd\ServicesController::class, 'lessons'])->name('services.lessons');
    Route::get('/at-home', [\App\Http\Controllers\FrontEnd\ServicesController::class, 'atHome'])->name('services.at-home');
    Route::get('/wellnesslive', [\App\Http\Controllers\FrontEnd\ServicesController::class, 'wellnesslive'])->name('services.wellnesslive');
    Route::get('/corporate', [\App\Http\Controllers\FrontEnd\ServicesController::class, 'corporate'])->name('services.corporate');
    Route::get('/homeswap', [\App\Http\Controllers\FrontEnd\ServicesController::class, 'homeswap'])->name('services.homeswap');
    
    // Routes pour les pages de catégories (DOIT être EN DERNIER pour éviter les conflits)
    Route::get('/{universe}/{category}', [\App\Http\Controllers\FrontEnd\ServicesController::class, 'category'])
      ->where(['universe' => 'projects|lessons|at-home|wellnesslive|corporate|homeswap', 'category' => '[a-z0-9-]+'])
      ->name('services.category');
  });
  
  // Route services legacy (ancienne route, conservée pour compatibilité)
  Route::get('/services-legacy', 'FrontEnd\ClientService\ServiceController@index')->name('services.legacy')->middleware('isServices');

  Route::get('/search-service', 'FrontEnd\ClientService\ServiceController@search_service')->name('search-service')->middleware('isServices');

  Route::get('/midtrans/notify/{id}', 'FrontEnd\PaymentGateway\MidtransController@cardNotify')->name('service.place_order.midtrans.notify');

  Route::middleware('isServices')->prefix('/service/{slug}')->group(function () {
    Route::post('/update-wishlist', 'FrontEnd\ClientService\ServiceController@updateWishlist')->name('service.update_wishlist');

    Route::get('/{id}', 'FrontEnd\ClientService\ServiceController@show')->name('service_details');

    Route::post('{id}/payment-form', 'FrontEnd\ClientService\ServiceController@paymentFormCheck')->name('service.payment_form.check');
    Route::get('{id}/payment-form', 'FrontEnd\ClientService\ServiceController@paymentForm')->name('service.payment_form');

    Route::prefix('/place-order')->middleware('Demo')->group(function () {
      Route::post('', 'FrontEnd\ClientService\OrderProcessController@index')->name('service.place_order');

      Route::get('/paypal/notify', 'FrontEnd\PaymentGateway\PayPalController@notify')->name('service.place_order.paypal.notify');

      Route::get('/instamojo/notify', 'FrontEnd\PaymentGateway\InstamojoController@notify')->name('service.place_order.instamojo.notify');

      Route::get('/paystack/notify', 'FrontEnd\PaymentGateway\PaystackController@notify')->name('service.place_order.paystack.notify');

      Route::get('/flutterwave/notify', 'FrontEnd\PaymentGateway\FlutterwaveController@notify')->name('service.place_order.flutterwave.notify');

      Route::post('/razorpay/notify', 'FrontEnd\PaymentGateway\RazorpayController@notify')->name('service.place_order.razorpay.notify');

      Route::get('/mercadopago/notify', 'FrontEnd\PaymentGateway\MercadoPagoController@notify')->name('service.place_order.mercadopago.notify');

      Route::get('/mollie/notify', 'FrontEnd\PaymentGateway\MollieController@notify')->name('service.place_order.mollie.notify');

      Route::post('/paytm/notify', 'FrontEnd\PaymentGateway\PaytmController@notify')->name('service.place_order.paytm.notify');

      Route::any('/phonepe/notify', 'FrontEnd\PaymentGateway\PhonePeController@notify')->name('service.place_order.phonepe.notify');

      Route::get('/yoco/notify', 'FrontEnd\PaymentGateway\YocoController@notify')->name('service.place_order.yoco.notify');

      Route::get('/perfect_money/notify', 'FrontEnd\PaymentGateway\PerfectMoneyController@notify')->name('service.place_order.perfect_money.notify');

      Route::get('/toyyibpay/notify', 'FrontEnd\PaymentGateway\ToyyibpayController@notify')->name('service.place_order.toyyibpay.notify');

      Route::post('/paytabs/notify', 'FrontEnd\PaymentGateway\PaytabsController@notify')->name('service.place_order.paytabs.notify');

      Route::post('/iyzico/notify', 'FrontEnd\PaymentGateway\IyzicoController@notify')->name('service.place_order.iyzico.notify');
      Route::get('/xendit/notify', 'FrontEnd\PaymentGateway\XenditController@notify')->name('service.place_order.xendit.notify');

      Route::get('/complete', 'FrontEnd\ClientService\OrderProcessController@complete')->name('service.place_order.complete');

      Route::get('/cancel', 'FrontEnd\ClientService\OrderProcessController@cancel')->name('service.place_order.cancel');
    });
  });

  Route::post('/service/{id}/store-review', 'FrontEnd\ClientService\ServiceController@storeReview')->name('service.store_review')->middleware('Demo');

  Route::get('/payment-form', 'FrontEnd\PayController@index')->name('payment_form');

  Route::prefix('/pay')->middleware('Demo')->group(function () {
    Route::post('', 'FrontEnd\PayController@pay')->name('pay');

    Route::get('/paypal/notify', 'FrontEnd\PaymentGateway\PayPalController@notify')->name('pay.paypal.notify');

    Route::get('/instamojo/notify', 'FrontEnd\PaymentGateway\InstamojoController@notify')->name('pay.instamojo.notify');

    Route::get('/paystack/notify', 'FrontEnd\PaymentGateway\PaystackController@notify')->name('pay.paystack.notify');

    Route::get('/flutterwave/notify', 'FrontEnd\PaymentGateway\FlutterwaveController@notify')->name('pay.flutterwave.notify');

    Route::post('/razorpay/notify', 'FrontEnd\PaymentGateway\RazorpayController@notify')->name('pay.razorpay.notify');

    Route::get('/mercadopago/notify', 'FrontEnd\PaymentGateway\MercadoPagoController@notify')->name('pay.mercadopago.notify');

    Route::get('/mollie/notify', 'FrontEnd\PaymentGateway\MollieController@notify')->name('pay.mollie.notify');

    Route::post('/paytm/notify', 'FrontEnd\PaymentGateway\PaytmController@notify')->name('pay.paytm.notify');

    Route::get('/complete', 'FrontEnd\PayController@complete')->name('pay.complete');

    Route::get('/cancel', 'FrontEnd\PayController@cancel')->name('pay.cancel');
  });

  Route::prefix('sellers')->group(function () {
    Route::get('/', 'FrontEnd\SellerController@index')->name('frontend.sellers');
    Route::post('contact/message', 'FrontEnd\SellerController@contact')->name('seller.contact.message')->middleware('Demo');
  });
  Route::get('seller/{username}', 'FrontEnd\SellerController@details')->name('frontend.seller.details');
  Route::get('followers/{username}', 'FrontEnd\SellerController@followers')->name('frontend.seller.followers');
  Route::get('followings/{username}', 'FrontEnd\SellerController@following')->name('frontend.seller.followings');
  Route::get('follow-seller/', 'FrontEnd\SellerController@follow_seller')->name('frontend.seller.follow-seller');
  Route::get('unfollow-seller/', 'FrontEnd\SellerController@unfollow_seller')->name('frontend.seller.unfollow-seller');


  Route::prefix('/blog')->group(function () {
    Route::get('', 'FrontEnd\BlogController@index')->name('blog');

    Route::get('/post/{slug}/{id}', 'FrontEnd\BlogController@show')->name('blog.post_details');
  });

  Route::get('/about', 'FrontEnd\AboutUsController@index')->name('aboutus');
  Route::get('/faq', 'FrontEnd\FaqController@faq')->name('faq');

  Route::prefix('/contact')->group(function () {
    Route::get('', 'FrontEnd\ContactController@contact')->name('contact');

    Route::post('/send-mail', 'FrontEnd\ContactController@sendMail')->name('contact.send_mail')->withoutMiddleware('change.lang')->middleware('Demo');
  });
});


Route::post('/advertisement/{id}/count-view', 'FrontEnd\MiscellaneousController@countAdView');

Route::get('login/facebook/callback', 'FrontEnd\UserController@handleFacebookCallback');
Route::get('login/google/callback', 'FrontEnd\UserController@handleGoogleCallback');
Route::prefix('/user')->middleware(['guest:web', 'change.lang'])->group(function () {
  Route::prefix('/login')->group(function () {
    // user redirect to login page route
    Route::get('', 'FrontEnd\UserController@login')->name('user.login');

    // user login via facebook route
    Route::prefix('/facebook')->group(function () {
      Route::get('', 'FrontEnd\UserController@redirectToFacebook')->name('user.login.facebook');
    });

    // user login via google route
    Route::prefix('/google')->group(function () {
      Route::get('', 'FrontEnd\UserController@redirectToGoogle')->name('user.login.google');
    });
  });

  // user login submit route
  Route::post('/login-submit', 'FrontEnd\UserController@loginSubmit')->name('user.login_submit')->withoutMiddleware('change.lang');
  
  // Redirect GET requests to login-submit to login page (pour éviter l'erreur MethodNotAllowed)
  Route::get('/login-submit', function() {
    return redirect()->route('user.login');
  })->name('user.login_submit.get');

  // resend verification email route
  Route::post('/resend-verification', 'FrontEnd\UserController@resendVerificationEmail')->name('user.resend_verification')->withoutMiddleware('change.lang');

  // user forget password route
  Route::get('/forget-password', 'FrontEnd\UserController@forgetPassword')->name('user.forget_password');

  // send mail to user for forget password route
  Route::post('/send-forget-password-mail', 'FrontEnd\UserController@forgetPasswordMail')->name('user.send_forget_password_mail')->withoutMiddleware('change.lang')->middleware('Demo');

  // reset password route
  Route::get('/reset-password', 'FrontEnd\UserController@resetPassword');

  // user reset password submit route
  Route::post('/reset-password-submit', 'FrontEnd\UserController@resetPasswordSubmit')->name('user.reset_password_submit')->withoutMiddleware('change.lang')->middleware('Demo');
});

// Route signup accessible même si connecté (pour permettre création profil freelance)
Route::prefix('/user')->middleware(['change.lang'])->group(function () {
  // user redirect to signup page route
  Route::get('/signup', 'FrontEnd\UserController@signup')->name('user.signup');

  // user signup submit route
  Route::post('/signup-submit', 'FrontEnd\UserController@signupSubmit')->name('user.signup_submit')->withoutMiddleware('change.lang')->middleware('Demo');

  // signup verify route
  Route::get('/signup-verify/{token}', 'FrontEnd\UserController@signupVerify')->withoutMiddleware('change.lang');
});

// Routes de parrainage
Route::prefix('/parrainage')->middleware(['change.lang'])->group(function () {
  Route::get('/', [\App\Http\Controllers\FrontEnd\ReferralController::class, 'index'])->name('referral.index');
  Route::get('/conditions', [\App\Http\Controllers\FrontEnd\ReferralController::class, 'conditions'])->name('referral.conditions');
});

// Routes Présence - Pause Souffle
Route::prefix('/presence')->middleware(['change.lang'])->group(function () {
  Route::get('/pause-souffle', [\App\Http\Controllers\FrontEnd\PauseSouffleController::class, 'index'])->name('presence.pause-souffle');
  Route::post('/pause-souffle/submit', [\App\Http\Controllers\FrontEnd\PauseSouffleController::class, 'submit'])->name('presence.pause-souffle.submit');
  Route::get('/pause-souffle/stripe/success', [\App\Http\Controllers\FrontEnd\PauseSouffleController::class, 'stripeSuccess'])->name('pause-souffle.stripe.success');
  Route::get('/pause-souffle/stripe/cancel', [\App\Http\Controllers\FrontEnd\PauseSouffleController::class, 'stripeCancel'])->name('pause-souffle.stripe.cancel');
  Route::get('/pause-souffle/choose-cycle', [\App\Http\Controllers\FrontEnd\PauseSouffleController::class, 'chooseCycle'])->name('pause-souffle.choose-cycle')->middleware('auth:web');
  Route::post('/pause-souffle/activate-cycle', [\App\Http\Controllers\FrontEnd\PauseSouffleController::class, 'activateCycle'])->name('pause-souffle.activate-cycle')->middleware('auth:web');
  Route::get('/pause-souffle/cycle-confirmation', [\App\Http\Controllers\FrontEnd\PauseSouffleController::class, 'cycleConfirmation'])->name('pause-souffle.cycle-confirmation')->middleware('auth:web');
});

// Route de tracking /r/{code} (publique, sans auth)
Route::get('/r/{code}', [\App\Http\Controllers\FrontEnd\ReferralController::class, 'track'])->name('referral.track')->middleware('change.lang');

// API routes pour parrainage (auth required)
Route::prefix('/api/referral')->middleware(['auth:web', 'change.lang'])->group(function () {
  Route::post('/copy-link', [\App\Http\Controllers\FrontEnd\ReferralController::class, 'copyLink'])->name('referral.api.copy-link');
  Route::post('/send-invitations', [\App\Http\Controllers\FrontEnd\ReferralController::class, 'sendInvitations'])->name('referral.api.send-invitations');
  Route::post('/recommend-company', [\App\Http\Controllers\FrontEnd\ReferralController::class, 'recommendCompany'])->name('referral.api.recommend-company');
});

// API routes pour schedulers (Projects et HomeSwap)
Route::prefix('/api/scheduler')->middleware(['auth:web'])->group(function () {
  Route::get('/projects/context', [\App\Http\Controllers\FrontEnd\SchedulerController::class, 'projectsContext'])->name('scheduler.api.projects.context');
  Route::post('/projects/confirm', [\App\Http\Controllers\FrontEnd\SchedulerController::class, 'projectsConfirm'])->name('scheduler.api.projects.confirm');
  Route::get('/homeswap/context', [\App\Http\Controllers\FrontEnd\SchedulerController::class, 'homeswapContext'])->name('scheduler.api.homeswap.context');
  Route::post('/homeswap/request', [\App\Http\Controllers\FrontEnd\SchedulerController::class, 'homeswapRequest'])->name('scheduler.api.homeswap.request');
});

Route::prefix('/user')->middleware(['auth:web', 'account.status', 'change.lang'])->group(function () {
  // user redirect to dashboard route
  Route::get('/dashboard', 'FrontEnd\UserController@redirectToDashboard')->name('user.dashboard');
  
  // Routes simplifiées pour le tableau de bord client (alias des routes /account/*)
  Route::get('/messages', [\App\Http\Controllers\FrontEnd\ClientMessagesController::class, 'index'])->name('user.messages.index');
  Route::post('/messages/send', [\App\Http\Controllers\FrontEnd\ClientMessagesController::class, 'sendMessage'])->name('user.messages.send');
  Route::get('/messages/start/{freelancerId}', [\App\Http\Controllers\FrontEnd\ClientMessagesController::class, 'startLeadConversation'])->name('user.messages.start_lead');
  Route::get('/projects-sessions', [\App\Http\Controllers\FrontEnd\ClientSubscriptionController::class, 'index'])->name('user.projects_sessions.index');
  Route::get('/subscriptions', [\App\Http\Controllers\FrontEnd\ClientSubscriptionController::class, 'index'])->name('user.subscriptions.index');
  Route::get('/settings', 'FrontEnd\UserController@editProfile')->name('user.settings.index');

  // Settings - Profil personnel
  Route::get('/settings/profile', 'FrontEnd\UserController@editProfileSettings')->name('user.settings.profile');

  // Settings - Mot de passe (nouvelle page)
  Route::get('/settings/password', 'FrontEnd\UserController@editPassword')->name('user.settings.password');
  Route::post('/settings/password', 'FrontEnd\UserController@updatePasswordSettings')->name('user.settings.password.update')->withoutMiddleware('change.lang')->middleware('Demo');
  
  // Settings - Adresse e-mail (nouvelle page)
  Route::get('/settings/email', 'FrontEnd\UserController@editEmail')->name('user.settings.email.edit');
  Route::post('/settings/email', 'FrontEnd\UserController@updateEmail')->name('user.settings.email.update')->withoutMiddleware('change.lang')->middleware('Demo');
  
  // Settings - Modes de paiement (nouvelle page)
  Route::get('/settings/payment-methods', 'FrontEnd\UserController@paymentMethods')->name('user.settings.payment_methods.index');
  Route::post('/settings/payment-methods', 'FrontEnd\UserController@storePaymentMethod')->name('user.settings.payment_methods.store')->withoutMiddleware('change.lang')->middleware('Demo');
  Route::delete('/settings/payment-methods/{paymentMethod}', 'FrontEnd\UserController@destroyPaymentMethod')->name('user.settings.payment_methods.destroy')->withoutMiddleware('change.lang')->middleware('Demo');
  
  // Settings - Abonnement Junspro (nouvelle page)
  Route::get('/settings/subscription', 'FrontEnd\UserController@subscription')->name('user.settings.subscription');
  Route::post('/settings/subscription/{subscription}/pause', 'FrontEnd\UserController@pauseSubscription')->name('user.settings.subscription.pause')->withoutMiddleware('change.lang')->middleware('Demo');
  Route::post('/settings/subscription/{subscription}/resume', 'FrontEnd\UserController@resumeSubscription')->name('user.settings.subscription.resume')->withoutMiddleware('change.lang')->middleware('Demo');
  Route::post('/settings/subscription/{subscription}/cancel', 'FrontEnd\UserController@cancelSubscription')->name('user.settings.subscription.cancel')->withoutMiddleware('change.lang')->middleware('Demo');
  Route::get('/account/subscriptions/{subscription}/topup-quota', 'FrontEnd\UserController@getTopupQuota')->name('user.account.subscriptions.topup-quota');
  Route::post('/account/subscriptions/{subscription}/topup', 'FrontEnd\UserController@topupSubscription')->name('user.account.subscriptions.topup')->withoutMiddleware('change.lang')->middleware('Demo');
  Route::get('/account/subscriptions/{subscription}/change-plan-context', 'FrontEnd\UserController@getChangePlanContext')->name('user.account.subscriptions.change-plan-context');
  Route::post('/account/subscriptions/{subscription}/change-plan', 'FrontEnd\UserController@changePlan')->name('user.account.subscriptions.change-plan')->withoutMiddleware('change.lang')->middleware('Demo');
  
  // Transfer Replace flow (Remplacer le freelance)
  Route::get('/account/subscriptions/{subscription}/transfer/replace/candidates', 'FrontEnd\UserController@getReplaceCandidates')->name('user.account.subscriptions.transfer.replace.candidates');
  Route::post('/account/subscriptions/{subscription}/transfer/replace/thanks', 'FrontEnd\UserController@sendReplaceThanks')->name('user.account.subscriptions.transfer.replace.thanks')->withoutMiddleware('change.lang')->middleware('Demo');
  Route::post('/account/subscriptions/{subscription}/transfer/replace/confirm', 'FrontEnd\UserController@confirmReplace')->name('user.account.subscriptions.transfer.replace.confirm')->withoutMiddleware('change.lang')->middleware('Demo');

  // Transfer Add flow (Ajouter un autre freelance)
  Route::get('/account/subscriptions/{subscription}/transfer/add/candidates', 'FrontEnd\UserController@getAddCandidates')->name('user.account.subscriptions.transfer.add.candidates');
  Route::post('/account/subscriptions/{subscription}/transfer/add/confirm', 'FrontEnd\UserController@confirmAdd')->name('user.account.subscriptions.transfer.add.confirm')->withoutMiddleware('change.lang')->middleware('Demo');
  Route::post('/account/subscriptions/{subscription}/transfer/add/payment', 'FrontEnd\UserController@processAddPayment')->name('user.account.subscriptions.transfer.add.payment')->withoutMiddleware('change.lang')->middleware('Demo');
  
  // Transfer Active flow (Transférer des rituels à un autre freelance actif)
  Route::get('/account/subscriptions/{subscription}/transfer/active/candidates', 'FrontEnd\UserController@getActiveTransferCandidates')->name('user.account.subscriptions.transfer.active.candidates');
  Route::post('/account/subscriptions/{subscription}/transfer/active/confirm', 'FrontEnd\UserController@confirmActiveTransfer')->name('user.account.subscriptions.transfer.active.confirm')->withoutMiddleware('change.lang')->middleware('Demo');
  
  // Settings - Renouvellement d'abonnement (modal)
  Route::get('/subscriptions/{id}/renew-quote', [\App\Http\Controllers\FrontEnd\SubscriptionRenewController::class, 'quote'])->name('user.subscriptions.renew-quote');
  Route::post('/subscriptions/{id}/renew', [\App\Http\Controllers\FrontEnd\SubscriptionRenewController::class, 'renew'])->name('user.subscriptions.renew');
  
  // Settings - Historique de paiement (nouvelle page)
  Route::get('/settings/billing-history', 'FrontEnd\UserController@billingHistory')->name('user.settings.billing_history');
  Route::get('/settings/billing-history/{invoice}/invoice', 'FrontEnd\UserController@downloadInvoice')->name('user.settings.billing_history.invoice');
  
  // Settings - Confirmation automatique (nouvelle page)
  Route::get('/settings/auto-confirmation', 'FrontEnd\UserController@editAutoConfirmation')->name('user.settings.auto_confirmation');
  Route::post('/settings/auto-confirmation', 'FrontEnd\UserController@updateAutoConfirmation')->name('user.settings.auto_confirmation.update')->withoutMiddleware('change.lang')->middleware('Demo');
  
  // Settings - Agenda & fuseau horaire (nouvelle page)
  Route::get('/settings/agenda', 'FrontEnd\UserController@editAgenda')->name('user.settings.agenda');
  Route::post('/settings/agenda', 'FrontEnd\UserController@updateAgenda')->name('user.settings.agenda.update')->withoutMiddleware('change.lang')->middleware('Demo');
  
  // Settings - Notifications (nouvelle page)
  Route::get('/settings/notifications', 'FrontEnd\UserController@editNotifications')->name('user.settings.notifications');
  Route::post('/settings/notifications', 'FrontEnd\UserController@updateNotifications')->name('user.settings.notifications.update')->withoutMiddleware('change.lang')->middleware('Demo');
  
  // Settings - Connexions & autorisations (nouvelle page)
  Route::get('/settings/connections', 'FrontEnd\UserController@editConnections')->name('user.settings.connections');
  Route::post('/settings/connections/disconnect', 'FrontEnd\UserController@disconnectProvider')->name('user.settings.connections.disconnect')->withoutMiddleware('change.lang')->middleware('Demo');
  
  // Settings - Supprimer le compte
  Route::get('/settings/delete-account', 'FrontEnd\UserController@confirmDeleteAccount')->name('user.settings.delete_account');
  Route::post('/settings/delete-account', 'FrontEnd\UserController@deleteAccount')->name('user.settings.delete_account.destroy')->withoutMiddleware('change.lang')->middleware('Demo');
  
  Route::get('/followings', 'FrontEnd\UserController@followings')->name('user.followings');

  // edit profile route
  Route::get('/edit-profile', 'FrontEnd\UserController@editProfile')->name('user.edit_profile');

  // update profile route
  Route::post('/update-profile', 'FrontEnd\UserController@updateProfile')->name('user.update_profile')->withoutMiddleware('change.lang')->middleware('Demo');

  Route::middleware('exists.password')->group(function () {
    // Ancienne route change-password : redirection vers la nouvelle page pour les clients
    Route::get('/change-password', 'FrontEnd\UserController@changePassword')->name('user.change_password');

    // update password route (ancienne méthode, conservée pour compatibilité)
    Route::post('/update-password', 'FrontEnd\UserController@updatePassword')->name('user.update_password')->withoutMiddleware('change.lang')->middleware('Demo');
  });

  // service orders route
  Route::get('/service-orders', 'FrontEnd\UserController@serviceOrders')->name('user.service_orders')->middleware('isServices');
  Route::get('service-orders/raise-request/{id}/{status}', 'FrontEnd\UserController@raise_request')->name('user.service_order.raise_request');

  Route::prefix('/service-order/{id}')->middleware(['has.access', 'isServices'])->group(function () {
    // service order details route
    Route::get('/details', 'FrontEnd\UserController@serviceOrderDetails')->name('user.service_order.details');

    // message of service order route
    Route::get('/message', 'FrontEnd\UserController@message')->name('user.service_order.message');

    Route::post('/store-message', 'FrontEnd\UserController@storeMessage')->name('user.service_order.store_message')->withoutMiddleware('has.access')->middleware('Demo');

    Route::post('/confirm-order', 'FrontEnd\UserController@confirm_order')->name('user.service_order.confirm_order')->withoutMiddleware('has.access')->middleware('Demo');
  });

  Route::middleware('isServices')->prefix('/service-wishlist')->group(function () {
    // service wishlist route
    Route::get('', 'FrontEnd\UserController@serviceWishlist')->name('user.service_wishlist');

    // remove service from wishlist route
    Route::post('/remove-service/{service_id}', 'FrontEnd\UserController@removeService')->name('user.service_wishlist.remove_service')->middleware('Demo');
  });

  // support tickets route
  Route::middleware('isSupportTicket', 'Demo')->prefix('/support-tickets')->group(function () {
    Route::get('', 'FrontEnd\UserController@tickets')->name('user.support_tickets');

    Route::get('/create-ticket', 'FrontEnd\UserController@createTicket')->name('user.support_tickets.create');

    Route::post('/store-temp-file', 'FrontEnd\UserController@storeTempFile')->name('user.support_tickets.store_temp_file');

    Route::post('/store-ticket', 'FrontEnd\UserController@storeTicket')->name('user.support_tickets.store');
  });

  Route::get('/support-ticket/{id}/conversation', 'FrontEnd\UserController@ticketConversation')->name('user.support_ticket.conversation')->middleware('isSupportTicket');

  Route::post('/support-ticket/{id}/reply', 'FrontEnd\UserController@ticketReply')->name('user.support_ticket.reply')->middleware('isSupportTicket')->middleware('Demo');

  // Junspro V2 - Dashboard client
  Route::get('/account/dashboard', [\App\Http\Controllers\FrontEnd\ClientDashboardController::class, 'index'])->name('client.dashboard.index');
  Route::get('/account/agenda', [\App\Http\Controllers\FrontEnd\ClientDashboardController::class, 'agenda'])->name('client.agenda.index');
  
  // Junspro V2 - Dashboards abonnements
  Route::prefix('/account/subscriptions')->group(function () {
    Route::get('/', [\App\Http\Controllers\FrontEnd\ClientSubscriptionController::class, 'index'])->name('client.subscriptions.index');
    Route::get('/first', [\App\Http\Controllers\FrontEnd\ClientSubscriptionController::class, 'firstSubscription'])->name('client.subscriptions.first');
    Route::get('/{id}', [\App\Http\Controllers\FrontEnd\ClientSubscriptionController::class, 'show'])->name('client.subscriptions.show');
    Route::get('/{id}/sessions', [\App\Http\Controllers\FrontEnd\ClientSubscriptionController::class, 'show'])->name('client.subscriptions.sessions');
    Route::post('/{id}/pause', [\App\Http\Controllers\FrontEnd\ClientSubscriptionController::class, 'pause'])->name('client.subscriptions.pause');
    Route::post('/{id}/resume', [\App\Http\Controllers\FrontEnd\ClientSubscriptionController::class, 'resume'])->name('client.subscriptions.resume');
    Route::get('/{id}/cancel', [\App\Http\Controllers\FrontEnd\ClientSubscriptionController::class, 'showCancelForm'])->name('client.subscriptions.cancel');
    Route::post('/{id}/cancel', [\App\Http\Controllers\FrontEnd\ClientSubscriptionController::class, 'cancel'])->name('client.subscriptions.cancel.submit');
  });

  // Junspro V2 - Messages client - TEST
  Route::get('/account/messages/test', function() {
    return 'Test route Messages fonctionne';
  })->name('client.messages.test');
  
  // Junspro V2 - Messages client
  Route::prefix('/account/messages')->group(function () {
    Route::get('/', [\App\Http\Controllers\FrontEnd\ClientMessagesController::class, 'index'])->name('client.messages.index');
    Route::post('/send', [\App\Http\Controllers\FrontEnd\ClientMessagesController::class, 'sendMessage'])->name('client.messages.send');
  });

  // Routes Stripe pour abonnements
  Route::get('/subscription/stripe/success', 'FrontEnd\FreelancerController@stripeSuccess')->name('subscription.stripe.success');
  Route::get('/subscription/stripe/cancel', 'FrontEnd\FreelancerController@stripeCancel')->name('subscription.stripe.cancel');

  // Rectifications de sessions de travail
  Route::post('/work-session/{id}/rectify', 'FrontEnd\WorkSessionController@requestRectification')
    ->name('client.work-session.rectify')
    ->middleware('auth:web');

  Route::prefix('/freelancer/subscriptions')->group(function () {
    Route::get('/', 'FrontEnd\FreelancerSubscriptionController@index')->name('freelancer.subscriptions.index');
    Route::get('/{id}', 'FrontEnd\FreelancerSubscriptionController@show')->name('freelancer.subscriptions.show');
    Route::post('/{id}/work-session', 'FrontEnd\FreelancerSubscriptionController@storeWorkSession')->name('freelancer.subscriptions.work-session');
  });

  // user logout attempt route
  Route::get('/logout', 'FrontEnd\UserController@logoutSubmit')->name('user.logout')->withoutMiddleware('change.lang');
});

// service unavailable route
Route::get('/service-unavailable', 'FrontEnd\MiscellaneousController@serviceUnavailable')->name('service_unavailable')->middleware('exists.down');


/*
|--------------------------------------------------------------------------
| Admin Panel Routes
|--------------------------------------------------------------------------
*/
Route::prefix('/admin')->middleware('guest:admin')->group(function () {
  // admin redirect to login page route
  Route::get('/', 'BackEnd\AdminController@login')->name('admin.login');

  // admin login attempt route
  Route::post('/auth', 'BackEnd\AdminController@authentication')->name('admin.auth');

  // admin forget password route
  Route::get('/forget-password', 'BackEnd\AdminController@forgetPassword')->name('admin.forget_password');

  // send mail to admin for forget password route
  Route::post('/mail-for-forget-password', 'BackEnd\AdminController@forgetPasswordMail')->name('admin.mail_for_forget_password');
});



/*
|--------------------------------------------------------------------------
| Pages légales statiques (avec sommaire)
|--------------------------------------------------------------------------
*/
Route::get('/mentions-legales', function () {
  return view('frontend.mentions-legales');
})->name('mentions_legales')->middleware('change.lang');

Route::get('/termes-et-conditions', function () {
  return view('frontend.terms-conditions');
})->name('termes_conditions')->middleware('change.lang');

Route::get('/politique-de-confidentialite', function () {
  return view('frontend.privacy-policy');
})->name('politique_confidentialite')->middleware('change.lang');

Route::get('/conditions-generales-de-vente', function () {
  return view('frontend.sales-terms');
})->name('conditions_generales_vente')->middleware('change.lang');

Route::get('/comment-on-estime-les-tarifs', [\App\Http\Controllers\FrontEnd\MiscellaneousController::class, 'commentOnEstimeLesTarifs'])
  ->name('comment_on_estime_les_tarifs')->middleware('change.lang');

/*
|--------------------------------------------------------------------------
| Custom Page Route For UI
|--------------------------------------------------------------------------
*/
Route::get('/{slug}', 'FrontEnd\PageController@page')->name('dynamic_page')->middleware('change.lang');

// // fallback route
// Route::fallback(function () {
//   //
// })->middleware('change.lang');
