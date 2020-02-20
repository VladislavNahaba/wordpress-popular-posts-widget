<?php
print '<ul>';
foreach ($template_data as $data) {
	print '<li class="popular-post-item">';
	print '<a href="' . $data['link'] . '">';
	print '<img src="' . $data['image_link'] . '" alt="' . $data['title'] . '" />';
	print '</a>';
	print '<div class="popular-post-item-description">Комментариев: ' . $data['comments_number'];
	print '<span class="popular-post-item-leave-comment"><a href="' . $data['comments_link'] . '">Оставить комментарией</a></span>';
	print '</div>';
	print '</li>';
}
print '</ul>';
