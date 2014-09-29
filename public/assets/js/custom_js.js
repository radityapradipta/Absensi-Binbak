// timer for hiding the div
var hideTimer0;

	// show the DIV on mouse over
	$(".size_type_trigger").mouseover(function() {
		// forget any hiding events in timer
		clearTimeout( hideTimer0 );
		$(".size_type_container").css('visibility', 'visible');
		$(".price_type_container").css('visibility', 'hidden');
		$(".brand_type_container").css('visibility', 'hidden');
			$(".color_type_container").css('visibility', 'hidden');
	});

	$(".size_type_container").mouseout(function() {
		hideTimer0 = setTimeout( hidesize, 300 );
	});
	function hidesize() {
		$(".size_type_container").css('visibility', 'hidden');
		$(".size_type_international").css('visibility', 'hidden');
		$(".size_type_eu").css('visibility', 'hidden');
		$(".size_type_collar").css('visibility', 'hidden');
	}

		//size int
		$(".size_type_international_tr, .size_type_international a").mouseover(function() {
			// forget any hiding events in timer
			clearTimeout( hideTimer0 );
			$(".size_type_international").css('visibility', 'visible');
			$(".size_type_eu").css('visibility', 'hidden');
			$(".size_type_collar").css('visibility', 'hidden');
		});

		$(".size_type_international a").mouseout(function() {
			hideTimer0 = setTimeout( hidesizeint, 300 );
		});
		function hidesizeint() {
			$(".size_type_international").css('visibility', 'hidden');
			$(".size_type_eu").css('visibility', 'hidden');
			$(".size_type_collar").css('visibility', 'hidden');
		}


		//size eu
		$(".size_type_eu_tr, .size_type_eu a").mouseover(function() {
			// forget any hiding events in timer
			clearTimeout( hideTimer0 );
			$(".size_type_international").css('visibility', 'hidden');
			$(".size_type_eu").css('visibility', 'visible');
			$(".size_type_collar").css('visibility', 'hidden');
		});

		$(".size_type_eu a").mouseout(function() {
			hideTimer0 = setTimeout( hidesizeint, 300 );
		});
		function hidesizeint() {
			$(".size_type_international").css('visibility', 'hidden');
			$(".size_type_eu").css('visibility', 'hidden');
			$(".size_type_collar").css('visibility', 'hidden');
		}

		//size eu
		$(".size_type_collar_tr, .size_type_collar a").mouseover(function() {
			// forget any hiding events in timer
			clearTimeout( hideTimer0 );
			$(".size_type_international").css('visibility', 'hidden');
			$(".size_type_eu").css('visibility', 'hidden');
			$(".size_type_collar").css('visibility', 'visible');
		});

		$(".size_type_collar a").mouseout(function() {
			hideTimer0 = setTimeout( hidesizeint, 300 );
		});
		function hidesizeint() {
			$(".size_type_international").css('visibility', 'hidden');
			$(".size_type_eu").css('visibility', 'hidden');
			$(".size_type_collar").css('visibility', 'hidden');
		}
		
	// show the DIV on mouse over
	$(".price_type_trigger").mouseover(function() {
		// forget any hiding events in timer
		clearTimeout( hideTimer0 );
		$(".price_type_container").css('visibility', 'visible');
		$(".size_type_container").css('visibility', 'hidden');
		$(".brand_type_container").css('visibility', 'hidden');
			$(".color_type_container").css('visibility', 'hidden');
	});
	
	$(".price_type").mouseover(function() {
		// forget any hiding events in timer
		clearTimeout( hideTimer0 );
		$(".price_type_container").css('visibility', 'visible');
	});

	$(".price_type_container .price_type").mouseout(function() {
		hideTimer0 = setTimeout( hidesize, 300 );
	});
	function hidesize() {
		$(".price_type_container").css('visibility', 'hidden');
		$(".size_type_container").css('visibility', 'hidden');
		$(".size_type_international").css('visibility', 'hidden');
		$(".size_type_eu").css('visibility', 'hidden');
		$(".size_type_collar").css('visibility', 'hidden');
	}

	// show the DIV on mouse over
	$(".brand_type_trigger").mouseover(function() {
		// forget any hiding events in timer
		clearTimeout( hideTimer0 );
		$(".price_type_container").css('visibility', 'hidden');
		$(".size_type_container").css('visibility', 'hidden');
		$(".brand_type_container").css('visibility', 'visible');
			$(".color_type_container").css('visibility', 'hidden');
	});
	
	$(".brand_type").mouseover(function() {
		// forget any hiding events in timer
		clearTimeout( hideTimer0 );
		$(".brand_type_container").css('visibility', 'visible');
	});

	$(".brand_type_container .brand_type").mouseout(function() {
		hideTimer0 = setTimeout( hidesize, 300 );
	});
	function hidesize() {
		$(".brand_type_container").css('visibility', 'hidden');
		$(".price_type_container").css('visibility', 'hidden');
		$(".size_type_container").css('visibility', 'hidden');
		$(".size_type_international").css('visibility', 'hidden');
		$(".size_type_eu").css('visibility', 'hidden');
		$(".size_type_collar").css('visibility', 'hidden');
	}

		// show the DIV on mouse over
		$(".color_type_trigger").mouseover(function() {
			// forget any hiding events in timer
			clearTimeout( hideTimer0 );
			$(".price_type_container").css('visibility', 'hidden');
			$(".size_type_container").css('visibility', 'hidden');
			$(".brand_type_container").css('visibility', 'hidden');
			$(".color_type_container").css('visibility', 'visible');
		});
		
		$(".color_type").mouseover(function() {
			// forget any hiding events in timer
			clearTimeout( hideTimer0 );
			$(".color_type_container").css('visibility', 'visible');
		});

		$(".color_type_container input").mouseout(function() {
			hideTimer0 = setTimeout( hidesize, 300 );
		});
		function hidesize() {
			$(".color_type_container").css('visibility', 'hidden');
			$(".brand_type_container").css('visibility', 'hidden');
			$(".price_type_container").css('visibility', 'hidden');
			$(".size_type_container").css('visibility', 'hidden');
			$(".size_type_international").css('visibility', 'hidden');
			$(".size_type_eu").css('visibility', 'hidden');
			$(".size_type_collar").css('visibility', 'hidden');
		}

