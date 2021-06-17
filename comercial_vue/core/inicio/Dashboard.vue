<template>
    <v-container>
        <loader v-if="isloading" :infoLoader="infoLoader"></loader>
        <div id="content-page" class="" >
            <div class="">
               <div class="row">
                  <!-- <div class="col-lg-8">
                     <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                        <div class="iq-card-body">
                           <div id="home-chart-06" style="height: 350px;"></div>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-4">
                     <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                        <div class="iq-card-body smaill-calender-home">
                           <input type="text" class="flatpicker d-none">
                        </div>
                     </div>
                  </div> -->
                
                
               <v-col cols="12" sm="12" md="3" lg="3" xl="3" class="text-center"  >
                    <v-card
                      color="deep-purple lighten-2"
                      dark>
                      <v-card-title class="text-h6 text-center ml-5">
                        <small>Total Gastos</small>
                        
                      </v-card-title>

                      <v-card-subtitle > <h6 style="color:#fff!important">{{totals.gastos}}€</h6></v-card-subtitle>

                      <!-- <v-card-actions>
                        <v-btn text>
                          Listen Now
                        </v-btn>
                      </v-card-actions> -->
                    </v-card>
                  </v-col>


                   <v-col cols="12" sm="12" md="3" lg="3" xl="3" class="text-center"  >
                     <router-link to="/gastos-generales">
                       <v-card
                         color="red"
                         dark>
                         <v-card-title class="text-h6 text-center ml-5">
                           <small>Gastos generales</small>
                           
                         </v-card-title>

                         <v-card-subtitle > <h6 style="color:#fff!important">{{totals.expenses}}€</h6></v-card-subtitle>

                         <!-- <v-card-actions>
                           <v-btn text>
                             Listen Now
                           </v-btn>
                         </v-card-actions> -->
                       </v-card>
                     </router-link>
                  </v-col>

                   <v-col cols="12" sm="12" md="3" lg="3" xl="3" class="text-center" >
                    <v-card
                      color="blue lighten-2">
                      <v-card-title class="text-h6 text-center ml-5">
                        <small style="color:#fff!important">Total Comisiones</small>
                      </v-card-title>

                      <v-card-subtitle > <h6 style="color:#fff!important">{{totals.comisiones}}€</h6></v-card-subtitle>

                      <!-- <v-card-actions>
                        <v-btn text>
                          Listen Now
                        </v-btn>
                      </v-card-actions> -->
                    </v-card>
                  </v-col>

                   <v-col cols="12" sm="12" md="3" lg="3" xl="3" class="text-center" >
                    <v-card
                      color="#385F73"
                      dark
                    >
                      <v-card-title class="text-h6 text-center ml-5">
                          <small>Total Beneficios</small>
                        
                      </v-card-title>

                      <v-card-subtitle > <h6 style="color:#fff!important">{{totals.beneficios}}€</h6></v-card-subtitle>

                      <!-- <v-card-actions>
                        <v-btn text>
                          Listen Now
                        </v-btn>
                      </v-card-actions> -->
                    </v-card>
                  </v-col>
               </div>
               <!-- <div class="row">
                   <div class="col-lg-8">
                     <div class="iq-card iq-card-block iq-card-stretch iq-card-height wow fadeInUp overflow-hidden" data-wow-delay="0.6s">
                        <div class="iq-card-header d-flex justify-content-between">
                           <div class="iq-header-title">
                              <h4 class="card-title">Frequent Post List</h4>
                           </div>
                        </div>
                        <div class="iq-card-body">
                           <div class="table-responsive">
                              <table class="table mb-0 table-borderless">
                                 <thead>
                                    <tr>
                                       <th scope="col">Package No.</th>
                                       <th scope="col">Date</th>
                                       <th scope="col">Delivery</th>
                                       <th scope="col">Status</th>
                                       <th scope="col">Location</th>
                                       <th scope="col">Progress</th>

                                    </tr>
                                 </thead>
                                 <tbody>
                                    <tr>
                                       <td>#0879985</td>
                                       <td>26/12/2019</td>
                                       <td>30/12/2019</td>
                                       <td>
                                          <div class="badge badge-pill badge-success">Moving</div>
                                       </td>
                                       <td>Victoria 8007 Australia</td>
                                       <td>
                                          <div class="iq-progress-bar">
                                             <span class="bg-success" data-percent="90" style="transition: width 2s ease 0s; width: 90%;"></span>
                                          </div>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>#0879984</td>
                                       <td>23/12/2019</td>
                                       <td>27/12/2019</td>
                                       <td>
                                          <div class="badge badge-pill badge-warning text-white">Pending</div>
                                       </td>
                                       <td>Athens 2745 Greece</td>
                                       <td>
                                          <div class="iq-progress-bar">
                                             <span class="bg-warning" data-percent="70" style="transition: width 2s ease 0s; width: 70%;"></span>
                                          </div>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>#0879983</td>
                                       <td>18/12/2019</td>
                                       <td>21/12/2019</td>
                                       <td>
                                          <div class="badge badge-pill badge-danger">Canceled</div>
                                       </td>
                                       <td>Victoria 8007 Australia</td>
                                       <td>
                                          <div class="iq-progress-bar">
                                             <span class="bg-danger" data-percent="48" style="transition: width 2s ease 0s; width: 48%;"></span>
                                          </div>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>#0879982</td>
                                       <td>14/12/2019</td>
                                       <td>20/12/2019</td>
                                       <td>
                                          <div class="badge badge-pill badge-info">Working</div>
                                       </td>
                                       <td>Delhi 0014 India</td>
                                       <td>
                                          <div class="iq-progress-bar">
                                             <span class="bg-info" data-percent="90" style="transition: width 2s ease 0s; width: 90%;"></span>
                                          </div>
                                       </td>
                                    </tr>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-12 col-lg-4">
                    <div class="iq-card iq-card-block iq-card-stretch iq-card-height wow fadeInUp" data-wow-delay="0.8s">
                        <div class="iq-card-header d-flex justify-content-between">
                           <div class="iq-header-title">
                              <h4 class="card-title">Post Summary</h4>
                           </div>
                           <div class="iq-card-header-toolbar d-flex align-items-center">
                              <div class="dropdown">
                                 <span class="dropdown-toggle text-primary" id="dropdownMenuButton4" data-toggle="dropdown">
                                 <i class="ri-more-fill"></i>
                                 </span>
                                 <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton4">
                                    <a class="dropdown-item" href="#"><i class="ri-eye-fill mr-2"></i>View</a>
                                    <a class="dropdown-item" href="#"><i class="ri-delete-bin-6-fill mr-2"></i>Delete</a>
                                    <a class="dropdown-item" href="#"><i class="ri-pencil-fill mr-2"></i>Edit</a>
                                    <a class="dropdown-item" href="#"><i class="ri-printer-fill mr-2"></i>Print</a>
                                    <a class="dropdown-item" href="#"><i class="ri-file-download-fill mr-2"></i>Download</a>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="iq-card-body">
                           <p class="mb-0">Total of Likes $ Comments</p>
                           <div class="m-0 p-0 d-flex flex-wrap align-items-center justify-content-between">
                              <div class="col-md-6">
                                 <div class="d-flex align-items-center  mt-4">
                                    <div class="iq-scale-border mr-3 like-block"></div>
                                    <div class="iq-scale-content">
                                       <h6>2.864</h6>
                                       <p class="mb-0">Likes</p>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="d-flex align-items-center  mt-4">
                                    <div class="iq-scale-border mr-3 comment-block"></div>
                                    <div class="iq-scale-content">
                                       <h6>624</h6>
                                       <p class="mb-0">Comments</p>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="d-flex align-items-center mt-4">
                                    <div class="iq-scale-border mr-3 share-block"></div>
                                    <div class="iq-scale-content">
                                       <h6>1.75</h6>
                                       <p class="mb-0">Share</p>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="d-flex align-items-center mt-4">
                                    <div class="iq-scale-border mr-3 repost-block"></div>
                                    <div class="iq-scale-content">
                                       <h6>345</h6>
                                       <p class="mb-0">Repost</p>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="d-flex align-items-center mt-4">
                                    <div class="iq-scale-border mr-3 view-block"></div>
                                    <div class="iq-scale-content">
                                       <h6>845</h6>
                                       <p class="mb-0">Views</p>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="d-flex align-items-center mt-4">
                                    <div class="iq-scale-border mr-3 post-block"></div>
                                    <div class="iq-scale-content">
                                       <h6>1200</h6>
                                       <p class="mb-0">Posts</p>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                 <div class="col-lg-12">
                     <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                        <div class="iq-card-header d-flex justify-content-between">
                           <div class="iq-header-title">
                              <h4 class="card-title">Best Performing Posts</h4>
                           </div>
                        </div>
                        <div class="iq-card-body">
                           <ul id="post-slider" class="p-0 m-0 d-flex">
                              <li class="d-flex align-items-center">
                                 <div class="post-image">
                                    <a href="javascript:void();">
                                       <img src="images/page-img/p-2.jpg" alt="post-image" class="img-fluid rounded">
                                    </a>
                                 </div>
                                 <div class="post-content pl-3">
                                    <h4>How to Like Posts</h4>
                                    <h3 class="mt-2 mb-2">89.64%</h3>
                                    <div class="iq-progress-bar mb-3">
                                       <span class="bg-primary" data-percent="90"></span>
                                    </div>
                                    <div class="text-center d-flex align-items-center justify-content-between">
                                       <div class="iq-post-likes text-left">
                                          <a href="#" class="text-secondary"><i class="ri-heart-line mr-2"></i>6.2K</a>
                                       </div>
                                       <div class="iq-post-comments text-left ml-2 mr-2">
                                          <a href="#" class="text-secondary"><i class="ri-chat-1-fill mr-2"></i>6.2K</a>
                                       </div>
                                       <div class="iq-post-save text-left">
                                          <a href="#" class="text-secondary"><i class="ri-save-line mr-2"></i>6.2K</a>
                                       </div>
                                    </div>
                                 </div>
                              </li>
                              <li class="d-flex align-items-center">
                                 <div class="post-image">
                                    <a href="javascript:void();">
                                       <img src="images/page-img/p-3.jpg" alt="post-image" class="img-fluid rounded">
                                    </a>
                                 </div>
                                 <div class="post-content pl-3">
                                    <h4>How to Comments Posts</h4>
                                    <h3 class="mt-2 mb-2">89.64%</h3>
                                    <div class="iq-progress-bar mb-3">
                                       <span class="bg-primary" data-percent="90"></span>
                                    </div>
                                    <div class="text-center d-flex align-items-center justify-content-between">
                                       <div class="iq-post-likes text-left">
                                          <a href="#" class="text-secondary"><i class="ri-heart-line mr-2"></i>6.2K</a>
                                       </div>
                                       <div class="iq-post-comments text-left ml-2 mr-2">
                                          <a href="#" class="text-secondary"><i class="ri-chat-1-fill mr-2"></i>6.2K</a>
                                       </div>
                                       <div class="iq-post-save text-left">
                                          <a href="#" class="text-secondary"><i class="ri-save-line mr-2"></i>6.2K</a>
                                       </div>
                                    </div>
                                 </div>
                              </li>
                              <li class="d-flex align-items-center">
                                 <div class="post-image">
                                    <a href="javascript:void();">
                                       <img src="images/page-img/p-4.jpg" alt="post-image" class="img-fluid rounded">
                                    </a>
                                 </div>
                                 <div class="post-content pl-3">
                                    <h4>How to Share Posts</h4>
                                    <h3 class="mt-2 mb-2">89.64%</h3>
                                    <div class="iq-progress-bar mb-3">
                                       <span class="bg-primary" data-percent="90"></span>
                                    </div>
                                    <div class="text-center d-flex align-items-center justify-content-between">
                                       <div class="iq-post-likes text-left">
                                          <a href="#"><i class="ri-heart-line mr-2"></i>6.2K</a>
                                       </div>
                                       <div class="iq-post-comments text-left ml-2 mr-2">
                                          <a href="#"><i class="ri-chat-1-fill mr-2"></i>6.2K</a>
                                       </div>
                                       <div class="iq-post-save text-left">
                                          <a href="#"><i class="ri-save-line mr-2"></i>6.2K</a>
                                       </div>
                                    </div>
                                 </div>
                              </li>
                              <li class="d-flex align-items-center">
                                 <div class="post-image">
                                    <a href="javascript:void();">
                                       <img src="images/page-img/p-5.jpg" alt="post-image" class="img-fluid rounded">
                                    </a>
                                 </div>
                                 <div class="post-content pl-3">
                                    <h4>How to Repost </h4>
                                    <h3 class="mt-2 mb-2">89.64%</h3>
                                    <div class="iq-progress-bar mb-3">
                                       <span class="bg-primary" data-percent="90"></span>
                                    </div>
                                    <div class="text-center d-flex align-items-center justify-content-between">
                                       <div class="iq-post-likes text-left">
                                          <a href="#" class="text-secondary"><i class="ri-heart-line mr-2"></i>6.2K</a>
                                       </div>
                                       <div class="iq-post-comments text-left ml-2 mr-2">
                                          <a href="#" class="text-secondary"><i class="ri-chat-1-fill mr-2"></i>6.2K</a>
                                       </div>
                                       <div class="iq-post-save text-left">
                                          <a href="#" class="text-secondary"><i class="ri-save-line mr-2"></i>6.2K</a>
                                       </div>
                                    </div>
                                 </div>
                              </li>
                           </ul>
                        </div>
                     </div>
                  </div>
               </div> -->
            </div>
         </div>
    </v-container>
</template>

<script>
    import {
        menu_items_mixin
    } from '../../global_mixins/menu_items_mixin'

    export default {
        mixins: [menu_items_mixin],
         data: () => ({
             totals : [],
             infoLoader: 'Obteniendo Página Principal'
         }),

         computed: {
               isloading: function() {
                    return this.$store.getters.getloading
               },
               
         },

         watch: {
             
         },

         created () {
              this.dashboard()
            
         },

         methods: {
              
              dashboard(){
                    this.snackbarInfoCrud = false
                    this.infoCrud = ''
                    this.$Progress.start()
                    axios.get(this.$apiUrl + `/dashboard` ).then(response => {
                         if (response.status == 200) {
                              this.totals = response.data

                              this.$Progress.finish()
                         }
                         
                  
                    }, err => {
                        this.$Progress.fail()
                    })
              }

              
         },
    };
</script>

<style>
   
</style>