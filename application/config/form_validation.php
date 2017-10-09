<?php 



$config = [

		'login_form_validation'=>[

							[
							'field' => 'username',
							'label' => 'Username',
							'rules' => 'required'
        
							],
							[
							
							'field' => 'password',
							'label' => 'Password',
							'rules' => 'required'
        
							]

		], 
		'user_registration_form_validation'=>[

							[
							
							'field' => 'username',
							'label' => 'User Name',
							'rules' => 'required|min_length[3]|is_unique[users.username]'
        
							],
							[
							
							'field' => 'email',
							'label' => 'Email',
							'rules' => 'required|valid_email|is_unique[users.email]'
        
							],
							[
							
							'field' => 'phone',
							'label' => 'Phone number',
							'rules' => 'required|is_natural|exact_length[10]'
        
							],
							[
							
							'field' => 'password',
							'label' => 'Password',
							'rules' => 'required|min_length[8]'
        
							],
							[
							
							'field' => 'retype-password',
							'label' => 'Retype password',
							'rules' => 'required|matches[password]'
        
							]
							

		],

];