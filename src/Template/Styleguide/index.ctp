<h2>Forms</h2>

<h3>Basic example</h3>

<?php
echo $this->Form->create($basicExampleForm);
echo $this->Form->input('email');
echo $this->Form->input('password');
echo $this->Form->input('file');
echo $this->Form->input('check');
echo $this->Form->submit();
echo $this->Form->end();
?>