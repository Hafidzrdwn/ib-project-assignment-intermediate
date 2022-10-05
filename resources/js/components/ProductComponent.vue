<template>
  <div>
    <Heading title="Semua Produk" classProps="h2 mt-4 mb-3" :count="productsCount" />
    <Table :datas="formatedProducts" :columns="columns" :giveAction="getStockAllProducts > 0">
      <template #action="{data}">
        <div v-if="data.stock > 0">
          <Button text="Add to Cart" color="btn-outline-primary" @emitClick="addCart(data)" />
          <Button text="Add all stock" @emitClick="addAllStock(data)" />
        </div>
      </template>
    </Table>
  </div>
</template>

<script>
import Heading from './HeadingComponent.vue'
import Table from './TableComponent.vue'
import Button from './ButtonComponent.vue'
import toRupiah from '@develoka/angka-rupiah-js';

export default {
  name: 'Product',
  props: ['products'],
  computed: {
    getStockAllProducts() {
      return this.products.reduce((acc, product) => {
        return acc + product.stock
      }, 0)
    },
    productsCount () {
      return ` (${this.products.length})`
    },
    formatedProducts () {
      return this.products.map(product => {
        return {
          id: product.id,
          name: product.name,
          desc: product.desc,
          price: toRupiah(product.price, {formal:false,floatingPoint: 0}),
          stock: product.stock,
          total: product.total,
          qty: product.qty
        }
      })
    }
  },
  data() {
    return {
      columns: [
        {
          title: 'Name',
          field: 'name'
        },
        {
          title: 'Description',
          field: 'desc'
        },
        {
          title: 'Stock',
          field: 'stock'
        },
        {
          title: 'Price',
          field: 'price'
        }
      ]
    }
  },
  components: {
    Heading,
    Table,
    Button
  },
  methods: {
    addCart(data) {
      const id = data.id
      this.$emit('addItem', id)
    },
    addAllStock(data) {
      const id = data.id
      this.$emit('addAllStock', id)
    }
  }
}
</script>

<style>

</style>