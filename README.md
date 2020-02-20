"# wordpress-popular-posts-widget"

What's this?

This plugin allows to get the most popular posts at your site. You can configure it and get most popular by comments, views, authors, categories etc.

How to use:

1. Copy this to your plugins folder and activate in plugins menu in wordpress admin panel.
2. Go to widgets menu in admin panel and add this widget at sidebar, for example.
3. Configure it.
4. Profit!

If you want to add your own templates. You need to create php file in 'templates' folder with your own markup.

Templates variables:

$template_data: global template data. Do it in cycle to get needed variables.

1. $template_data["link"] - link to the post.
2. $template_data["title"] - title of the post.
3. $template_data["image_link"] - link to the post image.
4. $template_data["description"] - text description of the post.
5. $template_data["comments_number"] - number of comments.
6. $template_data["comments_link"] - anchor to post comments.
7. $template_data["date_w3c"] - creation date of the post in W3C format.
8. $template_data["date"] - creation date of the post in dd.mm.yyyy format.
