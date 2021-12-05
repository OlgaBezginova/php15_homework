$('document').ready(function () {
    console.log('1 Получить <div>, <ul>, <li> с товаром апельсин. (JS + jQuery)');

    let div = document.querySelector('div');
    let divJQ = $('div')[0];

    console.log(div);
    console.log(divJQ);

    let ul = document.querySelector('ul.task1');
    let ulJQ = $('ul.task1');

    console.log(ul);
    console.log(ulJQ);

    let orange = document.querySelector('li:last-child');
    let orangeJQ = $('.task1 li').last();

    console.log(orange);
    console.log(orangeJQ);

    console.log('2 Напишите код, который выделит красным цветом все ячейки в таблице по диагонали. (JS + jQuery)');

    let table = document.querySelector('table');
    let rows =  table.rows;

    for(let i = 0; i < rows.length; i++){
        let cells = rows[i].cells;
        for(let j = 0; j < cells.length; j++){
            if(i==j){
                cells[i].style.border = '1px solid red';
            }
        }
    }

    $('table tr').each(function (i) {
        let cells = $(this).find('td');
        cells.each(function (j) {
            if(i == j) {
                $(this).css('color', 'red');
            }
        });
    });

    console.log('3 (JS + jQuery) Есть дерево, структурированное как вложенные списки ul/li. Напишите код, который выведет каждый элемент списка <li>:');

    console.log(document.querySelectorAll('ul.tree li'));
    console.log($('ul.tree li'));

    console.log( '• Какой в нём текст (без поддерева) ?');

    document.querySelectorAll('ul.tree > li').forEach(function (item) {
        console.log(item.innerText);
    });

    $('ul.tree > li').each(function () {
        console.log($(this).text());
    });

    console.log('• Какое число потомков – всех вложенных <li> (включая глубоко вложенные)?');

    console.log(document.querySelectorAll('ul.tree li').length);
    console.log($('ul.tree li').length);

    console.log('• Замените внутренний список <ul> на текст “one more second”');

    document.querySelector('ul.tree ul').outerHTML = 'one more second';
    $('ul.tree ul').closest('li').html('one more second');

    console.log('• (JS + jQuery) В HTML по ссылке page.html найти:');
    console.log('• Блок c id=“filters”');

    console.log(document.getElementById('filters'));
    console.log($('#filters'));

    console.log('• Все элементы input, select и button внутри этого блока' );

    console.log(document.querySelectorAll('#filters input, select, button'));
    console.log($('#filters input, select, button'));

    console.log('• Первый option с текстом “Сначала новые” в элементе с name=“order"');

    console.log(document.querySelector('[name="order"] option'));
    console.log($('[name="order"] option').first());

    console.log('• Форму form содержащую элемент с name=“order".');

    function findClosestParentByTag(elem, tag){
        if(elem.parentElement.tagName == tag.toUpperCase()) {
            return elem.parentElement;
        } else {
            return findClosestParentByTag(elem.parentElement, tag);
        }
    }

    let parentForm = findClosestParentByTag(document.querySelector('[name="order"]'), 'form');
    console.log(parentForm);
    console.log($('[name="order"]').closest('form'));

    console.log( '• Первый div class=“col" в этой форме');

    console.log(parentForm.querySelector('.row').firstElementChild);
    console.log($('[name="order"]').closest('form').find('.col').first());

    console.log('• Последний div class=“col" в этой форме');

    console.log(parentForm.querySelector('.row').lastElementChild);
    console.log($('[name="order"]').closest('form').find('.col').last());


});
