<label name="name">City :</label>                        
<?php 
					  echo $this->Form->input('User.city',array('type'=>'select','div'=>false,'label'=>false,'class'=>'text_style','options' => $cities ,'empty' => 'Select City','default' => 'empty','id'=>'city'));?>
					 