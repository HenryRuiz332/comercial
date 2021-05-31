<template>
	<v-dialog v-model="dialogDelete" max-width="400px">
           <v-card class="stylesDelete">
           	<h3 class="aviso">Aviso</h3>
                <h5><v-icon color="error">!</v-icon>¿Seguro que deseas eliminar el elemento?</h5>
                <v-card-actions class="pt-3">
                     <v-spacer></v-spacer>
                     <v-btn color="error" x-small @click="closeDelete">Cancelar</v-btn>
                     <v-btn color="success" x-small @click="deleteItemConfirm">Confirmar</v-btn>
                     <v-spacer></v-spacer>
                </v-card-actions>
           </v-card>
      </v-dialog>
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