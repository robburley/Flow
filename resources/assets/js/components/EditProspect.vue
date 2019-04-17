<style>
    .clickable {
        cursor: pointer;
    }
</style>

<template>
    <modal name="edit-prospect-modal"
           :adaptive="true"
           height="auto"
           :pivotY="0.1"
           classes=""
           width="930"
           :scrollable="true"
    >
        <div class="u-m-small" role="document">
            <div class="c-modal__content">
                <div class="c-modal__header">
                    <h3 class="c-modal__title">
                        Edit Prospect
                    </h3>

                    <span class="c-modal__close" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-close u-text-danger clickable u-ml-auto" @click="hideModal"></i>
                        </span>
                </div>

                <div class="c-modal__body">
                    <form @submit.prevent="submitForm">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="c-field">
                                    <label class="c-field__label">
                                        Company Name
                                    </label>

                                    <input class="c-input" type="text" placeholder="Quincomm" v-model="prospect.company_name" autocomplete="nope">

                                    <span v-if="utilities.errors && utilities.errors.company_name" class="u-text-danger u-text-small">{{ utilities.errors.company_name[0] }}</span> <br/>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="c-field">
                                    <label class="c-field__label">
                                        Industry
                                    </label>

                                    <input class="c-input" type="text" placeholder="Procurement" v-model="prospect.industry" autocomplete="nope">

                                    <span v-if="utilities.errors && utilities.errors.industry" class="u-text-danger u-text-small">{{ utilities.errors.industry[0] }}</span> <br/>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-8">
                                <div class="c-field">
                                    <label class="c-field__label">
                                        Website
                                    </label>

                                    <input class="c-input" type="text" placeholder="www.quincomm.co.uk" v-model="prospect.website" autocomplete="nope">

                                    <span v-if="utilities.errors && utilities.errors.website" class="u-text-danger u-text-small">{{ utilities.errors.website[0] }}</span> <br/>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="c-field">
                                    <label class="c-field__label">
                                        Number Of Employees
                                    </label>

                                    <input class="c-input" type="number" placeholder="20" v-model="prospect.number_of_employees" autocomplete="nope">

                                    <span v-if="utilities.errors && utilities.errors.number_of_employees" class="u-text-danger u-text-small">{{ utilities.errors.number_of_employees[0] }}</span> <br/>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <button class="c-btn c-btn--success pull-right" :disabled="utilities.saving">
                                    <i class="fa fa-fw fa-save" v-if="!utilities.saving"></i>
                                    <i class="fa fa-fw fa-spinner fa-spin" v-else></i>

                                    <span v-if="!utilities.saving">Save</span>
                                    <span v-else>Saving</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </modal>
</template>

<script>
    export default {
        props: {
            prospect: {
                required: true,
            },
            reload: {
                required: false,
                default: false,
            },
        },
        methods: {
            submitForm() {
                let self = this

                self.utilities.errors = null
                self.utilities.saving = true

                axios.post('/api/prospects/' + self.prospect.id, self.prospect)
                    .then(function (response) {
                        self.hideModal()

                        self.$emit('updated', response.data)

                        self.utilities.saving = false

                        if (self.reload) {
                            location.reload()
                        }
                    })
                    .catch(function (error) {
                        if (error.response && error.response.status === 422) {
                            self.utilities.saving = false

                            self.utilities.errors = error.response.data.errors
                        }
                    })
            },
            showModal() {
                this.$modal.show('edit-prospect-modal')
            },
            hideModal() {
                this.$modal.hide('edit-prospect-modal')
            },
        },
        data() {
            return {
                data: {
                    prospect: {
                        company_name: '',
                        number_of_employees: '',
                        industry: '',
                        website: '',
                        contacts: [
                            {
                                name: '',
                                landline_phone_number: '',
                                mobile_phone_number: '',
                                email: '',
                                job_title: '',
                            },
                        ],
                    },
                },
                utilities: {
                    errors: null,
                    saving: false,
                },
            }
        },
        mounted() {
        },
    }
</script>
