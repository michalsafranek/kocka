<template>
    <div class="modal" tabindex="-1" role="dialog" ref="modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Přidání nového menu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input class="form-control font-control-sm text-center" type="text" placeholder="Název menu..."/>
                    <textarea class="form-control text-center mt-2" placeholder="Text na menu..."></textarea>

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
    name: "AddNewMenuComponent",
    data: function () {
        return {
            year: null,
            week: null,
            caption: '',
            text: ''
        }
    },
    methods: {
        openModal() {
            $(this.$refs['modal']).modal('show');
            // $(this.$refs['modal']).find('input').focus();
        },
        closeModal() {
            $(this.$refs['modal']).modal('hide');
        }

    },
}
</script>

<style scoped>

</style>
