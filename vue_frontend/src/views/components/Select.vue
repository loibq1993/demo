<template>
  <CFormSelect aria-label="Disabled select example" :name="title" v-on:change="onChange($event)">
    <option>Open this select menu</option>
    <option v-for="option in options" :value="option.index"  :key="option.id">{{option.value}}</option>
  </CFormSelect>
</template>

<script>
export default {
  props: {
    title: { type: String },
    options: { type : Array }
  },
  methods: {
    onChange(event) {
      this.$emit('select-changed', event.target.value)
    }
  }
}
</script>
