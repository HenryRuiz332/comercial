<template>
    <v-container>
        <loader v-if="isloading" :infoLoader="infoLoader"></loader>
        <div id="content-page" class="" v-if="$route.path !== '/login'">
            <div class="" >
               <div class="row" style="background:white">

                    <h5 class="container-fluid">Consultar Datos</h5>
                    <v-col cols="12" sm="12" md="12" lg="12" xl="12">
                    <filtro-fechas :url="url" 
                                   has_tipo="true" 
                                   v-on:success_query="setGastos"></filtro-fechas>
               </v-col>
                
               <v-col cols="12" sm="12" md="3" lg="3" xl="3" class="text-center"  >
                    <v-card
                      color="deep-purple lighten-2"
                      dark>
                      <v-card-title class="text-h6 text-center ml-5">
                        <small>Total Gastos</small>
                        
                      </v-card-title>

                      <v-card-subtitle > <h6 style="color:#fff!important">{{totals.gastos}}€</h6></v-card-subtitle>

                    
                    </v-card>
                  </v-col>


                   <v-col cols="12" sm="12" md="3" lg="3" xl="3" class="text-center"  >
                     <router-link to="/gastos-generales">
                       <v-card
                         color="red"
                         dark>
                         <v-card-title class="text-h6 text-center ml-5">
                           <small>Gastos generales</small>
                           
                         </v-card-title>

                         <v-card-subtitle > <h6 style="color:#fff!important">{{totals.expenses}}€</h6></v-card-subtitle>

                         <!-- <v-card-actions>
                           <v-btn text>
                             Listen Now
                           </v-btn>
                         </v-card-actions> -->
                       </v-card>
                     </router-link>
                  </v-col>

                   <v-col cols="12" sm="12" md="3" lg="3" xl="3" class="text-center" >
                    <v-card
                      color="blue lighten-2">
                      <v-card-title class="text-h6 text-center ml-5">
                        <small style="color:#fff!important">Total Comisiones</small>
                      </v-card-title>

                      <v-card-subtitle > <h6 style="color:#fff!important">{{totals.comisiones}}€</h6></v-card-subtitle>

                    </v-card>
                  </v-col>

                   <v-col cols="12" sm="12" md="3" lg="3" xl="3" class="text-center" >
                    <v-card
                      color="#385F73"
                      dark>
                      <v-card-title class="text-h6 text-center ml-5">
                          <small>Total Beneficios</small>
                        
                      </v-card-title>

                      <v-card-subtitle > <h6 style="color:#fff!important">{{totals.beneficios}}€</h6></v-card-subtitle>
 
                    </v-card>
                  </v-col>
               </div>
              
               <v-divider></v-divider>
             
            </div>
         </div>
    </v-container>
</template>

<script>
    import {
        menu_items_mixin
    } from '../../global_mixins/menu_items_mixin'


    import FiltroFechaComponent from "./../../components/dashboard/crud/FiltroFechaComponent"
    export default {
        components:{
             'filtro-fechas' : FiltroFechaComponent
        },

        mixins: [menu_items_mixin],
         data: () => ({
             totals : [],
             expensesTypes: [],
             infoLoader: 'Obteniendo Página Principal',
             url: '',
             totalExpnsesFilter: 0
         }),

         computed: {
               isloading: function() {
                    return this.$store.getters.getloading
               },
               
         },

         watch: {
             
         },

         created () {
                this.dashboard()
                this.url =  this.$apiUrl + `/dashboardfilter-quants`
         },

         methods: {
            totalCal(){
                this.total = 0

            },
            setGastos(data) {
                    
                    console.log(data)

                    this.totals.gastos=0
                    this.totals.beneficios=0
                    this.totals.comisiones=0
                    this.totals.expenses = 0
                    for (var i = 0; i < data.cantidades.length; i++) {

                        this.totals.gastos = 1*this.totals.gastos + 1*data.cantidades[i].gasto
                        this.totals.beneficios = 1*this.totals.gastos + 1*data.cantidades[i].beneficio
                        this.totals.comisiones = 1*this.totals.gastos + 1*data.cantidades[i].comision
                    }
                    for (var n = 0; n < data.expensesG.length; n++) {
                       this.totals.expenses = 1*this.totals.expenses + 1*data.expensesG[n].importe 
                    }

                   

                    // if (data.length > 0) {
                    //     let sum = []
                    //     let totalExpenseF = 0
                    //     for (var i = 0; i < data.length; i++) {
                    //        sum[sum.length] = data[i].importe
                    //     }
                        
                    //     for (var n = 0; n < sum.length; n++) {
                    //         totalExpenseF = 1*totalExpenseF + 1*sum[n]
                    //     }

                    //     this.totalExpnsesFilter = totalExpenseF
                    //     return
                    // }
                    this.totalExpnsesFilter = []
                    // console.log('No hay gastos disponibles')
            },

              dashboard(){
                    this.snackbarInfoCrud = false
                    this.infoCrud = ''
                    this.$Progress.start()
                    axios.get(this.$apiUrl + `/dashboard` ).then(response => {
                         if (response.status == 200) {
                              this.totals = response.data.totals
                              this.expensesTypes = response.data.expensesTypes
                              this.$Progress.finish()
                              this.totalExpnsesFilter = this.totals.expenses
                         }
                         
                    
                    }, err => {
                        this.$Progress.fail()
                    })

                    
              }

              
         },
    };
</script>

<style>
   @media (max-width: 450px) {
        .totalMovil {
            display: none!important;
        }    
   }
</style>