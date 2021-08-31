<template>
    <div class="row justify-content-center">
        <div class="col-xl-10">
            <div v-for="(day, dayIndex) in menu.days" v-if="showFullMenu && dayIndex < 7">
                <h3>{{ dayName(day.day) }} <small class="text-muted">{{ day.date }}</small></h3>
                <TodayMenuMealList :day="day"/>
            </div>
            <div v-if="!showFullMenu">
                <h3>Dnešní menu <small class="text-muted">{{ menu.today.date }}</small></h3>
                <TodayMenuMealList :day="menu.today"/>
                <h3>Zítřejší menu <small class="text-muted">{{ menu.tommorow.date }}</small></h3>
                <TodayMenuMealList :day="menu.tommorow"/>
            </div>
            <div class="text-center">
                <button class="btn btn-outline-primary" @click="showFullMenu = true" v-if="!showFullMenu">Zobrazit menu na celý týden</button>
            </div>

        </div>
    </div>
</template>

<script>
import TodayMenuMealList from "./TodayMenuMealList";

export default {
    name: "TodayMenu",
    components: {TodayMenuMealList},
    data() {
        return {
            menu: {
                days: [],
                today: { date: '', meals: []},
                tommorow: { date: '', meals: []}
            },
            error: false,
            showFullMenu: false
        }
    },
    mounted() {
        let vm = this;
        axios.get('/todayMenu').then((response) => {
            vm.error = false;
            vm.menu = response.data;
            vm.todayMenu();
        }).catch((error) => {
            vm.error = "Nelze stáhnout informace o menua";
        });
    },
    methods: {
        dayName(day) {
            switch (day) {
                case 0: return "Pondělí";
                case 1: return "Úterý";
                case 2: return "Středa";
                case 3: return "Čtvrtek";
                case 4: return "Pátek";
                case 5: return "Sobota";
                case 6: return "Neděle";
                default: return day;
            }
        }
    }

}
</script>

