<template>
  <div class="container mt-4 mb-5">
    <Heading title="Supermarket Zaman Now" classProps="text-center" />
    <Product />
    <Cart />
  </div>
</template>

<script>
import Heading from './components/HeadingComponent.vue'
import Product from './components/ProductComponent.vue'
import Cart from './components/CartComponent.vue'

export default {
  name: 'App',
  components: {
    Heading,
    Product,
    Cart
  }
}
</script>

<style>

</style>
