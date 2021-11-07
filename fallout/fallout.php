<?php
define( 'SPECIAL_MIN', 1 );
define( 'SPECIAL_MAX', 10 );
define( 'MIN_AGE', 15 );
define( 'MAX_AGE', 60 );

game_init();

function game_init() {
    //генерация оружия
    $weapons = weapon_generator(1000 );

    //создание игроков
    $player1 = create_character('Никодим','♂' );
    choose_weapon( $weapons, $player1 );

    $player2 = create_character( 'Евдокия','♀' );
    choose_weapon( $weapons, $player2 );

    //жребий
    $players = [ $player1, $player2 ];
    shuffle( $players );
    list( $player1, $player2) = $players;

    //статы игроков
    get_player_status( $player1 );
    get_player_status( $player2 );

    //бой
    fight( $player1, $player2 ) ;
}

function weapon_generator( $count ) {
    $special = [ 'strength', 'perception', 'endurance', 'intelligence', 'agility' ];

    $types = ['Пистолет', 'Пистолет-пулемёт','Автомат','Винтовка','Мушкет','Ружьё','Пулемёт','Гранатомёт','Кинжал','Тесак','Мачете','Огнемёт','Булава',
    'Катана','Сабля','Шпага','Гуань дао','Граната','Метательный нож','Праща','Рогатка','Лук','Лук репчатый','Бумеранг','Сюрикэн','Арбалет','Бластер',
    'Световой меч','Магический посох','Волшебная палочка','Алебарда', 'Вилка','Дрын','Кастет','Сковородка','Вилы','Грабли','Ложка','Веер','Коса','Миниган',
    'Цепь','Глефа','Секира','Кирка','Лопата','Снайперская винтовка','Моргенштерн','Берцовая кость','Игрушечный автомат','Пластиковый нож','Фламберг',
    'Разбитая бутылка','Дротики','Кусок арматуры','Мультитул','Веник','Кирпич','Мухобойка','Кнут','Пульт от управления Вселенной (без батареек)',
    'Рапира','Опасная бритва','Безопасная бритва','Клешня','Нунчаки','Трость','Кувалда','Артиллерийская установка','Гитара','Базука','Револьвер',
    'Крюк','Бейсбольная бита','Лом','Разводной ключ','Пупырчатая пленка','Газовый балончик','Поднос','Брат боксер','Бензопила','Костыль','Гарпун'];

    $weapons = [];
    for ( $i = 0; $i < $count; $i++ ) {
        $requirements_count = rand( 1, count( $special ) );
        if( $requirements_count > 1 ) {
            $requirements = array_intersect_key( $special, array_flip( array_rand( $special, $requirements_count ) ) );
            $requirements = array_map( function(){ return rand( SPECIAL_MIN, SPECIAL_MAX ); }, array_flip( $requirements ));
        } else {
            $requirements[$special[array_rand( $special )]] = rand( SPECIAL_MIN, SPECIAL_MAX );
        }

        $weapon['damage'] = array_sum( $requirements ) * count( $requirements );
        $weapon['requirements'] = $requirements;
        $weapon['name'] = $types[array_rand( $types )];

        $weapons[] = $weapon;
    }

    return $weapons;
}

function create_character( $name, $gender ) {
    $special = [
        'strength' => rand( SPECIAL_MIN, SPECIAL_MAX ),
        'perception' =>rand( SPECIAL_MIN, SPECIAL_MAX ),
        'endurance' => rand( SPECIAL_MIN, SPECIAL_MAX ),
        'intelligence' => rand( SPECIAL_MIN, SPECIAL_MAX ),
        'agility' => rand( SPECIAL_MIN, SPECIAL_MAX ),
        'luck' => rand( SPECIAL_MIN, SPECIAL_MAX )
    ];
    $age = rand( MIN_AGE, MAX_AGE );
    $character = [
        'name' => $name,
        'gender' => $gender,
        'age' => $age,
        'hp' =>  ( ( MAX_AGE - $age ) + $special['strength'] + $special['endurance'] * 2 ) * SPECIAL_MAX,
        'damage' => $special['strength'] * $special['agility'],
        'special' => $special
    ];
    return $character;
}

function choose_weapon( $weapons, &$player ) {
    $approved_weapons = [];
    $player_special = $player['special'];
    foreach ( $weapons as $weapon ) {
        $weapon_requirements = $weapon['requirements'];
        $approved_requirements = 0;
        foreach ( $weapon_requirements as $requirement=>$value ) {
            if ( $player_special[$requirement] >= $value ) {
                $approved_requirements++;
            }
        }
        if ( $approved_requirements == count( $weapon_requirements ) ) {
            $approved_weapons[] = $weapon;
        }
    }

    if ( empty( $approved_weapons ) ) {
        return;
    }

    sort( $approved_weapons );
    $tries = min( count( $approved_weapons ), $player_special['luck'] );
    $variants = array_rand( $approved_weapons, $tries ) ;
    $best_weapon = is_array( $variants ) ? end( $variants ) : $variants;

    $player['damage'] += $approved_weapons[$best_weapon]['damage'];
    $player['weapon'] = $approved_weapons[$best_weapon];
}

function get_player_status( $player ) {
    echo "Боец: {$player['name']} {$player['gender']}, {$player['age']}\nHP:  {$player['hp']}\nУрон: {$player['damage']}\n";
    if ( ! empty( $player['weapon'] ) ) {
        echo "Оружие: {$player['weapon']['name']} +{$player['weapon']['damage']}\n";
    } else {
        echo "Без оружия\n";
    }
    echo "Удача: {$player['special']['luck']}";
    echo "\n\n";
}

function fight( $player1, $player2 ) {
    $name1 = $player1['name'];
    $name2 = $player2['name'];

    $hp1 = $player1['hp'];
    $hp2 = $player2['hp'];

    while ( true ) {
        if( ! attack_success( $player1 ) ) { //промах или удар
            echo "$name1 бьет мимо\n";
        } else {
            $damage1 = get_attack_damage( $player1 );
            echo "$name1 наносит $damage1 очков урона\n";
            $hp2 -= $damage1;
            if ( $hp2 <= 0 ) {
                echo $name2 . " теряет последнее здоровье.\n\n";
                echo $name1 . ' побеждает!';
                break;
            }
        }

        echo "$name1: $hp1 очков здоровья ( " . round($hp1/$player1['hp'] * 100, 1 ) . "% )\n";
        echo "$name2: $hp2 очков здоровья ( " . round( $hp2/$player2['hp'] * 100, 1 ) . "% )\n\n";

        if( ! attack_success( $player2 ) ) { //промах или удар
            echo "$name2 бьет мимо\n";
        } else {
            $damage2 = get_attack_damage( $player2 );
            echo "$name2 наносит $damage2 очков урона\n";
            $hp1 -= $damage2;
            if ( $hp1 <= 0 ) {
                echo $name1 . " теряет последнее здоровье.\n\n";
                echo $name2 . ' побеждает!';
                break;
            }
        }

        echo "$name1: $hp1 очков здоровья ( " . round($hp1/$player1['hp'] * 100, 1 ) . "% )\n";
        echo "$name2: $hp2 очков здоровья ( " . round( $hp2/$player2['hp'] * 100, 1 ) . "% )\n\n";
    }
}

function attack_success( $player ) {
    $tries = intval( $player['special']['luck'] / 3 );
    if( ! $tries ) {
        $tries = 1;
    }
    while ( $tries ) {
        $attack = rand( 0, 1 );
        if ( ! $attack ) {
            $tries--;
            continue;
        } else {
            return true;
        }
        return false;
    }
}

function get_attack_damage( $player ) {
    $max_damage = $player['damage'] + $player['weapon']['damage'];
    $tries = intval( $player['special']['luck'] / 3 );
    if( ! $tries ) {
        $tries = 1;
    }
    $damage = [];
    while( $tries ) {
        $damage[] = rand( 1, rand( 1, $max_damage ) );
        $tries--;
    }

    return max( $damage ) + $player['special']['luck'];
}