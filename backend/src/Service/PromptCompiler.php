<?php

namespace App\Service;

use Symfony\Component\Uid\Uuid;

class PromptCompiler
{
    public const SCHEMA_VERSION = '1.0.0';

    public function compile(array $composition, ?string $compositionId = null, string $targetModelHint = 'FLUX_1_DEV'): array
    {
        $canonical = $this->normalizeCanonical($composition);
        $compositionId ??= Uuid::v4()->toRfc4122();
        $canonical = $this->applyOverrides($canonical, $composition['applied_overrides'] ?? []);

        return [
            'meta' => [
                'schema_version' => self::SCHEMA_VERSION,
                'composition_id' => $compositionId,
                'compiled_at' => (new \DateTimeImmutable('now', new \DateTimeZone('UTC')))->format(\DateTimeInterface::ATOM),
                'target_model_hint' => $targetModelHint,
            ],
            'canonical' => $canonical,
            'compiled_text' => $this->buildText($canonical, $targetModelHint),
        ];
    }

    private function normalizeCanonical(array $composition): array
    {
        $canonical = [];
        foreach (['character', 'outfit', 'pose', 'scene'] as $key) {
            if (isset($composition[$key])) {
                $canonical[$key] = $this->normalizeBlock($key, $composition[$key]);
            }
        }
        return $canonical;
    }

    private function normalizeBlock(string $key, array $block): array
    {
        if ($key === 'character') {
            foreach (['grooming' => 'current_grooming', 'makeup' => 'current_makeup'] as $canonical => $storage) {
                if (!isset($block[$canonical]) && isset($block[$storage])) {
                    $block[$canonical] = $block[$storage];
                }
            }
        }
        return $block;
    }

    private function applyOverrides(array $canonical, array $overrides): array
    {
        foreach ($overrides as $override) {
            $path = $override['target_path'] ?? null;
            $value = $override['overridden_value'] ?? ($override['value'] ?? null);
            if ($path === null || $value === null) {
                continue;
            }
            $this->setPath($canonical, $path, $value);
        }
        return $canonical;
    }

    private function setPath(array &$data, string $path, mixed $value): void
    {
        $keys = explode('.', $path);
        $ref = &$data;
        foreach ($keys as $i => $key) {
            if (!is_array($ref)) {
                return;
            }
            if ($i === count($keys) - 1) {
                $ref[$key] = $value;
                return;
            }
            $ref = &$ref[$key];
        }
    }

    private function buildText(array $canonical, string $target): string
    {
        $parts = [];
        if (isset($canonical['character'])) {
            $parts[] = $this->characterText($canonical['character']);
        }
        if (isset($canonical['outfit'])) {
            $parts[] = $this->outfitText($canonical['outfit']);
        }
        if (isset($canonical['pose'])) {
            $parts[] = $this->poseText($canonical['pose']);
        }
        if (isset($canonical['scene'])) {
            $parts[] = $this->sceneText($canonical['scene']);
        }

        return trim(implode(' ', $parts) . ' ' . $this->modelTail($target));
    }

    private function characterText(array $c): string
    {
        $gender = $this->label($c['gender'] ?? 'NON_BINARY');
        $age = (string) ($c['age'] ?? '');
        $ethnicity = $this->label($c['ethnicity'] ?? 'MULTIRACIAL');
        $subject = "Photorealistic portrait of a {$age}-year-old {$ethnicity} {$gender} model";

        $skin = $c['skin_profile'] ?? [];
        $skinText = '';
        if ($skin) {
            $fitz = $this->label($skin['fitzpatrick_scale'] ?? 'TYPE_I');
            $undertone = $this->label($skin['undertone'] ?? 'NEUTRAL');
            $finish = $this->label($skin['finish'] ?? 'NATURAL');
            $skinText = ", {$fitz} skin, {$undertone} undertone, {$finish} finish";
            if (!empty($skin['imperfections'])) {
                $imperfections = array_map([$this, 'label'], $skin['imperfections']);
                $skinText .= ', ' . implode(' and ', $imperfections);
            }
            if (isset($skin['freckle_density'])) {
                $skinText .= ', ' . $this->label($skin['freckle_density']) . ' freckles';
            }
        }

        $hair = $c['hair_profile'] ?? [];
        $hairText = '';
        if ($hair) {
            $type = $this->label($hair['andre_walker_type'] ?? 'TYPE_1');
            $density = $this->label($hair['density'] ?? 'MEDIUM');
            $porosity = $this->label($hair['porosity'] ?? 'MEDIUM');
            $hairline = $this->label($hair['hairline'] ?? 'STRAIGHT');
            $hairText = ", {$type} hair, {$density} density, {$porosity} porosity, {$hairline} hairline";
        }

        $eyes = $c['eye_profile'] ?? [];
        $eyesText = '';
        if ($eyes) {
            $eyeColor = $this->label($eyes['primary_color'] ?? 'BROWN');
            $lash = $this->label($eyes['eyelash_details'] ?? 'MEDIUM');
            $eyesText = ", {$eyeColor} almond-shaped eyes, {$lash} lashes";
        }

        $grooming = $c['grooming'] ?? ($c['current_grooming'] ?? []);
        $groomingText = '';
        if ($grooming) {
            $length = $this->label($grooming['hair_length'] ?? 'MEDIUM');
            $color = $this->colorText($grooming['hair_color_primary'] ?? null);
            $finish = $this->label($grooming['hair_finish'] ?? 'STYLED');
            $groomingText = ", {$length} {$color} hair, {$finish} finish";
            $facial = $grooming['facial_hair_style'] ?? null;
            if ($facial && $facial !== 'CLEAN_SHAVEN') {
                $groomingText .= ', ' . $this->label($facial);
            }
        }

        $makeup = $c['makeup'] ?? ($c['current_makeup'] ?? []);
        $makeupText = '';
        if ($makeup) {
            $style = $this->label($makeup['style_name'] ?? 'NO-Makeup Natural Glow');
            $makeupText = ", wearing {$style} makeup";
            $lipstick = $makeup['lipstick'] ?? null;
            if ($lipstick) {
                $lipFinish = $this->label($lipstick['finish'] ?? 'SATIIN');
                $lipColor = $this->colorText($lipstick['color'] ?? null);
                $makeupText .= ", {$lipFinish} lips in {$lipColor}";
            }
        }

        return trim("{$subject}{$skinText}{$hairText}{$eyesText}{$groomingText}{$makeupText}");
    }

    private function outfitText(array $o): string
    {
        $layers = $o['layers'] ?? [];
        if (!is_array($layers) || $layers === []) {
            $style = $this->label($o['style_category'] ?? 'CASUAL');
            return "Dressed in a {$style} style.";
        }
        $style = $this->label($o['style_category'] ?? 'CASUAL');
        $bits = [];
        foreach ($layers as $layer) {
            $g = $layer['garment'] ?? [];
            $fabric = $g['fabric'] ?? [];
            $material = $this->label($fabric['material'] ?? 'COTTON');
            $weight = $this->label($fabric['weight'] ?? 'MEDIUM');
            $name = $g['name'] ?? 'garment';
            $color = $this->colorText($g['primary_color'] ?? null);
            $pattern = isset($g['pattern']) ? $this->label($g['pattern']) : null;
            $fit = $this->label($g['fit'] ?? 'REGULAR');
            $segment = "{$material} {$weight} {$name} ({$color}";
            if ($pattern) {
                $segment .= ", {$pattern}";
            }
            $segment .= ", {$fit})";
            $bits[] = trim($segment);
        }
        return "Styled in a {$style} outfit: " . implode('; ', $bits) . '.';
    }

    private function poseText(array $p): string
    {
        $category = $this->label($p['category'] ?? 'HIGH_FASHION');
        $expression = $this->label($p['facial_expression'] ?? 'NEUTRAL');
        $bodyLanguage = $p['body_language'] ?? '';
        $intensity = isset($p['expression_intensity']) ? "intensity {$p['expression_intensity']}/10" : '';
        $framing = isset($p['required_framing']) ? $this->label($p['required_framing']) : 'medium shot';
        $camera = isset($p['camera_angle']) ? $this->label($p['camera_angle']) : '';
        $text = "Pose: {$category}. {$bodyLanguage}, {$expression} expression";
        if ($intensity) {
            $text .= ", {$intensity}";
        }
        $text .= ", framed as {$framing}";
        if ($camera) {
            $text .= ", shot from {$camera}";
        }
        return $text . '.';
    }

    private function sceneText(array $s): string
    {
        $env = $this->label($s['environment_type'] ?? 'URBAN');
        $location = $s['location_details'] ?? '';
        $text = "{$env} scene: {$location}";

        $lighting = $s['lighting'] ?? [];
        if ($lighting) {
            $setup = $this->label($lighting['setup_type'] ?? 'NATURAL');
            $temp = $this->label($lighting['color_temperature'] ?? 'DAYLIGHT');
            $dir = $this->label($lighting['key_light_direction'] ?? 'FRONT');
            $hard = $this->label($lighting['hardness'] ?? 'SOFT_DIFFUSED');
            $text .= ", lit by {$setup} light, {$temp} color temperature, {$dir} key light, {$hard} diffusion";
        }

        $camera = $s['camera_and_lens'] ?? [];
        if ($camera) {
            $focal = $this->label($camera['focal_length'] ?? 'LENS_85MM_PORTRAIT');
            $aperture = $this->label($camera['aperture'] ?? 'F_1_8');
            $dof = $this->label($camera['depth_of_field'] ?? 'SHALLOW_BOKEH');
            $grain = $this->label($camera['film_grain'] ?? 'SUBTLE_35MM');
            $text .= ", shot on {$focal} lens, {$aperture} aperture, {$dof}, {$grain} grain";
        }

        return $text . '.';
    }

    private function colorText(?array $palette): string
    {
        if (!$palette) {
            return 'natural color';
        }
        $name = $palette['color_name'] ?? null;
        $hex = $palette['hex_code'] ?? null;
        if ($name && $hex) {
            return "{$name} {$hex}";
        }
        return $name ?? 'natural color';
    }

    private function modelTail(string $target): string
    {
        return match (strtoupper((string) $target)) {
            'MIDJOURNEY', 'MIDJOURN' => '--ar 16:9 --style raw --v 6.0',
            'SDXL', 'STABLE_DIFFUSION_XL' => '--ar 16:9',
            'FLUX_1_DEV', 'FLUX' => '--ar 16:9 --style raw',
            default => '--ar 16:9 --style raw',
        };
    }

    private function label(string $token): string
    {
        $map = [
            'FEMALE' => 'woman', 'MALE' => 'man', 'NON_BINARY' => 'non-binary person', 'ANDROGYNOUS' => 'androgynous person',
            'CAUCASIAN' => 'Caucasian', 'EAST_ASIAN' => 'East Asian', 'AFRICAN' => 'African', 'HISPANIC' => 'Hispanic',
            'SOUTH_ASIAN' => 'South Asian', 'MIDDLE_EASTERN' => 'Middle Eastern', 'NATIVE_AMERICAN' => 'Native American', 'MULTIRACIAL' => 'mixed-race',
            'TYPE_I' => 'very fair', 'TYPE_II' => 'fair', 'TYPE_III' => 'medium', 'TYPE_IV' => 'olive', 'TYPE_V' => 'brown', 'TYPE_VI' => 'dark',
            'WARM_GOLDEN' => 'warm golden', 'COOL_ROSE' => 'cool rose', 'NEUTRAL' => 'neutral',
            'DEWY' => 'dewy', 'MATTE' => 'matte', 'LUMINOUS' => 'luminous', 'NATURAL' => 'natural',
            'SPARSE' => 'sparse', 'MODERATE' => 'moderate', 'DENSE' => 'dense',
            'TYPE_1' => 'straight', 'TYPE_2A' => 'wavy', 'TYPE_2B' => 'wavy', 'TYPE_3A' => 'curly', '4C_COILY' => 'coily',
            'STRAIGHT' => 'straight', 'MEDIUM' => 'medium', 'HIGH' => 'high', 'LOW' => 'low',
            'GREEN' => 'green', 'BROWN' => 'brown', 'BLUE' => 'blue', 'HAZEL' => 'hazel',
            'ALMOND' => 'almond', 'UPTURNED' => 'upturned', 'DOWNTURNED' => 'downturned',
            'LONG_DENSE' => 'long and dense', 'SHORT' => 'short',
            'LONG' => 'long', 'SHAVED' => 'shaved', 'STYLED' => 'styled', 'MESSY' => 'messy', 'WET_LOOK' => 'wet-look', 'GLOSSY' => 'glossy',
            'CLEAN_SHAVEN' => 'clean-shaven', 'STUBBLE' => 'stubble', 'FULL_BEARD' => 'full beard',
            'NO-Makeup Natural Glow' => 'no-makeup natural glow', 'EDITORIAL GLOSSY' => 'editorial glossy',
            'SATIIN' => 'satin', 'SATIN' => 'satin', 'GLOSS' => 'gloss', 'OMBRE' => 'ombre',
            'SMOKEY' => 'smokey', 'CUT_CREASE' => 'cut-crease', 'GRAPHIC' => 'graphic', 'CAT_EYE' => 'cat-eye', 'SIMPLE' => 'simple',
            'SOFT' => 'soft', 'STRONG' => 'strong',
            'ROUND' => 'round', 'OVAL' => 'oval', 'SQUARE' => 'square', 'STILETTO' => 'stiletto',
            'COTTON' => 'cotton', 'DENIM' => 'denim', 'SILK' => 'silk', 'WOOL' => 'wool', 'LEATHER' => 'leather', 'LINEN' => 'linen',
            'KNITTED' => 'knitted', 'TWILL' => 'twill', 'SUEDE' => 'suede', 'CHIFFON' => 'chiffon',
            'HEAVYWEIGHT' => 'heavyweight', 'MEDIUMWEIGHT' => 'medium-weight', 'LIGHTWEIGHT' => 'lightweight',
            'OPAQUE' => 'opaque', 'TRANSLUCENT' => 'translucent',
            'SOLID' => 'solid', 'STRIPED' => 'striped', 'PLAID' => 'plaid', 'CAMO' => 'camo', 'GRAPHIC_PRINT' => 'graphic print',
            'SKINNY' => 'skinny', 'SLIM' => 'slim', 'REGULAR' => 'regular', 'OVERSIZED' => 'oversized', 'TAILORED' => 'tailored',
            'STANDING' => 'standing', 'SITTING' => 'sitting', 'DYNAMIC_SPORT' => 'dynamic sport', 'DANCE' => 'dancing',
            'YOGA_FITNESS' => 'yoga/fitness', 'HIGH_FASHION' => 'high-fashion',
            'INTENSE_SMILE' => 'intense smile', 'SMIRK' => 'smirk', 'SERIOUS_LOOK' => 'serious look', 'NEUTRAL' => 'neutral',
            'CRYING' => 'crying', 'SCREAMING' => 'screaming',
            'CLOSE_UP' => 'close-up', 'MEDIUM_SHOT' => 'medium shot', 'FULL_BODY' => 'full body',
            'LOW_ANGLE' => 'low angle', 'EYE_LEVEL' => 'eye level', 'HIGH_ANGLE' => 'high angle', 'BIRD_EYE' => 'bird eye',
            'INDOR' => 'indoor', 'OUTDOOR' => 'outdoor', 'STUDIO' => 'studio', 'URBAN' => 'urban', 'NATURE' => 'natural setting', 'ABSTRACT' => 'abstract',
            'GOLDEN_HOUR' => 'golden hour', 'OVERCAST' => 'overcast', 'STUDIO_SOFTBOX' => 'studio softbox', 'NATURAL_WINDOW' => 'natural window light',
            'DAYLIGHT' => 'daylight', 'WARM_2700K' => 'warm 2700K', 'COOL_5600K' => 'cool 5600K',
            'FRONT' => 'front', 'SIDE_45' => 'side 45', 'BACK' => 'back',
            'SOFT_DIFFUSED' => 'soft diffused', 'HARD' => 'hard',
            'LENS_85MM_PORTRAIT' => '85mm portrait', 'LENS_50MM' => '50mm', 'LENS_35MM' => '35mm',
            'F_1_2' => 'f/1.2', 'F_1_4' => 'f/1.4', 'F_1_8' => 'f/1.8', 'F_2_8' => 'f/2.8', 'F_4' => 'f/4',
            'SHALLOW_BOKEH' => 'shallow depth of field, creamy bokeh', 'DEEP' => 'deep focus',
            'SUBTLE_35MM' => 'subtle 35mm grain', 'HEAVY_GRAIN' => 'heavy film grain', 'NONE' => 'no grain',
            'CASUAL' => 'casual', 'FORMAL' => 'formal', 'ATHLETIC' => 'athletic', 'TACTICAL' => 'tactical', 'PERIOD_COSTUME' => 'period costume',
            'TOP' => 'top', 'BOTTOM' => 'bottom', 'FULL_BODY' => 'full-body', 'FOOTWEAR' => 'footwear', 'HEADWEAR' => 'headwear', 'ACCESSORY' => 'accessory',
            'BASE_LAYER' => 'base layer', 'MID_LAYER' => 'mid layer', 'OUTER_LAYER' => 'outer layer',
            'FRECKLES' => 'freckles', 'MOLES' => 'moles', 'SPARSE' => 'sparse', 'MODERATE' => 'moderate', 'DENSE' => 'dense',
            'MESOCEPHALIC' => 'mesocephalic', 'BRADYCEPHALIC' => 'broad', 'DYSTRICPHALIC' => 'long-faced',
            'OVAL' => 'oval', 'ROUND' => 'round', 'SQUARE' => 'square', 'HEART' => 'heart-shaped',
            'SOFT' => 'soft', 'PROMINENT' => 'prominent', 'REFINED' => 'refined',
            'ATTACHED_LOBE' => 'attached lobes', 'FREE_LOBE' => 'free lobes',
            'THIN' => 'thin', 'MEDIUM' => 'medium', 'FULL' => 'full',
            'SMALL' => 'small', 'MEDIUM' => 'medium', 'LARGE' => 'large',
            'WIDE_SET' => 'wide-set', 'CLOSE_SET' => 'close-set', 'HOODED' => 'hooded',
            'STRAIGHT' => 'straight', 'CONTOURED' => 'natural', 'OVERSIZED' => 'oversized',
        ];

        $key = strtoupper((string) $token);
        if (isset($map[$key])) {
            return $map[$key];
        }

        // Tolerate namespace-style tokens, e.g. "CRANIAL_MORPHOLOGY.MESOCEPHALIC".
        if (str_contains($token, '.')) {
            $key = strtoupper((string) substr($token, strrpos($token, '.') + 1));
            if (isset($map[$key])) {
                return $map[$key];
            }
        }

        return trim(ucwords(strtolower(str_replace(['_', '.'], ' ', (string) $token))));
    }
}
