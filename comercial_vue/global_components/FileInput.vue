<template>
  <!-- accept=".svg" -->
  <div>
        <!--div class="input-group bg-primary" >
          <input :value="getFilesName()" class="form-control" type="text"  placeholder="" readonly >
          <span class="input-group-btn">

            <button v-if="files.length" class="btn btn-danger" type="button"  @click="$emit('file-clear')" >
                <i class="fa fa-ban"></i>
              </button>
              <button class="btn btn-primary" type="button" @click="showFilePicker">
                <i class="fa fa-paperclip"></i>
              </button>
          </span>
          
        </div-->
        <input type="file" ref="file"  @change="onChange" multiple>

       <!--  <spam>
          
            <img :src="getImagesP()">
        </spam>
         -->
       <!--   <div class="container-input">
<input value="value" type="file" name="file-7" id="file-7"  ref="file"  @change="onChange" class="inputfile inputfile-7" data-multiple-caption="{count} archivos seleccionados" multiple style="display:none"/>
<label for="file-7">
<span class="iborrainputfile">{{ nombreImg }}</span>
<strong>
<svg xmlns="http://www.w3.org/2000/svg" class="iborrainputfile" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path></svg>
Seleccionar archivo
</strong>
</label>
</div> -->
    </div>

</template>


<script >
  export default{
    props: {
       
    },
    data:() => ({
      files: [],
      showPreview: '',
      imagePreview:[],
      nombreImg: ''
     
    }),
    mounted(){
       this.getImagesP()
       
    },
    methods:{

      showFilePicker(){
          this.$refs.file.click()

      },
       getImagesP(){
          let photo = (this.imagePreview.length > 100) ? '' :  this.imagePreview;
          
          return photo;
      },
      onChange(e){

       
        const filesPreview = e.currentTarget.files;
        Object.keys(filesPreview).forEach(i => {
            const file = filesPreview[i];
            const reader = new FileReader();
            reader.onload = (e) => {
                this.imagePreview.push(reader.result);
            }
            this.imagePreview = []
            reader.readAsDataURL(file);
           
        });



        this.files = e.target.files[0] //subir una

        let files = e.target.files //subir varias
        this.$emit('file-change', files)
        

      },

      getFilesName (){
        let filesName = []

        if (this.files.length > 0) {
          for (let file of this.files) {
              filesName.push(file.name)
          }
        }

        return filesName.join(", ")

      },
      clearFiles(){
        
        this.files = []
        this.disableUploadButtonImage = true

        
       },


      
      limpiar(){
        
          const input = this.$refs.file
          input.type = 'text'
          input.type = 'file'
      }



      
    }
  };
</script>

<style type="text/css">



  .inputfile-7 + label {
    color: #c39f77;
}

.inputfile-7 + label {
    border: 1px solid #c39f77;
    font-size: 1rem;
    background-color: #fff;
    padding: 0;
}

.inputfile-7:focus + label,
.inputfile-7.has-focus + label,
.inputfile-7 + label:hover {
    border-color: #9f8465;
}

.inputfile-7 + label span,
.inputfile-7 + label strong {
    padding: 0.625rem 1.25rem;
}

.inputfile-7 + label span {
    width: 300px;
    min-height: 1em;
    display: inline-block;
    text-overflow: ellipsis;
    white-space: nowrap;
    overflow: hidden;
    vertical-align: top;
}

.inputfile-7 + label strong {
    height: 100%;
    color: #fff;
    background-color: #c39f77;
    display: inline-block;
}

.inputfile-7:focus + label strong,
.inputfile-7.has-focus + label strong,
.inputfile-7 + label:hover strong {
    background-color: #9f8465;
}

@media screen and (max-width: 50em) {
  .inputfile-7 + label strong {
    display: block;
  }
}
</style>