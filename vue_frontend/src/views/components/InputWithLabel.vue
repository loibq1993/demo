<template>
  <CInputGroup class="mb-3">
    <CInputGroupText id="inputGroup-sizing-default" class="text-capitalize" v-if="placeholderTitle"
    >{{placeholderTitle}}
    </CInputGroupText>
    <CFormInput
      v-bind:name="title"
      aria-label="Sizing example input"
      aria-describedby="inputGroup-sizing-default"
      v-on:change="changeTitle($event.target.value)"
    />
  </CInputGroup>
</template>

<script>
export default {
  props: ['title', 'placeholderTitle'],
  methods: {
    changeTitle(value) {
      this.$emit('changeTitle', value)
    }
  }
}
</script>
