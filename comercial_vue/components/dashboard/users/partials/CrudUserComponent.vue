<template>

     <div>
          <loader v-if="isloading" :infoLoader="infoLoader"></loader>


          <v-card class="searchMovil">
              <v-card-title>
                <v-text-field
                  v-model="search"
                  append-icon="mdi-magnify"
                  label="Buscar"
                  single-line
                  hide-details
                ></v-text-field>
              </v-card-title>
          </v-card>

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
                              <v-toolbar-title class="h3 titleCrud">{{ titleCrud }}
                                  
                              </v-toolbar-title>
                              
                              <v-divider
                                   class="mx-4"
                                   inset
                                   vertical>   
                              </v-divider>
                              <controls-crud 
                                   :openDialogControl="openDialog" 
                                   :getFuntion="getUsers"
                                   :nameComponent="nameComponent"
                                 >
                                   
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
                                                  class="mr-3 mt-3 seacrPc">
                                                       
                                             </v-text-field>
                                            
                                        </template>
                                        <v-stepper
                                             v-model="paso"
                                             vertical>
                                             <v-stepper-step

                                                  :complete="paso > 1"
                                                  color="#9E7AF3"
                                                  step="1">
                                                  <small style="cursor:pointer" @click="paso=1">{{ formTitle }}</small>
                                             </v-stepper-step>

                                             <v-stepper-content  step="1">
                                                  
                                                  <form-crud 
                                                       :archivosClienteServicio="archivosClienteServicio"
                                                       :docs="docs"
                                                       :unicoUser="unicoUser"
                                                       :updateObjUser="updateObjUser"
                                                       :saveObjUser="saveObjUser"
                                                       :closeDialog="closeDialog"
                                                       :close="close"
                                                       :editarObj="editarObj"
                                                       :editIndexObj="editIndexObj"
                                                       :formTitle="formTitle"
                                                       :editMode="editMode"></form-crud>
                                                       
                                                       <v-btn
                                                          v-if="editMode"
                                                          color="#9E7AF3"
                                                          @click="paso = 2">
                                                          Servicios Contratados
                                                        </v-btn>
                                                        <v-btn
                                                          v-else
                                                          style="opacity:0"
                                                          >
                                                          Servicios Contratados
                                                        </v-btn>
                                             </v-stepper-content>

                                             <v-stepper-step 
                                                  v-if="editMode"
                                                  :complete="paso > 2"
                                                  color="#9E7AF3"
                                                  step="2">
                                                  Servicios Contratados
                                             </v-stepper-step>
                                             

                                             <v-stepper-content  complete step="2" v-if="editMode" >

                                                  <v-row style="height:100%" v-if="editarObj.cliente_servicio.length > 0">
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
                                                                                <v-select  label="Producto" :items="products" item-text="nombre" item-value="id"  v-model="servicio.producto_id">
                                                                                     
                                                                                </v-select>
                                                                           </v-col>
                                                                           <v-col cols="12" xs="12" sm="12" md="6" lg="6" xl="6">
                                                                                <v-select label="Colaborador" :items="collaborators" item-text="nombre" item-value="id" v-model="servicio.colaborador_id">
                                                                                     
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
                                                                           <v-col cols="12" xs="12" sm="12" md="12" lg="12" xl="12">
                                                                                
                                                                                <input type="date" v-model="servicio.aviso_permanencia" class="form-control" id="exampleInputdate">


                
                                                                           </v-col>
                                                                           <v-col cols="12" xs="12" sm="12" md="6" lg="6" xl="6">
                                                                                <v-text-field @change="validar" label="Comision"  v-model="servicio.comision" suffix="€">
                                                                                     
                                                                                </v-text-field>
                                                                                 
                                                                           </v-col>
                                                                           

                                                                           <v-col cols="12" xs="12" sm="12" md="12" lg="12" xl="12">
                                                                                <v-textarea label="Nota de Gasto" v-model="servicio.nota_gasto">
                                                                                     
                                                                                </v-textarea>
                                                                           </v-col>

                                                                            <v-col cols="12" xs="12" sm="12" md="12" lg="12" xl="12">
                                                                                <v-textarea label="Notas" v-model="servicio.notas">
                                                                                     
                                                                                </v-textarea>
                                                                           </v-col>

                                                                            <v-col  cols="12" xs="12" sm="12" md="12" lg="12">
                                                                                     <h6>Documentos del Servicio</h6>
                                                                                    
                                                                                </v-col>   
                                                                                <v-row style="overflow-y: scroll!important; height:200px; margin-bottom: 40px; margin-top:30px">
                                                                               
                                                                                <v-col class="text-center" cols="12" xs="12" sm="12" md="4" lg="4" xl="4" v-for="doc,i in servicio.docs" :key="i" :id="'columna' + i" >
                                                                                
                                                 
                             
                                                                                
                                                                                    <i class="fa fa-file fa-4x"

                                                                                     v-if="    
                                                                                               doc[0].formato == 'zip' ||
                                                                                               doc[0].formato == 'tar' ||
                                                                                               doc[0].formato == 'rar' ||   
                                                                                               doc[0].formato == 'png' || 
                                                                                               doc[0].formato == 'PNG' ||  
                                                                                               doc[0].formato == 'jpg' || 
                                                                                               doc[0].formato == 'JPG' || 
                                                                                               doc[0].formato == 'jpeg' || 
                                                                                               doc[0].formato == 'JPEG' ||
                                                                                               doc[0].formato == 'svg' ||
                                                                                               doc[0].formato == 'SVG' ||
                                                                                               doc[0].formato == 'webp' ||
                                                                                               doc[0].formato == 'txt' ||
                                                                                                doc[0].formato == 'TXT' ||
                                                                                               doc[0].formato == 'WEBP'" >
                                                                                     <!--  height="200"
                                                                                     :src="pathDoc + doc[0].imagen"
                                                                                     class="img-fluid"
                                                                                     width="200" -->
                                                                                </i>
                                                                                <i class="fa fa-file fa-4x" 
                                                                                      v-if="doc[0].formato == 'pdf' ||
                                                                                              
                                                                                            doc[0].formato == 'html' ">
                                                                                </i>

                                                                                <i class="fa fa-file fa-4x" v-if="doc[0].formato == 'doc' || 
                                                                                                              doc[0].formato == 'docx' ||
                                                                                                              doc[0].formato == 'xls' ||
                                                                                                              doc[0].formato == 'xlsx' ||
                                                                                                              doc[0].formato == 'ppt' ||
                                                                                                              doc[0].formato == 'pptx' ||
                                                                                                              doc[0].formato == 'DOC' ||
                                                                                                              doc[0].formato == 'DOCX' ||
                                                                                                              doc[0].formato == 'XLS' ||
                                                                                                              doc[0].formato == 'XLSX' ||
                                                                                                              doc[0].formato == 'PPT' ||
                                                                                                              
                                                                                                              doc[0].formato == 'PPTX'">
                                                                                                         
                                                                                                              </i>
                                                                                <p>
                                                                                    {{doc[0].nombreImagen + '.'+ doc[0].formato}}
                                                                                </p>
                                                                                <p>
                                                                                     <v-btn title="Descargar" @click="callDown(doc[0].imagen)" color="orange" x-small>
                                                                                          <i class="fa fa-download "></i>
                                                                                     </v-btn>
                                                                                     <v-btn title="Eliminar" @click="eliminarAdjuntoDesdeCliente(doc[0], servicio, i)" color="red" x-small>
                                                                                          <i class="fa fa-close "></i>
                                                                                     </v-btn>
                                                                                    
                                                                                </p> 
                                                                                
                                                                                

                                                                           </v-col> 
                                                                           </v-row>
                                                                          
                                                                      </v-row>
                                                                       <v-chip @click="actualizarServicio(editarObj, servicio)">Actualizar servicio</v-chip>
                                                                </v-card-text>
                                                               
                                                              </v-card>
                                                            </template>

                                                           
                                                       </v-col>
                                                       
                                                  </v-row>
                                                  <v-row v-else class="mt-5">
                                                    <v-col>
                                                      <p>Todavía No ha contratado ningun servicio.</p><br>
                                                        <p><router-link to="/servicios-contratados">Contratar Servicio</router-link></p>
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
                                              <span v-else></span>
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
               unicoUser : {},
               docs : [],
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
              errorDecimalBeneficio:'',
              aux : []
             
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
               pathDoc(){

                    return window.location.origin + '/assets/images/docs/'
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
               saveDate(date){
                    console.log(date)
               },
               callDown(doc){
                        
                    let path  = this.pathDoc + doc 

                    this.downloadFiles(path, doc)
               },
               downloadFiles(url, filename) {
                    fetch(url).then(function(t) {
                         return t.blob().then((b)=>{
                                 var a = document.createElement("a");
                                 a.href = URL.createObjectURL(b);
                                 a.setAttribute("download", filename);
                                 a.click();
                             }
                         );
                     });
               },
               eliminarAdjuntoDesdeCliente(documento, item, i){
                   
                    this.$Progress.start()
                    this.infoLoader = 'Eliminando...'
                    let objDelete = new FormData()
                    objDelete.append('idServicio', item.id)
                    objDelete.append('imagen', documento.imagen)


                    for (var i = 0; i <  this.editarObj.cliente_servicio.length; i++) {
                         if (this.editarObj.cliente_servicio[i].id == item.id){
                              this.editarObj.cliente_servicio[i].docs = []
                         }
                         
                    }

                    axios.post(this.$apiUrl + `/clients-services-trash-imagen/` + item.id, objDelete).then(response => {
                         if (response.status == 200) {

                              for (var n = 0; n < this.editarObj.cliente_servicio.length; n++) {
                                   if (this.editarObj.cliente_servicio[n].id == item.id) {

                                        this.editarObj.cliente_servicio[n]['docs'] = []
                                        let restantes = response.data.docsRestantes
                                        let splitArray = []
                                        let splitPiso = []
                                       
                                        let images = restantes
                                         
                                        for (var i = 0; i < images.length; i++) {
                                             splitArray[splitArray.length]= images[i].split('.')

                                               
                                        }
                                        for (var i = 0; i < splitArray.length; i++) {
                                             let splitPiso = splitArray[i][0].split('_')

                                             let docPush  = [
                                                  {
                                                       'imagen' :splitArray[i][0] + '.' + splitArray[i][1],
                                                       'nombreImagen' :splitPiso[0],
                                                       'formato' :splitArray[i][1],
                                                       
                                                  }
                                             ]
                                             this.editarObj.cliente_servicio[n]['docs'].push(docPush)
                                            
                                        }  
                                        
                                         this.getUsers()
                                         break
                                   }

                              }
                              
                              
                              this.infoCrud = 'Documento Eliminado' 
                              this.snackbarInfoCrud = false
                              this.$Progress.finish()
                             
                         }
                    }, err => {
                         this.infoCrud = 'Ocurrió un Error Al Eliminar'
                         this.snackbarInfoCrud = true
                         this.$Progress.fail()
                    })

               },
               archivosClienteServicio(user){
                    this.unicoUser = {}
                    this.docs= []

                    for (var k = user.cliente_servicio.length - 1; k >= 0; k--) {
                       
                        if (this.editMode == true) {
                              var item = user.cliente_servicio[k]
                              user.cliente_servicio[k]['docs'] = [] 
                              this.unicoUser = item
                         
                              let splitArray = []
                              let splitPiso = []

                              let images = JSON.parse(this.unicoUser.documento)

                              for (var i = 0; i < images.length; i++) {
                                   splitArray[splitArray.length]= images[i].split('.')

                                     
                              }
                              for (var i = 0; i < splitArray.length; i++) {
                                   let splitPiso = splitArray[i][0].split('_')

                                   let docPush  = [
                                        {
                                             'imagen' :splitArray[i][0] + '.' + splitArray[i][1],
                                             'nombreImagen' :splitPiso[0],
                                             'formato' :splitArray[i][1],
                                             
                                        }
                                   ]
                                   user.cliente_servicio[k]['docs'].push(docPush)

                                   
                              }  
                         }
                    }

                    
               },
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

                              for (var i = 0; i < this.users.length; i++) {
                                   for (var n = 0; n < this.users[i].cliente_servicio.length; n++) {
                                        
                                         this.users[i].cliente_servicio[n]['menu'] = false
                                         
                                   }
                                 
                              }
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
                    this.archivosClienteServicio(item)
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
