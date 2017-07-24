<?php $__env->startSection('title'); ?>
register
<?php $__env->stopSection(); ?>

 <?php echo $__env->make('header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>  

<body>
    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Register</h3>
                    </div>
                    <div class="panel-body">
                             <?php if(count($errors) > 0): ?>
                            <div class="alert alert-danger">
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $err): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                   <?php echo e($err); ?>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <?php endif; ?>
                            <?php if(Session::has('thanhcong')): ?>
                            <div class="alert alert-success">
                                   <?php echo e(Session::get('thanhcong')); ?>

                            </div>
                            <?php endif; ?>
                        <form role="form" action="" method="POST">
                            <fieldset>
                            <?php echo e(csrf_field()); ?>

                                <div class="form-group">
                                    <input class="form-control" placeholder="Username" name="name" value="" type="" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="E-mail" name="email" value="" type="email" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Confirm Password" name="repassword" type="password" value="">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Age" name="age" value="" type="" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Gender" name="gender" value="" type="" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Address" name="address" value="" type="" autofocus>
                                </div>
                                <button type="submit" class="btn btn-lg btn-success btn-block">Register</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</body>

</html>
