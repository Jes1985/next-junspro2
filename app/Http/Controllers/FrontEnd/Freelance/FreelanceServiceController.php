<?php

namespace App\Http\Controllers\FrontEnd\Freelance;

use App\Http\Controllers\Controller;
use App\Http\Helpers\UploadFile;
use App\Models\ClientService\Service;
use App\Models\ClientService\ServiceContent;
use App\Models\FreelancerProfile;
use App\Models\Language;
use App\Models\Seller;
use App\Models\SellerInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Mews\Purifier\Facades\Purifier;

class FreelanceServiceController extends Controller
{
    /**
     * Show the form for creating a new service.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        try {
        $user = Auth::guard('web')->user();
        
        if (!$user) {
            return redirect()->route('user.login')
                ->with('error', __('Vous devez être connecté pour accéder à cette page.'));
        }
        
        $freelancerProfile = FreelancerProfile::where('user_id', $user->id)->first();
        
        if (!$freelancerProfile) {
            return redirect()->route('freelance.onboarding.step1')
                ->with('error', __('Vous devez compléter votre profil freelance pour créer un service.'));
        }

            // Charger les langues et catégories pour le formulaire
            $languages = Language::all();
            
            if ($languages->isEmpty()) {
                return redirect()->route('freelance.dashboard', ['tab' => 'services'])
                    ->with('error', __('Aucune langue disponible dans la base de données.'));
            }

            // Charger les catégories pour chaque langue
            $languages->map(function ($language) {
                try {
                    $language['categories'] = $language->serviceCategory()->where('status', 1)->orderByDesc('id')->get();
                } catch (\Exception $e) {
                    Log::warning('FreelanceServiceController@create: Error loading categories for language ' . $language->id . ' - ' . $e->getMessage());
                    $language['categories'] = collect();
                }
            });
            
            return view('frontend.freelance.services.create', [
                'languages' => $languages
            ]);
        } catch (\Exception $e) {
            Log::error('FreelanceServiceController@create: Error - ' . $e->getMessage());
            Log::error('FreelanceServiceController@create: Stack trace - ' . $e->getTraceAsString());
            return redirect()->route('freelance.dashboard', ['tab' => 'services'])
                ->with('error', __('Erreur lors du chargement de la page de création de service. Veuillez réessayer.'));
        }
    }

    /**
     * Store a newly created service.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $user = Auth::guard('web')->user();
            
            if (!$user) {
                return redirect()->route('user.login')
                    ->with('error', __('Vous devez être connecté pour créer un service.'));
            }
            
            $freelancerProfile = FreelancerProfile::where('user_id', $user->id)->first();
            
            if (!$freelancerProfile) {
                return redirect()->route('freelance.onboarding.step1')
                    ->with('error', __('Vous devez compléter votre profil freelance pour créer un service.'));
            }

            // Validation basique
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string|min:30',
                'category_id' => 'required|exists:service_categories,id',
                'price' => 'required|numeric|min:0',
                'thumbnail_image' => 'required|image|max:2048',
            ], [
                'title.required' => __('Le titre est obligatoire.'),
                'description.required' => __('La description est obligatoire.'),
                'description.min' => __('La description doit contenir au moins 30 caractères.'),
                'category_id.required' => __('La catégorie est obligatoire.'),
                'category_id.exists' => __('La catégorie sélectionnée est invalide.'),
                'price.required' => __('Le prix est obligatoire.'),
                'price.numeric' => __('Le prix doit être un nombre.'),
                'price.min' => __('Le prix doit être supérieur ou égal à 0.'),
                'thumbnail_image.required' => __('L\'image miniature est obligatoire.'),
                'thumbnail_image.image' => __('Le fichier doit être une image.'),
                'thumbnail_image.max' => __('L\'image ne doit pas dépasser 2 Mo.'),
            ]);

            // Créer ou récupérer le compte seller pour l'utilisateur
            $seller = Seller::where('email', $user->email_address)->first();
            
            if (!$seller) {
                // Générer un username unique
                $baseUsername = $user->username ?? str_replace(['@', '.'], ['_', '_'], explode('@', $user->email_address)[0]);
                $username = $baseUsername;
                $counter = 1;
                
                while (Seller::where('username', $username)->exists()) {
                    $username = $baseUsername . $counter;
                    $counter++;
                }
                
                $tempPassword = Hash::make(Str::random(16));
                
                $seller = Seller::create([
                    'username' => $username,
                    'email' => $user->email_address,
                    'recipient_mail' => $user->email_address,
                    'password' => $tempPassword,
                    'status' => 1,
                    'email_verified_at' => $user->email_verified_at ?: now(),
                    'phone' => $user->phone ?? null,
                ]);
                
                $seller->refresh();
                
                // Créer les SellerInfo pour chaque langue
                $languages = Language::all();
                foreach ($languages as $language) {
                    try {
                        SellerInfo::create([
                            'seller_id' => $seller->id,
                            'language_id' => $language->id,
                            'name' => ($user->first_name ?? '') . ' ' . ($user->last_name ?? '') ?: $user->username,
                        ]);
                    } catch (\Exception $e) {
                        Log::warning('FreelanceServiceController@store: Error creating SellerInfo - ' . $e->getMessage());
                    }
                }
            }

            // Uploader l'image miniature
            $thumbnailImage = UploadFile::store('./assets/img/services/thumbnail-images/', $request->file('thumbnail_image'));

            // Récupérer la langue par défaut pour créer le service
            $defaultLanguage = Language::where('is_default', 1)->first() ?? Language::first();
            
            // Récupérer le form_id par défaut (premier form disponible pour cette langue)
            $formId = null;
            try {
                $form = $defaultLanguage->form()->where('seller_id', $seller->id)->first();
                if (!$form) {
                    $form = $defaultLanguage->form()->where('seller_id', null)->first();
                }
                $formId = $form ? $form->id : null;
            } catch (\Exception $e) {
                Log::warning('FreelanceServiceController@store: Error loading form - ' . $e->getMessage());
            }

            // Créer le service
            $service = Service::create([
                'seller_id' => $seller->id,
                'thumbnail_image' => $thumbnailImage,
                'slider_images' => json_encode([]),
                'video_preview_link' => null,
                'live_demo_link' => null,
                'quote_btn_status' => 1,
                'service_status' => 1,
                'is_featured' => 'no',
                'average_rating' => 0,
                'package_lowest_price' => $request->price,
            ]);

            // Créer les ServiceContent pour toutes les langues
            $languages = Language::all();
            foreach ($languages as $language) {
                try {
                    // Pour la langue par défaut, utiliser les données du formulaire
                    // Pour les autres langues, utiliser les mêmes données ou laisser vide
                    $title = ($language->id == $defaultLanguage->id) ? $request->title : $request->title;
                    $description = ($language->id == $defaultLanguage->id) ? $request->description : $request->description;
                    $categoryId = ($language->id == $defaultLanguage->id) ? $request->category_id : null;
                    
                    // Si pas de catégorie pour cette langue, utiliser la première catégorie disponible
                    if (!$categoryId) {
                        $firstCategory = $language->serviceCategory()->where('status', 1)->first();
                        $categoryId = $firstCategory ? $firstCategory->id : $request->category_id;
                    }
                    
                    // Récupérer le form_id pour cette langue
                    $langFormId = $formId;
                    try {
                        $langForm = $language->form()->where('seller_id', $seller->id)->first();
                        if (!$langForm) {
                            $langForm = $language->form()->where('seller_id', null)->first();
                        }
                        $langFormId = $langForm ? $langForm->id : $formId;
                    } catch (\Exception $e) {
                        // Utiliser le form_id par défaut
                    }

                    // Sanitization stricte de la description HTML
                    // Whitelist: p, h2, h3, ul, ol, li, strong, em, u, a, blockquote, hr, br
                    $cleanDescription = $this->sanitizeDescriptionHTML($description);

                    ServiceContent::create([
                        'language_id' => $language->id,
                        'service_category_id' => $categoryId,
                        'service_subcategory_id' => null,
                        'service_id' => $service->id,
                        'form_id' => $langFormId,
                        'title' => $title,
                        'slug' => createSlug($title),
                        'description' => $cleanDescription,
                        'tags' => null,
                        'skills' => json_encode([]),
                        'meta_keywords' => null,
                        'meta_description' => null,
                    ]);
                } catch (\Exception $e) {
                    Log::error('FreelanceServiceController@store: Error creating ServiceContent for language ' . $language->id . ' - ' . $e->getMessage());
                    // Continuer avec les autres langues même si une échoue
                }
            }

            return redirect()->route('freelance.dashboard', ['tab' => 'services'])
                ->with('success', __('Service créé avec succès !'));
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->route('freelance.services.create')
                ->withErrors($e->errors())
                ->withInput();
        } catch (\Exception $e) {
            Log::error('FreelanceServiceController@store: Error - ' . $e->getMessage());
            Log::error('FreelanceServiceController@store: Stack trace - ' . $e->getTraceAsString());
            return redirect()->route('freelance.services.create')
                ->with('error', __('Erreur lors de la création du service. Veuillez réessayer.') . ' ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Sanitize description HTML avec whitelist stricte
     * Tags autorisés: p, h2, h3, ul, ol, li, strong, em, u, a, blockquote, hr, br
     * Attributs autorisés: href, title sur <a>
     *
     * @param string $html
     * @return string
     */
    private function sanitizeDescriptionHTML($html)
    {
        // Utiliser Purifier avec configuration stricte (déjà utilisé dans le projet)
        // Purifier::clean() avec 'youtube' permet les tags de base mais on peut être plus strict
        $cleaned = Purifier::clean($html, 'youtube');
        
        // Nettoyage supplémentaire : supprimer les attributs non autorisés et les tags non whitelistés
        // Whitelist stricte
        $allowedTags = '<p><h2><h3><ul><ol><li><strong><em><u><a><blockquote><hr><br>';
        $cleaned = strip_tags($cleaned, $allowedTags);
        
        // Nettoyer les attributs des liens (garder seulement href et title)
        $cleaned = preg_replace_callback('/<a\s+([^>]*)>/i', function($matches) {
            $attrs = $matches[1];
            $href = '';
            $title = '';
            
            if (preg_match('/href=["\']([^"\']*)["\']/i', $attrs, $hrefMatch)) {
                $href = 'href="' . htmlspecialchars($hrefMatch[1], ENT_QUOTES) . '"';
            }
            if (preg_match('/title=["\']([^"\']*)["\']/i', $attrs, $titleMatch)) {
                $title = 'title="' . htmlspecialchars($titleMatch[1], ENT_QUOTES) . '"';
            }
            
            $finalAttrs = trim($href . ' ' . $title);
            return '<a ' . $finalAttrs . '>';
        }, $cleaned);
        
        return $cleaned;
    }

}

