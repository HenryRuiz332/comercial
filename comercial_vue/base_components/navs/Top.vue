<template>
    <div class="">
        <v-app-bar app flat class="nav-t">

            <v-toolbar-title class="text-uppercase grey--text text--darken-1">Panel de control</v-toolbar-title>

            <v-spacer></v-spacer>

            <!--<img class="d-none d-sm-flex" height="30px" :src="'logo.png'"></img>-->

            <v-app-bar-nav-icon @click.stop="toggleDrawer"></v-app-bar-nav-icon>

            <v-btn @click="doLogout" icon>
                <v-icon>mdi-login-variant</v-icon>
            </v-btn>

        </v-app-bar>
    </div>
</template>

<script>
    import auth from '../../auth/auth.js'
    export default {
        methods: {
            toggleDrawer() {
                this.$emit('toggleDrawer')
            },
            doLogout() {
                auth.logout()
            },
        }
    }
</script>