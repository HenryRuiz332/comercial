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
                    @click="saveObject">
                         Guardar
               </v-btn>
               <v-btn
                    v-else
                    dark
                    text
                    @click="updateObject">
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
                              <v-select label="Seleccione un tipo de producto" v-model="editarObj.tipo_producto_id" :items="productsTypes" item-value="id" item-text="nombre">
                                   
                              </v-select>
                         </v-col>
                         <v-col
                              cols="12"
                              sm="12"
                              md="12"
                              lg="12"
                              xl="12">
                                   <v-text-field
                                        v-model="editarObj.nombre"
                                        label="Nombre del Producto">
                                          
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
                         @click="saveObject">
                              Guardar
                    </v-btn>
                    <v-btn
                         v-else
                         x-smal
                         color="#9E7AF3"
                         text
                         @click="updateObject">
                              Actualizar
                    </v-btn>
          </v-card-actions>
     </v-card>
</template>

<script type="text/javascript">
     export default {
          props: {
               updateObject : Function,
               saveObject : Function,
               close: Function,
               closeDialog: Function,
               editarObj: Object,
               editIndexObj: Number,
               formTitle: String,
               editMode : Boolean,
               productsTypes: Array
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