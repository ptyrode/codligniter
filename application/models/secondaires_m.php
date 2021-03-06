<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Secondaires_m extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function get_categories()
    {
        $q = $this->db->query('select * from up_categorie');
        //$q = $this->db->select('*')->from('origine')->where('IDorigine',!$ido)->order_by('IDorigine','asc')->get();
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $row) {
                $data[] = $row;
            }
        }
        return $data;
    }

    function get_droits()
    {
        $q = $this->db->query('select * from up_droit');
        //$q = $this->db->select('*')->from('origine')->where('IDorigine',!$ido)->order_by('IDorigine','asc')->get();
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $row) {
                $data[] = $row;
            }
        }
        return $data;
    }

    function get_lieux()
    {
        $q = $this->db->query('select * from up_lieu');
        //$q = $this->db->select('*')->from('origine')->where('IDorigine',!$ido)->order_by('IDorigine','asc')->get();
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $row) {
                $data[] = $row;
            }
        }
        return $data;
    }

    function get_origines()
    {
        $q = $this->db->query('select * from up_origine');
        //$q = $this->db->select('*')->from('origine')->where('IDorigine',!$ido)->order_by('IDorigine','asc')->get();
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $row) {
                $data[] = $row;
            }
        }
        return $data;
    }

    function get_semaines()
    {
        $q = $this->db->query('select * from up_semaine');
        //$q = $this->db->select('*')->from('origine')->where('IDorigine',!$ido)->order_by('IDorigine','asc')->get();
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $row) {
                $data[] = $row;
            }
        }
        return $data;
    }


    function get_utilisateurs()
    {
        $q = $this->db->query('select * from up_utilisateur');
        //$q = $this->db->select('*')->from('origine')->where('IDorigine',!$ido)->order_by('IDorigine','asc')->get();
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $row) {
                $data[] = $row;
            }
        }
        return $data;
    }

    function ajout_categorie($categorie)
    {
        $sql = "INSERT INTO up_categorie VALUES (NULL,\"" . $categorie . "\");";
        $this->db->query($sql);
    }

    function ajout_droit($droit)
    {
        $sql = "INSERT INTO up_droit VALUES (NULL,\"" . $droit . "\");";
        $this->db->query($sql);
    }

    function ajout_lieu($lieu)
    {
        $sql = "INSERT INTO up_lieu VALUES (NULL,\"" . $lieu . "\");";
        $this->db->query($sql);
    }

    function ajout_origine($origine)
    {
        $sql = "INSERT INTO up_origine VALUES (NULL,\"" . $origine . "\");";
        $this->db->query($sql);
    }

    function ajout_semaine($debut, $fin)
    {
        $debut = date('Y-m-d', strtotime($debut));
        $fin = date('Y-m-d', strtotime($fin));
        $sql = "INSERT INTO up_semaine VALUES (NULL,\"" . $debut . "\",\"" . $fin . "\",'En cours');";
        $this->db->query($sql);
    }

    function ajout_utilisateur($nom, $passkey, $email, $droit)
    {
        $sql = "INSERT INTO up_utilisateur VALUES (NULL,\"" . $nom . "\",\"" . $passkey . "\",\"" . $email . "\",\"" . $droit . "\");";
        $this->db->query($sql);
    }

    public function activer_utilisateur($id)
    {
        $sql = "UPDATE up_utilisateur SET IDdroit=2 WHERE IDutilisateur=\"" . $id . "\"";
        $this->db->query($sql);
    }

    public function desactiver_utilisateur($id)
    {
        $sql = "UPDATE up_utilisateur SET IDdroit=3 WHERE IDutilisateur=\"" . $id . "\"";
        $this->db->query($sql);
    }

    function sup_categorie($categorie)
    {
        $sql = "DELETE FROM up_categorie WHERE IDcategorie=\"" . $categorie . "\"";
        $this->db->query($sql);
    }

    function sup_droit($droit)
    {
        $sql = "DELETE FROM up_droit WHERE IDdroit=\"" . $droit . "\"";
        $this->db->query($sql);
    }

    function sup_lieu($lieu)
    {
        $sql = "DELETE FROM up_lieu WHERE IDlieu=\"" . $lieu . "\"";
        $this->db->query($sql);
    }

    function sup_origine($origine)
    {
        $sql = "DELETE FROM up_origine WHERE IDorigine\"" . $origine . "\"";
        $this->db->query($sql);
    }

    function sup_semaine($semaine)
    {
        $sql = "DELETE FROM up_semaine WHERE IDsemaine=\"" . $semaine . "\"";
        $this->db->query($sql);
    }
}