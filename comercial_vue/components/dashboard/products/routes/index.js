import Products from '../Index'
// import ListaClientes from '../partials/ListaClientes'

const routes = [
   ...route('/productos', Products, {
      Auth: true,
      
   }),
  //  ...route(`/lista-clientes`, ListaClientes, {
  //    Auth: true,
    
  // }),
]

function route(path, component = Default, meta = {}) {
	return [{
		path,
		component,
		meta
	}]
}

export default routes
