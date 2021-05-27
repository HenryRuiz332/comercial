import Colaboradores from '../Index'
// import ListaClientes from '../partials/ListaClientes'

const routes = [
   ...route('/colaboradores', Colaboradores, {
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
