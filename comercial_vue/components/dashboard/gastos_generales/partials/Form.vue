<template>
     <div>
          <v-card>
               <v-toolbar
                    dark
                    color="#9E7AF3">
                    <v-btn
                         icon
                         dark
                         @click="closeDialog">
                         <i class="fa fa-close"></i>
                    </v-btn>
                    <v-toolbar-title>{{ formTitle }}</v-toolbar-title>
                    <v-spacer></v-spacer>
                    <v-toolbar-items>
                    <v-btn
                         v-if="editMode == false"
                         dark
                         text
                         @click="saveObject">
                              Guardar
                    </v-btn>
                    <v-btn
                         v-else
                         dark
                         text
                         @click="updateObject">
                              Actualizar
                    </v-btn>
                    </v-toolbar-items>
               </v-toolbar>

               <v-card-text>
                    <v-container>
                         <v-row>
                              <v-col
                                   cols="12"
                                   sm="12"
                                   md="4"
                                   lg="4"
                                   xl="4">
                                   <v-select 
                                        label="Tipos de Gastos" 
                                        v-model="editarObj.tipo_de_gasto_id"
                                        :items="expensesTypes" 
                                        item-value="id" 
                                        item-text="nombre"
                                        :error-messages="errors.errors.tipo_producto_id ? errors.errors.tipo_producto_id[0] : null">
                                        
                                   </v-select>
                                   <p>
                                        <v-btn x-small color="success" @click="NewExpenseTypeDialog">Nuevo Tipo de Gasto</v-btn>
                                   </p>
                              </v-col>
                              <v-col
                                   cols="12"
                                   sm="12"
                                   md="4"
                                   lg="4"
                                   xl="4">
                                        <v-text-field
                                             @change="validarImporte(editarObj.importe)"
                                             v-model="editarObj.importe"
                                             label="Importe"
                                             :error-messages="errors.errors.importe ? errors.errors.importe[0] : null"
                                             maxlength="10"
                                             :counter="10">
                                               
                                        </v-text-field>
                                         <small style="color:red" v-if="errorDecimalImporte != ''">{{errorDecimalImporte}}</small>
                              </v-col>

                              <v-col
                                   cols="12"
                                   sm="12"
                                   md="4"
                                   lg="4"
                                   xl="4">
                                        <v-menu ref="menu" v-model="menu" :close-on-content-click="false" :return-value.sync="editarObj.fecha" transition="scale-transition" offset-y min-width="290px">

                                       <template v-slot:activator="{ on, attrs }">
                                           <v-text-field filled :error-messages="errors.errors.fecha ? errors.errors.fecha[0] : null" v-model="editarObj.fecha" label="Fecha" append-icon="mdi-calendar" readonly v-bind="attrs" v-on="on">
                                           </v-text-field>
                                       </template>

                                       <v-date-picker v-model="editarObj.fecha" no-title scrollable>
                                           <v-spacer></v-spacer>

                                           <v-btn text color="primary" @click="menu = false">
                                               Cancel
                                           </v-btn>

                                           <v-btn text color="primary" @click="$refs.menu.save(editarObj.fecha)">
                                               OK
                                           </v-btn>
                                       </v-date-picker>

                                   </v-menu>
                              </v-col>

                              <v-col
                                   cols="12"
                                   sm="12"
                                   md="12"
                                   lg="12"
                                   xl="12">
                                        <v-text-field
                                             v-model="editarObj.descripcion"
                                             label="Nota o comentarios"
                                             :error-messages="errors.errors.descripcion ? errors.errors.descripcion[0] : null"
                                             
                                             >
                                               
                                        </v-text-field>
                              </v-col>
                         </v-row>
                    </v-container>
               </v-card-text>

               <v-card-actions>
                    <v-spacer></v-spacer>
                         <v-btn
                              x-smal
                              color="#9E7AF3"
                              text
                              @click="close">
                                   Cerrar
                         </v-btn>
                         <v-btn
                              v-if="editMode == false"
                              x-smal
                              color="#9E7AF3"
                              text
                              @click="saveObject">
                                   Guardar
                         </v-btn>
                         <v-btn
                              v-else
                              x-smal
                              color="#9E7AF3"
                              text
                              @click="updateObject">
                                   Actualizar
                         </v-btn>
               </v-card-actions>
          </v-card>

          <v-dialog
               v-model="dialogNewTypeExp"
               transition="dialog-bottom-transition"
               max-width="600">
             
               <template v-slot:default="dialog">
                    <v-card>
                         <v-toolbar
                              color="#9E7AF3"
                              dark>Nuevo Tipo de Gasto</v-toolbar>
                    <v-card-text>
                         <div class="text-h2 pa-12">
                              <v-text-field v-model="nombreTipoGasto" label="Tipo de Gasto"></v-text-field>
                         </div>
                    </v-card-text>
                    <v-card-actions class="justify-end">
                         <v-btn text @click="saveTG" >Guardar</v-btn>
                         <v-btn text @click="dialogNewTypeExp = false" >Cerrar</v-btn>
                    </v-card-actions>
               </v-card>
             </template>
           </v-dialog>
     </div>
     
</template>

<script type="text/javascript">
     export default {
          props: {
               updateObject : Function,
               saveObject : Function,
               close: Function,
               closeDialog: Function,
               editarObj: Object,
               editIndexObj: Number,
               formTitle: String,
               editMode : Boolean,
               expensesTypes: Array,
          },
          data: () => ({
               nameRules: [
                  v => !!v || 'El nombre es requerido',
                  v => (v && v.length >= 4) || 'Se requiere más de 3 caracteres',
               ],
               dialogNewTypeExp: false,
               nombreTipoGasto: '',
               menu: false,
               errorDecimalImporte: ''
          }),

          computed: {
               errors() {
                    return this.$store.getters.geterrors
               }
          },

          watch: {
             
          },

          created () {
              
          },

          methods: {
               validarImporte(value){

                    var RE = /^\d*\.?\d*$/;
                    if (RE.test(value)) {
                        this.errorDecimalImporte= ''
                    } else {
                              // alert('Inserte un número entero o decimal')
                         this.errorDecimalImporte =  'Inserte un número entero o decimal. Decimal separado por punto.'
                         this.editarObj.importe= ''
                    }
                   

              },

              NewExpenseTypeDialog(){
                    this.dialogNewTypeExp = true
              },
              saveTG(){

                    this.$Progress.start()

                    let editarObjAux = {
                         'nombre' : this.nombreTipoGasto
                    }

                    axios.post(this.$apiUrl + `/gTypes`, editarObjAux).then(response => {

                         if (response.status == 200) {
                              console.log(response.data)
                              this.editarObj.tipo_de_gasto_id = response.data.expenseType.id
                              this.expensesTypes.push(response.data.expenseType)
                              this.$Progress.finish()
                              this.dialogNewTypeExp = false
                              this.nombreTipoGasto = ''
                         }
                    }, err => {
                         
                         this.$Progress.fail()
                    })
              }
          },
     };
</script>