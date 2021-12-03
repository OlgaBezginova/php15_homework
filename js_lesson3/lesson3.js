console.log('Напишите код, выполнив задание из каждого пункта отдельной строкой:\n' +
    '• Создайте пустой объект user.\n' +
    '• Добавьте свойство name со значением John.\n' +
    '• Добавьте свойство surname со значением Smith.\n' +
    '• Измените значение свойства name на Pete.');

let user = {};

user.name = 'John';
user.surname = 'Smith';

console.log(user);

user.name = 'Pete';

console.log(user);

console.log('Напишите функцию isEmpty(obj), которая возвращает true, если у объекта нет свойств, иначе false.');

function isEmpty(obj) {
    return Object.keys(obj).length < 0;
}

console.log(isEmpty(user));
console.log(isEmpty({}));

console.log('У нас есть объект, в котором хранятся зарплаты нашей команды “let salaries = {Ivan: 1000, Dmitriy:\n' +
    '1600, Anton: 1300}”. Напишите код для суммирования всех зарплат и сохраните результат в\n' +
    'переменной sum. Если объект salaries пуст, то результат должен быть 0');

let salaries = {Ivan: 1000, Dmitriy: 1600, Anton: 1300};

function salariesSum(obj) {
    if (isEmpty(obj)) {
        return 0;
    }

    let sum = 0;

    for(key in obj) {
        sum += obj[key];
    }
    return sum;
}

console.log(salariesSum(salaries));
console.log(salariesSum({}));

console.log('Создайте функцию multiplyNumeric(obj), которая умножает все числовые свойства объекта obj на 2.\n' +
    'Обратите внимание, что multiplyNumeric не нужно ничего возвращать. Следует напрямую изменять\n' +
    'объект. Используйте typeof для проверки, что значение свойства числовое.');

let mixedObj = {
    prop1:  1,
    prop2:  6,
    prop3:  true,
    prop4:  'a string',
    prop5:  255,
    prop6:  salaries,
    prop7:  null,
    prop8:  15,
    prop9:  undefined,
    prop10: {},
    prop11: 42,
    prop12: [8, 16, 'js', [32, 64, 128]],
    prop13: [],
    prop14: -512,
    prop15: 0,
    prop16: function() {
        return 0;
    },
    prop17: [
        {
            prop1: 0.05,
            prop2: 0.25,
            prop3: 12.3
        },
        {
            prop1: 'another string',
            prop2: 0,
            prop3: false,
            prop4: 33
        },
        {}
        ],
    prop18: {
        prop1: {
            prop1: 0.05,
            prop2: 0.25,
            prop3: 12.3
        },
        prop2: {
            prop1: 'another string',
            prop2: 0,
            prop3: false,
            prop4: {
                prop1: 33
            }
        }
        },
    prop19: 0.18,
};

function multiplyNumeric(obj) {
    for(key in obj){
        if(typeof obj[key] === 'number') {
            obj[key] *= 2;
        } else if(typeof obj[key] === 'object') {
            multiplyNumeric(obj[key]);
        }
    }
}

multiplyNumeric(mixedObj);

console.log(mixedObj);

console.log('Создайте класс transport и дочерние - car, motorbike, и bicycle.\n' +
    'Придумайте и опишите по несколько свойств и методов, включая\n' +
    'одинаковый для всех классов метод ride() и свойство maxSpeed,\n' +
    'ограничьте максимальную скорость для объектов классов car,\n' +
    'motorbike.');

class Transport {
    #maxSpeed;
    #maxPassengers;
    currentSpeed = 0;
    currentPassengers = 0;
    constructor(maxSpeed, maxPassengers) {
        this.#maxSpeed = maxSpeed
        this.#maxPassengers = maxPassengers
    }
    get maxSpeed() {
        return this.#maxSpeed;
    }
    set maxSpeed(speed) {
        this.#maxSpeed = speed;
    }
    get maxPassengers() {
        return this.#maxPassengers;
    }
    set maxPassengers(passengers) {
        this.#maxPassengers = passengers;
    }
    ride(speed){
        this.currentSpeed = speed <= this.#maxSpeed ? speed : this.#maxSpeed;
    }
    stop(){
        this.currentSpeed = 0;
    }
    takePassengers(passengers){
        if(this.currentSpeed == 0) {
            this.currentPassengers = passengers <= this.#maxPassengers ? passengers : this.#maxPassengers;
        }
    }
}

class Car extends Transport {
    #leftSteeringWheel = true
    mileage = 0;
    constructor(maxSpeed, maxPassengers, leftSteeringWheel){
        maxSpeed = maxSpeed <= 80 ? maxSpeed : 80;
        super(maxSpeed, maxPassengers);
        this.#leftSteeringWheel = leftSteeringWheel
    }
    signal(){
        console.log('Beep-beep!');
    }
    get mileage() {
        return this.mileage;
    }
    set mileage(mileage) {
        this.mileage = mileage;
    }
}

class Motorbike extends Transport {
    hasSidecar = false;
    constructor(maxSpeed, maxPassengers){
        maxSpeed = maxSpeed <= 100 ? maxSpeed : 100;
        super(maxSpeed, maxPassengers);
    }
    attachSidecar(){
        this.hasSidecar = true;
        this.maxPassengers++;
    }
    removeSidecar(){
        if(this.hasSidecar){
            this.hasSidecar = false;
            this.maxPassengers--;
        }
    }

}

class Bicycle extends Transport {
    wheelsCount = 2;
    constructor(maxSpeed, maxPassengers, wheelsCount){
        maxSpeed = maxSpeed <= 80 ? maxSpeed : 80;
        super(maxSpeed, maxPassengers);
        this.wheelsCount = wheelsCount <= 3 && wheelsCount > 0 ? wheelsCount : 2;
    }
    signal(){
        console.log('Tink-tink-tink!');
    }
}

let car = new Car(120, 5, true);
car.ride(50);
car.stop();
car.takePassengers(4);
car.ride(60);
console.log(car);

let motorbike = new Motorbike(150, 2);
motorbike.attachSidecar();
console.log(motorbike);

let bicycle = new Bicycle(10, 2, 3);
console.log(bicycle);
bicycle.signal();

console.log('Создайте массив из 6 объектов классов car, motorbike, bicycle и\n' +
    'отсортируйте его от самого быстрого к самому медленному');

let transport = [
    new Car(100, 5),
    new Motorbike(120, 2),
    new Car(70, 4),
    new Bicycle(12, 3),
    new Motorbike(90, 1),
    new Bicycle(30, 2),
];

transport.sort(function(a, b) {
    return b.maxSpeed - a.maxSpeed;
});

console.log(transport);

console.log('Используя прототип добавьте метод классу transport.');

Transport.prototype.setBrand = function (brand) {
    Transport.prototype.brand = brand;
}

car.setBrand('GMC');
console.log(car.brand);