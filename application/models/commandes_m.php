<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Commandes_m extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_all_cmd() {
        // $q = $this->db->select('*')->from('produit')->order_by('IDproduit','desc')->get();
        $q = $this->db->query("SELECT IDcommande,(select designation from up_produit where IDproduit=(select IDproduit from up_a_pour where IDcommande = up_commande.IDcommande)) as nomProd,date_commande,(select date_debut from up_semaine where IDsemaine = up_commande.IDsemaine) as debutSemaineCmd,prix_total,IDutilisateur,IDlieu,(select description from up_lieu where IDlieu =up_commande.IDlieu) as IDlieuDes,IDsemaine,(select validationAdmin from up_a_pour where IDcommande = up_commande.IDcommande ) as validationStatus from up_COMMANDE ");
        if ($q->num_rows()>0) {
            foreach ($q->result() as $row) {
                $data[] = $row;
            }
        }
        return $data;
    }

    function get_all_cmd_in_obj() {
        // $q = $this->db->select('*')->from('produit')->order_by('IDproduit','desc')->get();
        $tags = $this->db->query("SELECT IDcommande,date_commande,prix_total,IDutilisateur,(select nom from up_utilisateur where IDutilisateur =up_commande.IDutilisateur)
        as IDutilisateurDes,IDlieu,(select description from up_lieu where IDlieu =up_commande.IDlieu) as IDlieuDes,IDsemaine,(select validationAdmin from up_a_pour where IDcommande = up_commande.IDcommande ) as IDsemaineDes from up_COMMANDE  ");
        $dropdowns = $tags->result();
        foreach ($dropdowns as $dropdown)
        {
            $dropdownlist[$dropdown->IDproduit] = $dropdown->designation;

        }
        $finaldropdown = $dropdownlist;
        return $finaldropdown;
    }
    function get_all()
    {
        $tags = $this->db->query("select distinct * from up_produit where disponible=1");
        $dropdowns = $tags->result();
        foreach ($dropdowns as $dropdown)
        {
            $dropdownlist[$dropdown->IDproduit] = $dropdown->designation;

        }
        $finaldropdown = $dropdownlist;
        return $finaldropdown;
    }
//    function getuser(){
//        $q = $this->db->query("select nom from utilisateur" );
//
//        return $q->result_array();
//    }
//
//    function getlieu(){
//        $q = $this->db->query('select description from lieu' );
//
//        return $q->result_array();
//    }
//
//    function getsemaine(){
//        $q = $this->db->query('select IDsemaine from semaine' );
//
//        return $q->result_array();
//    }
    function get_dropdown_products()
    {
        $tags = $this->db->query("select distinct IDproduit,designation from up_produit where disponible=1 ");
        $dropdowns = $tags->result();
        foreach ($dropdowns as $dropdown)
        {
            $dropdownlist[$dropdown->IDproduit] = $dropdown->designation;
        }
        $finaldropdown = $dropdownlist;
        return $finaldropdown;
    }

    function get_products_type_table()
    {
       $result = $this->db->query("select distinct code_produit,designation,(select designation from up_type_prix where IDtype_prix = up_produit.IDtype_prix) as typePrix from up_produit where disponible=1 ");
        foreach ($result->result() as $row) {
            $data[] = $row;
        }

        return $data;
    }



    function get_dropdown_users()
    {
        $tags = $this->db->query("select distinct IDutilisateur,nom from up_utilisateur ");
        $dropdowns = $tags->result();
        foreach ($dropdowns as $dropdown)
        {
            $dropdownlist[$dropdown->IDutilisateur] = $dropdown->nom;
        }
        $finaldropdown = $dropdownlist;
        return $finaldropdown;
}
    function get_dropdown_lieu()
    {
        $tags = $this->db->query("select distinct IDlieu,description from up_lieu");
        $dropdowns = $tags->result();
        foreach ($dropdowns as $dropdown)
        {
            $dropdownlist[$dropdown->IDlieu] = $dropdown->description;
        }
        $finaldropdown = $dropdownlist;
        return $finaldropdown;
    }

    function get_dropdown_semaine()
    {
        $tags = $this->db->query("select IDsemaine,date_debut,date_fin,valide from up_semaine where valide='En cours'");
        $dropdowns = $tags->result();
        foreach ($dropdowns as $dropdown)
        {
            $dropdownlist[$dropdown->IDsemaine] = $dropdown->date_debut;

        }
        $finaldropdown = $dropdownlist;
        return $finaldropdown;
    }



    function get_all_cmd_from_user($nomUser) {
        // $q = $this->db->select('*')->from('produit')->order_by('IDproduit','desc')->get();
//        $q = $this->db->query("SELECT IDcommande,date_commande,prix_total,IDutilisateur,IDlieu,(select description from lieu where IDlieu =commande.IDlieu) as IDlieuDes,IDsemaine,(select validationAdmin from a_pour where IDcommande = commande.IDcommande ) as validationStatus from COMMANDE where IDutilisateur = (select IDutilisateur from utilisateur where nom='".$nomUser."') ORDER BY date_commande DESC");
        $q = $this->db->query("SELECT IDcommande,(select designation from up_produit where IDproduit=(select IDproduit from up_a_pour where IDcommande = up_commande.IDcommande)) as nomProd,date_commande,(select date_debut from up_semaine where IDsemaine = up_commande.IDsemaine) as debutSemaineCmd,prix_total,IDutilisateur,IDlieu,(select description from up_lieu where IDlieu =up_commande.IDlieu) as IDlieuDes,IDsemaine,(select validationAdmin from up_a_pour where IDcommande = up_commande.IDcommande ) as validationStatus from up_COMMANDE where IDutilisateur = (select IDutilisateur from up_utilisateur where nom='".$nomUser."') ORDER BY debutSemaineCmd DESC");

        if ($q->num_rows()>0) {
            foreach ($q->result() as $row) {
                $data[] = $row;
            }
        }else{
            $data[]="vide";
        }

        return $data;
    }

    function verifier_semaine($semaine){
        $ifSemaineValide = $this->db->query("SELECT valide FROM up_semaine WHERE IDsemaine =".$semaine);
        foreach ($ifSemaineValide->result_array() as $row) //Iterate through results
        {
            $validite = $row['valide'];
        }

        if($validite == 'En cours'){
            $isValid = 1;
        }else if($validite == 'Terminé'){
           $isValid = 0;
        }

        return $isValid;
    }

    function creer_commande($semaine,$data,$data2) {
        $ifSemaineValide = $this->db->query("SELECT valide FROM up_semaine WHERE IDsemaine =".$semaine);
        foreach ($ifSemaineValide->result_array() as $row) //Iterate through results
        {
            $validite = $row['valide'];
        }

        if($validite == 'En cours'){

            $this->db->insert('commande', $data);


            $nbid = $this->db->query("SELECT IDcommande FROM up_commande ORDER BY IDcommande DESC limit 1");
            foreach ($nbid->result_array() as $row) //Iterate through results
            {
                $nb = $row['IDcommande'];
            }

            // obtenir prix du produit
            $idproduit = $this->db->query("select prix from up_produit where produit.IDproduit = ".$data2['IDproduit']);
            foreach ($idproduit->result_array() as $row) //Iterate through results
            {

                $prix = $row['prix'];
            }

            // obtenir type prix du produit
            $tprod = $this->db->query("select type_prix.designation from up_type_prix,up_produit where up_produit.IDtype_prix = up_type_prix.IDtype_prix and  up_produit.IDproduit= ".$data2['IDproduit']);
            foreach ($tprod->result_array() as $row) //Iterate through results
            {
                $tp = $tprod->row(1);
                $tp = $row['designation'];
            }

            // insertion dans apour
            $this->db->query("insert into up_a_pour values (".$nb.",".$data2['IDproduit'].",".$data2['quantite'].",".$prix.",'".$tp."' ,0)");




        }else if($validite == 'Terminé'){
            echo("Semaine terminée");
        }


        }
/*
    function ajouter_a_pour($data){
        $this->db->insert('a_pour', $data);
    } */

    function ajouterLieu($nomLieu){
        /*$nb=787;
        if($this->db->query("insert into lieu values (null,'".$nomLieu."')"))
        {*/
        $nb=0;
            $idlieu = $this->db->query("select IDlieu from up_lieu where description='".$nomLieu."' limit 1");
            if($idlieu->result_array() == null){
                $this->db->query("insert into up_lieu values (null,'".$nomLieu."')");
                $idlieu = $this->db->query("select IDlieu from up_lieu where description='".$nomLieu."' limit 1");


        foreach ($idlieu->result_array() as $row) //Iterate through results
            {
                $nb = $row['IDlieu'];

            }
            // Code here after successful insert
        /*}else{*/
        }
        return $nb;

    }

    function get_id_user_for_cmd($nom){
        $nb = 1;
        $iduser = $this->db->query("select IDutilisateur from up_utilisateur where nom='".$nom."' limit 1");
        foreach ($iduser->result_array() as $row) //Iterate through results
        {
            $nb = $row['IDutilisateur'];

        }

        return $nb;
    }
//test pour commit
    function validation_cmd($idCmd){
        $res1 = $this->db->query("UPDATE up_a_pour SET validationAdmin = 1 WHERE IDcommande =".$idCmd);

        return $res1;
    }

    function suppression_cmd($idCmd){
        $this->db->query("DELETE FROM up_a_pour WHERE IDcommande = ".$idCmd." ");
        $res1 = $this->db->query("DELETE FROM up_commande WHERE IDcommande = ".$idCmd." ");
        return $res1;


    }

    function getPrixArticle($idprod){
        $nb=1;
        $res = $this->db->query("SELECT prix from up_produit where IDproduit=".$idprod." limit 1");
        foreach ($res->result_array() as $row) //Iterate through results
        {
            $nb = $row['prix'];

        }

        return $nb;
    }

    function getTableCmdFromLieu($lieu){
        $q = $this->db->query("SELECT IDcommande,(select designation from up_produit where IDproduit=(select IDproduit from up_a_pour where IDcommande = up_commande.IDcommande)) as nomProd,date_commande,(select date_debut from up_semaine where IDsemaine = up_commande.IDsemaine) as debutSemaineCmd,prix_total,IDutilisateur,IDlieu,(select description from up_lieu where IDlieu =up_commande.IDlieu) as IDlieuDes,IDsemaine,(select validationAdmin from up_a_pour where IDcommande = up_commande.IDcommande ) as validationStatus from up_COMMANDE where IDlieu=".$lieu." ORDER BY debutSemaineCmd DESC");
        $q = $this->db->query("SELECT IDcommande,(select designation from up_produit where IDproduit=(select IDproduit from up_a_pour where IDcommande = up_commande.IDcommande)) as nomProd,date_commande,(select date_debut from up_semaine where IDsemaine = up_commande.IDsemaine) as debutSemaineCmd,prix_total,IDutilisateur,IDlieu,(select description from up_lieu where IDlieu =up_commande.IDlieu) as IDlieuDes,IDsemaine,(select validationAdmin from up_a_pour where IDcommande = up_commande.IDcommande ) as validationStatus from up_COMMANDE where IDlieu=".$lieu." ORDER BY debutSemaineCmd DESC");

        if ($q->num_rows()>0) {
            foreach ($q->result() as $row) {
                $data[] = $row;
            }
        }else{
            $data[]="vide";
        }

        return $data;
    }
}
    