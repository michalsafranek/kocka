<template>
    <div>
        <nav class="navbar navbar-expand-xl navbar-dark bg-dark">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <ul class="navbar-nav mr-auto">
                <li class="nav-item text-white">
                    Správa menu - {{ restaurant.name }}
                </li>
            </ul>
        </nav>
        <div class="row mt-3">
            <div class="col-3 ">
                <div class="list-group">
                    <button v-for="(menu, index) in menus" class="list-group-item" :class="index == selectedMenuId ? 'active' : ''" @click="selectedMenuId = index">{{ menu.caption }}<span class="float-right"><i class="fas fa-angle-right"></i></span></button>
                </div>
            </div>
            <div class="col-9">
                <div class="card">
                    <div class="card-header">
                        <h5>{{ menus[selectedMenuId].caption }}</h5>
                    </div>
                    <div class="card-body">
                        sas
                    </div>
                </div>

            </div>

        </div>
    </div>
</template>

<script>
export default {
    name: "MenuComponent",
    props: ['restaurant'],
    data: function () {
        return {
            menus: [
                {
                    id: 1,
                    year: 2021,
                    week: 32,
                    caption: 'Menu od 8.8 do 15.8. 2021',
                    text: '',
                    menuContent: [
                        {
                            day: 0,
                            meals: [
                                { type: 'soup', ammount: '', name: 'Kmínová polévka', price: '45', alergens: '1,2,3'}

                            ]
                        }
                    ]
                },
                {
                    id: 2,
                    year: 2021,
                    week: 33,
                    caption: 'Menu od 16.8. do 23.8.',
                    text: '',
                    menuContent: [
                        {
                            day: 0,
                            meals: [
                                { type: 'soup', ammount: '', name: 'Kmínová polévka', price: '45', alergens: '1,2,3'}

                            ]
                        }
                    ]
                }
            ],
            selectedMenuId: 0
        }
    },
    methods: {
        reload() {

        }

    },
    mounted() {
        this.reload();
    }


}
</script>

<style scoped>

</style>
