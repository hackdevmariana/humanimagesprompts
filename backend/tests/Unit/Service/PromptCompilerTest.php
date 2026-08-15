<?php

namespace App\Tests\Unit\Service;

use App\Service\PromptCompiler;
use PHPUnit\Framework\TestCase;

class PromptCompilerTest extends TestCase
{
    private PromptCompiler $compiler;

    protected function setUp(): void
    {
        $this->compiler = new PromptCompiler();
    }

    public function testCompileWithFullComposition(): void
    {
        $composition = [
            'character' => [
                'gender' => 'FEMALE',
                'age' => 26,
                'ethnicity' => 'CAUCASIAN',
                'skin_profile' => [
                    'fitzpatrick_scale' => 'TYPE_II',
                    'undertone' => 'WARM_GOLDEN',
                    'finish' => 'DEWY',
                    'imperfections' => ['FRECKLES'],
                    'freckle_density' => 'SPARSE',
                ],
                'hair_profile' => [
                    'andre_walker_type' => 'TYPE_2A',
                    'density' => 'MEDIUM',
                    'porosity' => 'MEDIUM',
                    'hairline' => 'STRAIGHT',
                ],
                'eye_profile' => [
                    'primary_color' => 'GREEN',
                    'eye_shape' => 'ALMOND',
                    'eyelash_details' => 'LONG_DENSE',
                ],
                'grooming' => [
                    'hairstyle_name' => 'Ondas Surferas',
                    'hair_length' => 'LONG',
                    'hair_color_primary' => ['color_name' => 'Warm Honey Blonde', 'hex_code' => '#E6C687'],
                    'hair_color_secondary' => null,
                    'hair_finish' => 'MATTE',
                    'facial_hair_style' => 'CLEAN_SHAVEN',
                ],
                'makeup' => [
                    'style_name' => 'No-Makeup Natural Glow',
                    'lipstick' => [
                        'color' => ['color_name' => 'Nude Rose', 'hex_code' => '#D8A399'],
                        'finish' => 'SATIN',
                    ],
                    'blush_and_contour' => ['definition' => 'SOFT', 'intensity' => 3],
                ],
            ],
            'outfit' => [
                'style_category' => 'HIGH_FASHION',
                'layers' => [
                    [
                        'slot' => 'OUTER_LAYER',
                        'garment' => [
                            'id' => 'test-id',
                            'name' => 'Chaqueta Denim Vintage',
                            'category' => 'TOP',
                            'sub_category' => 'Denim Jacket',
                            'fit' => 'OVERSIZED',
                            'fabric' => [
                                'material' => 'DENIM',
                                'weave' => 'TWILL',
                                'weight' => 'HEAVYWEIGHT',
                                'sheerness' => 'OPAQUE',
                            ],
                            'primary_color' => ['color_name' => 'Washed Indigo Blue', 'hex_code' => '#3B5998'],
                            'pattern' => 'SOLID',
                        ],
                    ],
                ],
            ],
            'pose' => [
                'category' => 'HIGH_FASHION',
                'body_language' => 'De pie, cuerpo inclinado ligeramente hacia atrás con una mano en la solapa.',
                'facial_expression' => 'SERIOUS_LOOK',
                'expression_intensity' => 6,
                'camera_angle' => 'EYE_LEVEL',
                'required_framing' => 'MEDIUM_SHOT',
            ],
            'scene' => [
                'environment_type' => 'URBAN',
                'location_details' => 'Calle peatonal del Soho de NY.',
                'lighting' => [
                    'setup_type' => 'GOLDEN_HOUR',
                    'color_temperature' => 'WARM_2700K',
                    'key_light_direction' => 'SIDE_45',
                    'hardness' => 'SOFT_DIFFUSED',
                ],
                'camera_and_lens' => [
                    'focal_length' => 'LENS_85MM_PORTRAIT',
                    'aperture' => 'F_1_8',
                    'depth_of_field' => 'SHALLOW_BOKEH',
                    'film_grain' => 'SUBTLE_35MM',
                ],
                'weather_and_atmosphere' => [
                    'weather' => 'CLEAR',
                    'time_of_day' => 'GOLDEN_HOUR',
                ],
            ],
        ];

        $result = $this->compiler->compile($composition, 'test-composition-id', 'FLUX_1_DEV');

        $this->assertArrayHasKey('meta', $result);
        $this->assertArrayHasKey('canonical', $result);
        $this->assertArrayHasKey('compiled_text', $result);

        $this->assertEquals('1.0.0', $result['meta']['schema_version']);
        $this->assertEquals('test-composition-id', $result['meta']['composition_id']);
        $this->assertEquals('FLUX_1_DEV', $result['meta']['target_model_hint']);
        $this->assertNotEmpty($result['meta']['compiled_at']);

        $this->assertArrayHasKey('character', $result['canonical']);
        $this->assertArrayHasKey('outfit', $result['canonical']);
        $this->assertArrayHasKey('pose', $result['canonical']);
        $this->assertArrayHasKey('scene', $result['canonical']);

        $this->assertIsString($result['compiled_text']);
        $this->assertStringContainsString('Photorealistic portrait', $result['compiled_text']);
        $this->assertStringContainsString('26-year-old Caucasian woman', $result['compiled_text']);
        $this->assertStringContainsString('Warm Honey Blonde', $result['compiled_text']);
        $this->assertStringContainsString('Chaqueta Denim Vintage', $result['compiled_text']);
        $this->assertStringContainsString('Washed Indigo Blue', $result['compiled_text']);
        $this->assertStringContainsString('Soho de NY', $result['compiled_text']);
        $this->assertStringContainsString('--ar 16:9 --style raw', $result['compiled_text']);
    }

    public function testCompileWithMinimalComposition(): void
    {
        $composition = [
            'character' => [
                'gender' => 'MALE',
                'age' => 30,
                'ethnicity' => 'ASIAN',
            ],
            'outfit' => [
                'style_category' => 'CASUAL',
                'layers' => [],
            ],
            'pose' => [
                'category' => 'STANDING',
                'body_language' => 'Standing',
                'facial_expression' => 'NEUTRAL',
                'expression_intensity' => 5,
                'required_framing' => 'MEDIUM_SHOT',
            ],
            'scene' => [
                'environment_type' => 'STUDIO',
                'location_details' => 'Photo studio',
            ],
        ];

        $result = $this->compiler->compile($composition);

        $this->assertArrayHasKey('compiled_text', $result);
        $this->assertStringContainsString('30-year-old Asian man', $result['compiled_text']);
        $this->assertStringContainsString('Photo studio', $result['compiled_text']);
    }

    public function testCompileWithMidjourneyTarget(): void
    {
        $composition = [
            'character' => ['gender' => 'FEMALE', 'age' => 25, 'ethnicity' => 'CAUCASIAN'],
            'outfit' => ['style_category' => 'CASUAL', 'layers' => []],
            'pose' => ['category' => 'STANDING', 'body_language' => 'Standing', 'facial_expression' => 'NEUTRAL', 'expression_intensity' => 5, 'required_framing' => 'MEDIUM_SHOT'],
            'scene' => ['environment_type' => 'URBAN', 'location_details' => 'City street'],
        ];

        $result = $this->compiler->compile($composition, 'test-id', 'MIDJOURNEY');

        $this->assertEquals('MIDJOURNEY', $result['meta']['target_model_hint']);
        $this->assertStringContainsString('--ar 16:9 --style raw --v 6.0', $result['compiled_text']);
    }

    public function testCompileWithSdXlTarget(): void
    {
        $composition = [
            'character' => ['gender' => 'FEMALE', 'age' => 25, 'ethnicity' => 'CAUCASIAN'],
            'outfit' => ['style_category' => 'CASUAL', 'layers' => []],
            'pose' => ['category' => 'STANDING', 'body_language' => 'Standing', 'facial_expression' => 'NEUTRAL', 'expression_intensity' => 5, 'required_framing' => 'MEDIUM_SHOT'],
            'scene' => ['environment_type' => 'URBAN', 'location_details' => 'City street'],
        ];

        $result = $this->compiler->compile($composition, 'test-id', 'SDXL');

        $this->assertEquals('SDXL', $result['meta']['target_model_hint']);
        $this->assertStringContainsString('--ar 16:9', $result['compiled_text']);
    }

    public function testCompileWithFluxTarget(): void
    {
        $composition = [
            'character' => ['gender' => 'FEMALE', 'age' => 25, 'ethnicity' => 'CAUCASIAN'],
            'outfit' => ['style_category' => 'CASUAL', 'layers' => []],
            'pose' => ['category' => 'STANDING', 'body_language' => 'Standing', 'facial_expression' => 'NEUTRAL', 'expression_intensity' => 5, 'required_framing' => 'MEDIUM_SHOT'],
            'scene' => ['environment_type' => 'URBAN', 'location_details' => 'City street'],
        ];

        $result = $this->compiler->compile($composition, 'test-id', 'FLUX_1_DEV');

        $this->assertEquals('FLUX_1_DEV', $result['meta']['target_model_hint']);
        $this->assertStringContainsString('--ar 16:9 --style raw', $result['compiled_text']);
    }

    public function testCompileGeneratesUniqueCompositionId(): void
    {
        $composition = [
            'character' => ['gender' => 'FEMALE', 'age' => 25, 'ethnicity' => 'CAUCASIAN'],
            'outfit' => ['style_category' => 'CASUAL', 'layers' => []],
            'pose' => ['category' => 'STANDING', 'body_language' => 'Standing', 'facial_expression' => 'NEUTRAL', 'expression_intensity' => 5, 'required_framing' => 'MEDIUM_SHOT'],
            'scene' => ['environment_type' => 'URBAN', 'location_details' => 'City street'],
        ];

        $result1 = $this->compiler->compile($composition);
        $result2 = $this->compiler->compile($composition);

        $this->assertNotEquals($result1['meta']['composition_id'], $result2['meta']['composition_id']);
        $this->assertMatchesRegularExpression('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/i', $result1['meta']['composition_id']);
    }

    public function testNormalizeCanonicalHandlesGroomingFallback(): void
    {
        $composition = [
            'character' => [
                'gender' => 'FEMALE',
                'age' => 25,
                'ethnicity' => 'CAUCASIAN',
                'current_grooming' => [
                    'hairstyle_name' => 'Test Style',
                    'hair_length' => 'SHORT',
                ],
            ],
        ];

        $reflection = new \ReflectionClass($this->compiler);
        $method = $reflection->getMethod('normalizeCanonical');
        $method->setAccessible(true);

        $canonical = $method->invoke($this->compiler, $composition);

        $this->assertArrayHasKey('grooming', $canonical['character']);
        $this->assertEquals('Test Style', $canonical['character']['grooming']['hairstyle_name']);
    }

    public function testNormalizeCanonicalHandlesMakeupFallback(): void
    {
        $composition = [
            'character' => [
                'gender' => 'FEMALE',
                'age' => 25,
                'ethnicity' => 'CAUCASIAN',
                'current_makeup' => [
                    'style_name' => 'Test Makeup',
                ],
            ],
        ];

        $reflection = new \ReflectionClass($this->compiler);
        $method = $reflection->getMethod('normalizeCanonical');
        $method->setAccessible(true);

        $canonical = $method->invoke($this->compiler, $composition);

        $this->assertArrayHasKey('makeup', $canonical['character']);
        $this->assertEquals('Test Makeup', $canonical['character']['makeup']['style_name']);
    }

    public function testApplyOverrides(): void
    {
        $canonical = [
            'character' => [
                'age' => 25,
                'skin_profile' => ['fitzpatrick_scale' => 'TYPE_II'],
            ],
        ];

        $overrides = [
            ['target_path' => 'character.age', 'value' => 30],
            ['target_path' => 'character.skin_profile.fitzpatrick_scale', 'value' => 'TYPE_III'],
        ];

        $reflection = new \ReflectionClass($this->compiler);
        $method = $reflection->getMethod('applyOverrides');
        $method->setAccessible(true);

        $result = $method->invoke($this->compiler, $canonical, $overrides);

        $this->assertEquals(30, $result['character']['age']);
        $this->assertEquals('TYPE_III', $result['character']['skin_profile']['fitzpatrick_scale']);
    }

    public function testBuildTextHandlesMissingOptionalFields(): void
    {
        $canonical = [
            'character' => [
                'gender' => 'FEMALE',
                'age' => 25,
                'ethnicity' => 'CAUCASIAN',
            ],
            'outfit' => ['style_category' => 'CASUAL', 'layers' => []],
            'pose' => ['category' => 'STANDING', 'body_language' => 'Standing', 'facial_expression' => 'NEUTRAL', 'expression_intensity' => 5, 'required_framing' => 'MEDIUM_SHOT'],
            'scene' => ['environment_type' => 'STUDIO', 'location_details' => 'Studio'],
        ];

        $reflection = new \ReflectionClass($this->compiler);
        $method = $reflection->getMethod('buildText');
        $method->setAccessible(true);

        $text = $method->invoke($this->compiler, $canonical, 'FLUX_1_DEV');

        $this->assertIsString($text);
        $this->assertStringContainsString('25-year-old Caucasian woman', $text);
        $this->assertStringContainsString('studio scene', $text);
    }
}