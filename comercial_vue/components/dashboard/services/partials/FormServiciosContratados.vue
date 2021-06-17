<template>
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
                    @click="saveObjServiceC">
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
                              md="3"
                              lg="3"
                              xl="3">
                                   <v-select
                                        :items="clients"
                                        v-model="editarObj.user_id"
                                        label="Cliente"
                                        item-text="nombre"
                                        item-value="id"
                                        :error-messages="errors.errors.user_id ? errors.errors.user_id[0] : null" >
                                          
                                   </v-select>
                         </v-col>
                         <v-col
                              cols="12"
                              sm="6"
                              md="3"
                              lg="3"
                              xl="3">
                              <v-select
                                   :items="services"
                                   v-model="editarObj.servicio_id"
                                   label="Servicio"
                                   item-text="nombre"
                                   item-value="id"
                                   :error-messages="errors.errors.servicio_id ? errors.errors.servicio_id[0] : null">
                                          
                              </v-select>
                         </v-col>
                         <v-col
                              cols="12"
                              sm="6"
                              md="3"
                              lg="3"
                              xl="3">
                                   <v-select
                                        :items="products"
                                        v-model="editarObj.producto_id"
                                        label="Producto"
                                        item-text="nombre"
                                        item-value="id"
                                        :error-messages="errors.errors.producto_id ? errors.errors.producto_id[0] : null">
                                               
                                   </v-select>
                         </v-col>
                         <v-col
                              cols="12"
                              sm="6"
                              md="3"
                              lg="3"
                              xl="3">
                             <v-select
                                   :items="collaborators"
                                   v-model="editarObj.colaborador_id"
                                   label="Colaborador"
                                   item-text="nombre"
                                   item-value="id"
                                   :error-messages="errors.errors.colaborador_id ? errors.errors.colaborador_id[0] : null">      
                              </v-select>
                         </v-col>
                         <v-col
                              cols="12"
                              sm="6"
                              md="3"
                              lg="3"
                              xl="3">
                                   <v-text-field
                                        @change="validarGasto"
                                        v-model="editarObj.gasto"
                                        suffix="€"
                                        label="Gasto">
                                        <small style="color:red" v-if="errorDecimalGasto != ''">{{errorDecimalGasto}}</small>
                                   </v-text-field>
                         </v-col>
                          <v-col
                              cols="12"
                              sm="6"
                              md="3"
                              lg="3"
                              xl="3">
                                   <v-text-field
                                        @change="validarComision"
                                        v-model="editarObj.comision"
                                        suffix="€"
                                        label="Comisión">
                                       
                                   </v-text-field>
                                   <small style="color:red" v-if="errorDecimalComision != ''">{{errorDecimalComision}}</small>
                         </v-col>
                         <v-col
                              cols="12"
                              sm="6"
                              md="3"
                              lg="3"
                              xl="3">
                                   <v-text-field
                                         @change="validarbeneficio"
                                        v-model="editarObj.beneficio"
                                        suffix="€"
                                        label="Beneficio">
                                       
                                   </v-text-field>
                                    <small style="color:red" v-if="errorDecimalBeneficio != ''">{{errorDecimalBeneficio}}</small>
                         </v-col>

                         <v-col
                              cols="12"
                              sm="6"
                              md="3"
                              lg="3"
                              xl="3">
                                    <v-menu ref="menu" v-model="menu" :close-on-content-click="false" :return-value.sync="editarObj.aviso_permanencia" transition="scale-transition" offset-y min-width="290px">

                                       <template v-slot:activator="{ on, attrs }">
                                           <v-text-field filled :error-messages="errors.errors.aviso_permanencia ? errors.errors.aviso_permanencia[0] : null" v-model="editarObj.aviso_permanencia" label="Aviso permamnencia" append-icon="mdi-calendar" readonly v-bind="attrs" v-on="on">
                                           </v-text-field>
                                       </template>

                                       <v-date-picker v-model="editarObj.aviso_permanencia" no-title scrollable>
                                           <v-spacer></v-spacer>

                                           <v-btn text color="primary" @click="menu = false">
                                               Cancel
                                           </v-btn>

                                           <v-btn text color="primary" @click="$refs.menu.save(editarObj.aviso_permanencia)">
                                               OK
                                           </v-btn>
                                       </v-date-picker>

                                   </v-menu>
                         </v-col>

                          <v-col
                              cols="12"
                              sm="12"
                              md="6"
                              lg="6"
                              xl="6">
                                   <v-textarea
                                        v-model="editarObj.nota_gasto"
                                        label="Notas de Gasto">
                                       
                                   </v-textarea>
                         </v-col>
                         <v-col
                              cols="12"
                              sm="12"
                              md="6"
                              lg="6"
                              xl="6">
                                   <v-textarea
                                        v-model="editarObj.notas"
                                        label="Notas">
                                       
                                   </v-textarea>
                         </v-col>

                         <v-col
                              cols="12"
                              sm="12"
                              md="12"
                              lg="12"
                              xl="12">
                                   <file-input  
                                       :files="files" 
                                       v-on:file-change="setFiles" 
                                       file-clear="clearFiles"
                                       id="inputFile">
                                       
                                   </file-input>

                                   <span>
                                        <v-btn v-if="files.length > 0 && editMode == true"  @click="actualizarArchivo">
                                             <v-icon>
                                                  mdi-upload
                                             </v-icon>
                                             Cargar Archivo(s)
                                        </v-btn>
                                   </span>
                         </v-col>

                         
                             
                        <v-col v-if="editMode" class="text-center" cols="12" xs="12" sm="12" md="4" lg="4" xl="4" v-for="doc,i in docs" :key="i">
                                        
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
                                                       doc[0].formato == 'WEBP'" 

                                            

                                             >
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
                                        <p class="mt-3">
                                             <v-btn title="Descargar"  @click="callDown(doc[0].imagen)" color="orange" x-small>
                                                  <i class="fa fa-download  "></i> 
                                             </v-btn>
                                             <v-btn title="Eliminar" @click="eliminarAdjunto(doc[0], unicoItem)" color="red" x-small>
                                                  <i class="fa fa-close "></i>
                                             </v-btn>
                                        </p>
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
                         @click="saveObjServiceC">
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
</template>

<script type="text/javascript">
     import FileInput from '../../../../global_components/FileInput.vue'

     export default {
          components: {
               'file-input' : FileInput
          },
          props: {
               updateObjUser : Function,
               editObj:Function,
               close: Function,
               closeDialog: Function,
               editarObj: Object,
               editIndexObj: Number,
               formTitle: String,
               editMode : Boolean,
               services: Array,
               clients: Array,
               products: Array,
               collaborators: Array,
               successDataSave : Function,
               beforeSave : Function,
               docs: Array,
               getClientServices: Function,
               callDown: Function,
               eliminarAdjunto: Function,
               unicoItem: Object,


          },
          data: () => ({
               errorDecimalGasto: '',
               errorDecimalComision:'',
               errorDecimalBeneficio:'',
               files: [],
               imagePreview: [],
               menu : false
               
          }),

          computed: {
               errors() {
                    return this.$store.getters.geterrors
               }
          },

          watch: {
             
          },

          created () {
              
          },

          methods: {
               eliminarAdjuntoDesdeForm(documento, item){
                                     
                    this.eliminarAdjunto(documento, item)
               },
               actualizarArchivo(){
                   
                    let formDataSave = new FormData()
                    for (let fileSave of this.files) {
                         formDataSave.append('imagen[]', fileSave, fileSave.name)

                    }
                    formDataSave.append('id', this.editarObj.id)
                    formDataSave.append('update', 'si')
                   
                    axios.post(this.$apiUrl + `/clients-services-doc/` + this.editarObj.id, formDataSave).then(response => {
                         if (response.status == 200) {
                              this.getClientServices()
                              this.successDataSave()
                              this.limpiar()

                         }
                    }, err => {
                        alert('Ocurrio un error')
                    }) 

                   
               },
               saveObjServiceC () {
                    this.beforeSave()

                    let formDataSave = new FormData()
                    for (let fileSave of this.files) {
                         formDataSave.append('imagen[]', fileSave, fileSave.name)

                    }

                    formDataSave.append('update', 'no')
                    formDataSave.append('editarObj', JSON.stringify(this.editarObj))

                    axios.post(this.$apiUrl + `/clients-services`, formDataSave).then(response => {
                         if (response.status == 200) {
                              this.successDataSave()
                              this.limpiar()
                         }
                    }, err => {
                         this.infoCrud = 'Ocurrió un error al guardar los datos'
                         this.snackbarInfoCrud = true
                         this.$Progress.fail()
                    })

                   
               },
              
               setFiles(files) {
                
                    const filesPreview = files

                    Object.keys(filesPreview).forEach(i => {
                         const file = filesPreview[i];
                         const reader = new FileReader();
                         reader.onload = (e) => {
                             this.imagePreview.push(reader.result);
                         }
                         this.imagePreview = []
                         reader.readAsDataURL(file);

                    });
                  

                    if (files !== undefined) {
                         this.files = files
                         this.disableUploadButtonImage = false
                    }
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