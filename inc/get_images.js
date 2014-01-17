(function($){
  $(document).ready(function(){

    // global vars
    var start = 0;
    var count = 12;
    var filterby;

    // Add pretty photos in the hard-refresh
    addPrettyPhoto();

    function addPrettyPhoto() {
      $("a[rel^='prettyPhoto']").prettyPhoto({ social_tools: '' });
    }

    /**
     * Load pictures
     */

    function load(){
      var data = {
        start: start,
        count: count
      };

      if (filterby) data.filter = filterby;

      $.ajax({
        type: 'GET',
        url: 'get_images.php',
        data: data
      }).done(renderResponse);
    }

    function renderResponse(html){
      $('a.loadmore').before(html);
      addPrettyPhoto();
    }

    /**
    * Bind 'click' event in show-more button
    */

    var button = $('#container .show-more a');
    button.on('click', function(ev){
      ev.preventDefault();
      start = $('#container .rectangle').length;
      load();
    });

    /**
    * Bind filters
    */
    var filter = $('select.filter');

    filter.on('change', function(e){
      e.preventDefault();
      var category = $(this).val();
      $('#container').find('li.rectangle').remove();
      filterby = category == 'all' ? null : category;
      start = 0;
      load();
    });

  });
})(jQuery);
