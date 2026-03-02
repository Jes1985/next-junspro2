#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
Analyze the exact byte encoding of payouts.blade.php
to determine the correct fix strategy.
"""
FILE = r"resources/views/frontend/freelance/settings/payouts.blade.php"

# Read as raw bytes
with open(FILE, 'rb') as f:
    raw = f.read()

print(f"File size: {len(raw)} bytes")
print(f"BOM: {raw[:4].hex()}")
print(f"First 4 bytes: {raw[:4]}")

# Try to detect encoding
import chardet
result = chardet.detect(raw)
print(f"Chardet result: {result}")

# Find the position of "France" in the raw bytes to understand the context
pos_france = raw.find(b'France')
if pos_france >= 0:
    print(f"\n'France' found at byte {pos_france}")
    print(f"Surrounding bytes (-10 to +20): {raw[pos_france-10:pos_france+20].hex()}")
    print(f"As string: {raw[pos_france-10:pos_france+20]}")

# Find position of known corrupted char sequence near COUNTRIES
# â€" should be in CSS comment around line 5-6
pos_dash = raw.find(b'\xe2\x80\x94')  # em-dash as UTF-8
pos_dash_cp = raw.find(b'\xe2\x80\x9d')  # em-dash corrupted as UTF-8 of cp1252
print(f"\nUTF-8 em-dash (E2 80 94) at: {pos_dash}")
print(f"UTF-8 right-quote (E2 80 9D) at: {pos_dash_cp}")

# Read as UTF-8 and check what we see near line 6
try:
    content_utf8 = raw.decode('utf-8', errors='replace')
    lines = content_utf8.split('\n')
    print(f"\nLine 6 as UTF-8: {repr(lines[5][:80])}")
    print(f"Line 219 as UTF-8: {repr(lines[218][:80])}")
except Exception as e:
    print(f"UTF-8 decode error: {e}")

# Try as cp1252
try:
    content_cp = raw.decode('cp1252', errors='replace')
    lines2 = content_cp.split('\n')
    print(f"\nLine 6 as CP1252: {repr(lines2[5][:80])}")
except Exception as e:
    print(f"CP1252 decode error: {e}")

# Check a few key byte offsets
# Find 'tape' (would be in 'Étape' - 'É' = U+00C9)
for encoding in ['utf-8', 'cp1252', 'latin-1']:
    try:
        text = raw.decode(encoding, errors='replace')
        etape_pos = text.find('\u00c9tape')  # Étape
        if etape_pos >= 0:
            print(f"\n'{encoding}' finds 'Étape' at char {etape_pos}")
            # What bytes correspond to this position?
            byte_pos = len(text[:etape_pos].encode(encoding, errors='replace'))
            print(f"  Bytes: {raw[byte_pos:byte_pos+10].hex()}")
        else:
            print(f"\n'{encoding}': 'Étape' NOT found")
    except Exception as e:
        print(f"{encoding}: {e}")

# Try to find what the file ACTUALLY shows for the É character
print("\n\nSearching for 'tape 1' pattern to find Étape:")
idx = 0
while True:
    pos = raw.find(b'tape 1', idx)
    if pos < 0: break
    print(f"  'tape 1' at byte {pos}: context bytes = {raw[pos-5:pos+8].hex()}")
    print(f"  Context as latin-1: {raw[pos-5:pos+8].decode('latin-1')}")
    idx = pos + 1
