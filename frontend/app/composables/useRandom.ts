import type { BlockKey } from '@/stores/dashboard';
import type { Character, Lighting, Pose, Scene, TimeWeather } from '@/types/api';

const pick = <T,>(arr: readonly T[]): T => arr[Math.floor(Math.random() * arr.length)] as T;

const int = (min: number, max: number): number => Math.floor(Math.random() * (max - min + 1)) + min;

export const characterNames = [
  'Aria', 'Valentina', 'Luna', 'Isla', 'Sofia', 'Amara', 'Noor', 'Kehlani',
  'Mateo', 'Ivan', 'Diego', 'Asher', 'Jules', 'Mika', 'Rafael', 'Nadia',
];

export const groomingNames = [
  'Bob despeinado', 'Moño bajo', 'Ondas playeras', 'Buzz cut', 'Cabello liso largo',
  'Corte pixie', 'Coleta alta', 'Rizos definidos', 'Peinado slick-back',
];

export const makeupStyleNames = [
  'No-Makeup Natural Glow', 'Smokey eye editorial', 'Look glow dorado',
  'Cut crease vibrante', 'Matte natural', 'Retro pin-up',
];

export const poseTitles = [
  'Manos sobre la cadera', 'Caminando hacia cámara', 'Apoyada en la pared',
  'Sentada con piernas cruzadas', 'Mirada por encima del hombro', 'Perfil estático',
];

export const bodyLanguages = [
  'Postura erguida, hombros relajados', 'Líneas alargadas, peso en una pierna',
  'Movimiento suelto, manos al costado', 'Confianza contenida, mentón alto',
];

export const sceneTitles = [
  'Azotea al atardecer', 'Estudio con fondo texturizado', 'Calle empedrada en la lluvia',
  'Bosque con luz filtrada', 'Interior minimalista con luz de ventana', 'Paisaje desértico',
];

export const locationDetails = [
  'Azotea con vista a la ciudad, césped húmedo', 'Fondo de estudio gris con sombra suave',
  'Calle adoquinada mojada con reflejos de neón', 'Claro de bosque con niebla baja',
  'Salón amplio con ventanales al jardín', 'Dunas doradas bajo el sol bajo',
];

const genders = ['FEMALE', 'MALE', 'NON_BINARY'] as const;
const ethnicities = ['CAUCASIAN', 'EAST_ASIAN', 'SOUTH_ASIAN', 'AFRICAN', 'LATINO', 'MIDDLE_EASTERN', 'MUTT'] as const;
const cranialShapes = ['MESOCEPHALIC', 'BRACHYCEPHALIC', 'DOLYCHOCEPHALIC'] as const;
const facialStructures = ['OVAL', 'ROUND', 'SQUARE', 'HEART'] as const;
const jawlines = ['SHARP', 'SOFT', 'ANGULAR', 'ROBUST'] as const;
const cheekbones = ['HIGH_PROMINENT', 'MODERATE', 'LOW_SET', 'SUNKEN'] as const;
const ears = ['ATTACHED_LOBE', 'FREE_LOBE', 'UTICATE'] as const;
const fitzpatrick = ['TYPE_I', 'TYPE_II', 'TYPE_III', 'TYPE_IV', 'TYPE_V', 'TYPE_VI'] as const;
const undertones = ['COOL', 'WARM', 'NEUTRAL', 'OLIVE'] as const;
const skinFinishes = ['DEWY', 'MATTE', 'LUMINOUS', 'SATIN'] as const;
const walkers = ['TYPE_1', 'TYPE_2A', 'TYPE_2B', 'TYPE_2C', 'TYPE_3A', 'TYPE_3B', 'TYPE_3C', 'TYPE_4A', 'TYPE_4B', 'TYPE_4C'] as const;
const densities = ['SPARSE', 'THIN', 'MEDIUM', 'THICK', 'DENSE'] as const;
const porosities = ['LOW', 'MEDIUM', 'HIGH'] as const;
const hairlines = ['STRAIGHT', 'SLEEK', 'WAVY', 'CURVED'] as const;
const eyeColors = ['BROWN', 'BLUE', 'GREEN', 'HAZEL', 'AMBER', 'GRAY'] as const;
const eyeShapes = ['ALMOND', 'ROUND', 'HOODED', 'UPTURNED', 'DOWNTURNED'] as const;
const eyelashes = ['LONG_DENSE', 'SHORT_SPARSE', 'MEDIUM', 'CURLED'] as const;
const hairLengths = ['BALD', 'SHORT', 'MEDIUM', 'LONG', 'VERY_LONG'] as const;
const hairFinishes = ['NATURAL', 'STYLED', 'MESSY', 'SLEEK'] as const;
const facialHairs = ['CLEAN_SHAVEN', 'STUBBLE', 'SHORT_BEARD', 'LONG_BEARD', 'MUSTACHE', 'GOATEE'] as const;

const poseCategories = ['HIGH_FASHION', 'EDITORIAL', 'PORTRAIT', 'CATWALK', 'CANDID'] as const;
const expressions = ['NEUTRAL', 'SMILE', 'SOFT_SMEAR', 'PUGIL', 'CONFIDENT', 'CONTEMPLATIVE', 'MYSTERIOUS', 'PASSIONATE'] as const;
const cameraAngles = ['EYE_LEVEL', 'HIGH_ANGLE', 'LOW_ANGLE', 'DUTCH_ANGLE', 'BIRDSEYE'] as const;
const framings = ['MEDIUM_SHOT', 'CLOSE_UP', 'WIDE_SHOT', 'KNEE_UP', 'THIGH_UP'] as const;

const environments = ['URBAN', 'NATURAL', 'INDOOR', 'STUDIO', 'FANTASY', 'SCI_FI'] as const;
const focalLengths = ['LENS_35MM_WIDE', 'LENS_50MM_NORMAL', 'LENS_85MM_PORTRAIT', 'LENS_135MM_TELEPHOTO'] as const;
const apertures = ['F_1_2', 'F_1_4', 'F_1_8', 'F_2_8', 'F_4', 'F_5_6', 'F_8', 'F_11'] as const;
const dofs = ['SHALLOW_BOKEH', 'MODERATE', 'DEEP'] as const;
const filmGrains = ['NONE', 'SUBTLE_35MM', 'MEDIUM_35MM', 'HEAVY_35MM', 'VINTAGE_8MM'] as const;
const weathers = ['CLEAR', 'PARTLY_CLOUDY', 'OVERCAST', 'RAIN', 'SNOW', 'FOG'] as const;
const timeOfDays = ['DAY', 'DUSK', 'GOLDEN_HOUR', 'BLUE_HOUR', 'NIGHT'] as const;

const setups = ['GOLDEN_HOUR', 'BLUE_HOUR', 'STUDIO_SOFTBOX', 'STUDIO_HARSHELL', 'WINDOW_LIGHT', 'NEON', 'CANDLELIGHT'] as const;
const temperatures = ['WARM_2700K', 'WARM_3200K', 'NEUTRAL_4500K', 'COOL_5600K', 'COOL_7000K'] as const;
const directions = ['FRONT', 'SIDE_45', 'SIDE_90', 'BACK_45', 'OVERHEAD', 'UNDER'] as const;
const hardnesses = ['SOFT_DIFFUSED', 'SEMI_SOFT', 'HARD_SHADOW', 'CONTRAST'] as const;

const seasons = ['SPRING', 'SUMMER', 'AUTUMN', 'WINTER'] as const;
const dayTimes = ['DEAD_NIGHT', 'SMALL_HOURS', 'BLUE_HOUR', 'SUNRISE', 'GOLDEN_HOUR', 'MORNING', 'LATE_MORNING', 'NOON', 'AFTERNOON', 'SUNSET', 'DUSK', 'TWILIGHT', 'NIGHT'] as const;
const dayWeathers = ['SUNNY', 'CLEAR', 'PARTLY_CLOUDY', 'CLOUDY', 'OVERCAST', 'RAINY', 'DRIZZLY', 'STORMY', 'SHOWERY', 'SNOWY', 'SLEET', 'HAIL', 'FOGGY', 'MISTY', 'WINDY', 'GUSTY', 'DUSTY', 'HAZY', 'HUMID', 'MUGGY', 'ICY', 'COLD', 'COOL', 'MILD', 'HOT', 'VERY_HOT', 'THUNDERSTORM', 'RAINBOW', 'ICE', 'DEW', 'FROST', 'VARIABLE', 'UNSTABLE', 'CHANGING'] as const;

function randomHairline(): string {
  const walker = pick(walkers);
  if (walker === 'TYPE_1') return 'STRAIGHT';
  if (walker.startsWith('TYPE_2')) return 'WAVY';
  return 'CURVED';
}

function randomSkin(): { fitzpatrick_scale: string; undertone: string; finish: string } {
  const scale = pick(fitzpatrick);
  const light = ['TYPE_I', 'TYPE_II', 'TYPE_III'].includes(scale);
  const undertone = light
    ? pick(['COOL', 'WARM', 'NEUTRAL'] as const)
    : pick(['WARM', 'NEUTRAL', 'OLIVE'] as const);
  return { fitzpatrick_scale: scale, undertone, finish: pick(skinFinishes) };
}

const hairColorObjects: Array<{ color_name: string; hex_code: string }> = [
  { color_name: 'Natural Brown', hex_code: '#8B4513' },
  { color_name: 'Black', hex_code: '#1C1C1C' },
  { color_name: 'Blonde', hex_code: '#E8CE9E' },
  { color_name: 'Red', hex_code: '#C1440E' },
  { color_name: 'Gray', hex_code: '#B0A79A' },
  { color_name: 'Blue', hex_code: '#2E4EB5' },
  { color_name: 'Pink', hex_code: '#E86AA6' },
  { color_name: 'Green', hex_code: '#3E7C4F' },
];

function randomCharacter(): Character {
  const { fitzpatrick_scale, undertone, finish } = randomSkin();
  return {
    name: pick(characterNames),
    gender: pick(genders),
    age: int(18, 70),
    ethnicity: pick(ethnicities),
    is_public: false,
    cranial_morphology: {
      cranial_shape: pick(cranialShapes),
      facial_structure: pick(facialStructures),
      jawline_definition: pick(jawlines),
      cheekbones: pick(cheekbones),
      ear_morphology: pick(ears),
    },
    skin_profile: {
      fitzpatrick_scale,
      undertone,
      finish,
      imperfections: [],
      freckle_density: null,
    },
    hair_profile: {
      andre_walker_type: pick(walkers),
      density: pick(densities),
      porosity: pick(porosities),
      hairline: randomHairline(),
    },
    eye_profile: {
      primary_color: pick(eyeColors),
      secondary_color: null,
      heterochromia_type: 'NONE',
      eye_shape: pick(eyeShapes),
      eyelash_details: pick(eyelashes),
    },
    facial_features: {},
    current_grooming: {
      hairstyle_name: pick(groomingNames),
      hair_length: pick(hairLengths),
      hair_color_primary: pick(hairColorObjects),
      hair_color_secondary: null,
      hair_finish: pick(hairFinishes),
      facial_hair_style: pick(facialHairs),
      facial_hair_color: null,
    },
    current_makeup: {
      style_name: pick(makeupStyleNames),
      lipstick: null,
      eyeshadow: null,
      eyeliner: null,
      blush_and_contour: null,
      nails: null,
    },
  } as unknown as Character;
}

function randomPose(): Pose {
  return {
    title: pick(poseTitles),
    category: pick(poseCategories),
    body_language: pick(bodyLanguages),
    facial_expression: pick(expressions),
    expression_intensity: int(1, 10),
    camera_angle: pick(cameraAngles),
    required_framing: pick(framings),
  };
}

function randomScene(): Scene {
  return {
    title: pick(sceneTitles),
    environment_type: pick(environments),
    location_details: pick(locationDetails),
    camera_and_lens: {
      focal_length: pick(focalLengths),
      aperture: pick(apertures),
      depth_of_field: pick(dofs),
      film_grain: pick(filmGrains),
    },
    weather_and_atmosphere: {
      weather: pick(weathers),
      time_of_day: pick(timeOfDays),
    },
    lighting_id: null,
  };
}

function randomLighting(): Lighting {
  return {
    setup_type: pick(setups),
    color_temperature: pick(temperatures),
    key_light_direction: pick(directions),
    hardness: pick(hardnesses),
    modifiers: {},
  };
}

function randomTime(): TimeWeather {
  return {
    season: pick(seasons),
    time_of_day: pick(dayTimes),
    weather: pick(dayWeathers),
  };
}

export const useRandom = () => {
  function randomize(blockKey: BlockKey) {
    switch (blockKey) {
      case 'character': {
        const store = useCharacterStore();
        store.data = randomCharacter();
        break;
      }
      case 'pose': {
        const store = usePoseStore();
        store.data = randomPose();
        break;
      }
      case 'scene': {
        const store = useSceneStore();
        store.data = randomScene();
        break;
      }
      case 'lighting': {
        const store = useLightingStore();
        store.data = randomLighting();
        break;
      }
      case 'time': {
        const store = useTimeStore();
        store.data = randomTime();
        break;
      }
      case 'outfit':
        break;
    }
  }

  return { randomize };
};