console.log('Напишите скрипт, который считает количество секунд в часе, сутках, неделе, месяце из 30 дней.');

let second = 1;
let minute = 60 * second;
let hour = 60 * minute;
let day = 26 * hour;
let week = 7 * day;
let month = 30 * day;

console.log('Seconds in:\n- minute: ' + minute + '\n- hour: ' + hour + '\n- day: ' + day + '\n- week: ' + week + '\n- month: ' + month);

console.log( 'Переделайте этот код так, чтобы в нем использовалась операция +=. Количество строк кода при этом не должно измениться!\n' +
    'let text = \'Я\';\n' +
    'text = text +\' хочу\';\n' +
    'text = text +\' знать\';\n' +
    'text = text +\' JS!\';\n' +
    'console.log(text);');

let text = 'Я';
text += ' хочу';
text += ' знать';
text += ' JS!';
console.log(text);

console.log( 'Дано число. Увеличьте его на 30%, на 120%.');

let num = 42;
let num30 = num + (num * 30) / 100;
let num120 = num + (num * 120) / 100;
console.log(num30);
console.log(num120);

console.log( 'Определить какое число четное или не четное. Реализовать через тернарную операцию.');

console.log(num % 2 ? 'odd' : 'even');

console.log('Создайте массив orders с несколькими элементами в формате “название товара: цена”. Добавьте в него один элемент в начало и в конец. Выведите все элементы массива на экран');

let orders = ['Xiaomi Redmi 9A: 5000', 'Samsung Galaxy A32: 8000', 'Apple iPhone 11: 21000'];
orders.unshift('Nokia C30: 3500');
orders.push('Meizu M10: 4000');

orders.forEach(function (item) {
    console.log(item);
});

console.log('Создайте массив с пятью элементами. Удалите второй и четвертый элемент. Выведите все элементы массива.');

orders.splice(1, 1);
orders.splice(-2, 1);

orders.forEach(function (item) {
    console.log(item);
});

console.log('Создайте массив с несколькими элементами. Выведите все четные элементы массива');

orders.forEach(function (item, index) {
    ! (index % 2) ? console.log(index + ' : ' + item) : null;
});

console.log('Создайте массив с несколькими числами, используя цикл найдите максимальное число в массиве.');

let numbers = [365, 220, 42, 13, 10, 20, 2018, 52, 1999, 7];

let max = numbers[0];
numbers.forEach(function (item) {
    if(max < item){
        max = item;
    }
});

console.log(max);

console.log('Создайте два массива с числами одинаковой длины, сравните элементы одного массива с элементами другого.');

let numbers2 = [3, 220, 8, 10, 1, 20, 800, 52, 1999, 15];

console.log(numbers);
console.log(numbers2);

if( numbers.length == numbers2.length ) {
    numbers.forEach(function (item, index) {
        console.log(index + ' : ' + (item === numbers2[index] ? 'equal' : 'not equal'));
    });
} else {
    console.log('Length error');
}

console.log('Создайте массив со строками ‘Я хочу знать JS’ и ‘Я не хочу знать JS’. Используя поиск по строке удалите из него элемент ‘Я не хочу знать JS’.');

let knowJs = ['Я хочу знать JS', 'Я не хочу знать JS'];

console.log(knowJs);

knowJs.forEach(function (item, index, array) {
    if(item.includes('не')) {
        array.splice(index, 1);
    }
});

console.log(knowJs);
