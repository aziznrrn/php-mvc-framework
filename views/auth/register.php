<h1 class="mb-4">Register an Account</h1>

<?php $form = \app\core\Form::begin('/register', 'POST', ['class' => 'form'], $model) ?>
<?php $form->field('text', 'name', 'Name', '', 'Your name', ['class' => 'form-control']) ?>
<?php $form->field('email', 'email', 'Email', '', 'Your email', ['class' => 'form-control']) ?>
<?php $form->field('password', 'password', 'Password', '', 'Your password', ['class' => 'form-control']) ?>
<?php $form->field('password', 'password_confirmation', 'Confirm Password', '', 'Confirm your password', ['class' => 'form-control']) ?>
<?php \app\core\Form::button('submit', '', 'Register', ['class' => 'btn btn-primary']) ?>
<?php $form->end() ?>