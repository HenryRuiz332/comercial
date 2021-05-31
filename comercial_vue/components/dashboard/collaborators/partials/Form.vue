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
                    @click="saveObjCollaborator">
                         Guardar
               </v-btn>
               <v-btn
                    v-else
                    dark
                    text
                    @click="updateObjCollaborator">
                         Actualizar
               </v-btn>
               </v-toolbar-items>
          </v-toolbar>

          <v-card-text>
               <v-container>
                    <v-row>
                          <v-col
                              cols="12"
                              sm="12"
                              md="12"
                              lg="12"
                              xl="12">
                                   <v-text-field
                                        v-model="editarObj.nombre"
                                        label="Nombre completo" 
                                        :error-messages="errors.errors.nombre ? errors.errors.nombre[0] : null"
                                        
                                        :counter="100">
                                          
                                   </v-text-field>
                         </v-col>
                         <v-col
                              cols="12"
                              sm="12"
                              md="12"
                              lg="12"
                              xl="12">
                                   <v-text-field
                                        v-model="editarObj.telefono"
                                        :error-messages="errors.errors.telefono ? errors.errors.telefono[0] : null"
                                        label="Teléfono" maxlength="9" :counter="9"  :rules="[rules.number]" >
                                          
                                   </v-text-field>
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
                         @click="saveObjCollaborator">
                              Guardar
                    </v-btn>
                    <v-btn
                         v-else
                         x-smal
                         color="#9E7AF3"
                         text
                         @click="updateObjCollaborator">
                              Actualizar
                    </v-btn>
          </v-card-actions>
     </v-card>
</template>

<script type="text/javascript">
     export default {
          props: {
               updateObjCollaborator : Function,
               saveObjCollaborator : Function,
               close: Function,
               closeDialog: Function,
               editarObj: Object,
               editIndexObj: Number,
               formTitle: String,
               editMode : Boolean,
          },
          data: () => ({
              rules: {
                    number: value => /^\d+$/.test(value) || 'Este campo solo acepta números',
               },
          }),

          computed: {
                computed: {
                    errors() {
                         return this.$store.getters.geterrors
                    }
               },
          },

          watch: {
             
          },

          created () {
              
          },

          methods: {
              

              
          },
     };
</script>