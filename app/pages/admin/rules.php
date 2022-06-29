<?php

$pageTitle = 'Rules';
require('_header.php');

$rules = Queries::getAll('rules');

foreach ($rules as $key => $rule) {
	$rules[$key]->title = Output::getClean($rule->title);
	$rules[$key]->description = Output::getClean($rule->description);
	$rules[$key]->punishment = Output::getClean($rule->punishment);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$timestamp = time();

	if (isset($_POST['action'])) {

		if ($_POST['action'] === 'createRule') {

			$data = [
				'title' => $_POST['ruleTitle'],
				'description' => $_POST['ruleDescription'],
				'punishment' => $_POST['rulePunishment'],
			];

			if (!Queries::create('rules', $data)) {
				Session::flash('error', 'An error occured while editing the update.');
				URL::redirect(URL::build('/admin/rules'));
			}

			Session::flash('success', 'Rule has been successfully created.');
			URL::redirect(URL::build('/admin/rules'));

		} else if ($_POST['action'] === 'editRule') {

			if (!isset($_POST['id'])) {
				Session::flash('error', 'Rule id is not specified.');
				URL::redirect(URL::build('/admin/rules'));
			}

			$rule = Queries::getFirst('rules', ['id' => $_POST['id']]);
			if (!$rule) {
				Session::flash('error', 'Specified rule could not be found.');
				URL::redirect(URL::build('/admin/rules'));
			}

			$data = [
				'title' => $_POST['ruleTitle'],
				'description' => $_POST['ruleDescription'],
				'punishment' => $_POST['rulePunishment'],
			];

			if (!Queries::update('rules', ['id' => $rule->id], $data)) {
				Session::flash('error', 'An error occured while editing the rule.');
				URL::redirect(URL::build('/admin/rules'));
			}

			Session::flash('success', 'Rule has been successfully edited.');
			URL::redirect(URL::build('/admin/rules'));
			
		} else if ($_POST['action'] === 'deleteRule') {

			if (!isset($_POST['id'])) {
				Session::flash('error', 'Rule id is not specified.');
				URL::redirect(URL::build('/admin/rules'));
			}

			$rule = Queries::getFirst('rules', ['id' => $_POST['id']]);
			if (!$rule) {
				Session::flash('error', 'Rule could not be found.');
				URL::redirect(URL::build('/admin/rules'));
			}

			if (!Queries::delete('rules', ['id' => $rule->id])) {
				Session::flash('error', 'An error occured while deleting the rule.');
				URL::redirect(URL::build('/admin/rules'));
			}

			Session::flash('success', 'Rule has been successfully deleted.');
			URL::redirect(URL::build('/admin/rules'));

		}

	}

}

?>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="white-box">
				<h3 class="box-title">
					All Rules
					<a href="#" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#modal-new-announcement">New Rule</a>
				</h3>
				<?php if (Session::exists('success')) { ?>
					<div class="alert alert-success">
						<?php echo Session::flash('success'); ?>
					</div>
				<?php } ?>
				<?php if (Session::exists('error')) { ?>
					<div class="alert alert-error">
						<?php echo Session::flash('error'); ?>
					</div>
				<?php } ?>
				<div class="table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th class="border-top-0">ID</th>
								<th class="border-top-0">Rule Title</th>
                                <th class="border-top-0 text-right">Actions</th>
							</tr>
						</thead>
						<colgroup>
							<col width="50px">
							<col width="">
							<col width="180px">
							<col width="150px">
						</colgroup>
						<tbody>
							<?php foreach ($rules as $rule) { ?>
								<tr>
									<td>#<?php echo $rule->id; ?></td>
									<td><?php echo $rule->title; ?></td>
									<td class=" text-right">
										<a href="#" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-edit-announcement-<?php echo $rule->id; ?>">Edit</a>
										<a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-delete-announcement-<?php echo $rule->id; ?>">Delete</a>
									</td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modal-new-announcement">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">New Update</h4>
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="" method="post">
				<div class="modal-body">
					<div class="form-group">
						<label for="rule-title">Rule Title</label>
						<input type="text" name="ruleTitle" id="rule-title" class="form-control" requred>
					</div>
					<div class="form-group">
						<label for="rule-server">Rule Description</label>
                        <textarea name="ruleDescription" id="rule-server" class="form-control" rows="10" requied></textarea>
					</div>
					<div class="form-group">
						<label for="rule-author">Rule Punishment</label>
						<input type="text" name="rulePunishment" id="rule-author" class="form-control" requred>
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="action" value="createRule">
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>
			</form>
		</div>
	</div>
</div>

<?php foreach ($rules as $rule) { ?>
	<div class="modal fade" id="modal-edit-announcement-<?php echo $rule->id; ?>">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Edit Update #<?php echo $rule->id; ?></h4>
					<button type="button" class="close" data-dismiss="modal">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="" method="post">
					<div class="modal-body">
						<div class="form-group">
							<label for="update-title-<?php echo $rule->id; ?>">Ruke Title</label>
							<input type="text" name="ruleTitle" id="update-title-<?php echo $rule->id; ?>" class="form-control" value="<?php echo $rule->title; ?>" required>
						</div>
						<div class="form-group">
							<label for="rule-description-<?php echo $rule->id; ?>">Rule Description</label>
                            <textarea name="ruleDescription" id="rule-description-<?php echo $rule->id; ?>" class="form-control" rows="10" required><?php echo $rule->description; ?></textarea>
						</div>
						<div class="form-group">
							<label for="update-author-<?php echo $rule->id; ?>">Punishment</label>
							<input type="text" name="rulePunishment" id="update-author-<?php echo $rule->id; ?>" class="form-control" value="<?php echo $rule->punishment; ?>" required>
						</div>
					</div>
					<div class="modal-footer">
						<input type="hidden" name="action" value="editRule">
						<input type="hidden" name="id" value="<?php echo $rule->id; ?>">
						<button type="submit" class="btn btn-primary">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>    
	<div class="modal fade" id="modal-delete-announcement-<?php echo $rule->id; ?>">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Delete Update #<?php echo $rule->id; ?></h4>
					<button type="button" class="close" data-dismiss="modal">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="" method="post">
					<div class="modal-body">
						Are you sure want to delete this rule?
					</div>
					<div class="modal-footer">
						<input type="hidden" name="action" value="deleteRule">
						<input type="hidden" name="id" value="<?php echo $rule->id; ?>">
						<button type="submit" class="btn btn-primary">Confirm</button>
					</div>
				</form>
			</div>
		</div>
	</div>
<?php } ?>

<?php

require('_footer.php');