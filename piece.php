<?php
				foreach ($data as $key => $value) {
					echo '<div class="card card-inverse card-info mb-3" style="padding:1%;">					
								  <div class="card-block">';
					echo '<a class="btn btn-warning float-right" href="update.php?id=' . $value['id'] . '&act=';
					if (!empty($value['own'])) {
						echo "ap";
					} else {
						echo "indi";
					}
					echo '">Edit</a>';
					echo 	'<div class="row">
											<div class="col-6">
											<h4 class="text-center">Property Details</h4>';
					echo '<p><b>Country: </b>' . $value['country'] . '</p><p><b> State: </b>' . $value['state'] . '</p><p><b> City: </b>' . $value['city'] . '</p>';
					if ($value['image'] !== 'uploads/') {
						# code...
						echo '<img src="' . $value['image'] . '" width="200">';
					}

					echo '<p><b>Address: </b>' . $value['address'] . '</p>';

					echo '
											<div class="col-6">
											<h4>Other Details</h4>';
					echo '<p><b>Description: </b>' . $value['description'] . '</p>';
					if ($value['vacant'] == 0) {
						echo '<div class="alert alert-danger" role="alert"><p><b>Occupied</b></p></div>';
					} else {
						echo '<div class="alert alert-success" role="alert"><p><b>Vacant</b></p></div>';
					}
					echo '</div>
										</div>				      
								   </div>
								</div>';
					echo '<a class="btn btn-warning float-right" href="../app/complaint.php">Complaint</a><br><br>';
				}
