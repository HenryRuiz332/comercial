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

                                             <v-stepper-content step="1">
                                                  
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
                                                          color="#9E7AF3"
                                                          @click="paso = 2">
                                                          Servicios Contratados
                                                        </v-btn>
                                             </v-stepper-content>

                                             <v-stepper-step
                                                  v-if="editMode == true"
                                                  :complete="paso > 2"
                                                  color="#9E7AF3"
                                                  step="2">
                                                  Servicios Contratados
                                             </v-stepper-step>


                                             <v-stepper-content step="2" >
                                                  <v-row style="height:100%">
                                                       <v-col cols="12" xs="12" sm="12" md="4" lg="4" xL="4" v-for="servicio,i in editarObj.cliente_servicio" :key="i">
                                                            <template>
                                                              <v-card
                                                                class="mx-auto"
                                                                max-width="344">
                                                                

                                                                <v-card-title>
                                                                  
                                                                </v-card-title>

                                                                <v-card-subtitle>
                                                                 <span>
                                                                      Servicio: {{servicio.servicio.nombre}}
                                                                 </span><br>

                                                                 <span>
                                                                      Producto : {{servicio.producto.nombre}}
                                                                 </span>
                                                                      <br>
                                                                
                                                                 <span>
                                                                      Colaborador: {{servicio.colaborador.nombre}}
                                                                 </span>
                                                                       <br>
                                                                </v-card-subtitle>

                                                                <v-card-actions>
                                                                  <v-btn
                                                                    color="orange lighten-2"
                                                                    text>
                                                                    Detalles
                                                                  </v-btn>

                                                                  <v-spacer></v-spacer>

                                                                  <v-btn
                                                                    icon
                                                                    @click="show = !show">
                                                                    <v-icon>{{ show ? 'mdi-chevron-up' : 'mdi-chevron-down' }}</v-icon>
                                                                  </v-btn>
                                                                </v-card-actions>

                                                                <v-expand-transition>
                                                                  <div v-show="show">
                                                                    <v-divider></v-divider>

                                                                    <v-card-text>
                                                                      
                                                                    </v-card-text>
                                                                  </div>
                                                                </v-expand-transition>
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
                                                                 @click="close">
                                                                      Cerrar
                                                            </v-btn>
                                                       </div>
                                                  </v-row>
                   
                                             </v-stepper-content>

                                        </v-stepper>
                                   
                              </v-dialog>

                              <v-dialog v-model="dialogDelete" max-width="500px">
                                   <v-card>
                                        <v-card-title class="headline">Se procederá a eliminar este elemento</v-card-title>
                                        <v-card-actions>
                                             <v-spacer></v-spacer>
                                             <v-btn color="#9E7AF3" text @click="closeDelete">Cancel</v-btn>
                                             <v-btn color="#9E7AF3" text @click="deleteItemConfirm">De Acuerdo</v-btn>
                                             <v-spacer></v-spacer>
                                        </v-card-actions>
                                   </v-card>
                              </v-dialog>

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
     import Info from "./Info.vue"
     export default {
          components:{
               'paginate' : Pagination,
               'form-crud' : FormCrud,
               'controls-crud' : Controls,
               'info-crud' : Info
          },
          data: () => ({
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
                    { text: 'Gasto', value: 'gasto' },
                    { text: 'Email', value: 'email' },
                    { text: 'Opciones', value: 'actions', sortable: false },
               ],
               users: [],
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
                    beneficio: ''
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
               closeSnackbar(){
                    this.snackbarInfoCrud = false
               },
               openDialog(){
                    this.editMode = false
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
                              this.pagination = response.data.users
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
                    this.editIndexObj = this.users.indexOf(item)
                    this.editarObj = Object.assign({}, item)
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
                    this.closeDialog()
                    this.$nextTick(() => {
                         this.editarObj = Object.assign({}, this.objDefault)
                         this.editIndexObj = -1
                    })
                    this.editMode = false
               },
               closeDelete () {
                    this.dialogDelete = false
                    this.$nextTick(() => {
                         this.editarObj = Object.assign({}, this.objDefault)
                         this.editIndexObj = -1
                    })
                     this.editMode = false
               },

              
          },
     };
</script>