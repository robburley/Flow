<style scoped>
    .clickable {
        cursor: pointer;
    }

    .v-select .dropdown-toggle {
        border: 1px solid #dfe3e9 !important;
    }
</style>

<template>
    <modal name="review-modal"
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
                        Review
                    </h3>

                    <span class="c-modal__close" data-dismiss="modal" aria-label="Close">
                        <i class="fa fa-close u-text-danger clickable u-ml-auto" @click="hideModal"></i>
                    </span>
                </div>

                <div class="c-modal__body">
                    <form @submit.prevent="submitForm">
                        <div class="row">
                            <div class="col-12 col-md-8">
                                <div class="c-field">
                                    <label class="c-field__label">
                                        Who is your existing network provider?
                                    </label>

                                    <span v-if="utilities.errors && utilities.errors['existing_networks']" class="u-text-danger u-text-small">{{ utilities.errors['existing_networks'][0] }}</span> <br/>
                                </div>
                            </div>

                            <div class="col-12 col-md-4">
                                <div class="c-field">
                                    <input class="c-input" type="text" placeholder="" v-model="review.reviewable.existing_networks" autocomplete="nope">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-md-8">
                                <div class="c-field">
                                    <label class="c-field__label">
                                        How many handsets do you currently use?
                                    </label>

                                    <span v-if="utilities.errors && utilities.errors['number_of_handsets']" class="u-text-danger u-text-small">{{ utilities.errors['number_of_handsets'][0] }}</span> <br/>
                                </div>
                            </div>

                            <div class="col-12 col-md-4">
                                <div class="c-field">
                                    <input class="c-input" type="number" placeholder="" v-model="review.reviewable.number_of_handsets" autocomplete="nope">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-md-8">
                                <div class="c-field">
                                    <label class="c-field__label">
                                        Do you have any tablets or other devices that have SIM cards?
                                    </label>

                                    <span v-if="utilities.errors && utilities.errors['tablets_or_sim_devices']" class="u-text-danger u-text-small">{{ utilities.errors['tablets_or_sim_devices'][0] }}</span> <br/>
                                </div>
                            </div>

                            <div class="col-12 col-md-4">
                                <div class="c-field">
                                    <input class="c-input" type="text" placeholder="" v-model="review.reviewable.tablets_or_sim_devices" autocomplete="nope">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-md-8">
                                <div class="c-field">
                                    <label class="c-field__label">
                                        Are your handsets are all in good working order?
                                    </label>

                                    <span v-if="utilities.errors && utilities.errors['handsets_working']" class="u-text-danger u-text-small">{{ utilities.errors['handsets_working'][0] }}</span> <br/>
                                </div>
                            </div>

                            <div class="col-12 col-md-4">
                                <div class="c-field">
                                    <v-select :options="['Yes', 'No']" v-model="review.reviewable.handsets_working"></v-select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-md-8">
                                <div class="c-field">
                                    <label class="c-field__label">
                                        Is your account currently managed by the network or a third party?
                                    </label>

                                    <span v-if="utilities.errors && utilities.errors['network_or_third_party']" class="u-text-danger u-text-small">{{ utilities.errors['network_or_third_party'][0] }}</span> <br/>
                                </div>
                            </div>

                            <div class="col-12 col-md-4">
                                <div class="c-field">
                                    <v-select :options="['Network', 'Third Party']" v-model="review.reviewable.network_or_third_party"></v-select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-md-8">
                                <div class="c-field">
                                    <label class="c-field__label">
                                        Are you happy with the customer service you receive from your current provider?
                                    </label>

                                    <span v-if="utilities.errors && utilities.errors['customer_service_satisfaction']" class="u-text-danger u-text-small">{{ utilities.errors['customer_service_satisfaction'][0] }}</span> <br/>
                                </div>
                            </div>

                            <div class="col-12 col-md-4">
                                <div class="c-field">
                                    <v-select :options="['Yes', 'No']" v-model="review.reviewable.customer_service_satisfaction"></v-select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-md-8">
                                <div class="c-field">
                                    <label class="c-field__label">
                                        Do you feel there needs to be any changes or improvements in customer service?
                                    </label>

                                    <span v-if="utilities.errors && utilities.errors['customer_service_improvement']" class="u-text-danger u-text-small">{{ utilities.errors['customer_service_improvement'][0] }}</span> <br/>
                                </div>
                            </div>

                            <div class="col-12 col-md-4">
                                <div class="c-field">
                                    <v-select :options="['Yes', 'No']" v-model="review.reviewable.customer_service_improvement"></v-select>
                                </div>
                            </div>
                        </div>

                        <div class="row" v-if="review.reviewable.customer_service_improvement === 'Yes'">
                            <div class="col-12 col-md-12 u-mb-small">
                                <div class="c-field">
                                    <textarea class="c-input" v-model="review.reviewable.customer_service_improvement_detail"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-md-8">
                                <div class="c-field">
                                    <label class="c-field__label">
                                        How is the signal with (Network)? How is it at the office and at home?
                                    </label>

                                    <span v-if="utilities.errors && utilities.errors['signal_and_service']" class="u-text-danger u-text-small">{{ utilities.errors['signal_and_service'][0] }}</span> <br/>
                                </div>
                            </div>

                            <div class="col-12 col-md-4">
                                <div class="c-field">
                                    <v-select :options="['Weak', 'Signal Anywhere', 'It\'s alright']" v-model="review.reviewable.signal_and_service"></v-select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-md-8">
                                <div class="c-field">
                                    <label class="c-field__label">
                                        How much is your typical monthly bill?
                                    </label>

                                    <span v-if="utilities.errors && utilities.errors['monthly_bill']" class="u-text-danger u-text-small">{{ utilities.errors['monthly_bill'][0] }}</span> <br/>
                                </div>
                            </div>

                            <div class="col-12 col-md-4">
                                <div class="c-field">
                                    <input class="c-input" type="number" step="0.01" v-model="review.reviewable.monthly_bill" autocomplete="nope">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-md-8">
                                <div class="c-field">
                                    <label class="c-field__label">
                                        Do you find it’s different each month?
                                    </label>

                                    <span v-if="utilities.errors && utilities.errors['bill_fluctuation']" class="u-text-danger u-text-small">{{ utilities.errors['bill_fluctuation'][0] }}</span> <br/>
                                </div>
                            </div>

                            <div class="col-12 col-md-4">
                                <div class="c-field">
                                    <v-select :options="['Yes', 'Sometimes', 'I don\'t Know', 'No']" v-model="review.reviewable.bill_fluctuation"></v-select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-md-8">
                                <div class="c-field">
                                    <label class="c-field__label">
                                        How do you receive your bills?
                                    </label>

                                    <span v-if="utilities.errors && utilities.errors['bill_format']" class="u-text-danger u-text-small">{{ utilities.errors['bill_format'][0] }}</span> <br/>
                                </div>
                            </div>

                            <div class="col-12 col-md-4">
                                <div class="c-field">
                                    <v-select :options="['Post', 'Email', 'Online', 'I don’t get bills', 'I don\'t know']" v-model="review.reviewable.bill_format"></v-select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-md-8">
                                <div class="c-field">
                                    <label class="c-field__label">
                                        Are you provided with a bill analysis or usage report from your network?
                                    </label>

                                    <span v-if="utilities.errors && utilities.errors['receives_bill_analysis']" class="u-text-danger u-text-small">{{ utilities.errors['receives_bill_analysis'][0] }}</span> <br/>
                                </div>
                            </div>

                            <div class="col-12 col-md-4">
                                <div class="c-field">
                                    <v-select :options="['No', 'I don\'t know', 'Yes']" v-model="review.reviewable.receives_bill_analysis"></v-select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-md-8">
                                <div class="c-field">
                                    <label class="c-field__label">
                                        Do you use your phone overseas? Do you often make calls to other countries?
                                    </label>

                                    <span v-if="utilities.errors && utilities.errors['overseas_calls']" class="u-text-danger u-text-small">{{ utilities.errors['overseas_calls'][0] }}</span> <br/>
                                </div>
                            </div>

                            <div class="col-12 col-md-4">
                                <div class="c-field">
                                    <v-select :options="['Yes', 'No']" v-model="review.reviewable.overseas_calls"></v-select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="c-field">
                                    <label class="c-field__label">
                                        Do you know when your current contract ends?
                                    </label>

                                    <span v-if="utilities.errors && utilities.errors['contract_end_date']" class="u-text-danger u-text-small">{{ utilities.errors['contract_end_date'][0] }}</span> <br/>
                                </div>
                            </div>

                            <div class="col-12 col-md-6 u-flex u-justify-end u-mb-small">
                                <datepicker v-model="review.reviewable.contract_end_date"
                                            :format="customFormatter"
                                            inputClass="c-input"
                                            :inline="true"
                                ></datepicker>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-md-8">
                                <div class="c-field">
                                    <label class="c-field__label">
                                        Were any numbers added over time, after the contract started?
                                    </label>

                                    <span v-if="utilities.errors && utilities.errors['add_numbers_after_contact_start']" class="u-text-danger u-text-small">{{ utilities.errors['add_numbers_after_contact_start'][0] }}</span> <br/>
                                </div>
                            </div>

                            <div class="col-12 col-md-4">
                                <div class="c-field">
                                    <input class="c-input" type="text" placeholder="" v-model="review.reviewable.add_numbers_after_contact_start" autocomplete="nope">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-md-8">
                                <div class="c-field">
                                    <label class="c-field__label">
                                        Add a document
                                    </label>

                                    <span v-if="utilities.errors && utilities.errors['document']" class="u-text-danger u-text-small">{{ utilities.errors['document'][0] }}</span> <br/>
                                </div>
                            </div>

                            <div class="col-12 col-md-4">
                                <div class="c-field">
                                    <input class="c-input" type="file" @change="onFile($event)">
                                </div>

                                <div class="c-field u-mt-small" v-if="utilities.hasFile">
                                    <v-select :options="utilities.fileTypes" v-model="data.fileType"></v-select>
                                </div>
                            </div>
                        </div>

                        <hr class="u-mv-small u-mh-medium">

                        <div class="row">
                            <div class="col-12 col-md-8">
                                <div class="c-field">
                                    <label class="c-field__label">
                                        Hot Transfer
                                    </label>

                                    <span v-if="utilities.errors && utilities.errors['hot_transfer']" class="u-text-danger u-text-small">{{ utilities.errors['add_numbers_after_contact_start'][0] }}</span> <br/>
                                </div>
                            </div>

                            <div class="col-12 col-md-4">
                                <div class="c-field">
                                    <v-select :options="['Yes', 'No']" v-model="data.hot_transfer"></v-select>
                                </div>
                            </div>
                        </div>

                        <div class="row" v-if="data.hot_transfer === 'Yes'">
                            <div class="col-12 col-md-8">
                                <div class="c-field">
                                    <span v-if="utilities.errors && utilities.errors['hot_transfer_user_id']" class="u-text-danger u-text-small">{{ utilities.errors['hot_transfer_user_id'][0] }}</span> <br/>
                                </div>
                            </div>

                            <div class="col-12 col-md-4">
                                <div class="c-field">
                                    <v-select :options="utilities.closers" v-model="data.hot_transfer_user_id"></v-select>
                                </div>
                            </div>
                        </div>

                        <div class="row u-mt-small">
                            <div class="col-12">
                                <span v-if="utilities.errors && utilities.errors['prospect']" class="u-text-danger u-text-small">{{ utilities.errors['prospect'][0] }}</span> <br/>

                                <button class="c-btn c-btn--success pull-right" :disabled="utilities.saving">
                                    <i class="fa fa-fw fa-save" v-if="!utilities.saving"></i>
                                    <i class="fa fa-fw fa-spinner fa-spin" v-else></i>

                                    <span v-if="!utilities.saving">Save</span>
                                    <span v-else>Saving</span>
                                </button>
                            </div>
                        </div>
                    </form>


                    <div class="row u-mt-medium" v-if="review.reviewable.notes">
                        <div class="col-sm-12">
                            <div class="c-card u-p-medium">
                                <h4>
                                    Notes
                                </h4>
                            </div>

                            <form @submit.prevent="saveNote">
                                <div class="c-post">
                                    <textarea class="c-post__content" rows="3" v-model="note.body"></textarea>

                                    <div class="c-post__toolbar">

                                        <span v-if="utilities.errors && utilities.errors['body']"
                                              class="u-text-danger u-text-small">
                                            {{ utilities.errors['body'][0] }}
                                        </span>

                                        <button class="c-btn c-btn--success u-float-right">
                                            Post
                                        </button>
                                    </div>
                                </div>
                            </form>

                            <ol class="c-stream">
                                <li class="c-stream-item o-media" v-for="note in review.reviewable.notes">
                                    <div class="o-media__img u-mr-small">
                                        <div class="c-avatar c-avatar--medium">
                                            <img class="c-avatar__img" src="/img/avatar4-120.jpg" alt="Adam's face">
                                        </div>
                                    </div>

                                    <div class="c-stream-item__content o-media__body">
                                        <div class="c-stream-item__header">
                                            <a class="c-stream-item__name" href="#">
                                                {{ note.user.name }}
                                            </a>

                                            <span class="c-stream-item__time">
                                                            {{ note.created_at | moment('from', 'now') }}
                                                        </span>
                                        </div>

                                        <p class="u-mb-small">
                                            {{ note.body }}
                                        </p>
                                    </div>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </modal>
</template>

<script>
    export default {
        props: {
            review: {
                required: true,
            },
            prospect: {
                required: true,
            },
        },
        methods: {
            customFormatter(date) {
                return moment(date).format('DD/MM/YYYY')
            },
            onFile(e) {
                this.utilities.hasFile = false

                let file = e.target.files[0]

                if (file) {
                    this.utilities.hasFile = true

                    this.data.file = file
                }
            },
            hideModal() {
                this.$modal.hide('review-modal')
            },
            submitForm() {
                let self = this

                self.utilities.errors = null

                self.utilities.saving = true

                let url = self.review && self.review.id
                    ? '/api/prospects/' + self.prospect.id + '/reviews/' + self.review.id
                    : '/api/prospects/' + self.prospect.id + '/reviews'

                axios.post(url, self.formData)
                    .then(response => {
                        self.utilities.saving = false

                        self.$emit('upserted', response.data)
                    })
                    .catch(error => {
                        self.utilities.saving = false

                        if (error.response && error.response.status === 422) {
                            self.utilities.errors = error.response.data.errors
                        }
                    })
            },

            saveNote() {
                let self = this

                axios.post('/api/notes', this.note)
                    .then(response => {
                        self.review.reviewable.notes.push(response.data)
                    })
            },
        },
        computed: {
            note() {
                return {
                    body: this.data.note,
                    noteable_type: 'App\\Models\\Mobile\\MobileLead',
                    noteable_id: this.review && this.review.id ? this.review.reviewable.id : null,
                }
            },

            formData() {
                let formDataObject = new FormData()

                _.forEach(this.review.reviewable, function (value, key) {
                    if (value && value !== 'null') {
                        formDataObject.append(key, value)
                    }
                })

                if (this.data.file) {
                    formDataObject.append('document[type]', this.data.fileType.key)
                    formDataObject.append('document[file]', this.data.file)
                }

                formDataObject.append('prospect', this.prospect.id)
                formDataObject.append(
                    'hot_transfer',
                    this.data.hot_transfer === 'Yes'
                        ? '1' : '0',
                )

                formDataObject.append(
                    'hot_transfer_user_id',
                    this.data.hot_transfer_user_id && this.data.hot_transfer_user_id.key
                        ? this.data.hot_transfer_user_id.key
                        : '',
                )

                return formDataObject
            },
        },
        data() {
            return {
                data: {
                    fileType: null,
                    file: null,
                    note: '',
                    hot_transfer: 'No',
                    hot_transfer_user_id: null,
                },
                utilities: {
                    errors: null,
                    saving: false,
                    hasFile: false,
                    fileTypes: [],
                    closers: [],
                },
            }
        },
        mounted() {
            let self = this

            axios.get('/api/helpers/file-types')
                .then(response => {
                    self.utilities.fileTypes = response.data

                    self.data.fileType = self.utilities.fileTypes[0]
                })

            axios.get('/api/helpers/closers')
                .then(response => {
                    self.utilities.closers = response.data
                })
        },
    }
</script>
