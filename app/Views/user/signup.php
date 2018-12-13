<?php $this->layout('layout') ?>


<div class="container">
    <?php if (!empty($errorList)) : ?>
    <div class="alert alert-danger" role="alert">
        <?= implode('<br>', $errorList) ?>
    </div>
    <?php endif; ?>
    <div class="row">
        <form class="col-md-6 m-auto" method="post" action="" id="formLogin">
          <div class="form-group">
            <label for="exampleInputFirstName">Nom</label>
            <input type="text" name="first_name" class="form-control" id="exampleInputFirstName" placeholder="nom">
          </div>
          <div class="form-group">
            <label for="exampleInputLastName">Prénom</label>
            <input type="text" name="last_name" class="form-control" id="exampleInputLastName" placeholder="Prénom">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Adresse Email</label>
            <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="email">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Mot de passe</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="mot de passe">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword2">Confirmation</label>
            <input type="password" name="confirmPassword" class="form-control" id="exampleInputPassword2" placeholder="confirmation du mot de passe">
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
