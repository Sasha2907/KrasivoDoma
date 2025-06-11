const menuToggle = document.querySelector('.menu-toggle');
    const navigation = document.querySelector('.navigation');

    menuToggle.addEventListener('click', () => {
        navigation.classList.toggle('active');
    });
document.addEventListener('DOMContentLoaded', () => {
    const track = document.querySelector('.carousel-track');
    const slides = Array.from(track.children);

    const nextButton = document.querySelector('.carousel-button.next');
    const prevButton = document.querySelector('.carousel-button.prev');
    let currentIndex = 0;

    function moveToSlide(index) {
        const slideWidth = slides[0].getBoundingClientRect().width;
        track.style.transform = `translateX(-${index * slideWidth}px)`;
        currentIndex = index;
    }

    function updateSlidePosition() {
        moveToSlide(currentIndex);
    }

    function nextSlide() {
        const nextIndex = (currentIndex + 1) % slides.length; // Зацикливание
        moveToSlide(nextIndex);
    }

    function prevSlide() {
        const prevIndex = (currentIndex - 1 + slides.length) % slides.length; // Зацикливание
        moveToSlide(prevIndex);
    }

    // Обработчики событий для кнопок
    nextButton.addEventListener('click', nextSlide);
    prevButton.addEventListener('click', prevSlide);

    // Пересчёт ширины слайдов при изменении размера окна
    window.addEventListener('resize', updateSlidePosition);

    // Автопрокрутка каждые 3 секунды
    setInterval(nextSlide, 15000);
});
/*----------------------кнопка вверх-----------------------*/
// Прокрутка вверх страницы
function scrollToTop() {
    window.scrollTo({
        top: 0,
        behavior: 'smooth' // Плавный скроллинг
    });
}

// Отображение кнопки при прокрутке
window.addEventListener('scroll', function () {
    const scrollButton = document.querySelector('.scroll-to-top');
    if (window.scrollY > 300) {
        scrollButton.style.display = 'block'; // Показываем кнопку
    } else {
        scrollButton.style.display = 'none'; // Прячем кнопку
    }
});
