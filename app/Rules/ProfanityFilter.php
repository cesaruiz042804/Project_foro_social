<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ProfanityFilter implements ValidationRule
{
    protected $profanities;

    public function __construct()
    {
        $this->profanities = $this->loadProfanities();
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        foreach ($this->profanities as $profanity) {
            if (stripos($value, $profanity) !== false) {
                $fail('El comentario contiene palabras inapropiadas.');
                return; // Detener la validación si se encuentra una palabra obscena
            }
        }
    }

    protected function loadProfanities()
    {
        // Carga tu lista de palabras obscenas
        return [
            'xuxa',
            'chucha',
            'pene',
            'pito',
            'cueco',
            'maricon',
            'maricón',
            'maricón',
            'marica',
            'puta',
            'putita',
            'puton',
            'putón',
            'lechita',
            'toto',
            'tota',
            'vagina',
            'mamador',
            'mamabicho',
            'mamapinga',
            'teton',
            'teta',
            'tetita',
            'bubis',
            'nalga',
            'nalgon',
        ];
    }
}
