@extends('frontend.layout')

@section('style')
  <link rel="stylesheet" href="{{ asset('assets/css/summernote-content.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/luxury-theme.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/dashboard-luxury-revamp.css') }}">
  <style>
    :root {
      --junspro-purple: #7C3AED;
      --junspro-blue: #1e40af;
      --junspro-gradient: linear-gradient(135deg, #7c3aed 0%, #1e40af 100%);
      --junspro-gradient-alt: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%);
      --shadow-sm: 0 2px 8px rgba(124, 58, 237, 0.12);
      --shadow-md: 0 8px 24px rgba(124, 58, 237, 0.15);
      --shadow-lg: 0 16px 48px rgba(124, 58, 237, 0.20);
      --shadow-xl: 0 24px 64px rgba(124, 58, 237, 0.25);
      --card-shadow: var(--shadow-md);
      --card-shadow-hover: var(--shadow-lg);
    }

    /* Layout principal Messages */
    .messages-container {
      max-width: 1400px;
      margin: 0 auto;
      padding: 3rem 2rem;
      background: linear-gradient(135deg, #fafafa 0%, #f5f3ff 100%);
      min-height: calc(100vh - 200px);
      display: grid;
      grid-template-columns: 25% 50% 25%;
      gap: 2rem;
      height: calc(100vh - 200px);
    }

    /* Colonne gauche - Liste des conversations */
    .messages-sidebar {
      background: white;
      border-radius: 24px;
      box-shadow: var(--card-shadow);
      display: flex;
      flex-direction: column;
      overflow: hidden;
      position: relative;
      z-index: 1;
      border: 1px solid rgba(124, 58, 237, 0.08);
    }

    .messages-sidebar-header {
      padding: 2rem;
      border-bottom: 1px solid rgba(124, 58, 237, 0.08);
      position: relative;
      z-index: 2;
      background: white;
    }

    .messages-sidebar-header h2 {
      font-size: 1.6rem;
      font-weight: 800;
      color: #1a202c;
      margin: 0 0 1.25rem 0;
      letter-spacing: -0.01em;
    }

    .messages-tabs {
      display: flex;
      gap: 0.5rem;
      border-bottom: 2px solid rgba(124, 58, 237, 0.1);
    }

    .messages-tab {
      padding: 0.875rem 1.25rem;
      background: none;
      border: none;
      color: #6b7280;
      font-weight: 600;
      font-size: 0.95rem;
      cursor: pointer;
      border-bottom: 3px solid transparent;
      transition: all 0.3s cubic-bezier(0.23, 1, 0.320, 1);
      position: relative;
    }

    .messages-tab:hover {
      color: var(--junspro-purple);
      background: rgba(124, 58, 237, 0.06);
    }

    .messages-tab.active {
      color: var(--junspro-purple);
      border-bottom-color: var(--junspro-purple);
      font-weight: 700;
    }

    .messages-tab-badge {
      display: inline-block;
      background: var(--junspro-gradient);
      color: white;
      font-size: 0.8rem;
      padding: 0.35rem 0.65rem;
      border-radius: 14px;
      margin-left: 0.6rem;
      font-weight: 700;
    }

    .conversations-list {
      flex: 1;
      overflow-y: auto;
      padding: 0.5rem;
    }

    .conversation-item {
      padding: 1.25rem;
      border-radius: 16px;
      cursor: pointer;
      transition: all 0.3s cubic-bezier(0.23, 1, 0.320, 1);
      margin-bottom: 0.75rem;
      border: 2px solid transparent;
      position: relative;
      z-index: 1;
    }

    .conversation-item:hover {
      background: #f9fafb;
      border-color: rgba(124, 58, 237, 0.2);
    }

    .conversation-item.active {
      background: linear-gradient(135deg, rgba(124, 58, 237, 0.08) 0%, rgba(30, 64, 175, 0.08) 100%);
      border-color: var(--junspro-purple);
    }

    .conversation-item-header {
      display: flex;
      align-items: center;
      gap: 0.75rem;
      margin-bottom: 0.5rem;
    }

    .conversation-avatar {
      width: 52px;
      height: 52px;
      border-radius: 50%;
      object-fit: cover;
      background: var(--junspro-gradient);
      border: 2.5px solid white;
      box-shadow: 0 4px 12px rgba(124, 58, 237, 0.15);
      position: relative;
      flex-shrink: 0;
    }

    .conversation-avatar-initials {
      width: 52px;
      height: 52px;
      border-radius: 50%;
      background: var(--junspro-gradient);
      color: white;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 700;
      font-size: 1.2rem;
      border: 2.5px solid white;
      box-shadow: 0 4px 12px rgba(124, 58, 237, 0.15);
      flex-shrink: 0;
    }

    .conversation-status-dot {
      position: absolute;
      bottom: 0;
      right: 0;
      width: 12px;
      height: 12px;
      border-radius: 50%;
      border: 2px solid white;
      background: #10b981;
      z-index: 2;
    }

    .conversation-status-dot.offline {
      background: #9ca3af;
    }

    .conversation-info {
      flex: 1;
      min-width: 0;
    }

    .conversation-name {
      font-weight: 700;
      color: #1a202c;
      margin-bottom: 0.3rem;
      font-size: 1rem;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
      letter-spacing: -0.005em;
    }

    .conversation-tag {
      font-size: 0.75rem;
      color: #6b7280;
      margin-bottom: 0.25rem;
    }

    .conversation-preview {
      font-size: 0.85rem;
      color: #6b7280;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
      margin-bottom: 0.25rem;
    }

    .conversation-meta {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .conversation-time {
      font-size: 0.75rem;
      color: #9ca3af;
    }

    .conversation-unread-badge {
      background: var(--junspro-purple);
      color: white;
      font-size: 0.7rem;
      font-weight: 600;
      padding: 0.2rem 0.5rem;
      border-radius: 12px;
      min-width: 20px;
      text-align: center;
    }

    .messages-empty-state {
      padding: 3rem 2rem;
      text-align: center;
      color: #6b7280;
    }

    .messages-empty-state-icon {
      font-size: 4rem;
      color: #d1d5db;
      margin-bottom: 1rem;
    }

    /* Colonne centrale - Fil de messages */
    .messages-thread {
      background: white;
      border-radius: 24px;
      box-shadow: var(--card-shadow);
      display: flex;
      flex-direction: column;
      overflow: hidden;
      position: relative;
      z-index: 2;
      border: 1px solid rgba(124, 58, 237, 0.08);
    }

    .messages-thread-header {
      padding: 1.75rem 2rem;
      border-bottom: 1px solid rgba(124, 58, 237, 0.08);
      display: flex;
      align-items: center;
      justify-content: space-between;
      position: relative;
      z-index: 3;
      background: white;
    }

    .thread-freelancer-info {
      display: flex;
      align-items: center;
      gap: 1rem;
    }

    .thread-avatar {
      width: 56px;
      height: 56px;
      border-radius: 50%;
      object-fit: cover;
      background: var(--junspro-gradient);
    }

    .thread-avatar-initials {
      width: 56px;
      height: 56px;
      border-radius: 50%;
      background: var(--junspro-gradient);
      color: white;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 700;
      font-size: 1.25rem;
    }

    .thread-info h3 {
      font-size: 1.2rem;
      font-weight: 800;
      color: #1a202c;
      margin: 0 0 0.35rem 0;
      letter-spacing: -0.01em;
    }

    .thread-info-subtitle {
      font-size: 0.9rem;
      color: #6b7280;
      margin: 0;
      font-weight: 400;
    }

    .thread-badges {
      display: flex;
      gap: 0.5rem;
      align-items: center;
    }

    .thread-badge {
      padding: 0.4rem 0.75rem;
      border-radius: 12px;
      font-size: 0.8rem;
      font-weight: 600;
    }

    .thread-badge.active {
      background: #d1fae5;
      color: #065f46;
    }

    .thread-badge.paused {
      background: #fef3c7;
      color: #92400e;
    }

    .thread-archive-btn {
      background: none;
      border: none;
      color: #9ca3af;
      cursor: pointer;
      padding: 0.5rem;
      border-radius: 8px;
      transition: all 0.2s ease;
    }

    .thread-archive-btn:hover {
      background: #f3f4f6;
      color: var(--junspro-purple);
    }

    .messages-content {
      flex: 1;
      overflow-y: auto;
      padding: 2rem;
      display: flex;
      flex-direction: column;
      gap: 1.25rem;
    }

    .message-date-separator {
      text-align: center;
      padding: 0.75rem 0;
      position: relative;
    }

    .message-date-separator::before,
    .message-date-separator::after {
      content: '';
      position: absolute;
      top: 50%;
      width: 40%;
      height: 1px;
      background: #e5e7eb;
    }

    .message-date-separator::before {
      left: 0;
    }

    .message-date-separator::after {
      right: 0;
    }

    .message-date-separator span {
      background: white;
      padding: 0 1rem;
      color: #6b7280;
      font-size: 0.85rem;
      position: relative;
    }

    .message-item {
      display: flex;
      gap: 0.75rem;
      max-width: 70%;
    }

    .message-item.sent {
      align-self: flex-end;
      flex-direction: row-reverse;
    }

    .message-item.received {
      align-self: flex-start;
    }

    .message-avatar {
      width: 36px;
      height: 36px;
      border-radius: 50%;
      object-fit: cover;
      flex-shrink: 0;
    }

    .message-avatar-initials {
      width: 36px;
      height: 36px;
      border-radius: 50%;
      background: var(--junspro-gradient);
      color: white;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 700;
      font-size: 0.9rem;
      flex-shrink: 0;
    }

    .message-bubble {
      padding: 1rem 1.35rem;
      border-radius: 20px;
      word-wrap: break-word;
      position: relative;
      font-size: 0.98rem;
      line-height: 1.6;
    }

    .message-item.sent .message-bubble {
      background: var(--junspro-gradient);
      color: white;
      border-bottom-right-radius: 4px;
      box-shadow: 0 4px 12px rgba(124, 58, 237, 0.25);
    }

    .message-item.received .message-bubble {
      background: #f3f4f6;
      color: #1a202c;
      border-bottom-left-radius: 4px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
    }

    .message-item.system .message-bubble {
      background: linear-gradient(135deg, #fef3c7 0%, #fcd34d 100%);
      color: #92400e;
      text-align: center;
      max-width: 100%;
      margin: 0 auto;
      box-shadow: 0 2px 8px rgba(217, 119, 6, 0.15);
    }

    .message-time {
      font-size: 0.7rem;
      color: #9ca3af;
      margin-top: 0.25rem;
      padding: 0 0.5rem;
    }

    .message-item.sent .message-time {
      text-align: right;
    }

    .messages-composer {
      padding: 1.5rem;
      border-top: 1px solid #e5e7eb;
      background: white;
      position: relative;
      z-index: 3;
    }

    .messages-composer-actions {
      display: flex;
      gap: 0.5rem;
      margin-bottom: 0.75rem;
    }

    .composer-action-btn {
      background: none;
      border: none;
      color: #6b7280;
      cursor: pointer;
      padding: 0.5rem;
      border-radius: 8px;
      transition: all 0.2s ease;
    }

    .composer-action-btn:hover {
      background: #f3f4f6;
      color: var(--junspro-purple);
    }

    .messages-composer-form {
      display: flex;
      gap: 0.75rem;
      align-items: flex-end;
    }

    .composer-textarea {
      flex: 1;
      padding: 1rem 1.25rem;
      border: 2px solid rgba(124, 58, 237, 0.15);
      border-radius: 18px;
      font-size: 0.98rem;
      font-family: inherit;
      resize: none;
      min-height: 52px;
      max-height: 120px;
      transition: all 0.3s cubic-bezier(0.23, 1, 0.320, 1);
      background: white;
    }

    .composer-textarea:focus {
      outline: none;
      border-color: var(--junspro-purple);
      box-shadow: 0 0 0 3.5px rgba(124, 58, 237, 0.12);
    }

    .composer-send-btn {
      padding: 1rem 2.25rem;
      background: var(--junspro-gradient);
      color: white;
      border: none;
      border-radius: 18px;
      font-weight: 700;
      font-size: 1rem;
      cursor: pointer;
      transition: all 0.35s cubic-bezier(0.23, 1, 0.320, 1);
      white-space: nowrap;
      box-shadow: 0 4px 16px rgba(124, 58, 237, 0.3);
    }

    .composer-send-btn:hover:not(:disabled) {
      transform: translateY(-3px);
      box-shadow: 0 8px 24px rgba(124, 58, 237, 0.4);
    }

    .composer-send-btn:disabled {
      opacity: 0.55;
      cursor: not-allowed;
    }

    .messages-thread-empty {
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
      color: #6b7280;
      padding: 3rem;
    }

    /* Colonne droite - Infos projet & freelance */
    .messages-sidebar-info {
      background: white;
      border-radius: 24px;
      box-shadow: var(--card-shadow);
      display: flex;
      flex-direction: column;
      overflow-y: auto;
      padding: 2rem;
      gap: 2rem;
      position: relative;
      z-index: 1;
      border: 1px solid rgba(124, 58, 237, 0.08);
    }

    .info-block {
      padding-bottom: 2rem;
      border-bottom: 1px solid rgba(124, 58, 237, 0.08);
    }

    .info-block:last-child {
      border-bottom: none;
      padding-bottom: 0;
    }

    .info-block-title {
      font-size: 1.2rem;
      font-weight: 800;
      color: #1a202c;
      margin-bottom: 1.25rem;
      letter-spacing: -0.01em;
    }

    .freelancer-card-large {
      text-align: center;
      padding: 1.5rem 0;
    }

    .freelancer-card-avatar {
      width: 112px;
      height: 112px;
      border-radius: 50%;
      object-fit: cover;
      margin: 0 auto 1.5rem;
      border: 4px solid var(--junspro-purple);
      box-shadow: 0 8px 24px rgba(124, 58, 237, 0.25);
    }

    .freelancer-card-avatar-initials {
      width: 112px;
      height: 112px;
      border-radius: 50%;
      background: var(--junspro-gradient);
      color: white;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 700;
      font-size: 2.2rem;
      margin: 0 auto 1.5rem;
      border: 4px solid var(--junspro-purple);
      box-shadow: 0 8px 24px rgba(124, 58, 237, 0.25);
    }

    .freelancer-card-name {
      font-size: 1.35rem;
      font-weight: 800;
      color: #1a202c;
      margin-bottom: 0.6rem;
      letter-spacing: -0.01em;
    }

    .freelancer-card-role {
      font-size: 0.95rem;
      color: #6b7280;
      margin-bottom: 1rem;
      font-weight: 400;
    }

    .freelancer-card-rating {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 0.5rem;
      font-size: 0.95rem;
      color: #1a202c;
    }

    .rating-stars {
      color: #fbbf24;
    }

    .info-line {
      display: flex;
      justify-content: space-between;
      padding: 0.75rem 0;
      font-size: 0.9rem;
    }

    .info-line-label {
      color: #6b7280;
    }

    .info-line-value {
      color: #1a202c;
      font-weight: 600;
    }

    .info-btn {
      display: block;
      width: 100%;
      padding: 1rem 1.25rem;
      border-radius: 14px;
      font-weight: 700;
      font-size: 0.95rem;
      text-align: center;
      text-decoration: none;
      transition: all 0.35s cubic-bezier(0.23, 1, 0.320, 1);
      border: none;
      cursor: pointer;
      margin-bottom: 0.75rem;
      box-sizing: border-box;
    }

    .info-btn-primary {
      background: var(--junspro-gradient);
      color: white;
      box-shadow: 0 4px 16px rgba(124, 58, 237, 0.3);
    }

    .info-btn-primary:hover {
      transform: translateY(-3px);
      box-shadow: 0 8px 24px rgba(124, 58, 237, 0.4);
      color: white;
    }

    .info-btn-secondary {
      background: linear-gradient(135deg, #f5f3ff 0%, #fafafa 100%);
      color: #1a202c;
      border: 1.5px solid rgba(124, 58, 237, 0.12);
    }

    .info-btn-secondary:hover {
      background: white;
      border-color: rgba(124, 58, 237, 0.2);
      color: #1a202c;
    }

    .info-list-item {
      padding: 0.5rem 0;
      font-size: 0.9rem;
      color: #4b5563;
      border-bottom: 1px solid #f3f4f6;
    }

    .info-list-item:last-child {
      border-bottom: none;
    }

    .notes-textarea {
      width: 100%;
      min-height: 130px;
      padding: 1rem;
      border: 2px solid rgba(124, 58, 237, 0.15);
      border-radius: 14px;
      font-size: 0.95rem;
      font-family: inherit;
      resize: vertical;
      background: white;
      transition: all 0.3s cubic-bezier(0.23, 1, 0.320, 1);
    }

    .notes-textarea:focus {
      outline: none;
      border-color: var(--junspro-purple);
      box-shadow: 0 0 0 3.5px rgba(124, 58, 237, 0.12);
    }

    /* Responsive */
    @media (max-width: 1200px) {
      .messages-container {
        grid-template-columns: 30% 45% 25%;
      }
    }

    @media (max-width: 992px) {
      .messages-container {
        grid-template-columns: 1fr;
        height: auto;
      }

      .messages-sidebar,
      .messages-thread,
      .messages-sidebar-info {
        height: auto;
        max-height: 600px;
      }

      .messages-thread-empty {
        min-height: 400px;
      }
    }

    @media (max-width: 768px) {
      .messages-container {
        padding: 1rem;
        gap: 1rem;
      }

      .message-item {
        max-width: 85%;
      }
    }

    /* === Dashboard Hero === */
    .messages-dashboard-hero {
      background: linear-gradient(135deg, #4c1d95 0%, #7c3aed 60%, #a855f7 100%);
      border-radius: 40px;
      padding: 3rem 4rem;
      margin: 1.5rem 0 2rem;
      color: white;
      display: flex;
      align-items: center;
      box-shadow: 0 32px 80px rgba(124, 58, 237, 0.3), inset 0 1px 1px rgba(255,255,255,0.2);
      position: relative;
      overflow: hidden;
    }
    .messages-dashboard-hero::before {
      content: '';
      position: absolute;
      top: -40%; left: -5%;
      width: 400px; height: 400px;
      background: radial-gradient(circle, rgba(255,255,255,0.08) 0%, transparent 70%);
      border-radius: 50%;
      pointer-events: none;
    }
    .messages-dashboard-hero::after {
      content: '';
      position: absolute;
      bottom: -20%; right: -10%;
      width: 600px; height: 600px;
      background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
      border-radius: 50%;
      pointer-events: none;
    }
    .messages-dashboard-hero-title {
      font-size: 2.5rem;
      font-weight: 900;
      margin-bottom: 0.5rem;
      color: white;
      line-height: 1.1;
      letter-spacing: -0.03em;
      position: relative;
      z-index: 2;
    }
    .messages-dashboard-hero-subtitle {
      font-size: 1.1rem;
      opacity: 0.9;
      margin-bottom: 0;
      font-weight: 300;
      color: white;
      position: relative;
      z-index: 2;
    }
  </style>
@endsection

@section('content')
  <!-- Navigation principale (onglets) -->
  <div style="max-width: 1400px; margin: 0 auto; padding: 3rem 1.5rem 0;">
    @include('frontend.client.partials.dashboard-nav')
  </div>

  <!-- Hero violet -->
  @php $heroFirstName = Auth::guard('web')->user() ? explode(' ', trim(Auth::guard('web')->user()->name))[0] : 'vous'; @endphp
  <div style="max-width: 1400px; margin: 0 auto; padding: 0 1.5rem;">
    <div class="messages-dashboard-hero">
      <div>
        <h1 class="messages-dashboard-hero-title">Bonjour {{ $heroFirstName }} !</h1>
        <p class="messages-dashboard-hero-subtitle">Bienvenue dans votre espace</p>
      </div>
    </div>
  </div>

  <div class="messages-container">
    <!-- Colonne gauche - Liste des conversations -->
    <div class="messages-sidebar">
      <div class="messages-sidebar-header">
        <h2>{{ __('Messages') }}</h2>
        <div class="messages-tabs">
          <a href="{{ route('user.messages.index', ['tab' => 'all']) }}" 
             class="messages-tab {{ $currentTab === 'all' ? 'active' : '' }}">
            {{ __('Tous') }}
          </a>
          <a href="{{ route('user.messages.index', ['tab' => 'unread']) }}" 
             class="messages-tab {{ $currentTab === 'unread' ? 'active' : '' }}">
            {{ __('Non lus') }}
            @php
              $totalUnread = is_array($conversations) ? collect($conversations)->sum('unreadCount') : 0;
            @endphp
            @if($totalUnread > 0)
              <span class="messages-tab-badge">{{ $totalUnread }}</span>
            @endif
          </a>
          <a href="{{ route('user.messages.index', ['tab' => 'archived']) }}" 
             class="messages-tab {{ $currentTab === 'archived' ? 'active' : '' }}">
            {{ __('Archivés') }}
          </a>
        </div>
      </div>

      <div class="conversations-list">
        @if(isset($conversations) && count($conversations) > 0)
          @foreach($conversations as $conv)
            @php
              $convType = $conv['type'] ?? 'subscription';
              $subscription = $conv['subscription'];
              $leadConversation = $conv['leadConversation'] ?? null;
              $freelancer = $conv['freelancer'];
              $freelancerProfile = $conv['freelancerProfile'] ?? null;
              $lastMessage = $conv['lastMessage'];
              $unreadCount = $conv['unreadCount'];
              
              // ÉTAPE 4.3 : Déterminer si cette conversation est active (par freelancer_id, pas par type)
              $isActive = false;
              if (isset($selectedConversation) && isset($selectedConversation['freelancerProfile'])) {
                $selectedFreelancerId = $selectedConversation['freelancerProfile']->id ?? null;
                $currentFreelancerId = $freelancerProfile->id ?? null;
                $isActive = $selectedFreelancerId && $currentFreelancerId && $selectedFreelancerId === $currentFreelancerId;
              }
              
              // ÉTAPE 4.3 : URL canonique — toujours utiliser subscription si elle existe
              $convUrl = $subscription
                ? route('user.messages.index', ['conversation' => $subscription->id, 'tab' => $currentTab])
                : route('user.messages.index', ['lead' => $leadConversation->id, 'tab' => $currentTab]);
              
              // Format date
              $dateText = '';
              if ($lastMessage) {
                $messageDate = \Carbon\Carbon::parse($lastMessage->created_at);
                if ($messageDate->isToday()) {
                  $dateText = $messageDate->format('H:i');
                } elseif ($messageDate->isYesterday()) {
                  $dateText = __('Hier');
                } else {
                  $dateText = $messageDate->format('d/m');
                }
              }
              
              // Tag de conversation (subscription vs lead)
              $convTag = $subscription
                ? __('Abonnement') . ' ' . ($subscription->hours_per_week ?? '') . 'h/semaine'
                : __('Pré-réservation');
              
              // Filtrage coordonnées pour preview du dernier message
              // Si le dernier message est un lead => filtrer
              // Si le dernier message est subscription => filtrer si subscription non active
              $shouldFilter = false;
              if ($lastMessage) {
                if ($lastMessage->lead_conversation_id) {
                  $shouldFilter = true;
                } elseif ($lastMessage->subscription_id && $subscription) {
                  $shouldFilter = $subscription->status !== 'active';
                }
              }
            @endphp
            <div class="conversation-item {{ $isActive ? 'active' : '' }}"
                 onclick="window.location.href='{{ $convUrl }}'">
              <div class="conversation-item-header">
                @if($freelancer->image)
                  <img src="{{ asset('assets/img/users/' . $freelancer->image) }}" 
                       alt="{{ $freelancer->name }}" 
                       class="conversation-avatar"
                       onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                  <div class="conversation-avatar-initials" style="display: none;">
                    {{ strtoupper(substr($freelancer->name, 0, 1)) }}
                  </div>
                @else
                  <div class="conversation-avatar-initials">
                    {{ strtoupper(substr($freelancer->name, 0, 1)) }}
                  </div>
                @endif
                <div class="conversation-info">
                  <div class="conversation-name">{{ $freelancer->name }}</div>
                  <div class="conversation-tag">{{ $convTag }}</div>
                  @if($lastMessage)
                    @php
                      $previewText = $shouldFilter
                        ? \App\Services\Junspro\ContactGuardService::filterContactCoordinates($lastMessage->message)
                        : $lastMessage->message;
                    @endphp
                    <div class="conversation-preview">{{ \Illuminate\Support\Str::limit($previewText, 50) }}</div>
                  @endif
                  <div class="conversation-meta">
                    @if($lastMessage)
                      <span class="conversation-time">{{ $dateText }}</span>
                    @endif
                    @if($unreadCount > 0)
                      <span class="conversation-unread-badge">{{ $unreadCount }}</span>
                    @endif
                  </div>
                </div>
              </div>
            </div>
          @endforeach
        @else
          <div class="messages-empty-state">
            <div class="messages-empty-state-icon"><i class="far fa-comments"></i></div>
            <h3>{{ __('Aucune conversation') }}</h3>
            <p>{{ __("Vous n'avez pas encore de messages. Réservez une première heure avec un freelance pour commencer votre Rituel.") }}</p>
            <a href="{{ route('explore') }}" class="info-btn info-btn-primary" style="margin-top: 1rem; display: inline-block;">{{ __('Trouver un freelance') }}</a>
          </div>
        @endif
      </div>
    </div>

    <!-- Colonne centrale - Fil de messages -->
    <div class="messages-thread">
      @if(isset($selectedConversation))
        @php
          $convType = $selectedConversation['type'] ?? 'subscription';
          $subscription = $selectedConversation['subscription'];
          $leadConversation = $selectedConversation['leadConversation'] ?? null;
          $freelancer = $selectedConversation['freelancer'];
          $freelancerProfile = $selectedConversation['freelancerProfile'];
          
          // ÉTAPE 4.3 : Garde-fous appliqués PAR MESSAGE
          // La bannière s'affiche si AU MOINS UN message nécessite filtrage :
          // - subscription non active OU lead_conversation existe
          $hasLeadMessages = $leadConversation !== null;
          $subscriptionIsActive = $subscription && $subscription->status === 'active';
          $showBanner = $hasLeadMessages || ($subscription && !$subscriptionIsActive);
          
          // Sous-titre
          $threadSubtitle = $subscription
            ? __('Freelance expert') . ' – ' . __('Abonnement') . ' ' . ($subscription->hours_per_week ?? '') . 'h/semaine'
            : __('Freelance expert') . ' – ' . __('Pré-réservation');
        @endphp
        
        <div class="messages-thread-header">
          <div class="thread-freelancer-info">
            @if($freelancer->image)
              <img src="{{ asset('assets/img/users/' . $freelancer->image) }}" 
                   alt="{{ $freelancer->name }}" 
                   class="thread-avatar"
                   onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
              <div class="thread-avatar-initials" style="display: none;">
                {{ strtoupper(substr($freelancer->name, 0, 1)) }}
              </div>
            @else
              <div class="thread-avatar-initials">
                {{ strtoupper(substr($freelancer->name, 0, 1)) }}
              </div>
            @endif
            <div class="thread-info">
              <h3>{{ $freelancer->name }}</h3>
              <p class="thread-info-subtitle">{{ $threadSubtitle }}</p>
            </div>
          </div>
          <div class="thread-badges">
            @if($subscription)
              @if($subscription->status === 'active')
                <span class="thread-badge active">{{ __('Rituel actif') }}</span>
              @elseif($subscription->status === 'paused')
                <span class="thread-badge paused">{{ __('En pause') }}</span>
              @else
                <span class="thread-badge paused">{{ ucfirst($subscription->status ?? 'pending') }}</span>
              @endif
            @else
              <span class="thread-badge paused">{{ __('Pré-réservation') }}</span>
            @endif
            <button class="thread-archive-btn" aria-label="{{ __('Archiver la conversation') }}">
              <i class="far fa-folder"></i>
            </button>
          </div>
        </div>

        @if($showBanner)
          <div class="messages-coordinates-guard" style="padding: 0.5rem 1rem; background: #f0f9ff; color: #0c4a6e; font-size: 0.75rem; border-bottom: 1px solid #bae6fd;">
            <div style="margin-bottom: 0.25rem;">{{ \App\Services\Junspro\ContactGuardService::$infoMessage }}</div>
            <div style="opacity: 0.9; font-size: clamp(0.75rem, 2.5vw, 0.8125rem);">{{ __('Paiement sécurisé') }} • {{ __('Annulation simplifiée') }} • {{ __('Facture') }} • {{ __('Support') }}</div>
          </div>
        @endif

        <div class="messages-content" id="messagesContent">
          @php
            $currentDate = null;
          @endphp
          @foreach($messages as $message)
            @php
              $messageDate = \Carbon\Carbon::parse($message->created_at);
              $showDateSeparator = !$currentDate || !$messageDate->isSameDay($currentDate);
              $currentDate = $messageDate;
              
              $isClient = $message->sender_id === Auth::guard('web')->id();
              $dateSeparatorText = '';
              if ($messageDate->isToday()) {
                $dateSeparatorText = __("Aujourd'hui");
              } elseif ($messageDate->isYesterday()) {
                $dateSeparatorText = __('Hier');
              } else {
                $dateSeparatorText = $messageDate->format('d F Y');
              }
              
              // ÉTAPE 4.3 : Garde-fous PAR MESSAGE
              // - Si message a lead_conversation_id => toujours filtrer
              // - Si message a subscription_id => filtrer seulement si subscription.status !== 'active'
              $shouldFilterThisMessage = false;
              if ($message->lead_conversation_id) {
                // Message lead => toujours filtrer
                $shouldFilterThisMessage = true;
              } elseif ($message->subscription_id) {
                // Message subscription => filtrer si subscription non active
                $shouldFilterThisMessage = !$subscriptionIsActive;
              }
            @endphp
            
            @if($showDateSeparator)
              <div class="message-date-separator">
                <span>{{ $dateSeparatorText }}</span>
              </div>
            @endif

            <div class="message-item {{ $isClient ? 'sent' : 'received' }}">
              @if(!$isClient)
                @if($freelancer->image)
                  <img src="{{ asset('assets/img/users/' . $freelancer->image) }}" 
                       alt="{{ $freelancer->name }}" 
                       class="message-avatar"
                       onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                  <div class="message-avatar-initials" style="display: none;">
                    {{ strtoupper(substr($freelancer->name, 0, 1)) }}
                  </div>
                @else
                  <div class="message-avatar-initials">
                    {{ strtoupper(substr($freelancer->name, 0, 1)) }}
                  </div>
                @endif
              @endif
              <div>
                @php
                  // Appliquer le filtrage PAR MESSAGE
                  $displayMessage = $shouldFilterThisMessage
                    ? \App\Services\Junspro\ContactGuardService::filterContactCoordinates($message->message)
                    : $message->message;
                @endphp
                <div class="message-bubble">{{ $displayMessage }}</div>
                <div class="message-time">{{ $messageDate->format('H:i') }}</div>
              </div>
            </div>
          @endforeach
        </div>

        <div class="messages-composer">
          <form id="messageForm" action="{{ route('user.messages.send') }}" method="POST">
            @csrf
            {{-- ÉTAPE 4.3 : Toujours utiliser subscription_id si elle existe (routage auto 4.4) --}}
            @if($subscription)
              <input type="hidden" name="subscription_id" value="{{ $subscription->id }}">
            @elseif($leadConversation)
              <input type="hidden" name="lead_conversation_id" value="{{ $leadConversation->id }}">
            @endif
            <div class="messages-composer-actions">
              <button type="button" class="composer-action-btn" aria-label="{{ __('Joindre un fichier') }}">
                <i class="far fa-paperclip"></i>
              </button>
              <button type="button" class="composer-action-btn" aria-label="{{ __('Emoji') }}">
                <i class="far fa-smile"></i>
              </button>
            </div>
            <div class="messages-composer-form">
              <textarea name="message" 
                        id="messageTextarea" 
                        class="composer-textarea" 
                        placeholder="{{ __('Votre message…') }}" 
                        rows="1"></textarea>
              <button type="submit" class="composer-send-btn" id="sendMessageBtn" disabled>
                {{ __('Envoyer') }}
              </button>
            </div>
          </form>
        </div>
      @else
        <div class="messages-thread-empty">
          <div>
            <i class="far fa-comments" style="font-size: 4rem; color: #d1d5db; margin-bottom: 1rem;"></i>
            <h3>{{ __('Choisissez un freelance') }}</h3>
            <p>{{ __('Choisissez un freelance dans la liste à gauche pour démarrer une conversation.') }}</p>
          </div>
        </div>
      @endif
    </div>

    <!-- Colonne droite - Infos projet & freelance -->
    @if(isset($selectedConversation))
      @php
        // ÉTAPE 4.3 : On n'utilise plus $convType, on vérifie directement si subscription existe
        $subscription = $selectedConversation['subscription'];
        $leadConversation = $selectedConversation['leadConversation'] ?? null;
        $freelancer = $selectedConversation['freelancer'];
        $freelancerProfile = $selectedConversation['freelancerProfile'];
        
        // Variables pour subscription uniquement
        $hoursRemaining = 0;
        $lastReport = null;
        $nextSession = null;
        
        if ($subscription) {
          // Calculer les heures restantes
          $completedSessions = \App\Models\WorkSession::where('subscription_id', $subscription->id)
            ->where('status', 'completed')
            ->get();
          $usedHours = $completedSessions->sum(function($session) {
            return ($session->duration_minutes ?? 60) / 60;
          });
          $hoursRemaining = max(0, ($subscription->hours_remaining ?? ($subscription->hours_total_month ?? 0) - $usedHours));
          
          // Dernier rapport
          $lastReport = \App\Models\WorkSession::where('subscription_id', $subscription->id)
            ->where('status', 'completed')
            ->whereNotNull('report_text')
            ->orderBy('end_at', 'desc')
            ->first();
          
          // Prochaine session
          $nextSession = \App\Models\WorkSession::where('subscription_id', $subscription->id)
            ->where('start_at', '>', now())
            ->where('status', '!=', 'cancelled')
            ->orderBy('start_at', 'asc')
            ->first();
        }
      @endphp
      
      <div class="messages-sidebar-info">
        <!-- Bloc 1 - Identité freelance -->
        <div class="info-block">
          <div class="freelancer-card-large">
            @if($freelancer->image)
              <img src="{{ asset('assets/img/users/' . $freelancer->image) }}" 
                   alt="{{ $freelancer->name }}" 
                   class="freelancer-card-avatar"
                   onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
              <div class="freelancer-card-avatar-initials" style="display: none;">
                {{ strtoupper(substr($freelancer->name, 0, 1)) }}
              </div>
            @else
              <div class="freelancer-card-avatar-initials">
                {{ strtoupper(substr($freelancer->name, 0, 1)) }}
              </div>
            @endif
            <div class="freelancer-card-name">{{ $freelancer->name }}</div>
            <div class="freelancer-card-role">{{ __('Freelance expert') }}</div>
            <div class="freelancer-card-rating">
              <span class="rating-stars">★★★★★</span>
              <span>4.8 (23 {{ __('avis') }})</span>
            </div>
          </div>
        </div>

        @if($subscription)
          <!-- Bloc 2 - Abonnement / Rituels (subscription existe) -->
          <div class="info-block">
            <h3 class="info-block-title">{{ __('Votre formule avec ce freelance') }}</h3>
            <div class="info-line">
              <span class="info-line-label">{{ __('Tarif') }}</span>
              <span class="info-line-value">{{ number_format($freelancerProfile->hourly_rate ?? 0, 0, ',', ' ') }} € / Rituel</span>
            </div>
            <div class="info-line">
              <span class="info-line-label">{{ __('Solde') }}</span>
              <span class="info-line-value">{{ number_format($hoursRemaining, 1) }} {{ __('Rituels restants') }}</span>
            </div>
            @if($lastReport)
              <div class="info-line">
                <span class="info-line-label">{{ __('Dernier rapport') }}</span>
                <span class="info-line-value">{{ \Carbon\Carbon::parse($lastReport->end_at)->format('d/m, H:i') }}</span>
              </div>
            @endif
            @if($nextSession)
              <div class="info-line">
                <span class="info-line-label">{{ __('Prochain Rituel') }}</span>
                <span class="info-line-value">{{ \Carbon\Carbon::parse($nextSession->start_at)->format('d/m, H:i') }}</span>
              </div>
            @endif
            <a href="{{ route('client.subscriptions.show', $subscription->id) }}" class="info-btn info-btn-primary">
              {{ __('Ajouter des Rituels') }}
            </a>
            <a href="{{ route('freelance.show', $freelancerProfile->id) }}" class="info-btn info-btn-secondary">
              {{ __('Voir le calendrier') }}
            </a>
          </div>

          <!-- Bloc 3 - Actions projet (subscription uniquement) -->
          <div class="info-block">
            <h3 class="info-block-title">{{ __('Actions Rituel') }}</h3>
            <a href="{{ route('client.subscriptions.show', $subscription->id) }}" class="info-btn info-btn-primary">
              {{ __('Voir les rapports') }}
            </a>
            <button class="info-btn info-btn-secondary">
              {{ __('Laisser un avis') }}
            </button>
          </div>

          <!-- Bloc 4 - Informations techniques (subscription uniquement) -->
          <div class="info-block">
            <h3 class="info-block-title">{{ __('Informations techniques') }}</h3>
            <div class="info-list-item">
              <strong>{{ __('Type de Rituel') }}:</strong> {{ __('Abonnement') }} {{ $subscription->hours_per_week }}h/semaine
            </div>
            <div class="info-list-item">
              <strong>{{ __('Statut') }}:</strong> 
              @if($subscription->status === 'active')
                {{ __('En cours') }}
              @elseif($subscription->status === 'paused')
                {{ __('En pause') }}
              @else
                {{ ucfirst($subscription->status) }}
              @endif
            </div>
          </div>
        @else
          <!-- Bloc 2 - Pré-réservation (lead uniquement) -->
          <div class="info-block">
            <h3 class="info-block-title">{{ __('Pré-réservation') }}</h3>
            <div class="info-line">
              <span class="info-line-label">{{ __('Tarif') }}</span>
              <span class="info-line-value">{{ number_format($freelancerProfile->hourly_rate ?? 0, 0, ',', ' ') }} € / Rituel</span>
            </div>
            <p style="font-size: 0.85rem; color: #6b7280; margin: 1rem 0;">
              {{ __('Discutez avec ce freelance pour définir votre Rituel avant de réserver.') }}
            </p>
            <a href="{{ route('freelance.booking', $freelancerProfile->id) }}" class="info-btn info-btn-primary">
              {{ __('Réserver un Rituel') }}
            </a>
            <a href="{{ route('freelance.show', $freelancerProfile->id) }}" class="info-btn info-btn-secondary">
              {{ __('Voir le profil') }}
            </a>
          </div>
        @endif

        <!-- Bloc 5 - Notes privées (toujours visible) -->
        <div class="info-block">
          <h3 class="info-block-title">{{ __('Mes notes') }}</h3>
          <textarea class="notes-textarea" placeholder="{{ __('Notez vos idées, décisions, prochaines étapes…') }}"></textarea>
        </div>
      </div>
    @else
      <div class="messages-sidebar-info">
        <div class="messages-empty-state">
          <i class="far fa-info-circle" style="font-size: 3rem; color: #d1d5db; margin-bottom: 1rem;"></i>
          <p>{{ __('Sélectionnez une conversation pour voir les informations du Rituel.') }}</p>
        </div>
      </div>
    @endif
  </div>

  <script>
    // Auto-resize textarea
    const textarea = document.getElementById('messageTextarea');
    const sendBtn = document.getElementById('sendMessageBtn');
    
    if (textarea) {
      textarea.addEventListener('input', function() {
        this.style.height = 'auto';
        this.style.height = Math.min(this.scrollHeight, 120) + 'px';
        
        // Enable/disable send button
        if (sendBtn) {
          sendBtn.disabled = this.value.trim().length === 0;
        }
      });

      // Send with Ctrl+Enter
      textarea.addEventListener('keydown', function(e) {
        if (e.key === 'Enter' && e.ctrlKey) {
          e.preventDefault();
          const form = document.getElementById('messageForm');
          if (form && !sendBtn.disabled) {
            form.submit();
          }
        }
      });

      // Scroll to bottom on load
      const messagesContent = document.getElementById('messagesContent');
      if (messagesContent) {
        messagesContent.scrollTop = messagesContent.scrollHeight;
      }
    }

    // Form submission
    const messageForm = document.getElementById('messageForm');
    if (messageForm) {
      messageForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        const messageText = formData.get('message');
        
        if (messageText.trim().length === 0) {
          return;
        }

        fetch(this.action, {
          method: 'POST',
          body: formData,
          headers: {
            'X-Requested-With': 'XMLHttpRequest',
          }
        })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            // Reload page to show new message
            window.location.reload();
          }
        })
        .catch(error => {
          console.error('Error:', error);
          alert('{{ __("Erreur lors de l'envoi du message.") }}');
        });
      });
    }
  </script>
@endsection
