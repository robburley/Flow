<style scoped>
    .clickable {
        cursor: pointer;
    }
</style>

<template>
    <modal name="lead-callback-modal"
           :adaptive="true"
           height="auto"
           :pivotY="0.1"
           classes=""
           width="465"
           :scrollable="true"
    >
        <div class="u-m-small" role="document">
            <div class="c-modal__content">
                <div class="c-modal__header">
                    <h3 class="c-modal__title">
                        Callback
                    </h3>

                    <span class="c-modal__close" data-dismiss="modal" aria-label="Close">
                        <i class="fa fa-close u-text-danger clickable u-ml-auto" @click="hideModal"></i>
                    </span>
                </div>

                <div class="c-modal__body">
                    <form @submit.prevent="submitForm">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="c-field">
                                    <label class="c-field__label">
                                        Time
                                    </label>

                                    <vue-timepicker
                                            format="HH:mm"
                                            :minute-interval="15"
                                            hide-clear-button
                                            v-model="data.time"
                                    >
                                    </vue-timepicker>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="c-field">
                                    <label class="c-field__label">
                                        Date
                                    </label>

                                    <datepicker v-model="data.date"
                                                inputClass="c-input"
                                                :inline="true"
                                    ></datepicker>

                                </div>
                            </div>
                        </div>

                        <div class="row u-mt-small" v-if="dateTime">
                            <div class="col-sm-12">
                                Set a callback for {{ dateTime }}
                            </div>
                        </div>

                        <div class="row" v-if="dateTime">
                            <div class="col-12">
                                <span v-if="utilities.errors && utilities.errors['date_time']" class="u-text-danger u-text-small">{{ utilities.errors['date_time'][0] }}</span> <br/>

                                <button class="c-btn c-btn--warning pull-right" :disabled="utilities.saving">
                                    <i class="fa fa-fw fa-save" v-if="!utilities.saving"></i>
                                    <i class="fa fa-fw fa-spinner fa-spin" v-else></i>

                                    <span v-if="!utilities.saving">Callback Required</span>
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
            lead: {
                required: true,
            },
        },
        methods: {
            hideModal() {
                this.$modal.hide('not-qualified-modal')
            },
            submitForm() {
                let self = this

                let requests = []

                self.utilities.errors = null

                self.utilities.saving = true

                requests.push(axios.post('/api/callbacks', {
                    date_time: this.dateTime,
                    callbackable_type: 'App\\Models\\Prospect\\Prospect',
                    callbackable_id: this.prospect.id,
                }))

                requests.push(axios.post('/mobile/leads/' + this.lead.id, {
                    status: 3,
                }))


                axios.all(requests)
                    .then(results => {
                        self.utilities.saving = false

                        location.replace('/mobile/leads/pipeline/fresh')
                    })
                    .catch(errors => {
                        errors.forEach(function (error) {
                            self.utilities.saving = false

                            if (error.response && error.response.status === 422) {
                                self.utilities.errors = error.response.data.errors
                            }
                        })
                    })
            },
        },
        computed: {
            dateTime() {
                if (this.data.date) {
                    return window.moment(this.data.date).format('DD/MM/YYYY') + ' ' + this.data.time.HH + ':' + this.data.time.mm
                }

                return false
            },
        },
        data() {
            return {
                data: {
                    date: '',
                    time: {
                        HH: '09',
                        mm: '00',
                    },
                },
                utilities: {
                    errors: null,
                    saving: false,
                },
            }
        },
        mounted() {
            let self = this
        },
    }
</script>
