<template>
  <div class="card">
    <div class="card-body">
      <table class="table table-hover">
        <thead>
          <tr>
            <th v-for="(column, index) in columns" :key="index">
              {{ column.title }}
            </th>
            <th v-if="giveAction">Action</th>
          </tr>
        </thead>
        <tbody v-if="datas.length > 0">
          <tr v-for="data in datas" :key="data.id">
            <td v-for="(column, index) in columns" :key="index">
              {{ data[column.field] }}
            </td>
            <td>
              <slot name="action" :data="data"></slot>
            </td>
          </tr>
        </tbody>
        <tbody v-else>
          <tr>
            <td :colspan="columns.length" class="text-center">
              {{ emptyMessage }}
            </td>
          </tr>
        </tbody>
        <tfoot class="fw-bold" v-if="withFooter">
          <tr>
            <td v-for="(footer, index) in footers" :key="index">
              {{ footer.value }}
            </td>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Table',
  props: {
    datas: {
      type: Array,
      required: true
    },
    columns: {
      type: Array,
      required: true
    },
    footers: {
      type: Array,
      default: () => [],
      required: false
    },
    withFooter: {
      type: Boolean,
      default: false
    },
    emptyMessage: {
      type: String,
      default: 'No data available.'
    },
    giveAction: {
      type: Boolean,
      default: false
    }
  }
}
</script>

<style>

</style>