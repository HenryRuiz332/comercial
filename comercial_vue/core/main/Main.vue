<template>
    <v-app>
         <vue-progress-bar></vue-progress-bar>
        <div>
         <!-- loader END -->
          <!-- Wrapper Start -->
          <div class="wrapper" >
                 <!-- Sidebar  -->
               <div class="iq-sidebar" v-if="$route.path !== '/login'">
                    <div class="iq-sidebar-logo d-flex justify-content-between">
                       <router-link to="/dashboard">
                       <img src="images/logo.gif" class="img-fluid" alt="">
                       <span>Comercial</span>
                       </router-link>
                       <div class="iq-menu-bt-sidebar">
                             <div class="iq-menu-bt align-self-center">
                                <div class="wrapper-menu">
                                   <div class="main-circle"><i class="ri-arrow-left-s-line"></i></div>
                                   <div class="hover-circle"><i class="ri-arrow-right-s-line"></i></div>
                                </div>
                             </div>
                          </div>
                    </div>
                   <sidebar-menu></sidebar-menu>
               </div>

                
               <navbar-top v-if="$route.path !== '/login'"></navbar-top>

                 <!-- Page Content  -->
               <div id="content-page" class="content-page">
                    <div class="container-fluid">
                         <v-main color="purple darken-3">
                              <v-container fluid grid-list-xs :class="{ 'pa-0' : $route.path == '/login' }">
                                   <router-view :key="$route.path"></router-view>
                              </v-container>
                         </v-main>
                    </div>
              </div>
              <!-- Wrapper END -->
              <!-- Footer -->
             <!--  <footer class="bg-white iq-footer">
                 <div class="container-fluid">
                    <div class="row">
                       <div class="col-lg-6">
                          <ul class="list-inline mb-0">
                             <li class="list-inline-item"><a href="privacy-policy.html">Privacy Policy</a></li>
                             <li class="list-inline-item"><a href="terms-of-service.html">Terms of Use</a></li>
                          </ul>
                       </div>
                       <div class="col-lg-6 text-right">
                          Copyright 2020 <a href="#">Vito</a> All Rights Reserved.
                       </div>
                    </div>
                 </div>
              </footer> -->

                   
               </div>
          </div>
    </v-app>
</template>

<script>
    import Top from '../navs/Top.vue'
    import Lateral from '../navs/Lateral.vue'
    export default {
        components: {
          'navbar-top' : Top,
          'sidebar-menu':  Lateral
        },
        watch: {
            drawer: {
                immediate: true,
                handler: function(n) {

                }
            },
        },
        data() {
            return {
                drawer: true
            }
        },
        methods: {
            // isActive() {
            //     return false //this.$route.path != '/login'
            // },
            // toggleDrawer() {
            //     this.drawer = !this.drawer
            // },
            // getInnputDrawer(e) {
            //     this.drawer = e
            // }
        },
    }
</script>

<style media="screen">
    .my-container {
        padding: 1rem;
        background-color: #ffffff;
        border-radius: 7px;
    }

    .v-content__wrap {
        background-color: #f3f6fd !important;
    }

    a {
        text-decoration: none;
    }


    .theme--light.v-application {
        background: #f3f6fd !important;
    }

    .theme--light.v-app-bar.v-toolbar.v-sheet {
        background-color: #f3f6fd !important;
    }

    .theme--light.v-data-table .v-data-table-header th.sortable .v-data-table-header__icon {
        display: none;
    }


    /*.v-toolbar__title {
        font-weight: 300;
        color: #555;
        font-size: 18px;
        margin-bottom: 6px;
    }*/
</style>