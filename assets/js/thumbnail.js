(function($) {

  $.fn.thumbnail = function() {

    return this.each(function() {

      //Init and get data from PHP
      $wrapper = $(this);

      /*
      $input = $(this).siblings('textarea').first();
      var thumbnail = {};
      var exsitingvalues = {};
      if($input.val()){
        var exsitingvalues = $input.val();
      }
      */

      //jQuery layout variables
      /*
      var $layout = $("<div>", {class: 'layout'});
      var $area = $("<div>", {class: 'area'});
      var $frame = $("<div>", {class: 'frame'});
      var $frame = $("<div>", {class: 'frame'});
      var $image = $("<img>", {src: thumbnail.src});
      */

      /* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */
      /* !Some clicking action */
      /* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

      /*
      $('.thumbnail img').on('click', function(event){
        //thumbnail.src = $(this).attr('src');
        //$image.attr('src', thumbnail.src);
        //thumbnail.width = ($frame[0].offsetWidth/$frame[0].parentElement.offsetWidth*100).toFixed(2);
        //thumbnail.height = ($frame[0].offsetHeight/$frame[0].parentElement.offsetHeight*100).toFixed(2);
        //thumbnail.top = ($frame[0].offset.top/$frame[0].parentElement.offsetHeight*100).toFixed(2);
        //thumbnail.left = ($frame[0].offset.left/$frame[0].parentElement.offsetWidth*100).toFixed(2);
        //$input.html(JSON.stringify([thumbnail]));
      });
      */

      /* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */
      /* !Put it all together */
      /* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

      //Put elements together
      /*
      $area.append($frame);
      $layout.append($area);
      $wrapper.append($layout);
      $wrapper.append($iframe);
      */

      //Add the slide element to DOM
    });
  };

})(jQuery);
