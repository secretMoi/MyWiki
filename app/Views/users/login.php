<?php if($errors): ?>

<div class="alert alert-danger">
	Identifiants incorrects
</div>

<?php endif; ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-8 align-self-center">
            <form method="post">
                <?= $form->hidden('pagePrec', $_SERVER['HTTP_REFERER']); ?>
		        <?= $form->input('username', 'Pseudo'); ?>
		        <?= $form->input('password', 'Mot de passe', ['type' => 'password']); ?>
                <button class="btn btn-primary">Envoyer</button>
            </form>
        </div>
    </div>
</div>

