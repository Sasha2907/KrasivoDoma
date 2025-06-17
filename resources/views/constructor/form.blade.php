@extends('layouts.Review.main')

@section('content')
<!-- <div class="container mb-4 mt-4">
        <div class="mb-4 mt-4 catalog-header">
            <img src="/images/logoCircle.png" alt="Логотип" class="catalog-logo">
            <p class="catalog-title">Конструктор</p>
        </div>
    

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('constructor.store') }}">
        @csrf
        <div class="form-group mb-4">
            <label for="config_name">Название конфигурации:</label>
            <input type="text" id="config_name" name="config_name" class="form-control" required>
        </div>

        <div class="form-group mb-4">
            <label for="product_type">Что собираем?</label>
            <select id="product_type" name="product_type" class="form-control" required>
                <option value="">Выберите</option>
                <option value="curtains">Шторы</option>
                <option value="tulle">Тюль</option>
                <option value="roman_curtains">Римские шторы</option> -->
                <!-- <option value="bedspread">Покрывало</option> -->
            <!-- </select>
        </div>
        <div class="mt-5">
            <h4>Превью</h4>
            <div id="preview-area" style="position: relative; width: 300px; height: 400px; border: 1px solid #ccc;">
                <img id="base-layer" src="" style="position: absolute; width: 100%; height: 100%;">
                <img id="fabric-layer" src="" style="position: absolute; width: 100%; height: 100%; opacity: 0.85;">
                <img id="sewing-layer" src="" style="position: absolute; width: 100%; height: 100%;">
            </div>
        </div>
        <div id="dimensions" class="form-group d-none">
            <label>Ширина карниза (см):</label>
            <input type="number" name="width" class="form-control" min="10" required><br>

            <label>Высота карниза (см):</label>
            <input type="number" name="height" class="form-control" min="10" required>
        </div><br>

        <div id="fabric-selector" class="form-group d-none">
            <label>Выбор ткани:</label>
            <div id="fabrics" class="row">
            </div>
            <input type="hidden" name="fabric">
        </div>

        <div id="sewing-selector" class="form-group d-none">
            <label>Тип пошива:</label>
            <div class="row">
                @foreach ($sewingTypes as $type)
                    <div class="col-md-4">
                        <div class="card select-sewing" data-value="{{ $type['id'] }}">
                            <img src="{{ $type['image'] }}" class="card-img-top">
                            <div class="card-body text-center">{{ $type['name'] }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
            <input type="hidden" name="sewing_type">
        </div>

        <div id="quilting-selector" class="form-group d-none">
            <label>Способ простежки:</label>
            <select name="quilting_method" class="form-control">
                @foreach ($quiltingMethods as $method)
                    <option value="{{ $method }}">{{ $method }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Сохранить конфигурацию</button>
    </form>
</div>

<script>
    const productType = document.getElementById('product_type');
    const dimensions = document.getElementById('dimensions');
    const fabricSelector = document.getElementById('fabric-selector');
    const fabricsDiv = document.getElementById('fabrics');
    const sewingSelector = document.getElementById('sewing-selector');
    const quiltingSelector = document.getElementById('quilting-selector');

    const fabricInputs = {
        curtains: @json($curtainFabrics),
        tulle: @json($tulleFabrics),
        roman_curtains: @json($curtainFabrics->merge($tulleFabrics)->all()),
    };

    productType.addEventListener('change', function () {
        const value = this.value;

        dimensions.classList.toggle('d-none', value === '');
        fabricSelector.classList.add('d-none');
        sewingSelector.classList.add('d-none');
        quiltingSelector.classList.add('d-none');

        if (value !== '') {
            showFabrics(value);
        }
        if (value === 'curtains') {
            sewingSelector.classList.remove('d-none');
        } else if (value === 'bedspread') {
            quiltingSelector.classList.remove('d-none');
        }
    });

    function showFabrics(type) {
        fabricSelector.classList.remove('d-none');
        fabricsDiv.innerHTML = '';
        (fabricInputs[type] || []).forEach(fabric => {
            const card = document.createElement('div');
            card.className = 'col-md-3 mb-3';
            card.innerHTML = `
                <div class="card select-fabric" data-id="${fabric.id}" data-overlay="${fabric.overlay}">
                    <img src="${fabric.image}" class="card-img-top">
                    <div class="card-body text-center">${fabric.name}</div>
                </div>
            `;
            fabricsDiv.appendChild(card);
        });

        fabricsDiv.querySelectorAll('.select-fabric').forEach(card => {
            card.addEventListener('click', () => {
                document.querySelector('input[name="fabric"]').value = card.dataset.id;
                fabricsDiv.querySelectorAll('.select-fabric').forEach(c => c.classList.remove('border-primary'));
                card.classList.add('border-primary');

                // Ткань
                document.getElementById('fabric-layer').src = card.dataset.overlay;
            });
        });
    }

document.querySelectorAll('.select-sewing').forEach(card => {
    card.addEventListener('click', () => {
        document.querySelector('input[name="sewing_type"]').value = card.dataset.value;
        document.querySelectorAll('.select-sewing').forEach(c => c.classList.remove('border-primary'));
        card.classList.add('border-primary');

        // Пошив
        const overlay = card.dataset.overlay;
        document.getElementById('sewing-layer').src = overlay;
    });
});

    document.querySelectorAll('.select-sewing').forEach(card => {
        card.addEventListener('click', () => {
            document.querySelector('input[name=\"sewing_type\"]').value = card.dataset.value;
            document.querySelectorAll('.select-sewing').forEach(c => c.classList.remove('border-primary'));
            card.classList.add('border-primary');
        });
    });
    productType.addEventListener('change', function () {
    const value = this.value;

    dimensions.classList.toggle('d-none', value === '');
    fabricSelector.classList.add('d-none');
    sewingSelector.classList.add('d-none');
    quiltingSelector.classList.add('d-none');

    // Обновляем базовое изображение
    document.getElementById('base-layer').src = `/images/constructor/base/${value}.png`;
    document.getElementById('fabric-layer').src = '';
    document.getElementById('sewing-layer').src = '';

    if (value !== '') {
        showFabrics(value);
    }
    if (value === 'curtains' || value === 'roman_curtains' || value === 'tulle') {
        sewingSelector.classList.remove('d-none');
    }
});
</script> -->

<div class="container mb-4 mt-4">
    <div class="mb-4 mt-4 catalog-header">
        <img src="/images/logoCircle.png" alt="Логотип" class="catalog-logo">
        <p class="catalog-title">Конструктор</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" autocomplete="off" action="{{ route('constructor.store') }}">
        @csrf

        <div class="form-group mb-4">
            <label for="config_name">Название конфигурации:</label>
            <input type="text" placeholder="Назовите вашу конфигурацию" name="name" class="form-control" required>
        </div>

        <div class="form-group mb-4">
            <label for="product_type">Что собираем?</label>
            <select id="product_type" name="product_type" class="form-control" required>
                <option value="">Выберите</option>
                <option value="curtains">Шторы</option>
                <option value="tulle">Тюль</option>
                <option value="roman_curtains">Римские шторы</option>
            </select>
        </div>

        <div class="mt-5">
    <h4 class="text-center">Превью</h4>
    <div class="d-flex justify-content-center">
        <div id="preview-area" style="position: relative; width: 290px; height: 400px; border: 1px solid #ccc;">
            <img id="base-layer" style="position: absolute; width: 100%; height: 100%; z-index: 1; display: none;">
            <img id="sewing-layer" style="position: absolute; width: 100%; height: 100%; z-index: 2; display: none;">
            <img id="fabric-layer" style="position: absolute; width: 100%; height: 100%; z-index: 3; opacity: 0.35; display: none;">
        </div>
    </div>
</div>

        <div id="dimensions" class="form-group d-none">
            <label>Ширина (см):</label>
            <input type="number" name="width" class="form-control" min="10" required><br>

            <label>Высота (см):</label>
            <input type="number" name="height" class="form-control" min="10" required>
        </div><br>

        <div id="fabric-selector" class="form-group d-none">
            <label>Выбор ткани:</label>
            <div id="fabrics" class="row"></div>
            <input type="hidden" name="fabric_id" required>
        </div>

        <div id="sewing-selector" class="form-group d-none">
            <label>Тип пошива:</label>
            <div class="row">
            @foreach ($sewingTypes as $type)
                <div class="col-md-4">
                    <div class="card select-sewing"
                        data-value="{{ $type->id }}"
                        data-overlay-curtain="{{ asset($type->overlay_curtain) }}"
                        data-overlay-tulle="{{ asset($type->overlay_tulle) }}">
                        <img src="{{ asset($type->image) }}" class="card-img-top">
                        <div class="card-body text-center">{{ $type->name }}</div>
                    </div>
                </div>
            @endforeach
            </div>
            <input type="hidden" name="sewing_type_id" required>
        </div>

        <div id="quilting-selector" class="form-group d-none">
            <label>Способ простежки:</label>
            <select name="quilting_method" class="form-control">
                @foreach ($quiltingMethods as $method)
                    <option value="{{ $method }}">{{ $method }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Сохранить конфигурацию</button>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function showAlert(message) {
    Swal.fire({
        icon: 'warning',
        title: 'Ошибка',
        text: message,
        confirmButtonText: 'ОК'
    });
}
const fabricData = {
    curtains: @json($curtainFabrics),
    tulle: @json($tulleFabrics),
    roman_curtains: @json($curtainFabrics->merge($tulleFabrics)),
};

const productType = document.getElementById('product_type');
const fabricSelector = document.getElementById('fabric-selector');
const fabricsDiv = document.getElementById('fabrics');
const dimensions = document.getElementById('dimensions');
const sewingSelector = document.getElementById('sewing-selector');
const quiltingSelector = document.getElementById('quilting-selector');

productType.addEventListener('change', function () {
    const type = this.value;

    dimensions.classList.toggle('d-none', type === '');
    fabricSelector.classList.add('d-none');
    sewingSelector.classList.add('d-none');
    quiltingSelector.classList.add('d-none');

    document.getElementById('base-layer').src = `/images/constructor/base/${type}.png`;
    document.getElementById('base-layer').style.display = 'block';
    document.getElementById('fabric-layer').src = '';
    document.getElementById('sewing-layer').src = '';

    if (type !== '') showFabrics(type);
    if (type === 'curtains' || type === 'tulle') {
    sewingSelector.classList.remove('d-none');
}
});

function showFabrics(type) {
    fabricSelector.classList.remove('d-none');
    fabricsDiv.innerHTML = '';

    (fabricData[type] || []).forEach(fabric => {
        const card = document.createElement('div');
        card.className = 'col-md-3 mb-3';
        card.innerHTML = `
            <div class="card select-fabric" data-id="${fabric.id}" data-overlay="${fabric.overlay}">
                <img src="${fabric.image}" class="card-img-top">
                <div class="card-body text-center">${fabric.name}</div>
            </div>
        `;
        fabricsDiv.appendChild(card);
    });

    fabricsDiv.querySelectorAll('.select-fabric').forEach(card => {
        card.addEventListener('click', () => {
            document.querySelector('input[name="fabric_id"]').value = card.dataset.id;
            fabricsDiv.querySelectorAll('.select-fabric').forEach(c => c.classList.remove('border-primary'));
            card.classList.add('border-primary');

            document.getElementById('fabric-layer').src = card.dataset.overlay;
            document.getElementById('fabric-layer').style.display = 'block';
        });
    });
}

document.querySelectorAll('.select-sewing').forEach(card => {
    card.addEventListener('click', () => {
        const type = document.getElementById('product_type').value;

        let overlaySrc = '';
        if (type === 'curtains' || type === 'roman_curtains') {
            overlaySrc = card.dataset.overlayCurtain;
        } else if (type === 'tulle') {
            overlaySrc = card.dataset.overlayTulle;
        }

        document.querySelector('input[name="sewing_type_id"]').value = card.dataset.value;
        document.querySelectorAll('.select-sewing').forEach(c => c.classList.remove('border-primary'));
        card.classList.add('border-primary');

        document.getElementById('sewing-layer').src = overlaySrc;
        document.getElementById('sewing-layer').style.display = 'block';
    });
});
document.querySelector('form').addEventListener('submit', function(e) {
    const type = document.getElementById('product_type').value;
    const fabricId = document.querySelector('input[name="fabric_id"]').value;
    const sewingId = document.querySelector('input[name="sewing_type_id"]').value;

    if (type === 'curtains' || type === 'tulle' || type === 'roman_curtains') {
        if (!fabricId) {
            e.preventDefault();
            showAlert('Пожалуйста, выберите ткань.');
            return;
        }

        if (!sewingId) {
            e.preventDefault();
            showAlert('Пожалуйста, выберите тип пошива.');
            return;
        }
    }

    // Можно добавить проверку на размеры, если нужно
});
</script>
@endsection
