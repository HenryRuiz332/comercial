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
                              md="4"
                              lg="4"
                              xl="4">
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
                              md="4"
                              lg="4"
                              xl="4">
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
                              md="4"
                              lg="4"
                              xl="4">
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
                              md="6"
                              lg="6"
                              xl="6">
                                   <file-input  
                                       :files="files" 
                                       v-on:file-change="setFiles" 
                                       file-clear="clearFiles"
                                       id="inputFile">
                                       
                                   </file-input>
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
               snackbarInfoCrud: Boolean,
               infoCrud: String,
               infoLoader: String,
               getClientServices : Function,

          },
          data: () => ({
               errorDecimalGasto: '',
               errorDecimalComision:'',
               errorDecimalBeneficio:'',
               files: [],
               imagePreview: []
               
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
               saveObjServiceC () {
                    this.$Progress.start()
                    this.snackbarInfoCrud = false
                    this.infoCrud = ''
                    this.infoLoader = 'Guardando...'


                    axios.post(this.$apiUrl + `/clients-services`, this.editarObj).then(response => {
                         if (response.status == 200) {
                              console.log(response.data.service.id)
                              this.postDoc(response.data.service.id)
                              this.infoCrud = 'Guardado Exitosamente'
                              this.snackbarInfoCrud = true
                              this.getClientServices()
                              // this.clientsServices.unshift(response.data.service)
                              this.close()
                              this.$Progress.finish()
                         }
                    }, err => {
                         this.infoCrud = 'Ocurrió un error al guardar los datos'
                         this.snackbarInfoCrud = true
                         this.$Progress.fail()
                    })

                   
               },
               postDoc(id){

                    let formDataSave = new FormData()
                    for (let fileSave of this.files) {
                         formDataSave.append('imagen[]', fileSave, fileSave.name)

                    }
                    formDataSave.append('id', id)
                   
                    axios.post(this.$apiUrl + `/clients-services-doc/` + id, formDataSave).then(response => {
                         if (response.status == 200) {
                              
                         }
                    }, err => {
                        
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