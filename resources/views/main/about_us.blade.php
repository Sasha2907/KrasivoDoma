@extends('layouts.Review.main')
@section('content')
    <main class="about">
        <section class="about-header">
            <div class="container">
                <div class="about-logo">
                    <img src="/images/logoCircle.png" alt="О компании">
                </div>
                <div class="about-text">
                    <h1>О нашей компании</h1>
                    <!-- <p>Компания "Шторы в каждый дом" занимается производством и продажей качественных текстильных изделий. Мы предоставляем широкий выбор штор, тюлей и аксессуаров, которые подойдут для любого интерьера.</p> -->
                    <p>Компания "Красиво дома" занимается производством и продажей качественных текстильных изделий. Мы предоставляем широкий выбор штор, тюлей и аксессуаров, которые подойдут для любого интерьера.</p>
                </div>
            </div>
        </section>

        <!-- Блок преимуществ -->
        <section class="advantages">
            <div class="container">
                <h2>Наши преимущества</h2>
                <div class="advantages-grid">
                    <div class="advantage">
                        <img src="/images/Высокое_качество.jpg" alt="Качество">
                        <h3>Высокое качество</h3>
                        <p>Мы используем только лучшие материалы для изготовления наших изделий.</p>
                    </div>
                    <div class="advantage">
                        <img src="/images/Современный_Дизайн.jpg" alt="Дизайн">
                        <h3>Современный дизайн</h3>
                        <p>Наши шторы гармонично дополнят интерьер любого помещения.</p>
                    </div>
                    <div class="advantage">
                        <img src="/images/Индивидуальный_подход.jpg" alt="Сервис">
                        <h3>Индивидуальный подход</h3>
                        <p>Мы учитываем все пожелания клиентов при подборе штор.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Контактная информация -->
        <section class="contact-section">
            <div class="contact-info">
                <h2>Свяжитесь с нами</h2>
                <p><strong>Телефон:</strong> +375 29 2879009</p>
                <p><strong>Телефон:</strong> +375 25 7973108</p>
                <p><strong>Email:</strong> <a href="mailto:opetuk@mail.ru">opetuk@mail.ru</a></p>
                <p><strong>Адрес:</strong> г. Гродно, пр-т Я.Купалы 88а</p>
                <p><strong>Режим работы:</strong> Пн-Пт 10:00-18:00, Сб 10:00-15:00, Вс - выходной</p>
            </div>
            <div class="map-container">

                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1967.4470471208647!2d23.847302386709483!3d53.65354798048819!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46dfd7afc44e02f1%3A0x10a60fa7414f0e6c!2z0L_RgNC-0YHQvy4g0K_QvdC60Lgg0JrRg9C_0LDQu9GLIDg40LA!5e1!3m2!1sru!2sby!4v1747949640695!5m2!1sru!2sby"
                        width="100%"
                        height="100%"
                        style="border:0;"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                </iframe>
                
            </div>
        </section>
    </main>
@endsection
