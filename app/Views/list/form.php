<?php $this->layout('layout') ?>
<?php $score = 0 ?>
<div class="w-100 p-3">

</div>
<div class="container">
    <div class="row box">
        <div class="col-4">
<div class="text-primary font-weight-bold"><?= $quizz->getTitle()?></div><span class="badge badge-success"><?= count($questionsList) ?> questions</span>
<div class="text-dark font-weight-bold"><?= $quizz->getDescription()?></div>
<div class="text-dark font-weight-bold"><?= $quizz->getAuthorNameById($quizz->getAuthorId())[0].' '. $quizz->getAuthorNameById($quizz->getAuthorId())[1] ?></div>
        </div>
    </div>
</div>

<div class="container text-primary font-weight-bold " >
  Nouveau jeu: Répondez au maximum de questions avant de valider !
</div>

<?php foreach ($questionsList as $currentQuestion) : ?>
    <?php if (isset($_POST[$currentQuestion->getId()]) !== false) : ?>
        <?php if ($_POST[$currentQuestion->getId()] == $currentQuestion->getProp1()) : ?>
        <?php $score++ ?>
        <?php endif; ?>
    <?php endif; ?>
<?php endforeach; ?>

    <?php if (empty($_POST) !== true) : ?>
      <div class="dialog">
      <p>  Votre score <?= $score ?> / <?=sizeof($questionsList) ?></p>
      <a href="<?= $router->generate('main_quiz', ['id' => $quizz->getId()]) ?>">Rejouer</a>
      </div>
    <?php endif; ?>

    <div class="container">
    <form class="" action="" method="post">
    <div class="row justify-content-start" id="<?= $currentQuestion->getId() ?>">
        <div class="col-12 alert alert-secondary ml-3 ">
<?php foreach ($questionsList as $currentQuestion) : ?>
    <div class="questionsBlock">

    <div class="questionBox" id="<?= $currentQuestion->getId() ?>">
        <div class="upPart">
           <?php if (isset($_POST[$currentQuestion->getId()]) == true) : ?>
           <?php if ($_POST[$currentQuestion->getId()] == $currentQuestion->getProp1()) : ?><span  class="badge badge-success">true</span>
           <?php else : ?><span  class="badge badge-danger">false</span>
           <?php endif; ?>
           <?php endif; ?>
        </div>
        <div class="text-primary font-weight-bold alert alert-info"><?= $currentQuestion->getQuestion()?></div>
    </div>

    <?php shuffle ($prop[($currentQuestion->getId())-1]) ?>
    <div class="centerPart">
                    <?php if ($connectedUser !== false && empty($_POST) !== false) : ?>
                        <?php for ($i = 0; $i <= 3; $i++) : ?>
                        <div>
                            <input class="form-check-input" type="radio" name="<?= ($currentQuestion->getId()) ?>" id="Question<?= ($currentQuestion->getId()) ?>Prop<?= ($i)+1 ?>" value="<?= $prop[(($currentQuestion->getId())-1)][$i] ?>">
                            <label class="form-check-label" for="Question<?= ($currentQuestion->getId()) ?>Prop<?= ($i)+1 ?>">
                                <?= $prop[(($currentQuestion->getId())-1)][$i] ?>
                            </label>
                        </div>
                        <?php endfor; ?>
                        <?php elseif ($connectedUser !== false && empty($_POST) === false) : ?>

                <?php for ($i = 0; $i <= 3; $i++) : ?>
                <div class="form-check">
                    <label class="form-check-label
                        <?php if ( $prop[(($currentQuestion->getId())-1)][$i] === $_POST[$currentQuestion->getId()] ) : ?>
                            <?php if ($currentQuestion->getProp1() == $prop[(($currentQuestion->getId())-1)][$i]) : ?>correct
                            <?php endif; ?>
                            <?php if ($_POST[$currentQuestion->getId()] !== $currentQuestion->getProp1()) : ?>wrong
                            <?php endif; ?>
                        <?php elseif ( $prop[(($currentQuestion->getId())-1)][$i] !== $_POST[$currentQuestion->getId()] &&  $currentQuestion->getProp1() == $prop[(($currentQuestion->getId())-1)][$i] && $_POST[$currentQuestion->getId()]!== null) : ?>correct
                        <?php endif; ?>"
                    for="Question<?= ($currentQuestion->getId()) ?>Prop<?= ($i)+1 ?>">
                        <?= $prop[(($currentQuestion->getId())-1)][$i] ?>
                    </label>
                </div>
                <?php endfor; ?>

            <?php else : ?>

                <?php for ($i = 0; $i <= 3; $i++) : ?>
                  <div><?= ($i)+1 ?>.&nbsp;
                      <label class="form-check-label" for="">
                          <?= $prop[(($currentQuestion->getId())-1)][$i] ?>
                      </label>
                  </div>
                <?php endfor; ?>

            <?php endif; ?>
            </div>
            <?php if (isset($_POST[$currentQuestion->getId()]) == true) : ?>
            <div class="downPart">
                <div class="alert alert-warning">
                    <div class="anecdote"><?= $currentQuestion->getAnecdote() ?></div>
                    <div class="lienWiki">
                        <a href="https://fr.wikipedia.org/wiki/<?= $currentQuestion->getWiki() ?>"> Wikipedia(<?= $currentQuestion->getWiki() ?>)</a>
                    </div>
                </div>
            </div>
            <?php else : ?>
              <div class="">

              </div>
            <?php endif; ?>

        </div>


<?php endforeach; ?>
    </div>
    </div>
        <?php if ($connectedUser !== false) : ?>
            <?php if (empty($_POST) !== false) : ?>
            <button class="btn btn-success   id ="ok" type="submit">ok</button>
            <?php else : ?>
            <button class="btn btn-success " id ="rejouer" type="submit">rejouer</button>
            <?php endif; ?>
            <?php endif; ?>


    </form>
</div>
