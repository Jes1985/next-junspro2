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
            ->whereNotNull('hourly_rate');

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

        // Premium / Super Freelance
        if ($request->boolean('is_premium')) {
            $query->where('is_verified', true);
        }

        // Tri
        $sort = $request->get('sort', 'best_match');
        switch ($sort) {
            case 'lowest_price':
                $query->orderBy('hourly_rate', 'asc');
                break;
            case 'highest_price':
                $query->orderBy('hourly_rate', 'desc');
                break;
            default:
                $query->orderByDesc('reliability_score');
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
                'sort' => $sort,
                'search' => $request->get('search'),
            ],
            'allLanguages' => $allLanguages,
            'timezones' => $timezones,
        ]);
    }
}



