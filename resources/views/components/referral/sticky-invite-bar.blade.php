<div 
  class="referral-sticky-bar"
  x-data="stickyBar()"
  x-show="isVisible"
  x-transition:enter="transition ease-out duration-300"
  x-transition:enter-start="translate-y-full opacity-0"
  x-transition:enter-end="translate-y-0 opacity-100"
  x-transition:leave="transition ease-in duration-200"
  x-transition:leave-start="translate-y-0 opacity-100"
  x-transition:leave-end="translate-y-full opacity-0"
>
  <div class="referral-sticky-bar-container">
    <div class="referral-sticky-bar-content">
      <span class="referral-sticky-bar-text">
        {{ __('Invitez un proche, recevez :amount€', ['amount' => 10]) }}
      </span>
    </div>
    <button 
      type="button"
      class="referral-sticky-bar-btn"
      onclick="window.dispatchEvent(new CustomEvent('openInviteModal'))"
    >
      {{ __('Inviter des amis') }}
    </button>
  </div>
</div>

