<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo $__env->yieldContent('title'); ?></title>
	<base href="assets">
	<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">	
	<link rel="stylesheet" title="style" href="source/assets/dest/css/style.css">
</head>
<body>
	<div id="header">
		<div class="header-top">
			<div class="container">
				<div class="pull-right auto-width-right">
					<ul class="top-details menu-beta l-inline">
					<?php if(Auth::check()): ?>
                    <li>
                        <a>Hello <?php echo e(Auth::user()->name); ?></a>
                    </li>
                     <li>
                        <a href="<?php echo e(route('logout')); ?>">Logout</a>
                    </li>
                    <?php else: ?>
                    <li>
                        <a href="<?php echo e(route('get_register')); ?>">Register</a>
                    </li>
                    <li>
                        <a href="<?php echo e(route('get_login')); ?>">Login</a>
                    </li>
                    <?php endif; ?>
					</ul>
				</div>
				<div class="clearfix"></div>
			</div> <!-- .container -->
		</div> <!-- .header-top -->
		<div class="header-body">
			<div class="container beta-relative">
				<div class="pull-left">
					<a href="index.html" id="logo"><img src="source/assets/dest/images/logo_primari.png" width="200px" alt=""></a>
				</div>
				
		</div> <!-- .header-body -->
		<div class="header-bottom"  style="background-color:#000000;">
			<div class="container">
				<nav class="main-menu">
					<ul class="l-inline ov">
					<?php if(Auth::check()): ?>
						<li>
						<a href="<?php echo e(route('home')); ?>">Home</a>
						</li>
						<li>
						<a href="#">All trip</a>
						</li>
						<li>
						<a href="#">User page</a>
						</li>
					<?php else: ?>
					    <li>
						<a href="<?php echo e(route('home')); ?>">Home</a>
						</li>
						<li>
						<a href="#">All trip</a>
						</li>
						<li>
                    <?php endif; ?>
					</ul>
					<div class="clearfix"></div>
				</nav>
			</div> <!-- .container -->
		</div> <!-- .header-bottom -->
	</div> <!-- #header -->
</body>
</html>