<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');

class MY_Controller extends CI_Controller {

    /**
    * @param: $data
    * @description: dados/informações passados para as views
    */
    public $data = array();


    /**
     * @param: $title 
     * @description: title of page
     */
    private $title = "";

    /**
     * @param: $menu
     * @description: menu a ser usado em permissios
     */
    private $menu = "";

    /**
     * @param: $view
     * @description: view a ser exibida
     */
    private $view = "";


    public function __construct()
    {
        parent::__construct();

        $this->load->library('template');

        $this->set_menu('site');
    }


    // public function admin()
    // {
    //     if( $this->session->userdata('logged')) 
    //     {
    //         $this->load->library('Sessao');
    //         $router = $this->sessao->router_role_init();
            
    //         if($router)
    //         {
    //             $this->set_menu('admin');
    //             $this->template->set_layout('logged');
           
    //             $this->get_title();
    //             $this->get_menu();
    //             $this->get_view();
    //         } 
    //         else 
    //         {
    //             redirect('scheduling', 'refresh');
    //         }            
    //     } 
    //     else 
    //     {
    //         redirect('login', 'refresh');
    //     }
    // }


    public function site()
    {
        $this->get_title();
        $this->get_menu();
        $this->get_view();
    }

    protected function set_title($title)
    {
        $this->title = $title;
    }

    protected function get_title()
    {
        if($this->title === "")
        {
            $this->title = SITE_NAME  . " | " . ucfirst($this->router->class);
        }

        return $this->template->title($this->title);
    }

    protected function set_menu($menu = "")
    {
        $this->menu = $menu;
    }

 
    protected function get_menu()
    {
        $this->load->model('permissions_m');
        $menus = $this->permissions_m->get_menu($this->menu);

        $arrMenu = array();
        $rolesUser = rolesUser();

        $viewMenu = "<ul class='nav nav-justified'>";

        foreach ($menus as $menu)
        {
            if( ($menu->role_id === NULL) || ( $this->session->userdata('logged') && in_array($menu->role_id, $rolesUser) ) )
            {            
                if($menu->permission_id == 0) {
                    $arrMenu['raiz'][$menu->id] = $menu;
                } else {
                    $arrMenu[$menu->permission_id][$menu->id] = $menu;
                }
            }
        }
        
        foreach ($arrMenu['raiz'] as $id => $menu_all)
        {
            $subMenu = false;

            if( isset($arrMenu[$id]) ) 
            {
                $subMenu = true;
            }

            $classLi = $this->router->class === $menu_all->name ? 'active' : '';
            
            if($subMenu === true) $classLi.= " dropdown";

            $viewMenu.= "<li class='" . $classLi . "'>";

            if($subMenu === true) {
                $viewMenu.= "<a href='#' class='dropdown-toggle' data-toggle='dropdown'>" . $menu_all->display_name;
                $viewMenu.= "<b class='caret'></b>";
            } else {
                $viewMenu.= "<a href='" . base_url() . $menu_all->link."' title='". $menu_all->display_name."'>" . $menu_all->display_name;
            }

            $viewMenu.= "</a>";
            
            if($subMenu === true)
            {
                $viewMenu.= $this->get_submenu($arrMenu, $id);
            }
            
            $viewMenu.= "</li>";
        }

        $viewMenu.= "</ul>";
     
        $this->template->inject_partial('menu', $viewMenu);
    }


    private function get_submenu($ar, $menu_all)
    {
        $viewSubMenu = "<ul class='dropdown-menu'>";
        
        foreach ($ar[$menu_all] as $id => $menu_all) 
        {
            if($menu_all->name == 'divider')
            {
                $viewSubMenu.= "<li class='divider'></li>";    
            } 
            else if($menu_all->name == 'nav-header')
            {
                $viewSubMenu.= "<li class='nav-header'>" . $menu_all->display_name . "</li>";
            } 
            else 
            {
                $viewSubMenu.= "<li>";
                $viewSubMenu.= "<a href='".base_url() . $menu_all->link."' title='". $menu_all->display_name."'>";
                $viewSubMenu.= $menu_all->display_name;
                $viewSubMenu.= "</a>";
                
                if( isset($ar[$id]) ) 
                {
                    $viewSubMenu.= $this->monta_submenu($ar, $id);
                }
                            
                $viewSubMenu.= "</li>";
            }            
        }

        $viewSubMenu.= "</ul>";
        
        return $viewSubMenu;
    }


    protected function set_view($view)
    {
        $this->view = $view;
    }

    protected function get_view()
    {
        if($this->view === "")
        {
            $this->view = $this->router->class;
        }

        return $this->template->build($this->view, $this->data);
    }    

    
}