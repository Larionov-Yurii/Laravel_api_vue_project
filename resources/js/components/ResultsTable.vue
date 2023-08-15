<template>
    <table class="results">
        <thead>
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Bedrooms</th>
                <th>Bathrooms</th>
                <th>Storeys</th>
                <th>Garages</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="property in properties" :key="property.id">
                <td>{{ property.name }}</td>
                <td>{{ property.price }}</td>
                <td>{{ property.bedrooms }}</td>
                <td>{{ property.bathrooms }}</td>
                <td>{{ property.storeys }}</td>
                <td>{{ property.garages }}</td>
            </tr>
        </tbody>
    </table>
</template>

<script>
export default {
    props: ["properties"],
};
</script>
