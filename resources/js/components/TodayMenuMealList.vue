<template>
  <ul class="leaders" v-if="day.meals.length > 0">
    <li v-for="meal in day.meals" v-if="meal.type != 'text'">
      <span><img class="meal-type mr-1" :src="'/images/meal_icons/'+meal.type+'.png'" style="height: 20px;"/> <small
          class="text-muted">{{ meal.ammount}}</small> {{ meal.name }}</span>
      <span>{{ meal.price}} Kč</span>
    </li>
    <li class="d-block text-center" v-else>{{ meal.name }}</li>
  </ul>
  <div class="text-center text-muted mb-4" v-else>
    Na tento den nemáme připravené žádné menu
  </div>
</template>
<script>
export default {
  name: 'TodayMenuMealList',
  props: {
    day: {}
  }
}
</script>
