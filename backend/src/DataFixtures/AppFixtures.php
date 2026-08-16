<?php

namespace App\DataFixtures;

use App\Entity\Character;
use App\Entity\Garment;
use App\Entity\GarmentSlot;
use App\Entity\Lighting;
use App\Entity\Outfit;
use App\Entity\Pose;
use App\Entity\PromptComposition;
use App\Entity\Scene;
use App\Entity\TimeWeather;
use App\Enum\CompositionStatusEnum;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $lighting = new Lighting();
        $lighting
            ->setSetupType('GOLDEN_HOUR')
            ->setColorTemperature('WARM_2700K')
            ->setKeyLightDirection('SIDE_45')
            ->setHardness('SOFT_DIFFUSED')
            ->setModifiers(['diffusion' => 'softbox']);

        $timeWeather = new TimeWeather();
        $timeWeather
            ->setSeason('SUMMER')
            ->setTimeOfDay('GOLDEN_HOUR')
            ->setWeather('CLEAR');

        $garment = new Garment();
        $garment
            ->setName('Chaqueta Denim Vintage')
            ->setCategory('TOP')
            ->setSubCategory('Denim Jacket')
            ->setFit('OVERSIZED')
            ->setFabric([
                'material' => 'DENIM',
                'weave' => 'TWILL',
                'weight' => 'HEAVYWEIGHT',
                'sheerness' => 'OPAQUE',
            ])
            ->setPrimaryColor(['color_name' => 'Washed Indigo Blue', 'hex_code' => '#3B5998'])
            ->setSecondaryColor(null)
            ->setPattern('SOLID')
            ->setTags(['denim', 'outer', 'vintage']);

        $garmentSlot = new GarmentSlot();
        $garmentSlot
            ->setSlotType('OUTER_LAYER')
            ->setGarment($garment);

        $outfit = new Outfit();
        $outfit
            ->setName('Soho Editorial')
            ->setStyleCategory('HIGH_FASHION')
            ->setIsPublic(true);
        $outfit->addGarment($garmentSlot); // cascade persist via outfit.garments

        $pose = new Pose();
        $pose
            ->setTitle('Ajuste Soho')
            ->setCategory('HIGH_FASHION')
            ->setBodyLanguage('De pie, cuerpo inclinado ligeramente hacia atrás con una mano en la solapa.')
            ->setFacialExpression('SERIOUS_LOOK')
            ->setExpressionIntensity(6)
            ->setCameraAngle('EYE_LEVEL')
            ->setRequiredFraming('MEDIUM_SHOT');

        $scene = new Scene();
        $scene
            ->setTitle('Soho Peatonal')
            ->setEnvironmentType('URBAN')
            ->setLocationDetails('Calle peatonal del Soho de NY.')
            ->setLighting($lighting)
            ->setCameraAndLens([
                'focal_length' => 'LENS_85MM_PORTRAIT',
                'aperture' => 'F_1_8',
                'depth_of_field' => 'SHALLOW_BOKEH',
                'film_grain' => 'SUBTLE_35MM',
            ])
            ->setWeatherAndAtmosphere([
                'weather' => 'CLEAR',
                'time_of_day' => 'GOLDEN_HOUR',
            ]);

        $character = new Character();
        $character
            ->setName('Modelo Editorial')
            ->setIsPublic(true)
            ->setGender('FEMALE')
            ->setAge(26)
            ->setEthnicity('CAUCASIAN')
            ->setCranialMorphology(['morphology' => 'MESOCEPHALIC'])
            ->setSkinProfile([
                'fitzpatrick_scale' => 'TYPE_II',
                'undertone' => 'WARM_GOLDEN',
                'finish' => 'DEWY',
                'imperfections' => ['FRECKLES'],
                'freckle_density' => 'SPARSE',
            ])
            ->setHairProfile([
                'andre_walker_type' => 'TYPE_2A',
                'density' => 'MEDIUM',
                'porosity' => 'MEDIUM',
                'hairline' => 'STRAIGHT',
            ])
            ->setEyeProfile([
                'primary_color' => 'GREEN',
                'eye_shape' => 'ALMOND',
                'eyelash_details' => 'LONG_DENSE',
            ])
            ->setCurrentGrooming([
                'hairstyle_name' => 'Ondas Surferas',
                'hair_length' => 'LONG',
                'hair_color_primary' => ['color_name' => 'Warm Honey Blonde', 'hex_code' => '#E6C687'],
                'hair_color_secondary' => null,
                'hair_finish' => 'MATTE',
                'facial_hair_style' => 'CLEAN_SHAVEN',
            ])
            ->setCurrentMakeup([
                'style_name' => 'No-Makeup Natural Glow',
                'lipstick' => [
                    'color' => ['color_name' => 'Nude Rose', 'hex_code' => '#D8A399'],
                    'finish' => 'SATIN',
                ],
                'blush_and_contour' => ['definition' => 'SOFT', 'intensity' => 3],
            ])
            ->setFacialFeatures([]);

        $composition = new PromptComposition();
        $composition
            ->setTitle('Editorial Soho Golden Hour')
            ->setUserId('admin')
            ->setStatus(CompositionStatusEnum::DRAFT)
            ->setTargetModelHint('FLUX_1_DEV')
            ->setAppliedOverrides([])
            ->setCharacter($character)
            ->setOutfit($outfit)
            ->setPose($pose)
            ->setScene($scene);

        foreach ([$lighting, $timeWeather, $garment, $garmentSlot, $outfit, $pose, $scene, $character, $composition] as $entity) {
            $manager->persist($entity);
        }

        $manager->flush();
    }
}
