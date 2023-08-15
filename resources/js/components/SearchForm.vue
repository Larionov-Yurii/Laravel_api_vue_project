<template>
    <div>
        <Form :loading="loading" v-on:form-submitted="handleFormSubmit" />
        <LoadingIndicator v-if="loading && !searchComplete" />
        <NoResultsMessage v-if="searchComplete && properties.length === 0" />
        <ResultsTable v-if="properties.length > 0" :properties="properties" />
    </div>
</template>

<script>
import { ref } from "vue";
import Form from "./Form.vue";
import LoadingIndicator from "./LoadingIndicator.vue";
import NoResultsMessage from "./NoResultsMessage.vue";
import ResultsTable from "./ResultsTable.vue";

export default {
    components: {
        Form,
        LoadingIndicator,
        NoResultsMessage,
        ResultsTable,
    },
    setup() {
        const loading = ref(false);
        const searchComplete = ref(false);
        const properties = ref([]);
        const searchQuery = ref({
            name: "",
            bedrooms: null,
            bathrooms: null,
            storeys: null,
            garages: null,
            min_price: null,
            max_price: null,
            attribute: "",
            value: "",
        });

        const handleFormSubmit = async (formData) => {
            loading.value = true;
            let response;
            try {
                const queryParams = new URLSearchParams();

                for (const [key, value] of Object.entries(formData)) {
                    if (value !== null && value !== "") {
                        queryParams.append(key, value);
                    }
                }

                let apiUrl = "/api/properties";

                if (formData.attribute && formData.value) {
                    apiUrl = `/api/properties/attribute?attribute=${formData.attribute}&value=${formData.value}`;
                }

                if (formData.min_price && formData.max_price) {
                    apiUrl = `/api/properties/price/${formData.min_price}-${formData.max_price}`;
                }

                const queryString = queryParams.toString();
                if (queryString !== "") {
                    apiUrl += `?${queryString}`;
                }

                response = await fetch(apiUrl, {
                    method: "GET",
                    headers: {
                        "Content-Type": "application/json",
                    },
                });

                const data = await response.json();

                await new Promise((resolve) => setTimeout(resolve, 1500));

                properties.value = data;
            } catch (error) {
                console.error("An error occurred:", error);
            } finally {
                loading.value = false;
                searchComplete.value = true;
            }
        };

        return {
            loading,
            searchComplete,
            properties,
            handleFormSubmit,
            searchQuery,
        };
    },
};
</script>
