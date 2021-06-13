<template>

     <div>
          <loader v-if="isloading" :infoLoader="infoLoader"></loader>


          <div style="background:white">
               <v-row class="container">
                    <v-col cols="12" xs="12" sm="12" md="3" lg="3" xl="3">
                         <v-toolbar-title>{{ titleCrud }}</v-toolbar-title>     
                    </v-col>
                    <v-col cols="12" xs="12" sm="12" md="3" lg="3" xl="3">
                         <controls-crud 
                                   :openDialogControl="openDialog" 
                                   :getFuntion="getExpenses"
                                   :nameComponent="nameComponent">
                                   
                         </controls-crud>
                    </v-col> 
                    <v-col  cols="12" xs="12" sm="12" md="3" lg="3" xl="3">
                          <v-text-field
                                   append-icon="mdi-magnify"
                                   v-model="search"
                                   label="Buscar"
                                   class="mr-3 mt-3">
                                        
                              </v-text-field>
                             
                    </v-col>
               </v-row>
               <v-row class="container" style="margin-top:-3vw">
                    <v-col cols="12" xs="12" sm="12" md="12" lg="12" xl="12">

                        <rango-fechas 
                                   :expensesTypes="expensesTypes"
                                   :url="url" 
                                   has_tipo="true" 
                                   v-on:success_query="setGastos"></rango-fechas>
                    </v-col>
               </v-row>
          </div>
          <v-simple-table>
               <template v-slot:default>
                    <thead>
                         <tr>
                              <th class="text-left">
                                   Importe
                              </th>
                              <th class="text-left">
                                   Tipo de Gasto
                              </th>
                              <th class="text-left">
                                   Fecha
                              </th>
                              <th class="text-left">
                                   Opciones
                              </th>
                         </tr>
                    </thead>
                    <tbody>
                         <tr v-for="item in expenses" :key="item.name">
                              <td>{{ item.importe }}</td>
                              <td>{{ item.tipo_gasto.nombre }}</td>
                              <td>{{ item.fecha }}</td>
                              <td>
                                   <v-btn @click="editObj(item)" color="success" x-small>
                                        <i class="fa fa-pencil mr-2"></i>
                                   </v-btn>
                                   <v-btn @click="deleteObj(item)" color="error" x-small>
                                        <i class="fa fa-trash mr-2"></i>
                                   </v-btn>
                              </td>
                         </tr>
                    </tbody>
               </template>
               </v-simple-table>
               <v-dialog
                    v-model="dialog"
                    max-width="70%"
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
                                   :editMode="editMode"
                                   :expensesTypes="expensesTypes"
                                   ></form-crud>
               </v-dialog>

              <dialog-delete :dialogDelete="dialogDelete" 
                              :closeDelete="closeDelete"
                              :deleteItemConfirm="deleteItemConfirm"></dialog-delete>
               <info-crud :snackbar="snackbarInfoCrud" :info="infoCrud" :closeSnackbar="closeSnackbar"></info-crud>
        
     </div>
</template>

<script type="text/javascript">
     import Pagination from "../../../../global_components/Pagination.vue"
     import FormCrud from "./Form.vue"
     import Controls from "../../crud/Controls.vue"
     import Info from "./Info.vue"
     import DialogDelete from "../../crud/DialogDelete.vue"
     import RangoFechas from "./RangoFechas.vue"
     export default {
          components:{
               'paginate' : Pagination,
               'form-crud' : FormCrud,
               'controls-crud' : Controls,
               'info-crud' : Info,
               'dialog-delete': DialogDelete,
               'rango-fechas' : RangoFechas
          },
          data: () => ({
               nameComponent : 'Gasto',
               snackbarInfoCrud: false,
               infoCrud: '',
               crud: [],
               search: '',
               pagination: {
                    current_page:1,
               },
               paso: 1,
               infoLoader: 'Cargando Gastos',
               title : '',
               dialog: false,
               dialogDelete: false,
               objectsTabe: [
      
                    { text: 'Importe', value: 'importe' },
                    { text: 'Tipo de Gasto', value: 'tipo_gasto.nombre' },
                    { text: 'Fecha', value: 'fecha' },
                    { text: 'Opciones', value: 'actions', sortable: false },
               ],
               expenses: [],
               expensesTypes: [],
               editMode: false,
               editIndexObj: -1,
               editarObj: {
                    id: '',
                    tipo_de_gasto_id: '',
                    importe: '',
                    fecha: '',
                    descripcion: '',
                    
                   
               },
               objDefault: {
                    id: '',
                    tipo_de_gasto_id: '',
                    importe: '',
                    fecha: '',
                    descripcion: '',
                    
                    
               },
               url : ''
              
          }),

          computed: {
               formTitle () {
                    return this.editIndexObj === -1 ? 'Nuevo Gasto' : 'Editar Gasto'
               },
               titleCrud(){
                  this.title = 'Gastos Generales'
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
               this.url =  this.$apiUrl + `/gastos`
          },

          methods: {
               setGastos(data) {

                    if (data.length > 0) {
                         this.expenses = data
                         return
                    }
                    this.expenses = []
                    alert("no hay")
               },

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
                    this.getExpenses()  
               },
               getExpenses(){
                    this.$Progress.start()
                    axios.get(this.$apiUrl + `/gastos` ).then(response => {
                         if (response.status == 200) {
                              this.expenses = response.data.expenses.data
                              this.expensesTypes = response.data.expensesTypes
                              // this.pagination = response.data.products
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
                    axios.post(this.$apiUrl + `/gastos`, this.editarObj).then(response => {
                         if (response.status == 200) {
                              this.infoCrud = 'Guardado Exitosamente'
                              this.snackbarInfoCrud = true
                              this.expenses.unshift(response.data.expense)
                              this.getExpenses()
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
                    this.editIndexObj = this.expenses.indexOf(item)
                    this.editarObj = Object.assign({}, item)
                    this.dialog = true
               },
               updateObject () {
                    this.$Progress.start()
                    this.snackbarInfoCrud = false
                    this.infoCrud = ''
                    this.infoLoader = 'Actualizando...'
                    axios.put(this.$apiUrl + `/gastos/` + this.editarObj.id, this.editarObj).then(response => {
                         if (response.status == 200) {
                              this.infoCrud = 'Actualizado Exitosamente'
                              this.snackbarInfoCrud = true
                              this.getExpenses()
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
                    this.editIndexObj = this.expenses.indexOf(item)
                    this.editarObj = Object.assign({}, item)
                    this.dialogDelete = true
                    
                   
               },

               deleteItemConfirm () {
                    this.$Progress.start()
                    this.infoLoader = 'Eliminando...'
                    let objDelete = this.editarObj
                    axios.post(this.$apiUrl + `/gastos-trash/` + this.editarObj.id).then(response => {
                         if (response.status == 200) {

                              this.getExpenses()
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