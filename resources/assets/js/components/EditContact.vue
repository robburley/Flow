<style>
    .clickable {
        cursor: pointer;
    }
</style>

<template>
    <div>
        <a style="position: absolute; top: 20px; right: 20px;">
            <i class="fa fa-cog" @click="showModal"></i>
        </a>

        <modal :name="'edit-'+ this.contact.id +'-contact-modal'"
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
                            Edit Contact
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

                                        <input class="c-input" type="text" placeholder="Tom Jones" v-model="contact.name" autocomplete="nope">

                                        <span v-if="utilities.errors && utilities.errors['name']" class="u-text-danger u-text-small">{{ utilities.errors['name'][0] }}</span> <br/>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="c-field">
                                        <label class="c-field__label">
                                            Job Title
                                        </label>

                                        <input class="c-input" type="text" placeholder="Word Smith" v-model="contact.job_title" autocomplete="nope">

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

                                        <input class="c-input" type="text" placeholder="01234 567890" v-model="contact.landline_phone_number" autocomplete="nope">

                                        <span v-if="utilities.errors && utilities.errors['landline_phone_number']" class="u-text-danger u-text-small">{{ utilities.errors['landline_phone_number'][0] }}</span> <br/>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="c-field">
                                        <label class="c-field__label">
                                            Mobile Phone Number
                                        </label>

                                        <input class="c-input" type="text" placeholder="07234 567890" v-model="contact.mobile_phone_number" autocomplete="nope">

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

                                        <input class="c-input" type="text" placeholder="tom.jones@quincomm.co.uk" v-model="contact.email" autocomplete="nope">

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

                                    <a class="c-btn c-btn--secondary  pull-right u-mr-small" :disabled="utilities.saving" @click="removeContact(contact)">
                                        <i class="fa fa-fw fa-minus-circle fa-2x clickable u-text-danger"></i>

                                        Delete
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </modal>
    </div>
</template>

<script>
    export default {
        props: [
            'contact',
            'prospect',
        ],
        methods: {
            removeContact(contact) {
                let self = this

                axios.delete('/api/prospects/' + self.prospect.id + '/contacts/' + contact.id)
                    .then(function (response) {
                        console.log('0')
                        console.log(contact)
                        self.$emit('deleted', self.contact)

                        self.hideModal()

                        self.utilities.saving = false
                    })
            },
            submitForm() {
                let self = this

                self.utilities.errors = null
                self.utilities.saving = true

                axios.post('/api/prospects/' + self.prospect.id + '/contacts/' + self.contact.id, self.data.contact)
                    .then(function (response) {
                        self.hideModal()

                        self.utilities.saving = false
                    })
                    .catch(function (error) {
                        if (error.response && error.response.status === 422) {
                            self.utilities.saving = false

                            self.utilities.errors = error.response.data.errors
                        }
                    })
            },
            showModal() {
                this.$modal.show('edit-' + this.contact.id + '-contact-modal')
            },
            hideModal() {
                this.$modal.hide('edit-' + this.contact.id + '-contact-modal')
            },
        },
        data() {
            return {
                data: {
                    contact: {},
                },
                utilities: {
                    errors: null,
                    saving: false,
                },
            }
        },
        mounted() {
            this.data.contact = this.contact
        },
    }
</script>
