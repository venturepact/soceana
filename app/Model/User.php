<?php
/*
* @ User Model class
* 
*/
class User extends AppModel{
    
    public $name = 'User';    
  
    
    var $hasAndBelongsToMany = array(
        'ServiceType' => array(
            'className' => 'ServiceType',
            'joinTable' => 'user_service_types',
            'foreignKey' => 'user_id',
            'associationForeignKey' => 'service_type_id',
        ),
    );  
    
    
    
    public function beforeSave($options = array()){
        if(isset($this->data[$this->alias]['password'])){
            $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
        }
        return true;
    }
}
?>