<template>
  <div>
    <Heading title="Semua Produk" classProps="h2 mt-4 mb-3" :count="productsCount" />
    <Table :datas="formatedProducts" :columns="columns">
      <template v-slot:action>
        <Button text="Add to Cart" color="btn-outline-primary" />
        <Button text="Add all item" />
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
  mounted () {
    console.log(this.products)
  },
  computed: {
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
        }
      })
    }
  },
  data() {
    return {
      products: [
        {
          id: 1,
          name: 'Indomie Goreng Rendang',
          desc: 'Masakan instan terenak di dunia',
          price: 3900,
          stock: 55
        },
        {
          id: 2,
          name: 'Mie Gelas Rendang',
          desc: 'Mie instant khusus anak kosan',
          price: 1500,
          stock: 25
        },
        {
          id: 3,
          name: 'Bakmi Mewah',
          desc: 'Kalau anak kosan jangan macam2 deh',
          price: 10000,
          stock: 80
        },
      ],
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
  }
}
</script>

<style>

</style>