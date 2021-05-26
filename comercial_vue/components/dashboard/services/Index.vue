<template>
     <v-data-table
          :headers="objectsTabe"
          :items="arrayObjects"
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
                              v-model="dialogCrearAlmacen"
                              max-width="70%">

                              <template v-slot:activator="{ on, attrs }">
                                   <v-btn
                                        x-small
                                        color="primary"
                                        dark
                                        class="mb-2"
                                        v-bind="attrs"
                                        v-on="on">
                                        <v-icon>
                                             mdi-plus
                                        </v-icon>
                                   </v-btn>
                              </template>
                              <v-card>
                                   <v-card-title>
                                        <span class="headline">{{ formTitle }}</span>
                                   </v-card-title>

                                   <v-card-text>
                                        <v-container>
                                             <v-row>
                                                  <v-col
                                                       cols="12"
                                                       sm="6"
                                                       md="4">
                                                            <v-text-field
                                                                 v-model="editarObj.name"
                                                                 label="First Name">
                                                                      
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
                                                                 label="Document">
                                                                      
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
                                                   @click="saveObj">
                                                       Save
                                             </v-btn>
                                   </v-card-actions>
                              </v-card>
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
                    <v-icon
                          small
                         class="mr-2"
                         @click="editObj(item)">
                              mdi-pencil
                    </v-icon>
                    <v-icon
                         small
                         @click="deleteObj(item)">
                         mdi-delete
                    </v-icon>
              </template>
              <template v-slot:no-data>
                    <v-btn
                         color="primary"
                         @click="ini">
                         Reset
                    </v-btn>
              </template>
     </v-data-table>
</template>

<script>
     export default {
          data: () => ({
               title : '',
               dialogCrearAlmacen: false,
               dialogDelete: false,
               objectsTabe: [
      
                    { text: 'Name', value: 'name' },
                    { text: 'Last Name', value: 'last_name' },
                    { text: 'Document', value: 'document' },
                    { text: 'Address', value: 'address' },
                    { text: 'Phone', value: 'phone' },
                    { text: 'Actions', value: 'actions', sortable: false },
               ],
               arrayObjects: [],
               editIndexObj: -1,
               editarObj: {
                    name: 'henry',
                    last_name: 'ruiz',
                    document: '20097857',
                    address: 'Antimano 1100',
                    phone: '04142823998',
               },
               objDefault: {
                    name: '',
                    last_name: '',
                    document: '',
                    address: '',
                    phone: '',
               },
          }),

          computed: {
               formTitle () {
                    return this.editIndexObj === -1 ? 'New Item' : 'Edit Item'
               },
               titleCrud(){
                  this.title = 'Title crud'
                  return this.title
               }
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
               ini () {
                    this.getQuery()  
               },
               getQuery(){
                this.arrayObjects = [
                         {
                              name: 'Henry',
                              last_name: 'Ruiz',
                              document: '20097857',
                              address: 'Antmano-1100',
                              phone: '4142823998',
                         },
                    ]
               },
               saveObj () {
                    if (this.editIndexObj > -1) {
                    Object.assign(this.arrayObjects[this.editIndexObj], this.editarObj)
                    } else {
                         this.arrayObjects.push(this.editarObj)
                    }
                         this.close()
               },
               editObj (item) {
                    this.editIndexObj = this.arrayObjects.indexOf(item)
                    this.editarObj = Object.assign({}, item)
                    this.dialogCrearAlmacen = true
               },

               deleteObj (item) {
                    this.editIndexObj = this.arrayObjects.indexOf(item)
                    this.editarObj = Object.assign({}, item)
                    this.dialogDelete = true
               },

               deleteItemConfirm () {
                    this.arrayObjects.splice(this.editIndexObj, 1)
                    this.closeDelete()
               },

               close() {
                    this.dialogCrearAlmacen = false
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
     }
</script>