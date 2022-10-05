<template>
    <h1 :class="classProps">{{ title }}{{ count }}</h1>
</template>

<script>
export default {
  name: 'Heading',
  props: {
    title: {
      type: String,
      required: true
    },
    classProps: {
      type: String,
      default: 'h1 text-start'
    },
    count: {
      type: String,
      default: '',
      required: false
    }
  }
}
</script>