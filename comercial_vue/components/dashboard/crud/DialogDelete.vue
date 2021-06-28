<template>
	<v-row justify="center">
	<v-dialog v-model="dialogDelete" max-width="290">
           <v-card >

           	 <v-card-title class="text-h6 aviso">
	          Aviso
	        </v-card-title>

	        <v-card-text>
           	
                <h5><v-icon color="error">!</v-icon>¿Seguro que deseas eliminar el elemento?</h5>
                
           </v-card-text>
           <v-card-actions class="pt-3">
                     <v-spacer></v-spacer>
                     <v-btn color="error" x-small @click="closeDelete">Cancelar</v-btn>
                     <v-btn color="success" x-small @click="deleteItemConfirm">Confirmar</v-btn>
                     <v-spacer></v-spacer>
                </v-card-actions>
           </v-card>
      </v-dialog>
 </v-row>
</template>

<script type="text/javascript">
	
	export default{
		props: {
			dialogDelete: Boolean,
			closeDelete: Function,
			deleteItemConfirm: Function
		}
	};
</script>
<style type="text/css">
	.stylesDelete{
		height: 10vw;
    	text-align: center;
	}
	.aviso{
		background: #a27af3;
		padding: 5px;
		color:white!important;
	}
	
</style>