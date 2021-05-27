<template>

     <div>
          <loader v-if="isloading" :infoLoader="infoLoader"></loader>
          <v-data-table
          :headers="objectsTabe"
          :items="collaborators"
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
                                   :getFuntion="getCollaborators"
                                   :nameComponent="nameComponent">
                                   
                              </controls-crud>
                              <v-spacer></v-spacer>

                              <v-dialog
                                   max-width="50%"
                                   v-model="dialog"
                                   persistent
                                   transition="dialog-bottom-transition">
                                        <template v-slot:activator="{ on, attrs }">
                                             
                                             <v-text-field
                                                  append-icon="mdi-magnify"
                                                  v-model="search"
                                                  label="Buscar"
                                                  class="mr-3 mt-3">
                                                       
                                             </v-text-field>
                                            
                                        </template>   
                                             <form-crud 
                                                  :updateObjCollaborator="updateObjCollaborator"
                                                  :saveObjCollaborator="saveObjCollaborator"
                                                  :closeDialog="closeDialog"
                                                  :close="close"
                                                  :editarObj="editarObj"
                                                  :editIndexObj="editIndexObj"
                                                  :formTitle="formTitle"
                                                  :editMode="editMode"></form-crud>
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
     import Form from "./Form.vue"
     import Controls from "../../crud/Controls.vue"
     import Info from "./Info.vue"
     export default {
          components:{
               'paginate' : Pagination,
               'form-crud' : Form,
               'controls-crud' : Controls,
               'info-crud' : Info
          },
          data: () => ({
               nameComponent : 'Colaborador',
               snackbarInfoCrud: false,
               infoCrud: '',
               crud: [],
               search: '',
               pagination: {
                    current_page:1,
               },
               paso: 1,
               infoLoader: 'Cargando Colaboradores',
               title : '',
               dialog: false,
               dialogDelete: false,
               objectsTabe: [
      
                    { text: 'Nombre', value: 'nombre' },
                    { text: 'Teléfono', value: 'telefono' },
                    { text: 'Opciones', value: 'actions', sortable: false },
               ],
               collaborators: [],
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
                    return this.editIndexObj === -1 ? 'Nuevo Colaborador' : 'Editar Colaborador'
               },
               titleCrud(){
                  this.title = 'Colaboradores'
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
                    this.getCollaborators()  
               },
               getCollaborators(){
                    this.$Progress.start()
                    this.snackbar = false
                    this.infoCrud = ''
                    axios.get(this.$apiUrl + `/collaborators?page` + this.pagination.current_page).then(response => {
                         if (response.status == 200) {
                              this.collaborators = response.data.colaboradores.data
                              this.pagination = response.data.colaboradores
                              this.$Progress.finish()
                         }
                         
                  
                    }, err => {
                        this.$Progress.fail()
                    })
               },
               saveObjCollaborator () {
                    this.$Progress.start()
                         
                    this.infoLoader = 'Guardando...'
                    axios.post(this.$apiUrl + `/collaborators`, this.editarObj).then(response => {
                         if (response.status == 200) {
                              this.infoCrud = 'Guardado Exitosamente'
                              this.snackbarInfoCrud = true

                              this.getCollaborators()
                              this.collaborators.unshift(response.data.tipoProducto)
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
                    this.editIndexObj = this.collaborators.indexOf(item)
                    this.editarObj = Object.assign({}, item)
                    this.dialog = true
               },
               updateObjCollaborator () {
                    this.$Progress.start()
                    this.snackbarInfoCrud = false
                    this.infoCrud = ''
                    this.infoLoader = 'Actualizando...'
                    axios.put(this.$apiUrl + `/collaborators/` + this.editarObj.id, this.editarObj).then(response => {
                         if (response.status == 200) {
                              this.infoCrud = 'Actualizado Exitosamente'
                              this.snackbarInfoCrud = true
                              this.getCollaborators()
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
                    this.editIndexObj = this.collaborators.indexOf(item)
                    this.editarObj = Object.assign({}, item)
                    this.dialogDelete = true
                    
                   
               },

               deleteItemConfirm () {
                    this.$Progress.start()
                    this.infoLoader = 'Eliminando...'
                    let objDelete = this.editarObj
                    axios.post(this.$apiUrl + `/collaborators-trash/` + this.editarObj.id).then(response => {
                         if (response.status == 200) {

                              this.getCollaborators()
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