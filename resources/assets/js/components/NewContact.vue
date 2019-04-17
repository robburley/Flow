<style>
    .clickable {
        cursor: pointer;
    }
</style>

<template>
    <modal name="new-contact-modal"
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
                        New Contact
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
                                        Name
                                    </label>

                                    <input class="c-input" type="text" placeholder="Tom Jones" v-model="data.contact.name" autocomplete="nope">

                                    <span v-if="utilities.errors && utilities.errors['name']" class="u-text-danger u-text-small">{{ utilities.errors['name'][0] }}</span> <br/>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="c-field">
                                    <label class="c-field__label">
                                        Job Title
                                    </label>

                                    <input class="c-input" type="text" placeholder="Word Smith" v-model="data.contact.job_title" autocomplete="nope">

                                    <span v-if="utilities.errors && utilities.errors['job_title']" class="u-text-danger u-text-small">{{ utilities.errors['job_title'][0] }}</span> <br/>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="c-field">
                                    <label class="c-field__label">
                                        Landline Phone Number
                                    </label>

                                    <input class="c-input" type="text" placeholder="01234 567890" v-model="data.contact.landline_phone_number" autocomplete="nope">

                                    <span v-if="utilities.errors && utilities.errors['landline_phone_number']" class="u-text-danger u-text-small">{{ utilities.errors['landline_phone_number'][0] }}</span> <br/>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="c-field">
                                    <label class="c-field__label">
                                        Mobile Phone Number
                                    </label>

                                    <input class="c-input" type="text" placeholder="07234 567890" v-model="data.contact.mobile_phone_number" autocomplete="nope">

                                    <span v-if="utilities.errors && utilities.errors['mobile_phone_number']" class="u-text-danger u-text-small">{{ utilities.errors['mobile_phone_number'][0] }}</span> <br/>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="c-field">
                                    <label class="c-field__label">
                                        Email
                                    </label>

                                    <input class="c-input" type="text" placeholder="tom.jones@quincomm.co.uk" v-model="data.contact.email" autocomplete="nope">

                                    <span v-if="utilities.errors && utilities.errors['email']" class="u-text-danger u-text-small">{{ utilities.errors['email'][0] }}</span> <br/>
                                </div>
                            </div>

                            <div class="col-md-6">
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

                axios.post('/api/prospects/' + this.prospect.id + '/contacts', self.data.contact)
                    .then(function (response) {

                        self.$emit('added', response.data)

                        self.hideModal()

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
                this.$modal.show('new-contact-modal')
            },
            hideModal() {
                this.$modal.hide('new-contact-modal')
            },
        },
        data() {
            return {
                data: {
                    contact: {
                        name: '',
                        job_title: '',
                        landline_phone_number: '',
                        mobile_phone_number: '',
                        email: '',
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
