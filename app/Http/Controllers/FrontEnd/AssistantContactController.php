<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Mail\AssistantContactMail;
use App\Models\SupportTicket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;

class AssistantContactController extends Controller
{
    /**
     * Envoyer un message de contact depuis l'assistant IA
     */
    public function store(Request $request)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:191',
            'subject' => 'required|string|max:191',
            'message' => 'required|string|min:10',
        ], [
            'email.required' => 'L\'adresse email est obligatoire.',
            'email.email' => 'L\'adresse email n\'est pas valide.',
            'subject.required' => 'Le sujet est obligatoire.',
            'message.required' => 'Le message est obligatoire.',
            'message.min' => 'Le message doit contenir au moins 10 caractères.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Créer le ticket de support
            $ticketData = [
                'user_id' => Auth::guard('web')->check() ? Auth::guard('web')->id() : null,
                'user_type' => Auth::guard('web')->check() ? 'user' : 'guest',
                'admin_id' => 1, // Admin par défaut
                'ticket_number' => 'AST-' . uniqid(),
                'subject' => $request->subject,
                'message' => $request->message,
            ];
            
            // Ajouter source si la colonne existe
            if (Schema::hasColumn('support_tickets', 'source')) {
                $ticketData['source'] = 'assistant_widget';
            }
            
            // Ajouter status si la colonne existe
            if (Schema::hasColumn('support_tickets', 'status')) {
                $ticketData['status'] = 'open';
            }
            
            $ticket = SupportTicket::create($ticketData);

            // Envoyer l'email au support (configurable via .env)
            $supportEmail = env('SUPPORT_EMAIL', 'support@junspro.com');
            Mail::to($supportEmail)->send(new AssistantContactMail([
                'email' => $request->email,
                'subject' => $request->subject,
                'message' => $request->message,
                'ticket_number' => $ticket->ticket_number,
                'user_id' => Auth::guard('web')->check() ? Auth::guard('web')->id() : null,
                'user_name' => Auth::guard('web')->check() ? Auth::guard('web')->user()->name : null,
            ]));

            return response()->json([
                'success' => true,
                'message' => 'Votre message a bien été envoyé. Notre équipe vous répondra par email.',
                'ticket_number' => $ticket->ticket_number,
            ], 200);

        } catch (\Exception $e) {
            Log::error('Erreur lors de l\'envoi du message depuis l\'assistant: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue. Merci de réessayer plus tard ou d\'envoyer un email à support@junspro.com.'
            ], 500);
        }
    }
}

