<?php

$pageTitle = 'Updates';
require('_header.php');

$updates = Queries::getAll('updates');

foreach ($updates as $key => $update) {
	$updates[$key]->title = Output::getClean($update->title);
	$updates[$key]->update_server = Output::getClean($update->update_server);
	$updates[$key]->author = Output::getClean($update->author);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$timestamp = time();

	if (isset($_POST['action'])) {

		if ($_POST['action'] === 'createUpdate') {

			$data = [
				'title' => $_POST['updateTitle'],
				'update_server' => $_POST['updateServer'],
				'author' => $_POST['updateAuthor'],
				'createdAt' => $timestamp,
			];

			if (!Queries::create('updates', $data)) {
				Session::flash('error', 'An error occured while editing the update.');
				URL::redirect(URL::build('/admin/updates'));
			}

			Session::flash('success', 'Update has been successfully created.');
			URL::redirect(URL::build('/admin/updates'));

		} else if ($_POST['action'] === 'editUpdate') {

			if (!isset($_POST['id'])) {
				Session::flash('error', 'Update id is not specified.');
				URL::redirect(URL::build('/admin/updates'));
			}

			$update = Queries::getFirst('updates', ['id' => $_POST['id']]);
			if (!$update) {
				Session::flash('error', 'Specified update could not be found.');
				URL::redirect(URL::build('/admin/updates'));
			}

			$data = [
				'title' => $_POST['updateTitle'],
				'update_server' => $_POST['updateServer'],
				'author' => $_POST['updateAuthor'],
			];

			if (!Queries::update('updates', ['id' => $update->id], $data)) {
				Session::flash('error', 'An error occured while editing the announcement.');
				URL::redirect(URL::build('/admin/updates'));
			}

			Session::flash('success', 'Update has been successfully edited.');
			URL::redirect(URL::build('/admin/updates'));
			
		} else if ($_POST['action'] === 'deleteUpdate') {

			if (!isset($_POST['id'])) {
				Session::flash('error', 'Update id is not specified.');
				URL::redirect(URL::build('/admin/updates'));
			}

			$update = Queries::getFirst('updates', ['id' => $_POST['id']]);
			if (!$update) {
				Session::flash('error', 'Update announcement could not be found.');
				URL::redirect(URL::build('/admin/updates'));
			}

			if (!Queries::delete('updates', ['id' => $update->id])) {
				Session::flash('error', 'An error occured while deleting the announcement.');
				URL::redirect(URL::build('/admin/updates'));
			}

			Session::flash('success', 'Update has been successfully deleted.');
			URL::redirect(URL::build('/admin/updates'));

		}

	}

}

?>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="white-box">
				<h3 class="box-title">
					All Updates
					<a href="#" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#modal-new-announcement">New Update</a>
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
								<th class="border-top-0">Update Title</th>
								<th class="border-top-0">Update Description</th>
                                <th class="border-top-0">Author</th>
								<th class="border-top-0">Created At</th>
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
							<?php foreach ($updates as $update) { ?>
								<tr>
									<td>#<?php echo $update->id; ?></td>
									<td><?php echo $update->title; ?></td>
                                    <td><?php echo $update->update_server; ?></td>
                                    <td><?php echo $update->author; ?></td>
									<td><?php echo date('d M Y', $update->createdAt); ?></td>
									<td class=" text-right">
										<a href="#" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-edit-announcement-<?php echo $update->id; ?>">Edit</a>
										<a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-delete-announcement-<?php echo $update->id; ?>">Delete</a>
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
						<label for="update-title">Update Title</label>
						<input type="text" name="updateTitle" id="update-title" class="form-control" requred>
					</div>
					<div class="form-group">
						<label for="update-server">Update Server</label>
						<input type="text" name="updateServer" id="update-server" class="form-control" requied>
					</div>
					<div class="form-group">
						<label for="update-author">Author</label>
						<input type="text" name="updateAuthor" id="update-author" class="form-control" requred>
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="action" value="createUpdate">
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>
			</form>
		</div>
	</div>
</div>

<?php foreach ($updates as $update) { ?>
	<div class="modal fade" id="modal-edit-announcement-<?php echo $update->id; ?>">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Edit Update #<?php echo $update->id; ?></h4>
					<button type="button" class="close" data-dismiss="modal">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="" method="post">
					<div class="modal-body">
						<div class="form-group">
							<label for="update-title-<?php echo $update->id; ?>">Update Title</label>
							<input type="text" name="updateTitle" id="update-title-<?php echo $update->id; ?>" class="form-control" value="<?php echo $update->title; ?>" required>
						</div>
						<div class="form-group">
							<label for="update-server-<?php echo $update->id; ?>">Update Server</label>
							<input type="text" name="updateServer" id="update-server-<?php echo $update->id; ?>" class="form-control" value="<?php echo $update->update_server; ?>" required>
						</div>
						<div class="form-group">
							<label for="update-author-<?php echo $update->id; ?>">Author</label>
							<input type="text" name="updateAuthor" id="update-author-<?php echo $update->id; ?>" class="form-control" value="<?php echo $update->author; ?>" required>
						</div>
					</div>
					<div class="modal-footer">
						<input type="hidden" name="action" value="editUpdate">
						<input type="hidden" name="id" value="<?php echo $update->id; ?>">
						<button type="submit" class="btn btn-primary">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="modal fade" id="modal-delete-announcement-<?php echo $update->id; ?>">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Delete Update #<?php echo $update->id; ?></h4>
					<button type="button" class="close" data-dismiss="modal">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="" method="post">
					<div class="modal-body">
						Are you sure want to delete this update?
					</div>
					<div class="modal-footer">
						<input type="hidden" name="action" value="deleteUpdate">
						<input type="hidden" name="id" value="<?php echo $update->id; ?>">
						<button type="submit" class="btn btn-primary">Confirm</button>
					</div>
				</form>
			</div>
		</div>
	</div>
<?php } ?>

<?php

require('_footer.php');