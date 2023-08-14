<!-- create the modal delete -->
<div class="modal fade" id="deleteModal<?php echo $IDcli?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this item?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <!-- create a form with a hidden input for the item ID -->
        <form method="POST">
            <input type="hidden" name="codeit" value="<?php echo $IDcli?>">
            <button type="submit" name="delete" class="btn btn-danger">Supprimer</button>

        </form>
  
        <?php
                include 'DATA_connect.php';
                
                 if (isset($_POST['codeit'])){
                
                    $idd = $_POST['codeit'];
                    $query2 = "DELETE FROM Client WHERE IDcli = $idd";
                    $resultat2 = mysqli_query($connex, $query2);
                }
        ?>

      </div>
    </div>
  </div>
</div>

<!-- <td>
              <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#deleteModal<?php echo $row['IDcli']?>">Delete</button>
                 
            </td>  -->