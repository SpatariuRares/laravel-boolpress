<template>
    <div class="container">
        <h1>Dettaglio del post</h1>
        {{post.title}}
    </div>
</template>

<script>
export default {
    data() {
        return {
        post: null,
        api_token: 'nwcgi9VyIALUlBiqcJc7kHW9KMl8gMZtjCSNRxOhHIkowq3EsupUrnwFQhZD875udhNvjUEYVnl3ZJkh'
        }
    },
    created() {
        this.getPostDetail();
    },
    methods: {
        getPostDetail() {
        const config = {
            headers: { Authorization: `Bearer ${this.api_token}` },
        };
        const bodyParameter = {
            key: "value",
        };
        axios
            .post("/api" + this.$route.path, bodyParameter, config)
            .then((response) => {
            this.post = response.data.results;
            console.log(response.data);
            })
            .catch((err) => {
            console.log(err);
            });
        },
    },
};
</script>