<template>
  <div>
    <div v-for="(category) in options">
      <h2>{{ transformName(category.name) }}</h2>
      <div v-for="option in category.options">
        <input type="radio" :value="option.price" v-model="selected[category.name]"> <strong>{{ option.name }}</strong> -
        {{ option.price }} $
      </div>
    </div>
    <h2>Total price: {{ totalPrice }}</h2>
    <button @click="confirmSelection">Підтвердити вибір</button>
  </div>
</template>

<script>
export default {
  props: ['options', 'basePrice'],
  data() {
    return {
      selected: {}
    }
  },
  methods: {
    transformName(name) {
      switch (name) {
        case 'color': return 'Колір';
        case 'wheels_type': return 'Тип дисків';
        case 'wheels_diameter': return 'Діаметр дисків';
        case 'seats_type': return 'Тип сидінь';
        case 'additional': return 'Додаткові опції';
        default: return name;
      }
    },
    confirmSelection() {
      // First, we need to map the selected options to an array of IDs
      let selectedIds = Object.values(this.selected).map(option => option.id);

      // Now you can send this array to your backend
      // For example, using axios (make sure to install it if you haven't already)

      axios.post('/api/order', selectedIds)
        .then(response => {
          // handle success
          console.log(response);
        })
        .catch(error => {
          // handle error
          console.log(error);
        })
    }
  },
  computed: {
    totalPrice() {
      let total = parseFloat(this.basePrice)
      for (let key in this.selected) {
        total += parseFloat(this.selected[key])
      }
      return total.toFixed(2)
    }
  }
}
</script>