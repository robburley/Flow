require('./bootstrap')

import Vue2Filters from 'vue2-filters'
import VModal from 'vue-js-modal'

Vue.use(Vue2Filters)
Vue.use(VModal)
Vue.use(require('vue-moment'))

Vue.component('new-prospect-icon', require('./components/NewProspectIcon.vue'))
Vue.component('new-prospect', require('./components/NewProspect.vue'))
Vue.component('show-prospect', require('./components/ShowProspect.vue'))
Vue.component('prospect', require('./components/Prospect.vue'))
Vue.component('edit-prospect', require('./components/EditProspect.vue'))
Vue.component('edit-contact', require('./components/EditContact.vue'))
Vue.component('new-contact', require('./components/NewContact.vue'))
Vue.component('review-item', require('./components/ReviewItem.vue'))
Vue.component('review', require('./components/Review.vue'))
Vue.component('v-select', require('./components/select/components/Select.vue'))
Vue.component('date-input', require('./components/date-picker/components/DateInput.vue'))
Vue.component('datepicker', require('./components/date-picker/components/Datepicker.vue'))
Vue.component('picker-day', require('./components/date-picker/components/PickerDay.vue'))
Vue.component('picker-month', require('./components/date-picker/components/PickerMonth.vue'))
Vue.component('picker-year', require('./components/date-picker/components/PickerYear.vue'))
Vue.component('callback', require('./components/Callback.vue'))
Vue.component('callback-icon', require('./components/CallbackIcon.vue'))
Vue.component('edit-prospect-icon', require('./components/EditProspectIcon.vue'))
Vue.component('new-contact-icon', require('./components/NewContactIcon.vue'))
Vue.component('not-qualified-button', require('./components/NotQualifiedButton.vue'))
Vue.component('not-qualified-modal', require('./components/NotQualifiedModal.vue'))
Vue.component('lead-callback-button', require('./components/LeadCallbackButton.vue'))
Vue.component('lead-callback-modal', require('./components/LeadCallbackModal.vue'))
Vue.component('vue-timepicker', require('./components/VueTimepicker.vue'))
Vue.component('proposals', require('./components/Proposals.vue'))

const app = new Vue({
    el: '#app',
})
