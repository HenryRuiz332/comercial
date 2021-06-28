<template>

     <div>
          <loader v-if="isloading" :infoLoader="infoLoader"></loader>
           <div style="background:white; z-index:1000">
               <v-row class="container">
                    <v-col cols="12" xs="12" sm="12" md="5" lg="5" xl="5">
                         <v-toolbar-title>{{ titleCrud }}</v-toolbar-title>     
                    </v-col>
                    <v-col cols="12" xs="12" sm="12" md="3" lg="3" xl="3">
                         <controls-crud 
                                   :openDialogControl="openDialog" 
                                   :getFuntion="getTypesProducts"
                                   :nameComponent="nameComponent">
                         </controls-crud>
                    </v-col> 
                    <v-col  cols="12" xs="12" sm="12" md="4" lg="4" xl="4">
                          <v-text-field

                                   append-icon="mdi-magnify"
                                   v-model="search"
                                   label="Buscar"
                                   class=""
                                   style="margin-top:-15px!important">
                                        
                              </v-text-field>
                             
                    </v-col>
               </v-row>

          </div>

          <v-data-table
           style="margin-top:-2.5vw"
          :headers="objectsTabe"
          :items="productsTypes"
          :search="search"
          class="elevation-1"
          show-select
          v-model="crud">
                     
                    <template v-slot:top>
                         <v-toolbar
                              flat>
                              
                              <v-dialog
                                   max-width="80%"
                                   v-model="dialog"
                                   persistent
                                   transition="dialog-bottom-transition">
                                         
                                             <form-crud 
                                                  :updateObject="updateObject"
                                                  :saveObject="saveObject"
                                                  :closeDialog="closeDialog"
                                                  :close="close"
                                                  :editarObj="editarObj"
                                                  :editIndexObj="editIndexObj"
                                                  :formTitle="formTitle"
                                                  :editMode="editMode"></form-crud>
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
     import FormTiposProductos from "./FormTiposProductos.vue"
     import Controls from "../../crud/Controls.vue"
     import Info from "./Info.vue"
     import DialogDelete from "../../crud/DialogDelete.vue"
     export default {
          components:{
               'paginate' : Pagination,
               'form-crud' : FormTiposProductos,
               'controls-crud' : Controls,
               'info-crud' : Info,
               'dialog-delete': DialogDelete
          },
          data: () => ({
               nameComponent : 'Tipo de Producto',
               snackbarInfoCrud: false,
               infoCrud: '',
               crud: [],
               search: '',
               pagination: {
                    current_page:1,
               },
               paso: 1,
               infoLoader: 'Cargando Tipos de Productos',
               title : '',
               dialog: false,
               dialogDelete: false,
               objectsTabe: [
      
                    { text: 'Nombre', value: 'nombre' },
                    { text: 'Opciones', value: 'actions', sortable: false },
               ],
               productsTypes: [],
               editMode: false,
               editIndexObj: -1,
               editarObj: {
                    id: '',
                    nombre: '',
                   
               },
               objDefault: {
                    id: '',
                    nombre: '',
                    
               },
          }),

          computed: {
               formTitle () {
                    return this.editIndexObj === -1 ? 'Nuevo Tipo de Producto' : 'Editar Tipo de Producto'
               },
               titleCrud(){
                  this.title = 'Tipos de Productos'
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
                    this.getTypesProducts()  
               },
               getTypesProducts(){
                    this.$Progress.start()
                    this.snackbarInfoCrud = false
                    this.infoCrud = ''
                    axios.get(this.$apiUrl + `/products-types?page` + this.pagination.current_page).then(response => {
                         if (response.status == 200) {
                              this.productsTypes = response.data.tiposProductos.data
                              this.pagination = response.data.tiposProductos
                              this.$Progress.finish()
                         }
                         
                  
                    }, err => {
                        this.$Progress.fail()
                    })
               },
               saveObject () {
                    this.$Progress.start()
                    this.snackbarInfoCrud = false
                    this.infoCrud = ''
                    this.infoLoader = 'Guardando...'
                    axios.post(this.$apiUrl + `/products-types`, this.editarObj).then(response => {
                         if (response.status == 200) {
                              this.infoCrud = 'Guardado Exitosamente'
                              this.snackbarInfoCrud = true
                              this.productsTypes.unshift(response.data.tipoProducto)
                              this.getTypesProducts()
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
                    this.editIndexObj = this.productsTypes.indexOf(item)
                    this.editarObj = Object.assign({}, item)
                    this.dialog = true
               },
               updateObject () {
                    this.$Progress.start()
                    this.snackbarInfoCrud = false
                    this.infoCrud = ''
                    this.infoLoader = 'Actualizando...'
                    axios.put(this.$apiUrl + `/products-types/` + this.editarObj.id, this.editarObj).then(response => {
                         if (response.status == 200) {
                              this.infoCrud = 'Actualizado Exitosamente'
                              this.snackbarInfoCrud = true
                              this.getTypesProducts()
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
                    this.editIndexObj = this.productsTypes.indexOf(item)
                    this.editarObj = Object.assign({}, item)
                    this.dialogDelete = true
                    
                   
               },

               deleteItemConfirm () {
                    this.$Progress.start()
                    this.infoLoader = 'Eliminando...'
                    let objDelete = this.editarObj
                    axios.post(this.$apiUrl + `/products-types-trash/` + this.editarObj.id).then(response => {
                         if (response.status == 200) {

                              this.getTypesProducts()
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