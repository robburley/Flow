<style>
    .clickable {
        cursor: pointer;
    }
</style>

<template>
    <div class="" v-if="data.prospect">
        <div class="row">
            <div class="col-sm-12">
                <div class="c-card u-p-medium u-text-small u-mb-small">
                    <h3 class="u-text-bold">
                        {{ data.prospect.company_name }}
                    </h3>

                    <div class="u-flex">

                        <p class="u-mr-small" v-if="data.prospect.industry">
                            <i class="fa fa-fw fa-industry u-color-info"></i>

                            {{ data.prospect.industry }}
                        </p>

                        <p class="u-mr-small" v-if="data.prospect.website">
                            <i class="fa fa-fw fa-globe u-color-info"></i>
                            {{ data.prospect.website }}
                        </p>

                        <p class="u-mr-small" v-if="data.prospect.number_of_employees">
                            <i class="fa fa-fw fa-users u-color-info"></i>

                            {{ data.prospect.number_of_employees }}

                            Employee<span v-if="data.prospect.number_of_employees > 1">s</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6 col-sm-12 u-mb-small" v-for="contact in data.prospect.contacts">
                <div class="c-card u-p-medium u-text-small u-mb-small">
                    <edit-contact :contact="contact" :prospect="data.prospect" @deleted="deleteContact"></edit-contact>

                    <h4 class="u-text-bold">
                        {{ contact.name }}
                    </h4>

                    <p class="u-text-small">
                        {{ contact.job_title }}
                    </p>

                    <dl class="u-flex u-pv-small u-border-bottom" v-if="contact.landline_phone_number">
                        <dt class="u-width-40">
                            <i class="fa fa-fw fa-phone u-mr-xsmall u-color-info"></i>

                            Land line
                        </dt>

                        <dd>{{ contact.landline_phone_number }}</dd>
                    </dl>

                    <dl class="u-flex u-pv-small u-border-bottom" v-if="contact.mobile_phone_number">
                        <dt class="u-width-40">
                            <i class="fa fa-fw fa-mobile u-mr-xsmall u-color-info"></i>

                            Mobile
                        </dt>

                        <dd>{{ contact.mobile_phone_number }}</dd>
                    </dl>

                    <dl class="u-flex u-pt-small" v-if="contact.email">
                        <dt class="u-width-40">
                            <i class="fa fa-fw fa-envelope u-mr-xsmall u-color-info"></i>

                            Email
                        </dt>

                        <dd>{{ contact.email }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        props: {
            prospect: {
                type: Object,
            },
        },
        data() {
            return {
                data: {
                    prospect: null,
                },
                utilities: {
                    errors: null,
                    saving: false,
                },
            }
        },
        methods: {
            deleteContact(contact) {
                let index = this.data.prospect.contacts.indexOf(contact)

                this.data.prospect.contacts.splice(index, 1)

                this.$emit('deleted', contact)
            },
        },
        mounted() {
            this.data.prospect = this.prospect
        },
    }
</script>
