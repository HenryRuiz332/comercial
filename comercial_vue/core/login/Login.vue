<template>
    <div>
        <section class="sign-in-page">
            <div class="container bg-white mt-5 p-0">
                <div class="row no-gutters">
                    <div class="col-sm-6 offset-3 align-self-center">
                        <div class="sign-in-from">
                            <h1 class="mb-0">Login</h1>
                           
                            <p>Ingrese su Correo Electrónico y Contraseña para acceder al panel de administración</p>
                            <form class="mt-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Correo Electrónico</label>
                                    <input 
                                        type="email" 
                                        class="form-control mb-0" 
                                        id="exampleInputEmail1" 
                                        placeholder="Ingrese Correo" 
                                        v-model="user.email">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Contraseña</label>
                                    <a href="#" class="float-right">¿Olvidaste la contraseña?</a>
                                    <input 
                                        type="password" 
                                        class="form-control mb-0" 
                                        id="exampleInputPassword1" 
                                        placeholder="Contraseña" 
                                        v-model="user.password">
                                </div>
                                <div class="d-inline-block w-100">
                                    <div class="custom-control custom-checkbox d-inline-block mt-2 pt-1">
                                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                                        <label class="custom-control-label" for="customCheck1">Recordar</label>
                                    </div>
                                    <button type="submit"  @click="Login" class="btn btn-primary float-right">Iniciar Sesión</button>
                                </div>
                                <div class="sign-info">
                                    <span class="dark-color d-inline-block line-height-2">¿No tienes una cuenta? <a href="#">Registrarme</a></span>
                                    <ul class="iq-social-media">
                                        <li><a href="#"><i class="ri-facebook-box-line"></i></a></li>
                                        <li><a href="#"><i class="ri-twitter-line"></i></a></li>
                                        <li><a href="#"><i class="ri-instagram-line"></i></a></li>
                                    </ul>
                                </div>
                            </form>
                        </div>
                    </div>
                   
                </div>
            </div>
        </section>  
    </div>
</template>

<script>
    import auth from '../../auth/auth.js'
    export default {
        data() {
            return {
                user: {
                    email: '',
                    password: ''
                }
            }
        },
        mounted() {
            
            if(localStorage != undefined){
                let valid = localStorage.user_id
                if(valid){
                    window.location.href = '/'
                }
            }
               
            
        },
        methods: {
            Login() {
                auth.signin(this.user)
            }
        },
        computed: {
            isloading: function() {
                return this.$store.getters.getloading
            },
            errors() {
                    return this.$store.getters.geterrors
            }
        }
    };
</script>
