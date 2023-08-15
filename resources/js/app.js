import "./bootstrap";
import "../css/app.css";
import { createApp } from "vue/dist/vue.esm-bundler";
import SearchForm from "./components/SearchForm.vue";

const app = createApp({
    components: {
        "search-form": SearchForm,
    },
});

app.mount("#app");
