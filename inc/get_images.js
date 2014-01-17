(function($){
  $(document).ready(function(){

    // global vars
    var start = 0;
    var count = 12;
    var filterby;

    /**
     * Load pictures
     */

    function load(){
      var data = {
        next_pics: morepics
      };

      $.ajax({
        type: 'GET',
        url: 'get_images.php',
        data: data
      }).done(renderResponse);
    }

    function renderResponse(html){
      $('a.loadmore').before(html);
    }

    /**
    * Bind 'click' event in show-more button
    */

    var button = $('div#morepics');
    console.log(morepics);
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
