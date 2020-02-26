<?php
print '<ul>';
foreach ($template as $data) {
	print '<li class="popular-post-item">';
	print '<a href="' . $data['link'] . '"><div class="popular-post-item-title">' . $data['title'] .'</div></a>';
	print '<div class="popular-post-item-description">' . $data['description'] .'</div>';
	print '<div class="popular-post-item-date">Дата создания: ' . $data['date'] . '</div>';
	print '</li>';
}
print '</ul>';
