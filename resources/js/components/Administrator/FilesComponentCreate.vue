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
                            <div class="columns is-centered">
                                <div class="column is-6">
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

                            <div class="buttons is-right">
                                <b-button label="Upload File" @click="submit" :class="btnClass"></b-button>
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

            btnClass: {
                'is-success': true,
                'button': true,
                'is-loading':false,
            }

        }
    },
    methods: {
        submit: function(){
            this.btnClass['is-loading'] = true;

            let formData = new FormData();
            formData.append('repo_filename', this.fields.filename);

            this.fields.dropFiles.forEach(item =>{
                formData.append('repo_filepath[]', item);
            });

            axios.post('/files', formData).then(res=>{
                this.btnClass['is-loading'] = false;

                if(res.data.status === 'saved'){
                    alert('Files uploaded successfully.');
                    window.location = '/files';
                }
            }).catch(err=>{
                if(err.response.status === 422){
                    this.errors = err.response.data.errors;
                }
                this.btnClass['is-loading'] = false;
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