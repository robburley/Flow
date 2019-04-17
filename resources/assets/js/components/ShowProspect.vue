<style>
    .clickable {
        cursor: pointer;
    }
</style>

<template>
    <div v-if="data.prospect">
        <div class="c-toolbar u-mb-medium">
            <button class="c-sidebar-toggle u-mr-small">
                <span class="c-sidebar-toggle__bar"></span>
                <span class="c-sidebar-toggle__bar"></span>
                <span class="c-sidebar-toggle__bar"></span>
            </button>

            <i class="fa fa-phone fa-2x clickable u-color-info u-ml-auto" @click.prevent="showModal('callback-modal')"></i>

            <i class="fa fa-user-plus fa-2x clickable u-ml-small u-color-info" @click="showModal('new-contact-modal')"></i>

            <i class="fa fa-edit fa-2x u-ml-small clickable u-color-info" @click.prevent="showModal('edit-prospect-modal')"></i>
        </div>

        <div class="container">
            <prospect :prospect="data.prospect"
                      @deleted="deleteContact"
            ></prospect>

            <div class="row u-mb-medium">
                <div class="col-12">
                    <div class="c-table-responsive@tablet">
                        <table class="c-table">
                            <caption class="c-table__title">
                                Reviews

                                <a class="c-table__title-action u-color-facebook"
                                   @click.prevent="newReview()"
                                >
                                    <i class="fa fa-file-text-o"></i>
                                </a>
                            </caption>

                            <thead class="c-table__head">
                                <tr class="c-table__row">
                                    <th class="c-table__cell c-table__cell--head">Reviewer</th>
                                    <th class="c-table__cell c-table__cell--head">Type</th>
                                    <th class="c-table__cell c-table__cell--head">Date Started</th>
                                    <th class="c-table__cell c-table__cell--head">Status</th>
                                    <th class="c-table__cell c-table__cell--head u-width-10"></th>
                                </tr>
                            </thead>

                            <tbody>
                                <review-item v-for="review in data.prospect.reviews"
                                             :key="review.id"
                                             :review="review"
                                             @edit="editReview"
                                ></review-item>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="row u-mb-medium" v-if="hasRole(['Admin', 'Supervisor', 'Closer'])">
                <div class="col-12">
                    <div class="c-table-responsive@tablet">
                        <table class="c-table">
                            <caption class="c-table__title">
                                Leads
                            </caption>

                            <thead class="c-table__head">
                                <tr class="c-table__row">
                                    <th class="c-table__cell c-table__cell--head">Status</th>
                                    <th class="c-table__cell c-table__cell--head">Assigned To</th>
                                    <th class="c-table__cell c-table__cell--head u-width-10"></th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr v-for="lead in leads">
                                    <th class="c-table__cell">{{ getLeadStatus(lead.status) }}</th>
                                    <th class="c-table__cell">
                                        {{ lead.user.name }}
                                    </th>
                                    <th class="c-table__cell">
                                        <a class="c-btn c-btn-info"
                                           :href="'/mobile/leads/' + lead.id"
                                        >
                                            View
                                        </a>
                                    </th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="row u-mb-medium" v-if="hasRole(['Admin', 'Supervisor', 'Closer'])">
                <div class="col-12">
                    <div class="c-table-responsive@tablet">
                        <table class="c-table">
                            <caption class="c-table__title">
                                Opportunities

                            </caption>

                            <thead class="c-table__head">
                                <tr class="c-table__row">
                                    <th class="c-table__cell c-table__cell--head">Status</th>
                                    <th class="c-table__cell c-table__cell--head">Assigned To</th>
                                    <th class="c-table__cell c-table__cell--head u-width-10"></th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr v-for="opportunity in opportunities">
                                    <th class="c-table__cell">{{ getOpportunityStatus(opportunity.status) }}</th>
                                    <th class="c-table__cell">
                                        {{ opportunity.user.name }}
                                    </th>
                                    <th class="c-table__cell">
                                        <a class="c-btn c-btn-info"
                                           :href="'/mobile/opportunities/' + opportunity.id"
                                        >
                                            View
                                        </a>
                                    </th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-6">
                    <div class="c-table-responsive@tablet">
                        <table class="c-table">
                            <caption class="c-table__title">
                                Callbacks
                            </caption>

                            <thead class="c-table__head">
                                <tr class="c-table__row">
                                    <th class="c-table__cell c-table__cell--head">Date Time</th>
                                    <th class="c-table__cell c-table__cell--head">User</th>
                                    <th class="c-table__cell c-table__cell--head u-width-10"></th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr v-for="callback in  orderBy(data.prospect.callbacks, 'date_time', -1)"
                                    :key="callback.id"
                                    class="c-table__row"
                                >
                                    <td class="c-table__cell">{{ callback.date_time | moment('DD/MM/YYYY HH:mm') }}</td>
                                    <td class="c-table__cell">{{ callback.user.name }}</td>
                                    <td class="c-table__cell">
                                        <span class="c-badge c-badge--success" v-if="callback.completed_at">
                                            {{ callback.completed_at | moment('DD/MM/YYYY HH:mm') }}
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <new-contact :prospect="data.prospect"
                     @added="addContact"
        ></new-contact>

        <edit-prospect :prospect="data.prospect"
        ></edit-prospect>

        <callback :prospect="data.prospect"
                  :callback="data.callback"
                  @created="addCallback"
        ></callback>

        <review :review="data.review"
                :prospect="data.prospect"
                @upserted="upsertReview"
        ></review>
    </div>
</template>

<script>

    export default {
        props: {
            prospect: {
                type: Object,
            },
            user: {
                type: Object,
            },
        },
        computed: {
            roles() {
                return collect(this.user.roles)
                    .pluck('name')
            },
            leads() {
                return collect(this.data.prospect.reviews)
                    .pluck('reviewable')
                    .filter(item => {
                        return collect([2, 3, 5]).contains(item.status) && item.user_id
                    })
                    .toArray()
            },
            opportunities() {
                return collect(this.data.prospect.reviews)
                    .pluck('reviewable')
                    .filter(item => {
                        return collect([4]).contains(item.status)
                    })
                    .pluck('opportunity')
                    .toArray()
            },
        },
        data() {
            return {
                data: {
                    prospect: null,
                    review: {
                        reviewable: {
                            document: {},
                        },
                    },
                    callback: null,
                },
                utilities: {
                    errors: null,
                    saving: false,
                },
            }
        },
        methods: {
            hasRole(roles) {
                return this.roles
                    .filter(role => {
                        return collect(roles).contains(role)
                    }).count() > 0
            },
            getLeadStatus(status) {
                let statuses = [
                    'Incomplete',
                    'Awaiting Validation',
                    'Fresh',
                    'Callback',
                    'Qualified',
                    'Not Qualified',
                ]

                return statuses[status]
            },

            getOpportunityStatus(status) {
                let statuses = [
                    'Negotiation',
                    'Proposed',
                    'Underwriting',
                    'Pending',
                    'Signed',
                    'Lost',
                ]

                return statuses[status]
            },

            showModal(name) {
                this.$modal.show(name)
            },

            hideModal(name) {
                this.$modal.hide(name)
            },

            addContact(contact) {
                this.data.prospect.contacts.push(contact)
            },

            deleteContact(contact) {
                console.log('2')
                console.log(contact)

                let index = this.data.prospect.contacts.indexOf(contact)

                this.data.prospect.contacts.splice(index, 1)
            },

            editReview(review) {
                this.data.review = review

                this.showModal('review-modal')
            },

            newReview() {
                this.data.review = {
                    reviewable: {},
                }

                this.showModal('review-modal')
            },

            upsertReview(review) {
                let self = this

                axios.get('/api/callbacks/', {
                    params: {
                        callbackable_type: 'App\\Models\\Prospect\\Prospect',
                        callbackable_id: self.data.prospect.id,
                    },
                })
                    .then(response => {
                        self.data.prospect.callbacks = response.data
                    })
                    .catch(error => {
                    })

                let index = _.findIndex(this.data.prospect.reviews, function (item) {
                    return item.id === review.id
                })

                this.hideModal('review-modal')

                if (!review.completed_at) {
                    this.showModal('callback-modal')
                }

                if (index >= 0) {
                    return this.data.prospect.reviews.splice(index, 1, review)
                }

                this.data.prospect.reviews.push(review)
            },

            addCallback(callbacks) {
                this.data.prospect.callbacks = callbacks

                this.hideModal('callback-modal')
            },
        },
        mounted() {
            this.data.prospect = this.prospect
        },
    }
</script>
