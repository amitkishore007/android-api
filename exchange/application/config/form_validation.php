<?php 



$config = [

		'login_form_validation'=>[

							[
							'field' => 'email',
							'label' => 'Email address',
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
							
							'field' => 'name',
							'label' => 'User Name',
							'rules' => 'required|min_length[3]|is_unique[users.name]'
        
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
							
							'field' => 'retype',
							'label' => 'Retype password',
							'rules' => 'required|matches[password]'
        
							],
							[
							
							'field' => 'country_id',
							'label' => 'Country',
							'rules' => 'required|is_natural'
        
							]


		],

];