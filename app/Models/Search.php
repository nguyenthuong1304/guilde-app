<?php

namespace App\Models;

trait Search
{
    private function buildWildCards($term) {
        // if ($term == "") {
        //     return $term;
        // }

        // $reservedSymbols = ['-', '+', '<', '>', '@', '(', ')', '~'];
        // $term = str_replace($reservedSymbols, '', $term);

        // $words = explode(' ', $term);
        // foreach($words as $idx => $word) {
        //     $words[$idx] = "+" . $word . "*";
        // }
        // $term = implode(' ', $words);

        return $term;
    }

    protected function scopeSearch($query, $term, $prefix = null) {

        // $query->whereRaw(
        //     "MATCH ({$columns}) AGAINST (? IN BOOLEAN MODE)",
        //     $this->buildWildCards($term)
        // );
        $query->where(function ($q) use ($term, $prefix) {
            foreach ($this->searchable as $field) {
                $field = $prefix ? "$prefix.$field" : $field;
                $q->orWhere($field, 'like' ,'%'.$this->buildWildCards($term).'%');
            }
        });

        return $query;
    }
}
