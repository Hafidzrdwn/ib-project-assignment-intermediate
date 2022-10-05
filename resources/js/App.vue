<template>
  <div class="container mt-4 mb-5">
    <Heading title="Warung Zaman Now" classProps="text-center" />
    <Product :products="products" @addItem="addOneItem" @addAllStock="addAllItem" />
    <Cart :carts="carts" :totalQty="total_qty" :totalPrice="total_price"
          @deleteItem="deleteOneItem" @deleteAllStock="deleteAllItem" />
    <Button text="Checkout" color="mt-3 btn-success" @emitClick="checkout" :disabled="carts.length === 0" />
  </div>
</template>

<script>
import Heading from './components/HeadingComponent.vue'
import Product from './components/ProductComponent.vue'
import Cart from './components/CartComponent.vue'
import Button from './components/ButtonComponent.vue'

import toRupiah from '@develoka/angka-rupiah-js'
import Swal from 'sweetalert2'

export default {
  name: 'App',
  components: {
    Heading,
    Product,
    Cart,
    Button
  },
  data() {
    return {
      total_qty: 0,
      total_price: 0,
      carts: [],
      products: [
        {
          id: 1,
          name: 'Indomie Goreng Rendang',
          desc: 'Masakan instan terenak di dunia',
          price: 3900,
          stock: 15,
          total: 0,
          qty: 0
        },
        {
          id: 2,
          name: 'Mie Gelas Rendang',
          desc: 'Mie instant khusus anak kosan',
          price: 1500,
          stock: 28,
          total: 0,
          qty: 0
        },
        {
          id: 3,
          name: 'Bakmi Mewah',
          desc: 'Kalau anak kosan jangan macam2 deh',
          price: 10000,
          stock: 55,
          total: 0,
          qty: 0
        },
      ],
    }
  },
  methods: {
    pushToCart(data, product) {
      if(this.carts.find(cart => cart.name === data.name)) {
        this.carts = this.carts.map(cart => {
          if(cart.name === data.name) {
            cart.qty = product.qty
            cart.total = toRupiah(product.price * cart.qty, { formal: false, floatingPoint: 0 })
          }
          return cart
        })
      } else {
        this.carts.push(data)
      }

      this.updateTotal(this.carts)
    },
    findProductInCart(id) {
      return this.carts.find(cart => cart.id === id)
    },
    updateTotal(carts) {
      this.totalQty(carts)
      this.totalPrice(carts)
    },
    addOneItem(id) {
      this.products = this.products.map(product => {
        if (product.id === id) {
          product.stock -= 1
          product.qty += 1
        }
        return product
      })

      const product = this.products.filter(product => product.id === id)[0]
      product.total = toRupiah(product.price * product.qty, { formal: false, floatingPoint: 0 })

      const data = {
        id: Date.now(),
        name: product.name,
        qty: product.qty,
        price: product.price,
        total: product.total
      }

      this.pushToCart(data, product)
    },
    addAllItem(id) {
      this.products = this.products.map(product => {
        if (product.id === id) {
          product.qty += product.stock
          product.total = toRupiah(product.price * product.qty, { formal: false, floatingPoint: 0 })
          product.stock = 0
        }
        return product
      })

      const product = this.products.filter(product => product.id === id)[0]

      const data = {
        id: Date.now(),
        name: product.name,
        qty: product.qty,
        price: product.price,
        total: product.total
      }

      this.pushToCart(data, product)
    },
    deleteOneItem(id) {
      const prd = this.findProductInCart(id)

      this.products = this.products.map(product => {
        if (product.name === prd.name) {
          product.stock += 1
          product.qty -= 1
          product.total = toRupiah(product.price * product.qty, { formal: false, floatingPoint: 0 })
        }
        return product
      })

      if (prd.qty > 1) {
        this.carts = this.carts.map(cart => {
          if (cart.id === id) {
              cart.qty -= 1
              cart.total = toRupiah(cart.price * cart.qty, { formal: false, floatingPoint: 0 })
          }
          return cart
        })
      } else {
        this.carts = this.carts.filter(cart => cart.id !== id)
      }

      this.updateTotal(this.carts)
    },
    deleteAllItem(id) {
      const prd = this.findProductInCart(id)

      this.products = this.products.map(product => {
        if (product.name === prd.name) {
          product.stock += prd.qty
          product.qty = 0
          product.total = toRupiah(product.price * product.qty, { formal: false, floatingPoint: 0 })
        }
        return product
      })


      this.carts = this.carts.filter(cart => cart.id !== id)
      this.updateTotal(this.carts)
    },
    totalQty(carts) {
      let total = 0
      carts.forEach(cart => {
        total += cart.qty
      })
      this.total_qty = total
    },
    totalPrice() {
      let total = 0
      this.carts.forEach(cart => {
        total += cart.price * cart.qty
      })

      this.total_price = total
    },
    checkout() {
      Swal.fire({
        title: 'Checkout',
        text: 'Are you sure to checkout?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, checkout!'
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire(
            'Your order has been checkout!',
            'You should pay us : ' + toRupiah(this.total_price, { formal: false, floatingPoint: 0 }),
            'success'
          )
          this.total_qty = 0
          this.total_price = 0
          this.carts = []

        }
      })
    }
  }
}
</script>

<style>

</style>
