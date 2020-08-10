<!doctype html>
<html lang="en">
<head>   

    <title><?=$title?></title>   
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <link href="<?php echo base_url().'/public/css/styles.css'?> "rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue-toast-notification"></script>
    <link href="https://cdn.jsdelivr.net/npm/vue-toast-notification/dist/theme-default.css" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="#">
                <?=$heading?>
                </a>
            </div>
        </nav>

        <main class="py-4">
            
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><?=$login_title?></div>

                <div class="card-body">
                    <form method="POST" action=" ">                       
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right"><?=$username?></label>
                            <div class="col-md-6">
                                <input name="username" v-model="username" type="text" class="form-control" autocomplete="off" autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right"><?=$password?></label>
                            <div class="col-md-6">
                                <input name="password" v-model="password"  type="password" class="form-control " autocomplete="off">
                           </div>
                        </div>

                        <div class="form-group row">
                        <div class="col-md-12 offset-md-4">
                              <button type="button" @click='login();' value="Login"class="btn btn-primary">
                                    Login
                              </button>
                        </div>
                        </div>   
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</main>
</div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.0.0/crypto-js.min.js"></script>
<script>
  var app = new Vue({
            el: '#app',
            data: {
              username: "",
              password: ""
            },
            methods: {
              login: function(){
               // alert(CryptoJS.SHA1(this.password))
                if (this.username != '' && this.password != '') {
                             
                            axios.post('<?php echo base_url().'/login/doLogin'?>', {                            
                            username: this.username,
                            password: CryptoJS.SHA1(this.password).toString()
                  })
                  .then(function(response) {
                     
                        if (response.data[0].status == 1) {
                          app.toast('Login Successfully','success')    
                          window.location.href='<?php echo base_url().'/dashboard'?>';                     
                        } else {
                          app.toast('User does not exist','error')
                          
                        }
                  })
                  .catch(function(error) {
                    console.log(error);
                  });
      }else {
           app.toast('Please enter username & password','error')           
      }
    },
    toast:function(message,type){
          Vue.use(VueToast);
          Vue.$toast.open({
                message: message,
                type: type,
                position: 'top-right',
                pauseOnHover:true                                
          });
    }
   }
  })
</script>
</html>
