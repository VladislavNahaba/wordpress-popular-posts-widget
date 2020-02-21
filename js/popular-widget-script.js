jQuery(function( $ ) {
  $(document).on('widget-updated widget-added', function(event, widget) {
    handle_widget_updated($(widget));
  });
  $(document).on('ready', function (event, widget) {
    handle_widget_updated($('#widgets-right'));
  });
  function handle_widget_updated($selector) {
    $selector.find('.popular-posts-select').select2({
      width: '100%'
    });
    $selector.find('.popular-posts-category').select2({
      width: '100%'
    });
    $selector.find('.popular-posts-tag').select2({
      width: '100%'
    });
    $selector.find('.popular-posts-author').select2({
      width: '100%'
    });
    $selector.find('.popular-posts-template').select2({
      width: '100%'
    });
    $selector.find('.popular-posts-thumbnail').select2({
      width: '100%'
    });
    $selector.find('.popular-posts-post').select2({
      ajax: {
        url: ajaxurl + '?action=popular_posts_widget',
        dataType: 'json',
        delay: 250
      },
      width: '100%',
      minimumInputLength: 3
    });
  }
});
