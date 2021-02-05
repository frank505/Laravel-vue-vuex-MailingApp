<template>
    <v-app>
        <v-app-bar class="custom-content">
            <v-app-bar-title><b>Welcome To MiniSend</b></v-app-bar-title>
        </v-app-bar>
        <Drawer></Drawer>

    </v-app>

</template>

<script>
    import Drawer from "../../../components/dashboard/Drawer";


    export default {
        name: "Dashboard",
        components:{
            Drawer
        }
    }
</script>

<style scoped>
.custom-content
{
background: white !important;
}
</style>