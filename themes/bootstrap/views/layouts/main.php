<!DOCTYPE html>

<html lang="<?php echo Yii::app()->language;?>">

<head>

	 <title><?php echo CHtml::encode($this->pageTitle); ?></title>
	 
	 <meta charset="<?php echo Yii::app()->charset;?>">
     <meta name="author" content="<?php echo CHtml::encode(Yii::app()->params['autor']); ?>">
	 
	<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
		<script src="<?php echo Yii::app()->baseUrl; ?>/js/html5.js"></script>
	<![endif]-->
	
	<link rel="shortcut icon" href="<?php echo Yii::app()->theme->baseUrl; ?>/images/favicon.ico">
	
</head>

<body>

<header>
<?php	
$this->widget('bootstrap.widgets.TbNavbar', array(
	'type'=>'inverse', // null or 'inverse'
	'brand'=>CHtml::encode(Yii::app()->name),
	'brandUrl'=>array('/site/index'),
	'collapse'=>true, // requires bootstrap-responsive.css
	'items'=>array(
		array(
			'class'=>'bootstrap.widgets.TbMenu',
			'items'=>array(
			array('label'=>'Factura Compra','url'=>array('/cabcompra/index'))
			),
		),		
		array(
			'class'=>'bootstrap.widgets.TbMenu',
			'htmlOptions'=>array('class'=>'pull-right'),
			'items'=>array(
				array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
			),
			   //	array('label'=>'Logout', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest, 'htmlOptions'=>array('class'=>'btn'))					
		),
	),
));
?>	

</header>
<div class="container" id="main">
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?>
	<?php endif?>
	<?php echo $content; ?>
	<hr>
		<footer>
		Copyright &copy; <?php echo date('Y'); ?> <?php echo CHtml::encode(Yii::app()->params['empresa']); ?> | <?php echo CHtml::encode((Yii::app()->name).' '.Yii::app()->params['version']); ?> - All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
		</footer>
		
</div>      
</body>
</html>
