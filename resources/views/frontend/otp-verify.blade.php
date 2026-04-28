@extends('frontend.layout')

@section('pageHeading')
  Vérification de connexion
@endsection

@section('content')
<div class="otp-page">
  <div class="otp-card">

    <div class="otp-icon">
      <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
        <rect width="48" height="48" rx="12" fill="#f5f5f0"/>
        <path d="M24 10C18.477 10 14 14.477 14 20v2H12a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h24a2 2 0 0 0 2-2V24a2 2 0 0 0-2-2h-2v-2c0-5.523-4.477-10-10-10zm0 3a7 7 0 0 1 7 7v2H17v-2a7 7 0 0 1 7-7zm0 13a3 3 0 1 1 0 6 3 3 0 0 1 0-6z" fill="#1a1a1a"/>
      </svg>
    </div>

    <h1 class="otp-title">Vérification requise</h1>
    <p class="otp-subtitle">
      Un code à 6 chiffres a été envoyé à<br>
      <strong>{{ $maskedEmail }}</strong>
    </p>

    @if(session('error'))
      <div class="otp-alert otp-alert-error">{{ session('error') }}</div>
    @endif
    @if(session('success'))
      <div class="otp-alert otp-alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('otp.verify') }}" method="POST" class="otp-form" id="otpForm">
      @csrf
      <div class="otp-inputs" id="otpInputs">
        @for($i = 0; $i < 6; $i++)
          <input
            type="text"
            inputmode="numeric"
            pattern="[0-9]"
            maxlength="1"
            class="otp-input"
            autocomplete="off"
            data-index="{{ $i }}"
          />
        @endfor
      </div>
      <input type="hidden" name="otp" id="otpHidden" />

      <button type="submit" class="otp-btn" id="otpSubmit" disabled>
        Confirmer la connexion
      </button>
    </form>

    <div class="otp-footer">
      <span>Vous n'avez pas reçu le code ?</span>
      <form action="{{ route('otp.resend') }}" method="POST" style="display:inline">
        @csrf
        <button type="submit" class="otp-resend-btn">Renvoyer</button>
      </form>
    </div>

    <a href="{{ route('user.login') }}" class="otp-back">← Retour à la connexion</a>

  </div>
</div>

<style>
  .otp-page {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #fafaf7;
    padding: 40px 16px;
  }
  .otp-card {
    background: #fff;
    border-radius: 20px;
    box-shadow: 0 4px 40px rgba(0,0,0,.08);
    padding: 48px 40px;
    width: 100%;
    max-width: 440px;
    text-align: center;
  }
  .otp-icon { margin-bottom: 24px; }
  .otp-title {
    font-size: 24px;
    font-weight: 700;
    color: #1a1a1a;
    margin: 0 0 10px;
  }
  .otp-subtitle {
    font-size: 15px;
    color: #666;
    margin: 0 0 28px;
    line-height: 1.6;
  }
  .otp-alert {
    border-radius: 8px;
    padding: 12px 16px;
    font-size: 14px;
    margin-bottom: 20px;
    text-align: left;
  }
  .otp-alert-error  { background: #fef2f2; color: #dc2626; border: 1px solid #fecaca; }
  .otp-alert-success{ background: #f0fdf4; color: #16a34a; border: 1px solid #bbf7d0; }
  .otp-inputs {
    display: flex;
    gap: 10px;
    justify-content: center;
    margin-bottom: 28px;
  }
  .otp-input {
    width: 52px;
    height: 60px;
    border: 2px solid #e5e5e5;
    border-radius: 12px;
    font-size: 24px;
    font-weight: 700;
    text-align: center;
    color: #1a1a1a;
    outline: none;
    transition: border-color .2s, box-shadow .2s;
    background: #fafaf7;
  }
  .otp-input:focus {
    border-color: #1a1a1a;
    box-shadow: 0 0 0 3px rgba(26,26,26,.08);
    background: #fff;
  }
  .otp-input.filled { border-color: #1a1a1a; background: #fff; }
  .otp-btn {
    width: 100%;
    padding: 16px;
    background: #1a1a1a;
    color: #fff;
    border: none;
    border-radius: 12px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: background .2s, opacity .2s;
  }
  .otp-btn:disabled { opacity: .4; cursor: not-allowed; }
  .otp-btn:hover:not(:disabled) { background: #333; }
  .otp-footer {
    margin-top: 24px;
    font-size: 14px;
    color: #888;
  }
  .otp-resend-btn {
    background: none;
    border: none;
    color: #1a1a1a;
    font-weight: 600;
    cursor: pointer;
    text-decoration: underline;
    font-size: 14px;
  }
  .otp-back {
    display: inline-block;
    margin-top: 16px;
    font-size: 13px;
    color: #aaa;
    text-decoration: none;
  }
  .otp-back:hover { color: #666; }
  @media (max-width: 480px) {
    .otp-card { padding: 32px 20px; }
    .otp-input { width: 42px; height: 52px; font-size: 20px; }
  }
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
  const inputs  = document.querySelectorAll('.otp-input');
  const hidden  = document.getElementById('otpHidden');
  const btn     = document.getElementById('otpSubmit');

  function sync() {
    const val = Array.from(inputs).map(i => i.value).join('');
    hidden.value = val;
    btn.disabled = val.length < 6;
    inputs.forEach(i => i.classList.toggle('filled', i.value !== ''));
  }

  inputs.forEach((input, idx) => {
    input.addEventListener('input', function () {
      // Autoriser seulement les chiffres
      this.value = this.value.replace(/[^0-9]/g, '').slice(-1);
      sync();
      if (this.value && idx < 5) inputs[idx + 1].focus();
    });

    input.addEventListener('keydown', function (e) {
      if (e.key === 'Backspace' && !this.value && idx > 0) {
        inputs[idx - 1].focus();
        inputs[idx - 1].value = '';
        sync();
      }
    });

    // Support coller (paste) le code complet
    input.addEventListener('paste', function (e) {
      e.preventDefault();
      const pasted = (e.clipboardData || window.clipboardData).getData('text').replace(/\D/g, '');
      pasted.split('').slice(0, 6).forEach((char, i) => {
        if (inputs[i]) inputs[i].value = char;
      });
      sync();
      const nextEmpty = Array.from(inputs).findIndex(i => !i.value);
      if (nextEmpty !== -1) inputs[nextEmpty].focus();
      else inputs[5].focus();
    });
  });

  inputs[0].focus();
});
</script>
@endsection
