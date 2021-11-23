<template>
    <div class="container">
        <div class="row">
        <div class="col-12">
            <p>{{ message }}</p>
            <PostCard v-for="post in posts" :key="post.id" :post="post" />
        </div>
        </div>
    </div>
</template>

<script>
import PostCard from "../components/PostCard.vue";
export default {
    name: "Posts",
    components: {
        PostCard,
    },
    data() {
        return {
        message: "Sezione dei posts",
        posts: [],
        api_token: "nwcgi9VyIALUlBiqcJc7kHW9KMl8gMZtjCSNRxOhHIkowq3EsupUrnwFQhZD875udhNvjUEYVnl3ZJkh",
        };
    },
    created() {
        this.getPosts();
    },
    methods: {
        getPosts() {
            const bodyParameter = {
                key: "value",
            };
            const config = {
                headers: { Authorization: `Bearer ${this.api_token}` },
            };
            axios.post("/api/posts", 
                        bodyParameter, 
                        config)
                .then((response) => {
                    this.posts = response.data.results;
                })
                .catch((err) => {
                    console.log(err);
                });
        },
    },
};
</script>

<style lang="scss" scoped>
</style>