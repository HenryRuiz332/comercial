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
                                        label="Nombre Completo"
                                        :rules="nameRules"
                                        :error-messages="errors.errors.nombre ? errors.errors.nombre[0] : null">
                                          
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
                                   label="Teléfono"
                                   :error-messages="errors.errors.telefono ? errors.errors.telefono[0] : null"
                                   :rules="[rules.number]" 
                                   :counter="9" 
                                   maxlength="9">
                                  
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
                                        label="CIF" :counter="15"  maxlength="15"
                                        :error-messages="errors.errors.cif ? errors.errors.cif[0] : null">
                                          
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
                                   label="Email"
                                   :rules="emailRules" :counter="80"
                                   :error-messages="errors.errors.email ? errors.errors.email[0] : null">
                                     
                              </v-text-field>
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
                                        label="Gasto" :counter="10"
                                        suffix="€"
                                        :error-messages="errors.errors.gasto ? errors.errors.gasto[0] : null">
                                       
                                   </v-text-field>
                                    <small style="color:red" v-if="errorDecimalGasto != ''">{{errorDecimalGasto}}</small>
                         </v-col>
                         <v-col
                              cols="12"
                              sm="6"
                              md="4"
                              lg="4"
                              xl="4">
                                   <v-text-field
                                        @change="validarBenficio"
                                        v-model="editarObj.beneficio"
                                        label="Beneficio" :counter="10"
                                        suffix="€"
                                        :error-messages="errors.errors.beneficio ? errors.errors.beneficio[0] : null">
                                       
                                   </v-text-field>
                                   <small style="color:red" v-if="errorDecimalBneficio != ''">{{errorDecimalBneficio}}</small>
                         </v-col>
                          <v-col
                              cols="12"
                              sm="12"
                              md="12"
                              lg="12"
                              xl="12">
                                   <v-textarea
                                        v-model="editarObj.nota_gasto"
                                        :error-messages="errors.errors.nota_gasto ? errors.errors.nota_gasto[0] : null"
                                        label="Nota">
                                       
                                   </v-textarea>
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
</template>

<script type="text/javascript">
     export default {
          props: {
               updateObjUser : Function,
               saveObjUser : Function,
               close: Function,
               closeDialog: Function,
               editarObj: Object,
               editIndexObj: Number,
               formTitle: String,
               editMode : Boolean,
          },
          data: () => ({
               unicoItem: {},
               docs : [],
               
               errorDecimalGasto: '',
               errorDecimalBneficio: '',
               nameRules: [
                  v => !!v || 'El nombre es requerido',
                  v => (v && v.length >= 4) || 'Se requiere más de 3 caracteres',
               ],
               
               rules: {
                    number: value => /^\d+$/.test(value) || 'Este campo solo acepta números',
               },
               emailRules: [
                 
                  v => /.+@.+\..+/.test(v) || 'Ingrese un correo electrónico válido',
                ],
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
              validarGasto(value){
                    var RE = /^\d*\.?\d*$/;
                    if (RE.test(value)) {
                        this.errorDecimalGasto= ''
                    } else {
                              // alert('Inserte un numero entero o decimal')
                         this.errorDecimalGasto =  'Inserte un numero entero o decimal. Decimal separado por punto.'
                         this.editarObj.gasto= []
                    }
                   

              },
              validarBenficio(value){
                var RE = /^\d*\.?\d*$/;
                    if (RE.test(value)) {
                        this.errorDecimalBneficio= ''
                    } else {
                              // alert('Inserte un numero entero o decimal')
                         this.errorDecimalBneficio =  'Inserte un numero entero o decimal. Decimal separado por punto.'
                         this.editarObj.beneficio= []
                    }
              }

              
          },
     };
</script>