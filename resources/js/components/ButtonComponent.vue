<template>
  <button type="button" class="btn me-2" @click="eventClick" :class="color">{{ text }}</button>
</template>

<script>
export default {
  name: 'Button',
  props: {
    text: {
      type: String,
      required: true
    },
    color: {
      type: String,
      default: 'btn-primary',
      required: false
    }
  },
  methods: {
    eventClick() {
      this.$emit('emitClick')
    }
  }
}
</script>
  
<style>

</style>