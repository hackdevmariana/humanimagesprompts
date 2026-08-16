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
        placeholder="Ej: Algodón"
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
  { value: 'TOP', label: 'Superior' },
  { value: 'BOTTOM', label: 'Inferior' },
  { value: 'DRESS', label: 'Vestido' },
  { value: 'OUTERWEAR', label: 'ABrigo' },
  { value: 'SHOES', label: 'Calzado' },
  { value: 'ACCESSORY', label: 'Accesorio' },
];

const fitOptions = [
  { value: 'SLIM', label: 'Slim' },
  { value: 'REGULAR', label: 'Regular' },
  { value: 'RELAXED', label: 'Relajado' },
  { value: 'OVERSIZE', label: 'Oversize' },
  { value: 'FORM_FITTING', label: 'Ajustado' },
];

const patternOptions = [
  { value: 'SOLID', label: 'Sólido' },
  { value: 'STRIPED', label: 'Rayado' },
  { value: 'CHECKERED', label: 'Cuadros' },
  { value: 'FLORAL', label: 'Floral' },
  { value: 'PAISLEY', label: 'Paisley' },
  { value: 'LOGO', label: 'Logo' },
];

const materialOptions = [
  { value: 'COTTON', label: 'Algodón' },
  { value: 'SILK', label: 'Seda' },
  { value: 'WOOL', label: 'Lana' },
  { value: 'LINEN', label: 'Lino' },
  { value: 'POLYESTER', label: 'Poliéster' },
  { value: 'NYLON', label: 'Nylon' },
  { value: 'LEATHER', label: 'Cuero' },
  { value: 'SATIN', label: 'Satén' },
  { value: 'CHIFFON', label: 'Chiffon' },
  { value: 'DENIM', label: 'Jeans' },
];

const weaveOptions = [
  { value: 'KNITTED', label: 'Tejido' },
  { value: 'WOVEN', label: 'Trenzado' },
];

const weightOptions = [
  { value: 'LIGHTWEIGHT', label: 'Ligero' },
  { value: 'MEDIUMWEIGHT', label: 'Medio' },
  { value: 'HEAVYWEIGHT', label: 'Pesado' },
];

const sheernessOptions = [
  { value: 'OPAQUE', label: 'Opaco' },
  { value: ' SEMI_TRANSPARENT', label: 'Semitransparente' },
  { value: 'TRANSPARENT', label: 'Transparente' },
];
</script>
