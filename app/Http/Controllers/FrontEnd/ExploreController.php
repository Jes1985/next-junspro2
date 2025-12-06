<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\FreelancerProfile;
use App\Models\Language;
use App\Models\Timezone;
use Illuminate\Http\Request;

class ExploreController extends Controller
{
    public function index(Request $request)
    {
        $query = FreelancerProfile::query()
            ->with('user')
            ->whereNotNull('hourly_rate')
            ->whereBetween('hourly_rate', [10, 299]); // Validation stricte 10-299 €/h

        // Recherche textuelle (nom, bio, skills)
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->whereHas('user', function ($userQuery) use ($search) {
                    $userQuery->where('name', 'like', "%{$search}%");
                })
                ->orWhere('bio', 'like', "%{$search}%")
                ->orWhereJsonContains('skills', $search);
            });
        }

        // Filtres prix (10–299 €/h)
        $min = max((int) $request->get('price_min', 10), 10);
        $max = min((int) $request->get('price_max', 299), 299);
        $query->whereBetween('hourly_rate', [$min, $max]);

        // Langues (JSON sur FreelancerProfile)
        if ($request->filled('languages')) {
            $languages = (array) $request->get('languages');
            $query->where(function ($q) use ($languages) {
                foreach ($languages as $code) {
                    $q->orWhereJsonContains('languages', ['code' => $code]);
                }
            });
        }

        // Pays (stocké sur l'utilisateur via country_code)
        if ($request->filled('country')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('country_code', $request->get('country'));
            });
        }

        // Premium / Super Freelance (amélioré)
        if ($request->boolean('is_premium')) {
            $query->whereHas('user', function ($q) {
                $q->where('is_super_freelancer', true)
                  ->orWhere('is_verified_freelancer', true);
            });
        }

        // Filtre par catégorie (via skills ou recherche)
        if ($request->filled('category')) {
            $category = $request->get('category');
            $query->where(function ($q) use ($category) {
                $q->whereJsonContains('skills', $category)
                  ->orWhere('bio', 'like', "%{$category}%");
            });
        }

        // Tri amélioré
        $sort = $request->get('sort', 'best_match');
        switch ($sort) {
            case 'lowest_price':
                $query->orderBy('hourly_rate', 'asc')
                      ->orderByDesc('reliability_score');
                break;
            case 'highest_price':
                $query->orderBy('hourly_rate', 'desc')
                      ->orderByDesc('reliability_score');
                break;
            case 'best_rating':
                // TODO: Ajouter calcul de rating moyen depuis reviews
                $query->orderByDesc('reliability_score')
                      ->orderBy('hourly_rate', 'asc');
                break;
            default: // best_match
                $query->orderByDesc('reliability_score')
                      ->orderByRaw('CASE WHEN EXISTS (SELECT 1 FROM users WHERE users.id = freelancer_profiles.user_id AND users.is_super_freelancer = 1) THEN 0 ELSE 1 END')
                      ->orderBy('hourly_rate', 'asc');
                break;
        }

        $freelancers = $query->paginate(12)->appends($request->query());

        $allLanguages = Language::query()->orderBy('name')->get();
        $timezones = Timezone::query()->orderBy('timezone')->get();

        return view('frontend.explore.index', [
            'freelancers' => $freelancers,
            'filters' => [
                'price_min' => $min,
                'price_max' => $max,
                'languages' => (array) $request->get('languages', []),
                'country' => $request->get('country'),
                'category' => $request->get('category'),
                'sort' => $sort,
                'search' => $request->get('search'),
                'is_premium' => $request->boolean('is_premium'),
            ],
            'allLanguages' => $allLanguages,
            'timezones' => $timezones,
        ]);
    }
}




