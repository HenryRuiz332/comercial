<template>

     <div>
          

          <loader v-if="isloading" :infoLoader="infoLoader"></loader>
          <v-data-table
          :headers="objectsTabe"
          :items="users"
          sort-by="calories"
          class="elevation-1">

                   <template v-slot:top>
                         <v-toolbar
                              flat>
                              <v-toolbar-title>{{ titleCrud }}</v-toolbar-title>
                              <v-divider
                                   class="mx-4"
                                   inset
                                   vertical>
                                        
                              </v-divider>
                              <v-spacer></v-spacer>
                              <v-dialog
                                   v-model="dialog"
                                  
                                   persistent
                                   fullscreen
                                   hide-overlay
                                   transition="dialog-bottom-transition">
                                        <template v-slot:activator="{ on, attrs }">
                                         
                                             <button 
                                                  class="btn btn-outline-success mb-3 mr-3"
                                                  @click="openDialog">
                                                  <i class="fa fa-plus pr-0"></i>
                                             </button>
                                             <button 
                                                  class="btn btn-outline-danger mb-3 mr-3">
                                                       <i class="ri-delete-bin-2-fill pr-0"></i>
                                             </button>
                                             <button 
                                                  class="btn btn-outline-primary mb-3 mr-3"
                                                  @click="getUsers()">
                                                      <i class="fas fa-retweet"></i>
                                             </button>
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
                                                                 @click="saveObjUser">
                                                                      Guardar
                                                            </v-btn>
                                                            <v-btn
                                                                 v-else
                                                                 dark
                                                                 text
                                                                 @click="updateObjUser">
                                                                      Actualizar
                                                            </v-btn>
                                                            </v-toolbar-items>
                                                       </v-toolbar>

                                                       <v-card-text>
                                                            <v-container>
                                                                 <v-row>
                                                                      <v-col
                                                                           cols="12"
                                                                           sm="6"
                                                                           md="4"
                                                                           lg="4"
                                                                           xl="4">
                                                                                <v-text-field
                                                                                     v-model="editarObj.nombre"
                                                                                     label="Nombre Completo">
                                                                                       
                                                                                </v-text-field>
                                                                      </v-col>
                                                                      <v-col
                                                                           cols="12"
                                                                           sm="6"
                                                                           md="4"
                                                                           lg="4"
                                                                           xl="4">
                                                                           <v-text-field
                                                                               v-model="editarObj.telefono"
                                                                               label="Teléfono">
                                                                               
                                                                          </v-text-field>
                                                                      </v-col>
                                                                      <v-col
                                                                           cols="12"
                                                                           sm="6"
                                                                           md="4"
                                                                           lg="4"
                                                                           xl="4">
                                                                                <v-text-field
                                                                                     v-model="editarObj.cif"
                                                                                     label="CIF">
                                                                                       
                                                                                </v-text-field>
                                                                      </v-col>
                                                                      <v-col
                                                                           cols="12"
                                                                           sm="6"
                                                                           md="4"
                                                                           lg="4"
                                                                           xl="4">
                                                                           <v-text-field
                                                                                v-model="editarObj.email"
                                                                                label="Email">
                                                                                  
                                                                           </v-text-field>
                                                                      </v-col>
                                                                      <v-col
                                                                           cols="12"
                                                                           sm="6"
                                                                           md="4"
                                                                           lg="4"
                                                                           xl="4">
                                                                                <v-text-field
                                                                                     v-model="editarObj.gasto"
                                                                                     label="Gasto">
                                                                                    
                                                                                </v-text-field>
                                                                      </v-col>
                                                                      <v-col
                                                                           cols="12"
                                                                           sm="6"
                                                                           md="4"
                                                                           lg="4"
                                                                           xl="4">
                                                                                <v-text-field
                                                                                     v-model="editarObj.beneficio"
                                                                                     label="Beneficio">
                                                                                    
                                                                                </v-text-field>
                                                                      </v-col>
                                                                       <v-col
                                                                           cols="12"
                                                                           sm="12"
                                                                           md="12"
                                                                           lg="12"
                                                                           xl="12">
                                                                                <v-textarea
                                                                                     v-model="editarObj.nota_gasto"
                                                                                     label="Nota">
                                                                                    
                                                                                </v-textarea>
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
                                                                      @click="saveObjUser">
                                                                           Guardar
                                                                 </v-btn>
                                                                 <v-btn
                                                                      v-else
                                                                      x-smal
                                                                      color="#9E7AF3"
                                                                      text
                                                                      @click="updateObjUser">
                                                                           Actualizar
                                                                 </v-btn>
                                                       </v-card-actions>
                                                  </v-card>
                   
                                             </v-stepper-content>

                                             <v-stepper-step
                                                  v-if="editMode == true"
                                                  :complete="paso > 2"
                                                  step="2">
                                                  Servicios Contratados
                                             </v-stepper-step>
                                        </v-stepper>
                                   
                              </v-dialog>

                              <v-dialog v-model="dialogDelete" max-width="500px">
                                   <v-card>
                                        <v-card-title class="headline">Are you sure you want to delete this item?</v-card-title>
                                        <v-card-actions>
                                             <v-spacer></v-spacer>
                                             <v-btn color="blue darken-1" text @click="closeDelete">Cancel</v-btn>
                                             <v-btn color="blue darken-1" text @click="deleteItemConfirm">OK</v-btn>
                                             <v-spacer></v-spacer>
                                        </v-card-actions>
                                   </v-card>
                              </v-dialog>

                         </v-toolbar>
                   </template>
                   <template v-slot:item.actions="{ item }">
                         <v-btn @click="editObj(item)" x-small color="success">
                              <i class="fa fa-pencil mr-2"></i>
                         </v-btn>
                         <v-btn @click="deleteObj(item)" x-small color="error">
                              <i class="fa fa-trash mr-2"></i>
                         </v-btn>
                   </template>
                   <template v-slot:no-data>
                         <v-btn
                              color="primary"
                              @click="ini">
                              
                         </v-btn>
                   </template>
                   <tfoot></tfoot>
          </v-data-table>
          
         <!--  <div>
               <paginate id="pages" v-if="pagination.last_page > 1"
                              :pagination="pagination"
                              :offset="5"
                              @paginate="getUsers()"></paginate>
          </div> -->
     </div>
</template>

<script type="text/javascript">

     import DialogCrud from "./DialogCrud"
     import Pagination from "../../../../global_components/Pagination.vue"

     export default {
          components:{
               'dialog-crud' : DialogCrud,
               'paginate' : Pagination
          },
          data: () => ({
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
               editIndexObj: -1,
               editMode : false,
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
                    axios.get(this.$apiUrl + `/users?page` + this.pagination.current_page).then(response => {
                         if (response.status == 200) {
                              this.users = response.data.users.data
                              this.pagination = response.data.users
                         }
                         
                  
                    }, err => {
                   
                    })
               },
               saveObjUser () {

                    axios.post(this.$apiUrl + `/users`, this.editarObj).then(response => {
                         if (response.status == 200) {

                              this.users.push(response.data.user)
                              this.close()
                         }
                    }, err => {
                   
                    })

                   
               },
               editObj (item) {
                    this.editMode = true
                    this.editIndexObj = this.users.indexOf(item)
                    this.editarObj = Object.assign({}, item)
                    this.dialog = true
               },
               updateObjUser () {
                    axios.put(this.$apiUrl + `/users/` + this.editarObj.id, this.editarObj).then(response => {
                         if (response.status == 200) {
                              this.getUsers()
                              this.close()
                         }
                    }, err => {
                   
                    })

                   
               },

               deleteObj (item) {
                    this.editIndexObj = this.users.indexOf(item)
                    this.editarObj = Object.assign({}, item)
                    this.dialogDelete = true
               },

               deleteItemConfirm () {
                     this.users.splice(this.editIndexObj, 1)
                     this.closeDelete()
               },

               close() {
                    this.closeDialog()
                    this.$nextTick(() => {
                         this.editarObj = Object.assign({}, this.objDefault)
                         this.editIndexObj = -1
                    })
               },
               closeDelete () {
                    this.dialogDelete = false
                    this.$nextTick(() => {
                         this.editarObj = Object.assign({}, this.objDefault)
                         this.editIndexObj = -1
                    })
               },

              
          },
     };
</script>