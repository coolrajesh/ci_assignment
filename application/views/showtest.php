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
                <?php if($this->session->userdata('user_id')!='') { ?>   
                <ul class="navbar-nav ml-auto">
                        
                        <li class="nav-item">
                                <a class="nav-link">Welcome <?=$this->session->userdata('user_id')?></a>
                        </li>
                        <li class="nav-item">
                                    <a class="nav-link" href="#">Logout</a>
                        </li>
                 </ul>
                <?php } ?>
            </div>
        </nav>

        <main class="py-4">
            
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h4><?php if($this->session->flashdata('success')!='') { echo $this->session->flashdata('success'); } ?></h4>
                <div class="col-md-5"> <a href="<?php echo base_url();?>/dashboard/getCartItems" class="btn btn-success">View Cart</a></div>
            <form method="post" action="<?php echo base_url();?>/dashboard/savetest">
            <?php if($this->session->userdata('user_id')!='') { ?>   
                <div class="card-header"><?=$panel_title?></div>
                <div class="card-body">
                <div class="col-md-5"><strong>Search By Test</strong> : <input v-on:keyup="search" type="text" v-model="searchQuery" name="searchQuery"class="form-control"></div><br>
                <table class="table table-hover table-bordered">  
                        <thead class="card-header">             
                        <tr>  
                        <th>Select</th>
                        <th>Test</th>
                        <th>Lab</th>
                        <th>Price</th>
                        <th>Category</th>
                        </tr>
                    </thead>
                    <tbody>
                       
                            <tr v-for='(package, index) in packages'>
                                <td><input type="checkbox" :value="package.test_id"   name="testid[]"></td>
                                <td>{{ package.itemName }}</td>
                                <td>{{ package.labName }}</td>
                                <td>{{package.minPrice}}</td>
                                <td>{{package.category}}</td>
                            </tr>             
                    </tbody>
                    
                </table>
                    <input type="submit" value="Add To Cart" class="btn btn-success">
                </form>
                </div>
            </div>
            <?php } else { ?>
                <h4 style='color:red;margin-top:20px;margin-left:20px'>Please Login To Access This Page</h4>
            <?php } ?>
        </div>
    </div>
</div>
</main>
</div>
</body> 
 
 <script type="text/javascript">
        var app = new Vue({
        el: '#app',
        data: {
                packages: '',    
                searchQuery: null,
                testid:''                
        },
        methods: {       
            gettests: function(){
                    axios.get('<?php echo base_url();?>/dashboard/testDetails', {})
                    .then(function (response) {
                        app.packages = response.data;    
                        console.log(app.packages);
                    }); 
            },   
            
            search: function() {

                axios.get('<?php echo base_url();?>/dashboard/search', {

                    params: {
                        key: this.searchQuery
                    }
                })
                    .then(function (response) {
                        app.packages = response.data;    
                        console.log(app.packages);
                    }); 
            },

            validateBeforeSubmit:function(){

                //alert(app.testid)
            }
            
        },   
        created: function(){                 
            this.gettests(); 
        },
        
        

});
</script>
</html>
