<template>
  <div class="grid grid-cols-3 gap-3">
    <UiSelect
      v-model="data.season"
      label="Estación"
      :options="seasonOptions"
    />
    <UiSelect
      v-model="data.time_of_day"
      label="Hora del día"
      :options="timeOfDayOptions"
    />
    <UiSelect
      v-model="data.weather"
      label="El día"
      :options="weatherOptions"
    />
  </div>
</template>

<script setup lang="ts">
import { storeToRefs } from 'pinia';

const time = useTimeStore();
const { data } = storeToRefs(time);

const seasonOptions = [
  { value: 'SPRING', label: 'Primavera' },
  { value: 'SUMMER', label: 'Verano' },
  { value: 'AUTUMN', label: 'Otoño' },
  { value: 'WINTER', label: 'Invierno' },
];

const timeOfDayOptions = [
  { value: 'DEAD_NIGHT', label: 'Noche cerrada' },
  { value: 'SMALL_HOURS', label: 'Madrugada' },
  { value: 'BLUE_HOUR', label: 'Hora azul' },
  { value: 'SUNRISE', label: 'Amanecer' },
  { value: 'GOLDEN_HOUR', label: 'Hora dorada' },
  { value: 'MORNING', label: 'Mañana' },
  { value: 'LATE_MORNING', label: 'Media mañana' },
  { value: 'NOON', label: 'Mediodía' },
  { value: 'AFTERNOON', label: 'Tarde' },
  { value: 'SUNSET', label: 'Atardecer' },
  { value: 'DUSK', label: 'Anochecer' },
  { value: 'TWILIGHT', label: 'Crepúsculo' },
  { value: 'NIGHT', label: 'Noche' },
];

const weatherOptions = [
  { value: 'SUNNY', label: 'Soleado' },
  { value: 'CLEAR', label: 'Despejado' },
  { value: 'PARTLY_CLOUDY', label: 'Parcialmente nublado' },
  { value: 'CLOUDY', label: 'Nublado' },
  { value: 'OVERCAST', label: 'Cubierto' },
  { value: 'RAINY', label: 'Lluvioso' },
  { value: 'DRIZZLY', label: 'Lloviznando' },
  { value: 'STORMY', label: 'Tormentoso' },
  { value: 'SHOWERY', label: 'Con chubascos' },
  { value: 'SNOWY', label: 'Nevando' },
  { value: 'SLEET', label: 'Con aguanieve' },
  { value: 'HAIL', label: 'Con granizo' },
  { value: 'FOGGY', label: 'Con niebla' },
  { value: 'MISTY', label: 'Con bruma' },
  { value: 'WINDY', label: 'Ventoso' },
  { value: 'GUSTY', label: 'Con rachas de viento' },
  { value: 'DUSTY', label: 'Polvoriento' },
  { value: 'HAZY', label: 'Con calima' },
  { value: 'HUMID', label: 'Húmedo' },
  { value: 'MUGGY', label: 'Bochornoso' },
  { value: 'ICY', label: 'Helado' },
  { value: 'COLD', label: 'Frío' },
  { value: 'COOL', label: 'Fresco' },
  { value: 'MILD', label: 'Templado' },
  { value: 'HOT', label: 'Caluroso' },
  { value: 'VERY_HOT', label: 'Muy caluroso' },
  { value: 'THUNDERSTORM', label: 'Con tormenta eléctrica' },
  { value: 'RAINBOW', label: 'Con arcoíris' },
  { value: 'ICE', label: 'Con hielo' },
  { value: 'DEW', label: 'Con rocío' },
  { value: 'FROST', label: 'Con escarcha' },
  { value: 'VARIABLE', label: 'Variable' },
  { value: 'UNSTABLE', label: 'Inestable' },
  { value: 'CHANGING', label: 'Cambiante' },
];
</script>