jQuery(function( $ ) {
  $(document).ready(
    $(document).on('ready widget-updated widget-added', function (event, widget) {
      handle_widget_updated('.widget-popular-posts');
    })
  );
  function handle_widget_updated(selector) {
    $(selector + ' .popular-posts-select').select2();

    $(selector + ' .popular-posts-category').select2();

    $(selector + ' .popular-posts-tag').select2();

    $(selector + ' .popular-posts-author').select2();

    $(selector + ' .popular-posts-template').select2();

    $(selector + ' .popular-posts-post').select2({
      ajax: {
        url: ajaxurl + '?action=popular_posts_widget',
        dataType: 'json',
        delay: 250
      },
      minimumInputLength: 3
    });

  }
});
