<?php

namespace Database\Seeders;

use App\Models\Blog\Post;
use App\Models\Blog\PostInformation;
use App\Models\Blog\BlogCategory;
use App\Models\Language;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BlogPostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Récupérer la langue par défaut (français)
        $language = Language::where('code', 'fr')->first() 
            ?? Language::where('is_default', 1)->first();
        
        if (!$language) {
            $this->command->warn('Aucune langue trouvée. Création de l\'article annulée.');
            return;
        }

        // Récupérer ou créer la catégorie "Platform" / "Plateforme"
        $category = BlogCategory::where('language_id', $language->id)
            ->where(function($q) {
                $q->where('name', 'like', '%plateforme%')
                  ->orWhere('name', 'like', '%platform%')
                  ->orWhere('slug', 'like', '%platform%');
            })
            ->first();

        if (!$category) {
            // Créer une catégorie par défaut si elle n'existe pas
            $category = BlogCategory::create([
                'language_id' => $language->id,
                'name' => 'Plateforme',
                'slug' => 'plateforme',
                'status' => 1,
                'serial_number' => 1,
            ]);
        }

        // Slug de l'article
        $slug = 'bienvenue-sur-junspro-deposer-une-mission-rituel-dessai';
        
        // Contenu de l'article (remplacer "Bien-être en entreprise" par "Pause Souffle")
        $content = '<h2>Bienvenue sur Junspro</h2>
<p>Junspro est votre plateforme de mise en relation avec des freelances sélectionnés dans 6 univers spécialisés : Projets & Consulting, Cours, Services à domicile, WellnessLive, Pause Souffle, Échanges de logement.</p>

<h3>Déposer une mission</h3>
<p>Pour déposer une mission, rendez-vous sur la page de dépôt et décrivez votre besoin. Notre système vous orientera automatiquement vers le bon univers et les profils adaptés.</p>

<h3>Choisir un univers</h3>
<p>Nos 6 univers couvrent tous vos besoins :</p>
<ul>
<li><strong>Projets & Consulting</strong> : Marketing, développement, design, conseil</li>
<li><strong>Cours</strong> : Cours particuliers, formations, tutorat</li>
<li><strong>Services à domicile</strong> : Ménage, garde d\'enfants, aide à domicile</li>
<li><strong>WellnessLive</strong> : Bien-être, santé, activités sportives</li>
<li><strong>Pause Souffle</strong> : Cohésion d\'équipe, séminaires, bien-être en entreprise</li>
<li><strong>Échanges de logement</strong> : Échanges temporaires de logements</li>
</ul>

<h3>Rituel d\'essai</h3>
<p>Avant de vous engager, profitez de notre rituel d\'essai pour tester un service et découvrir la qualité de nos freelances.</p>

<p>Bêta privée — qualité > quantité. Vos premières missions sont traitées en priorité.</p>';

        // Chercher un post existant avec le slug ou le titre "Test"
        $postInfo = PostInformation::where('slug', $slug)
            ->orWhere('title', 'like', '%Test%')
            ->first();

        if ($postInfo) {
            // Mettre à jour le post existant
            $post = Post::find($postInfo->post_id);
            
            $postInfo->update([
                'title' => 'Bienvenue sur Junspro : déposer une mission, choisir un univers, avancer avec un rituel d\'essai',
                'slug' => $slug,
                'author' => 'Équipe Junspro',
                'content' => $content,
                'meta_keywords' => 'Junspro, freelance, mission, rituel d\'essai, plateforme',
                'meta_description' => 'Découvrez Junspro : déposez une mission, choisissez un univers et profitez d\'un rituel d\'essai pour tester nos services.',
                'blog_category_id' => $category->id,
                'language_id' => $language->id,
            ]);

            if ($post) {
                $post->update([
                    'image' => 'images/blog/junspro-welcome.jpg',
                ]);
            }
        } else {
            // Créer un nouveau post
            $maxSerial = Post::max('serial_number') ?? 0;
            
            $post = Post::create([
                'image' => 'images/blog/junspro-welcome.jpg',
                'serial_number' => $maxSerial + 1,
            ]);

            PostInformation::create([
                'post_id' => $post->id,
                'language_id' => $language->id,
                'blog_category_id' => $category->id,
                'title' => 'Bienvenue sur Junspro : déposer une mission, choisir un univers, avancer avec un rituel d\'essai',
                'slug' => $slug,
                'author' => 'Équipe Junspro',
                'content' => $content,
                'meta_keywords' => 'Junspro, freelance, mission, rituel d\'essai, plateforme',
                'meta_description' => 'Découvrez Junspro : déposez une mission, choisissez un univers et profitez d\'un rituel d\'essai pour tester nos services.',
            ]);
        }

        $this->command->info('Article "Bienvenue sur Junspro" créé/mis à jour avec succès (slug: ' . $slug . ')');
    }
}
