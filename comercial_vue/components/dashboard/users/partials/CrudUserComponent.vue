<template>

     <div>
          <loader v-if="isloading" :infoLoader="infoLoader"></loader>
          <v-data-table
          :headers="objectsTabe"
          :items="users"
          :search="search"
          class="elevation-1"
          show-select
          v-model="crud">
                    
                    <template v-slot:top>
                         <v-toolbar
                              flat>
                              <v-toolbar-title>{{ titleCrud }}</v-toolbar-title>
                              
                              <v-divider
                                   class="mx-4"
                                   inset
                                   vertical>   
                              </v-divider>
                              <controls-crud 
                                   :openDialogControl="openDialog" 
                                   :getFuntion="getUsers"
                                   :nameComponent="nameComponent">
                                   
                              </controls-crud>
                              <v-spacer></v-spacer>

                              <v-dialog
                                   v-model="dialog"
                                  
                                   persistent
                                   fullscreen
                                   hide-overlay
                                   transition="dialog-bottom-transition">
                                        <template v-slot:activator="{ on, attrs }">
                                             
                                             <v-text-field
                                                  append-icon="mdi-magnify"
                                                  v-model="search"
                                                  label="Buscar"
                                                  class="mr-3 mt-3">
                                                       
                                             </v-text-field>
                                            
                                        </template>
                                        <v-stepper
                                             v-model="paso"
                                             vertical>
                                             <v-stepper-step
                                                  :complete="paso > 1"
                                                  color="#9E7AF3"
                                                  step="1">
                                                  <small>{{ formTitle }}</small>
                                             </v-stepper-step>

                                             <v-stepper-content  step="1">
                                                  
                                                  <form-crud 
                                                       :updateObjUser="updateObjUser"
                                                       :saveObjUser="saveObjUser"
                                                       :closeDialog="closeDialog"
                                                       :close="close"
                                                       :editarObj="editarObj"
                                                       :editIndexObj="editIndexObj"
                                                       :formTitle="formTitle"
                                                       :editMode="editMode"></form-crud>
                                                       
                                                       <v-btn
                                                          v-show="editMode == true"
                                                          color="#9E7AF3"
                                                          @click="paso = 2">
                                                          Servicios Contratados
                                                        </v-btn>
                                             </v-stepper-content>

                                             <v-stepper-step 
                                                  v-show="editMode == true"
                                                  :complete="paso > 2"
                                                  color="#9E7AF3"
                                                  step="2">
                                                  Servicios Contratados
                                             </v-stepper-step>


                                             <v-stepper-content  complete step="2" v-show="editMode == true" >
                                                  <v-row style="height:100%">
                                                       <v-col cols="12" xs="12" sm="12" md="4" lg="4" xL="4" v-for="servicio,i in editarObj.cliente_servicio" :key="i">
                                                            <template>
                                                              <v-card
                                                                class="mx-auto"
                                                                max-width="344">
                                                                
                                                                     <v-card-title>
                                                                       
                                                                     </v-card-title>

                                                                

                                                                 <v-card-text>
                                                                      <h5>
                                                                          <strong> Servicio Contratado</strong> {{servicio.servicio.nombre}}
                                                                      </h5></br></br>
                                                                     
                                                                      <v-row>
                                                                           <v-col cols="12" xs="12" sm="12" md="6" lg="6" xl="6" >
                                                                                <v-select  label="Producto" :items="products" item-text="nombre" item-value="id"  v-model="servicio.producto">
                                                                                     
                                                                                </v-select>
                                                                           </v-col>
                                                                           <v-col cols="12" xs="12" sm="12" md="6" lg="6" xl="6">
                                                                                <v-select label="Colaborador" :items="collaborators" item-text="nombre" item-value="id" v-model="servicio.colaborador">
                                                                                     
                                                                                </v-select>
                                                                           </v-col>
                                                                           <v-col cols="12" xs="12" sm="12" md="6" lg="6" xl="6" >
                                                                                <v-text-field @change="validar" label="Gasto" v-model="servicio.gasto" suffix="€">
                                                                                     
                                                                                </v-text-field>
                                                                           </v-col>
                                                                            <v-col cols="12" xs="12" sm="12" md="6" lg="6" xl="6" >
                                                                                <v-text-field @change="validar" label="Beneficio" v-model="servicio.beneficio" suffix="€">
                                                                                     
                                                                                </v-text-field>
                                                                           </v-col>
                                                                           <v-col cols="12" xs="12" sm="12" md="6" lg="6" xl="6">
                                                                                <v-text-field @change="validar" label="Comision"  v-model="servicio.comision" suffix="€">
                                                                                     
                                                                                </v-text-field>
                                                                                 
                                                                           </v-col>
                                                                          <!--  <v-col cols="12" xs="12" sm="12" md="6" lg="6" xl="6">
                                                                               
                                                                           <v-menu ref="menu" v-model="menu" :close-on-content-click="false" :return-value.sync="servicio.aviso_permanencia" transition="scale-transition" offset-y min-width="290px">

                                                                               <template v-slot:activator="{ on, attrs }">
                                                                                   <v-text-field filled  v-model="servicio.aviso_permanencia" label="Fecha" append-icon="mdi-calendar" readonly v-bind="attrs" v-on="on">
                                                                                   </v-text-field>
                                                                               </template>

                                                                               <v-date-picker v-model="servicio.aviso_permanencia" no-title scrollable>
                                                                                   <v-spacer></v-spacer>

                                                                                   <v-btn text color="primary" @click="menu = false">
                                                                                       Cancel
                                                                                   </v-btn>

                                                                                   <v-btn text color="primary" @click="$refs.menu.save(servicio.aviso_permanencia)">
                                                                                       OK
                                                                                   </v-btn>
                                                                               </v-date-picker>

                                                                           </v-menu>
                
                                                                           </v-col> -->

                                                                           <v-col cols="12" xs="12" sm="12" md="12" lg="12" xl="12">
                                                                                <v-textarea label="Nota de Gasto" v-model="servicio.nota_gasto">
                                                                                     
                                                                                </v-textarea>
                                                                           </v-col>
                                                                      </v-row>
                                                                       <v-chip @click="actualizarServicio(editarObj, servicio)">Actualizar servicio</v-chip>
                                                                </v-card-text>
                                                               
                                                              </v-card>
                                                            </template>

                                                           
                                                       </v-col>
                                                       
                                                  </v-row>
                                                  <v-row>
                                                        <div>
                                                            <v-btn
                                                                 x-smal
                                                                 color="#9E7AF3"
                                                                 text
                                                                 @click="paso=1">
                                                                      Editar Usuario
                                                            </v-btn>
                                                            <v-btn
                                                                 x-smal
                                                                 color="#9E7AF3"
                                                                 text
                                                                 @click="closeDialog()">
                                                                      Cerrar
                                                            </v-btn>
                                                       </div>
                                                  </v-row>
                   
                                             </v-stepper-content>

                                        </v-stepper>
                                   
                              </v-dialog>

                              <dialog-delete :dialogDelete="dialogDelete" 
                                             :closeDelete="closeDelete"
                                             :deleteItemConfirm="deleteItemConfirm"></dialog-delete>

                         </v-toolbar>
                   </template>
                   <template v-slot:item.actions="{ item }">
                         <v-btn @click="editObj(item)" color="success" x-small>
                              <i class="fa fa-pencil mr-2"></i>
                         </v-btn>
                         <v-btn @click="deleteObj(item)" color="error" x-small>
                              <i class="fa fa-trash mr-2"></i>
                         </v-btn>
                   </template>
                   <template v-slot:no-data>
                         <span>No hay datos disponibles</span>
                   </template>
                   <tfoot></tfoot>
          </v-data-table>
          
          <info-crud :snackbar="snackbarInfoCrud" :info="infoCrud" :closeSnackbar="closeSnackbar"></info-crud>
     </div>
</template>

<script type="text/javascript">
     import Pagination from "../../../../global_components/Pagination.vue"
     import FormCrud from "./Form.vue"
     import Controls from "../../crud/Controls.vue"
     import DialogDelete from "../../crud/DialogDelete.vue"
     import Info from "./Info.vue"
     export default {
          components:{
               'paginate' : Pagination,
               'form-crud' : FormCrud,
               'controls-crud' : Controls,
               'info-crud' : Info,
               'dialog-delete': DialogDelete
          },
          data: () => ({
               menu: false,
               show: false,
               nameComponent : 'Cliente',
               snackbarInfoCrud: false,
               infoCrud: '',
               crud: [],
               search: '',
               pagination: {
                    current_page:1,
               },
               paso: 1,
               infoLoader: 'Cargando Clientes',
               title : '',
               dialog: false, 
               dialogDelete: false,
               objectsTabe: [
      
                    { text: 'Nombre', value: 'nombre' },
                    { text: 'CIF', value: 'cif' },
                    { text: 'Teléfono', value: 'telefono' },
                    { text: 'Email', value: 'email' },
                    { text: 'Beneficio (€)', value: 'beneficio' },
                    { text: 'Opciones', value: 'actions', sortable: false },
               ],
               users: [],
               collaborators: [],
               products: [],
               editMode: false,
               editIndexObj: -1,
               editarObj: {
                    id: '',
                    nombre: '',
                    cif: '',
                    telefono: '',
                    email: '',
                    gasto: '',
                    nota_gasto : '',
                    beneficio: '',
                   
               },
               objDefault: {
                    id: '',
                    nombre: '',
                    cif: '',
                    telefono: '',
                    email: '',
                    gasto: '',
                    nota_gasto : '',
                    beneficio: '',
                   
               },
               errorDecimalGasto: '',
              errorDecimalComision:'',
              errorDecimalBeneficio:''
          }),

          computed: {
               formTitle () {
                    return this.editIndexObj === -1 ? 'Nuevo Cliente' : 'Editar Cliente'
               },
               titleCrud(){
                  this.title = 'Clientes'
                  return this.title
               },
               isloading: function() {
                    return this.$store.getters.getloading
               },
          },

          watch: {
               dialog (val) {
                    val || this.close()
               },
               dialogDelete (val) {
                    val || this.closeDelete()
               },
          },

          created () {
               this.ini()
          },

          methods: {
                validar(value){
                    this.$decimal(value)
                },
               actualizarServicio(user, servicio){
                    this.$Progress.start()
                    this.snackbarInfoCrud = false
                    this.infoCrud = ''
                    this.infoLoader = 'Actualizando...'

                    let updateService = {
                         'user' : user,
                         'service' : servicio

                    }

                    axios.put(this.$apiUrl + `/users-update-services/` + servicio.id, updateService).then(response => {
                         if (response.status == 200) {
                              this.infoCrud = 'Actualizado Exitosamente' 
                              this.snackbarInfoCrud = true
                              this.$Progress.finish()
                         }
                    }, err => {
                         this.infoCrud = 'Ocurrió un error al Actualizar los datos'
                         this.snackbarInfoCrud = true
                         this.$Progress.fail()
                    })
               },
              
               closeSnackbar(){
                    this.snackbarInfoCrud = false
               },
               openDialog(){
                    this.dialog =  true
               },
               closeDialog(){
                    this.dialog =  false
               },
               ini () {
                    this.getUsers()  
               },
               getUsers(){
                    this.snackbarInfoCrud = false
                    this.infoCrud = ''
                    this.$Progress.start()
                    axios.get(this.$apiUrl + `/users?page` + this.pagination.current_page).then(response => {
                         if (response.status == 200) {
                              this.users = response.data.users.data

                              this.collaborators = response.data.collaborators
                              this.products = response.data.products

                              this.pagination = response.data.users

                              // for (var i = 0; i < this.users.length; i++) {
                              //      for (var n = 0; n < this.users[i].cliente_servicio.length; i++) {
                              //            this.users[i].cliente_servicio[n]['detalles'] = false
                                         
                              //      }
                                 
                              // }
                              this.$Progress.finish()
                         }
                         
                  
                    }, err => {
                        this.$Progress.fail()
                    })
               },
               saveObjUser () {
                    this.$Progress.start()
                    this.snackbarInfoCrud = false
                    this.infoCrud = ''
                    this.infoLoader = 'Guardando...'
                    axios.post(this.$apiUrl + `/users`, this.editarObj).then(response => {
                         if (response.status == 200) {
                              this.infoCrud = 'Guardado Exitosamente'
                              this.snackbarInfoCrud = true
                              this.getUsers()
                              this.users.unshift(response.data.user)
                              

                              this.close()
                              this.$Progress.finish()
                         }
                    }, err => {
                         this.infoCrud = 'Ocurrió un error al guardar los datos'
                         this.snackbarInfoCrud = true
                         this.$Progress.fail()
                    })

                   
               },
               editObj (item) {
                   
                    this.editMode = true
                    // this.editIndexObj = this.users.indexOf(item)
                    // this.editarObj = Object.assign({}, item)
                    this.editarObj = item
                    this.dialog = true
               },
               updateObjUser () {
                    this.$Progress.start()
                    this.snackbarInfoCrud = false
                    this.infoCrud = ''
                    this.infoLoader = 'Actualizando...'
                    axios.put(this.$apiUrl + `/users/` + this.editarObj.id, this.editarObj).then(response => {
                         if (response.status == 200) {
                              this.infoCrud = 'Actualizado Exitosamente'
                              this.snackbarInfoCrud = true
                              this.getUsers()
                              this.close()
                              this.$Progress.finish()
                         }
                    }, err => {
                         this.infoCrud = 'Ocurrió un error al Actualizar los datos'
                         this.snackbarInfoCrud = true
                         this.$Progress.fail()
                    })

                   
               },

               deleteObj (item) {
                    this.editIndexObj = this.users.indexOf(item)
                    this.editarObj = Object.assign({}, item)
                    this.dialogDelete = true
                    
                   
               },

               deleteItemConfirm () {
                    this.$Progress.start()
                    this.infoLoader = 'Eliminando...'
                    let objDelete = this.editarObj
                    axios.post(this.$apiUrl + `/users-trash/` + this.editarObj.id).then(response => {
                         if (response.status == 200) {
                              this.getUsers()
                              this.$delete(this.users, objDelete)
                              this.closeDelete()
                              this.infoCrud = 'Elemento Eliminado'
                              this.snackbarInfoCrud = true
                              this.$Progress.finish()
                             
                         }
                    }, err => {
                         this.infoCrud = 'Ocurrió un Error Al Eliminar'
                         this.snackbarInfoCrud = true
                         this.$Progress.fail()
                    })
                     
               },

               close() {
                    this.paso = 1
                    this.closeDialog()
                    this.$nextTick(() => {
                         this.editarObj = Object.assign({}, this.objDefault)
                         this.editIndexObj = -1
                    })
                    this.editMode = false
               },
               closeDelete () {
                    this.paso = 1
                    this.dialogDelete = false
                    this.$nextTick(() => {
                         this.editarObj = Object.assign({}, this.objDefault)
                         this.editIndexObj = -1
                    })
                     this.editMode = false
               },



               validarGasto(value){
                    var RE = /^\d*\.?\d*$/;
                    if (RE.test(value)) {
                        this.errorDecimalGasto= ''
                    } else {
                               alert('Inserte un número entero o decimal')
                         this.errorDecimalGasto =  'Inserte un número entero o decimal. Decimal separado por punto.'
                         this.editarObj.gasto= []
                    }
                   

              },
              validarComision(value){
                    var RE = /^\d*\.?\d*$/;
                    if (RE.test(value)) {
                        this.errorDecimalComision= ''
                    } else {
                              // alert('Inserte un número entero o decimal')
                         this.errorDecimalComision =  'Inserte un número entero o decimal. Decimal separado por punto.'
                         this.editarObj.comision= []
                    }
                   

              },
              validarbeneficio(value){
                    var RE = /^\d*\.?\d*$/;
                    if (RE.test(value)) {
                        this.errorDecimalBeneficio= ''
                    } else {
                              // alert('Inserte un número entero o decimal')
                         this.errorDecimalBeneficio =  'Inserte un número entero o decimal. Decimal separado por punto.'
                         this.editarObj.beneficio= []
                    }
                   

              },

              
          },
     };
</script>