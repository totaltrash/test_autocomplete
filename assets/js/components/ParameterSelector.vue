<template>
    <div class="selector-container">
        <div class="d-none">
            <input v-for="p in selectedItems" :key="p.id" type="checkbox" :name="fieldName" :value="p.id" checked />
        </div>
        <input type="text" @keydown.esc="filter=''" v-model="filter" class="form-control" placeholder="Search for parameter" ref="filter" />
        <b-list-group class="mt-1 shadow-lg parameter-list-group">
            <b-list-group-item v-if="filtered.length > 0" variant="light" class="font-italic font-weight-bold">Add parameter:</b-list-group-item>
            <b-list-group-item href="#" @keydown.esc="$refs.filter.focus()" @click="select(p.id)" v-for="p in filtered" :key="p.id">{{ p.label }}</b-list-group-item>
        </b-list-group>
        <b-list-group class="mt-2">
            <b-list-group-item v-if="selectedItems.length == 0" class="font-italic">No parameters selected</b-list-group-item>
            <b-list-group-item v-for="p in selectedItems" :key="p.id" class="d-flex justify-content-between align-items-center">
                {{ p.label }}
                <a @click.prevent="unselect(p.id)" href="#">
                    <i class="fas fa-times"></i>
                </a>
            </b-list-group-item>
        </b-list-group>
    </div>
</template>

<script>
export default {
  props: {
    fieldName: {
      type: String,
      required: true
    },
    choices: {
      type: Object,
      required: true
    },
    selected: {
      type: Array,
      required: true
    }
  },
  data() {
    return {
      selectedIds: this.selected,
      all: Object.values(this.choices),
      filter: ''
    }
  },
  computed: {
    available() {
      return this.all.filter(p => !this.selectedIds.includes(p.id))
    },
    selectedItems() {
      return this.all.filter(p => this.selectedIds.includes(p.id))
    },
    filtered() {
      let filter = this.filter.toLowerCase()
      if (filter === '' || filter.length < 2) {
        return []
      }
      return this.available.filter(p => p.label.toLowerCase().includes(filter))
    }
  },
  methods: {
    select(id) {
      this.selectedIds.push(id)
      this.filter = ''
      this.$refs.filter.focus()
    },
    unselect(id) {
      this.selectedIds = this.selectedIds.filter(
        selectedId => selectedId !== id
      )
      this.$refs.filter.focus()
    }
  }
}
</script>

<style scoped>
.parameter-list-group {
  position: absolute;
  overflow-y: auto;
  max-height: 350px;
  z-index: 999;
  width: 100%;
}
.selector-container {
  position: relative;
}
</style>