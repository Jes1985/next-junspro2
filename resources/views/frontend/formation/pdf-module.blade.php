<!DOCTYPE html>
<html lang="{{ $pdfLang ?? 'fr' }}">
<head>
<meta charset="UTF-8">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>{{ $module->title }} — Pause Souffle</title>
<style>
  body {
    font-family: Georgia, "Times New Roman", serif;
    background: #ffffff;
    color: #1a1a1a;
    font-size: 14pt;
    line-height: 1.8;
    margin: 0;
    padding: 0 0 38pt 0;
    direction: ltr;
    unicode-bidi: embed;
  }

  /* PIED DE PAGE FIXE */
  .pdf-footer {
    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;
    height: 26pt;
    background: #ffffff;
    border-top: 0.5pt solid #e8e0d0;
    padding: 5pt 46pt 0 46pt;
  }
  .pdf-footer table { width: 100%; }
  .pdf-footer td    { font-size: 10pt; vertical-align: middle; }
  .pdf-footer .fl   { text-align: left;  color: #bbbbbb; }
  .pdf-footer .fr   { text-align: right; color: #C9A84C; }

  /* COUVERTURE */
  .cover {
    page-break-after: always;
    background: #0f0f0f;
    color: #ffffff;
    text-align: center;
    padding: 90pt 50pt 70pt 50pt;
  }
  .cover-school  { font-size: 12pt; text-transform: uppercase; letter-spacing: 0.3em; color: #8a7040; margin-bottom: 8pt; }
  .cover-eyebrow { font-size: 11pt;  text-transform: uppercase; letter-spacing: 0.3em; color: #6a5830; margin-bottom: 34pt; }
  .cover-title   { font-size: 34pt;  font-weight: 400; color: #ffffff; line-height: 1.25; margin-bottom: 14pt; }
  .cover-subtitle{ font-size: 16pt;  color: #C9A84C; font-style: italic; margin-bottom: 34pt; }
  .cover-line    { width: 55pt; height: 1pt; background: #5a4a28; margin: 0 auto 32pt auto; }
  .cover-desc    { font-size: 13pt; color: #777777; line-height: 1.9; margin-bottom: 38pt; }
  .cover-user    { font-size: 12pt;  color: #C9A84C; text-transform: uppercase; letter-spacing: 0.2em; }
  .cover-date    { margin-top: 32pt; font-size: 11pt; color: #444444; letter-spacing: 0.12em; }

  /* INTENTION */
  .intro-page    { page-break-after: always; background: #0f0f0f; color: #ffffff; padding: 55pt; }
  .intro-eyebrow { font-size: 11pt; text-transform: uppercase; letter-spacing: 0.3em; color: #8a7040; margin-bottom: 22pt; padding-bottom: 10pt; border-bottom: 0.5pt solid #2a2a2a; }
  .intro-body    { font-size: 15pt; color: #cccccc; line-height: 2.1; font-style: italic; }
  .intro-quote   { margin-top: 32pt; padding: 14pt 20pt; border-left: 2pt solid #5a4a28; font-size: 13pt; color: #C9A84C; font-style: italic; line-height: 1.9; }

  /* SOMMAIRE */
  .toc-page   { page-break-after: always; padding: 48pt 55pt; background: #fafaf8; }
  .toc-header { font-size: 11pt; text-transform: uppercase; letter-spacing: 0.3em; color: #C9A84C; margin-bottom: 24pt; padding-bottom: 10pt; border-bottom: 1pt solid #e8e0d0; }
  .toc-table  { width: 100%; }
  .toc-table td { vertical-align: top; padding-bottom: 14pt; }
  .toc-num    { width: 28pt; font-size: 12pt; color: #C9A84C; padding-top: 2pt; }
  .toc-label  { font-size: 14pt; color: #1a1a1a; line-height: 1.5; }
  .toc-type   { font-size: 11pt; text-transform: uppercase; letter-spacing: 0.15em; color: #aaaaaa; margin-top: 2pt; }

  /* ACTIVITE */
  .activity-page    { padding: 42pt 52pt 16pt 52pt; }
  .activity-header  { margin-bottom: 20pt; padding-bottom: 12pt; border-bottom: 1pt solid #e8e0d0; }
  .activity-eyebrow { font-size: 10pt; text-transform: uppercase; letter-spacing: 0.3em; color: #C9A84C; margin-bottom: 6pt; }
  .activity-title   { font-size: 24pt; font-weight: 400; color: #0f0f0f; line-height: 1.2; margin-bottom: 6pt; }
  .activity-meta    { font-size: 12pt; color: #999999; font-style: italic; }
  .activity-desc    { margin-top: 8pt; font-size: 13pt; color: #666666; line-height: 1.85; font-style: italic; }

  /* CARTES DE CONTENU */
  .card            { margin-bottom: 12pt; padding: 10pt 14pt; border-radius: 5pt; }
  .card-gold       { border-left: 3pt solid #C9A84C; background: #faf8f2; }
  .card-teal       { border-left: 3pt solid #14b8a6; background: #f0faf9; }
  .card-blue       { border-left: 3pt solid #3b82f6; background: #f0f5ff; }
  .card-purple     { border-left: 3pt solid #a855f7; background: #f8f0ff; }
  .card-orange     { border-left: 3pt solid #f97316; background: #fff7f0; }
  .card-red        { border-left: 3pt solid #ef4444; background: #fff5f5; }
  .card-green      { border-left: 3pt solid #22c55e; background: #f0fff5; }
  .card-indigo     { border-left: 3pt solid #6366f1; background: #f3f1ff; }
  .card-default    { border-left: 3pt solid #dddddd; background: #fafafa; }

  .card-badge-row  { margin-bottom: 6pt; }
  .card-badge      { font-size: 10pt; text-transform: uppercase; letter-spacing: 0.12em; font-weight: 700; padding: 2pt 6pt; border-radius: 3pt; }
  .badge-gold      { color: #8a6a1a; background: #f3e6c0; border: 0.5pt solid #C9A84C; }
  .badge-teal      { color: #0f6b62; background: #d0f2ef; border: 0.5pt solid #14b8a6; }
  .badge-blue      { color: #1e40af; background: #dbeafe; border: 0.5pt solid #3b82f6; }
  .badge-purple    { color: #6b21a8; background: #ede9fe; border: 0.5pt solid #a855f7; }
  .badge-orange    { color: #9a3412; background: #fed7aa; border: 0.5pt solid #f97316; }
  .badge-red       { color: #991b1b; background: #fee2e2; border: 0.5pt solid #ef4444; }
  .badge-green     { color: #166534; background: #dcfce7; border: 0.5pt solid #22c55e; }
  .badge-indigo    { color: #3730a3; background: #e0e7ff; border: 0.5pt solid #6366f1; }
  .badge-default   { color: #555555; background: #eeeeee; border: 0.5pt solid #cccccc; }

  .card-heading    { font-size: 14pt; font-weight: 700; color: #1a1a1a; line-height: 1.3; margin-bottom: 7pt; }
  .card-body       { font-size: 13pt; color: #333333; line-height: 1.9; }
  .card-body p     { margin: 0 0 8pt 0; }
  .card-body strong{ color: #111111; font-weight: 700; }
  .card-body em    { color: #555555; font-style: italic; }

  .card-exercise   { margin-top: 8pt; padding: 8pt 11pt; border-radius: 4pt; }
  .ex-gold   { background: #f5ecce; }
  .ex-teal   { background: #cef0ec; }
  .ex-blue   { background: #d6e8fb; }
  .ex-purple { background: #ead6fb; }
  .ex-orange { background: #fde8d4; }
  .ex-red    { background: #fdd6d6; }
  .ex-green  { background: #d1fadf; }
  .ex-indigo { background: #dde0fb; }
  .ex-default{ background: #eeeeee; }
  .ex-label  { font-size: 10pt; text-transform: uppercase; letter-spacing: 0.15em; color: #888888; margin-bottom: 5pt; }
  .ex-body   { font-size: 13pt; color: #333333; line-height: 1.85; }

  .card-territory  { margin-bottom: 12pt; padding: 12pt 14pt; border: 1.5pt solid #a855f7; border-radius: 7pt; background: #faf5ff; }
  .territory-label { font-size: 10pt; text-transform: uppercase; letter-spacing: 0.2em; color: #a855f7; margin-bottom: 8pt; }
  .territory-table { width: 100%; }
  .territory-table td { vertical-align: top; padding-right: 10pt; padding-bottom: 8pt; }
  .territory-lbl   { font-size: 10pt; text-transform: uppercase; letter-spacing: 0.1em; color: #888888; margin-bottom: 2pt; }
  .territory-val   { font-size: 14pt; font-weight: 700; color: #1a1a1a; }
  .territory-sub   { font-size: 12pt; color: #a855f7; font-style: italic; margin-top: 2pt; }
  .territory-note  { margin-top: 8pt; padding: 8pt 12pt; border-left: 2.5pt solid #a855f7; background: #f3e8ff; font-size: 12pt; color: #4a4a4a; line-height: 1.8; }
  .territory-note strong { color: #7c3aed; }

  /* AUDIO */
  .audio-block { margin-top: 14pt; background: #f5f3ee; border-left: 2.5pt solid #C9A84C; padding: 10pt 14pt; font-size: 12pt; color: #555555; line-height: 1.85; font-style: italic; }
  .audio-label { font-size: 10pt; text-transform: uppercase; letter-spacing: 0.2em; color: #C9A84C; font-style: normal; font-weight: 700; margin-bottom: 6pt; }

  /* NOTES */
  .notes-block { margin-top: 20pt; padding-top: 12pt; border-top: 1pt dashed #dddddd; }
  .notes-label { font-size: 10pt; text-transform: uppercase; letter-spacing: 0.2em; color: #cccccc; margin-bottom: 12pt; }
  .notes-line  { border-bottom: 0.5pt solid #e0e0e0; height: 26pt; margin-bottom: 3pt; }

  /* PAGE FINALE */
  .final-page   { page-break-before: always; background: #0f0f0f; color: #ffffff; text-align: center; padding: 90pt 55pt 55pt; }
  .final-school { font-size: 11pt; text-transform: uppercase; letter-spacing: 0.3em; color: #6a5830; margin-bottom: 22pt; }
  .final-title  { font-size: 28pt; color: #ffffff; font-weight: 300; line-height: 1.35; margin-bottom: 18pt; }
  .final-line   { width: 50pt; height: 1pt; background: #5a4a28; margin: 0 auto 26pt auto; }
  .final-body   { font-size: 13pt; color: #666666; font-style: italic; line-height: 2.1; }

  /* CONTENU RICHE — h3, blockquote, ul, table (fallback rich renderer) */
  .rich-content             { direction: ltr; unicode-bidi: embed; }
  .rich-content p          { font-size: 14pt; color: #333333; line-height: 1.9; margin: 0 0 9pt 0; }
  .rich-content strong     { font-weight: 700; color: #111111; }
  .rich-content em         { font-style: italic; color: #555555; }
  .rich-content h3         { font-size: 18pt; font-weight: 700; color: #1a1a1a; margin: 16pt 0 8pt 0; padding-bottom: 5pt; border-bottom: 1pt solid #e8e0d0; }
  .rich-content blockquote { margin: 9pt 0; padding: 10pt 14pt; background: #f9f5fe; border-left: 3pt solid #a855f7; font-size: 13pt; color: #5a5a5a; font-style: italic; line-height: 1.85; }
  .rich-content ul         { margin: 4pt 0 10pt 16pt; padding: 0; }
  .rich-content li         { font-size: 14pt; color: #333333; line-height: 1.9; margin-bottom: 5pt; }
  .rich-content table      { width: 100%; border-collapse: collapse; margin: 10pt 0; }
  .rich-content th         { background: #f5edd6; padding: 7pt 10pt; text-align: left; border-bottom: 2pt solid #c9a84c; color: #7a5a1a; font-size: 12pt; font-weight: 700; }
  .rich-content td         { padding: 6pt 10pt; border-bottom: 1pt solid #eeeeee; font-size: 13pt; color: #333333; vertical-align: top; }
  .rich-content .gold-box  { margin: 10pt 0; padding: 12pt 15pt; background: #faf8f0; border-left: 3pt solid #c9a84c; font-size: 13pt; line-height: 1.9; }
  .rich-content .teal-box  { margin: 10pt 0; padding: 12pt 15pt; background: #f0faf9; border-left: 3pt solid #14b8a6; font-size: 13pt; line-height: 1.9; }
</style>
</head>
<body>

@php
$pdfLang = $pdfLang ?? 'fr';
$pdfText = [
  'fr' => [
    'school' => 'Ecole Pause Souffle',
    'cover_eyebrow' => 'Formation Certifiante &middot; Praticien Pause Souffle',
    'personal_document' => 'Document personnel de',
    'rights' => 'Pause Souffle &middot; Tous droits reserves',
    'module_intention' => 'Intention du module',
    'intro_quote' => '"Un praticien qui se connait peut accueillir l\'autre pleinement."',
    'toc' => 'Sommaire',
    'activity_fallback' => 'Activite',
    'activity_label' => 'Activite',
    'source' => 'Source',
    'audio_script' => 'Script audio ElevenLabs',
    'notes' => 'Mes notes personnelles',
    'final_title' => 'Ce module<br>est maintenant en vous.',
    'final_confidential' => 'Ce document est personnel et confidentiel.',
    'final_program' => 'Il fait partie de votre parcours de formation certifiante Praticien Pause Souffle.',
    'final_done_by' => 'Formation realisee par',
    'footer_confidential' => 'Ecole Pause Souffle &middot; Confidentiel praticien',
    'page' => 'Page',
    'type_labels' => ['lecture' => 'Lecture', 'pratique' => 'Pratique', 'ecriture' => 'Ecriture', 'exercice' => 'Exercice', 'reflexion' => 'Reflexion'],
  ],
  'en' => [
    'school' => 'Pause Souffle School',
    'cover_eyebrow' => 'Certified Training &middot; Pause Souffle Practitioner',
    'personal_document' => 'Personal document for',
    'rights' => 'Pause Souffle &middot; All rights reserved',
    'module_intention' => 'Module intention',
    'intro_quote' => '"A practitioner who knows themselves can fully welcome the other."',
    'toc' => 'Table of contents',
    'activity_fallback' => 'Activity',
    'activity_label' => 'Activity',
    'source' => 'Source',
    'audio_script' => 'ElevenLabs audio script',
    'notes' => 'My personal notes',
    'final_title' => 'This module<br>now lives within you.',
    'final_confidential' => 'This document is personal and confidential.',
    'final_program' => 'It is part of your certified Pause Souffle Practitioner training journey.',
    'final_done_by' => 'Training completed by',
    'footer_confidential' => 'Pause Souffle School &middot; Practitioner confidential',
    'page' => 'Page',
    'type_labels' => ['lecture' => 'Reading', 'pratique' => 'Practice', 'ecriture' => 'Writing', 'exercice' => 'Exercise', 'reflexion' => 'Reflection'],
  ],
][$pdfLang];

$fnCleanText = function(?string $text): string {
  if ($text === null) return '';
  $text = html_entity_decode($text, ENT_QUOTES | ENT_HTML5, 'UTF-8');
  // Emojis non supportés par DomPDF, souvent rendus en '?'.
  $text = preg_replace('/[\x{1F300}-\x{1FAFF}\x{2600}-\x{27FF}\x{1F000}-\x{1F02F}]/u', '', $text);
  // Nettoie les '?' parasites placés avant la phrase.
  $text = preg_replace('/^\s*\?\s+/u', '', $text);
  $text = preg_replace('/([\-\|\x{00B7}])\s*\?\s+(?=\p{L})/u', '$1 ', $text);
  $text = preg_replace('/\s{2,}/u', ' ', $text);
  return trim($text);
};

$fnTypeLabel = function(?string $type) use ($pdfText): string {
  $type = $type ?? 'lecture';
  return $pdfText['type_labels'][$type] ?? ucfirst($type);
};
@endphp

{{-- PIED DE PAGE FIXE --}}
<div class="pdf-footer">
  <table><tr>
    <td class="fl">Formation Pause Souffle &mdash; {{ $fnCleanText($module->title) }}</td>
    <td class="fr">&nbsp;</td>
  </tr></table>
</div>

{{-- PAGE 1 : COUVERTURE --}}
<div class="cover">
  <div class="cover-school">{!! $pdfText['school'] !!}</div>
  <div class="cover-eyebrow">{!! $pdfText['cover_eyebrow'] !!}</div>
  <div class="cover-title">{{ $fnCleanText($module->title) }}</div>
  @if(!empty($module->week_label))
    <div class="cover-subtitle">{{ $fnCleanText($module->week_label) }}</div>
  @endif
  <div class="cover-line"></div>
  @if(!empty($module->description))
    <div class="cover-desc">{{ $fnCleanText($module->description) }}</div>
  @endif
  <div class="cover-user">{{ $pdfText['personal_document'] }} {{ $fnCleanText($user->first_name ?? $user->name) }}</div>
  <div class="cover-date">{!! $pdfText['rights'] !!} &middot; {{ date('Y') }}</div>
</div>

{{-- PAGE 2 : INTENTION --}}
@if(!empty($module->intro_text))
<div class="intro-page">
  <div class="intro-eyebrow">{{ $pdfText['module_intention'] }}</div>
  <div class="intro-body">
    @php $introLines = array_filter(explode("\n", $module->intro_text), fn($l) => trim($l) !== ''); @endphp
    @foreach($introLines as $line){{ $fnCleanText(trim($line)) }}<br>@endforeach
  </div>
  <div class="intro-quote">{!! $pdfText['intro_quote'] !!}</div>
</div>
@endif

{{-- PAGE 3 : SOMMAIRE --}}
<div class="toc-page">
  <div class="toc-header">{{ $pdfText['toc'] }}</div>
  <table class="toc-table">
  @foreach($activities as $i => $activity)
  <tr>
    <td class="toc-num">{{ $i + 1 }}</td>
    <td class="toc-label">
      {{ $fnCleanText($activity['title'] ?? ($pdfText['activity_fallback'] . ' ' . ($i + 1))) }}
      <div class="toc-type">{{ $fnCleanText($fnTypeLabel($activity['type'] ?? 'lecture')) }}@if(!empty($activity['duration'])) &middot; {{ $fnCleanText($activity['duration']) }}@endif</div>
    </td>
  </tr>
  @endforeach
  </table>
</div>

{{-- PAGES ACTIVITES --}}
@php
// ── Closures (évite la redéclaration si la vue est rendue plusieurs fois) ────

$fnColorKey = function(string $style): string {
    if (str_contains($style, '201,168,76'))  return 'gold';
    if (str_contains($style, '20,184,166'))  return 'teal';
    if (str_contains($style, '59,130,246'))  return 'blue';
    if (str_contains($style, '168,85,247'))  return 'purple';
    if (str_contains($style, '249,115,22'))  return 'orange';
    if (str_contains($style, '239,68,68'))   return 'red';
    if (str_contains($style, '34,197,94'))   return 'green';
    if (str_contains($style, '99,102,241'))  return 'indigo';
    return 'default';
};

$fnBuildParagraphs = function(string $html): string {
    $html = preg_replace('/<br\s*\/?>/i', "\n", $html);
    $html = preg_replace('/<\/(div|p|h[1-6]|li)>/i', "\n\n", $html);
    $html = preg_replace('/<strong[^>]*>/i', '<strong>', $html);
    $html = preg_replace('/<em[^>]*>/i',     '<em>',     $html);
    $html = strip_tags($html, '<strong><em>');
    $html = html_entity_decode($html, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $html = preg_replace('/[ \t]+/', ' ', $html);
    $html = preg_replace('/\n{3,}/', "\n\n", trim($html));
    $out  = '';
    foreach (explode("\n\n", $html) as $part) {
        $part = trim($part);
        if ($part === '') continue;
        $out .= '<p>' . implode('<br>', array_map('trim', explode("\n", $part))) . '</p>';
    }
    return $out;
};

$fnExtractExercise = function(string $html, string $colorKey) use ($fnBuildParagraphs): array {
    $results = [];
    preg_match_all('/<div[^>]*background[^>]*>(.*?)<\/div>/si', $html, $m);
    foreach ($m[1] as $block) {
        $label = '';
        if (preg_match('/<div[^>]*text-transform[^>]*>(.*?)<\/div>/si', $block, $lm)) {
            $label = trim(preg_replace('/[─\-]+/', '', strip_tags($lm[1])));
        }
        if ($label === '') continue;
        $body = preg_replace('/<div[^>]*text-transform[^>]*>.*?<\/div>/si', '', $block, 1);
        $cleanBody = $fnBuildParagraphs($body);
        if ($cleanBody !== '') {
            $results[] = ['label' => $label, 'body' => $cleanBody, 'color' => $colorKey];
        }
    }
    return $results;
};

$fnParseCards = function(string $raw) use ($fnColorKey, $fnBuildParagraphs, $fnExtractExercise): array {
    $cards = [];
    $pos   = 0;
    $len   = strlen($raw);

    while ($pos < $len) {
        $start = stripos($raw, '<div style="border-left:', $pos);
        if ($start === false) break;

        $styleEnd  = strpos($raw, '">', $start + 12);
        $styleAttr = substr($raw, $start + 12, $styleEnd - $start - 12);

        $openCount = 1;
        $cursor    = $styleEnd + 2;
        $cardHtml  = '';
        while ($openCount > 0 && $cursor < $len) {
            $nextOpen  = stripos($raw, '<div', $cursor);
            $nextClose = stripos($raw, '</div>', $cursor);
            if ($nextClose === false) break;
            if ($nextOpen !== false && $nextOpen < $nextClose) {
                $openCount++;
                $cursor = $nextOpen + 4;
            } else {
                $openCount--;
                if ($openCount === 0) {
                    $cardHtml = substr($raw, $start, $nextClose + 6 - $start);
                    $pos      = $nextClose + 6;
                    break;
                }
                $cursor = $nextClose + 6;
            }
        }
        if ($cardHtml === '') break;

        $colorKey = $fnColorKey($styleAttr);

        $badge = $heading = '';
        if (preg_match('/<h4[^>]*>.*?<span[^>]*>(.*?)<\/span>(.*?)<\/h4>/si', $cardHtml, $hm)) {
            $badge   = trim(strip_tags($hm[1]));
            $heading = trim(strip_tags($hm[2]));
        }

        $audio = '';
        if (preg_match_all('/<em>"(.*?)"<\/em>/si', $cardHtml, $am)) {
            $lastAm = end($am[1]);
            $audio  = trim(strip_tags(html_entity_decode($lastAm, ENT_QUOTES | ENT_HTML5, 'UTF-8')));
        }

        $bodyHtml     = preg_replace('/<h4[^>]*>.*?<\/h4>/si', '', $cardHtml);
        $bodyHtml     = preg_replace('/<div[^>]*border:1px dashed[^>]*>.*?<\/div>/si', '', $bodyHtml);
        $exercises    = $fnExtractExercise($bodyHtml, $colorKey);
        $mainBodyHtml = preg_replace('/<div[^>]*background[^>]*>.*?<\/div>/si', '', $bodyHtml);
        $cleanBody    = $fnBuildParagraphs($mainBodyHtml);

        $cards[] = [
            'color'     => $colorKey,
            'badge'     => $badge,
            'heading'   => $heading,
            'body'      => $cleanBody,
            'exercises' => $exercises,
            'audio'     => $audio,
            'territory' => [],
        ];
    }

    // Blocs territoire (border:2px solid ... border-radius:14px)
    preg_match_all('/<div[^>]*border:2px solid[^>]*border-radius:14px[^>]*>(.*?)<\/div>\s*(?=<\/div>|<div[^>]*border-left)/si', $raw, $tm);
    foreach ($tm[0] as $tBlock) {
        $colorKey = $fnColorKey($tBlock);
        $label    = '';
        if (preg_match('/letter-spacing[^>]*>(.*?)<\/div>/si', $tBlock, $llm)) {
            $label = trim(strip_tags($llm[1]));
        }
        $keyvals = [];
        preg_match_all('/<div[^>]*>(?:<div[^>]*>[^<]*<\/div>){1,2}<div[^>]*font-weight:800[^>]*>([^<]*)<\/div>(?:<div[^>]*>[^<]*<\/div>)?<\/div>/si', $tBlock, $kvM);
        foreach ($kvM[0] ?? [] as $kv) {
            preg_match('/<div[^>]*text-transform:uppercase[^>]*>(.*?)<\/div>/si', $kv, $km);
            preg_match('/<div[^>]*font-weight:800[^>]*>(.*?)<\/div>/si',          $kv, $vm);
            preg_match('/<div[^>]*font-style:italic[^>]*>(.*?)<\/div>/si',        $kv, $sm);
            if (!empty($km[1]) && !empty($vm[1])) {
                $keyvals[] = [
                    'key' => trim(strip_tags($km[1])),
                    'val' => trim(strip_tags($vm[1])),
                    'sub' => !empty($sm[1]) ? trim(strip_tags($sm[1])) : '',
                ];
            }
        }
        $note = '';
        if (preg_match('/<div[^>]*border-left[^>]*>(.*?)<\/div>/si', $tBlock, $nm)) {
            $noteHtml = preg_replace('/<strong[^>]*>/i', '<strong>', $nm[1]);
            $note     = strip_tags($noteHtml, '<strong>');
            $note     = html_entity_decode($note, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        }
        $cards[] = [
            'color' => $colorKey, 'badge' => '', 'heading' => '', 'body' => '',
            'exercises' => [], 'audio' => '',
            'territory' => ['label' => $label, 'keyvals' => $keyvals, 'note' => $note],
        ];
    }

    return $cards;
};

// ── Préprocesseur HTML pour rendu riche via DomPDF ─────────────────────────
// Convertit le HTML des activités (h3, blockquote, table, ul, gold-boxes)
// en HTML DomPDF-safe (sans rgba() inline, emoji filtrés).
$fnRichHtml = function(string $html): string {
    // 1. Emoji → vide (Georgia/DejaVu ne les affiche pas dans DomPDF)
    $html = preg_replace('/[\x{1F300}-\x{1FAFF}\x{2600}-\x{27FF}\x{1F000}-\x{1F02F}]/u', '', $html);

    // 2. Gold boxes : background rgba(201,168,76...) ou hex c9a84c → .gold-box
    $html = preg_replace_callback('/<div([^>]*)>/si', function($m) {
        $a = $m[1];
        if (str_contains($a, '201,168,76') || stripos($a, 'c9a84c') !== false) {
            return '<div class="gold-box">';
        }
        if (str_contains($a, '20,184,166') || stripos($a, '14b8a6') !== false) {
            return '<div class="teal-box">';
        }
        if (str_contains($a, 'rgba')) {
            return '<div>';
        }
        return $m[0];
    }, $html);

    // 3. Table : supprimer tous les styles inline (CSS .rich-content gère)
    $html = preg_replace('/<table[^>]*>/si',  '<table>', $html);
    $html = preg_replace('/<thead[^>]*>/si',  '<thead>', $html);
    $html = preg_replace('/<tbody[^>]*>/si',  '<tbody>', $html);
    $html = preg_replace('/<tr[^>]*>/si',     '<tr>',    $html);
    $html = preg_replace('/<th[^>]*>/si',     '<th>',    $html);
    $html = preg_replace('/<td[^>]*>/si',     '<td>',    $html);

    // 4. H3 inline styles → balise propre
    $html = preg_replace('/<h3[^>]*>/si', '<h3>', $html);
    $html = preg_replace('/<h4[^>]*>/si', '<h4>', $html);

    // 5. Blockquote → balise propre (CSS .rich-content gère le style violet)
    $html = preg_replace('/<blockquote[^>]*>/si', '<blockquote>', $html);

    // 6. UL / LI inline styles → balises propres
    $html = preg_replace('/<ul[^>]*>/si', '<ul>', $html);
    $html = preg_replace('/<li[^>]*>/si', '<li>', $html);

    // 7. Retire les '?' parasites en debut de ligne/bloc.
    $html = preg_replace('/>\s*\?\s+(?=\p{L})/u', '> ', $html);

    return $html;
};
@endphp

@foreach($activities as $i => $activity)
<div class="activity-page"@if(!$loop->first) style="page-break-before:always;"@endif>

  <div class="activity-header">
    <div class="activity-eyebrow">Module {{ $module->display_order ?? '00' }} &middot; {{ $pdfText['activity_label'] }} {{ $i + 1 }} / {{ count($activities) }}</div>
    <div class="activity-title">{{ $fnCleanText($activity['title'] ?? ($pdfText['activity_fallback'] . ' ' . ($i + 1))) }}</div>
    <div class="activity-meta">
      {{ $fnCleanText($fnTypeLabel($activity['type'] ?? 'lecture')) }}
      @if(!empty($activity['duration'])) &middot; {{ $fnCleanText($activity['duration']) }}@endif
      @if(!empty($activity['source'])) &middot; {{ $pdfText['source'] }} : {{ $fnCleanText($activity['source']) }}@endif
    </div>
    @if(!empty($activity['description']))<div class="activity-desc">{{ $fnCleanText($activity['description']) }}</div>@endif
  </div>

  @if(!empty($activity['content']))
    @php $cards = $fnParseCards($activity['content']); @endphp

    @foreach($cards as $card)

      @if(!empty($card['territory']))
        {{-- BLOC TERRITOIRE --}}
        @php $t = $card['territory']; @endphp
        <div class="card-territory">
          @if(!empty($t['label']))
            <div class="territory-label">{{ $fnCleanText($t['label']) }}</div>
          @endif
          @if(!empty($t['keyvals']))
            <table class="territory-table"><tr>
            @foreach($t['keyvals'] as $kv)
              <td>
                <div class="territory-lbl">{{ $fnCleanText($kv['key']) }}</div>
                <div class="territory-val">{{ $fnCleanText($kv['val']) }}</div>
                @if(!empty($kv['sub']))<div class="territory-sub">{{ $fnCleanText($kv['sub']) }}</div>@endif
              </td>
            @endforeach
            </tr></table>
          @endif
          @if(!empty($t['note']))
            <div class="territory-note">{!! $t['note'] !!}</div>
          @endif
        </div>

      @else
        {{-- CARTE STANDARD --}}
        @php $ck = $card['color']; @endphp
        <div class="card card-{{ $ck }}">

          @if(!empty($card['badge']) || !empty($card['heading']))
            <div class="card-badge-row">
              @if(!empty($card['badge']))<span class="card-badge badge-{{ $ck }}">{{ $fnCleanText($card['badge']) }}</span>@endif
            </div>
            @if(!empty($card['heading']))<div class="card-heading">{{ $fnCleanText($card['heading']) }}</div>@endif
          @endif

          @if(!empty($card['body']))
            <div class="card-body">{!! $card['body'] !!}</div>
          @endif

          @foreach($card['exercises'] as $ex)
            <div class="card-exercise ex-{{ $ex['color'] }}">
              <div class="ex-label">{{ $fnCleanText($ex['label']) }}</div>
              <div class="ex-body">{!! $ex['body'] !!}</div>
            </div>
          @endforeach

          @if(!empty($card['audio']))
            <div class="audio-block">
              <div class="audio-label">{{ $pdfText['audio_script'] }}</div>
              {{ $fnCleanText($card['audio']) }}
            </div>
          @endif

        </div>
      @endif

    @endforeach

    @if(empty($cards))
      {{-- Contenu riche (h3, blockquote, table, ul) — rendu HTML direct DomPDF --}}
      <div class="rich-content">{!! $fnRichHtml($activity['content']) !!}</div>
    @endif

  @endif

  <div class="notes-block">
    <div class="notes-label">{{ $pdfText['notes'] }}</div>
    @for($n = 0; $n < 5; $n++)<div class="notes-line"></div>@endfor
  </div>

</div>
@endforeach

{{-- PAGE FINALE --}}
<div class="final-page">
  <div class="final-school">{!! $pdfText['school'] !!}</div>
  <div class="final-title">{!! $pdfText['final_title'] !!}</div>
  <div class="final-line"></div>
  <div class="final-body">
    {{ $pdfText['final_confidential'] }}<br>
    {{ $pdfText['final_program'] }}<br><br>
    {{ $pdfText['final_done_by'] }} {{ $fnCleanText($user->first_name ?? $user->name) }} &middot; {{ date('Y') }}
  </div>
</div>

<script type="text/php">
if (isset($pdf) && isset($fontMetrics)) {
    $font = $fontMetrics->getFont('Georgia', 'normal');
    $size = 10;
    $text = '{{ $pdfText['page'] }} {PAGE_NUM} / {PAGE_COUNT}';
    $width = $fontMetrics->getTextWidth($text, $font, $size);
    $x = $pdf->get_width() - 46 - $width;
    $y = $pdf->get_height() - 18;
    $pdf->page_text($x, $y, $text, $font, $size, [0.79, 0.66, 0.30]);
}
</script>

</body>
</html>
