#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
Fix encoding corruption in payouts.blade.php
The file was double-encoded: UTF-8 bytes were re-read as Latin-1 then saved as UTF-8 again.
Fix: read as latin-1, re-encode bytes to latin-1, decode as utf-8 to restore original text.
Then apply all text substitutions (remove f: emoji fields, add flagEmoji(), fix accents).
"""

import re

FILE = r"resources/views/frontend/freelance/settings/payouts.blade.php"

# Read file as latin-1 to get raw characters
with open(FILE, 'r', encoding='latin-1') as f:
    content = f.read()

# Try to undo double-encoding: encode back to latin-1 bytes, decode as utf-8
try:
    content_bytes = content.encode('latin-1', errors='replace')
    content = content_bytes.decode('utf-8', errors='replace')
    print("Double-encoding fix applied: latin-1 -> utf-8")
except Exception as e:
    print(f"Warning: {e}")

# ============================================================
# Now content should be proper UTF-8. Do all replacements.
# ============================================================

# 1. Replace the SCRIPT intro comment + COUNTRIES array
# Find the <script> opening and the var IBAN_LENGTHS that follows COUNTRIES

COUNTRIES_NEW = '''
  /* Generate flag emoji from ISO 2-letter country code (no emoji stored in file) */
  function flagEmoji(cc) {
    var offset = 127397;
    return String.fromCodePoint(cc.charCodeAt(0) + offset) +
           String.fromCodePoint(cc.charCodeAt(1) + offset);
  }

  var COUNTRIES = [
    // EUROPE / SEPA
    {c:'FR',n:'France',              s:'IBAN (SEPA)',    t:'iban'},
    {c:'DE',n:'Allemagne',           s:'IBAN (SEPA)',    t:'iban'},
    {c:'ES',n:'Espagne',             s:'IBAN (SEPA)',    t:'iban'},
    {c:'IT',n:'Italie',              s:'IBAN (SEPA)',    t:'iban'},
    {c:'BE',n:'Belgique',            s:'IBAN (SEPA)',    t:'iban'},
    {c:'NL',n:'Pays-Bas',            s:'IBAN (SEPA)',    t:'iban'},
    {c:'PT',n:'Portugal',            s:'IBAN (SEPA)',    t:'iban'},
    {c:'CH',n:'Suisse',              s:'IBAN (SEPA)',    t:'iban'},
    {c:'AT',n:'Autriche',            s:'IBAN (SEPA)',    t:'iban'},
    {c:'LU',n:'Luxembourg',          s:'IBAN (SEPA)',    t:'iban'},
    {c:'IE',n:'Irlande',             s:'IBAN (SEPA)',    t:'iban'},
    {c:'PL',n:'Pologne',             s:'IBAN (SEPA)',    t:'iban'},
    {c:'SE',n:'Suede',               s:'IBAN (SEPA)',    t:'iban'},
    {c:'DK',n:'Danemark',            s:'IBAN (SEPA)',    t:'iban'},
    {c:'NO',n:'Norvege',             s:'IBAN (SEPA)',    t:'iban'},
    {c:'FI',n:'Finlande',            s:'IBAN (SEPA)',    t:'iban'},
    {c:'CZ',n:'Tchequie',            s:'IBAN (SEPA)',    t:'iban'},
    {c:'HU',n:'Hongrie',             s:'IBAN (SEPA)',    t:'iban'},
    {c:'RO',n:'Roumanie',            s:'IBAN (SEPA)',    t:'iban'},
    {c:'SK',n:'Slovaquie',           s:'IBAN (SEPA)',    t:'iban'},
    {c:'HR',n:'Croatie',             s:'IBAN (SEPA)',    t:'iban'},
    {c:'SI',n:'Slovenie',            s:'IBAN (SEPA)',    t:'iban'},
    {c:'BG',n:'Bulgarie',            s:'IBAN (SEPA)',    t:'iban'},
    {c:'GR',n:'Grece',               s:'IBAN (SEPA)',    t:'iban'},
    {c:'LT',n:'Lituanie',            s:'IBAN (SEPA)',    t:'iban'},
    {c:'LV',n:'Lettonie',            s:'IBAN (SEPA)',    t:'iban'},
    {c:'EE',n:'Estonie',             s:'IBAN (SEPA)',    t:'iban'},
    {c:'CY',n:'Chypre',              s:'IBAN (SEPA)',    t:'iban'},
    {c:'MT',n:'Malte',               s:'IBAN (SEPA)',    t:'iban'},
    // UK
    {c:'GB',n:'Royaume-Uni',         s:'Sort Code / BACS', t:'sortcode'},
    // MOYEN-ORIENT
    {c:'AE',n:'Emirats arabes unis', s:'IBAN',           t:'iban'},
    {c:'SA',n:'Arabie saoudite',     s:'IBAN',           t:'iban'},
    {c:'QA',n:'Qatar',               s:'IBAN',           t:'iban'},
    {c:'BH',n:'Bahrein',             s:'IBAN',           t:'iban'},
    {c:'KW',n:'Koweit',              s:'IBAN',           t:'iban'},
    {c:'JO',n:'Jordanie',            s:'IBAN',           t:'iban'},
    {c:'IL',n:'Israel',              s:'IBAN',           t:'iban'},
    {c:'TR',n:'Turquie',             s:'IBAN',           t:'iban'},
    {c:'LB',n:'Liban',               s:'IBAN',           t:'iban'},
    // AFRIQUE
    {c:'MA',n:'Maroc',               s:'IBAN',           t:'iban'},
    {c:'TN',n:'Tunisie',             s:'IBAN',           t:'iban'},
    {c:'DZ',n:'Algerie',             s:'IBAN',           t:'iban'},
    {c:'MU',n:'Ile Maurice',         s:'IBAN',           t:'iban'},
    {c:'CM',n:'Cameroun',            s:'IBAN',           t:'iban'},
    {c:'SN',n:'Senegal',             s:'IBAN',           t:'iban'},
    {c:'CI',n:"Cote d'Ivoire",       s:'IBAN',           t:'iban'},
    {c:'GA',n:'Gabon',               s:'IBAN',           t:'iban'},
    // AMERIQUES
    {c:'US',n:'Etats-Unis',          s:'ABA / ACH',      t:'ach'},
    {c:'CA',n:'Canada',              s:'EFT',            t:'eft'},
    {c:'MX',n:'Mexique',             s:'CLABE',          t:'clabe'},
    {c:'BR',n:'Bresil',              s:'PIX',            t:'pix'},
    {c:'AR',n:'Argentine',           s:'CBU / CVU',      t:'generic'},
    {c:'CO',n:'Colombie',            s:'Numero compte',  t:'generic'},
    {c:'CL',n:'Chili',               s:'Numero compte',  t:'generic'},
    // ASIE
    {c:'IN',n:'Inde',                s:'IFSC / NEFT',    t:'ifsc'},
    {c:'CN',n:'Chine',               s:'Numero compte',  t:'generic'},
    {c:'JP',n:'Japon',               s:'Zengin',         t:'generic'},
    {c:'AU',n:'Australie',           s:'BSB',            t:'bsb'},
    {c:'NZ',n:'Nouvelle-Zelande',    s:'BSB',            t:'bsb'},
    {c:'SG',n:'Singapour',           s:'PayNow / FAST',  t:'generic'},
    {c:'HK',n:'Hong Kong',           s:'FPS',            t:'generic'},
    {c:'KR',n:'Coree du Sud',        s:'Numero compte',  t:'generic'},
    {c:'TH',n:'Thailande',           s:'PromptPay',      t:'generic'},
    {c:'MY',n:'Malaisie',            s:'Numero compte',  t:'generic'},
    {c:'ID',n:'Indonesie',           s:'Numero compte',  t:'generic'},
    {c:'PH',n:'Philippines',         s:'InstaPay',       t:'generic'},
    {c:'PK',n:'Pakistan',            s:'IBAN',           t:'iban'},
    {c:'BD',n:'Bangladesh',          s:'Numero compte',  t:'generic'},
    {c:'VN',n:'Viet Nam',            s:'Numero compte',  t:'generic'},
  ];'''

# Replace the entire COUNTRIES block using regex
# Match from "(function () {" opening to just before "var IBAN_LENGTHS"
content = re.sub(
    r'\(function \(\) \{.*?var COUNTRIES = \[.*?\];',
    '(function () {' + COUNTRIES_NEW,
    content,
    flags=re.DOTALL
)

# 2. Replace THEMES - remove icon field (all 9 lines have it)
content = re.sub(r",\s*icon:'[^']*'", '', content)

# 3. Fix JS: renderDropdown - c.f -> flagEmoji(c.c)
content = content.replace("'<span class=\"country-opt-flag\">'+c.f+'</span>'",
                          "'<span class=\"country-opt-flag\">'+flagEmoji(c.c)+'</span>'")

# 4. Fix JS: selectCountry - obj.f references
content = content.replace('chipFlag.textContent = obj.f;',
                          'chipFlag.textContent = flagEmoji(obj.c);')
content = content.replace('applyTheme(obj.t, obj.f);',
                          'applyTheme(obj.t, flagEmoji(obj.c));')
content = content.replace('bkFlag.textContent         = obj.f;',
                          'bkFlag.textContent         = flagEmoji(obj.c);')

# 5. Fix JS: 'Aucun pays trouvé' (was stored as UTF-8, may be correct now)
content = content.replace("Aucun pays trouv\u00e9", "Aucun pays trouv\u00e9")  # already correct after fix

# 6. Fix bullet characters in JS (• = U+2022)
# These were \u2022 originally, now restored. Just ensure they're correct.
# Replace any remaining corrupted bullet sequences with \u2022
content = re.sub(r'â€¢', '\u2022', content)

# 7. Fix JS: applyTheme title - "Détails bancaires — "
# After fix, these should be correct UTF-8. But replace via unicode just in case:
content = re.sub(r'D\u00e9tails bancaires \u2014 ', 'Details bancaires \u2014 ', content)
content = re.sub(r'D\u00e9tails bancaires \u2013 ', 'Details bancaires \u2013 ', content)

# 8. Fix bkIcon initialization - replace textContent with innerHTML (fa icon)
content = content.replace(
    "document.getElementById('bkIcon').textContent = th.icon;",
    "document.getElementById('bkIcon').innerHTML = '<i class=\"fas fa-university\"></i>';"
)

# 9. Fix remaining corrupted sequences that may still be in the file
# Run a second pass just to catch anything the utf-8 decode might have missed
fixes = [
    # HTML entities approach for accented chars in visible text
    ('\u00c9tape', '\u00c9tape'),   # Étape - keep as is (now proper UTF-8)
    ('Rechercher un pays\u2026', 'Rechercher un pays...'),
    ('\u2715', '\u00d7'),           # ✕ -> ×
    ('Coordonn\u00e9es bancaires enregistr\u00e9es', 'Coordonn\u00e9es bancaires enregistr\u00e9es'),
    ('D\u00e9tails bancaires', 'D\u00e9tails bancaires'),
]
# These are now proper UTF-8 so they should be fine.

# 10. remove any residual corrupted patterns (double-encoded leftovers)
# Check for any remaining â€" (which is the corrupted em-dash U+2014)
content = re.sub(r'â€"', '\u2014', content)
content = re.sub(r'â€™', '\u2019', content)
content = re.sub(r'â€˜', '\u2018', content)
content = re.sub(r'â€¦', '\u2026', content)
content = re.sub(r'Ã©', '\u00e9', content)
content = re.sub(r'Ã¨', '\u00e8', content)
content = re.sub(r'Ã ', '\u00e0', content)
content = re.sub(r'Ã¢', '\u00e2', content)
content = re.sub(r'Ã®', '\u00ee', content)
content = re.sub(r'Ã´', '\u00f4', content)
content = re.sub(r'Ã»', '\u00fb', content)
content = re.sub(r'Ã«', '\u00eb', content)
content = re.sub(r'Ã¯', '\u00ef', content)
content = re.sub(r'Ã\u00aa', '\u00ea', content)
content = re.sub(r'Ã‰', '\u00c9', content)
content = re.sub(r'Ã\u008e', '\u00ce', content)
content = re.sub(r'Ã\u008f', '\u00cf', content)
content = re.sub(r'Ã\u0080', '\u00c0', content)
content = re.sub(r'Â·', '\u00b7', content)
content = re.sub(r'Â«', '\u00ab', content)
content = re.sub(r'Â»', '\u00bb', content)

# Write result as proper UTF-8 (no BOM)
with open(FILE, 'w', encoding='utf-8', newline='\n') as f:
    f.write(content)

print(f"Done. File rewritten as UTF-8 without BOM.")

# Quick verification
with open(FILE, 'r', encoding='utf-8') as f:
    lines = f.readlines()
print(f"Lines: {len(lines)}")
# Show a sample to verify
for i, line in enumerate(lines[488:500], start=489):
    print(f"L{i}: {line}", end='')
