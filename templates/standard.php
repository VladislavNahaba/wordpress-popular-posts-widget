<?php
foreach ($template_data as $data) {
	print '<div>' . $data['title'] .'</div>';
	print '<div>' . $data['description'] .'</div>';
}
