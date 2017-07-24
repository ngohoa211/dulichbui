<?php $__env->startSection('title'); ?>
login
<?php $__env->stopSection(); ?>
<?php echo $__env->make('header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

  <body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h2 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
                           
                            <?php if(count($errors) > 0): ?>
                            <div class="alert alert-danger">
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $err): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                   <?php echo e($err); ?>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <?php endif; ?>
                            <?php if(Session::has('thongbao')): ?>
                            <div class="alert alert-success">
                                   <?php echo e(Session::get('thongbao')); ?>

                            </div>
                            <?php endif; ?>
                    
                        <form role="form" action="" method="POST">
                            <fieldset>
                            <?php echo e(csrf_field()); ?>

                                
                                <div class="form-group">
                                    <input class="form-control" placeholder="E-mail" name="email" value="" type="email" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                </div>
                                <button type="submit" class="btn btn-lg btn-success btn-block">Login</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    

</body>


