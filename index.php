<?php

$card_deck = [
    ['name' => 'Ace of spades', 'value' => [1, 11]],
    ['name' => 'K of spades', 'value' => 10],
    ['name' => 'D of spades', 'value' => 10],
    ['name' => 'J of spades', 'value' => 10],
    ['name' => '10 of spades', 'value' => 10],
    ['name' => '9 of spades', 'value' => 9],
    ['name' => '8 of spades', 'value' => 8],
    ['name' => '7 of spades', 'value' => 7],
    ['name' => '6 of spades', 'value' => 6],
    ['name' => '5 of spades', 'value' => 5],
    ['name' => '4 of spades', 'value' => 4],
    ['name' => '3 of spades', 'value' => 3],
    ['name' => '2 of spades', 'value' => 2],
    ['name' => 'Ace of hearts', 'value' => [1, 11]],
    ['name' => 'K of hearts', 'value' => 10],
    ['name' => 'D of hearts', 'value' => 10],
    ['name' => 'J of hearts', 'value' => 10],
    ['name' => '10 of hearts', 'value' => 10],
    ['name' => '9 of hearts', 'value' => 9],
    ['name' => '8 of hearts', 'value' => 8],
    ['name' => '7 of hearts', 'value' => 7],
    ['name' => '6 of hearts', 'value' => 6],
    ['name' => '5 of hearts', 'value' => 5],
    ['name' => '4 of hearts', 'value' => 4],
    ['name' => '3 of hearts', 'value' => 3],
    ['name' => '2 of hearts', 'value' => 2],
    ['name' => 'Ace of diamonds', 'value' => [1, 11]],
    ['name' => 'K of diamond', 'value' => 10],
    ['name' => 'D of diamond', 'value' => 10],
    ['name' => 'J of diamond', 'value' => 10],
    ['name' => '10 of diamond', 'value' => 10],
    ['name' => '9 of diamond', 'value' => 9],
    ['name' => '8 of diamond', 'value' => 8],
    ['name' => '7 of diamond', 'value' => 7],
    ['name' => '6 of diamond', 'value' => 6],
    ['name' => '5 of diamond', 'value' => 5],
    ['name' => '4 of diamond', 'value' => 4],
    ['name' => '3 of diamond', 'value' => 3],
    ['name' => '2 of diamond', 'value' => 2],
    ['name' => 'Ace of clubs', 'value' => [1, 11]],
    ['name' => 'K of clubs', 'value' => 10],
    ['name' => 'D of clubs', 'value' => 10],
    ['name' => 'J of clubs', 'value' => 10],
    ['name' => '10 of clubs', 'value' => 10],
    ['name' => '9 of clubs', 'value' => 9],
    ['name' => '8 of clubs', 'value' => 8],
    ['name' => '7 of clubs', 'value' => 7],
    ['name' => '6 of clubs', 'value' => 6],
    ['name' => '5 of clubs', 'value' => 5],
    ['name' => '4 of clubs', 'value' => 4],
    ['name' => '3 of clubs', 'value' => 3],
    ['name' => '2 of clubs', 'value' => 2]
];

$my_cards = [];
$dealer_cards = [];

function get_random_card(&$array, &$cards){
    $rand_num = rand(0, count($array) - 1);
    $card = $array[$rand_num];
    if($array[$rand_num]['name'] == "Ace of spades" || $array[$rand_num]['name'] === "Ace of hearts" || $array[$rand_num]['name'] === "Ace of clubs" || $array[$rand_num]['name'] === "Ace of diamonds"){
        $rand_ace_num = rand(0,1);
        $ace_value = $card['value'][$rand_ace_num];
        /*echo $card['name'] . " hat den Wert: " . $ace_value; */
        array_push($cards, $ace_value);
    } else {
        //echo $card['name'] . " hat den Wert: " . $card['value'];
        array_push($cards, $card['value']);
    }
    array_splice($array, $rand_num, 1);
    
}


function dealCards(&$card_deck) {
    global $my_cards;
    global $dealer_cards;
    for ($i = 0; $i < 2; $i++) {
        get_random_card($card_deck, $my_cards);
        get_random_card($card_deck, $dealer_cards);
    }
}

dealCards($card_deck);


function who_won($my_cards, $dealer_cards) {
    $sum_me = array_sum($my_cards);
    $sum_dealer = array_sum($dealer_cards);
    $result = [
        'sum_dealer' => $sum_dealer,
        'sum_me' => $sum_me,
        'me_win' => 0,
        'dealer_win' => 0
    ];

    if ($sum_me > $sum_dealer && $sum_me <= 21) {
        $result['me_win'] = 1;
    } elseif ($sum_dealer > $sum_me && $sum_dealer <= 21) {
        $result['dealer_win'] = 1;
    }

    return $result;
}



function game() {
    global $card_deck;
    global $my_cards;
    global $dealer_cards;

    $total_me_wins = 0;
    $total_dealer_wins = 0;

    for ($i = 0; $i < 5; $i++) {
        $my_cards = [];
        $dealer_cards = [];
        $deck_copy = $card_deck;
        dealCards($deck_copy);

        $result = who_won($my_cards, $dealer_cards);
        $total_me_wins += $result['me_win'];
        $total_dealer_wins += $result['dealer_win'];

        echo "Spiel " . ($i + 1) . ": Spieler: " . $total_me_wins . " vs Dealer: " . $total_dealer_wins . "<br>";
    }

    echo "---------------------------------";
    echo "<br>";

    return ($total_me_wins > $total_dealer_wins ) ? "Spieler hat gewonnen" : "Dealer hat gewonnen";
}

echo game();
