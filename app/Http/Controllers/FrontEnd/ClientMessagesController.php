<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\ChatMessage;
use App\Models\FreelancerProfile;
use App\Models\LeadConversation;
use App\Models\Subscription;
use App\Services\Junspro\ContactGuardService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientMessagesController extends Controller
{
    /**
     * Page principale Messages - Liste des conversations
     * 
     * ÉTAPE 4.3 — UN SEUL FIL PAR PAIRE (client, freelancer) :
     * - Sidebar : une seule entrée par paire (subscription priorisée si elle existe)
     * - Thread : messages lead + subscription fusionnés, triés par date
     * - Garde-fous appliqués PAR MESSAGE (pas globalement)
     */
    public function index(Request $request)
    {
        $user = Auth::guard('web')->user();
        
        if (!$user) {
            return redirect()->route('user.login');
        }
        
        $clientProfile = $user->clientProfile;
        
        if (!$clientProfile) {
            return redirect()->route('user.dashboard')
                ->with('error', __('Vous devez avoir un profil client pour accéder à cette page.'));
        }

        $tab = $request->get('tab', 'all');

        // ========================================
        // ÉTAPE 4.3 : Construction des conversations PAR PAIRE (freelancer_id)
        // Une seule entrée par freelancer, fusionnant lead + subscription
        // ========================================
        
        // Récupérer toutes les subscriptions du client
        try {
            $subscriptions = Subscription::where('client_id', $clientProfile->id)
                ->with(['freelancer.user'])
                ->get()
                ->keyBy('freelancer_id'); // Index par freelancer_id
        } catch (\Exception $e) {
            $subscriptions = collect([]);
        }
        
        // Récupérer toutes les lead conversations du client
        try {
            $leadConversations = LeadConversation::where('client_id', $clientProfile->id)
                ->with(['freelancer.user'])
                ->get()
                ->keyBy('freelancer_id'); // Index par freelancer_id
        } catch (\Exception $e) {
            $leadConversations = collect([]);
        }

        // Collecter tous les freelancer_ids uniques (union des deux)
        $allFreelancerIds = $subscriptions->keys()->merge($leadConversations->keys())->unique();

        $conversations = [];

        foreach ($allFreelancerIds as $freelancerId) {
            try {
                $subscription = $subscriptions->get($freelancerId);
                $leadConv = $leadConversations->get($freelancerId);
                
                // Déterminer le freelancer profile et user
                $freelancerProfile = null;
                $freelancerUser = null;
                
                if ($subscription && $subscription->freelancer && $subscription->freelancer->user) {
                    $freelancerProfile = $subscription->freelancer;
                    $freelancerUser = $subscription->freelancer->user;
                } elseif ($leadConv && $leadConv->freelancer && $leadConv->freelancer->user) {
                    $freelancerProfile = $leadConv->freelancer;
                    $freelancerUser = $leadConv->freelancer->user;
                } else {
                    continue; // Pas de freelancer valide
                }

                // Calculer le dernier message (tous messages de la paire)
                $lastMessage = $this->getLastMessageForPair($subscription, $leadConv);
                
                // Calculer le nombre de non-lus (tous messages de la paire)
                $unreadCount = $this->getUnreadCountForPair($subscription, $leadConv, $user->id);

                // Filtre onglet "unread"
                if ($tab === 'unread' && $unreadCount === 0) {
                    continue;
                }
                
                // Déterminer le type principal (subscription prioritaire)
                $type = $subscription ? 'subscription' : 'lead';
                
                // Afficher si : subscription active OU au moins un message existe
                if ($lastMessage || ($subscription && $subscription->status === 'active')) {
                    $conversations[] = [
                        'type' => $type,
                        'subscription' => $subscription,
                        'leadConversation' => $leadConv,
                        'freelancer' => $freelancerUser,
                        'freelancerProfile' => $freelancerProfile,
                        'lastMessage' => $lastMessage,
                        'unreadCount' => $unreadCount,
                    ];
                }
            } catch (\Exception $e) {
                continue;
            }
        }
        
        // Trier toutes les conversations par date du dernier message
        usort($conversations, function($a, $b) {
            if (!$a['lastMessage'] && !$b['lastMessage']) {
                return 0;
            }
            if (!$a['lastMessage']) {
                return 1;
            }
            if (!$b['lastMessage']) {
                return -1;
            }
            return strtotime($b['lastMessage']->created_at) - strtotime($a['lastMessage']->created_at);
        });

        // ========================================
        // Redirection automatique vers la première conversation si aucune n'est sélectionnée
        // ========================================
        if (!$request->has('conversation') && !$request->has('lead') && !empty($conversations)) {
            $first = $conversations[0];
            if ($first['subscription']) {
                return redirect()->route('user.messages.index', ['conversation' => $first['subscription']->id, 'tab' => $tab]);
            } elseif ($first['leadConversation']) {
                return redirect()->route('user.messages.index', ['lead' => $first['leadConversation']->id, 'tab' => $tab]);
            }
        }

        // ========================================
        // Conversation sélectionnée (subscription OU lead)
        // ========================================
        $selectedSubscriptionId = $request->get('conversation');
        $selectedLeadId = $request->get('lead');
        $selectedConversation = null;
        $messages = collect([]);
        
        // SÉCURITÉ + FUSION : Contrôle d'accès et chargement des messages fusionnés
        if ($selectedSubscriptionId) {
            // Vérifier que la subscription appartient bien à ce client
            $selectedSubscription = Subscription::where('id', $selectedSubscriptionId)->first();
            
            if (!$selectedSubscription) {
                abort(404, __('Conversation introuvable.'));
            }
            
            if ($selectedSubscription->client_id !== $clientProfile->id) {
                abort(403, __('Accès non autorisé à cette conversation.'));
            }
            
            $selectedSubscription->load(['freelancer.user', 'freelancer']);
            
            if ($selectedSubscription->freelancer && $selectedSubscription->freelancer->user) {
                // Trouver la lead conversation associée (même paire)
                $associatedLead = $leadConversations->get($selectedSubscription->freelancer_id);
                
                // Chercher dans la liste des conversations
                foreach ($conversations as $conv) {
                    if ($conv['subscription'] && $conv['subscription']->id == $selectedSubscriptionId) {
                        $selectedConversation = $conv;
                        break;
                    }
                }
                
                if (!$selectedConversation) {
                    $selectedConversation = [
                        'type' => 'subscription',
                        'subscription' => $selectedSubscription,
                        'leadConversation' => $associatedLead,
                        'freelancer' => $selectedSubscription->freelancer->user,
                        'freelancerProfile' => $selectedSubscription->freelancer,
                        'lastMessage' => null,
                        'unreadCount' => 0,
                    ];
                }
                
                // ÉTAPE 4.3 : Charger les messages FUSIONNÉS (lead + subscription), triés par date
                $messages = $this->getMergedMessagesForPair($selectedSubscription, $associatedLead);
                
                // Marquer comme lus (les deux sources)
                $this->markMessagesAsRead($selectedSubscription, $associatedLead, $user->id);
            }
        }
        elseif ($selectedLeadId) {
            // Vérifier que la lead conversation appartient bien à ce client
            $selectedLead = LeadConversation::where('id', $selectedLeadId)->first();
            
            if (!$selectedLead) {
                abort(404, __('Conversation introuvable.'));
            }
            
            if ($selectedLead->client_id !== $clientProfile->id) {
                abort(403, __('Accès non autorisé à cette conversation.'));
            }
            
            $selectedLead->load(['freelancer.user', 'freelancer']);

            if ($selectedLead->freelancer && $selectedLead->freelancer->user) {
                // Trouver la subscription associée (même paire)
                $associatedSubscription = $subscriptions->get($selectedLead->freelancer_id);
                
                // Si une subscription existe, rediriger vers elle (URL canonique)
                if ($associatedSubscription) {
                    return redirect()->route('user.messages.index', [
                        'conversation' => $associatedSubscription->id,
                        'tab' => $tab
                    ]);
                }
                
                // Chercher dans la liste des conversations
                foreach ($conversations as $conv) {
                    if ($conv['leadConversation'] && $conv['leadConversation']->id == $selectedLeadId) {
                        $selectedConversation = $conv;
                        break;
                    }
                }

                if (!$selectedConversation) {
                    $selectedConversation = [
                        'type' => 'lead',
                        'subscription' => null,
                        'leadConversation' => $selectedLead,
                        'freelancer' => $selectedLead->freelancer->user,
                        'freelancerProfile' => $selectedLead->freelancer,
                        'lastMessage' => null,
                        'unreadCount' => 0,
                    ];
                }

                // ÉTAPE 4.3 : Charger les messages (lead uniquement dans ce cas)
                $messages = $this->getMergedMessagesForPair(null, $selectedLead);
                
                // Marquer comme lus
                $this->markMessagesAsRead(null, $selectedLead, $user->id);
            }
        }

        return view('frontend.client.messages.index', [
            'conversations' => $conversations,
            'selectedConversation' => $selectedConversation,
            'messages' => $messages,
            'currentTab' => $tab,
        ]);
    }

    /**
     * Récupère le dernier message pour une paire (subscription + lead combinés).
     */
    private function getLastMessageForPair(?Subscription $subscription, ?LeadConversation $lead): ?ChatMessage
    {
        $query = ChatMessage::query();
        $conditions = [];

        if ($subscription) {
            $conditions[] = ['subscription_id', '=', $subscription->id];
        }
        if ($lead) {
            $conditions[] = ['lead_conversation_id', '=', $lead->id];
        }

        if (empty($conditions)) {
            return null;
        }

        return $query->where(function($q) use ($conditions) {
            foreach ($conditions as $i => $cond) {
                if ($i === 0) {
                    $q->where($cond[0], $cond[1], $cond[2]);
                } else {
                    $q->orWhere($cond[0], $cond[1], $cond[2]);
                }
            }
        })
        ->orderBy('created_at', 'desc')
        ->first();
    }

    /**
     * Compte les messages non lus pour une paire (subscription + lead combinés).
     */
    private function getUnreadCountForPair(?Subscription $subscription, ?LeadConversation $lead, int $userId): int
    {
        $count = 0;

        if ($subscription) {
            $count += ChatMessage::where('subscription_id', $subscription->id)
                ->where('receiver_id', $userId)
                ->where('is_read', false)
                ->count();
        }

        if ($lead) {
            $count += ChatMessage::where('lead_conversation_id', $lead->id)
                ->where('receiver_id', $userId)
                ->where('is_read', false)
                ->count();
        }

        return $count;
    }

    /**
     * Récupère les messages fusionnés pour une paire, triés par date.
     */
    private function getMergedMessagesForPair(?Subscription $subscription, ?LeadConversation $lead)
    {
        $query = ChatMessage::query();
        $conditions = [];

        if ($subscription) {
            $conditions[] = ['subscription_id', '=', $subscription->id];
        }
        if ($lead) {
            $conditions[] = ['lead_conversation_id', '=', $lead->id];
        }

        if (empty($conditions)) {
            return collect([]);
        }

        return $query->where(function($q) use ($conditions) {
            foreach ($conditions as $i => $cond) {
                if ($i === 0) {
                    $q->where($cond[0], $cond[1], $cond[2]);
                } else {
                    $q->orWhere($cond[0], $cond[1], $cond[2]);
                }
            }
        })
        ->with(['sender', 'receiver'])
        ->orderBy('created_at', 'asc')
        ->get();
    }

    /**
     * Marque les messages comme lus pour une paire.
     */
    private function markMessagesAsRead(?Subscription $subscription, ?LeadConversation $lead, int $userId): void
    {
        if ($subscription) {
            ChatMessage::where('subscription_id', $subscription->id)
                ->where('receiver_id', $userId)
                ->where('is_read', false)
                ->update(['is_read' => true]);
        }

        if ($lead) {
            ChatMessage::where('lead_conversation_id', $lead->id)
                ->where('receiver_id', $userId)
                ->where('is_read', false)
                ->update(['is_read' => true]);
        }
    }

    /**
     * Envoyer un message (Subscription OU Lead conversation).
     * 
     * RÈGLES DE VALIDATION :
     * - Un seul identifiant de conversation autorisé par requête (subscription_id XOR lead_conversation_id XOR freelancer_id)
     * - L'identifiant fourni doit correspondre à une ressource appartenant au client connecté
     * - Erreurs claires et cohérentes : 400 (bad request), 403 (forbidden), 404 (not found)
     */
    public function sendMessage(Request $request)
    {
        $user = Auth::guard('web')->user();
        
        if (!$user) {
            return response()->json(['error' => 'Unauthorized', 'code' => 'AUTH_REQUIRED'], 401);
        }
        
        $clientProfile = $user->clientProfile;
        
        if (!$clientProfile) {
            return response()->json(['error' => 'Client profile required', 'code' => 'NO_CLIENT_PROFILE'], 403);
        }

        $request->validate([
            'message' => 'required|string|max:5000',
            'subscription_id' => 'nullable|integer',
            'lead_conversation_id' => 'nullable|integer',
            'freelancer_id' => 'nullable|integer',
        ]);

        // SÉCURITÉ : Interdire les cas ambigus (plusieurs identifiants fournis)
        $identifiersProvided = array_filter([
            $request->filled('subscription_id'),
            $request->filled('lead_conversation_id'),
            $request->filled('freelancer_id'),
        ]);
        
        if (count($identifiersProvided) === 0) {
            return response()->json([
                'error' => 'Missing conversation identifier. Provide exactly one of: subscription_id, lead_conversation_id, or freelancer_id.',
                'code' => 'MISSING_IDENTIFIER'
            ], 400);
        }
        
        if (count($identifiersProvided) > 1) {
            return response()->json([
                'error' => 'Ambiguous request. Provide exactly one of: subscription_id, lead_conversation_id, or freelancer_id.',
                'code' => 'AMBIGUOUS_IDENTIFIERS'
            ], 400);
        }

        $messageToSave = $request->message;
        $freelancerUserId = null;
        $subscriptionId = null;
        $leadConversationId = null;

        // CAS 1 : Envoi via Subscription existante
        if ($request->filled('subscription_id')) {
            // Vérifier existence
            $subscription = Subscription::with('freelancer.user')->find($request->subscription_id);
            
            if (!$subscription) {
                return response()->json([
                    'error' => 'Subscription not found.',
                    'code' => 'SUBSCRIPTION_NOT_FOUND'
                ], 404);
            }
            
            // SÉCURITÉ : Vérifier appartenance au client
            if ($subscription->client_id !== $clientProfile->id) {
                return response()->json([
                    'error' => 'Access denied to this subscription.',
                    'code' => 'SUBSCRIPTION_ACCESS_DENIED'
                ], 403);
            }

            if (!$subscription->freelancer || !$subscription->freelancer->user) {
                return response()->json([
                    'error' => 'Freelancer profile incomplete.',
                    'code' => 'FREELANCER_INCOMPLETE'
                ], 404);
            }

            $freelancerUserId = $subscription->freelancer->user_id;
            $subscriptionId = $subscription->id;

            // Anti-désintermédiation : filtrer si subscription non active
            if ($subscription->status !== 'active') {
                $messageToSave = ContactGuardService::filterContactCoordinates($request->message);
            }
        }
        // CAS 2 : Envoi via LeadConversation existante
        elseif ($request->filled('lead_conversation_id')) {
            // Vérifier existence
            $leadConv = LeadConversation::with('freelancer.user')->find($request->lead_conversation_id);
            
            if (!$leadConv) {
                return response()->json([
                    'error' => 'Lead conversation not found.',
                    'code' => 'LEAD_CONVERSATION_NOT_FOUND'
                ], 404);
            }
            
            // SÉCURITÉ : Vérifier appartenance au client
            if ($leadConv->client_id !== $clientProfile->id) {
                return response()->json([
                    'error' => 'Access denied to this conversation.',
                    'code' => 'LEAD_CONVERSATION_ACCESS_DENIED'
                ], 403);
            }

            if (!$leadConv->freelancer || !$leadConv->freelancer->user) {
                return response()->json([
                    'error' => 'Freelancer profile incomplete.',
                    'code' => 'FREELANCER_INCOMPLETE'
                ], 404);
            }

            $freelancerUserId = $leadConv->freelancer->user_id;

            // ÉTAPE 4.4 : ROUTAGE AUTOMATIQUE
            // Si une subscription existe pour cette paire, utiliser subscription_id au lieu de lead_conversation_id
            $existingSubscription = Subscription::where('client_id', $clientProfile->id)
                ->where('freelancer_id', $leadConv->freelancer_id)
                ->first();

            if ($existingSubscription) {
                // Routage vers subscription (lead_conversation_id reste null)
                $subscriptionId = $existingSubscription->id;
                
                // Anti-désintermédiation : filtrer si subscription non active
                if ($existingSubscription->status !== 'active') {
                    $messageToSave = ContactGuardService::filterContactCoordinates($request->message);
                }
            } else {
                // Pas de subscription => utiliser lead
                $leadConversationId = $leadConv->id;

                // Anti-désintermédiation : toujours filtrer pour les lead
                $messageToSave = ContactGuardService::filterContactCoordinates($request->message);
            }
        }
        // CAS 3 : Nouveau message vers un freelancer (créer LeadConversation si nécessaire)
        elseif ($request->filled('freelancer_id')) {
            $freelancerProfile = FreelancerProfile::with('user')->find($request->freelancer_id);
            
            if (!$freelancerProfile) {
                return response()->json([
                    'error' => 'Freelancer not found.',
                    'code' => 'FREELANCER_NOT_FOUND'
                ], 404);
            }

            if (!$freelancerProfile->user) {
                return response()->json([
                    'error' => 'Freelancer profile incomplete.',
                    'code' => 'FREELANCER_INCOMPLETE'
                ], 404);
            }

            $freelancerUserId = $freelancerProfile->user_id;

            // Vérifier s'il existe déjà une subscription pour cette paire
            $existingSubscription = Subscription::where('client_id', $clientProfile->id)
                ->where('freelancer_id', $freelancerProfile->id)
                ->first();

            if ($existingSubscription) {
                // Utiliser la subscription existante
                $subscriptionId = $existingSubscription->id;
                if ($existingSubscription->status !== 'active') {
                    $messageToSave = ContactGuardService::filterContactCoordinates($request->message);
                }
            } else {
                // Créer ou récupérer la LeadConversation (unique par paire)
                $leadConv = LeadConversation::firstOrCreate(
                    [
                        'client_id' => $clientProfile->id,
                        'freelancer_id' => $freelancerProfile->id,
                    ]
                );
                $leadConversationId = $leadConv->id;

                // Anti-désintermédiation : toujours filtrer pour les lead
                $messageToSave = ContactGuardService::filterContactCoordinates($request->message);
            }
        }

        // Créer le message
        $chatMessage = ChatMessage::create([
            'sender_id' => $user->id,
            'receiver_id' => $freelancerUserId,
            'subscription_id' => $subscriptionId,
            'lead_conversation_id' => $leadConversationId,
            'message' => $messageToSave,
            'is_read' => false,
        ]);

        return response()->json([
            'success' => true,
            'message' => $chatMessage->load(['sender', 'receiver']),
            'lead_conversation_id' => $leadConversationId,
        ]);
    }

    /**
     * Démarrer une conversation lead avec un freelancer (depuis son profil).
     * Redirige vers la page messages avec la conversation lead ouverte.
     */
    public function startLeadConversation(Request $request, $freelancerId)
    {
        $user = Auth::guard('web')->user();
        
        if (!$user) {
            return redirect()->route('user.login');
        }

        $clientProfile = $user->clientProfile;
        
        if (!$clientProfile) {
            return redirect()->route('user.dashboard')
                ->with('error', __('Vous devez avoir un profil client pour contacter un freelance.'));
        }

        $freelancerProfile = FreelancerProfile::with('user')->find($freelancerId);
        
        if (!$freelancerProfile) {
            abort(404, __('Freelance introuvable.'));
        }

        // Vérifier s'il existe déjà une subscription pour cette paire
        $existingSubscription = Subscription::where('client_id', $clientProfile->id)
            ->where('freelancer_id', $freelancerProfile->id)
            ->first();

        if ($existingSubscription) {
            // Rediriger vers la conversation subscription existante
            return redirect()->route('user.messages.index', ['conversation' => $existingSubscription->id]);
        }

        // Créer ou récupérer la LeadConversation
        $leadConv = LeadConversation::firstOrCreate(
            [
                'client_id' => $clientProfile->id,
                'freelancer_id' => $freelancerProfile->id,
            ]
        );

        // Rediriger vers les messages avec cette lead conversation sélectionnée
        return redirect()->route('user.messages.index', ['lead' => $leadConv->id]);
    }
}
