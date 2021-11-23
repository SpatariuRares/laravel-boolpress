<template>
    <header>
        <h1>Sono l'header</h1>
        <div id="main-menu">
            <div class="mt-5">
                <ul>
                <li
                    class="nav-item"
                    v-for="(menuItem, index) in menuItems"
                    :key="index"
                >
                    <router-link :to="{ name: menuItem.name }">{{
                    menuItem.label
                    }}</router-link>
                </li>
                </ul>
            </div>
        </div>
    </header>
</template>

<script>
    export default {
    name: "Header",
    data() {
        return {
            menuItems: [
                {
                    name: "home",
                    label: "Home",
                },
                {
                    name: "about-us",
                    label: "About-us",
                },
                {
                    name: "contacts",
                    label: "Contact Us",
                },
                {
                    name: "posts",
                    label: "Posts",
                },
            ],
        };
    },
    created() {},
    methods: {},
};
</script>