<template>
    <div>


        <div class="section">
            <div class="columns is-centered">
                <div class="column is-8">
                    <div class="box">
                        <div class="box-head">
                            File Information
                        </div>

                        <div class="box-body">
                            <div class="columns">
                                <div class="column">
                                    <b-field label="Filename">
                                        <b-input type="text" v-model="fields.filename" placeholder="Filename"></b-input>
                                    </b-field>
                                </div>
                            </div>

                            <div class="columns">
                                <div class="column">
                                    <b-field label="">
                                        <b-upload v-model="fields.dropFiles"
                                            multiple
                                            drag-drop>
                                            <section class="section">
                                                <div class="content has-text-centered">
                                                    <p>
                                                        <b-icon
                                                            icon="upload"
                                                            size="is-large">
                                                        </b-icon>
                                                    </p>
                                                    <p>Drop your files here or click to upload</p>
                                                </div>
                                            </section>
                                        </b-upload>
                                    </b-field>

                                    <div class="tags">
                                        <span v-for="(file, index) in fields.dropFiles"
                                            :key="index"
                                            class="tag is-primary" >
                                            {{file.name}}
                                            <button class="delete is-small"
                                                type="button"
                                                @click="deleteDropFile(index)">
                                            </button>
                                        </span>
                                    </div>
                                </div>
                            </div><!--div cols-->

                            <div class="buttons">
                                <b-button label="Upload File" @click="submit" class="is-info"></b-button>
                            </div>


                        </div><!--div box body-->
                    </div> <!--div box-->
                </div>
            </div>
        </div>


    </div>
</template>

<script>
export default {
    data(){
        return{
            fields: {},
            errors: {},

        }
    },
    methods: {
        submit: function(){
            let formData = new FormData();
            formData.append('repo_filename', this.fields.filename);

            this.fields.dropFiles.forEach(item =>{
                formData.append('repo_filepath[]', item);
            });

            axios.post('/files', formData).then(res=>{
                if(res.data.status === 'saved'){
                    //alert('Boarding house successfully saved.');
                    //window.location = '/boarding-house';
                }
            }).catch(err=>{
                if(err.response.status === 422){
                    this.errors = err.response.data.errors;
                }
            });
            
        },

        deleteDropFile(index) {
            this.fields.dropFiles.splice(index, 1)
        }
    }
}
</script>

<style scoped>
    .box-head{
        padding: 10px;
        font-weight: bold;
        font-size: large;
       
    }

    .box-body{
        padding: 10px;
    }
</style>