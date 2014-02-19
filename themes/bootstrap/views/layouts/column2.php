<?php $this->beginContent('//layouts/main'); ?>  
	<div class="row">
    <div class="span3">
				<?php
					$this->widget('bootstrap.widgets.TbBox', array(
						'title'=>'Operaciones',
						'content'=> $this->widget('zii.widgets.CMenu', array(
						'items'=>$this->menu,
					),true),
					));
				?>
			</div>
			<div class="span9">
				<?php echo $content; ?>
			</div>
			</div>
<?php $this->endContent(); ?>
