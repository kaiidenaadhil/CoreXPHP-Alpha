<?php

function generateRoutes($models) {
    $method = $models;//singularize($models);
    $controller = ucfirst($models) . 'Controller';
    $app = '$app';
    $identify = $models.'Identify';
    $routes = [
        "// {$models} of routes",
        "{$app}->router->get('/{$models}', [{$controller}::class, '{$method}Index']);",
        "{$app}->router->get('/{$models}/build', [{$controller}::class, '{$method}Build']);",
        "{$app}->router->post('/{$models}/build', [{$controller}::class, '{$method}Record']);",
        "{$app}->router->get('/{$models}/{{$identify}}/destroy', [{$controller}::class, '{$method}Destroy']);",
        "{$app}->router->get('/{$models}/{{$identify}}/modify', [{$controller}::class, '{$method}Modify']);",
        "{$app}->router->post('/{$models}/{{$identify}}/modify', [{$controller}::class, '{$method}Edit']);",
        "{$app}->router->get('/{$models}/{{$identify}}', [{$controller}::class, '{$method}Display']);"
    ];
    return $routes;
}


function generateResource($models) {
    $controller = ucfirst($models) . 'Controller';
    $app = '$app';
    $routes = [
        "{$app}->router->resource('admin/{$models}', '{$models}',{$controller}::class);",
    ];
    return $routes;
}

function removeFields(array $schema, array $fieldsToRemove): array {
    foreach ($fieldsToRemove as $field) {
        unset($schema[$field]);
    }
    return $schema;
}

function removeThree($array) {
    // remove first element
    array_shift($array);
     
    // remove last two elements
    array_pop($array);
    array_pop($array);
    
    return $array;
}

// Camel Case To Sentente Case Function
function camelCaseToSentence($camelCase) {
    $sentence = preg_replace('/(?<!\ )[A-Z]/', ' $0', $camelCase);
    $sentence = ucfirst($sentence);
    return $sentence;
  }
  


function singularize($word) {
    $singular = array (
        '/(quiz)zes$/i' => '\\1',
        '/(matr)ices$/i' => '\\1ix',
        '/(vert|ind)ices$/i' => '\\1ex',
        '/^(ox)en/i' => '\\1',
        '/(alias|status)es$/i' => '\\1',
        '/([octop|vir])i$/i' => '\\1us',
        '/(cris|ax|test)es$/i' => '\\1is',
        '/(shoe)s$/i' => '\\1',
        '/(o)es$/i' => '\\1',
        '/(bus)es$/i' => '\\1',
        '/([m|l])ice$/i' => '\\1ouse',
        '/(x|ch|ss|sh)es$/i' => '\\1',
        '/(m)ovies$/i' => '\\1ovie',
        '/(s)eries$/i' => '\\1eries',
        '/([^aeiouy]|qu)ies$/i' => '\\1y',
        '/([lr])ves$/i' => '\\1f',
        '/(tive)s$/i' => '\\1',
        '/(hive)s$/i' => '\\1',
        '/([^f])ves$/i' => '\\1fe',
        '/(^analy)ses$/i' => '\\1sis',
        '/((a)naly|(b)a|(d)iagno|(p)arenthe|(p)rogno|(s)ynop|(t)he)ses$/i' => '\\1\\2sis',
        '/([ti])a$/i' => '\\1um',
        '/(n)ews$/i' => '\\1ews',
        '/s$/i' => ''
    );

    $uncountable = array('equipment', 'information', 'rice', 'money', 'species', 'series', 'fish', 'sheep');

    $irregular = array(
        'person' => 'people',
        'man' => 'men',
        'child' => 'children',
        'sex' => 'sexes',
        'move' => 'moves'
    );

    $lowercasedWord = strtolower($word);

    foreach ($uncountable as $uncountableWord) {
        if (substr($lowercasedWord, (-1 * strlen($uncountableWord))) == $uncountableWord) {
            return $word;
        }
    }

    foreach ($irregular as $singularWord => $pluralWord) {
        if (preg_match('/('.$pluralWord.')$/i', $word, $arr)) {
            return preg_replace('/('.$pluralWord.')$/i', substr($arr[0],0,1).substr($singularWord,1), $word);
        }
    }

    foreach ($singular as $rule => $replacement) {
        if (preg_match($rule, $word)) {
            return preg_replace($rule, $replacement, $word);
        }
    }

    return $word;
}



