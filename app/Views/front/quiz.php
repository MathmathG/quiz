<?php $this->layout('layout') ?>

<div class="w-100 p-3">

</div>
<div class="container">
    <div class="row box">
        <div class="col-4">
<div class="text-primary font-weight-bold"><?= $quizz->getTitle()?></div><span class="badge badge-success"></span>
<div class="text-dark font-weight-bold"><?= $quizz->getDescription()?></div>
<div class="text-dark font-weight-bold"><?= $quizz->getAuthorNameById($quizz->getAuthorId())[0].' '. $quizz->getAuthorNameById($quizz->getAuthorId())[1] ?></div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row box">
<?php foreach ($questionsList as $currentQuestion) : ?>
    <div class="col-3 alert alert-secondary ml-2 ">
        <div class="text-primary font-weight-bold alert alert-info"><?= $currentQuestion->getQuestion()?></div>

        <ol>
        <!-- Get Mixed Props and display it -->
        <?php foreach($currentQuestion->getMixedProps() as $key => $value) : ?>
          <?php if(isset($value['prop1'])) : ?>
            <li><?= $value['prop1'] ?></li>
          <?php elseif(isset($value['prop2'])) : ?>
            <li><?= $value['prop2'] ?></li>
          <?php elseif(isset($value['prop3'])) : ?>
            <li><?= $value['prop3'] ?></li>
          <?php elseif(isset($value['prop4'])) : ?>
            <li><?= $value['prop4'] ?></li>
          <?php endif; ?>
        <?php endforeach ?>
      </ol>

    </div>
        <?php endforeach; ?>
    </div>
</div>
