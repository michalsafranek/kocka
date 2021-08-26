<template>
    <div>
        <div class="row mt-3">
            <div class="col-3 ">
                <div class="list-group">
                    <button v-for="(menu, index) in menus" class="list-group-item" :class="index == selectedMenuId ? 'active' : ''" @click="selectedMenuId = index">{{ menu.caption }}<span class="float-right"><i class="fas fa-angle-right"></i></span></button>
                </div>
            </div>
            <div class="col-9">
                <div class="card">
                    <h5 class="card-header">
                        {{ selectedMenuId !== null ? menus[selectedMenuId].caption : 'Není vybráno žádné menu' }}
                        <div class="position-absolute btn-group" style="top:0.45em; right: 0.65em;">
                            <button class="btn btn-sm btn-outline-primary" @click="setDefaultLayout"><i class="fas fa-list"></i> Výchozí layout</button>
                            <button class="btn btn-sm btn-outline-primary"><i class="fas fa-file-alt"></i> PDF</button>
                            <button class="btn btn-sm btn-outline-primary"><i class="fas fa-envelope"></i> Email</button>
                            <button class="btn btn-sm btn-outline-primary"><i class="fas fa-download"></i> Stáhnout</button>
                        </div>
                    </h5>
                    <div class="card-body" v-if="selectedMenuId !== null">
                        <div class="alert alert-warning" v-if="menus[selectedMenuId].changed">
                            <small><i class="fas fa-info-circle"></i> Změny nejsou uloženy</small>
                            <button class="btn btn-sm btn-success position-absolute" style="top:0.65em; right: 0.65em;" @click="saveMenu"><i class="fas fa-save"></i> Uložit</button>
                        </div>
                        <div v-for="(day, dayIndex) in menus[selectedMenuId].days">
                            <h5 class="mt-2">
                                {{ day.date }}

                            </h5>
                            <draggable class="list-group" group="menu" :list="day.meals" @change="setChanged" @start="drag=true" >
                                <li v-for="(meal, mealIndex) in day.meals" class="list-group-item noselect">
                                    <div class="row">
                                        <div class="col-xl-1 py-0 px-3">
                                            <div class="dropdown">
                                                <button class="btn btn-outline-primary dropdown-toggle btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <img :src="'/images/meal_icons/'+meal.type+'.png'"  style="height: 20px;"/>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" @click="changeType(selectedMenuId, dayIndex, mealIndex, 'soup')" href="#"><img :src="'/images/meal_icons/soup.png'" class="mr-2" style="height: 20px;"/> Polévka</a>
                                                    <a class="dropdown-item" @click="changeType(selectedMenuId, dayIndex, mealIndex, 'main')" href="#"><img :src="'/images/meal_icons/main.png'" class="mr-2"  style="height: 20px;"/> Hlavní jídlo</a>
                                                    <a class="dropdown-item" @click="changeType(selectedMenuId, dayIndex, mealIndex, 'desert')" href="#"><img :src="'/images/meal_icons/desert.png'" class="mr-2" style="height: 20px;"/> Dezert</a>
                                                    <a class="dropdown-item" @click="changeType(selectedMenuId, dayIndex, mealIndex, 'text')" href="#"><img :src="'/images/meal_icons/text.png'" class="mr-2" style="height: 20px;"/> Text</a>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-xl-1 px-1" v-if="meal.type != 'text'"><input class="form-control form-control-sm text-right" type="text" v-model="meal.ammount" placeholder="... g" @keyup="setChanged"/></div>
                                        <div class="col-xl-7" v-if="meal.type != 'text'"><input class="form-control form-control-sm" type="text" v-model="meal.name" placeholder="název jídla" @keyup="setChanged"/></div>
                                        <div class="col-xl-10" v-if="meal.type == 'text'"><input class="form-control form-control-sm text-center" type="text" v-model="meal.name" placeholder="zadejte text..." @keyup="setChanged"/></div>
                                        <div class="col-xl-1 px-1" v-if="meal.type != 'text'"><input class="form-control form-control-sm" type="text" v-model="meal.alergens" placeholder="alergeny" @keyup="setChanged"/></div>
                                        <div class="col-xl-1 px-2" v-if="meal.type != 'text'"><input class="form-control form-control-sm text-right" type="text" v-model="meal.price" placeholder="Kč" @keyup="setChanged"/></div>
                                        <div class="col-xl-1 px-1">
                                            <div class="btn-group">
                                                <button class="btn btn-primary btn-sm" @click="$refs.mealSearchComponent.openModal(selectedMenuId,dayIndex, mealIndex, menus[selectedMenuId].days[dayIndex].meals[mealIndex])"><i class="fas fa-search"></i></button>
                                                <button class="btn btn-danger btn-sm" @click="removeMeal(selectedMenuId, dayIndex, mealIndex)"><i class="fas fa-trash-alt"></i></button>
                                            </div>

                                        </div>
                                    </div>

                                </li>
                                <button class="list-group-item list-group-item-action py-1 text-center button-group" @click="add(selectedMenuId, dayIndex)"><small><i class="fas fa-plus"></i> Přidat nové jídlo</small></button>

                            </draggable>
                        </div>

                    </div>
                </div>

            </div>

        </div>
        <MealSearchComponent ref="mealSearchComponent" :restaurant-id="restaurant.id" v-on:selected="mealSelected"></MealSearchComponent>
        <AddNewMenuComponent ref="addNewMenuComponent" :restaurant-id="restaurant.id" ></AddNewMenuComponent>
    </div>

</template>

<script>
import draggable from 'vuedraggable';
import MealSearchComponent from "./MealSearchComponent";
import AddNewMenuComponent from "./AddNewMenuComponent";

export default {
    name: "MenuComponent",
    props: ['restaurant'],
    data: function () {
        return {
            menus: [],
            selectedMenuId: null,
        }
    },

    methods: {
        reload() {
            let vm = this;
            axios.get('/menu/getMenus/'+this.restaurant.id).then(function(response) {
                vm.menus = response.data.menus.reverse();
                if(vm.menus.length > 2) {
                    vm.selectedMenuId = 1;
                }
            });

            //console.log(this.menus);

        },
        mealSelected(menuIndex, dayIndex, mealIndex, elm) {
            this.menus[menuIndex].days[dayIndex].meals[mealIndex].name = elm.name;
            this.menus[menuIndex].days[dayIndex].meals[mealIndex].price = elm.price;
            this.menus[menuIndex].days[dayIndex].meals[mealIndex].alergens = elm.alergens;
            this.menus[menuIndex].days[dayIndex].meals[mealIndex].ammount = elm.ammount;
            this.$refs.mealSearchComponent.closeModal();
            this.setChanged();
        },
        log: function(evt) {
            console.log(evt);
        },
        removeMeal(menuIndex,dayIndex, mealIndex) {
            this.menus[menuIndex].days[dayIndex].meals.splice(mealIndex, 1);
            this.setChanged();
        },
        add(menuIndex, dayindex, type) {
            if(type) {
                this.menus[menuIndex].days[dayindex].meals.push({ type: type, ammount: '', name: '', price: '', alergens: ''});
            }
            else {
                if(this.menus[menuIndex].days[dayindex].meals.length == 0) {
                    this.menus[menuIndex].days[dayindex].meals.push({ type: 'soup', ammount: '', name: '', price: '', alergens: ''});
                }
                else {
                    this.menus[menuIndex].days[dayindex].meals.push({ type: 'main', ammount: '', name: '', price: '', alergens: ''});
                }
            }

            this.setChanged();
        },
        setChanged() {
            this.menus[this.selectedMenuId].changed = true;
        },
        changeType(menuIndex, dayindex, mealIndex, type) {
            this.menus[menuIndex].days[dayindex].meals[mealIndex].type = type;
            this.menus[menuIndex].changed = true;
        },

        setDefaultLayout() {
            // Kocka
            if(this.restaurant.id == 1) {
                this.menus[this.selectedMenuId].days.forEach((day, dayIndex) => {
                    for(let i=day.meals.length; i<5; i++) {
                        this.add(this.selectedMenuId, dayIndex);
                        if(day.meals.length == 5) {
                            this.add(this.selectedMenuId, dayIndex, 'desert');
                        }
                    }
                });

            }
            // Zamek
            else if(this.restaurant.id == 2) {
                this.menus[this.selectedMenuId].days.forEach((day, dayIndex) => {
                    for(let i=day.meals.length; i<3; i++) {
                        this.add(this.selectedMenuId, dayIndex);
                        if(day.meals.length == 3) {
                            this.add(this.selectedMenuId, dayIndex, 'desert');
                        }
                    }
                });
            }

        },
        saveMenu() {
            // console.log(this.restaurant.id);
            let v = this;
            axios.post('/menu/'+this.restaurant.id, {menu: this.menus[this.selectedMenuId] })
                .then((response) => {
                    v.menus[v.selectedMenuId].changed = false;
                })
                .catch((error) => {
                    alert('Chyba při ukládání menu');
                });
        }
    },
    components : {AddNewMenuComponent, MealSearchComponent, draggable },
    mounted() {
        this.reload();
    },




}
</script>

<style scoped>
.noselect {
    -webkit-touch-callout: none; /* iOS Safari */
    -webkit-user-select: none; /* Safari */
    -khtml-user-select: none; /* Konqueror HTML */
    -moz-user-select: none; /* Old versions of Firefox */
    -ms-user-select: none; /* Internet Explorer/Edge */
    user-select: none; /* Non-prefixed version, currently
                                  supported by Chrome, Edge, Opera and Firefox */
}
</style>
