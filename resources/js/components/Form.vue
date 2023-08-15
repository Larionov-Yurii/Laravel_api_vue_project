<template>
    <form @submit.prevent="submitForm">
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" v-model="formData.name" />
        </div>
        <div>
            <label for="bedrooms">Bedrooms:</label>
            <input
                type="number"
                id="bedrooms"
                v-model.number="formData.bedrooms"
            />
        </div>
        <div>
            <label for="bathrooms">Bathrooms:</label>
            <input
                type="number"
                id="bathrooms"
                v-model.number="formData.bathrooms"
            />
        </div>
        <div>
            <label for="storeys">Storeys:</label>
            <input
                type="number"
                id="storeys"
                v-model.number="formData.storeys"
            />
        </div>
        <div>
            <label for="garages">Garages:</label>
            <input
                type="number"
                id="garages"
                v-model.number="formData.garages"
            />
        </div>
        <div>
            <label for="min_price">Min Price:</label>
            <input
                type="number"
                id="min_price"
                v-model.number="formData.min_price"
            />
        </div>
        <div>
            <label for="max_price">Max Price:</label>
            <input
                type="number"
                id="max_price"
                v-model.number="formData.max_price"
            />
        </div>

        <button type="submit" :disabled="loading">
            <span v-if="loading" class="loading-icon">
                <i class="fas fa-spinner fa-spin"></i>
            </span>
            Search
        </button>
    </form>
</template>

<script>
export default {
    props: ["loading"],
    data() {
        return {
            formData: {
                name: "",
                bedrooms: null,
                bathrooms: null,
                storeys: null,
                garages: null,
                min_price: null,
                max_price: null,
            },
        };
    },
    methods: {
        submitForm() {
            this.$emit("form-submitted", this.formData);
        },
    },
};
</script>
