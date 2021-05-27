<template>
     <div class="text-center">
   
          <v-snackbar
               :timeout="timeout"
               v-model="snackbar">
               {{ info }}

               <template v-slot:action="{ attrs }">
                    <v-btn
                         bottom
                         left
                         color="#9B7AF3"
                         text
                         v-bind="attrs"
                         @click="closeSnackbar()">
                              Cerrar
                         </v-btn>
               </template>
          </v-snackbar>
     </div>
</template>
<script>
     export default {
          props:{
               snackbar : Boolean,
               info: String,
               closeSnackbar: Function

          },
          data: () => ({
               timeout: 10000,
          }),
          created(){
               if (this.timeout == 10000) {

                    this.closeSnackbar()
               }
          },
          methods:{

          }
     };
</script>