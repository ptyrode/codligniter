<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Secondaires_c extends CI_Controller
{

    public function index()
    {
        $data = array(
            'contenu' => "admin/secondaires_v",
            'categories' => $this->secondaires_m->get_categories(),
            'droits' => $this->secondaires_m->get_droits(),
            'lieux' => $this->secondaires_m->get_lieux(),
            'origines' => $this->secondaires_m->get_origines(),
            'semaines' => $this->secondaires_m->get_semaines(),
            'utilisateurs' => $this->secondaires_m->get_utilisateurs()
        );

        $this->load->view('template/admin/content', $data);
    }

    public function ajout_categorie()
    {
        $this->secondaires_m->ajout_categorie($this->input->post('description'));
    }

    public function ajout_droit()
    {
        $this->secondaires_m->ajout_droit($this->input->post('description'));
    }

    public function ajout_lieu()
    {
        $this->secondaires_m->ajout_lieu($this->input->post('description'));
    }

    public function ajout_origine()
    {
        $this->secondaires_m->ajout_origine($this->input->post('description'));
    }

    public function ajout_semaine()
    {
        $this->secondaires_m->ajout_semaine($this->input->post('debut'), $this->input->post('fin'));
    }

    public function ajout_utilisateur()
    {
        $this->secondaires_m->ajout_utilisateur($this->input->post('nom'), $this->input->post('passkey'), $this->input->post('email'), $this->input->post('droit'));
    }

    public function activer_utilisateur($id)
    {
        $this->secondaires_m->activer_utilisateur($id);
        redirect('admin/secondaires_c/');
    }

    public function desactiver_utilisateur($id)
    {
        $this->secondaires_m->desactiver_utilisateur($id);
        redirect('admin/secondaires_c/');
    }

    function sup_categorie($categorie)
    {
        $this->secondaires_m->sup_categorie($categorie);
        redirect('admin/secondaires_c/');
    }

    function sup_droit($droit)
    {
        $this->secondaires_m->sup_droit($droit);
        redirect('admin/secondaires_c/');
    }

    function sup_lieu($lieu)
    {
        $this->secondaires_m->sup_lieu($lieu);
        redirect('admin/secondaires_c/');
    }

    function sup_origine($origine)
    {
        $this->secondaires_m->sup_origine($origine);
        redirect('admin/secondaires_c/');
    }

    function sup_semaine($semaine)
    {
        $this->secondaires_m->sup_semaine($semaine);
        redirect('admin/secondaires_c/');
    }

}