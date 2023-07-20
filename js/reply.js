// Отримання посилання та контейнера форми за допомогою id
var showFormLink = document.getElementById('showFormLink');
var formContainer = document.getElementById('formContainer');

// Додавання обробника події для натискання на посилання
showFormLink.addEventListener('click', function(event) {
    event.preventDefault(); // Відміна стандартної дії посилання

    // Створення HTML-коду для форми
    var formHTML = '<form id="myForm" class="comments-form" action="/template/products.php" method="post">';
    formHTML += '<div class="comments-form__box-input">';
    formHTML += '<input class="comments-form__text-input" placeholder="Your name" type="text" name="reply-name" required>';
    formHTML += '<input class="comments-form__text-input" placeholder="E-mail addres" type="email" name="reply-E-mail" required>';
    formHTML += '<input  value="<?php echo $res[\'id\'] ?>" type="text" name="reply-id" style="display: none;">';
    formHTML += '</div>';
    formHTML += '<textarea class="comments-form__textarea" name="reply-text"></textarea>';
    formHTML += '<button class="comments-form__btn" type="submit" name="reply">Leave Review</button>';
    formHTML += '</form>';

    // Вставлення форми в контейнер
    formContainer.innerHTML = formHTML;

    // Додавання обробника події для подання форми
    var myForm = document.getElementById('myForm');
    myForm.addEventListener('submit', function(event) {
        event.preventDefault(); // Відміна стандартної дії форми

        // Виконання дій при поданні форми, наприклад, відправка даних на сервер
        // Тут ви можете використати AJAX або інші методи для відправки даних

        // Після виконання дій можна очистити форму і приховати її
        formContainer.innerHTML = '';
    });
});
