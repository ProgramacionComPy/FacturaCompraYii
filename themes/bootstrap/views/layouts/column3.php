<?php $this->beginContent('//layouts/main'); ?>  
	<div class="row">
    <div class="span3">
	<div class="well sidebar-nav">
				<?php
					$this->beginWidget('zii.widgets.CPortlet', array(
						'title'=>'Panel',
						'htmlOptions'=>array('class'=>'nav-header'),
					));
					$this->widget('zii.widgets.CMenu', array(
						'items'=>$this->menu,
						'htmlOptions'=>array('class'=>'nav nav-list'),
					));
					$this->endWidget();
				?>
			</div>
			</div>
			<div class="span9">
				<?php echo $content; ?>
			</div>
			</div>
<?php $this->endContent(); ?>


