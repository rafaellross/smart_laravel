<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link rel="shortcut icon" href="<?php echo e(asset('img/brand.ico')); ?>">
    <link rel="apple-touch-icon" href="<?php echo e(asset('img/brand.ico')); ?>">  
    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e('Administration - Smart Plumbing Solutions'); ?></title>

    <!-- Scripts -->    
    <script src="<?php echo e(asset('js/jquery.min.js')); ?>"></script>    
    <script src="<?php echo e(asset('js/app.js')); ?>"></script>    
    <script src="<?php echo e(asset('js/bootstrap-datepicker.min.js')); ?>"></script>        
    <script src="<?php echo e(asset('js/jSignature.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/custom.js')); ?>"></script>
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Styles -->
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.css">
</head>
<body>

    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container-fluid">
                <a class="navbar-brand" href="<?php echo e(url('/')); ?>">                    
                    <img src="<?php echo e(URL::to('/')); ?>/img/brand.ico" width="30" height="30" alt="<?php echo e(config('app.name', 'Administration - Smart Plumbing Solutions')); ?>"/>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(URL::to('/')); ?>">Home</a>
                        </li>
                        <?php if(isset(Auth::user()->administrator) && Auth::user()->administrator): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(URL::to('/users')); ?>">Users</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(URL::to('/employees')); ?>">Employees</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(URL::to('/jobs')); ?>">Jobs</a>
                            </li>

                        <?php endif; ?>
                        <?php if(auth()->guard()->check()): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Modules
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="<?php echo e(URL::to('/timesheets')); ?>">Time Sheets</a>
                                <div class="dropdown-divider"></div>                                
                                <a class="dropdown-item" href="<?php echo e(URL::to('/employee_application')); ?>" style="display: none;">Employee Application</a>
                            </div>
                        </li>
                        
                        <?php endif; ?>                                                
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        <?php if(auth()->guard()->guest()): ?>
                            <li><a class="nav-link" href="<?php echo e(route('login')); ?>"><?php echo e(__('Login')); ?></a></li>
                        <?php else: ?>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <?php echo e(Auth::user()->name); ?> <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="/users/<?php echo e(Auth::user()->id); ?>/edit"><?php echo e(__('Change Password')); ?>

                                    </a>

                                    <a class="dropdown-item" href="<?php echo e(route('logout')); ?>"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <?php echo e(__('Logout')); ?>

                                    </a>

                                    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                                        <?php echo csrf_field(); ?>
                                    </form>
                                </div>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>
        <?php if($flash = session('success')): ?>
        <div id="flash-message" class="alert alert-success" role="alert">            
            <strong class="mr-2"><?php echo e($flash); ?></strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>            
        </div>
        <?php endif; ?>
        <?php if($flash = session('success')): ?>
        <div id="flash-message" class="alert alert-success" role="alert">            
            <strong class="mr-2"><?php echo e($flash); ?></strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>            
        </div>
        <?php endif; ?>

        <main class="py-4">
            <?php echo $__env->yieldContent('content'); ?>
        </main>
    </div>
    <div id="modalLoading" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalLoading" aria-hidden="true">          
        <div class="modal-dialog modal-sm">
            <div class="modal-content" style="width: 48px">
                <span class="fa fa-spinner fa-spin fa-3x"></span>
            </div>
        </div>          
    </div>   
</body>
</html>
