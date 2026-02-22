<div data-onboarding-universe="{{ $uSlug }}">
  <x-services.filters.universal-filter
    :universe="$uSlug"
    :categories="$uf['categories'] ?? []"
    :lesson-goals="$uf['lessonGoals'] ?? []"
    :embedded="true"
    :hierarchy-mode="(bool)($uf['hierarchyMode'] ?? true)"
    :hide-domain-spec-in-advanced="true"
    :disable-expert-filter="true"
  />
</div>
