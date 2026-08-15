<?php

namespace App\Tests\Unit\Entity;

use App\Entity\Character;
use App\Entity\Garment;
use App\Entity\Outfit;
use App\Entity\Pose;
use App\Entity\Scene;
use App\Entity\Lighting;
use App\Entity\GarmentSlot;
use App\Entity\PromptComposition;
use App\Enum\CompositionStatusEnum;
use PHPUnit\Framework\TestCase;

class EntityTest extends TestCase
{
    public function testCharacterEntity(): void
    {
        $character = new Character();
        $character->setName('Test Character');
        $character->setIsPublic(true);
        $character->setGender('FEMALE');
        $character->setAge(25);
        $character->setEthnicity('CAUCASIAN');
        $character->setCranialMorphology(['morphology' => 'MESOCEPHALIC']);
        $character->setSkinProfile([
            'fitzpatrick_scale' => 'TYPE_II',
            'undertone' => 'WARM_GOLDEN',
            'finish' => 'DEWY',
            'imperfections' => ['FRECKLES'],
            'freckle_density' => 'SPARSE',
        ]);
        $character->setHairProfile([
            'andre_walker_type' => 'TYPE_2A',
            'density' => 'MEDIUM',
            'porosity' => 'MEDIUM',
            'hairline' => 'STRAIGHT',
        ]);
        $character->setEyeProfile([
            'primary_color' => 'GREEN',
            'eye_shape' => 'ALMOND',
            'eyelash_details' => 'LONG_DENSE',
        ]);
        $character->setCurrentGrooming([
            'hairstyle_name' => 'Ondas Surferas',
            'hair_length' => 'LONG',
            'hair_color_primary' => ['color_name' => 'Warm Honey Blonde', 'hex_code' => '#E6C687'],
            'hair_color_secondary' => null,
            'hair_finish' => 'MATTE',
            'facial_hair_style' => 'CLEAN_SHAVEN',
        ]);
        $character->setCurrentMakeup([
            'style_name' => 'No-Makeup Natural Glow',
            'lipstick' => [
                'color' => ['color_name' => 'Nude Rose', 'hex_code' => '#D8A399'],
                'finish' => 'SATIN',
            ],
            'blush_and_contour' => ['definition' => 'SOFT', 'intensity' => 3],
        ]);
        $character->setFacialFeatures([]);

        $this->assertEquals('Test Character', $character->getName());
        $this->assertTrue($character->isPublic());
        $this->assertEquals('FEMALE', $character->getGender());
        $this->assertEquals(25, $character->getAge());
        $this->assertEquals('CAUCASIAN', $character->getEthnicity());
        $this->assertEquals(['morphology' => 'MESOCEPHALIC'], $character->getCranialMorphology());
        $this->assertEquals('TYPE_II', $character->getSkinProfile()['fitzpatrick_scale']);
        $this->assertEquals('TYPE_2A', $character->getHairProfile()['andre_walker_type']);
        $this->assertEquals('GREEN', $character->getEyeProfile()['primary_color']);
        $this->assertEquals('Ondas Surferas', $character->getCurrentGrooming()['hairstyle_name']);
        $this->assertEquals('No-Makeup Natural Glow', $character->getCurrentMakeup()['style_name']);
    }

    public function testGarmentEntity(): void
    {
        $garment = new Garment();
        $garment->setName('Test Jacket');
        $garment->setCategory('TOP');
        $garment->setSubCategory('Denim Jacket');
        $garment->setFit('OVERSIZED');
        $garment->setFabric([
            'material' => 'DENIM',
            'weave' => 'TWILL',
            'weight' => 'HEAVYWEIGHT',
            'sheerness' => 'OPAQUE',
        ]);
        $garment->setPrimaryColor(['color_name' => 'Washed Indigo Blue', 'hex_code' => '#3B5998']);
        $garment->setSecondaryColor(null);
        $garment->setPattern('SOLID');
        $garment->setTags(['denim', 'outer', 'vintage']);

        $this->assertEquals('Test Jacket', $garment->getName());
        $this->assertEquals('TOP', $garment->getCategory());
        $this->assertEquals('Denim Jacket', $garment->getSubCategory());
        $this->assertEquals('OVERSIZED', $garment->getFit());
        $this->assertEquals('DENIM', $garment->getFabric()['material']);
        $this->assertEquals('Washed Indigo Blue', $garment->getPrimaryColor()['color_name']);
        $this->assertNull($garment->getSecondaryColor());
        $this->assertEquals('SOLID', $garment->getPattern());
        $this->assertEquals(['denim', 'outer', 'vintage'], $garment->getTags());
    }

    public function testOutfitEntity(): void
    {
        $outfit = new Outfit();
        $outfit->setName('Test Outfit');
        $outfit->setStyleCategory('HIGH_FASHION');
        $outfit->setIsPublic(true);

        $this->assertEquals('Test Outfit', $outfit->getName());
        $this->assertEquals('HIGH_FASHION', $outfit->getStyleCategory());
        $this->assertTrue($outfit->isPublic());
        $this->assertCount(0, $outfit->getGarments());
    }

    public function testGarmentSlotEntity(): void
    {
        $garmentSlot = new \App\Entity\GarmentSlot();
        $garmentSlot->setSlotType('OUTER_LAYER');

        $this->assertEquals('OUTER_LAYER', $garmentSlot->getSlotType());
        $this->assertNull($garmentSlot->getOutfit());
        $this->assertNull($garmentSlot->getGarment());
    }

    public function testSceneEntity(): void
    {
        $scene = new Scene();
        $scene->setTitle('Test Scene');
        $scene->setEnvironmentType('URBAN');
        $scene->setLocationDetails('Test Location');
        $scene->setCameraAndLens([
            'focal_length' => 'LENS_85MM_PORTRAIT',
            'aperture' => 'F_1_8',
            'depth_of_field' => 'SHALLOW_BOKEH',
            'film_grain' => 'SUBTLE_35MM',
        ]);
        $scene->setWeatherAndAtmosphere([
            'weather' => 'CLEAR',
            'time_of_day' => 'GOLDEN_HOUR',
        ]);

        $this->assertEquals('Test Scene', $scene->getTitle());
        $this->assertEquals('URBAN', $scene->getEnvironmentType());
        $this->assertEquals('Test Location', $scene->getLocationDetails());
        $this->assertEquals('LENS_85MM_PORTRAIT', $scene->getCameraAndLens()['focal_length']);
        $this->assertEquals('CLEAR', $scene->getWeatherAndAtmosphere()['weather']);
    }

    public function testLightingEntity(): void
    {
        $lighting = new Lighting();
        $lighting->setSetupType('GOLDEN_HOUR');
        $lighting->setColorTemperature('WARM_2700K');
        $lighting->setKeyLightDirection('SIDE_45');
        $lighting->setHardness('SOFT_DIFFUSED');
        $lighting->setModifiers(['diffusion' => 'softbox']);

        $this->assertEquals('GOLDEN_HOUR', $lighting->getSetupType());
        $this->assertEquals('WARM_2700K', $lighting->getColorTemperature());
        $this->assertEquals('SIDE_45', $lighting->getKeyLightDirection());
        $this->assertEquals('SOFT_DIFFUSED', $lighting->getHardness());
        $this->assertEquals(['diffusion' => 'softbox'], $lighting->getModifiers());
    }

    public function testPoseEntity(): void
    {
        $pose = new Pose();
        $pose->setTitle('Test Pose');
        $pose->setCategory('HIGH_FASHION');
        $pose->setBodyLanguage('Standing pose');
        $pose->setFacialExpression('SERIOUS_LOOK');
        $pose->setExpressionIntensity(6);
        $pose->setCameraAngle('EYE_LEVEL');
        $pose->setRequiredFraming('MEDIUM_SHOT');

        $this->assertEquals('Test Pose', $pose->getTitle());
        $this->assertEquals('HIGH_FASHION', $pose->getCategory());
        $this->assertEquals('Standing pose', $pose->getBodyLanguage());
        $this->assertEquals('SERIOUS_LOOK', $pose->getFacialExpression());
        $this->assertEquals(6, $pose->getExpressionIntensity());
        $this->assertEquals('EYE_LEVEL', $pose->getCameraAngle());
        $this->assertEquals('MEDIUM_SHOT', $pose->getRequiredFraming());
    }

    public function testPromptCompositionEntity(): void
    {
        $composition = new PromptComposition();
        $composition->setTitle('Test Composition');
        $composition->setUserId('test-user');
        $composition->setStatus(CompositionStatusEnum::DRAFT);
        $composition->setTargetModelHint('FLUX_1_DEV');
        $composition->setAppliedOverrides([]);

        $this->assertEquals('Test Composition', $composition->getTitle());
        $this->assertEquals('test-user', $composition->getUserId());
        $this->assertEquals(CompositionStatusEnum::DRAFT, $composition->getStatus());
        $this->assertEquals('FLUX_1_DEV', $composition->getTargetModelHint());
        $this->assertEquals([], $composition->getAppliedOverrides());
        $this->assertNull($composition->getCharacter());
        $this->assertNull($composition->getOutfit());
        $this->assertNull($composition->getPose());
        $this->assertNull($composition->getScene());
    }

    public function testCompositionStatusEnum(): void
    {
        $this->assertEquals('DRAFT', CompositionStatusEnum::DRAFT->value);
        $this->assertEquals('COMPILED', CompositionStatusEnum::COMPILED->value);
        $this->assertEquals('ARCHIVED', CompositionStatusEnum::ARCHIVED->value);
    }
}