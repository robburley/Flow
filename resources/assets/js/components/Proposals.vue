<style scoped>
    .clickable {
        cursor: pointer;
    }
</style>

<template>
    <div>
        <div class="row u-mt-large u-pt-medium u-border-top">
            <div class="col-sm-12">
                <h3>
                    Proposals

                    <i class="fa fa-file pull-right clickable u-text-mute"
                       @click="newProposal"
                    ></i>
                </h3>
            </div>
        </div>

        <div class="row u-mt-small">
            <div class="col-12">
                <table class="c-table">
                    <thead class="c-table__head">
                        <tr class="c-table__row">
                            <th class="c-table__cell c-table__cell--head">Proposed For</th>
                            <th class="c-table__cell c-table__cell--head">Created At</th>
                            <th class="c-table__cell c-table__cell--head">Created By</th>
                            <th class="c-table__cell c-table__cell--head"></th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr class="c-table__row" v-for="proposal in data.proposals">

                            <td class="c-table__cell">
                                <span v-if="proposal.contact">
                                    {{ proposal.contact.name }}
                                </span>
                                <span class="u-text-small u-text-danger" v-if="proposal.sent_at">
                                    sent: {{ proposal.sent_at | moment('DD/MM/YYYY HH:mm')}}
                                </span>
                            </td>

                            <td class="c-table__cell">
                                {{ proposal.created_at | moment('DD/MM/YYYY') }}
                            </td>

                            <td class="c-table__cell">
                                <span v-if="proposal.user">
                                    {{ proposal.user.name }}
                                </span>
                            </td>

                            <td class="c-table__cell u-width-40">
                                <button class="c-btn c-btn--success pull-right u-ml-small"
                                        @click="select(proposal)"
                                        v-if="proposal.document"
                                >
                                    <i class="fa fa-fw fa-check" v-if="!utilities.selecting"></i>
                                    <i class="fa fa-fw fa-spinner fa-spin" v-else></i>

                                    <span v-if="utilities.selecting">Selecting</span>
                                    <span v-else>Select</span>

                                </button>

                                <button class="c-btn c-btn--warning pull-right u-ml-small"
                                        @click.prevent="send(proposal)"
                                        v-if="proposal.document && proposal.contact && proposal.contact.email"
                                        :disabled="utilities.sent"
                                >
                                    <i class="fa fa-fw fa-envelope" v-if="!utilities.sending && !utilities.sent"></i>
                                    <i class="fa fa-fw fa-spinner fa-spin" v-if="utilities.sending"></i>
                                    <i class="fa fa-fw fa-check" v-if="utilities.sent"></i>

                                    <span v-if="!utilities.sending && !utilities.sent">Send</span>
                                    <span v-if="utilities.sending">Sending</span>
                                    <span v-if="utilities.sent">Sent</span>
                                </button>

                                <button class="c-btn c-btn--info pull-right" @click="edit(proposal)">
                                    <i class="fa fa-fw fa-edit"></i>
                                    Edit
                                </button>
                            </td>
                        </tr>

                        <tr class="c-table__row" v-if="data.proposals.length === 0">
                            <td class="c-table__cell" colspan="4">
                                No Proposals Created
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <form class="row u-mt-medium u-pt-medium u-border-top" v-if="data.proposal" @submit.prevent="save">
            <div class="col-md-6">
                <h5>
                    Propose to
                </h5>
            </div>

            <div class="col-md-6">
                <v-select v-model="data.proposal.contact_id"
                          :options="contacts"
                ></v-select>
            </div>

            <div class="col-12">
                <h5>
                    Airtime
                </h5>

                <table class="c-table">
                    <thead class="c-table__head">
                        <tr class="c-table__row">
                            <th class="c-table__cell c-table__cell--head">Tariff</th>
                            <th class="c-table__cell c-table__cell--head">Minutes</th>
                            <th class="c-table__cell c-table__cell--head">Texts</th>
                            <th class="c-table__cell c-table__cell--head">Data</th>
                            <th class="c-table__cell c-table__cell--head">Term (months)</th>
                            <th class="c-table__cell c-table__cell--head">Quantity</th>
                            <th class="c-table__cell c-table__cell--head">Price</th>
                            <th class="c-table__cell c-table__cell--head"></th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr class="c-table__row" v-for="(airtime, index) in data.proposal.airtime">
                            <td class="c-table__cell">
                                <input :class="'c-input' + (utilities.errors && utilities.errors['airtime.' + index + '.tariff'] ? ' c-input--danger' : '')"
                                       v-model="airtime.tariff"
                                >
                            </td>

                            <td class="c-table__cell">
                                <input :class="'c-input' + (utilities.errors && utilities.errors['airtime.' + index + '.minutes'] ? ' c-input--danger' : '')"
                                       v-model="airtime.minutes">
                            </td>

                            <td class="c-table__cell">
                                <input :class="'c-input' + (utilities.errors && utilities.errors['airtime.' + index + '.texts'] ? ' c-input--danger' : '')"
                                       v-model="airtime.texts">
                            </td>

                            <td class="c-table__cell">
                                <input :class="'c-input' + (utilities.errors && utilities.errors['airtime.' + index + '.data'] ? ' c-input--danger' : '')"
                                       v-model="airtime.data">
                            </td>

                            <td class="c-table__cell">
                                <input :class="'c-input' + (utilities.errors && utilities.errors['airtime.' + index + '.term'] ? ' c-input--danger' : '')"
                                       type="number" step="0.01"
                                       v-model="airtime.term">
                            </td>

                            <td class="c-table__cell">
                                <input :class="'c-input' + (utilities.errors && utilities.errors['airtime.' + index + '.quantity'] ? ' c-input--danger' : '')"
                                       type="number" step="0.01"
                                       v-model="airtime.quantity">
                            </td>

                            <td class="c-table__cell">
                                <input :class="'c-input' + (utilities.errors && utilities.errors['airtime.' + index + '.price'] ? ' c-input--danger' : '')"
                                       type="number" step="0.01"
                                       v-model="airtime.price">
                            </td>

                            <td class="c-table__cell u-width-5">
                                <i class="fa fa-close u-color-danger clickable" @click="remove('airtime', index)"></i>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <i class="fa fa-plus-circle pull-right u-color-info u-mt-xsmall clickable" @click="add('airtime')"></i>

                <span v-if="utilities.errors && utilities.errors['airtime']" class="u-text-danger u-text-small">{{ utilities.errors['airtime'][0] }}</span>
            </div>

            <div class="col-12">
                <h5>
                    Credits
                </h5>

                <table class="c-table">
                    <thead class="c-table__head">
                        <tr class="c-table__row">
                            <th class="c-table__cell c-table__cell--head">Type</th>
                            <th class="c-table__cell c-table__cell--head">Description</th>
                            <th class="c-table__cell c-table__cell--head">Quantity</th>
                            <th class="c-table__cell c-table__cell--head">Amount</th>
                            <th class="c-table__cell c-table__cell--head"></th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr class="c-table__row" v-for="(credit, index) in data.proposal.credits">
                            <td class="c-table__cell">
                                <input :class="'c-input' + (utilities.errors && utilities.errors['credits.' + index + '.type'] ? ' c-input--danger' : '')"
                                       v-model="credit.type"
                                >
                            </td>

                            <td class="c-table__cell u-width-40">
                                <input :class="'c-input' + (utilities.errors && utilities.errors['credits.' + index + '.description'] ? ' c-input--danger' : '')"
                                       v-model="credit.description"
                                >
                            </td>

                            <td class="c-table__cell u-width-15">
                                <input :class="'c-input' + (utilities.errors && utilities.errors['credits.' + index + '.quantity'] ? ' c-input--danger' : '')"
                                       type="number" step="0.01"
                                       v-model="credit.quantity"
                                >
                            </td>

                            <td class="c-table__cell u-width-15">
                                <input :class="'c-input' + (utilities.errors && utilities.errors['credits.' + index + '.price'] ? ' c-input--danger' : '')"
                                       type="number" step="0.01"
                                       v-model="credit.price"
                                >
                            </td>

                            <td class="c-table__cell u-width-5">
                                <i class="fa fa-close u-color-danger clickable" @click="remove('credits', index)"></i>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <i class="fa fa-plus-circle pull-right u-color-info u-mt-xsmall clickable" @click="add('credits')"></i>
            </div>

            <div class="col-12">
                <h5>
                    Hardware
                </h5>

                <table class="c-table">
                    <thead class="c-table__head">
                        <tr class="c-table__row">
                            <th class="c-table__cell c-table__cell--head">Manufacturer</th>
                            <th class="c-table__cell c-table__cell--head">Model</th>
                            <th class="c-table__cell c-table__cell--head">Quantity</th>
                            <th class="c-table__cell c-table__cell--head">Upfront</th>
                            <th class="c-table__cell c-table__cell--head">Monthly</th>
                            <th class="c-table__cell c-table__cell--head"></th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr class="c-table__row" v-for="(hardware, index) in data.proposal.hardware">
                            <td class="c-table__cell">
                                <input :class="'c-input' + (utilities.errors && utilities.errors['hardware.' + index + '.manufacturer'] ? ' c-input--danger' : '')"
                                       v-model="hardware.manufacturer"
                                >
                            </td>

                            <td class="c-table__cell">
                                <input :class="'c-input' + (utilities.errors && utilities.errors['hardware.' + index + '.model'] ? ' c-input--danger' : '')"
                                       v-model="hardware.model"
                                >
                            </td>

                            <td class="c-table__cell u-width-15">
                                <input type="number" step="0.01" :class="'c-input' + (utilities.errors && utilities.errors['hardware.' + index + '.quantity'] ? ' c-input--danger' : '')"
                                       v-model="hardware.quantity"
                                >
                            </td>

                            <td class="c-table__cell u-width-15">
                                <input type="number" step="0.01" :class="'c-input' + (utilities.errors && utilities.errors['hardware.' + index + '.upfront'] ? ' c-input--danger' : '')"
                                       v-model="hardware.upfront"
                                >
                            </td>

                            <td class="c-table__cell u-width-15">
                                <input type="number" step="0.01" :class="'c-input' + (utilities.errors && utilities.errors['hardware.' + index + '.monthly'] ? ' c-input--danger' : '')"
                                       v-model="hardware.monthly"
                                >
                            </td>

                            <td class="c-table__cell u-width-5">
                                <i class="fa fa-close u-color-danger clickable" @click="remove('hardware', index)"></i>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <i class="fa fa-plus-circle pull-right u-color-info u-mt-xsmall clickable" @click="add('hardware')"></i>
            </div>

            <div class="col-12">
                <h5>
                    Total Cost
                </h5>

                <table class="c-table">
                    <thead class="c-table__head">
                        <tr class="c-table__row">
                            <th class="c-table__cell c-table__cell--head">Product</th>
                            <th class="c-table__cell c-table__cell--head">Term (months)</th>
                            <th class="c-table__cell c-table__cell--head">Upfront</th>
                            <th class="c-table__cell c-table__cell--head">Monthly</th>
                            <th class="c-table__cell c-table__cell--head"></th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr class="c-table__row" v-for="(total, index) in data.proposal.totals">
                            <td class="c-table__cell">
                                <input :class="'c-input' + (utilities.errors && utilities.errors['totals.' + index + '.monthly'] ? ' c-input--danger' : '')"
                                       v-model=" total.product"
                                >
                            </td>

                            <td class="c-table__cell u-width-15">
                                <input type="number" step="0.01" :class="'c-input' + (utilities.errors && utilities.errors['totals.' + index + '.monthly'] ? ' c-input--danger' : '')"
                                       v-model=" total.term"
                                >
                            </td>

                            <td class="c-table__cell u-width-15">
                                <input type="number" step="0.01" :class="'c-input' + (utilities.errors && utilities.errors['totals.' + index + '.monthly'] ? ' c-input--danger' : '')"
                                       v-model=" total.upfront"
                                >
                            </td>

                            <td class="c-table__cell u-width-15">
                                <input type="number" step="0.01" :class="'c-input' + (utilities.errors && utilities.errors['totals.' + index + '.monthly'] ? ' c-input--danger' : '')"
                                       v-model=" total.monthly"
                                >
                            </td>

                            <td class="c-table__cell u-width-5">
                                <i class="fa fa-close u-color-danger clickable" @click="remove('totals', index)"></i>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <i class="fa fa-plus-circle pull-right u-color-info u-mt-xsmall clickable" @click="add('totals')"></i>

                <span v-if="utilities.errors && utilities.errors['totals']" class="u-text-danger u-text-small">{{ utilities.errors['totals'][0] }}</span>
            </div>

            <div class="col-12 u-mt-small">
                <button class="c-btn c-btn--success pull-right" :disabled="utilities.saving">
                    <i class="fa fa-fw fa-save" v-if="!utilities.saving"></i>
                    <i class="fa fa-fw fa-spinner fa-spin" v-else></i>

                    <span v-if="!utilities.saving">Save Proposal</span>
                    <span v-else>Saving</span>
                </button>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        props: {
            opportunity: {
                required: true,
            },
            proposals: {
                required: false,
            },
        },
        methods: {
            send(proposal) {
                let self = this

                self.utilities.sending = true

                axios.post('/api/mobile/opportunities/' + self.opportunity.id + '/proposals/' + proposal.id + '/email', {})
                    .then(response => {
                        self.utilities.sending = false
                        self.utilities.sent = true
                    })
                    .catch(error => {
                        self.utilities.sending = false
                        self.utilities.sent = false
                    })
            },

            select(proposal) {
                let self = this

                self.utilities.selecting = true

                axios.post('/api/mobile/opportunities/' + self.opportunity.id + '/proposals/' + proposal.id + '/select', {})
                    .then(response => {
                        location.reload()
                    })
                    .catch(error => {
                        self.utilities.selecting = false
                    })
            },

            edit(proposal) {
                this.utilities.errors = null

                proposal.contact_id = proposal.contact_id
                    ? collect(this.contacts).firstWhere('value', proposal.contact_id)
                    : collect(this.contacts).first()

                this.data.proposal = proposal
            },

            remove(type, index) {
                this.utilities.errors = null

                this.data.proposal[type].splice(index, 1)
            },

            add(type) {
                this.utilities.errors = null

                this.data.proposal[type].push({})
            },

            newProposal() {
                this.data.proposal = {
                    contact_id: collect(this.contacts).first(),
                    airtime: [{}],
                    hardware: [],
                    credits: [],
                    totals: [{}],
                }
            },

            save() {
                let self = this

                self.utilities.saving = true
                self.utilities.errors = null

                let url = self.data.proposal.id > 0
                    ? '/api/mobile/opportunities/' + self.opportunity.id + '/proposals/' + self.data.proposal.id
                    : '/api/mobile/opportunities/' + self.opportunity.id + '/proposals/'

                axios.post(url, self.data.proposal)
                    .then(response => {
                        self.utilities.saving = false

                        self.data.proposal = null

                        let original = collect(self.data.proposals)
                            .firstWhere('id', response.data.id)

                        if (original && original.id) {
                            let index = self.data.proposals.indexOf(original)

                            return self.data.proposals[index] = response.data

                        }

                        return self.data.proposals.push(response.data)
                    })
                    .catch(error => {
                        self.utilities.saving = false

                        if (error.response && error.response.status === 422) {
                            self.utilities.errors = error.response.data.errors
                        }
                    })

            },
        },
        computed: {
            contacts() {
                return collect(this.opportunity.lead.review.prospect.contacts)
                    .map(contact => {
                        return {label: contact.name, value: contact.id}
                    })
                    .toArray()
            },
        },
        data() {
            return {
                data: {
                    proposals: [],
                    proposal: null,
                },
                utilities: {
                    errors: null,
                    saving: false,
                    sending: false,
                    sent: false,
                    selecting: false,
                },
            }
        },
        mounted() {
            this.data.proposals = this.proposals
        },
    }
</script>
