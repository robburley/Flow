<style>
    .clickable {
        cursor: pointer;
    }
</style>

<template>


    <button class="c-btn c-btn--warning c-btn--fullwidth"
            @click="$modal.show('lead-callback-modal')"
    >
        Callback Required
    </button>
</template>

<script>
    export default {
        mounted() {
        },
    }
</script>
