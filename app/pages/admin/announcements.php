<?php

$pageTitle = 'Announcements';
require('_header.php');

$announcements = Queries::getAll('announcements');

foreach ($announcements as $key => $announcement) {
	$announcements[$key]->title = Output::getClean($announcement->title);
	$announcements[$key]->description = Output::getClean($announcement->description);
	$announcements[$key]->contentTitle = Output::getClean($announcement->contentTitle);
	$announcements[$key]->contentDescription = Output::getClean(str_replace('<br />', "\n", $announcement->contentDescription));
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$timestamp = time();

	if (isset($_POST['action'])) {

		if ($_POST['action'] === 'createAnnouncement') {

			$data = [
				'title' => $_POST['announcementTitle'],
				'description' => $_POST['announcementDescription'],
				'contentTitle' => $_POST['announcementContentTitle'],
				'contentDescription' => $_POST['announcementContentDescription'],
				'createdAt' => $timestamp,
				'author' => 'TripleZone',
			];

			if (!Queries::create('announcements', $data)) {
				Session::flash('error', 'An error occured while editing the announcement.');
				URL::redirect(URL::build('/admin/announcements'));
			}

			Session::flash('success', 'Announcement has been successfully created.');
			URL::redirect(URL::build('/admin/announcements'));

		} else if ($_POST['action'] === 'editAnnouncement') {

			if (!isset($_POST['id'])) {
				Session::flash('error', 'Announcement id is not specified.');
				URL::redirect(URL::build('/admin/announcements'));
			}

			$announcement = Queries::getFirst('announcements', ['id' => $_POST['id']]);
			if (!$announcement) {
				Session::flash('error', 'Specified announcement could not be found.');
				URL::redirect(URL::build('/admin/announcements'));
			}

			$data = [
				'title' => $_POST['announcementTitle'],
				'description' => $_POST['announcementDescription'],
				'contentTitle' => $_POST['announcementContentTitle'],
				'contentDescription' => str_replace("\n", '<br />', $_POST['announcementContentDescription']),
				'author' => 'TripleZone',
			];

			if (!Queries::update('announcements', ['id' => $announcement->id], $data)) {
				Session::flash('error', 'An error occured while editing the announcement.');
				URL::redirect(URL::build('/admin/announcements'));
			}

			Session::flash('success', 'Announcement has been successfully edited.');
			URL::redirect(URL::build('/admin/announcements'));
			
		} else if ($_POST['action'] === 'deleteAnnouncement') {

			if (!isset($_POST['id'])) {
				Session::flash('error', 'Announcement id is not specified.');
				URL::redirect(URL::build('/admin/announcements'));
			}

			$announcement = Queries::getFirst('announcements', ['id' => $_POST['id']]);
			if (!$announcement) {
				Session::flash('error', 'Specified announcement could not be found.');
				URL::redirect(URL::build('/admin/announcements'));
			}

			if (!Queries::delete('announcements', ['id' => $announcement->id])) {
				Session::flash('error', 'An error occured while deleting the announcement.');
				URL::redirect(URL::build('/admin/announcements'));
			}

			Session::flash('success', 'Announcement has been successfully deleted.');
			URL::redirect(URL::build('/admin/announcements'));

		}

	}

}

?>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="white-box">
				<h3 class="box-title">
					All Announcements
					<a href="#" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#modal-new-announcement">New Announcement</a>
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
								<th class="border-top-0">Announcement Title</th>
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
							<?php foreach ($announcements as $announcement) { ?>
								<tr>
									<td>#<?php echo $announcement->id; ?></td>
									<td><?php echo $announcement->title; ?></td>
									<td><?php echo date('d M Y', $announcement->createdAt); ?></td>
									<td class=" text-right">
										<a href="#" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-edit-announcement-<?php echo $announcement->id; ?>">Edit</a>
										<a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-delete-announcement-<?php echo $announcement->id; ?>">Delete</a>
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
				<h4 class="modal-title">New Announcement</h4>
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="" method="post">
				<div class="modal-body">
					<div class="form-group">
						<label for="announcement-title">Announcement Title</label>
						<input type="text" name="announcementTitle" id="announcement-title" class="form-control" requred>
					</div>
					<div class="form-group">
						<label for="announcement-description-">Announcement Description</label>
						<input type="text" name="announcementDescription" id="announcement-description" class="form-control" requied>
					</div>
					<div class="form-group">
						<label for="announcement-content-title">Content Title</label>
						<input type="text" name="announcementContentTitle" id="announcement-content-title" class="form-control" requred>
					</div>
					<div class="form-group">
						<label for="announcement-content-description">Content Description</label>
						<textarea name="announcementContentDescription" id="announcement-content-description" class="form-control" rows="10" requied></textarea>
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="action" value="createAnnouncement">
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>
			</form>
		</div>
	</div>
</div>

<?php foreach ($announcements as $announcement) { ?>
	<div class="modal fade" id="modal-edit-announcement-<?php echo $announcement->id; ?>">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Edit Announcement #<?php echo $announcement->id; ?></h4>
					<button type="button" class="close" data-dismiss="modal">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="" method="post">
					<div class="modal-body">
						<div class="form-group">
							<label for="announcement-title-<?php echo $announcement->id; ?>">Announcement Title</label>
							<input type="text" name="announcementTitle" id="announcement-title-<?php echo $announcement->id; ?>" class="form-control" value="<?php echo $announcement->title; ?>" required>
						</div>
						<div class="form-group">
							<label for="announcement-description-<?php echo $announcement->id; ?>">Announcement Description</label>
							<input type="text" name="announcementDescription" id="announcement-description-<?php echo $announcement->id; ?>" class="form-control" value="<?php echo $announcement->description; ?>" required>
						</div>
						<div class="form-group">
							<label for="announcement-content-title-<?php echo $announcement->id; ?>">Content Title</label>
							<input type="text" name="announcementContentTitle" id="announcement-content-title-<?php echo $announcement->id; ?>" class="form-control" value="<?php echo $announcement->contentTitle; ?>" required>
						</div>
						<div class="form-group">
							<label for="announcement-content-description-<?php echo $announcement->id; ?>">Content Description</label>
							<textarea name="announcementContentDescription" id="announcement-content-description-<?php echo $announcement->id; ?>" class="form-control" rows="10" required><?php echo $announcement->contentDescription; ?></textarea>
						</div>
					</div>
					<div class="modal-footer">
						<input type="hidden" name="action" value="editAnnouncement">
						<input type="hidden" name="id" value="<?php echo $announcement->id; ?>">
						<button type="submit" class="btn btn-primary">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="modal fade" id="modal-delete-announcement-<?php echo $announcement->id; ?>">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Delete Announcement #<?php echo $announcement->id; ?></h4>
					<button type="button" class="close" data-dismiss="modal">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="" method="post">
					<div class="modal-body">
						Are you sure want to delete this announcement?
					</div>
					<div class="modal-footer">
						<input type="hidden" name="action" value="deleteAnnouncement">
						<input type="hidden" name="id" value="<?php echo $announcement->id; ?>">
						<button type="submit" class="btn btn-primary">Confirm</button>
					</div>
				</form>
			</div>
		</div>
	</div>
<?php } ?>

<?php

require('_footer.php');