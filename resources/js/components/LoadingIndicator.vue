<template>
    <div v-if="loading" class="loading-icon">
        <i class="fas fa-spinner fa-spin"></i>
    </div>
</template>

<script>
export default {
    props: ["loading"],
};
</script>
