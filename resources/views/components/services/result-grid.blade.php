<div class="services-result-grid">
  @if(isset($results) && count($results) > 0)
    @foreach($results as $result)
      <x-services.service-card
        :title="$result['title'] ?? 'Service'"
        :description="$result['description'] ?? null"
        :badges="$result['badges'] ?? ($result['badge'] ?? null)"
        :price="$result['price'] ?? null"
        :image="$result['image'] ?? null"
        :cta="$result['cta'] ?? null"
      />
    @endforeach
  @else
    {{-- Afficher 3 cartes démo si pas de résultats --}}
    @for($i = 1; $i <= 3; $i++)
      <x-services.service-card
        title="Service exemple {{ $i }}"
        description="Description du service exemple {{ $i }}"
        :badges="['Démo']"
        price="Sur devis"
      />
    @endfor
  @endif
</div>

