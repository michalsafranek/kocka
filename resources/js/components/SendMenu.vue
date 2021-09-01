<template>
    <div class="row justify-content-center">
        <div class="col-6 mt-3">

                <div class="form-group">
                    <label for="caption">Předmět</label>
                    <input type="text" class="form-control" id="caption"  placeholder="Předmět e-mailu" v-model="captionValue">
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-6 text-center">
                        <button class="btn btn-outline-primary btn-block" @click="sendTest()">Odeslat testovací e-mail</button>
                        <small class="text-muted ">E-mail na zamek.dobris@seznam.cz</small>
                    </div>
                    <div class="col-lg-6">
                        <button class="btn btn-primary btn-block">Odeslat na adresy ({{ emails.length }})</button>

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
            captionValue: 'Polední menu '+this.restaurant.name+' '+this.menu.caption
        }
    },
    methods: {
        sendTest() {
            axios.post('/menu/send', {}).then((response) => {

            }).catch((error) => {
                console.log(error);
            })
        }
    }
}
</script>

<style scoped>

</style>
