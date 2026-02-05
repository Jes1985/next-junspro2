<?php

namespace App\Services;

class HomeswapScoring
{
    /**
     * Calcule le score HomeSwap (0-100) et les points/nuit estimés (25-100)
     * 
     * @param mixed $item Model Eloquent ou array-like avec les champs homeswap_*
     * @return array ['score' => int, 'points_per_night' => int, 'breakdown' => array]
     */
    public static function computeHomeswapScore($item): array
    {
        // Convertir l'item en array si c'est un modèle Eloquent
        $data = is_object($item) && method_exists($item, 'toArray') 
            ? $item->toArray() 
            : (array) $item;
        
        // Helper pour récupérer une valeur avec fallback
        $get = function($key, $default = null) use ($data) {
            // Essayer homeswap_* d'abord (nouveaux champs)
            if (isset($data['homeswap_' . $key])) {
                return $data['homeswap_' . $key];
            }
            // Fallback sur anciens champs homeswap_* (compatibilité)
            $oldFieldMap = [
                'housing_type' => 'property_type',
                'sleep_capacity' => 'beds_real', // ou beds_real + beds_extra
                'has_balcony' => 'outdoor', // 'balcony' dans outdoor
                'has_terrace' => 'outdoor', // 'terrace' dans outdoor
                'has_garden' => 'outdoor', // 'garden' dans outdoor
                'parking_type' => 'parking',
                'has_pool' => 'pool', // 'none' vs autres
                'has_wifi' => 'wifi_quality', // 'basic|good|excellent'
                'has_heating' => 'climate', // 'heating|both'
                'has_ac' => 'climate', // 'ac|both'
            ];
            if (isset($oldFieldMap[$key]) && isset($data['homeswap_' . $oldFieldMap[$key]])) {
                $oldValue = $data['homeswap_' . $oldFieldMap[$key]];
                // Convertir les anciens formats
                return self::convertOldField($key, $oldValue);
            }
            // Fallback sur la clé directe
            if (isset($data[$key])) {
                return $data[$key];
            }
            return $default;
        };
        
        // A) LOGEMENT (15 points)
        $logementScore = self::calculateLogementScore($get);
        
        // B) CHAMBRES (20 points)
        $chambresScore = self::calculateChambresScore($get);
        
        // C) COUCHAGE (20 points)
        $couchageScore = self::calculateCouchageScore($get);
        
        // D) EXTÉRIEUR (10 points)
        $exterieurScore = self::calculateExterieurScore($get);
        
        // E) STATIONNEMENT (5 points)
        $stationnementScore = self::calculateStationnementScore($get);
        
        // F) PISCINE (5 points)
        $piscineScore = self::calculatePiscineScore($get);
        
        // G) CONFORT INTÉRIEUR (25 points)
        $confortScore = self::calculateConfortScore($get);
        
        // Total
        $totalScore = $logementScore + $chambresScore + $couchageScore + 
                     $exterieurScore + $stationnementScore + $piscineScore + $confortScore;
        
        // Clamp 0-100
        $score = max(0, min(100, $totalScore));
        
        // Points / nuit estimés (25-100)
        $pointsPerNight = round(25 + ($score * 0.75));
        $pointsPerNight = max(25, min(100, $pointsPerNight));
        
        return [
            'score' => (int) $score,
            'points_per_night' => (int) $pointsPerNight,
            'breakdown' => [
                'logement' => (int) $logementScore,
                'chambres' => (int) $chambresScore,
                'couchage' => (int) $couchageScore,
                'exterieur' => (int) $exterieurScore,
                'stationnement' => (int) $stationnementScore,
                'piscine' => (int) $piscineScore,
                'confort' => (int) $confortScore,
            ],
        ];
    }
    
    /**
     * A) LOGEMENT (15 points)
     * A1) Type logement (0-10) + A2) Localisation déclarative (0-5)
     */
    private static function calculateLogementScore($get): float
    {
        // A1) Type logement (0-10)
        $type = strtolower($get('housing_type', ''));
        $typeScores = [
            'room' => 4,
            'studio' => 6,
            'apartment' => 8,
            'house' => 10,
            'villa' => 10,
            'penthouse' => 10,
            'other' => 7,
        ];
        $typeScore = $typeScores[$type] ?? ($type ? 7 : 0);
        
        // A2) Localisation déclarative (0-5)
        $locationScore = 0;
        if ($get('near_transport', false)) $locationScore += 2;
        if ($get('near_shops', false)) $locationScore += 2;
        if ($get('quiet_area', false)) $locationScore += 1;
        $locationScore = min(5, $locationScore);
        
        return $typeScore + $locationScore;
    }
    
    /**
     * B) CHAMBRES (20 points)
     */
    private static function calculateChambresScore($get): float
    {
        $bedrooms = $get('bedrooms');
        
        if ($bedrooms === null) {
            return 10; // Fallback neutre
        }
        
        $bedrooms = (int) $bedrooms;
        
        if ($bedrooms === 0) return 0;
        if ($bedrooms === 1) return 8;
        if ($bedrooms === 2) return 12;
        if ($bedrooms === 3) return 16;
        if ($bedrooms >= 4) return 20;
        
        return 0;
    }
    
    /**
     * C) COUCHAGE (20 points)
     */
    private static function calculateCouchageScore($get): float
    {
        $sleepCapacity = $get('sleep_capacity');
        
        if ($sleepCapacity === null) {
            return 10; // Fallback neutre
        }
        
        $sleepCapacity = (int) $sleepCapacity;
        
        if ($sleepCapacity === 1) return 5;
        if ($sleepCapacity === 2) return 8;
        if ($sleepCapacity === 3) return 12;
        if ($sleepCapacity === 4) return 15;
        if ($sleepCapacity === 5) return 18;
        if ($sleepCapacity >= 6) return 20;
        
        return 0;
    }
    
    /**
     * D) EXTÉRIEUR (10 points)
     */
    private static function calculateExterieurScore($get): float
    {
        $score = 0;
        
        if ($get('has_balcony', false)) $score += 3;
        if ($get('has_terrace', false)) $score += 4;
        if ($get('has_garden', false)) $score += 6;
        
        return min(10, $score);
    }
    
    /**
     * E) STATIONNEMENT (5 points)
     */
    private static function calculateStationnementScore($get): float
    {
        $parkingType = strtolower($get('parking_type', 'none'));
        
        $scores = [
            'none' => 0,
            'street' => 2,
            'private' => 4,
            'garage' => 5,
        ];
        
        return $scores[$parkingType] ?? 0;
    }
    
    /**
     * F) PISCINE (5 points)
     */
    private static function calculatePiscineScore($get): float
    {
        return $get('has_pool', false) ? 5 : 0;
    }
    
    /**
     * G) CONFORT INTÉRIEUR (25 points)
     * G1) WIFI (0-10) + G2) CLIM/CHAUFFAGE (0-10) + G3) SDB (0-5)
     */
    private static function calculateConfortScore($get): float
    {
        // G1) WIFI (0-10)
        $wifiScore = $get('has_wifi', false) ? 10 : 0;
        
        // G2) CLIM/CHAUFFAGE (0-10)
        $hasHeating = $get('has_heating', false);
        $hasAc = $get('has_ac', false);
        
        $climateScore = 0;
        if ($hasHeating && $hasAc) {
            $climateScore = 10;
        } elseif ($hasHeating || $hasAc) {
            $climateScore = 6;
        }
        
        // G3) SDB (0-5)
        $bathrooms = $get('bathrooms');
        $bathroomScore = 3; // Fallback
        if ($bathrooms !== null) {
            $bathrooms = (int) $bathrooms;
            if ($bathrooms === 0) {
                $bathroomScore = 0;
            } elseif ($bathrooms === 1) {
                $bathroomScore = 3;
            } elseif ($bathrooms >= 2) {
                $bathroomScore = 5;
            }
        }
        
        return $wifiScore + $climateScore + $bathroomScore;
    }
    
    /**
     * Convertit les anciens champs vers les nouveaux formats
     */
    private static function convertOldField($newKey, $oldValue)
    {
        if ($oldValue === null) {
            return null;
        }
        
        switch ($newKey) {
            case 'sleep_capacity':
                // Si beds_real existe, l'utiliser
                return $oldValue; // beds_real est déjà la capacité
                
            case 'has_balcony':
                return strpos($oldValue, 'balcony') !== false;
                
            case 'has_terrace':
                return strpos($oldValue, 'terrace') !== false;
                
            case 'has_garden':
                return strpos($oldValue, 'garden') !== false;
                
            case 'parking_type':
                $map = [
                    'none' => 'none',
                    'nearby_easy' => 'street',
                    'private_spot' => 'private',
                    'garage' => 'garage',
                ];
                return $map[$oldValue] ?? 'none';
                
            case 'has_pool':
                return $oldValue !== 'none' && !empty($oldValue);
                
            case 'has_wifi':
                return !empty($oldValue) && $oldValue !== 'none';
                
            case 'has_heating':
                return in_array($oldValue, ['heating', 'both']);
                
            case 'has_ac':
                return in_array($oldValue, ['ac', 'both']);
                
            default:
                return $oldValue;
        }
    }
}
