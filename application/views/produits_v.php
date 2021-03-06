<div class="jumbotron">
    <h2>Tous les produits</h2>
</div>

<div class="container" id="body">
    <div class="row">
        <?php if ($produits != null): ?>
            <table class="table table-striped table-hover table-bordered">
                <th>Identifiant du produit</th><th>Designation</th><th>Commentaire</th><th>Prix</th><th>Code produit (balance)</th><th>Type prix</th><th>Origine</th><th>Categorie</th><th>Disponible</th>
                <?php foreach ($produits as $r): ?>
                    <tr>
                        <td><?= $r->IDproduit ?></td>
                        <td><?= $r->designation ?></td>
                        <td><?= $r->commentaire ?></td>
                        <td><?= $r->prix ?>€</td>
                        <td><?= $r->code_produit ?></td>


                        <td><?= $r->IDtype_prixDes ?></td>
                        <td><?= $r->IDorigineDes ?></td>
                        <td><?= $r->IDcategorieDes ?></td>
                        <?php if($r->disponible == 1){ $dispo=1;?>
                                                       <td >  <?php echo "Oui"; ?> </td>

                        <?php } else { $dispo=0; ?>
                                                        <td>  <?php echo "Non"; ?> </td>
                        <?php } ?>
                        <?php
                        if($nomUtil['IDdroit'] == 1){ ?>
                            <td><a href="<?php echo site_url('admin/produits_c/modif_produit/' . $r->IDproduit.'/'.$r->IDtype_prix.'/'.$r->IDorigine.'/'.$r->IDcategorie ) ?>">Modifier</a></td>
                            <td><a onclick="return confirm('Etes vous sur ?')" href="<?php echo site_url('admin/produits_c/suppr_produit/' . $r->IDproduit) ?>">Supprimer</a></td>
                        <?php }else{
                              if($dispo==1){      ?>
                            <td><a href="<?php echo site_url('client/commandes_c/nouvelle_commande/' . $r->IDproduit ) ?>">Commander</a></td>

                           <?php }else{ ?>
                                  <td><label>Produit non disponible</label></a></td>


                      <?php } }; ?>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>

    </div>
</div>