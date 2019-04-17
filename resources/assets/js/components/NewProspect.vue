<style>
    .clickable {
        cursor: pointer;
    }
</style>

<template>
    <modal name="new-prospect-modal"
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
                        New Prospect
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

                                    <input class="c-input" type="text" placeholder="Quincomm" v-model="data.prospect.company_name" autocomplete="nope">

                                    <span v-if="utilities.errors && utilities.errors.company_name" class="u-text-danger u-text-small">{{ utilities.errors.company_name[0] }}</span> <br/>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="c-field">
                                    <label class="c-field__label">
                                        Industry
                                    </label>

                                    <input class="c-input" type="text" placeholder="Procurement" v-model="data.prospect.industry" autocomplete="nope">

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

                                    <input class="c-input" type="text" placeholder="www.quincomm.co.uk" v-model="data.prospect.website" autocomplete="nope">

                                    <span v-if="utilities.errors && utilities.errors.website" class="u-text-danger u-text-small">{{ utilities.errors.website[0] }}</span> <br/>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="c-field">
                                    <label class="c-field__label">
                                        Number Of Employees
                                    </label>

                                    <input class="c-input" type="number" placeholder="20" v-model="data.prospect.number_of_employees" autocomplete="nope">

                                    <span v-if="utilities.errors && utilities.errors.number_of_employees" class="u-text-danger u-text-small">{{ utilities.errors.number_of_employees[0] }}</span> <br/>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <h4>
                                    Contacts

                                    <i class="fa fa-plus-circle u-text-success clickable" @click="addContact"></i>
                                </h4>

                                <span v-if="utilities.errors && utilities.errors.contacts" class="u-text-danger u-text-small">{{ utilities.errors.contacts[0] }}</span> <br/>
                            </div>
                        </div>

                        <div class="u-mb-small u-border-bottom" v-for="(contact, index) in data.prospect.contacts">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="c-field">
                                        <label class="c-field__label">
                                            Name
                                        </label>

                                        <input class="c-input" type="text" placeholder="Tom Jones" v-model="contact.name" autocomplete="nope">

                                        <span v-if="utilities.errors && utilities.errors['contacts.'+ index + '.name']" class="u-text-danger u-text-small">{{ utilities.errors['contacts.'+ index + '.name'][0] }}</span> <br/>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="c-field">
                                        <label class="c-field__label">
                                            Job Title
                                        </label>

                                        <input class="c-input" type="text" placeholder="Word Smith" v-model="contact.job_title" autocomplete="nope">

                                        <span v-if="utilities.errors && utilities.errors['contacts.'+ index + '.job_title']" class="u-text-danger u-text-small">{{ utilities.errors['contacts.'+ index + '.job_title'][0] }}</span> <br/>
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

                                        <span v-if="utilities.errors && utilities.errors['contacts.'+ index + '.landline_phone_number']" class="u-text-danger u-text-small">{{ utilities.errors['contacts.'+ index + '.landline_phone_number'][0] }}</span> <br/>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="c-field">
                                        <label class="c-field__label">
                                            Mobile Phone Number
                                        </label>

                                        <input class="c-input" type="text" placeholder="07234 567890" v-model="contact.mobile_phone_number" autocomplete="nope">

                                        <span v-if="utilities.errors && utilities.errors['contacts.'+ index + '.mobile_phone_number']" class="u-text-danger u-text-small">{{ utilities.errors['contacts.'+ index + '.mobile_phone_number'][0] }}</span> <br/>
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

                                        <span v-if="utilities.errors && utilities.errors['contacts.'+ index + '.email']" class="u-text-danger u-text-small">{{ utilities.errors['contacts.'+ index + '.email'][0] }}</span> <br/>
                                    </div>
                                </div>

                                <div class="col-md-6 u-flex justify-content-end u-align-items-end" v-if="index !== 0">
                                    <i class="fa fa-minus-circle fa-2x clickable u-text-danger" @click="removeContact(index)"></i>
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
        methods: {
            removeContact(index) {
                this.data.prospect.contacts.splice(index, 1)
            },
            addContact() {
                this.data.prospect.contacts.push({
                    name: '',
                    landline_phone_number: '',
                    mobile_phone_number: '',
                    email: '',
                    job_title: '',
                })
            },
            submitForm() {
                let self = this

                self.utilities.errors = null
                self.utilities.saving = true

                axios.post('/api/prospects', self.data.prospect)
                    .then(function (response) {
                        window.location.replace('/prospects/' + response.data.id)
                    })
                    .catch(function (error) {
                        if (error.response && error.response.status === 422) {
                            self.utilities.saving = false

                            self.utilities.errors = error.response.data.errors
                        }
                    })
            },
            showModal() {
                this.$modal.show('new-prospect-modal')
            },
            hideModal() {
                this.$modal.hide('new-prospect-modal')
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
