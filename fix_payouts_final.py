#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
Fix payouts.blade.php encoding corruption.
The file was read with cp1252 then re-encoded as UTF-8.

Exact byte analysis:
- Ã‰ (U+00C9) -> stored as U+00C3 U+2030 (Ãƒâ€° where â€° is per-mille U+2030)
- â€” (U+2014) -> stored as U+00E2 U+20AC U+201D (Ã¢â‚¬")
- ðŸ‡«ðŸ‡· (flag) -> stored as U+00F0 U+0178 U+2021 U+00AB + same (Ã°Å¸â€¡Â«...)

Strategy: regex-replace all runs of cp1252-decodable chars, try UTF-8 decode on their bytes.
"""

import re

FILE = r"resources/views/frontend/freelance/settings/payouts.blade.php"

# Read as UTF-8 (file has BOM, Python will auto-strip with utf-8-sig)
with open(FILE, 'r', encoding='utf-8-sig') as f:
    content = f.read()

print(f"Read {len(content)} chars (BOM stripped)")

# Chars that have single-byte cp1252 encodings in range 0x80-0xFF
# (includes latin-1 range U+00A0-U+00FF plus cp1252 specials)
cp1252_special = (
    '\u20ac'  # 0x80 = â‚¬
    '\u201a'  # 0x82 = â€š
    '\u0192'  # 0x83 = Æ’
    '\u201e'  # 0x84 = â€ž
    '\u2026'  # 0x85 = â€¦
    '\u2020'  # 0x86 = â€ 
    '\u2021'  # 0x87 = â€¡
    '\u02c6'  # 0x88 = Ë†
    '\u2030'  # 0x89 = â€°
    '\u0160'  # 0x8a = Å 
    '\u2039'  # 0x8b = â€¹
    '\u0152'  # 0x8c = Å’
    '\u017d'  # 0x8e = Å½
    '\u2018'  # 0x91 = '  
    '\u2019'  # 0x92 = '
    '\u201c'  # 0x93 = "
    '\u201d'  # 0x94 = "
    '\u2022'  # 0x95 = â€¢
    '\u2013'  # 0x96 = â€“
    '\u2014'  # 0x97 = â€” (em-dash)
    '\u02dc'  # 0x98 = Ëœ
    '\u2122'  # 0x99 = â„¢
    '\u0161'  # 0x9a = Å¡
    '\u203a'  # 0x9b = â€º
    '\u0153'  # 0x9c = Å“
    '\u017e'  # 0x9e = Å¾
    '\u0178'  # 0x9f = Å¸
)

# Build a character class: latin-1 range (0x80-0xFF) plus cp1252 specials
latin1_range = ''.join(chr(i) for i in range(0x80, 0x100))
all_cp1252_chars = latin1_range + cp1252_special

# Regex: match runs of 2+ chars that can all be encoded as single cp1252 bytes
pattern = '[' + re.escape(all_cp1252_chars) + ']+'

def try_decode(match):
    s = match.group()
    try:
        b = s.encode('cp1252')
        decoded = b.decode('utf-8')
        # Only accept if the decoded string differs and doesn't contain replacement chars
        if decoded != s and '\ufffd' not in decoded:
            return decoded
    except (UnicodeEncodeError, UnicodeDecodeError):
        pass
    return s

# Apply the fix
content_fixed = re.sub(pattern, try_decode, content)

# Count changes
changes = sum(1 for a, b in zip(content, content_fixed) if a != b)
print(f"Characters changed: {changes}")
print(f"Length: {len(content)} -> {len(content_fixed)}")

# Now apply additional targeted replacements for the JS/HTML

# Replace the COUNTRIES array (still has f: fields with emoji)
COUNTRIES_BLOCK = r"var COUNTRIES = \[.*?\];"
COUNTRIES_NEW = "var COUNTRIES = [\n" + \
    "    // EUROPE / SEPA\n" + \
    "    {c:'FR',n:'France',                s:'IBAN (SEPA)',    t:'iban'},\n" + \
    "    {c:'DE',n:'Allemagne',             s:'IBAN (SEPA)',    t:'iban'},\n" + \
    "    {c:'ES',n:'Espagne',               s:'IBAN (SEPA)',    t:'iban'},\n" + \
    "    {c:'IT',n:'Italie',                s:'IBAN (SEPA)',    t:'iban'},\n" + \
    "    {c:'BE',n:'Belgique',              s:'IBAN (SEPA)',    t:'iban'},\n" + \
    "    {c:'NL',n:'Pays-Bas',              s:'IBAN (SEPA)',    t:'iban'},\n" + \
    "    {c:'PT',n:'Portugal',              s:'IBAN (SEPA)',    t:'iban'},\n" + \
    "    {c:'CH',n:'Suisse',                s:'IBAN (SEPA)',    t:'iban'},\n" + \
    "    {c:'AT',n:'Autriche',              s:'IBAN (SEPA)',    t:'iban'},\n" + \
    "    {c:'LU',n:'Luxembourg',            s:'IBAN (SEPA)',    t:'iban'},\n" + \
    "    {c:'IE',n:'Irlande',               s:'IBAN (SEPA)',    t:'iban'},\n" + \
    "    {c:'PL',n:'Pologne',               s:'IBAN (SEPA)',    t:'iban'},\n" + \
    "    {c:'SE',n:'Su\u00e8de',                s:'IBAN (SEPA)',    t:'iban'},\n" + \
    "    {c:'DK',n:'Danemark',              s:'IBAN (SEPA)',    t:'iban'},\n" + \
    "    {c:'NO',n:'Norv\u00e8ge',              s:'IBAN (SEPA)',    t:'iban'},\n" + \
    "    {c:'FI',n:'Finlande',              s:'IBAN (SEPA)',    t:'iban'},\n" + \
    "    {c:'CZ',n:'Tch\u00e9quie',             s:'IBAN (SEPA)',    t:'iban'},\n" + \
    "    {c:'HU',n:'Hongrie',               s:'IBAN (SEPA)',    t:'iban'},\n" + \
    "    {c:'RO',n:'Roumanie',              s:'IBAN (SEPA)',    t:'iban'},\n" + \
    "    {c:'SK',n:'Slovaquie',             s:'IBAN (SEPA)',    t:'iban'},\n" + \
    "    {c:'HR',n:'Croatie',               s:'IBAN (SEPA)',    t:'iban'},\n" + \
    "    {c:'SI',n:'Slov\u00e9nie',             s:'IBAN (SEPA)',    t:'iban'},\n" + \
    "    {c:'BG',n:'Bulgarie',              s:'IBAN (SEPA)',    t:'iban'},\n" + \
    "    {c:'GR',n:'Gr\u00e8ce',                s:'IBAN (SEPA)',    t:'iban'},\n" + \
    "    {c:'LT',n:'Lituanie',              s:'IBAN (SEPA)',    t:'iban'},\n" + \
    "    {c:'LV',n:'Lettonie',              s:'IBAN (SEPA)',    t:'iban'},\n" + \
    "    {c:'EE',n:'Estonie',               s:'IBAN (SEPA)',    t:'iban'},\n" + \
    "    {c:'CY',n:'Chypre',                s:'IBAN (SEPA)',    t:'iban'},\n" + \
    "    {c:'MT',n:'Malte',                 s:'IBAN (SEPA)',    t:'iban'},\n" + \
    "    // UK\n" + \
    "    {c:'GB',n:'Royaume-Uni',           s:'Sort Code / BACS', t:'sortcode'},\n" + \
    "    // MOYEN-ORIENT\n" + \
    "    {c:'AE',n:'\u00c9mirats arabes unis',  s:'IBAN',           t:'iban'},\n" + \
    "    {c:'SA',n:'Arabie saoudite',       s:'IBAN',           t:'iban'},\n" + \
    "    {c:'QA',n:'Qatar',                 s:'IBAN',           t:'iban'},\n" + \
    "    {c:'BH',n:'Bahre\u00efn',              s:'IBAN',           t:'iban'},\n" + \
    "    {c:'KW',n:'Kowe\u00eft',               s:'IBAN',           t:'iban'},\n" + \
    "    {c:'JO',n:'Jordanie',              s:'IBAN',           t:'iban'},\n" + \
    "    {c:'IL',n:'Isra\u00ebl',               s:'IBAN',           t:'iban'},\n" + \
    "    {c:'TR',n:'Turquie',               s:'IBAN',           t:'iban'},\n" + \
    "    {c:'LB',n:'Liban',                 s:'IBAN',           t:'iban'},\n" + \
    "    // AFRIQUE\n" + \
    "    {c:'MA',n:'Maroc',                 s:'IBAN',           t:'iban'},\n" + \
    "    {c:'TN',n:'Tunisie',               s:'IBAN',           t:'iban'},\n" + \
    "    {c:'DZ',n:'Alg\u00e9rie',               s:'IBAN',           t:'iban'},\n" + \
    "    {c:'MU',n:'\u00cele Maurice',           s:'IBAN',           t:'iban'},\n" + \
    "    {c:'CM',n:'Cameroun',              s:'IBAN',           t:'iban'},\n" + \
    "    {c:'SN',n:'S\u00e9n\u00e9gal',              s:'IBAN',           t:'iban'},\n" + \
    "    {c:'CI',n:\"C\u00f4te d'Ivoire\",       s:'IBAN',           t:'iban'},\n" + \
    "    {c:'GA',n:'Gabon',                 s:'IBAN',           t:'iban'},\n" + \
    "    // AMERIQUES\n" + \
    "    {c:'US',n:'\u00c9tats-Unis',           s:'ABA / ACH',      t:'ach'},\n" + \
    "    {c:'CA',n:'Canada',                s:'EFT',            t:'eft'},\n" + \
    "    {c:'MX',n:'Mexique',               s:'CLABE',          t:'clabe'},\n" + \
    "    {c:'BR',n:'Br\u00e9sil',               s:'PIX',            t:'pix'},\n" + \
    "    {c:'AR',n:'Argentine',             s:'CBU / CVU',      t:'generic'},\n" + \
    "    {c:'CO',n:'Colombie',              s:'Num\u00e9ro compte',  t:'generic'},\n" + \
    "    {c:'CL',n:'Chili',                 s:'Num\u00e9ro compte',  t:'generic'},\n" + \
    "    // ASIE\n" + \
    "    {c:'IN',n:'Inde',                  s:'IFSC / NEFT',    t:'ifsc'},\n" + \
    "    {c:'CN',n:'Chine',                 s:'Num\u00e9ro compte',  t:'generic'},\n" + \
    "    {c:'JP',n:'Japon',                 s:'Zengin',         t:'generic'},\n" + \
    "    {c:'AU',n:'Australie',             s:'BSB',            t:'bsb'},\n" + \
    "    {c:'NZ',n:'Nouvelle-Z\u00e9lande',    s:'BSB',            t:'bsb'},\n" + \
    "    {c:'SG',n:'Singapour',             s:'PayNow / FAST',  t:'generic'},\n" + \
    "    {c:'HK',n:'Hong Kong',             s:'FPS',            t:'generic'},\n" + \
    "    {c:'KR',n:'Cor\u00e9e du Sud',         s:'Num\u00e9ro compte',  t:'generic'},\n" + \
    "    {c:'TH',n:'Tha\u00eflande',             s:'PromptPay',      t:'generic'},\n" + \
    "    {c:'MY',n:'Malaisie',              s:'Num\u00e9ro compte',  t:'generic'},\n" + \
    "    {c:'ID',n:'Indon\u00e9sie',             s:'Num\u00e9ro compte',  t:'generic'},\n" + \
    "    {c:'PH',n:'Philippines',           s:'InstaPay',       t:'generic'},\n" + \
    "    {c:'PK',n:'Pakistan',              s:'IBAN',           t:'iban'},\n" + \
    "    {c:'BD',n:'Bangladesh',            s:'Num\u00e9ro compte',  t:'generic'},\n" + \
    "    {c:'VN',n:'Vi\u00eat Nam',              s:'Num\u00e9ro compte',  t:'generic'},\n" + \
    "  ];"

content_fixed = re.sub(COUNTRIES_BLOCK, COUNTRIES_NEW, content_fixed, flags=re.DOTALL)

# Add flagEmoji function before COUNTRIES
FLAG_FUNC = """/* Generate flag emoji from ISO 2-letter country code */
  function flagEmoji(cc) {
    var offset = 127397;
    return String.fromCodePoint(cc.charCodeAt(0) + offset) +
           String.fromCodePoint(cc.charCodeAt(1) + offset);
  }

  """
content_fixed = content_fixed.replace(
    '  var COUNTRIES = [',
    '  ' + FLAG_FUNC + 'var COUNTRIES = [',
    1  # Only first occurrence
)

# Remove icon field from THEMES (emojis in icon field)
content_fixed = re.sub(r",\s*icon:'[^']*'", '', content_fixed)

# Fix JS: c.f -> flagEmoji(c.c) (in renderDropdown)
content_fixed = content_fixed.replace(
    "'+c.f+'",
    "'+flagEmoji(c.c)+'"
)

# Fix JS: obj.f references (selectCountry, applyTheme)
content_fixed = content_fixed.replace(
    'chipFlag.textContent = obj.f;',
    'chipFlag.textContent = flagEmoji(obj.c);'
)
content_fixed = content_fixed.replace(
    'applyTheme(obj.t, obj.f);',
    'applyTheme(obj.t, flagEmoji(obj.c));'
)
content_fixed = content_fixed.replace(
    'bkFlag.textContent         = obj.f;',
    'bkFlag.textContent         = flagEmoji(obj.c);'
)

# Fix bkIcon - use fa icon instead of emoji
content_fixed = content_fixed.replace(
    "document.getElementById('bkIcon').textContent = th.icon;",
    "document.getElementById('bkIcon').innerHTML = '<i class=\"fas fa-university\"></i>';"
)

# Write back as UTF-8 without BOM
with open(FILE, 'w', encoding='utf-8', newline='\n') as f:
    f.write(content_fixed)

print("File written as UTF-8 without BOM.")

# Verify
with open(FILE, 'r', encoding='utf-8') as f:
    lines = f.readlines()
print(f"Total lines: {len(lines)}")
print(f"BOM check: first bytes = {open(FILE,'rb').read(3).hex()}")

# Check key lines
checks = [
    (218, '\u00c9tape'),         # Ã‰tape
    (473, 'S\u00e9curit\u00e9'), # SÃ©curitÃ©  
    (628, 'flagEmoji'),          # flagEmoji call in dropdown
    (693, 'flagEmoji'),          # flagEmoji call for chip
    (730, 'flagEmoji'),          # flagEmoji in bkFlag
    (762, 'D\u00e9tails'),       # DÃ©tails bancaires
    (792, 'IBAN attendu'),       # IBAN hint
]
print("\nVerification:")
for lineno, keyword in checks:
    if lineno <= len(lines):
        line = lines[lineno-1].rstrip()[:100]
        found = keyword in line
        print(f"  {'OK' if found else 'MISSING'} L{lineno}: {line}")
    else:
        print(f"  L{lineno}: (out of range, total={len(lines)})")

