<template>
  <div class="modal" tabindex="-1" role="dialog" ref="mealSearchModal">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Vyhledání jídla</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <input class="form-control font-control-sm text-center" type="text" placeholder="zadejte část názvu jídla pro vyhledání..." v-model="searchString"/>
            <table class="table table-sm table-hover">
                <tbody>
                    <tr v-for="elm in filtered" style="cursor: pointer" @click="$emit('selected', menuIndex, dayIndex, mealIndex, elm)">
                        <td>{{ elm.ammount }}</td>
                        <td>{{ elm.name }}</td>
                        <td>{{ elm.alergens }}</td>
                        <td class="text-right">{{ elm.price }} Kč</td>
                    </tr>
                </tbody>
            </table>
            <div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Zavřít</button>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
    name: 'MealSearchComponent',
    props: ['restaurantId'],
    data: function() {
        return {
            searchString: '',
            soup: [],
            main: [],
            desert: [],
            text: [],
            menuIndex: null,
            dayIndex: null,
            mealIndex: null,
            meal: {}

        }
    },
    methods: {
        openModal(menuIndex, dayIndex, mealIndex, meal) {
            this.searchString = '';
            this.meal = meal;
            this.menuIndex = menuIndex;
            this.dayIndex = dayIndex;
            this.mealIndex = mealIndex;
            $(this.$refs['mealSearchModal']).modal('show');
            $(this.$refs['mealSearchModal']).find('input').focus();
        },
        closeModal() {
            $(this.$refs['mealSearchModal']).modal('hide');
        }

    },
    mounted() {
        let soup = this.soup;
        let main = this.main;
        let desert = this.desert;
        let text = this.text;
        axios.get('/menu/mealHistory/'+this.restaurantId).then(function(response) {

            response.data.forEach(element=> {
                if(element.type == 'soup') {
                    soup.push({name: element.name, price: element.price, alergens: element.alergens, ammount: element.ammount});
                }
                else if(element.type == 'main') {
                    main.push({name: element.name, price: element.price, alergens: element.alergens, ammount: element.ammount});
                }
                else if(element.type == 'desert') {
                    desert.push({name: element.name, price: element.price, alergens: element.alergens, ammount: element.ammount});
                }
                else if(element.type == 'text') {
                    text.push({name: element.name, price: element.price, alergens: element.alergens, ammount: element.ammount});
                }

            });
        });
    },
    computed: {
        filtered: function() {

            var str = this.searchString;
            var arr = [];
            if(this.meal.type == 'soup') { arr = this.soup }
            else if(this.meal.type == 'main') { arr = this.main }
            else if(this.meal.type == 'desert') { arr = this.desert }
            else if(this.meal.type == 'text') { arr = this.text }


            return arr.filter(function(item) {
                if(item.name.includes(str)) {
                    return true;
                }
                else {return false;}
            });

        }
    }
}
</script>
