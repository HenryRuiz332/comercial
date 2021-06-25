<template>
     <div>
          <v-row style="background:white!important">
               <v-col cols="12" xs="12" sm="12" md="12" lg="12" xl="12">
                    <h4>
                         Enviar Mensajes
                    </h4>
                    <p>Envío de mensajes a clientes </p>
                    <ckeditor 
                    style="height:50vh!important"
                    ref="miEditor" :config="editorConfig"  v-model="form.sms" :editor="editor" height="50%"  :counter="1000"></ckeditor>
          
                    

               </v-col>
               <v-col cols="12" xs="12" sm="12" md="12" lg="12" xl="12">
                    <v-btn @click="dialogSendMeesge" color="success" small>Enviar mensaje a clientes</v-btn>
               </v-col>
          </v-row>
           <info-crud :snackbar="snackbarInfoCrud" :info="infoCrud" :closeSnackbar="closeSnackbar"></info-crud>
          <send-message 
               :enviarMensajes="enviarMensajes"
              
               :dialogSend="dialogSend" 
               :cancelarEnvio="cancelarEnvio"></send-message>
     </div>
</template>
<script>
    

     import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
     import DialogSendMessage from './DialogSendMessage'
   
     import Info from "../../crud/Info.vue"
     export default {
          components :{
               'send-message' : DialogSendMessage,
               'info-crud' : Info
          },
          props:{
             

          },
          data: () => ({
               nameComponent : 'Mensaje',
               snackbarInfoCrud: false,
               infoCrud: '',
               infoLoader: 'Cargando...',
               dialogSend : false,
               form : {
                    sms : ''
               },
               editor: ClassicEditor,
               editorData: '<p>Escriba la decripción del producto.</p>',
                  editorConfig: {
                      toolbar: {
                              items: [
                                  'heading',
                                  '|',
                                  'bold',
                                  'italic',
                                  '|',
                                  'bulletedList',
                                  'numberedList',
                                  '|',

                                  // 'imageUpload',
                                  // '|',
                                  'undo',
                                  'redo',


                              ],

                          },
                          extraPlugins: null,
                  },
          }),
          created(){
               if (this.timeout == 10000) {

                    this.closeSnackbar()
               }
          },
          methods:{
               dialogSendMeesge(){
                    this.dialogSend = true
               },
               cancelarEnvio(){
                    this.dialogSend = false
               },
                closeSnackbar(){
                    this.snackbarInfoCrud = false
               },
               enviarMensajes(){

                    this.$Progress.start()
                    this.snackbarInfoCrud = false
                    this.infoCrud = ''
                    this.infoLoader = 'Guardando...'
                    // axios.post(this.$apiUrl + `/send-messages`, this.form).then(response => {
                    //      if (response.status == 200) {
                    //           this.infoCrud = 'Guardado Exitosamente'
                    //           this.snackbarInfoCrud = true
                    //           this.cancelarEnvio()
                    //           this.$Progress.finish()
                    //      }
                    // }, err => {
                    //      this.infoCrud = 'Ocurrió un error al guardar los datos'
                    //      this.snackbarInfoCrud = true
                    //      this.$Progress.fail()
                    // })

                    


                    //  let json = [ { "recipient": "+5841412823998", "body": "message test", "sender": "Tu empresa" }]
                    
                    // this.form = json

                    // axios.post(this.$apiUrl + `/send-messages`, this.form).then(response => {
                    //      if (response.status == 200) {
                    //           this.infoCrud = 'Guardado Exitosamente'
                    //           this.snackbarInfoCrud = true
                    //           this.cancelarEnvio()
                    //           this.$Progress.finish()
                    //      }
                    // }, err => {
                    //      this.infoCrud = 'Ocurrió un error al guardar los datos'
                    //      this.snackbarInfoCrud = true
                    //      this.$Progress.fail()
                    // })


                    let json = [{ "recipient": "+5841412823998", "body": "message test", "sender": "Tu empresa" }]

                    let form  = new FormData()
                    form.append('messages' , json)

                    axios.post('https://acumbamail.com/api/1/sendSMS("HYn29fZIQ8kVGmZtzqbW", '+ form+')').then(response => {
                         console.log(response)
                    }, err => {
                         
                    })
                 
              }  
          }
     };
</script>
<style type="text/css">
     .ck-content{
          height: 100px!important;
     }
</style>