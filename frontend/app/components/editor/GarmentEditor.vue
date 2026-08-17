<template>
  <div class="space-y-2">
    <UiInput
      v-model="garment.name"
      label="Nombre"
      placeholder="Ej: Camiseta blanca"
    />
    <div class="grid grid-cols-2 gap-2">
      <UiSelect
        v-model="garment.category"
        label="Categoría"
        :options="categoryOptions"
      />
      <UiInput
        v-model="garment.sub_category"
        label="Subcategoría"
        placeholder="Ej: T_SHIRT"
      />
      <UiSelect
        v-model="garment.fit"
        label="Ajuste"
        :options="fitOptions"
      />
      <UiSelect
        v-model="garment.pattern"
        label="Patrón"
        :options="patternOptions"
      />
    </div>

    <UiAccordion title="Material" :default-open="false">
      <div class="grid grid-cols-2 gap-2 pt-1">
        <UiSelect
          v-model="garment.fabric.material"
          label="Material"
          :options="materialOptions"
        />
        <UiSelect
          v-model="garment.fabric.weave"
          label="Tejido"
          :options="weaveOptions"
        />
        <UiSelect
          v-model="garment.fabric.weight"
          label="Peso"
          :options="weightOptions"
        />
        <UiSelect
          v-model="garment.fabric.sheerness"
          label="Transparencia"
          :options="sheernessOptions"
        />
      </div>
    </UiAccordion>
  </div>
</template>

<script setup lang="ts">
import { ref, watch } from 'vue';

const props = defineProps<{
  garment: Record<string, unknown>;
}>();

const emit = defineEmits<{
  (e: 'update', v: Record<string, unknown>): void;
}>();

const garment = ref<any>(props.garment);

watch(garment, (v) => {
  emit('update', v);
}, { deep: true });

const categoryOptions = [
  { value: 'TOP', label: 'Superior (Top)' },
  { value: 'BOTTOM', label: 'Inferior (Bottom)' },
  { value: 'FULL_BODY', label: 'Cuerpo completo (Dress/Jumpsuit)' },
  { value: 'FOOTWEAR', label: 'Calzado' },
  { value: 'HEADWEAR', label: 'Accesorio cabeza' },
  { value: 'ACCESSORY', label: 'Accesorio' },
];

const fitOptions = [
  { value: 'SKINNY', label: 'Skinny' },
  { value: 'SLIM', label: 'Slim' },
  { value: 'REGULAR', label: 'Regular' },
  { value: 'OVERSIZED', label: 'Oversized' },
  { value: 'TAILORED', label: 'Tailored' },
];

const patternOptions = [
  { value: 'SOLID', label: 'Sólido' },
  { value: 'STRIPED', label: 'Rayado' },
  { value: 'PLAID', label: 'Cuadros (Plaid)' },
  { value: 'CAMO', label: 'Camuflaje' },
  { value: 'GRAPHIC_PRINT', label: 'Estampado gráfico' },
];

const materialOptions = [
  { value: 'COTTON', label: 'Algodón' },
  { value: 'LINEN', label: 'Lino' },
  { value: 'LEATHER', label: 'Cuero' },
  { value: 'DENIM', label: 'Denim' },
  { value: 'SILK', label: 'Seda' },
  { value: 'WOOL', label: 'Lana' },
  { value: 'NYLON', label: 'Nylon' },
  { value: 'POLYESTER', label: 'Poliéster' },
  { value: 'VISCOSE', label: 'Viscosa' },
  { value: 'LACE', label: 'Encaje' },
  { value: 'STRAW', label: 'Paja' },
  { value: 'FELT', label: 'Fieltro' },
  { value: 'ELASTANE', label: 'Elastano' },
  { value: 'METAL', label: 'Metal' },
  { value: 'GOLD', label: 'Oro' },
  { value: 'SILVER', label: 'Plata' },
  { value: 'SATIN', label: 'Satén' },
  { value: 'CHIFFON', label: 'Chiffon' },
  { value: 'SUEDE', label: 'Ante' },
];

const weaveOptions = [
  { value: 'KNITTED', label: 'Tejido de punto' },
  { value: 'WOVEN', label: 'Tejido plano' },
  { value: 'TWILL', label: 'Sarga (Twill)' },
  { value: 'SATIN', label: 'Satén' },
];

const weightOptions = [
  { value: 'LIGHTWEIGHT', label: 'Ligero' },
  { value: 'MEDIUMWEIGHT', label: 'Medio' },
  { value: 'HEAVYWEIGHT', label: 'Pesado' },
];

const sheernessOptions = [
  { value: 'OPAQUE', label: 'Opaco' },
  { value: 'SEMI_TRANSPARENT', label: 'Semitransparente' },
  { value: 'TRANSLUCENT', label: 'Translúcido' },
];
</script>