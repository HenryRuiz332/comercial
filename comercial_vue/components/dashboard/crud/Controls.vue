<template>
    <div>
        <div class="controls">
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

        <v-btn 
                class="btnFloat"
                color="success"
                small
                dark
                absolute
                left
                bottom
                fab 
                @click="openDialogControl">
                    <v-icon>mdi-plus</v-icon>
            </v-btn>
        <v-btn 
                class="btnFloat btnFloat-refresh"
                
                color="#9e7af3"
                small
                dark
                absolute
                left
                bottom
                fab 
                @click="getFuntion">
                    <v-icon>mdi-refresh</v-icon>
            </v-btn>
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
                         class: 'btn btn-outline-success mb-3 mr-3 ',
                         method: this.openDialogControl,
                         iconClass : 'fa fa-plus pr-0',
                         infoTooltip : 'Nuevo ' + this.nameComponent,
                         colorInFloat: 'success',
                         iconFloat : 'mdi-plus'

                    },
                    {
                         id:2,
                         class: 'btn btn-outline-primary mb-3 mr-3 ',
                         method: this.getFuntion,
                         iconClass : 'fa fa-refresh',
                         infoTooltip : 'Actualizar',
                         colorInFloat: 'success',
                         iconFloat : 'mdi-plus'
                    }
               ]
        },

        methods: {
              

              
        },
     };
</script>

<style type="text/css">
    
    @media (max-width: 700px) { 
        .controls{
            display: none!important;
        }

        .btnFloat{
            left: -5vw!important;
            z-index: 200!important;
        }

        .btnFloat-refresh{
            top: 25vw;
        }
    }


    @media (min-width: 700px) { 
        .btnFloat{
            display: none!important;
        }
    }
</style>