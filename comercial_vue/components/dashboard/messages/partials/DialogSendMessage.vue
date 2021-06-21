<template>
  <v-row justify="center">
    <v-dialog
      v-model="dialogSend"
      persistent
      max-width="290">
     
      <v-card>
          <v-card-title class="text-h6">
               ¿Está seguro que desea enviar los mensajes?
          </v-card-title>
        
          <v-card-actions>
               <v-spacer></v-spacer>
               <v-btn
                 color="green "
                 x-small
                 class="text-white"
                 @click="enviarMensajes()">
               Enviar
          </v-btn> 
          <v-btn
            color="error"
            x-small
            @click="cancelarEnvio()">
            Cancelar
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-row>
</template>
<script>
     export default {
          props:{
            
            dialogSend: Boolean,
            cancelarEnvio: Function,
            enviarMensajes: Function,
           
          },
          data: () => ({
               
              
          }),
          created(){
              
          },
          methods:{
              
          }
     };
</script>