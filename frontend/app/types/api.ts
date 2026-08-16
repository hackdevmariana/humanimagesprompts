export type UUID = string;

export type GenderEnum = 'FEMALE' | 'MALE' | 'NON_BINARY' | 'ANDROGYNOUS';
export type EthnicityEnum = 'CAUCASIAN' | 'EAST_ASIAN' | 'AFRICAN' | 'HISPANIC' | 'SOUTH_ASIAN' | 'MIDDLE_EASTERN' | 'NATIVE_AMERICAN' | 'MULTIRACIAL';

export type CranialShapeEnum = 'DOLICHOCEPHALIC' | 'BRACHYCEPHALIC' | 'MESOCEPHALIC';
export type FacialStructureEnum = 'OVAL' | 'SQUARE' | 'HEART' | 'DIAMOND' | 'ROUND' | 'OBLONG';
export type JawlineEnum = 'SHARP' | 'SOFT' | 'RECESSED' | 'PROMINENT_SQUARE';
export type CheekbonesEnum = 'HIGH_PROMINENT' | 'FLAT' | 'SOFT';
export type EarMorphologyEnum = 'ATTACHED_LOBE' | 'FREE_LOBE' | 'POINTED' | 'PROTRUDING';

export type FitzpatrickScaleEnum = 'TYPE_I' | 'TYPE_II' | 'TYPE_III' | 'TYPE_IV' | 'TYPE_V' | 'TYPE_VI';
export type UndertoneEnum = 'WARM_GOLDEN' | 'COOL_ROSE' | 'NEUTRAL' | 'OLIVE' | 'RED_COOL';
export type SkinFinishEnum = 'DEWY' | 'MATTE' | 'SATIN' | 'OILY_SHINE' | 'TEXTURED_NATURAL' | 'LUMINOUS' | 'NATURAL';
export type SkinFeatureEnum = 'FRECKLES' | 'MOLES' | 'ROSACEA' | 'VITILIGO' | 'SCARS' | 'ACNE_NEUTRAL';
export type DensityEnum = 'THIN' | 'MEDIUM' | 'THICK' | 'VERY_DENSE' | 'SPARSE' | 'MODERATE' | 'DENSE';

export type AndreWalkerScaleEnum = 'TYPE_1A' | 'TYPE_1B' | 'TYPE_1C' | 'TYPE_2A' | 'TYPE_2B' | 'TYPE_2C' | 'TYPE_3A' | 'TYPE_3B' | 'TYPE_3C' | 'TYPE_4A' | 'TYPE_4B' | 'TYPE_4C';
export type HairPorosityEnum = 'LOW' | 'MEDIUM' | 'HIGH';
export type HairlineEnum = 'STRAIGHT' | 'WIDOWS_PEAK' | 'RECEDING' | 'HIGH';

export type EyeColorEnum = 'AMBER' | 'BLUE' | 'BROWN' | 'GREEN' | 'HAZEL' | 'GRAY';
export type HeterochromiaEnum = 'NONE' | 'COMPLETE' | 'CENTRAL' | 'SEGMENTAL';
export type EyeShapeEnum = 'ALMOND' | 'ROUND' | 'MONOLID' | 'HOODED' | 'DOWNTURNED' | 'UPTURNED' | 'WIDE_SET' | 'CLOSE_SET';
export type EyelashEnum = 'NATURAL' | 'LONG_DENSE' | 'EXTENSIONS' | 'SPARSE' | 'MEDIUM';

export type HairLengthEnum = 'SHAVED' | 'SHORT' | 'MEDIUM' | 'LONG' | 'EXTRA_LONG';
export type HairFinishEnum = 'MATTE' | 'WET_LOOK' | 'GLOSSY' | 'MESSY' | 'STYLED' | 'NONE';
export type FacialHairEnum = 'CLEAN_SHAVEN' | 'STUBBLE' | 'FULL_BEARD' | 'MUSTACHE' | 'GOATEE';

export type LipstickFinishEnum = 'MATTE' | 'GLOSS' | 'SATIN' | 'OME';
export type EyeshadowStyleEnum = 'NATURAL' | 'SMOKEY' | 'CUT_CREASE' | 'GRAPHIC';
export type EyelinerStyleEnum = 'CAT_EYE' | 'GRAPHIC' | 'SIMPLE' | 'THIN' | 'MEDIUM' | 'THICK';
export type NailLengthEnum = 'VERY_SHORT' | 'SHORT' | 'MEDIUM' | 'LONG' | 'VERY_LONG' | 'STILETTO' | 'BALLERINA' | 'COFFIN';
export type NailShapeEnum = 'ROUND' | 'OVAL' | 'SQUoval' | 'SQUARE' | 'SOFT_SQUARE' | 'ALMOND' | 'STILETTO' | 'COFFIN';

export type GarmentCategoryEnum = 'TOP' | 'BOTTOM' | 'FULL_BODY' | 'FOOTWEAR' | 'HEADWEAR' | 'ACCESSORY';
export type GarmentFitEnum = 'SKINNY' | 'SLIM' | 'REGULAR' | 'OVERSIZED' | 'TAILORED';
export type FabricMaterialEnum = 'COTTON' | 'LINEN' | 'LEATHER' | 'DENIM' | 'SILK' | 'WOOL' | 'NYLON' | 'LATEX' | 'CHIFFON' | 'SUEDE';
export type WeaveTypeEnum = 'KNITTED' | 'WOVEN' | 'SATIIN' | 'TWILL';
export type FabricWeightEnum = 'LIGHTWEIGHT' | 'MEDIUM_WEIGHT' | 'HEAVYWEIGHT';
export type SheernessEnum = 'OPAQUE' | 'SEMI_TRANSPARENT' | 'SHEER';
export type PatternEnum = 'SOLID' | 'STRIPED' | 'PLAID' | 'CAMO' | 'GRAPHIC_PRINT';
export type LayerSlotEnum = 'BASE_LAYER' | 'MID_LAYER' | 'OUTER_LAYER' | 'FOOTWEAR' | 'HEADWEAR' | 'ACCESSORIES';

export type OutfitStyleEnum = 'CASUAL' | 'FORMAL' | 'ATHLETIC' | 'HIGH_FASHION' | 'TACTICAL' | 'PERIOD_COSTUME';

export type PoseCategoryEnum = 'STANDING' | 'SITTING' | 'DYNAMIC_SPORT' | 'DANCE' | 'YOGA_FITNESS' | 'HIGH_FASHION' | 'PORTRAIT';
export type FacialExpressionEnum = 'NEUTRAL' | 'INTENSE_SMILE' | 'SMIRK' | 'SERIOUS_LOOK' | 'CRYING' | 'SCREAMING';
export type CameraAngleEnum = 'LOW_ANGLE' | 'EYE_LEVEL' | 'HIGH_ANGLE' | 'BIRD_EYE';
export type FramingEnum = 'CLOSE_UP' | 'MEDIUM_SHOT' | 'FULL_BODY';

export type EnvironmentEnum = 'INDOOR' | 'OUTDOOR' | 'STUDIO' | 'URBAN' | 'NATURE' | 'ABSTRACT';

export type LightingSetupEnum = 'REMBRANDT' | 'BUTTERFLY' | 'SOFTBOX_STUDIO' | 'NATURAL_SUNLIGHT' | 'NEON_CYBERPUNK' | 'GOLDEN_HOUR' | 'DRAMATIC_SPLIT' | 'OVERCAST' | 'STUDIO_SOFTBOX' | 'NATURAL_WINDOW';

export type ColorTemperatureEnum = 'WARM_2700K' | 'NEUTRAL_5000K' | 'COOL_6500K' | 'COOL_5600K' | 'DAYLIGHT';

export type SeasonEnum = 'SPRING' | 'SUMMER' | 'AUTUMN' | 'WINTER';

export type TimeOfDayEnum = 'DEAD_NIGHT' | 'SMALL_HOURS' | 'BLUE_HOUR' | 'SUNRISE' | 'GOLDEN_HOUR' | 'MORNING' | 'LATE_MORNING' | 'NOON' | 'AFTERNOON' | 'SUNSET' | 'DUSK' | 'TWILIGHT' | 'NIGHT';

export type WeatherEnum = 'SUNNY' | 'CLEAR' | 'PARTLY_CLOUDY' | 'CLOUDY' | 'OVERCAST' | 'RAINY' | 'DRIZZLY' | 'STORMY' | 'SHOWERY' | 'SNOWY' | 'SLEET' | 'HAIL' | 'FOGGY' | 'MISTY' | 'WINDY' | 'GUSTY' | 'DUSTY' | 'HAZY' | 'HUMID' | 'MUGGY' | 'ICY' | 'COLD' | 'COOL' | 'MILD' | 'HOT' | 'VERY_HOT' | 'THUNDERSTORM' | 'RAINBOW' | 'ICE' | 'DEW' | 'FROST' | 'VARIABLE' | 'UNSTABLE' | 'CHANGING';

export interface ColorPalette {
  color_name: string;
  hex_code: string;
}

export interface Fabric {
  material: string;
  weave: string;
  weight: string;
  sheerness: string;
}

export interface CranialMorphology {
  cranial_shape: string;
  facial_structure: string;
  jawline_definition: string;
  cheekbones: string;
  ear_morphology: string;
}

export interface SkinProfile {
  fitzpatrick_scale: string;
  undertone: string;
  finish: string;
  imperfections?: string[];
  freckle_density?: string | null;
}

export interface HairProfile {
  andre_walker_type: string;
  density: string;
  porosity: string;
  hairline: string;
}

export interface EyeProfile {
  primary_color: string;
  secondary_color?: string | null;
  heterochromia_type?: string | null;
  eye_shape: string;
  eyelash_details: string;
}

export interface LipstickSettings {
  color: ColorPalette;
  finish: string;
}

export interface EyeshadowSettings {
  color?: ColorPalette;
  style: string;
}

export interface EyelinerSettings {
  style: string;
  color?: ColorPalette;
}

export interface ContourSettings {
  definition: string;
  intensity: number;
}

export interface NailArtSettings {
  length: string;
  shape: string;
  color?: ColorPalette;
  pattern?: string;
}

export interface MakeupProfile {
  style_name: string;
  lipstick?: LipstickSettings | null;
  eyeshadow?: EyeshadowSettings | null;
  eyeliner?: EyelinerSettings | null;
  blush_and_contour?: ContourSettings | null;
  nails?: NailArtSettings | null;
}

export interface GroomingStyle {
  hairstyle_name: string;
  hair_length: string;
  hair_color_primary: ColorPalette;
  hair_color_secondary?: ColorPalette | null;
  hair_finish: string;
  facial_hair_style?: string | null;
  facial_hair_color?: ColorPalette | null;
}

export interface SkinProfile {
  fitzpatrick_scale: string;
  undertone: string;
  finish: string;
  imperfections?: string[];
  freckle_density?: string | null;
}

export interface CranialMorphology {
  cranial_shape: string;
  facial_structure: string;
  jawline_definition: string;
  cheekbones: string;
  ear_morphology: string;
}

export interface Character {
  id?: UUID;
  name: string;
  is_public?: boolean;
  gender: string;
  age: number;
  ethnicity: string;
  cranial_morphology: CranialMorphology;
  skin_profile: SkinProfile;
  hair_profile: HairProfile;
  eye_profile: EyeProfile;
  facial_features?: Record<string, unknown>;
  current_grooming: GroomingStyle;
  current_makeup: MakeupProfile;
  created_at?: string;
  updated_at?: string;
}

export interface Garment {
  id?: UUID;
  name: string;
  category: string;
  sub_category: string;
  fit: string;
  fabric: Fabric;
  primary_color: ColorPalette;
  secondary_color?: ColorPalette | null;
  pattern?: string | null;
  tags?: string[];
  created_at?: string;
  updated_at?: string;
}

export interface GarmentSlot {
  id?: UUID;
  slot_type: string;
  garment: Garment;
  created_at?: string;
  updated_at?: string;
}

export interface Outfit {
  id?: UUID;
  name: string;
  style_category: string;
  is_public?: boolean;
  garments?: GarmentSlot[];
  garment_count?: number;
  created_at?: string;
  updated_at?: string;
}

export interface Pose {
  id?: UUID;
  title: string;
  category: string;
  body_language: string;
  facial_expression: string;
  expression_intensity: number;
  camera_angle?: string | null;
  required_framing?: string | null;
  created_at?: string;
  updated_at?: string;
}

export interface Lighting {
  id?: UUID;
  setup_type: string;
  color_temperature: string;
  key_light_direction?: string | null;
  hardness?: string | null;
  modifiers?: Record<string, unknown>;
  created_at?: string;
  updated_at?: string;
}

export interface TimeWeather {
  id?: UUID;
  season: string;
  time_of_day: string;
  weather: string;
  created_at?: string;
  updated_at?: string;
}

export interface Scene {
  id?: UUID;
  title: string;
  environment_type: string;
  location_details: string;
  camera_and_lens: Record<string, unknown>;
  weather_and_atmosphere?: Record<string, unknown>;
  lighting_id?: UUID | null;
  created_at?: string;
  updated_at?: string;
}

export interface PromptComposition {
  id?: UUID;
  title: string;
  user_id?: string;
  character_id?: UUID | null;
  outfit_id?: UUID | null;
  pose_id?: UUID | null;
  scene_id?: UUID | null;
  status?: string;
  applied_overrides?: MutationOverride[];
  target_model_hint?: string | null;
}

export interface MutationOverride {
  target_path: string;
  original_value?: unknown;
  overridden_value: unknown;
  reason?: string;
}

export type AssetType = 'character' | 'pose' | 'outfit' | 'scene' | 'lighting' | 'time-weather';

export interface SearchResult {
  type: AssetType;
  id: UUID;
  label: string;
}

export interface CompileResult {
  meta: {
    schema_version: string;
    composition_id: UUID;
    compiled_at: string;
    target_model_hint: string;
  };
  canonical: Record<string, unknown>;
  compiled_text: string;
}
