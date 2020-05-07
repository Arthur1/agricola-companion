<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GamePickOccupation extends Model
{
    protected $table = 'game_pick_occupations';
    protected $guarded = ['id'];
    protected $with = ['card'];

    public function card()
    {
        return $this->belongsTo('App\Card', 'card_id');
    }

    public static function setCards(Game $game)
    {
        $hand_cards_number = $game->my_user->hand_occupations->count();
        $set_id = (($hand_cards_number + $game->my_user->player_order - 1) % $game->players_number) + 1;
        $pick_occupations = self::where('game_id', $game->id)->where('set_id', $set_id)->get();
        if ($hand_cards_number + $pick_occupations->count() !== $game->cards_number) {
            return [];
        }
        return $pick_occupations;
    }
}
