<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partit extends Model
{
    use HasFactory;

    protected $fillable = ['local_id', 'visitant_id', 'estadi_id', 'arbitre_id', 'data', 'jornada', 'gols_local', 'gols_visitant'];
    protected $casts = [
        'data' => 'date',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function local()
    {
        return $this->belongsTo(Equip::class, 'local_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function visitant()
    {
        return $this->belongsTo(Equip::class, 'visitant_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function estadi()
    {
        return $this->belongsTo(Estadi::class, 'estadi_id');
    }

    /**
     * Alias per a la relació local per mantenir compatibilitat
     */
    public function equipLocal()
    {
        return $this->local();
    }

    /**
     * Alias per a la relació visitant per mantenir compatibilitat
     */
    public function equipVisitant()
    {
        return $this->visitant();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function arbitre()
    {
        return $this->belongsTo(User::class, 'arbitre_id');
    }

    public function getResultatAttribute()
    {
        if ($this->gols_local === null || $this->gols_visitant === null) {
            return '-';
        }
        return "{$this->gols_local} - {$this->gols_visitant}";
    }
}
