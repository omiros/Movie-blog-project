<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {

	$('form').on('click', function(e){
		e.preventDefault();
		upcommingMovies($('#keyword').val());
	});

	function upcommingMovies(page) {
		var api_url = 'http://api.themoviedb.org/3/tv/top_rated?api_key=10c5489407c952ec7df3554030efba02&page='+page;

  $.ajax({
    url: api_url,
    type: 'GET',
    dataType: 'jsonp',
    success: function(data) {
    	$('#wrapper').empty();
    	console.log(data.results);

			$.each(data.results, function(i, val){

				var current = $('#container').clone();
				//console.log(current);
				// current.attr('id','');
				current.find('h5').html(val.original_name);
				current.find('img').attr({
					'src': 'http://image.tmdb.org/t/p/w150' + val.poster_path,
					'alt': val.original_name
				});
				current.find('p').html('<strong>Rating: </strong>' + val.vote_average);

				$('#wrapper').append(current);
			});
    }
});

}

});
</script>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" media="all" href="sass/css/blog_style.css">
<body>
<div class="container api-movie">
	<div class="row">
		<div class="jumbotron" id="top">
			<a href='index.php'><img src='img/top_rated.png' style='margin-left:135px;'></a>
		</div>
		<div class="col-sm-12">
			<div class="col-sm-3 col-sm-offset-4">
				<form>
					<h3 style="text-align:center">Select page:</h3>
					<select multiple class="form-control" id="keyword">
						  <option selected="selected">1</option>
						  <option>2</option>
						  <option>3</option>
						  <option>4</option>
						  <option>5</option>
						  <option>6</option>
						  <option>7</option>
						  <option>8</option>
						  <option>9</option>
						  <option>10</option>
					</select>
				<!-- <input type="number" name="search" id="keyword" class='form-control'placeholder="page number"> -->
				</form>
			</div>
		</div>
	</div>
	<div id="wrapper" class="col-sm-12"></div>

		<h2><a href="#top">Top</a><h2>
</div>
		<!-- api container -->
		<div id="container">
		<h5></h5>
		<img src="">
		<p></p>
	</div>
	</body>
