<?php
$this->Html->css('Gourmet/TwitterBootstrap.cover', ['block' => true]);
$this->prepend('tb_body_attrs', ' class="' . implode(' ', array($this->request->controller, $this->request->action)) . '" ');
$this->start('tb_body_start');
?>
<body <?= $this->fetch('tb_body_attrs') ?>>
	<div class="site-wrapper">
		<div class="site-wrapper-inner">
			<div class="cover-container">

				<div class="masthead clearfix">
					<div class="inner">
						<h3 class="masthead-brand"><?= read('App.title', env('HTTP_HOST')) ?></h3>
						<?= $this->fetch('tb_topnav') ?>
					</div>
				</div>

				<div class="inner cover">
<?php
$this->end();

$this->start('tb_body_end');
?>
			</div>
		</div>
	</div>
</body>
<?php
$this->end();

$this->start('tb_footer');
printf('<footer class="mastfoot"><div class="inner">&copy;%s %s</div></footer>', date('Y'), read('App.title', env('HTTP_HOST')));
$this->end('tb_footer');

$this->append('content', '</div>');
echo $this->fetch('content');
