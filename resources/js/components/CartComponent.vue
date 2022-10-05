<template>
  <div>
    <Heading title="Keranjang Belanja" classProps="h2 mt-4 mb-3" :count="cartsCount" />
    <Table 
    :datas="carts" :columns="columns" 
    :withFooter="true" :footers="footers"
    emptyMessage="Keranjang belanja kosong."
    :giveAction="(carts.length > 0)"
    >
      <template #action="{data}">
        <Button text="Delete item" color="btn-outline-danger" @emitClick="deleteItem(data)" />
        <Button text="Delete all item" color="btn-danger" @emitClick="deleteAllStock(data)"/>
      </template>
    </Table>
  </div>
</template>

<script>
import Heading from './HeadingComponent.vue'
import Table from './TableComponent.vue'
import Button from './ButtonComponent.vue'
import toRupiah from '@develoka/angka-rupiah-js'

export default {
  name: 'Cart',
  props: ['carts', 'totalQty', 'totalPrice'],
  components: {
    Heading,
    Table,
    Button
  },
  computed: {
    cartsCount() {
      return ` (${this.carts.length})`
    },
  },
  mounted() { 
    if(!localStorage.getItem('carts') || !localStorage.getItem('total_qty') || !localStorage.getItem('total_price')) {
      localStorage.setItem('carts', JSON.stringify(this.carts))
      localStorage.setItem('total_qty', this.totalQty)
      localStorage.setItem('total_price', this.totalPrice)
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
          title: 'Quantity',
          field: 'qty'
        },
        {
          title: 'Price',
          field: 'total'
        },
      ],
      footers: [
        {
          value: 'Total:'
        },
        {
          value: this.totalQty
        },
        {
          value: toRupiah(this.totalPrice, {formal:false,floatingPoint: 0})
        }
      ]
    }
  },
  watch: {
    totalQty: {
      immediate: true,
      handler() {
        this.footers[1].value = this.totalQty
      }
    },
    totalPrice: {
      immediate: true,
      handler() {
        this.footers[2].value = toRupiah(this.totalPrice, {formal:false,floatingPoint: 0})
      }
    }
  },
  methods: {
    deleteItem(data) {
      const id = data.id
      this.$emit('deleteItem', id)
    },
    deleteAllStock(data) {
      const id = data.id
      this.$emit('deleteAllStock', id)
    }
  }
}
</script>

<style>

</style>