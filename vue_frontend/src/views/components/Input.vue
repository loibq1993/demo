<template>
  <div class="mb-3 d-flex">
    <input
      v-bind:name="title"
      aria-label="Sizing example input"
      aria-describedby="inputGroup-sizing-default"
      v-on:change="changeTitle($event.target.value)"
      class="form-control"
      v-bind:placeholder="placeholder"
      v-bind:type="type"
    />
  </div>
</template>

<script>
export default {
  props: ['title', 'placeholder', 'type'],
  methods: {
    changeTitle(value) {
      this.$emit('changeTitle', value)
    }
  }
}
</script>
