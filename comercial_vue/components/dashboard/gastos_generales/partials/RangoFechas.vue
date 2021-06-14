<template>
    <v-row dense align="center">
        <v-col cols="12" md="2">
            <v-menu ref="desde" v-model="desde" :close-on-content-click="false" transition="scale-transition" offset-y min-width="290px">

                <template v-slot:activator="{ on, attrs }">
                    <v-text-field v-model="rango.desde" label="Desde" append-icon="mdi-calendar" readonly v-bind="attrs" v-on="on">
                    </v-text-field>
                </template>

                <v-date-picker v-model="rango.desde" no-title scrollable>
                    <v-spacer></v-spacer>

                    <v-btn text color="primary" @click="desde = false">
                        Cancel
                    </v-btn>

                    <v-btn text color="primary" @click="$refs.desde.save(rango.desde)">
                        OK
                    </v-btn>
                </v-date-picker>

            </v-menu>
        </v-col>

        <v-col cols="12" md="2">
            <v-menu ref="hasta" v-model="hasta" :close-on-content-click="false" transition="scale-transition" offset-y min-width="290px">

                <template v-slot:activator="{ on, attrs }">
                    <v-text-field v-model="rango.hasta" label="Hasta" append-icon="mdi-calendar" readonly v-bind="attrs" v-on="on">
                    </v-text-field>
                </template>

                <v-date-picker v-model="rango.hasta" no-title scrollable>
                    <v-spacer></v-spacer>

                    <v-btn text color="primary" @click="hasta = false">
                        Cancel
                    </v-btn>

                    <v-btn text color="primary" @click="$refs.hasta.save(rango.hasta)">
                        OK
                    </v-btn>
                </v-date-picker>

            </v-menu>
        </v-col>

        <v-col v-if="has_tipo == 'true'" cols="12" md="2">
            <v-select 
                :items="expensesTypes" 
                item-value="id" 
                item-text="nombre" 
                v-model="tipo" 
                label="Tipo de gasto">
                    <template v-slot:prepend-item>
                         <v-list-item @click="funcionArray">
                            <v-list-item-content>
                                <v-list-item-title>
                                  
                                </v-list-item-title>
                          </v-list-item-content>
                      </v-list-item>

                    </template>
                    
                </v-select>
        </v-col>

        <v-col cols="12" md="4">
            <v-btn @click="buscarRango" depressed rounded color="green" x-small class="white--text">Buscar</v-btn>
            
        </v-col>

    </v-row>
</template>

<script>
  

    export default {
        props: ['has_tipo', 'url', 'expensesTypes'],

        data() {
            return {
                desde: false,
                hasta: false,
                rango: {
                    desde: moment().startOf('month').format('Y-MM-DD'),
                    hasta: moment().add(1, 'days').format('Y-MM-DD'),
                },
                
                tipo: 'not',
            }
        },

        mounted() {
            this.$parent.$on('hacer_busqueda', this.buscarRango)


        },

        methods: {
            funcionArray(e){
               
                this.tipo = 'not'
            },
            buscarRango() {
                // if (this.rango.desde == null || this.rango.hasta == null) {
                //     alert("Formato fecha incorrecto")
                //     return null
                // }

                // let url = `${this.url}?desde=${this.rango.desde}&hasta=${this.rango.hasta}`

                // if (this.has_tipo == 'true') {
                //     url = `${url}&tipo=${this.tipo}`
                // }

                let newUrl = this.$apiUrl + `/gastos-filter-date`
                let fecha = {
                    'desde' : this.rango.desde,
                    'hasta' : this.rango.hasta,
                    'tipo' : this.tipo
                }

                axios.post(newUrl, fecha).then(res => {
                    console.log(res.data)

                    this.$emit('success_query', res.data.expenses.data)

                }, res => {
                    alert('Error obteniendo registros')
                })
            },

            defaultQuery() {
                this.$emit('default_query')
            }
        }

    }
</script>