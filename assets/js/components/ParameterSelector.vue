<template>
    <div>
        <input v-for="param in sel" :key="param.id" type="checkbox" name="item[parameters][]" :value="param.id" checked />
    </div>
</template>

<script>
export default {
  props: {
    parameters: {
      type: Array,
      required: true
    },
    selected: {
      type: Array,
      required: true
    }
  },
  data() {
    return {
      sel: this.selected
    }
  }
}
</script>
