<template>
        <div>

          <v-tooltip top v-for="control, i in controls" :key="i">
               <template v-slot:activator="{ on, attrs }">
                    <button 
                         v-bind="attrs"
                         v-on="on"
                         :class="control.class"
                         @click="control.method">
                         <i :class="control.iconClass"></i>
                    </button>
                   
               </template>
               <span>{{ control.infoTooltip }}</span>
          </v-tooltip>



        	
        </div>
</template>
<script>
    export default {
    	props:{
    		  openDialogControl: Function,
    		  getFuntion: Function,
          nameComponent: String,
    	},
     data: () => ({
          controls:[
              
          ]     
     }),

        computed: {
               
        },

        watch: {
             
        },

        created () {
              this.controls = [
                   {
                         id:1,
                         class: 'btn btn-outline-success mb-3 mr-3',
                         method: this.openDialogControl,
                         iconClass : 'fa fa-plus pr-0',
                         infoTooltip : 'Nuevo ' + this.nameComponent
                    },
                    {
                         id:2,
                         class: 'btn btn-outline-primary mb-3 mr-3',
                         method: this.getFuntion,
                         iconClass : 'fa fa-refresh',
                         infoTooltip : 'Actualizar'
                    }
               ]
        },

        methods: {
              

              
        },
     };
</script>