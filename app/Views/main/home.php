<?php $this->layout('layout', ['home' => 'Oquiz']) ?>


<div class="container">
    <h2>Bienvenue sur O'Quiz</h2>
    <p>Si vous aimez les petits animaux mignons, Star Wars, la bière, le fromage et que Linux n'a aucuns secrets pour vous ce quiz est fait pour vous. Si ce n'est pas le cas vous pouvez quand même y participer.</p>
</div>
<div class="container">

<div class="row box">
    <?php foreach ($quizzList as $currentQuizz) : ?>

    <div class="col-3 alert alert-secondary ml-2">
    <div class="text-primary font-weight-bold"><a href="<?= $router->generate('main_quiz', ['id'=>$currentQuizz->getId()]) ?>"><?= $currentQuizz->getTitle()?></a></div>
    <div class="text-dark font-weight-bold"><?= $currentQuizz->getDescription()?></div>
    <div class="text-info font-weight-bold"><?= $currentQuizz->getAuthorNameById($currentQuizz->getAuthorId())[0].''. $currentQuizz->getAuthorNameById($currentQuizz->getAuthorId())[1] ?></div>
    </div>
<?php endforeach; ?>
</div>
</div>
