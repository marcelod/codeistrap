<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config = array(
  /**
   * validacao da area login
   */
  'login/send' => array(
      array('field'=>'login',
            'label'=>'Login/E-mail',
            'rules'=>'required|min_length[3]|max_length[100]|trim|addslashes|xss_clean'),
      array('field'=>'password',
            'label'=>'Senha',
            'rules'=>'required|min_length[3]|max_length[255]|trim')
  ),

  /**
   * validation register
   */
  'register/send' => array(
      array('field'=>'name',
            'label'=>'Nome',
            'rules'=>'required|min_length[3]|max_length[255]|trim|xss_clean'),
      array('field'=>'username',
            'label'=>'Login',
            'rules'=>'required|min_length[3]|max_length[100]|trim|xss_clean|is_unique[users.username]'),
      array('field'=>'email',
            'label'=>'E-mail',
            'rules'=>'required|min_length[3]|max_length[100]|trim|valid_email|is_unique[users.email]|xss_clean'),
      array('field'=>'password',
            'label'=>'Senha',
            'rules'=>'required|min_length[3]|max_length[100]|trim|matches[passwordconfirm]'),
      array('field'=>'passwordconfirm', 
            'label'=>'Confirme a Senha', 
            'rules'=>'required|min_length[3]|max_langth[100]|trim'),
      array('field'=>'gender', 
            'label'=>'Sexo', 
            'rules'=>'required|exact_length[1]')
  ),


  /**
   * validation register - codigo de confirmação
   */
  'register/send_confirmation_register' => array(
      array('field'=>'confirmation_register',
            'label'=>'Código de Confirmação',
            'rules'=>'required|max_length[200]|trim|xss_clean')
  ),


  /**
   * validation forget_password
   */
  'forget_password/send' => array(
      array('field'=>'email',
            'label'=>'E-mail',
            'rules'=>'required|valid_email|max_length[100]|trim|xss_clean')
  ),


  /**
   * validation contact
   */
  'contact/send' => array(
      array('field'=>'name',
            'label'=>'Nome',
            'rules'=>'required|min_length[3]|max_length[255]|trim|xss_clean'),
      array('field'=>'email',
            'label'=>'E-mail',
            'rules'=>'required|min_length[3]|max_length[100]|trim|valid_email|xss_clean'),
      array('field'=>'telephone',
            'label'=>'Telefone',
            'rules'=>'min_length[8]|max_length[25]|trim|xss_clean'),
      array('field'=>'message',
            'label'=>'Mensagem',
            'rules'=>'required|trim|xss_clean')
  ),


  /**
   * editar perfil
   */
  'edit_perfil/send' => array(
      array('field'=>'name',
            'label'=>'Nome',
            'rules'=>'required|min_length[3]|max_length[255]|trim|xss_clean'),
      array('field'=>'username',
            'label'=>'Login',
            'rules'=>'required|min_length[3]|max_length[100]|trim|xss_clean'),
      array('field'=>'password',
            'label'=>'Senha',
            'rules'=>'min_length[3]|max_length[100]|trim|matches[passwordconfirm]'),
      array('field'=>'passwordconfirm', 
            'label'=>'Confirme a Senha', 
            'rules'=>'min_length[3]|max_langth[100]|trim'),
      array('field'=>'gender', 
            'label'=>'Sexo', 
            'rules'=>'required|exact_length[1]'),
      array('field'=>'telephone',
            'label'=>'Telefone',
            'rules'=>'max_length[15]|trim|xss_clean'),
      array('field'=>'nickname',
            'label'=>'Apelido',
            'rules'=>'max_length[100]|trim|xss_clean'),
      array('field'=>'birthdate',
            'label'=>'Data de Aniversário',
            'rules'=>'data_br_to_us|trim|xss_clean'),
      array('field'=>'zipcode',
            'label'=>'CEP',
            'rules'=>'max_length[9]|trim|xss_clean'),
      array('field'=>'address',
            'label'=>'Endereço',
            'rules'=>'max_length[255]|trim|xss_clean'),
      array('field'=>'number',
            'label'=>'Número do endereço',
            'rules'=>'max_length[10]|trim|xss_clean'),
      array('field'=>'complement',
            'label'=>'Complemento',
            'rules'=>'max_length[100]|trim|xss_clean'),
      array('field'=>'district',
            'label'=>'Bairro',
            'rules'=>'max_length[100]|trim|xss_clean'),
      array('field'=>'state',
            'label'=>'Estado',
            'rules'=>'max_length[100]|trim|xss_clean'),
      array('field'=>'city',
            'label'=>'Cidade',
            'rules'=>'max_length[100]|trim|xss_clean')
  ),
    
  



  ############
  #ADMIN
  ############
  
  /**
   * validation register
   */
  'admin/users/send' => array(
      array('field'=>'name',
            'label'=>'Nome',
            'rules'=>'required|min_length[3]|max_length[255]|trim|xss_clean'),
      array('field'=>'username',
            'label'=>'Login',
            'rules'=>'required|min_length[3]|max_length[100]|trim|xss_clean|is_unique[users.username]'),
      array('field'=>'email',
            'label'=>'E-mail',
            'rules'=>'required|min_length[3]|max_length[100]|trim|valid_email|is_unique[users.email]|xss_clean'),
      array('field'=>'password',
            'label'=>'Senha',
            'rules'=>'required|min_length[3]|max_length[100]|trim|matches[passwordconfirm]'),
      array('field'=>'passwordconfirm', 
            'label'=>'Confirme a Senha', 
            'rules'=>'required|min_length[3]|max_langth[100]|trim'),
      array('field'=>'gender', 
            'label'=>'Sexo', 
            'rules'=>'required|exact_length[1]')
  ),


);
