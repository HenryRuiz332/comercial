<template>
    <div id="sidebar-scrollbar" v-if="$route.path !== '/login'">
        <nav class="iq-sidebar-menu">
          <ul id="iq-sidebar-toggle" class="iq-menu">
            <li class="iq-menu-title">
                <i class="ri-subtract-line"></i><span>Menú</span>
            </li>
            <li>
                <router-link 
                    to="/dashboard" 
                    class="iq-waves-effect">
                        <i class="ri-home-4-line"></i>
                        <span>Dashboard</span>
                </router-link>
            </li>
            <li>
                <router-link 
                    to="/mensajes" 
                    class="iq-waves-effect">
                        <i class="fa fa-envelope"></i>
                        <span>Mensajes</span>
                </router-link>
            </li>
             
            <li class="iq-menu-title">
                <i class="ri-subtract-line"></i><span>App</span>
            </li>


            <li>
                <a 
                    href="#productos" 
                    class="iq-waves-effect collapsed"  
                    data-toggle="collapse" 
                    aria-expanded="false">
                    <i class="fa fa-cubes"></i>
                        <span>Productos</span>
                        <i class="ri-arrow-right-s-line iq-arrow-right"></i>
                </a>
                <ul id="productos" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                   <li>
                        <router-link to="/productos"><i class="fa fa-list"></i>Lista de Productos</router-link>
                    </li>
                    <li>
                        <router-link to="/tipos-productos"><i class="fa fa-list"></i>Tipos de Productos</router-link>
                    </li>
                    <!-- <li>
                        <router-link to="/lista-clientes"><i class="ri-edit-line"></i>Tipos de Servicios</router-link></li> -->
                </ul>
            </li>

            <li>
                <a 
                    href="#servicios" 
                    class="iq-waves-effect collapsed"  
                    data-toggle="collapse" 
                    aria-expanded="false">
                    <i class="fa fa-file"></i>
                    <span>Servicios</span>
                    <i class="ri-arrow-right-s-line iq-arrow-right"></i>
                </a>
                <ul id="servicios" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                    <li>
                        <router-link to="/servicios-contratados"><i class="fa fa-list"></i>Servcios Contratados</router-link>
                    </li>
                    <li>
                        <router-link to="/servicios"><i class="ri-edit-line"></i>Tipos de Servicios</router-link>
                    </li>
                </ul>
             </li>


            <li>
                <a 
                    href="#clientes" 
                    class="iq-waves-effect collapsed"  
                    data-toggle="collapse" 
                    aria-expanded="false">
                    <i class="fa fa-users"></i>
                        <span>Clientes</span>
                        <i class="ri-arrow-right-s-line iq-arrow-right"></i>
                </a>
                <ul id="clientes" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                   <li>
                        <router-link to="/clientes"><i class="fa fa-list"></i>Lista de Clientes</router-link></li>
                    <!-- <li>
                        <router-link to="/lista-clientes"><i class="ri-edit-line"></i>Tipos de Servicios</router-link></li> -->
                </ul>
            </li>


            <li>
                <a 
                    href="#colaboradores" 
                    class="iq-waves-effect collapsed"  
                    data-toggle="collapse" 
                    aria-expanded="false">
                    <i class="fa fa-user"></i>
                        <span>Colaboradores</span>
                        <i class="ri-arrow-right-s-line iq-arrow-right"></i>
                </a>
                <ul id="colaboradores" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                   <li>
                        <router-link to="/colaboradores">
                            <i class="fa fa-list"></i>Lista de Colaboradores</router-link>
                        </li>
                    <!-- <li>
                        <router-link to="/lista-clientes"><i class="ri-edit-line"></i>Tipos de Servicios</router-link></li> -->
                </ul>
            </li>


            <li>
                <a 
                    href="#gastos_generales" 
                    class="iq-waves-effect collapsed"  
                    data-toggle="collapse" 
                    aria-expanded="false">
                    <i class="fa fa-chevron-down"></i>
                        <span>Gastos </span>
                        <i class="ri-arrow-right-s-line iq-arrow-right"></i>
                </a>
                <ul id="gastos_generales" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                   <li>
                        <router-link to="/gastos-generales">
                            <i class="fa fa-arrow-down"></i>Gastos Generales</router-link>
                        </li>
                  
                </ul>
            </li>


            
            




            <!--  <li>
                <a href="#userinfo" class="iq-waves-effect collapsed" data-toggle="collapse" aria-expanded="false"><i class="ri-user-line"></i><span>User</span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                <ul id="userinfo" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                   <li><a href="profile.html"><i class="ri-profile-line"></i>User Profile</a></li>
                   <li><a href="profile-edit.html"><i class="ri-file-edit-line"></i>User Edit</a></li>
                   <li><a href="add-user.html"><i class="ri-user-add-line"></i>User Add</a></li>
                   <li><a href="user-list.html"><i class="ri-file-list-line"></i>User List</a></li>
                </ul>
             </li> -->
          </ul>
        </nav>
        <div class="p-3"></div>
    </div>

</template>

<script>
  
    export default {
        methods: {
            
        },
        data() {
            return {
               
            }
        },
        watch: {
           
            computed: {
                
                
            }
        }
    };
</script>