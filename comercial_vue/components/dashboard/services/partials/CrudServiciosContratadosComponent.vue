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
                                   :getFuntion="getClientServices"
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
                         :item-class="itemRowBackground"
                         style="margin-top:-2.5vw"
                         :search="search"
                         class="elevation-1"
                         show-select
                         v-model="crud" 
                         :headers="objectsTabe" 
                         :items="clientsServices" >


                  

                        <!--   <template v-slot:item.montosModal="{ item }">
                               <a target="_blank" :href="item.path" @click="modalMontosList(item)">
                                   <v-icon medium color="orange" class="mr-2">
                                       mdi-nfc-variant
                                   </v-icon>
                               </a>
                           </template> -->

                       

                  <!--   <template v-slot:default>
                         <thead>
                              <tr>
                                   <th><v-checkbox></v-checkbox></th>
                                   <th class="text-left">
                                        Cliente
                                   </th>
                                   <th class="text-left">
                                        Servicio
                                   </th>
                                   <th class="text-left">
                                        Producto
                                   </th>
                                   <th class="text-left">
                                        Gasto
                                   </th>
                                   <th class="text-left">
                                        Comisión
                                   </th>
                                   <th class="text-left">
                                        Opciones
                                   </th>
                              </tr>
                         </thead>
                         <tbody>
                              <tr 
                                   v-for="item in clientsServices" 
                                   :key="item.id"
                                   :class="item.aviso <= 30 ? 'permanencia' : ''">
                                   <td><v-checkbox></v-checkbox></td>
                                   <td>{{ item.cliente.nombre }}</td>
                                   <td>{{ item.servicio.nombre}}</td>
                                   <td v-if="item.producto_id">{{ item.producto.nombre }}</td>
                                   <td v-else></td>
                                   <td>
                                        <span v-for="monto in item.monto" :key="monto.id">
                                             {{  monto.gasto }}€,
                                        </span>
                                   </td>
                                   <td>
                                        <span v-for="monto in item.monto" :key="monto.id">
                                             {{  monto.comision }}€,
                                        </span>
                                   </td>
                                   <td>
                                         <v-btn @click="modalDocs(item)" color="orange" x-small>
                                             <i class="fa fa-download mr-2"></i>
                                        </v-btn>

                                        <v-btn @click="editObj(item)" color="success" x-small>
                                             <i class="fa fa-pencil mr-2"></i>
                                        </v-btn>
                                        <v-btn @click="deleteObj(item)" color="error" x-small>
                                             <i class="fa fa-trash mr-2"></i>
                                        </v-btn>
                                   </td>
                                   
                              </tr>

                             

                         </tbody>
                    </template> -->

                    <template v-slot:top>
                         <v-toolbar
                              flat>
                             
                          
                             
                              <v-dialog
                                   v-model="dialog"
                                  
                                   persistent
                                   fullscreen
                                   hide-overlay
                                   transition="dialog-bottom-transition">
                                        <template v-slot:activator="{ on, attrs }">
                                             
                                           
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
                                                       :montosInputs="montosInputs"
                                                       :addRow="addRow"
                                                       :removeRow="removeRow"
                                                       :unicoItem="unicoItem"
                                                       :eliminarAdjunto="eliminarAdjunto"
                                                       :callDown="callDown"
                                                       :editObj="editObj"
                                                       :getClientServices="getClientServices"
                                                       :updateObjUser="updateObjUser"
                                                       :closeDialog="closeDialog"
                                                       :close="close"
                                                       :editarObj="editarObj"
                                                       :editIndexObj="editIndexObj"
                                                       :formTitle="formTitle"
                                                       :editMode="editMode" 
                                                       :services="services"
											:clients="clients"
											:products="products"
											:collaborators="collaborators" 
                                                       :successDataSave="successDataSave"
                                                       :beforeSave="beforeSave"
                                                       :docs="docs">
                                                            
                                                       </form-crud>
                   
                                             </v-stepper-content>

                                             <!-- <v-stepper-step
                                                  v-if="editMode == true"
                                                  :complete="paso > 2"
                                                  step="2">
                                                  Servicios Contratados
                                             </v-stepper-step> -->
                                        </v-stepper>
                                   
                              </v-dialog>

                              <dialog-delete :dialogDelete="dialogDelete" 
                                             :closeDelete="closeDelete"
                                             :deleteItemConfirm="deleteItemConfirm"></dialog-delete>

                              <v-dialog
                                    v-model="dialogModalDoc"
                                    fullscreen
                                    hide-overlay
                                    transition="dialog-bottom-transition">
                              
                                   <v-card>
                                      <v-toolbar
                                        dark
                                        color="primary">
                                        <v-btn
                                          icon
                                          dark
                                          @click="dialogModalDoc = false">
                                          <v-icon>mdi-close</v-icon>
                                        </v-btn>
                                        <v-toolbar-title class="h6">Documentos del Servicio</v-toolbar-title>
                                        <v-spacer></v-spacer>
                                        
                                        <v-toolbar-items class="itemsDown">
                                          <v-btn
                                            dark
                                            text
                                            @click="dialogModalDoc = false">
                                            Cerrar
                                          </v-btn>
                                        </v-toolbar-items>
                                      </v-toolbar>
                                   <v-row class="container">
                                        <v-col class="text-center" cols="12" xs="12" sm="12" md="12" lg="12" xl="12">
                                             <p v-if="docs.length > 0">
                                                   <v-btn 
                                                       @click="downAll()" 
                                                       small 
                                                       color="orange"
                                                       >Descargar Todos</v-btn>
                                                  <v-btn 
                                                       @click="eliminarTodosDocs()" 
                                                       small 
                                                       color="red"
                                                      >Eliminar Todos</v-btn>
                                             </p>
                                            

                                                  <span v-else>No se existen documentos relacionados a este servicio</span>
                                        </v-col>
                                        <v-col class="text-center" cols="12" xs="12" sm="12" md="4" lg="4" xl="4" v-for="doc,i in docs" :key="i">
                                             
                                             <i class="fa fa-file fa-4x"
                                                  v-if="    doc[0].formato == 'png' || 
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
                                                  <v-btn title="Eliminar" @click="eliminarAdjunto(doc[0], unicoItem)" color="red" x-small>
                                                       <i class="fa fa-close "></i>
                                                  </v-btn>
                                             </p>
                                        </v-col>
                                   </v-row>
                                 <v-divider></v-divider>
                                 
                               </v-card>
                             </v-dialog>

                         </v-toolbar>
                   </template>

                  
                   <template v-slot:item.actions="{ item }">
                         <v-btn @click="modalDocs(item)" color="orange" x-small>
                              <i class="fa fa-download mr-2"></i>
                         </v-btn>

                          <v-btn @click="modalMontosList(item)" color="white" x-small>
                              <v-icon x-small color="orange" class="mr-2">
                                   mdi-nfc-variant
                              </v-icon>
                            </v-btn>  
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

          <v-dialog persistent v-model="modalMonunts" max-width="80%">
                                        
               <v-card>
                    <h5 class="container" v-if="modalMonunts">
                         {{montosClick.servicio.nombre}}
                    </h5>
                    <h5 class="container" v-if="modalMonunts">
                         {{montosClick.cliente.nombre}}
                    </h5>
                    <p class="container">Información acerca de los montos, fecha de Inicio y Fecha de Caducidad de este servicio.</p>
                    <p class="container">Los items de la lista marcados en rojo son servicios que estan por caducar.</p>
                    <v-card-text>
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col"><small>Gasto</small></th>
                          <th scope="col"><small>Comision</small></th>
                          <th scope="col"><small>Beneficio</small></th>
                          <th scope="col"><small>Fecha</small></th>
                          <th scope="col"><small>F. Caducidad</small></th>
                          
                        </tr>
                      </thead>
                      <tbody>
                        <tr 
                         v-for="m,k in  montosClick.monto" 
                         :key="k" 
                         :class="m.aviso <= 30 ? 'permanencia' : ''">
                              
                          <td><small>{{m.gasto ? m.gasto+ '€' : 0}}</small></td>
                          <td><small>{{m.comision+ '€'}}</small></td>
                          <td><small>{{m.beneficio+ '€'}}</small></td>
                          <td><small>{{m.fecha}}</small></td>
                          <td><small>{{m.aviso_permanencia}}</small></td>
                        </tr>
                      </tbody>
                    </table>
               </v-card-text>
                <v-card-actions >
               <v-spacer></v-spacer>
               <v-btn @click="closemodalMontosList" color="red" small>Cerrar</v-btn>
               <v-btn 
               
               @click="guardarMontos(servicio)" 
               color="success" 
               small>Guardar</v-btn>
             </v-card-actions>
               </v-card>
               

          </v-dialog>



          <span style="visibility:hidden; opacity:0; position:absolute; z-index:0">{{scoped}}</span>
          <info-crud :snackbar="snackbarInfoCrud" :info="infoCrud" :closeSnackbar="closeSnackbar"></info-crud>
     </div>
</template>

<script type="text/javascript">
     import Pagination from "../../../../global_components/Pagination.vue"
     import FormServiciosContratados from "./FormServiciosContratados.vue"
     import Controls from "../../crud/Controls.vue"
     import Info from "../../crud/Info.vue"
     import DialogDelete from "../../crud/DialogDelete.vue"
                                            
     export default {
          components:{
               'paginate' : Pagination,
               'form-crud' : FormServiciosContratados,
               'controls-crud' : Controls,
               'info-crud' : Info,
                'dialog-delete': DialogDelete
          },
          data: () => ({
               loading: false,
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
                    { text: 'Gastos (€)', value: 'gasto' },
                    { text: 'Comisiones (€)' , value: 'comision' },
                    { text: 'Beneficios (€)', value: 'beneficio' },
                   
                   
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
                    archivo : {}
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
                    archivo : {}
               },
               dialogModalDoc : false,
               unicoItem: {},
               docs : [],


               montosInputs:[
                    {
                         id: 0,
                         menu: '',
                         gasto: '',
                         comision: '',
                         beneficio: '',
                         fecha: '',
                         aviso_permanencia :''
                    }

                    
               ],
               montosClick : {},
               modalMonunts: false
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
               pathDoc(){

                    return window.location.origin + '/assets/images/docs/'
               },
               scoped(){
                     for (var i = 0; i < this.clientsServices.length; i++) {
                          if (this.crud.length > 0) {
                              this.clientsServices[i].crud = true
                         }else{
                            this.clientsServices[i].crud = false 
                         }
                         
                    }
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
               itemRowBackground (item){

                  for (var i = 0; i < item.monto.length; i++) {
                       return item.monto[i].dias <= 30   ? 'permanencia' : ''
                  }
                     
                  
               },
               axiosNotificarCaducidad(objMail){

                    let notify = new FormData()
                    notify.append('services', JSON.stringify(objMail))

                    axios.post(this.$apiUrl + `/notify-date`, notify).then(response => {
                        
                    }, err => {
                        
                    })
               },
               calcularFechasDeCaducidad(item){
                    
                    let vb = item.monto
                    var  fecha_inicio = ''
                    var  avisoPermam = ''
                    let res = ''

                    for (var i = 0; i < vb.length; i++) {
                         fecha_inicio = moment(vb[i].fecha)
                         avisoPermam = moment(vb[i].aviso_permanencia)

                         res = avisoPermam.diff(fecha_inicio, 'days')

                         vb[i]['aviso'] = res*1
                         vb[i]['redColor'] = false
                         
                         if (vb[i]['aviso'] <= 30) {
                              vb[i]['redColor'] = true

                              
                         }

                         
                    }
                    //axios notificar
                    for (var n = 0; n < vb.length; n++) {
                        if (vb[n].aviso <= 30) {

                            
                              break
                         } 
                    }


                   

               },
               modalMontosList(item){
                    this.calcularFechasDeCaducidad(item)

                    this.montosClick = item
                    this.modalMonunts = true
                    
               },
               closemodalMontosList(){
                    this.montosClick = {}
                    this.modalMonunts = false
               },
               addRow(){
                    if (this.montosInputs.length == 0) {
                         let vm = this.montosInputs
                         let newMontosInputs = {
                              id: 1,
                              menu: '',
                              gasto: '',
                              comision: '',
                              beneficio: '',
                              fecha: '',
                              aviso_permanencia :''
                         }
                         vm.push(newMontosInputs)
                         return 
                    }
                     if (this.editMode == false) {
                         let vm = this.montosInputs
                         let lastId = vm[vm.length-1].id
                         let newMontosInputs = {
                              id: lastId + 1,
                              menu: '',
                              gasto: '',
                              comision: '',
                              beneficio: '',
                              fecha: '',
                              aviso_permanencia :''
                         }
                         vm.push(newMontosInputs)
                    }else{
                         let vm = this.montosInputs
                         let lastId = vm[vm.length-1].id
                         let newMontosInputs = {
                              id: lastId + 1,
                              menu: '',
                              gasto: '',
                              comision: '',
                              beneficio: '',
                              fecha: '',
                              aviso_permanencia :''
                         }
                         vm.push(newMontosInputs)  
                    }
                  
               },
               removeRow(index){
                    
                    const indice =   this.montosInputs. indexOf(this.montosInputs[index]);
                    this.montosInputs .splice(indice, 1)
               },



               eliminarTodosDocs(){
                    
                    axios.post(this.$apiUrl + `/clients-services-trash-images/` + this.unicoItem.id, this.unicoItem).then(response => {
                         if (response.status == 200) {
                              this.unicoItem  = response.data.service
                              this.docs = []
                              let splitArray = []
                              let splitPiso = []
                              let images = JSON.parse(this.unicoItem.documento)

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
                                   this.docs.push(docPush)
                              }  
                              // this.$delete(this.clientsServices, objDelete)
                              // this.closeDelete()
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
               eliminarAdjunto(documento, item){
                   
                    this.$Progress.start()
                    this.infoLoader = 'Eliminando...'
                    let objDelete = new FormData()
                    objDelete.append('idServicio', item.id)
                    objDelete.append('imagen', documento.imagen)

                    axios.post(this.$apiUrl + `/clients-services-trash-imagen/` + item.id, objDelete).then(response => {
                         if (response.status == 200) {
                              this.unicoItem  = response.data.service
                              this.docs = []
                              let splitArray = []
                              let splitPiso = []
                              let images = JSON.parse(this.unicoItem.documento)

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
                                   this.docs.push(docPush)
                              }  
                              // this.$delete(this.clientsServices, objDelete)
                              // this.closeDelete()
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

               beforeSave(){
                    this.$Progress.start()
                    this.snackbarInfoCrud = false
                    this.infoCrud = ''
                    this.infoLoader = 'Guardando...'
               },
               successDataSave(){
                    this.infoCrud = 'Guardado Exitosamente'
                    this.snackbarInfoCrud = true
                    this.getClientServices()
                    // this.clientsServices.unshift(response.data.service)
                    this.close()
                    this.$Progress.finish()
               },
               modalDocs(item){
                    this.unicoItem = {}
                    this.docs= []
                    if (this.editMode == true) {
                        this.unicoItem = item
                    
                         let splitArray = []
                         let splitPiso = []
                         let images = JSON.parse(this.unicoItem.documento)

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
                              this.docs.push(docPush)
                         }  
                    }else{
                         this.unicoItem = item
                    
                         let splitArray = []
                         let splitPiso = []
                         let images = JSON.parse(this.unicoItem.documento)

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
                              this.docs.push(docPush)
                         }

                        

                         this.dialogModalDoc = true 
                    }
                    
               },
               callDown(doc){
                        
                         let path  = this.pathDoc + doc 

                         this.downloadFiles(path, doc)
               },
               downAll(){
                    for (var i = 0; i < this.docs.length; i++) {

                         this.downloadFiles(this.pathDoc + this.docs[i][0].imagen, this.docs[i][0].imagen)
                    }
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
                    this.infoLoader = 'Cargando...'
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
                    this.loading = true
                    this.snackbarInfoCrud = false
                    this.infoCrud = ''
                    this.$Progress.start()
                    axios.get(this.$apiUrl + `/clients-services?page` + this.pagination.current_page).then(response => {
                         if (response.status == 200) {
                            
                            this.clientsServices = response.data.clientsServices.data
                            this.clientsServices.forEach(element => {
                                   element.gasto = 0;
                                   element.comision = 0;
                                   element.beneficio = 0;
                                   element.monto.forEach(elementMonto => {
                                        element.gasto = element.gasto + Number(elementMonto.gasto);
                                        element.comision = element.comision + Number(elementMonto.comision);
                                        element.beneficio = element.beneficio + Number(elementMonto.beneficio);
                                   });  


                            });
                            this.clients =  response.data.clients
                            this.services =  response.data.services
                            

                              let objMail = []

                              for (var i = 0; i < this.clientsServices.length; i++) {
                                   this.clientsServices[i]['crud'] = false
                                   this.clientsServices[i]['montosModal'] = 'Montos'
                                   this.clientsServices[i]['mod'] = false
                                   var hoy = moment(new Date().toISOString().substr(0, 10))
                                   var  avisoPermam = moment(this.clientsServices[i].aviso_permanencia)

                                   let res = avisoPermam.diff(hoy, 'days')
                                   this.clientsServices[i]['aviso'] = 30
                                   this.clientsServices[i]['rojo'] = false

                                   if (this.clientsServices[i]['aviso'] == 30) {
                                        this.clientsServices[i]['rojo'] = true
                                   }

                                  
                                   for (var m = 0; m < this.clientsServices[i].monto.length; m++) {
                                       let fechaInicio = moment(this.clientsServices[i].monto[m].fecha)
                                       let fechaFin = moment(this.clientsServices[i].monto[m].aviso_permanencia)

                                       
                                        var resU = fechaFin.diff(fechaInicio, 'days')
                                        this.clientsServices[i].monto[m]['dias'] = resU

                                        if (this.clientsServices[i].monto[m]['dias'] <= 30) {
                                             
                                             objMail.push(this.clientsServices[i])
                                             
                                        }
                                   }
                                       
                                  
                                       
                            } 
                             

                         //crear cron para enviar correos 
                         this.axiosNotificarCaducidad(objMail)



                            this.$Progress.finish()

                            this.loading = false
                            
                         }
                         
                  
                    }, err => {
                        this.$Progress.fail()
                    })
               },
              
               editObj (item) {
                    //aqui calculo de fechas

                    this.calcularFechasDeCaducidad(item)

                    this.montosInputs = item.monto
                    this.auxAxios()
                    this.editMode = true
                    this.editIndexObj = this.clientsServices.indexOf(item)
                    this.editarObj = Object.assign({}, item)


                    this.modalDocs(item)
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
                    this.files = []
                    this.closeDialog()
                    this.$nextTick(() => {
                         this.editarObj = Object.assign({}, this.objDefault)
                         this.editIndexObj = -1
                    })
                    this.editMode = false
                    this.unicoItem = {}
                    this.limpiar()

                    this.montosInputs = []
                    let vm = this.montosInputs

                    let newMontosInputs = {
                         id: 0,
                         menu: '',
                         gasto: '',
                         comision: '',
                         beneficio: '',
                         aviso_permanencia :''
                    }
                    vm.push(newMontosInputs)

               },
               closeDelete () {
                    this.dialogDelete = false
                    this.$nextTick(() => {
                         this.editarObj = Object.assign({}, this.objDefault)
                         this.editIndexObj = -1
                    })
                     this.editMode = false
               },

               limpiar(){
             
                    // const input = this.$refs.file
                    // input.type = 'text'
                    // input.type = 'file'

                    var input = document.getElementById("inputFile")
                    input.children[0].type = 'text'
                    input.children[0].type = "file"
                    this.files = []
               },
              
          },
     };
</script>

<style type="text/css">
     
          @media (max-width:430px ) {
               .itemsDown{
                    display: none!important;
               }
          }
          .permanencia{
               background: #F44336;
               
          }
          .permanencia div input::text{
               color: white;
          }
          .permanencia:hover{
               background: #F44336!important;
          }
         
</style>