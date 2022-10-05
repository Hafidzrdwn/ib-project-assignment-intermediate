<template>
  <div>
    <Heading title="Keranjang Belanja" classProps="h2 mt-4 mb-3" :count="cartsCount" />
    <Table 
    :datas="carts" :columns="columns" 
    :withFooter="true" :footers="footers"
    emptyMessage="Keranjang belanja kosong."
    />
  </div>
</template>

<script>
import Heading from './HeadingComponent.vue'
import Table from './TableComponent.vue'
import toRupiah from '@develoka/angka-rupiah-js'

export default {
  name: 'Cart',
  computed: {
    cartsCount() {
      return ` (${this.carts.length})`
    }
  },
  data() {
    return {
      carts: [],
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
          field: 'price'
        },
      ],
      footers: [
        {
          value: 'Total'
        },
        {
          value: '0'
        },
        {
          value: toRupiah(0, {formal:false,floatingPoint: 0})
        }
      ]
    }
  },
  components: {
    Heading,
    Table
  }
}
</script>

<style>

</style>