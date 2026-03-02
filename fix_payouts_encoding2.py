#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
Fix remaining mojibake in payouts.blade.php.
PS5 used Windows-1252 (cp1252) to read UTF-8 bytes, then re-wrote as UTF-8.
Fix: read file as UTF-8, encode each char as cp1252 bytes, decode bytes as UTF-8.
"""

FILE = r"resources/views/frontend/freelance/settings/payouts.blade.php"

# Read file as current UTF-8
with open(FILE, 'r', encoding='utf-8') as f:
    content = f.read()

print(f"Read {len(content)} chars")
print(f"Sample (line 762): exists={chr(226)+chr(8364)+chr(8221) in content}")

def fix_mojibake_cp1252(text):
    """
    Undo the damage: each UTF-8 char that arrived via cp1252 re-encoding.
    For sequences where each Unicode char can be encoded as a single cp1252 byte,
    we collect those bytes and decode the whole sequence as UTF-8.
    """
    result = []
    i = 0
    while i < len(text):
        # Try to collect consecutive characters that are cp1252-encodable
        j = i
        buf = bytearray()
        # Lookahead: collect chars that have a single-byte cp1252 encoding
        while j < len(text):
            ch = text[j]
            try:
                b = ch.encode('cp1252')
                if len(b) == 1:
                    buf.append(b[0])
                    j += 1
                else:
                    break
            except (UnicodeEncodeError, ValueError):
                break
        
        if j > i and len(buf) >= 2:
            # Try to decode the collected bytes as UTF-8
            try:
                decoded = buf.decode('utf-8')
                # Check if the decoded string is "better" (more meaningful)
                # and doesn't contain replacement characters
                if '\ufffd' not in decoded and decoded != text[i:j]:
                    result.append(decoded)
                    i = j
                    continue
            except (UnicodeDecodeError, ValueError):
                pass
        
        # Default: keep original character
        result.append(text[i])
        i += 1
    
    return ''.join(result)

# Apply the fix
content_fixed = fix_mojibake_cp1252(content)

# Count how many chars changed
changed = sum(1 for a, b in zip(content, content_fixed) if a != b)
print(f"Characters changed: {changed}")
print(f"Length: {len(content)} -> {len(content_fixed)}")

# Verify some key strings
for check_orig, check_expected in [
    ('\u00e2\u20ac\u201d', '\u2014'),  # â€" -> —
    ('\u00e2\u20ac\u2022', '\u2022'),  # â€¢ -> •
    ('\u00c3\u00a9', '\u00e9'),        # Ã© -> é
]:
    if check_orig in content_fixed:
        print(f"WARNING: {repr(check_orig)} still present!")
    elif check_expected in content_fixed:
        print(f"OK: {repr(check_expected)} present")

# Write back as UTF-8 without BOM
with open(FILE, 'w', encoding='utf-8', newline='\n') as f:
    f.write(content_fixed)

print("File written successfully.")

# Show lines around key areas
with open(FILE, 'r', encoding='utf-8') as f:
    lines = f.readlines()
print(f"\nTotal lines: {len(lines)}")
print("\nLines 760-765:")
for i, ln in enumerate(lines[759:765], start=760):
    print(f"  L{i}: {ln.rstrip()}")
print("\nLines 470-476:")
for i, ln in enumerate(lines[469:476], start=470):
    print(f"  L{i}: {ln.rstrip()}")
print("\nLines 790-795:")
for i, ln in enumerate(lines[789:795], start=790):
    print(f"  L{i}: {ln.rstrip()}")
