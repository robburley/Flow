<style>
    .clickable {
        cursor: pointer;
    }
</style>

<template>
    <li class="c-sidebar__item">
        <a class="c-sidebar__link" @click="$modal.show('new-prospect-modal')">
            <i class="fa fa-fw fa-file-text-o u-mr-xsmall"></i>

            New Prospect
        </a>
    </li>
</template>

<script>
    export default {
        mounted() {
        },
    }
</script>
