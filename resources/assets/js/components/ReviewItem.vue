<style>
    .clickable {
        cursor: pointer;
    }
</style>

<template>
    <tr class="c-table__row">
        <td class="c-table__cell">
            {{ review.user.name }}
        </td>

        <td class="c-table__cell">
            Mobile Review
        </td>

        <td class="c-table__cell">
            {{ review.created_at | moment('DD/MM/YYYY HH:mm') }}
        </td>

        <td class="c-table__cell">
            <span class="c-badge c-badge--warning" v-if="!review.completed_at">
                Partial
            </span>

            <span class="c-badge c-badge--success" v-else>
                Complete
            </span>
        </td>

        <td class="c-table__cell u-text-right">
            <i class="fa fa-fw fa-edit u-color-info clickable"
               v-if="!review.completed_at"
                @click="edit"
            ></i>

            <span class="c-badge c-badge--success" v-if="review.completed_at">
                {{ review.completed_at | moment('DD/MM/YYYY HH:mm') }}
            </span>
        </td>
    </tr>
</template>

<script>
    export default {
        props: {
            review: {
                type: Object,
                required: true,
            },
        },
        methods: {
            edit(){
                this.$emit('edit', this.review)
            }
        },
        data() {
            return {
                data: {},
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
