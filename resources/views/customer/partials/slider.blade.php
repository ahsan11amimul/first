    <div class="slider">
        <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
                <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                <img src="{{asset('test-image/slider4.jpg')}}" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>We Provide 100% organic and fresh foods></h5>
                           <form action="{{route('customer.search')}}" method="GET" class="form-inline my-2 my-lg-0">
                    <div class="input-group my-3">
                        <input type="text" class="form-control" placeholder="Search For Products (eg:alu, piyaz, eggs, etc..)"
                    name="query" id="query" value="{{request()->input('query')}}" size="76">
                        <div class="input-group-append">
                            <button class="btn btn-outline-warning" type="submit" name="search_btn"><i class="fas fa-search text-white"></i></button>
                        </div>
                    </div>
                </form>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{{asset('test-image/slider5.jpg')}}" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>We Provide 100% organic and fresh foods></h5>
                          <form action="{{route('customer.search')}}" method="GET" class="form-inline my-2 my-lg-0">
                    <div class="input-group my-3">
                        <input type="text" class="form-control" placeholder="Search For Products (eg:alu, piyaz, eggs, etc..)"
                    name="query" id="query" value="{{request()->input('query')}}" size="76">
                        <div class="input-group-append">
                            <button class="btn btn-outline-warning" type="submit" name="search_btn"><i class="fas fa-search text-white"></i></button>
                        </div>
                    </div>
                </form>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{{asset('test-image/slider2.jpg')}}" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>We Provide 100% organic and fresh foods></h5>
                           <form action="{{route('customer.search')}}" method="GET" class="form-inline my-2 my-lg-0">
                    <div class="input-group my-3">
                        <input type="text" class="form-control" placeholder="Search For Products (eg:alu, piyaz, eggs, etc..)"
                    name="query" id="query" value="{{request()->input('query')}}" size="76">
                        <div class="input-group-append">
                            <button class="btn btn-outline-warning" type="submit" name="search_btn"><i class="fas fa-search text-white"></i></button>
                        </div>
                    </div>
                </form>
                    </div>
                </div>
            </div>
            {{-- <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a> --}}
        </div>
   
    </div>