<template>

     <div>
          <loader v-if="isloading" :infoLoader="infoLoader"></loader>
          <v-data-table
          :headers="objectsTabe"
          :items="clientsServices"
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
                                   :getFuntion="getClientServices"
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
                                                       :editMode="editMode" 
                                                       :services="services"
													   :clients="clients"
													   :products="products"
													   :collaborators="collaborators"></form-crud>
                   
                                             </v-stepper-content>

                                             <!-- <v-stepper-step
                                                  v-if="editMode == true"
                                                  :complete="paso > 2"
                                                  step="2">
                                                  Servicios Contratados
                                             </v-stepper-step> -->
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
     import FormServiciosContratados from "./FormServiciosContratados.vue"
     import Controls from "../../crud/Controls.vue"
     import Info from "../../crud/Info.vue"
     export default {
          components:{
               'paginate' : Pagination,
               'form-crud' : FormServiciosContratados,
               'controls-crud' : Controls,
               'info-crud' : Info
          },
          data: () => ({
               nameComponent : 'Servico de Cliente',
               snackbarInfoCrud: false,
               infoCrud: '',
               crud: [],
               search: '',
               pagination: {
                    current_page:1,
               },
               paso: 1,
               infoLoader: 'Cargando Servicios de Clientes',
               title : '',
               dialog: false,
               dialogDelete: false,
               objectsTabe: [
      
                    { text: 'Cliente', value: 'cliente.nombre' },
                    { text: 'Servicio', value: 'servicio.nombre' },
                    { text: 'Producto', value: 'producto.nombre' },
                    { text: 'Colaborador', value: 'colaborador.nombre' },
                    { text: 'Gasto', value: 'gasto' },
                    { text: 'Comision', value: 'comision' },
                    { text: 'Opciones', value: 'actions', sortable: false },
               ],
               clientsServices: [],
               clients: [],
               services: [],
               products:[],
			collaborators:[],
               editMode: false,
               editIndexObj: -1,
               editarObj: {
                    id: '',
                    user_id: '',
                    servicio_id: '',
                    producto_id: '',
                    colaborador_id: '',
                    gasto: '',
                    comision : '',
                    beneficio: '',
                    aviso_permanencia : '',
                    nota_gasto: '',
                    notas: '',
               },
               objDefault: {
                   id: '',
                    user_id: '',
                    servicio_id: '',
                    producto_id: '',
                    colaborador_id: '',
                    gasto: '',
                    comision : '',
                    beneficio: '',
                    aviso_permanencia : '',
                    nota_gasto: '',
                    notas: '',
               },
          }),

          computed: {
               formTitle () {
                    return this.editIndexObj === -1 ? 'Nuevo Servicio de Cliente' : 'Editar Servicio de Cliente'
               },
               titleCrud(){
                  this.title = 'Servicios Contratados'
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
               auxAxios(){
                    this.$Progress.start()
                    axios.get(this.$apiUrl + `/clients-services-aux`).then(response => {
                         if (response.status == 200) {
                            this.products = response.data.products
                            this.collaborators =  response.data.collaborators
                          
                            this.$Progress.finish()
                         }
                         
                  
                    }, err => {
                        this.$Progress.fail()
                    })
               },
               closeSnackbar(){
                    this.snackbarInfoCrud = false
               },
               openDialog(){
                    this.editMode = false
                    this.dialog =  true
                    this.auxAxios()
                   
               },
               closeDialog(){
                    this.dialog =  false
               },
               ini () {
                    this.getClientServices()  
               },
               getClientServices(){
                    this.snackbarInfoCrud = false
                    this.infoCrud = ''
                    this.$Progress.start()
                    axios.get(this.$apiUrl + `/clients-services?page` + this.pagination.current_page).then(response => {
                         if (response.status == 200) {
                            this.clientsServices = response.data.clientsServices.data
                            this.clients =  response.data.clients
                            this.services =  response.data.services
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
                    axios.post(this.$apiUrl + `/clients-services`, this.editarObj).then(response => {
                         if (response.status == 200) {
                              this.infoCrud = 'Guardado Exitosamente'
                              this.snackbarInfoCrud = true
                              this.getClientServices()
                              this.clientsServices.unshift(response.data.user)
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
                    this.auxAxios()
                    this.editMode = true
                    this.editIndexObj = this.clientsServices.indexOf(item)
                    this.editarObj = Object.assign({}, item)
                    this.dialog = true
               },
               updateObjUser () {
                    this.$Progress.start()
                    this.snackbarInfoCrud = false
                    this.infoCrud = ''
                    this.infoLoader = 'Actualizando...'
                    axios.put(this.$apiUrl + `/clients-services/` + this.editarObj.id, this.editarObj).then(response => {
                         if (response.status == 200) {
                              this.infoCrud = 'Actualizado Exitosamente'
                              this.snackbarInfoCrud = true
                              this.getClientServices()
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
                    this.editIndexObj = this.clientsServices.indexOf(item)
                    this.editarObj = Object.assign({}, item)
                    this.dialogDelete = true
                    
                   
               },

               deleteItemConfirm () {
                    this.$Progress.start()
                    this.infoLoader = 'Eliminando...'
                    let objDelete = this.editarObj
                    axios.post(this.$apiUrl + `/clients-services-trash/` + this.editarObj.id).then(response => {
                         if (response.status == 200) {
                              this.getClientServices()
                              this.$delete(this.clientsServices, objDelete)
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