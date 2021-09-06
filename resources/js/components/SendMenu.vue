<template>
    <div class="row justify-content-center">
        <div class="col-6 mt-3">

                <div class="form-group">
                    <label for="caption">Předmět</label>
                    <input type="text" class="form-control" id="caption"  placeholder="Předmět e-mailu" v-model="captionValue">
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-6 text-center">
                        <button class="btn btn-outline-primary btn-block" @click="sendTest()" :disabled="sendingTest"><i class="fas fa-spinner fa-spin" v-if="sendingTest"></i> Odeslat testovací e-mail</button>
                        <small class="text-muted ">E-mail na {{ toEmail }}</small>
                    </div>
                    <div class="col-lg-6">
                        <button class="btn btn-primary btn-block" @click="send()"><i class="fas fa-spinner fa-spin" v-if="sendingRegular"></i> Odeslat na adresy ({{ emails.length }})</button>
                    </div>
                </div>

        </div>
    </div>
</template>

<script>
export default {
    name: "SendMenu",
    props: { menu: {}, restaurant: { name: ''}, emails: [] },
    data() {
        return {
            captionValue: 'Polední menu '+this.restaurant.name+' '+this.menu.caption,
            sendingTest: false,
            sendingRegular: false,
            toEmail: 'ms@dobris.net'
        }
    },
    methods: {
        sendTest() {
            let vm = this;
            this.sendingTest = true;
            axios.post('/menu/send', {
                restaurant: this.menu.restaurant,
                year: this.menu.year,
                week: this.menu.week,
                toEmail: this.toEmail,
                emails: []
            }).then((response) => {
                vm.sendingTest = false;
            }).catch((error) => {
                vm.sendingTest = false;
                alert('Chyba při odesílání e-mailu');
            });
        },
        send() {
            let vm = this;
            this.sendingRegular = true;
            axios.post('/menu/send', {
                restaurant: this.menu.restaurant,
                year: this.menu.year,
                week: this.menu.week,
                toEmail: this.toEmail,
                emails: this.emails
            }).then((response) => {
                vm.sendingRegular = false;
            }).catch((error) => {
                vm.sendingRegular = false;
                alert('Chyba při odesílání e-mailu');
            });
        }
    }
}
</script>

<style scoped>

</style>
