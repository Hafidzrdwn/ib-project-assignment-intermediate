<template>
  <button type="button" class="btn me-2" :class="color">{{ text }}</button>
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
  }
}
</script>
  
<style>

</style>