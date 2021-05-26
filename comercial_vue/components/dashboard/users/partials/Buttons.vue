<template>
     <div>
          
          <button 
               class="btn btn-outline-success mb-3 mr-3"
               v-bind="attrs"
               v-on="on">
               <i class="fa fa-plus pr-0"></i>
          </button>
          <button 
               
               class="btn btn-outline-danger mb-3 mr-3"
               v-bind="attrs"
               v-on="on">
               <i class="ri-delete-bin-2-fill pr-0"></i>
          </button>
          <button 
               color="primary"
               class="btn btn-outline-primary mb-3 mr-3"
               @click="getUsers()">
               <i class="fa fa-async pr-0"></i>
          </button>
          
     </div>
</template>
<script type="text/javascript">
    export default {
          props:{
               attrs : Function,
          },
     };
</script