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
            
            <form method="post" action="<?php echo base_url();?>/dashboard/confirmOrder">
            <?php if($this->session->userdata('user_id')!='') { ?>   
                <div class="card-header"><?=$order_summary_text?></div>
                <div class="card-body">
                <?php $sr=1;$total_price=0?> 
                                
                <?php if(isset($order_summary) and !empty($order_summary)) { ?>               
                <table class="table table-hover table-bordered">  
                        <thead class="card-header">             
                        <tr>  
                        <th>Sr.No.</th>
                        <th>Test</th>
                        <th>Price</th>                         
                        <th>Lab</th>                        
                        </tr>
                    </thead>
                    <tbody>
                    
                       <?php foreach($order_summary as $order){ ?>
                            <tr>
                                <td><?=$sr++?></td>
                                <td><?=$order->itemName?></td>
                                <td><?=$order->minPrice?></td>
                                <td><?=$order->labName?></td>
                               
                            </tr> 
                    <?php $total_price+=$order->minPrice; ?>
                    <?php  } ?>
                    </tbody>                    
                </table>
                <?php }  else { ?>
                    <h4>No Order</h4>  
                <?php } ?>
                 
                <h4>Total Amount: <?=$total_price?></h4>
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
</html>
