<?php

$this->layout("layout", [
    'bodyClass' => '',
    'title' => 'Registrar :: Goteo.org',
    'meta_description' => $this->text('meta-description-discover')
    ]);

$this->section('content');
?>
<div class="container">

	<div class="row row-form">
			<div class="panel panel-default panel-form">
				<div class="panel-body">
					<h2 class="col-md-offset-1 padding-bottom-6">Registrar</h2>

                    <?= $this->supply('sub-header', $this->get_session('sub-header')) ?>

					<form class="form-horizontal" role="form" method="post" action="/signup?return=<?= $return ?>">

						<div class="form-group">
							<div class="col-md-10 col-md-offset-1">
								<input type="input" class="form-control" placeholder="<?= $this->text('register-name-field') ?>" name="username" value="<?= $this->username ?>" required>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-10 col-md-offset-1">
								<input type="email" class="form-control" placeholder="<?= $this->text('register-email-field') ?>" name="email" value="<?= $this->email ?>" required>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-10 col-md-offset-1">
								<input type="email" class="form-control" placeholder="<?= $this->text('register-email-confirm-field') ?>" name="remail" value="<?= $this->remail ?>" required>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-10 col-md-offset-1">
								<input type="input" class="form-control" placeholder="<?= $this->text('register-id-field') ?>" name="userid" value="<?= $this->userid ?>" required>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-10 col-md-offset-1">
								<input type="password" class="form-control" placeholder="<?= $this->text('register-password-field') ?>" name="password" value="" required>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-10 col-md-offset-1">
								<input type="password" class="form-control" placeholder="<?= $this->text('register-password-confirm-field') ?>" name="rpassword" value="" required>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-10 col-md-offset-1">
								<div class="checkbox">
									<label>
										<input type="checkbox" class="no-margin-checkbox" name="remember">
											<p class="label-checkbox">
											<?= $this->text('login-register-conditions') ?>
											</p>
									</label>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-10 col-md-offset-1">
								<button type="submit" class="btn btn-success">Regístrate</button>
								<a class="btn btn-link" href="/login?return=<?= urlencode($this->get_query('return')) ?>">¿Ya estás registrado?</a>
							</div>
						</div>

						<hr>

                        <?= $this->insert('auth/partials/social_login') ?>

					</form>


				</div>
			</div>
	</div>
</div>

<?php $this->replace() ?>