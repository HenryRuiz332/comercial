<template>
     <div>
          <loader v-if="isloading" :infoLoader="infoLoader"></loader>
          <v-row style="background:white!important">
               <v-col cols="12" xs="12" sm="12" md="12" lg="12" xl="12">
                    <h4>
                        Mensajes
                    </h4>
                    <p>Envío de mensajes a clientes </p>
                    <ckeditor 
                    style="height:50vh!important"
                    ref="miEditor" :config="editorConfig"  v-model="form.sms" :editor="editor" height="50%"  :counter="1000"></ckeditor>
                    
                    <v-progress-circular
                         v-if="send"
                         indeterminate
                         color="purple"></v-progress-circular>
                    <p style="color:orange" v-if="mensaje!=null">
                         <strong>{{mensaje}}</strong>
                    </p>
                    <div id="demo" >
                         
                    </div>
                    

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
                    sms : 'Hola, recibes este mensaje de acumbamail'
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
                  users: [],

                  sending : false,
                  mensaje: null
          }),
          computed:{
               isloading: function() {
                    return this.$store.getters.getloading
               },
               send(){
                  return this.sending  
               }
          },
          created(){
               if (this.timeout == 10000) {

                    this.closeSnackbar()
               }
               this.getUsers()
          },
          methods:{
                getUsers(){
                    this.snackbarInfoCrud = false
                    this.infoCrud = 'Actualizando'
                    this.$Progress.start()
                    axios.get(this.$apiUrl + `/users`).then(response => {
                         if (response.status == 200) {
                              this.users = response.data.users.data
                              this.$Progress.finish()
                         }
                         
                  
                    }, err => {
                        this.$Progress.fail()
                    })
               },
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
                    this.send = true
                    this.$Progress.start()
                    this.snackbarInfoCrud = false
                    this.infoCrud = ''
                    this.infoLoader = 'Enviando...'

                    const  messages = []

                    let json = {
                         "mandatory" : "4142823998",
                         "recipient" : "",//Teléfono
                         "body" : "", //Mensaje
                         "sender" : "", //Empresa 
                    }

                    for (var i = 0; i < this.users.length; i++) {
                         const tel =  this.users[i].telefono
                         json = {
                              "mandatory" : "4142823998",
                              "recipient" : '+34' + tel,
                              "body" : this.form.sms, 
                              "sender" : "Comercial"
                         }
                         messages.push(json)
                        
                    }
                    json = JSON.stringify(messages)
                    let  apiUrl = 'https://acumbamail.com/api/1/sendSMS/'
                    let formData = new FormData();
                    formData.append('auth_token', 'HYn29fZIQ8kVGmZtzqbW')
                    formData.append('messages', json)
                    

                    let control = true
                    var xhttp = new XMLHttpRequest();
                    xhttp.onreadystatechange = function() {
                       if (this.readyState == 4 && this.status == 200 ) {
                              this.send = false
                              document.getElementById("demo").innerHTML = '<p style="color:green">Se han enviado los Mensajes</p>'
                              console.log(this.responseText)
                      }
                      if (this.readyState == 4 && this.status == 201 ) {
                              control = false
                              this.send = false
                              document.getElementById("demo").innerHTML = '<p style="color:green">Se han enviado los Mensajes</p>'

                              console.log(this.responseText)
                      }
                    };

                   xhttp.open("POST", apiUrl);
                   xhttp.send(formData);
                   this.cancelarEnvio()
                    if (control == false) {
                         this.sending = false
                    }
                    //04123639852 HYn29fZIQ8kVGmZtzqbW
                    //+51962154918  
                    
                    
              }  
          }
     };
</script>
<style type="text/css">
     .ck-content{
          height: 100px!important;
     }
</style>