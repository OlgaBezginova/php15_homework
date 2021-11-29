console.log('Сделайте функцию inArray, которая определяет, есть в массиве элемент с заданным текстом или нет. ' +
    'Функция первым параметром должна принимать текст элемента, а вторым - массив, в котором делается поиск. ' +
    'Функция должна возвращать true или false.');

function inArray(needle, haystack) {
    var result = false;
    haystack.forEach(function (item) {
        if(typeof item != 'string') {
            return;
        }
        if(item.includes(needle)) {
            result = true;
        }
    });
    return result;
}

console.log(inArray('test', ['123123', 'try', 'test test']));
console.log(inArray('test', ['123123', 'try']));
console.log(inArray('test', [1, 2, 3, 4]));

console.log('Дана строка. Сделайте заглавным первый символ каждого слова этой строки. Для этого сделайте вспомогательную функцию ucfirst, ' +
    'которая будет получать строку, делать первый символ этой строки заглавным и возвращать обратно строку с заглавной первой буквой.');

let string = 'my test string';

console.log(string);

function ucfirst(string) {
    return string.replace(string[0], string[0].toUpperCase());
}

string = string.split(' ');

string.forEach(function (item, index, array) {
    array[index] = ucfirst(item);
});

string = string.join(' ');

console.log(string);

console.log('Сделайте функцию each, которая первым параметром принимает массив, а вторым - функцию, которая применится к каждому ' +
    'элементу массива. Функция each должна вернуть измененный массив.');

function each(array, func) {
    array.forEach(function(item, i, arr) {
        arr[i] = func(item);
    });
    return array;
}

let array = [3, 6, 8, 9];
let func = function(param) {
    return param*param;
};

console.log(array);
console.log(each(array, func));

console.log('Сделайте функцию each, которая первым параметром принимает массив, а вторым - массив функций, которые по очереди ' +
    'применятся к каждому элементу массива: к первому элементу массива - первая функция, ко второму - вторая и так далее пока' +
    'функции в массиве не закончатся, после этого возьмется первая функция, вторая и так далее по кругу');

function each2(array, funcArray) {
    let j = 0;
    array.forEach(function(item, i, arr) {
        arr[i] = funcArray[j](item);
        if(j < funcArray.length - 1) {
            j++;
        } else {
            j = 0;
        }
    });
    return array;
}

let input = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11];

let func0 = function(param) {
    return param + 1;
};

let func1 = function(param) {
    return param % 2;
};

let func2 = function(param) {
    return param * param;
};

let func3 = function(param) {
    return param / 10;
};

let functions = [func0, func1, func2, func3] ;

console.log(input);
console.log(each2(input, functions));

console.log('Используя замыкание сделайте функцию, которая считает и выводит количество своих вызовов');

function counter() {
    let count = 0;
    return function () {
        return ++count;
    }
}

let countCalls = counter();

console.log(countCalls());
console.log(countCalls());
console.log(countCalls());