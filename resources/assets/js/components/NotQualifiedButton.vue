<style>
    .clickable {
        cursor: pointer;
    }
</style>

<template>


    <button class="c-btn c-btn--danger c-btn--fullwidth"
            @click="$modal.show('not-qualified-modal')"
    >
        Not Qualified
    </button>
</template>

<script>
    export default {
        mounted() {
        },
    }
</script>
