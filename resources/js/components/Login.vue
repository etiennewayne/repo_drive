<template>
    <div class="login-wrapper">
        <div class="login">
            <form @submit.prevent="submit">
                <div class="panel is-primary">
                    <div class="panel-heading">
                        SECURITY CHECK
                    </div>

                    <div class="panel-body">

                        <div class="icon-wrapper">
                            <img src="/img/dictlogo.png" style="height: 120px;"/>
                            <img src="/img/gadtclogo.png" style="height: 120px;"/>
                        </div>
                        <b-field label="Username" label-position="on-border"
                            :type="this.errors.username ? 'is-danger':''"
                            :message="this.errors.username ? this.errors.username[0] : ''">
                            <b-input type="text" v-model="fields.username" placeholder="Username" />
                        </b-field>

                        <b-field label="Password" label-position="on-border">
                            <b-input type="password" v-model="fields.password" password-reveal placeholder="Password" />
                        </b-field>

                        <div class="buttons mb-3">
                            <button :class="btnClass">LOGIN</button>
                            <a tag="a" href="/sign-up" class="button is-link">REGISTER</a>
                        </div>
                        <div style="height: 20px;">

                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
</template>

<script>

export default {
    data(){
        return {
            fields: {
                username: '',
                password: '',
            },

            btnClass: {
                'is-primary': true,
                'is-loading': false,
                'button': true
            },

            errors: {},

        }
    },

    methods: {
        submit: function(){
            this.btnClass['is-loading'] = true;

            axios.post('/login', this.fields).then(res=>{
            this.btnClass['is-loading'] = false;

                console.log(res.data)
                window.location = '/dashboard';
            }).catch(err=>{
            this.btnClass['is-loading'] = false;
                this.errors = err.response.data.errors;

            })
        }
    }
}
</script>


<style scoped>
    .login-wrapper{
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .login{
        width: 500px;
        
    }

    .panel-body{
        margin: 15px;
    }

    .img-container{
        display: flex;
        justify-content: center;
    }

    .img{
        height: 200px;
    }

    .icon-wrapper{
        display: flex;
        margin: 20px;
        justify-content: center;
    }


</style>
