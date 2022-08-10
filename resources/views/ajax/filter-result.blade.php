@foreach($cars as $car)
    <div class="col-lg-4">
        <div class="card mb-3" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">{{$car->brand}}</h5>
                <p class="card-text">{{mb_substr($car->model, 0 , 100)}}...</p>
                <p class="card-text">{{mb_substr($car->engine_type, 0 , 100)}}...</p>
                <p class="card-text">{{mb_substr($car->drive, 0 , 100)}}...</p>
            </div>
        </div>
    </div>
@endforeach
