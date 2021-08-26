<template>
    <div class="row justify-content-center mt-3">
        <div class="col-xl-4 m-auto">
            <ul class="list-group">
                <li class="list-group-item p-2" v-for="email in emails">
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control" v-model="email.email"/>
                        <div class="input-group-append">
                            <button class="btn btn-danger" type="button" @click="deleteEmail(email.id)"><i class="fas fa-times"></i></button>
                        </div>
                    </div>
                </li>
                <li class="list-group-item p-2">
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control" v-model="newEmail"/>
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button" @click="addNewEmail"><i class="fas fa-plus"></i></button>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>

</template>

<script>
export default {
    name: "MenuEmailsComponent",
    props: ['restaurant'],
    data: function () {
        return {
            newEmail: '',
            emails: []
        }
    },
    mounted() {
        let vm = this;
        axios.get('/menu/getEmails/'+this.restaurant.id).then(function(response) {
            vm.emails = response.data;
        });
    },
    methods: {
        addNewEmail() {
            let vm = this;
            axios.post('/menu/emails/'+this.restaurant.id+'/add', { email: this.newEmail }).then((response) => {
                vm.newEmail = '';
                vm.emails = response.data;
            }).catch(function(error) {
                alert('Chyba při přidávání e-mailu ');
            });
        },
        deleteEmail(id) {
            let vm = this;
            axios.delete('/menu/emails/'+this.restaurant.id+'/'+id).then((response) => {
                vm.emails = response.data;
            }).catch(function(error) {
                alert('Chyba při odstranění e-mailu ');
            });
        }
    }


}
</script>

<style scoped>

</style>
