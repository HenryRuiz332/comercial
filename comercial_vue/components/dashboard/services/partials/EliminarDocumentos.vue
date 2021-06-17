<template>
     <div >
   
         
     </div>
</template>
<script>
     export default {
          props:{
             

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