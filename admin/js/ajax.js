

$(document).ready(function() {

//bring the data from preview.php
$('#btn-default').on('click', function(e) {
  e.preventDefault();

  $.ajax({
    url: 'preview.php',
    type: 'GET',
    success: function(data) {
        //console.log(data);
        $('.show-preview').html(data);
      },
      error: function(e) {
        console.log(e.message);
      }
    });
});
$('form').on('click', function(e){
  e.preventDefault();
  $('#toggle').slideDown('slow').css("display","inline-block");
  $('#content').removeClass('hidden');
});

$('.button').on('click', function(e){
  e.preventDefault();
  searchMovies($('#movie').val());
});

function searchMovies(page) {
  var api_url = 'http://api.themoviedb.org/3/search/movie?api_key=10c5489407c952ec7df3554030efba02&query='+ page;

  $.ajax({
    url: api_url,
    type: 'GET',
    dataType: 'jsonp',
    success: function(data) {
      console.log(data);
      $('#content').empty();

      $.each(data.results, function(i, val){

        var current = $('#toggle').clone();
        current.find('h5').html(val.original_title);
        current.find('img').attr({
          'src': 'http://image.tmdb.org/t/p/w150' + val.poster_path,
          'alt': val.original_title
        });
        current.find('p').html('<strong>Rating: </strong>' + val.vote_average);

        $('#content').append(current);
      });
    }
  });

}
});

