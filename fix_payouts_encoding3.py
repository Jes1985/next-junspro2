#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
Targeted replacement of remaining corrupted sequences in payouts.blade.php.
Uses explicit unicode escape sequences to avoid ambiguity.
"""

FILE = r"resources/views/frontend/freelance/settings/payouts.blade.php"

with open(FILE, 'r', encoding='utf-8') as f:
    content = f.read()

print(f"Read {len(content)} chars")

# Map: corrupted multi-byte sequence -> correct unicode
# Corrupted chars are PS5 cp1252-read then UTF-8-written sequences

replacements = [
    # em-dash — (U+2014) = UTF-8 E2 80 94
    # PS5 cp1252: E2->â, 80->€, 94->" (U+201D)
    ('\u00e2\u20ac\u201d', '\u2014'),
    # en-dash – (U+2013) = UTF-8 E2 80 93
    # PS5 cp1252: E2->â, 80->€, 93->" (U+201C)
    ('\u00e2\u20ac\u201c', '\u2013'),
    # bullet • (U+2022) = UTF-8 E2 80 A2
    # PS5 cp1252: E2->â, 80->€, A2->¢
    ('\u00e2\u20ac\u00a2', '\u2022'),
    # horizontal ellipsis … (U+2026) = UTF-8 E2 80 A6
    # PS5 cp1252: E2->â, 80->€, A6->¦
    ('\u00e2\u20ac\u00a6', '\u2026'),
    # left single quote ' (U+2018) = UTF-8 E2 80 98
    # PS5 cp1252: E2->â, 80->€, 98->˜
    ('\u00e2\u20ac\u02dc', '\u2018'),
    # right single quote ' (U+2019) = UTF-8 E2 80 99
    # PS5 cp1252: E2->â, 80->€, 99->™
    ('\u00e2\u20ac\u2122', '\u2019'),
    # left double quote " (U+201C) = UTF-8 E2 80 9C
    # PS5 cp1252: E2->â, 80->€, 9C->œ
    ('\u00e2\u20ac\u0153', '\u201c'),
    # right double quote " (U+201D) = UTF-8 E2 80 9D
    # PS5 cp1252: E2->â, 80->€, 9D->  (no cp1252 mapping for 9D -> U+009D control)
    # Actually cp1252 0x9D is unused -> U+009D control char
    # Let this one stay (rare in JS strings)

    # Box-drawing chars used in comments (cosmetic but fix anyway)
    # ╔ (U+2554) = UTF-8 E2 95 94 -> PS5: â(E2) ?(95->nothing valid in cp1252 note: 95=\x95=• U+2022 bullet!) Hmm
    # Actually let me not touch box drawing - they're only in comments

    # 🔒 U+1F512 = UTF-8 F0 9F 94 92
    # PS5 cp1252: F0->ð, 9F->Ÿ (U+0178), 94->" (U+201D), 92->' (U+2018)
    ('\u00f0\u0178\u201d\u2018', '&#x1F512;'),  # Use HTML entity since it's in HTML

    # ™ trademark that might appear
    ('\u00e2\u20ac\u2122', '\u2019'),  # Already covered above for '

    # ‒ figure dash if present
]

count = 0
for old, new in replacements:
    if old in content:
        n = content.count(old)
        content = content.replace(old, new)
        print(f"  Replaced {n}x {repr(old)} -> {repr(new)}")
        count += n
    else:
        print(f"  Not found: {repr(old)}")

print(f"\nTotal replacements: {count}")

# Write back
with open(FILE, 'w', encoding='utf-8', newline='\n') as f:
    f.write(content)

print("File written.")

# Verify
with open(FILE, 'r', encoding='utf-8') as f:
    lines = f.readlines()

print(f"Lines: {len(lines)}")
print("\nKey lines to verify:")
targets = [
    (218, "Étape 1"),
    (473, "Sécurité"),
    (627, "Aucun pays trouvé"),
    (724, "CLÉ PIX"),
    (762, "Details bancaires"),
    (792, "IBAN attendu"),
    (881, "sélectionner"),
]
for lineno, keyword in targets:
    line = lines[lineno-1].rstrip() if lineno <= len(lines) else "(out of range)"
    status = "✓" if keyword.lower() in line.lower() else "?"
    print(f"  [{status}] L{lineno}: {line[:100]}")
