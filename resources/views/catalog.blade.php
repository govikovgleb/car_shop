<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Продажа новых автомобилей @if(isset($brand)) {{$brand}} @endif @if(isset($model)) {{$model}} @endif в Санкт-Петербурге</title>
    <link rel="stylesheet" href="/css/app.css">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <h1 class="text-center mt-3">Продажа новых автомобилей @if(isset($brand)) {{$brand}} @endif @if(isset($model)) {{$model}} @endif в Санкт-Петербурге</h1>
    <form action="{{route('filter')}}" method="post" id="brand_model_filter">
        @csrf
        <div class="mb-3">
            <div class="form-label">Фильтрация по бренду и модели</div>
            <select name="brand" class="form-select form-select-sm" aria-label=".form-select-sm example">
                <option></option>
                <option value="Lexus">Lexus</option>
                <option value="Toyota">Toyota</option>
            </select>
        </div>
        <div class="mb-3">
            <div class="form-label">Choose model</div>
            <select name="model" class="form-select form-select-sm" aria-label=".form-select-sm example">
                <option></option>
                <option value="ES">ES</option>
                <option value="GX">GX</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <form action="{{route('filter')}}" method="post" id="drive_filter">
        @csrf

        <div class="mb-3">
            <div class="form-label">Фильтрация приводу</div>
            <select name="drive" class="form-select form-select-sm" aria-label=".form-select-sm example">
                <option></option>
                <option value="Полный">Полный</option>
                <option value="Передний">Передний</option>
            </select>
        </div>
        <div class="mb-3">
            <div class="form-label">Фильтрация по типу двигателя</div>
            <select name="engine_type" class="form-select form-select-sm" aria-label=".form-select-sm example">
                <option></option>
                <option value="Бензин">Бензин</option>
                <option value="Дизель">Дизель</option>
                <option value="Гибрид">Гибрид</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <div id="items" class="row mt-5">
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
    </div>
{{--    {{$products->withQueryString()->links('vendor.pagination.bootstrap-4')}}--}}
</div>
<script src="/js/app.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function () {
        $('#drive_filter').submit(function (e) {
            e.preventDefault()
            let url_params = $(location).attr('pathname').split('/') // парсим url для получения параметров фильтра

            let drive = $('select[name="drive"]').val()
            let engine_type = $('select[name="engine_type"]').val()

            //собираем данные для фильтрации
            let data = {}
            if (drive) data['drive'] = drive
            if (engine_type) data['engine_type'] = engine_type
            if (url_params[2]) data['brand'] = url_params[2]
            if (url_params[3]) data['model'] = url_params[3]

            if (drive || engine_type) {
                $.ajax({
                    url: "{{ route('filter') }}",
                    method: 'post',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: data,
                    success: (result) => {
                        $('#items').html(result)// отрисовываем товары после фильтрации

                        // добавлчем параметры фильтрации в url
                        let url = new URL(window.location)
                        if (drive) url.searchParams.set('drive', drive)
                        if (engine_type) url.searchParams.set('engine_type', engine_type)
                        history.pushState(null, null, url)
                    }
                })
            }
        })
    })
</script>
</body>
</html>
