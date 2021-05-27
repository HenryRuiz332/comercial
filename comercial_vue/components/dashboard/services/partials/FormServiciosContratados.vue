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
                              md="3"
                              lg="3"
                              xl="3">
                                   <v-select
                                        :items="clients"
                                        v-model="editarObj.user_id"
                                        label="Cliente"
                                        item-text="nombre"
                                        item-value="id">
                                          
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
                                   item-value="id">
                                          
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
                                        item-value="id">
                                               
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
                                   item-value="id">      
                              </v-select>
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
                                        v-model="editarObj.comision"
                                        label="Comisión">
                                       
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
               services: Array,
               clients: Array,
               products: Array,
               collaborators: Array,
          },
          data: () => ({
              
          }),

          computed: {
               
          },

          watch: {
             
          },

          created () {
              
          },

          methods: {
              

              
          },
     };
</script>