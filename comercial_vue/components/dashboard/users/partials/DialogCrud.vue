<template>
	<v-dialog
          v-model="dialog"
         
          persistent
          fullscreen
          hide-overlay
          transition="dialog-bottom-transition">

          <template v-slot:activator="{ on, attrs }">
                 <!-- <v-btn
                      x-small
                      color="primary"
                      dark
                      class="mb-2"
                      v-bind="attrs"
                      v-on="on">
                      <v-icon>
                           mdi-plus
                      </v-icon>
                 </v-btn> -->

                 <button 
                      class="btn btn-outline-success mb-3 mr-3"
                         @click="openDialog">
                      <i class="fa fa-plus pr-0"></i>
                 </button>
                 <button 
                      
                      class="btn btn-outline-danger mb-3 mr-3"
                      v-bind="attrs"
                      v-on="on">
                      <i class="ri-delete-bin-2-fill pr-0"></i>
                 </button>
                 <button 
                      color="primary"
                      class="btn btn-outline-primary mb-3 mr-3"
                      @click="getUsers()">
                      <i class="fa fa-async pr-0"></i>
                 </button>
          </template>
          <v-card>
               <v-toolbar
                    dark
                    color="primary">
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
                        dark
                        text
                        @click="saveObjUser">
                              Guardar
                    </v-btn>
                    </v-toolbar-items>
               </v-toolbar>

               <v-card-text>
                    <v-container>
                         <v-row>
                              <v-col
                                   cols="12"
                                   sm="6"
                                   md="4">
                                        <v-text-field
                                             v-model="editarObj.name"
                                             label="Nombre Completo">
                                               
                                        </v-text-field>
                              </v-col>
                              <v-col
                                   cols="12"
                                   sm="6"
                                   md="4">
                                   <v-text-field
                                       v-model="editarObj.last_name"
                                       label="Last Name">
                                       
                                  </v-text-field>
                              </v-col>
                              <v-col
                                   cols="12"
                                   sm="6"
                                   md="4">
                                        <v-text-field
                                             v-model="editarObj.document"
                                             label="CIF">
                                               
                                        </v-text-field>
                              </v-col>
                              <v-col
                                   cols="12"
                                   sm="6"
                                   md="4">
                                   <v-text-field
                                        v-model="editarObj.address"
                                        label="Address">
                                          
                                   </v-text-field>
                              </v-col>
                              <v-col
                                   cols="12"
                                   sm="6"
                                   md="4">
                                        <v-text-field
                                             v-model="editarObj.phone"
                                             label="Phone">
                                            
                                        </v-text-field>
                              </v-col>
                         </v-row>
                    </v-container>
               </v-card-text>

               <v-card-actions>
                    <v-spacer></v-spacer>
                         <v-btn
                              x-smal
                              color="blue darken-1"
                              text
                              @click="close">
                                Cancel
                         </v-btn>
                         <v-btn
                              x-smal
                               color="blue darken-1"
                              text
                              @click="saveObjUser">
                                Save
                         </v-btn>
            </v-card-actions>
       </v-card>
     </v-dialog>
</template>

<script type="text/javascript">
    export default {
    	props:{
    		openDialog : Function,
    		closeDialog: Function,
    		dialog: Boolean
    	},

        data: () => ({
            title : '',
           
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
           	editarObj: {
                id: '',
                nombre: '',
                cif: '',
                telefono: '',
                email: '',
           	},
           	objDefault: {
                id: '',
                nombre: '',
                cif: '',
                telefono: '',
                email: '',
           	},
              
               
          }),

          computed: {
               	formTitle () {
                    return this.editIndexObj === -1 ? 'Nuevo Cliente' : 'Editar Cliente'
               	},
               	titleCrud(){
                  this.title = 'Clientes'
                  return this.title
               	}
          },

          watch: {
              
          },

          created () {
              
          },

          methods: {
        	      saveObjUser () {
                    if (this.editIndexObj > -1) {
                         Object.assign(this.users[this.editIndexObj], this.editarObj)
                    } else {
                         this.users.push(this.editarObj)
                    }
                    this.close()
           	},
           	editObj (item) {
                     this.editIndexObj = this.users.indexOf(item)
                     this.editarObj = Object.assign({}, item)
                     this.dialogCrearAlmacen = true
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

              
        },
     };
</script>